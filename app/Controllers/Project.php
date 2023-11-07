<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProjectModel;
use App\Models\UnitModel;
use FPDF;

class Project extends BaseController
{
    protected $helpers = ['custom'];
    protected $pdf;
    protected $unit;
    protected $project;
    function __construct()
    {
        $this->unit = new UnitModel();
        $this->pdf = new FPDF();
        $this->project = new ProjectModel();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    public function index()
    {
        $data['nama_data'] = $this->project->getAll();
        return view('project/home', $data);
    }
    public function add()
    {
        $data['unit'] = $this->unit->findAll();
        return view('project/add', $data);
    }
    public function create()
    {
        if (!empty($_FILES['rab']['name'])) {
            $rab = $this->request->getFile('rab');
            $namarab = $rab->getRandomName();
            $rab->move('uploads/project', $namarab);
            $status = 0;
        } else {
            $namarab = '';
        }
        if (!empty($_FILES['bapp']['name'])) {
            $bapp = $this->request->getFile('bapp');
            $namabapp = $bapp->getRandomName();
            $bapp->move('uploads/project', $namabapp);
            $status = 1;
        } else {
            $namabapp = '';
        }
        if (!empty($_FILES['bast']['name'])) {
            $bast = $this->request->getFile('bast');
            $namabast = $bast->getRandomName();
            $bast->move('uploads/project', $namabast);
            $status = 2;
        } else {
            $namabast = '';
        }
        $data = [
            'id_unit' => $this->request->getPost('id_unit'),
            'nama_project' => $this->request->getPost('nama_project'),
            'jenis_pekerjaan' => $this->request->getPost('jenis_pekerjaan'),
            'estimasi' => $this->request->getPost('estimasi'),
            'no_ict' => $this->request->getPost('no_ict'),
            'rab' => $namarab,
            'bapp' => $namabapp,
            'bast' => $namabast,
            'status' => $status,
        ];
        $this->project->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('project/home/'))->with('success', 'Data telah ditambahkan');
    }
    public function edit($id = null)
    {
        $project = $this->project->find($id);
        if (is_object($project)) {
            $data['project'] = $project;
            $data['unit'] = $this->unit->findAll();
            return view('project/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function editP($id = null)
    {
        $oldimage = $this->project->find($id);
        if (!empty($_FILES['rab']['name'])) {
            $rab = $this->request->getFile('rab');
            $namarab = $rab->getRandomName();
            $rab->move('uploads/project', $namarab);
            $status = 0;
            $data['img'] = $oldimage;
            $gmbr = $data['img']->rab;
            if ($gmbr != null) {
                unlink('uploads/project/' . $gmbr);
            }
        } else {
            $data['img'] = $oldimage;
            $namarab = $data['img']->rab;
        }
        if (!empty($_FILES['bapp']['name'])) {
            $bapp = $this->request->getFile('bapp');
            $namabapp = $bapp->getRandomName();
            $bapp->move('uploads/project', $namabapp);
            $status = 1;
            $data['img'] = $oldimage;
            $gmbr = $data['img']->bapp;
            if ($gmbr != null) {
                unlink('uploads/project/' . $gmbr);
            }
        } else {
            $data['img'] = $oldimage;
            $namabapp = $data['img']->bapp;
        }
        if (!empty($_FILES['bast']['name'])) {
            $bast = $this->request->getFile('bast');
            $namabast = $bast->getRandomName();
            $bast->move('uploads/project', $namabast);
            $status = 2;
            $data['img'] = $oldimage;
            $gmbr = $data['img']->bast;
            if ($gmbr != null) {
                unlink('uploads/project/' . $gmbr);
            }
        } else {
            $data['img'] = $oldimage;
            $namabast = $data['img']->bast;
        }
        $data = [
            'id_unit' => $this->request->getPost('id_unit'),
            'nama_project' => $this->request->getPost('nama_project'),
            'jenis_pekerjaan' => $this->request->getPost('jenis_pekerjaan'),
            'estimasi' => $this->request->getPost('estimasi'),
            'no_ict' => $this->request->getPost('no_ict'),
            'rab' => $namarab,
            'bapp' => $namabapp,
            'bast' => $namabast,
            'status' => $status,
        ];
        $this->project->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('project/home/'))->with('success', 'Data telah ditambahkan');
    }
    public function delete($id = null)
    {
        $oldimage = $this->project->find($id);

        $data['img'] = $oldimage;
        $gmbr = $data['img']->rab;
        if ($gmbr != null) {
            unlink('uploads/project/' . $gmbr);
        }

        $data['img'] = $oldimage;
        $gmbr = $data['img']->bapp;
        if ($gmbr != null) {
            unlink('uploads/project/' . $gmbr);
        }

        $data['img'] = $oldimage;
        $gmbr = $data['img']->bast;
        if ($gmbr != null) {
            unlink('uploads/project/' . $gmbr);
        }
        $this->project->where(['id_project' => $id])->delete();
        return redirect()->to(site_url('project/home'))->with('delete', 'Data Berhasil Dihapus');
    }
    public function showPDF($filename)
    {
        $pdfFilePath = 'uploads/project/' . $filename; // Path ke file PDF
        if (file_exists($pdfFilePath)) {
            return $this->response->download($pdfFilePath, null);
        } else {
            echo "File not found";
        }
    }
}
