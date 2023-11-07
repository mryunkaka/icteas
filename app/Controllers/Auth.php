<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RegModel;
use App\Models\UnitModel;

class Auth extends BaseController
{
    protected $helpers = ['custom'];
    function __construct()
    {
        $this->regis = new RegModel();
        $this->units = new UnitModel();
    }
    public function index()
    {
        return redirect()->to(site_url('login'));
    }
    public function login()
    {
        if (session('id_user')) {
            return view('home');
        }
        return view('auth/login');
    }
    public function loginProcess()
    {
        $post = $this->request->getPost();
        $query = $this->db->table('users')->getWhere(['username' => $post['username']]);
        $user = $query->getRow();
        if ($user) {
            if (password_verify($post['password'], $user->password_user)) {
                $status = $user->status;
                if ($status == 0) {
                    return redirect()->back()->with('error', 'Akun anda belum di Approve, Mohon tunggu');
                } else {
                    $param = [
                        'id_user' => $user->id_user,
                        'id_unit' => $user->id_unit,
                        'nama' => $user->name_user,
                        'jabatan' => $user->jabatan_user
                    ];
                    session()->set($param);
                    return redirect()->to(site_url('home'));
                }
            } else {
                return redirect()->back()->with('error', 'Pasword Tidak Sesuai');
            }
        } else {
            return redirect()->back()->with('error', 'Username Tidak Ditemukan!');
        }
    }
    public function register()
    {
        if (session('id_user')) {
            return redirect()->to(site_url('home'));
        }
        $data['unit'] = $this->units->findAll();
        return view('auth/register', $data);
    }
    public function logout()
    {
        session()->remove('id_user');
        return redirect()->to(site_url('login'));
    }
    public function prosesRegis()
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
            $data['unit'] = $this->units->findAll();
            return view('auth/register', $data);
        }
        $data = [
            'username' => $this->request->getPost('username'),
            'nik_name' => $this->request->getPost('nik_name'),
            'name_user' => $this->request->getPost('name_user'),
            'email_user' => $this->request->getPost('email_user'),
            'password_user' => password_hash($this->request->getPost('password_user'), PASSWORD_DEFAULT),
            'jabatan_user' => $this->request->getPost('jabatan_user'),
            'id_unit' => $this->request->getPost('id_unit'),
        ];
        // $data = $this->request->getPost();
        $this->regis->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('auth/register'))->with('success', 'Data anda berhasil didaftarkan, Mohon tunggu data anda masih di lakukan pengecekan');
    }
}
