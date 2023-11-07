<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\DowntimeModel;
use App\Models\UnitModel;
use CodeIgniter\Images\Image;
use Dompdf\Dompdf;
use FPDF;

class Downtime extends ResourceController
{
    protected $helpers = ['custom'];
    protected $pdf;
    function __construct()
    {
        $this->downtime = new DowntimeModel();
        $this->units = new UnitModel();
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['downtime'] = $this->downtime->getAll();
        return view('downtime/home', $data);
    }
    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $data['unit'] = $this->units->findAll();
        return view('downtime/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $validate = $this->validate([
            'id_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Unit Dipilih salah satu.',
                ],
            ],
            'down_awal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon down Awal Untuk diisi.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $data['unit'] = $this->units->findAll();
            return view('downtime/new', $data);
        }
        $waktuAwal = strtotime($this->request->getPost('down_awal'));
        $waktuAkhir = strtotime($this->request->getPost('down_akhir'));
        $selisihWaktu = $waktuAkhir - $waktuAwal;
        if ($selisihWaktu < 0) {
            $selisihWaktu = 0;
        } else {
            $selisihWaktu = date($waktuAwal, $waktuAkhir);
        }
        $data = [
            'id_unit' => $this->request->getPost('id_unit'),
            'tanggal_input' => $this->request->getPost('tanggal_input'),
            'down_awal' => $this->request->getPost('down_awal'),
            'down_akhir' => $this->request->getPost('down_akhir'),
            'interval' => $selisihWaktu,
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        // $data = $this->request->getPost();
        $this->downtime->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('downtime'))->with('success', 'Data telah ditambahkan');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $downtime = $this->downtime->find($id);
        if (is_object($downtime)) {
            $data['downtime'] = $downtime;
            $data['unit'] = $this->units->findAll();
            return view('downtime/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $validate = $this->validate([
            'id_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Unit Dipilih salah satu.',
                ],
            ],
            'down_awal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon down Awal Untuk diisi.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $data['unit'] = $this->units->findAll();
            return view('downtime/edit', $data);
            //print_r('disini');
        }
        $waktuAwal = strtotime($this->request->getPost('down_awal'));
        $waktuAkhir = strtotime($this->request->getPost('down_akhir'));
        $selisihWaktu = $waktuAkhir - $waktuAwal;
        $data = [
            'tanggal_input' => $this->request->getPost('tanggal_input'),
            'down_awal' => $this->request->getPost('down_awal'),
            'down_akhir' => $this->request->getPost('down_akhir'),
            'interval' => $selisihWaktu,
            'keterangan' => $this->request->getPost('keterangan'),
        ];
        // $data = $this->request->getPost();
        $this->downtime->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('downtime'))->with('success', ' Data telah diupdate');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->downtime->where(['id_downtime' => $id])->delete();
        return redirect()->to(site_url('downtime'))->with('delete', 'Data Berhasil Dihapus');
    }
    public function domPdf()
    {
        $dompdf = new Dompdf();
        $data['downtime'] = $this->downtime->getAll();
        $html = view('downtime/pdf', $data);
        // $dompdf->load_html_file('http://example.com/mydoc.html');
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));
        // exit(0);
        // $dompdf->stream();
    }
    public function tcpdfExport()
    {
        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT);
        // $pdf->AddPage();
        // $data['downtime'] = $this->downtime->getAll();
        // $html = view('downtime/pdf', $data);
        // $pdf->writeHTML($html);
        // $this->response->SetContentType('application/pdf');
        // $pdf->Output('export.pdf', 'I');
        // Data untuk tabel
        $data = [
            ['nama' => 'John Doe', 'alamat' => '123 Main St', 'telepon' => '555-1234'],
            ['nama' => 'Jane Smith', 'alamat' => '456 Elm St', 'telepon' => '555-5678']
        ];

        // Load library TCPDF
        $pdf = new TCPDF();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->AddPage();

        // Render HTML template
        $html = view('downtime/pdf', ['data' => $data]); // Gunakan view() untuk memuat template

        $pdf->writeHTML($html, true, false, true, false, '');
        $this->response->SetContentType('application/pdf');

        // Output file PDF ke browser
        $pdf->Output('Laporan.pdf', 'I');
    }
    public function pdf()
    {
        $data['downtime'] = $this->downtime->getAll();
        return view('downtime/pdf', $data);
    }
    public function header()
    {

        // Memanggil gambar
        $gambarPath = FCPATH . 'template\assets\img\EAS.jpg'; // Ganti dengan path ke gambar header Anda
        $this->pdf->Image($gambarPath, 10, 9, 30);
        $this->pdf->cell(30, 20, '', 1, 0, 'C');
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->cell(160, 20, 'PERMOHONAN FASILITAS ICT', 1, 0, 'C');
        $this->pdf->SetFont('Arial', '', 5);
        $this->pdf->SetXY(20, 10);
        $this->pdf->cell(179, 5, '01', 0, 0, 'R');
        $this->pdf->SetFont('Arial', '', 7);
        $this->pdf->SetXY(20, 20);
        $this->pdf->cell(175, 11, 'FMR-ICT-01', 0, 0, 'R');
        $this->pdf->Ln(10);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->Ln(3);
        $this->pdf->cell(5, 5, '', 0, 0, 'L', 0);
        $this->pdf->cell(20, 5, 'PT', 0, 0, 'L', 0);
        $this->pdf->cell(5, 5, ':  ', 0, 0, 'L', 0);
        $this->pdf->SetFont('Arial', 'U', 9);
        $this->pdf->cell(5, 5, '                                                            ', 0, 0, 'L', 0);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->cell(5, 5, '', 0, 0, 'L', 0);
        $this->pdf->cell(20, 5, 'Tanggal', 0, 0, 'L', 0);
        $this->pdf->cell(5, 5, ':  ', 0, 0, 'L', 0);
        $this->pdf->SetFont('Arial', 'U', 9);
        $this->pdf->cell(5, 5, '                                                            ', 0, 0, 'L', 0);
        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->cell(5, 5, '', 0, 0, 'L', 0);
        $this->pdf->cell(20, 5, 'Pengguna', 0, 0, 'L', 0);
        $this->pdf->cell(5, 5, ':  ', 0, 0, 'L', 0);
        $this->pdf->SetFont('Arial', 'U', 9);
        $this->pdf->cell(5, 5, '                                                            ', 0, 0, 'L', 0);
        $this->pdf->Ln(6);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->cell(5, 5, '', 0, 0, 'L', 0);
        $this->pdf->cell(20, 5, 'Dept.', 0, 0, 'L', 0);
        $this->pdf->cell(5, 5, ':  ', 0, 0, 'L', 0);
        $this->pdf->SetFont('Arial', 'U', 9);
        $this->pdf->cell(5, 5, '                                                            ', 0, 0, 'L', 0);

        $this->pdf->SetFont('Arial', '', 9);

        $this->pdf->SetXY(40, 33);
        $this->pdf->cell(5, 5, 'JAL', 0, 0, 'L', 0);

        $this->pdf->SetXY(40, 39);
        $this->pdf->cell(5, 5, '26 Oktober 2023', 0, 0, 'L', 0);

        $this->pdf->SetXY(40, 45);
        $this->pdf->cell(5, 5, 'SHRE', 0, 0, 'L', 0);

        $this->pdf->SetXY(40, 51);
        $this->pdf->cell(5, 5, 'SHRE', 0, 0, 'L', 0);

        $this->pdf->SetXY(100, 33);
        $this->pdf->cell(5, 5, 'URGENT     :', 0, 0, 'L', 0);

        $this->pdf->SetXY(125, 34);
        $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);

        $this->pdf->SetXY(100, 44);
        $this->pdf->cell(5, 5, 'NORMAL     :', 0, 0, 'L', 0);

        $this->pdf->SetXY(125, 45);
        $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);

        $this->pdf->SetXY(160, 33);
        $this->pdf->cell(5, 5, 'HARDWARE     :', 0, 0, 'L', 0);
        $this->pdf->SetXY(190, 33);
        $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);

        $this->pdf->SetXY(160, 44);
        $this->pdf->cell(5, 5, 'SOFTWARE     :', 0, 0, 'L', 0);
        $this->pdf->SetXY(190, 45);
        $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);

        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->SetXY(18, 58);
        $this->pdf->cell(5, 5, 'Detail Fasilitas ICT', 0, 0, 'L', 0);
    }

    public function body()
    {
        $this->pdf->SetXY(13, 65);
        $this->pdf->cell(10, 7, 'No.', 1, 0, 'C', 0);
        $this->pdf->cell(60, 7, 'Nama Barang', 1, 0, 'C', 0);
        $this->pdf->cell(18, 7, 'Merk/Tipe', 1, 0, 'C', 0);
        $this->pdf->cell(17, 7, 'Jumlah', 1, 0, 'C', 0);
        $this->pdf->cell(20, 7, 'Harga', 1, 0, 'C', 0);
        $this->pdf->cell(20, 7, 'Total', 1, 0, 'C', 0);
        $this->pdf->cell(40, 7, 'Keterangan', 1, 0, 'C', 0);
        $this->pdf->ln(5);

        $string = $this->GetMultiCellHeight(11, 'PC Corei3-Gen11 (3.0 Ghz Up To 4.8 Ghz Cache 12MB) | RAM 8 GB | SSD 512 GB | VGA SHARED | LAYAR 19,5" | Garansi > 2 Thn');

        $this->pdf->SetXY(13, 72);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->cell(10, $string, '1', 1, 0, 'C', 0);

        $this->pdf->cell(60, $string, '', 1, 0, 'L');
        $this->pdf->SetXY(23, 72);
        $this->pdf->MultiCell(60, 4, 'PC Corei3-Gen11 (3.0 Ghz Up To 4.8 Ghz Cache 12MB) | RAM 8 GB | SSD 512 GB | VGA SHARED | LAYAR 19,5" | Garansi > 2 Thn ', 0, 'L');

        $this->pdf->SetXY(83, 72);
        $this->pdf->cell(18, $string, '', 1, 0, 'L');
        $this->pdf->SetXY(83, 72);
        $this->pdf->MultiCell(18, 4, 'LENOVO/HP/DELL/MSI/ASUS', 0, 'L');

        $this->pdf->SetXY(101, 72);
        $this->pdf->cell(17, $string, '', 1, 0, 'L');
        $this->pdf->SetXY(104, 74);
        $this->pdf->MultiCell(11, 4, '2 Unit', 0, 'C');

        $this->pdf->SetXY(118, 72);
        $this->pdf->cell(20, $string, '', 1, 0, 'L');
        $this->pdf->SetXY(108, 74);
        $this->pdf->MultiCell(40, 4, 'Rp. 13.250.000', 0, 'C');

        $this->pdf->SetXY(138, 72);
        $this->pdf->cell(20, $string, '', 1, 0, 'L');
        $this->pdf->SetXY(128, 74);
        $this->pdf->MultiCell(40, 4, 'Rp. 26.500.000', 0, 'C');

        $this->pdf->SetXY(158, 72);
        $this->pdf->cell(40, $string, '', 1, 0, 'L');
        $this->pdf->SetXY(160, 73);
        $this->pdf->MultiCell(40, 4, 'U/ Penunjang Pekerjaan Admin dan Krani Estate ( dikarenakan Perangkat User Rusak kena petir )', 0, 'L');
    }

    function GetMultiCellHeight($w, $txt)
    {
        $height = 1;
        $strlen = strlen($txt);
        $wdth = 0;
        for ($i = 0; $i <= $strlen; $i++) {
            $char = substr($txt, $i, 1);
            $wdth += $this->pdf->GetStringWidth($char);
            if ($char == "\n") {
                $height++;
                $wdth = 0;
            }
            if ($wdth >= $w) {
                $height++;
                $wdth = 0;
            }
        }
        return $height;
    }

    function Footer()
    {
        //Geser posisi ke 1,5 cm dari bawah
        $this->pdf->SetY(-15);
        //Pilih font Arial italic 8
        $this->pdf->SetFont('Arial', 'I', 8);
        //Tampilkan nomor halaman rata tengah
        $this->pdf->Cell(0, 10, 'Page ' . $this->pdf->PageNo(), 0, 0, 'C');
    }

    public function ttd()
    {
    }

    public function exportPDF()
    {
        $this->header();
        $this->body();
        $this->ttd();
        $this->Footer();

        // Output the PDF
        $pdfContent = $this->pdf->Output('', 'S'); // 'S' mengembalikan konten sebagai string

        // Mengatur header HTTP untuk menampilkan PDF di browser
        return $this->response
            ->setStatusCode(200)
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="laporan.pdf"')
            ->setBody($pdfContent);
    }
}
