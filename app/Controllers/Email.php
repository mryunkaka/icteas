<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\EmailModel;
use App\Models\PermintaanModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use FPDF;

class Email extends BaseController
{
    protected $helpers = ['custom'];
    protected $pdf;
    protected $barang;
    protected $permintaan;
    protected $unit;
    protected $user;
    protected $email;
    function __construct()
    {
        $this->barang = new BarangModel();
        $this->permintaan = new PermintaanModel();
        $this->unit = new UnitModel();
        $this->user = new UserModel();
        $this->email = new EmailModel();
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    public function index()
    {
        $data['nama_data'] = $this->email->getAll();
        return view('email/home', $data);
    }
    public function new()
    {
        $data['unit'] = $this->unit->findAll();
        $data['max'] = $this->email->selectMax('no_email')->where('id_unit', session('id_unit'))->get()->getRowArray();
        return view('email/add', $data);
    }
    public function create()
    {
        $data = [
            'nama_pembuat' => $this->request->getPost('nama_pemohon'),
        ];
        $data = $this->request->getPost();
        $this->email->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('email/home'))->with('success', 'Data telah ditambahkan');
    }
    public function edit($id = null)
    {
        $email = $this->email->find($id);
        if (is_object($email)) {
            $data['email'] = $email;
            $data['unit'] = $this->unit->findAll();
            return view('email/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function editP($id = null)
    {
        $data = [
            'nama_pembuat' => $this->request->getPost('nama_pemohon'),
        ];
        $data = $this->request->getPost();
        $this->email->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('email/home'))->with('success', 'Data telah ditambahkan');
    }
    public function delete($id = null)
    {
        $this->email->where(['id_email' => $id])->delete();
        return redirect()->to(site_url('email/home'))->with('delete', 'Data Berhasil Dihapus');
    }
}
