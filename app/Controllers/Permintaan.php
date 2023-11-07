<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\PermintaanModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use FPDF;

class Permintaan extends BaseController
{
    protected $helpers = ['custom'];
    protected $pdf;
    protected $barang;
    protected $permintaan;
    protected $units;
    protected $user;
    function __construct()
    {
        $this->permintaan = new PermintaanModel();
        $this->units = new UnitModel();
        $this->barang = new BarangModel();
        $this->user = new UserModel();
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    public function index()
    {
        $data['nama_data'] = $this->permintaan->getAll();
        return view('permintaan/home', $data);
    }
    public function new()
    {
        $id = session('id_unit');
        $data['unit'] = $this->units->findAll();
        $data['pfi'] = $this->permintaan->selectMax('no_pfi')->where('id_unit', session('id_unit'))->get()->getRowArray();
        $data['user'] = $this->user->where('id_unit', session('id_unit'))->findAll();
        return view('permintaan/new', $data);
        // print_r($data['user']['id_user']);
    }
    public function prosesAdd()
    {
        $validate = $this->validate([
            'id_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Unit Dipilih salah satu.',
                ],
            ],
            'tanggal_pfi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Tanggal Untuk diisi.',
                ],
            ],
            'no_pfi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon No Permohonan Fasilitas ICT Untuk diisi.',
                ],
            ],
            'prioritas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Prioritas Untuk Diisi.',
                ],
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Type Untuk Diisi.',
                ],
            ],
            'pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Pengguna Untuk Diisi.',
                ],
            ],
            'dept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Dept Untuk Diisi.',
                ],
            ],
            'alasan_kebutuhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Alasan Kebutuhan Untuk Diisi.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $data['unit'] = $this->units->findAll();
            return view('permintaan/new', $data);
        }
        $data = [
            'nama_head' => 'Ferdian Yusman',
        ];
        $data = $this->request->getPost();
        $this->permintaan->insert($data);
        session()->remove('temp_data');
        return redirect()->to(site_url('permintaan'))->with('success', 'Data telah ditambahkan');
    }
    public function edit($id = null)
    {
        $permintaan = $this->permintaan->find($id);
        if (is_object($permintaan)) {
            $data['nama_data'] = $permintaan;
            $data['unit'] = $this->units->findAll();
            return view('permintaan/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function update($id = null)
    {
        $validate = $this->validate([
            'id_unit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Unit Dipilih salah satu.',
                ],
            ],
            'tanggal_pfi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Tanggal Untuk diisi.',
                ],
            ],
            'no_pfi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon No Permohonan Fasilitas ICT Untuk diisi.',
                ],
            ],
            'prioritas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Prioritas Untuk Diisi.',
                ],
            ],
            'type' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Type Untuk Diisi.',
                ],
            ],
            'pengguna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Pengguna Untuk Diisi.',
                ],
            ],
            'dept' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Dept Untuk Diisi.',
                ],
            ],
            'alasan_kebutuhan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Alasan Kebutuhan Untuk Diisi.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $data['unit'] = $this->units->findAll();
            $data['nama_data'] = $this->permintaan->getAll();
            return view('permintaan/edit', $data);
        }

        $data = $this->request->getPost();
        $this->permintaan->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('permintaan'))->with('success', 'Data telah diupdate');
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
        $this->barang->where(['id_pfi' => $id])->delete();
        $this->permintaan->where(['id_pfi' => $id])->delete();
        return redirect()->to(site_url('permintaan'))->with('delete', 'Data Berhasil Dihapus');
    }
    public function setujui($id = null)
    {
        $data = [
            'progres' => $this->request->getPost('progres'),
            'catatan' => $this->request->getPost('catatan'),
        ];
        // $this->permintaan->update($id, $data);
        // $data = $this->request->getPost();
        $this->permintaan->update($id, $data);
        return redirect()->to(site_url('permintaan'))->with('success', 'Data Berhasil Diupdate');
        // print_r($data);
    }

    public function exportPdf($id = null)
    {
        $permintaan = $this->permintaan->find($id);
        if (is_object($permintaan)) {
            $data['nama_data'] = $permintaan;

            foreach ($data as $data_p) {
                // Memanggil gambar
                $gambarPath = FCPATH . 'template\assets\img\EAS.jpg'; // Ganti dengan path ke gambar header Anda
                $this->pdf->Image($gambarPath, 10, 9, 30);
                $this->pdf->cell(30, 20, '', 1, 0, 'C');
                $this->pdf->SetFont('Arial', 'B', 12);
                $this->pdf->cell(160, 20, 'PERMOHONAN FASILITAS ICT', 1, 0, 'C');
                $this->pdf->SetFont('Arial', '', 5);
                $this->pdf->SetXY(20, 10);
                $this->pdf->cell(179, 5, $data['nama_data']->no_pfi, 0, 0, 'R');
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

                $tanggal = tanggal_indonesia($data_p->tanggal_pfi);
                $this->pdf->SetFont('Arial', '', 9);
                $this->pdf->SetXY(40, 33);
                $this->pdf->cell(5, 5, $data_p->id_unit, 0, 0, 'L', 0);

                $this->pdf->SetXY(40, 39);

                $this->pdf->cell(5, 5, $tanggal, 0, 0, 'L', 0);

                $this->pdf->SetXY(40, 45);
                $this->pdf->cell(5, 5, $data_p->pengguna, 0, 0, 'L', 0);

                $this->pdf->SetXY(40, 51);
                $this->pdf->cell(5, 5, $data_p->dept, 0, 0, 'L', 0);

                $this->pdf->SetXY(100, 33);
                $this->pdf->cell(5, 5, 'URGENT     :', 0, 0, 'L', 0);

                $this->pdf->SetXY(125, 34);
                if ($data_p->prioritas == 0) {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);
                } else {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);
                }

                $this->pdf->SetXY(100, 44);
                $this->pdf->cell(5, 5, 'NORMAL     :', 0, 0, 'L', 0);

                $this->pdf->SetXY(125, 45);
                if ($data_p->prioritas == 1) {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);
                } else {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);
                }

                $this->pdf->SetXY(160, 33);
                $this->pdf->cell(5, 5, 'HARDWARE     :', 0, 0, 'L', 0);
                $this->pdf->SetXY(190, 33);
                if ($data_p->type == 1) {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);
                } else {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);
                }
                $this->pdf->SetXY(160, 44);
                $this->pdf->cell(5, 5, 'SOFTWARE     :', 0, 0, 'L', 0);
                $this->pdf->SetXY(190, 45);
                if ($data_p->type == 0) {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);
                } else {
                    $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);
                }

                $this->pdf->SetFont('Arial', 'B', 10);
                $this->pdf->SetXY(18, 58);
                $this->pdf->cell(5, 5, 'Detail Fasilitas ICT', 0, 0, 'L', 0);

                // $this->pdf->SetXY(13, 65);
                $this->pdf->ln(5);
                $this->pdf->cell(10, 7, 'No.', 1, 0, 'C', 0);
                $this->pdf->cell(60, 7, 'Nama Barang', 1, 0, 'C', 0);
                $this->pdf->cell(18, 7, 'Merk/Tipe', 1, 0, 'C', 0);
                $this->pdf->cell(17, 7, 'Jumlah', 1, 0, 'C', 0);
                $this->pdf->cell(20, 7, 'Harga', 1, 0, 'C', 0);
                $this->pdf->cell(20, 7, 'Total', 1, 0, 'C', 0);
                $this->pdf->cell(40, 7, 'Keterangan', 1, 0, 'C', 0);
                $this->pdf->ln(7);

                // $barang = $this->barang->getAll();
                // foreach ($barang as $data_b) {

                //     // $string = $this->GetMultiCellHeight(11, 'PC Corei3-Gen11 (3.0 Ghz Up To 4.8 Ghz Cache 12MB) | RAM 8 GB | SSD 512 GB | VGA SHARED | LAYAR 19,5" | Garansi > 2 Thn');
                //     $str = $this->GetMultiCellHeight(11, $data_b->keterangan);
                //     $string = $str + 3;

                //     $this->pdf->SetFont('Arial', '', 8);
                //     $this->pdf->cell(10, $string, '', 1, 0, 'L');
                //     $this->pdf->cell(60, $string, '', 1, 0, 'L');
                //     $this->pdf->ln();
                // }
                $this->pdf->SetFont('Arial', '', 8);
            }

            $no = 1;
            $barang = $this->barang->getAll();

            foreach ($barang as $hasil) {
                $cellWidth = 60; //lebar sel
                $cellHeight = 5; //tinggi sel satu baris normal

                //periksa apakah teksnya melibihi kolom?
                if ($this->pdf->GetStringWidth($hasil->nama_barang) < $cellWidth) {
                    //jika tidak, maka tidak melakukan apa-apa
                    $line = 1;
                } else {
                    //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                    //dengan memisahkan teks agar sesuai dengan lebar sel
                    //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                    $textLength = strlen($hasil->nama_barang);    //total panjang teks
                    $errMargin = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                    $startChar = 0;        //posisi awal karakter untuk setiap baris
                    $maxChar = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                    $textArray = array();    //untuk menampung data untuk setiap baris
                    $tmpString = "";        //untuk menampung teks untuk setiap baris (sementara)

                    while ($startChar < $textLength) { //perulangan sampai akhir teks
                        //perulangan sampai karakter maksimum tercapai
                        while (
                            $this->pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
                            ($startChar + $maxChar) < $textLength
                        ) {
                            $maxChar++;
                            $tmpString = substr($hasil->nama_barang, $startChar, $maxChar);
                        }
                        //pindahkan ke baris berikutnya
                        $startChar = $startChar + $maxChar;
                        //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                        array_push($textArray, $tmpString);
                        //reset variabel penampung
                        $maxChar = 0;
                        $tmpString = '';
                    }
                    //dapatkan jumlah baris
                    $line = count($textArray);
                }

                //tulis selnya
                $this->pdf->SetFillColor(255, 255, 255);
                $this->pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', true); //sesuaikan ketinggian dengan jumlah garis
                //$this->pdf->Cell(30, ($line * $cellHeight), $hasil->nama_barang, 1, 0); //sesuaikan ketinggian dengan jumlah garis
                //$this->pdf->MultiCell($cellWidth, $cellHeight, $hasil->keterangan, 1);
                //memanfaatkan MultiCell sebagai ganti Cell
                //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
                //ingat posisi x dan y sebelum menulis MultiCell
                $xPos = $this->pdf->GetX();
                $yPos = $this->pdf->GetY();
                $this->pdf->MultiCell($cellWidth, $cellHeight, $hasil->nama_barang, 1);

                $this->pdf->SetXY($xPos + $cellWidth, $yPos);
                $this->pdf->Cell(18, ($line * $cellHeight), $hasil->merk_tipe, 1, 0, 'C');

                $this->pdf->Cell(17, ($line * $cellHeight), $hasil->jumlah_barang . ' ' . $hasil->satuan, 1, 0, 'C');
                $rp = rupiah($hasil->harga_barang);
                $this->pdf->Cell(20, ($line * $cellHeight), $rp, 1, 0, 'C');
                $this->pdf->Cell(20, ($line * $cellHeight), $rp, 1, 0, 'C');
                $this->pdf->MultiCell(40, $cellHeight, $hasil->keterangan, 1);

                //kembalikan posisi untuk sel berikutnya di samping MultiCell 
                //dan offset x dengan lebar MultiCell
                // $this->pdf->SetXY($xPos + $cellWidth, $yPos);

                // $this->pdf->Cell(30, ($line * $cellHeight), $hasil->merk_tipe, 1, 1); //sesuaikan ketinggian dengan jumlah garis
                // $this->pdf->Cell(60, ($line * $cellHeight), $hasil->nama_barang, 1, 1);
            }
            //Geser posisi ke 1,5 cm dari bawah
            $this->pdf->SetY(-15);
            //Pilih font Arial italic 8
            $this->pdf->SetFont('Arial', 'I', 8);
            //Tampilkan nomor halaman rata tengah
            $this->pdf->Cell(0, 10, 'Page ' . $this->pdf->PageNo(), 0, 0, 'C');
            // Output the PDF
            $pdfContent = $this->pdf->Output('', 'S'); // 'S' mengembalikan konten sebagai string

            // Mengatur header HTTP untuk menampilkan PDF di browser
            return $this->response
                ->setStatusCode(200)
                ->setContentType('application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="laporan.pdf"')
                ->setBody($pdfContent);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function ttd_stf($id = null)
    {
        $data = [
            'progres' => 1,
        ];
        $this->permintaan->update($id, $data);
        return redirect()->to(site_url('permintaan'))->with('success', 'Permohonan Fasilitas Berhasil Di TTD');
    }
    public function ttd_fat($id = null)
    {
        $data = [
            'progres' => 2,
        ];
        $this->permintaan->update($id, $data);
        return redirect()->to(site_url('permintaan'))->with('success', 'Permohonan Fasilitas Berhasil Di TTD');
    }
    public function ttd_gm($id = null)
    {
        $data = [
            'progres' => 3,
        ];
        $this->permintaan->update($id, $data);
        return redirect()->to(site_url('permintaan'))->with('success', 'Permohonan Fasilitas Berhasil Di TTD');
    }
    public function head_it($id = null)
    {
        $data = [
            'progres' => 4,
        ];
        $this->permintaan->update($id, $data);
        return redirect()->to(site_url('permintaan'))->with('success', 'Permohonan Fasilitas Berhasil Di TTD');
    }
}
