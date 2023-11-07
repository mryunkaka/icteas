<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\PerbaikanModel;
use App\Models\PermintaanModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use FPDF;

class Perbaikan extends BaseController
{
    protected $helpers = ['custom'];
    protected $pdf;
    protected $barang;
    protected $permintaan;
    protected $unit;
    protected $user;
    protected $perbaikan;
    function __construct()
    {
        $this->barang = new BarangModel();
        $this->permintaan = new PermintaanModel();
        $this->unit = new UnitModel();
        $this->user = new UserModel();
        $this->pdf = new FPDF();
        $this->perbaikan = new PerbaikanModel();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    public function index()
    {
        $data['perbaikan'] = $this->perbaikan->getAll();
        return view('perbaikan/home', $data);
    }
    public function add()
    {
        $data['unit'] = $this->unit->findAll();
        $data['no_perbaikan'] = $this->perbaikan->selectMax('no_perbaikan')->where('id_unit', session('id_unit'))->get()->getRowArray();
        return view('perbaikan/add', $data);
    }
    public function create()
    {
        $data = $this->request->getPost();
        $this->perbaikan->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('perbaikan/home'))->with('success', 'Data telah ditambahkan');
    }
    public function edit($id = null)
    {
        $perbaikan = $this->perbaikan->find($id);
        if (is_object($perbaikan)) {
            $data['perbaikan'] = $perbaikan;
            $data['unit'] = $this->unit->findAll();
            return view('perbaikan/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function editP($id = null)
    {
        $data = $this->request->getPost();
        $this->perbaikan->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('perbaikan/home'))->with('success', 'Data telah ditambahkan');
    }
    public function delete($id = null)
    {
        $this->perbaikan->where(['id_perbaikan' => $id])->delete();
        return redirect()->to(site_url('perbaikan/home'))->with('delete', 'Data Berhasil Dihapus');
    }
}
