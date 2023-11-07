<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UnitModel;
use App\Models\UserModel;

class User extends BaseController
{
    protected $helpers = ['custom'];
    protected $user;
    protected $unit;
    function __construct()
    {
        $this->user = new UserModel();
        $this->unit = new UnitModel();
    }
    public function home()
    {
        $data['nama_data'] = $this->user->getAll();
        return view('user/home', $data);
    }
    public function add()
    {
        $data['nama_data'] = $this->user->get()->getResult();
        $data['unit'] = $this->unit->findAll();
        return view('user/add', $data);
    }
    public function prosesAdd()
    {
        $validate = $this->validate([
            'name_user' => [
                'rules' => 'required|is_unique[users.name_user]|min_length[6]',
                'errors' => [
                    'required' => 'Mohon nama diisi dengan lengkap.',
                    'is_unique' => 'Nama ini sudah terpakai, Mohon gunakan nama lain.',
                    'min_length' => 'Mohon isi Nama minimal 6 Karakter.',
                ],
            ],
            'nik_name' => [
                'rules' => 'required|is_unique[users.nik_name]|min_length[4]',
                'errors' => [
                    'required' => 'Mohon NIK diisi dengan lengkap.',
                    'is_unique' => 'NIK ini sudah terpakai, Mohon gunakan nama lain.',
                    'min_length' => 'Mohon isi NIK minimal 4 Karakter.',
                ],
            ],
            'username' => [
                'rules' => 'required|is_unique[users.username]|min_length[6]',
                'errors' => [
                    'required' => 'Mohon Username diisi dengan lengkap.',
                    'is_unique' => 'Username ini sudah terpakai, Mohon gunakan nama lain.',
                    'min_length' => 'Mohon isi Username minimal 6 Karakter.',
                ],
            ],
            'email_user' => [
                'rules' => 'required|is_unique[users.email_user]|valid_email|min_length[6]',
                'errors' => [
                    'required' => 'Mohon Email diisi dengan lengkap.',
                    'is_unique' => 'Username ini sudah terpakai, Mohon gunakan nama lain.',
                    'valid_email' => 'Bukan alamat email yang benar.',
                    'min_length' => 'Mohon isi Email minimal 6 Karakter.',
                ],
            ],
            'password_user' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Mohon Password diisi dengan lengkap.',
                    'min_length' => 'Mohon isi Password minimal 6 Karakter.',
                ],
            ],
            'id_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon pilih Unit Kerja anda.',
                ],
            ],
            'jabatan_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon pilih Jabatan anda.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $user = $this->user->getAll();
            $data['nama_data'] = $user;
            $data['unit'] = $this->unit->findAll();
            return view('user/add', $data);
        }
        if (!empty($_FILES['ttd']['name'])) {
            $file = $this->request->getFile('ttd');
            $namaFoto = $file->getRandomName();
            $file->move('uploads/ttd', $namaFoto);
            $data = [
                'username' => $this->request->getPost('username'),
                'nik_name' => $this->request->getPost('nik_name'),
                'name_user' => $this->request->getPost('name_user'),
                'email_user' => $this->request->getPost('email_user'),
                'password_user' => password_hash($this->request->getPost('password_user'), PASSWORD_DEFAULT),
                'jabatan_user' => $this->request->getPost('jabatan_user'),
                'id_unit' => $this->request->getPost('id_unit'),
                'status' => 1,
                'ttd' => $namaFoto,
            ];
            $this->user->insert($data);
            session()->remove('temp_data');
            return redirect()->to(site_url('user/home'))->with('success', 'User berhasil ditambahkan');
        } else {
            $data = [
                'username' => $this->request->getPost('username'),
                'nik_name' => $this->request->getPost('nik_name'),
                'name_user' => $this->request->getPost('name_user'),
                'email_user' => $this->request->getPost('email_user'),
                'password_user' => password_hash($this->request->getPost('password_user'), PASSWORD_DEFAULT),
                'jabatan_user' => $this->request->getPost('jabatan_user'),
                'id_unit' => $this->request->getPost('id_unit'),
                'status' => 1,
            ];
            $this->user->insert($data);
            session()->remove('temp_data');
            return redirect()->to(site_url('user/home'))->with('success', 'User berhasil ditambahkan');
        }
    }
    public function delete($id = null)
    {
        $oldimage = $this->user->find($id);
        $data['img'] = $oldimage;
        $gmbr = $data['img']->ttd;
        if ($gmbr == null) {
        } else {
            unlink('uploads/ttd/' . $gmbr);
        }
        $this->user->where(['id_user' => $id])->delete();
        return redirect()->to(site_url('user/home'))->with('delete', 'Data Berhasil Dihapus');
    }
    public function verif($id = null)
    {
        $data = [
            'status' => 1,
        ];
        $this->user->update($id, $data);
        return redirect()->to(site_url('user/home'))->with('success', 'User berhasil diverifikasi');
    }
    public function unverif($id = null)
    {
        $data = [
            'status' => 0,
        ];
        $this->user->update($id, $data);
        return redirect()->to(site_url('user/home'))->with('success', 'User berhasil diunverifikasi');
    }
    public function editAja($id = null)
    {
        $user = $this->user->find($id);
        if (is_object($user)) {
            $data['nama_data'] = $user;
            $data['unit'] = $this->unit->findAll();
            return view('user/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function editP($id = null)
    {
        $validate = $this->validate([
            'name_user' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Mohon nama diisi dengan lengkap.',
                    'min_length' => 'Mohon isi Nama minimal 6 Karakter.',
                ],
            ],
            'nik_name' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'Mohon NIK diisi dengan lengkap.',
                    'min_length' => 'Mohon isi NIK minimal 4 Karakter.',
                ],
            ],
            'username' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Mohon Username diisi dengan lengkap.',
                    'min_length' => 'Mohon isi Username minimal 6 Karakter.',
                ],
            ],
            'email_user' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Mohon Email diisi dengan lengkap.',
                    'min_length' => 'Mohon isi Email minimal 6 Karakter.',
                ],
            ],
            'password_user' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Mohon Password diisi dengan lengkap.',
                    'min_length' => 'Mohon isi Password minimal 6 Karakter.',
                ],
            ],
            'id_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon pilih Unit Kerja anda.',
                ],
            ],
            'jabatan_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon pilih Jabatan anda.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $user = $this->user->find($id);
            $data['nama_data'] = $user;
            $data['unit'] = $this->unit->findAll();
            return view('user/edit', $data);
        }
        if (!empty($_FILES['ttd']['name'])) {
            $file = $this->request->getFile('ttd');
            $namaFoto = $file->getRandomName();
            $file->move('uploads/ttd', $namaFoto);
            $data = [
                'username' => $this->request->getPost('username'),
                'nik_name' => $this->request->getPost('nik_name'),
                'name_user' => $this->request->getPost('name_user'),
                'email_user' => $this->request->getPost('email_user'),
                'password_user' => password_hash($this->request->getPost('password_user'), PASSWORD_DEFAULT),
                'jabatan_user' => $this->request->getPost('jabatan_user'),
                'id_unit' => $this->request->getPost('id_unit'),
                'ttd' => $namaFoto,
            ];
            $oldimage = $this->user->find($id);
            $data['img'] = $oldimage;
            $gmbr = $data['img']->ttd;
            if ($gmbr == null) {
            } else {
                unlink('uploads/ttd/' . $gmbr);
            }
            $this->user->update($id, $data);
            session()->remove('temp_data');
            return redirect()->to(site_url('user/home'))->with('success', 'User berhasil ditambahkan');
        } else {
            $data = [
                'username' => $this->request->getPost('username'),
                'nik_name' => $this->request->getPost('nik_name'),
                'name_user' => $this->request->getPost('name_user'),
                'email_user' => $this->request->getPost('email_user'),
                'password_user' => password_hash($this->request->getPost('password_user'), PASSWORD_DEFAULT),
                'jabatan_user' => $this->request->getPost('jabatan_user'),
                'id_unit' => $this->request->getPost('id_unit'),
            ];
            $this->user->update($id, $data);
            session()->remove('temp_data');
            return redirect()->to(site_url('user/home'))->with('success', 'User berhasil ditambahkan');
        }
    }
}
