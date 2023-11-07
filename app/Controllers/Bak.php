<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BakModel;
use App\Models\PerbaikanModel;
use App\Models\UnitModel;
use FPDF;

class Bak extends BaseController
{
    protected $helpers = ['custom'];
    protected $pdf;
    protected $unit;
    protected $bak;
    function __construct()
    {
        $this->unit = new UnitModel();
        $this->pdf = new FPDF();
        $this->bak = new BakModel();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    public function index()
    {
        $data['bak'] = $this->bak->getAll();
        return view('bak/home', $data);
    }
    public function add()
    {
        $data['unit'] = $this->unit->findAll();
        $data['nama_data'] = $this->bak->selectMax('no_bak')->where('id_unit', session('id_unit'))->get()->getRowArray();
        return view('bak/add', $data);
    }
    public function create()
    {
        $data = $this->request->getPost();
        $this->bak->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('bak/home'))->with('success', 'Data telah ditambahkan');
    }
    public function edit($id = null)
    {
        $bak = $this->bak->find($id);
        if (is_object($bak)) {
            $data['bak'] = $bak;
            $data['unit'] = $this->unit->findAll();
            return view('bak/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function editP($id = null)
    {
        $data = $this->request->getPost();
        $this->bak->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('bak/home'))->with('success', 'Data telah ditambahkan');
    }
    public function delete($id = null)
    {
        $this->bak->where(['id_bak' => $id])->delete();
        return redirect()->to(site_url('bak/home'))->with('delete', 'Data Berhasil Dihapus');
    }
}
