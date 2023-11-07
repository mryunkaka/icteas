<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AsetModel;
use App\Models\BakModel;
use App\Models\UnitModel;
use FPDF;

class Aset extends BaseController
{
    protected $helpers = ['custom'];
    protected $pdf;
    protected $unit;
    protected $aset;
    function __construct()
    {
        $this->unit = new UnitModel();
        $this->pdf = new FPDF();
        $this->aset = new AsetModel();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    public function index()
    {
        $data['aset'] = $this->aset->getAll();
        return view('aset/home', $data);
    }
    public function add()
    {
        $data['unit'] = $this->unit->findAll();
        return view('aset/add', $data);
    }
    public function create()
    {
        if (!empty($_FILES['form_bast']['name'])) {
            $rab = $this->request->getFile('form_bast');
            $namabast = $rab->getRandomName();
            $rab->move('uploads/aset', $namabast);
        } else {
            $namabast = '';
        }
        if (!empty($_FILES['foto_aset']['name'])) {
            $aset = $this->request->getFile('foto_aset');
            $namaaset = $aset->getRandomName();
            $aset->move('uploads/aset', $namaaset);
        } else {
            $namaaset = '';
        }
        $data = [
            'id_unit' => $this->request->getPost('id_unit'),
            'form_bast' => $namabast,
            'no_aset' => $this->request->getPost('no_aset'),
            'desc_aset' => $this->request->getPost('desc_aset'),
            'lokasi' => $this->request->getPost('lokasi'),
            'user' => $this->request->getPost('user'),
            'foto_aset' => $namaaset,
            'tahun_perolehan' => $this->request->getPost('tahun_perolehan'),
            'usia' => $this->request->getPost('usia'),
        ];
        $this->aset->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('aset/home'))->with('success', 'Data telah ditambahkan');
    }
    public function edit($id = null)
    {
        $aset = $this->aset->find($id);
        if (is_object($aset)) {
            $data['aset'] = $aset;
            $data['unit'] = $this->unit->findAll();
            return view('aset/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function editP($id = null)
    {
        $oldimage = $this->aset->find($id);
        if (!empty($_FILES['form_bast']['name'])) {
            $rab = $this->request->getFile('form_bast');
            $namabast = $rab->getRandomName();
            $rab->move('uploads/aset', $namabast);
            $data['img'] = $oldimage;
            $gmbr = $data['img']->form_bast;
            if ($gmbr != null) {
                unlink('uploads/project/' . $gmbr);
            }
        } else {
            $data['img'] = $oldimage;
            $namabast = $data['img']->form_bast;
        }
        if (!empty($_FILES['foto_aset']['name'])) {
            $aset = $this->request->getFile('foto_aset');
            $namaaset = $aset->getRandomName();
            $aset->move('uploads/aset', $namaaset);
            $data['img'] = $oldimage;
            $gmbr = $data['img']->foto_aset;
            if ($gmbr != null) {
                unlink('uploads/project/' . $gmbr);
            }
        } else {
            $data['img'] = $oldimage;
            $namaaset = $data['img']->foto_aset;
        }
        $data = [
            'id_unit' => $this->request->getPost('id_unit'),
            'form_bast' => $namabast,
            'no_aset' => $this->request->getPost('no_aset'),
            'desc_aset' => $this->request->getPost('desc_aset'),
            'lokasi' => $this->request->getPost('lokasi'),
            'user' => $this->request->getPost('user'),
            'foto_aset' => $namaaset,
            'tahun_perolehan' => $this->request->getPost('tahun_perolehan'),
            'usia' => $this->request->getPost('usia'),
        ];
        $this->aset->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('aset/home'))->with('success', 'Data telah ditambahkan');
    }
    public function delete($id = null)
    {
        $oldimage = $this->aset->find($id);

        $data['img'] = $oldimage;
        $gmbr = $data['img']->form_bast;
        if ($gmbr != null) {
            unlink('uploads/aset/' . $gmbr);
        }

        $data['img'] = $oldimage;
        $gmbr = $data['img']->foto_aset;
        if ($gmbr != null) {
            unlink('uploads/aset/' . $gmbr);
        }
        $this->aset->where(['id_aset' => $id])->delete();
        return redirect()->to(site_url('aset/home'))->with('delete', 'Data Berhasil Dihapus');
    }
    public function showPDF($filename)
    {
        $pdfFilePath = 'uploads/aset/' . $filename; // Path ke file PDF
        if (file_exists($pdfFilePath)) {
            return $this->response->download($pdfFilePath, null);
        } else {
            echo "File not found";
        }
    }
}
