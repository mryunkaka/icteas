<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\PermintaanModel;
use App\Models\UnitModel;
use App\Models\UserModel;
use FPDF;

class Barang extends BaseController
{
    protected $helpers = ['custom'];
    protected $pdf;
    protected $barang;
    protected $permintaan;
    protected $unit;
    protected $user;
    function __construct()
    {
        $this->barang = new BarangModel();
        $this->permintaan = new PermintaanModel();
        $this->unit = new UnitModel();
        $this->user = new UserModel();
        $this->pdf = new FPDF();
        $this->pdf->AddPage();
        $this->pdf->SetFont('Arial', 'B', 16);
        $this->pdf->SetAutoPageBreak(true, 10);
    }
    public function home($id = null)
    {
        $data['nama_data'] = $this->barang->get_id($id);
        $data['id'] = $id;
        $data['pfi'] = $this->permintaan->where(['id_pfi' => $id])->get()->getRow();
        return view('barang/home', $data);
    }
    public function add($id = null)
    {
        $data['nama_data'] = $this->barang->get_id($id);
        $data['id'] = $id;
        return view('barang/new', $data, ['enctype' => 'multipart/form-data']);
    }
    public function prosesAdds($id = null)
    {
        $data = $this->request->getPost('harga_barang');
        print_r($data);
    }
    public function prosesAdd($id = null)
    {
        $validate = $this->validate([
            'nama_barang' => [
                'rules' => 'required|max_length[43]',
                'errors' => [
                    'required' => 'Mohon nama barang diisi dengan lengkap.',
                    'max_length' => 'Mohon isi Max 43 Karakter.',
                ],
            ],
            'merk_tipe' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => 'Mohon Merk/Type diisi dengan lengkap.',
                    'max_length' => 'Mohon isi Max 15 Karakter.',
                ],
            ],
            'jumlah_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon No Jumlah Barang Diisi.',
                ],
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Satuan Untuk Diisi.',
                ],
            ],
            'harga_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Harga Barang Untuk Diisi.',
                ],
            ],
            'keterangan' => [
                'rules' => 'required|max_length[43]',
                'errors' => [
                    'required' => 'Mohon Keterangan Untuk Diisi.',
                    'max_length' => 'Mohon isi Max 29 Karakter.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $data['nama_data'] = $this->barang->get_id($id);
            $data['id'] = $id;
            return view('barang/new', $data);
        } else {
            if (!empty($_FILES['gambar']['name'])) {
                $file = $this->request->getFile('gambar');
                $namaFoto = $file->getRandomName();
                $file->move('uploads/barang', $namaFoto);
                $data = [
                    'id_pfi' => $this->request->getPost('id_pfi'),
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'merk_tipe' => $this->request->getPost('merk_tipe'),
                    'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                    'satuan' => $this->request->getPost('satuan'),
                    'harga_barang' => $this->request->getPost('harga_barang'),
                    'total_barang' => $this->request->getPost('jumlah_barang') * $this->request->getPost('harga_barang'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'gambar' => $namaFoto,
                ];
                $this->barang->insert($data);
                session()->remove('temp_data');
                return redirect()->to(site_url('barang/home/' . $id))->with('success', 'Data telah ditambahkan');
            } else {
                $data = [
                    'id_pfi' => $this->request->getPost('id_pfi'),
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'merk_tipe' => $this->request->getPost('merk_tipe'),
                    'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                    'satuan' => $this->request->getPost('satuan'),
                    'harga_barang' => $this->request->getPost('harga_barang'),
                    'total_barang' => $this->request->getPost('jumlah_barang') * $this->request->getPost('harga_barang'),
                    'keterangan' => $this->request->getPost('keterangan'),
                ];
                $this->barang->insert($data);
                session()->remove('temp_data');
                return redirect()->to(site_url('barang/home/' . $id))->with('success', 'Data telah ditambahkan');
            }
        }
    }
    public function edit($id = null)
    {
        $barang = $this->barang->find($id);
        if (is_object($barang)) {
            $data['id'] = $id;
            $data['barang'] = $barang;
            return view('barang/edit', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }
    public function prosesEdit($id = null)
    {
        $validate = $this->validate([
            'nama_barang' => [
                'rules' => 'required|max_length[43]',
                'errors' => [
                    'required' => 'Mohon nama barang diisi dengan lengkap.',
                    'max_length' => 'Mohon isi Max 43 Karakter.',
                ],
            ],
            'merk_tipe' => [
                'rules' => 'required|max_length[15]',
                'errors' => [
                    'required' => 'Mohon Merk/Type diisi dengan lengkap.',
                    'max_length' => 'Mohon isi Max 15 Karakter.',
                ],
            ],
            'jumlah_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon No Jumlah Barang Diisi.',
                ],
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Satuan Untuk Diisi.',
                ],
            ],
            'harga_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Mohon Harga Barang Untuk Diisi.',
                ],
            ],
            'keterangan' => [
                'rules' => 'required|max_length[29]',
                'errors' => [
                    'required' => 'Mohon Keterangan Untuk Diisi.',
                    'max_length' => 'Mohon isi Max 29 Karakter.',
                ],
            ],
        ]);

        if (!$validate) {
            $temp = $this->request->getPost();
            session()->set('temp_data', $temp);
            $data['barang'] = $this->barang->find($id);
            $data['id'] = $id;
            return view('barang/edit', $data);
            // print_r($id);
        } else {
            if (!empty($_FILES['gambar']['name'])) {
                $oldimage = $this->barang->find($id);
                $data['img'] = $oldimage;
                $gmbr = $data['img']->gambar;
                if ($gmbr != null) {
                    unlink('uploads/barang/' . $gmbr);
                }
                $file = $this->request->getFile('gambar');
                $namaFoto = $file->getRandomName();
                $file->move('uploads/barang', $namaFoto);
                $data = [
                    'id_pfi' => $this->request->getPost('id_pfi'),
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'merk_tipe' => $this->request->getPost('merk_tipe'),
                    'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                    'satuan' => $this->request->getPost('satuan'),
                    'harga_barang' => $this->request->getPost('harga_barang'),
                    'total_barang' => $this->request->getPost('jumlah_barang') * $this->request->getPost('harga_barang'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'gambar' => $namaFoto,
                ];
                $this->barang->update($id, $data);
                session()->remove('temp_data');
                return redirect()->to(site_url('barang/home/' . $this->request->getPost('id_pfi')))->with('success', 'Data telah ditambahkan');
            } else {
                $data = [
                    'id_pfi' => $this->request->getPost('id_pfi'),
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'merk_tipe' => $this->request->getPost('merk_tipe'),
                    'jumlah_barang' => $this->request->getPost('jumlah_barang'),
                    'satuan' => $this->request->getPost('satuan'),
                    'harga_barang' => $this->request->getPost('harga_barang'),
                    'total_barang' => $this->request->getPost('jumlah_barang') * $this->request->getPost('harga_barang'),
                    'keterangan' => $this->request->getPost('keterangan'),
                ];
                $this->barang->update($id, $data);
                session()->remove('temp_data');
                return redirect()->to(site_url('barang/home/' . $this->request->getPost('id_pfi')))->with('success', 'Data telah ditambahkan');
            }
        }
    }
    public function delete($id = null)
    {
        $oldimage = $this->barang->find($id);
        $data['img'] = $oldimage;
        $gmbr = $data['img']->gambar;
        if ($gmbr == null) {
        } else {
            unlink('uploads/barang/' . $gmbr);
        }
        $this->barang->where(['id_barang' => $id])->delete();
        return redirect()->to(site_url('permintaan'))->with('delete', 'Data Barang Berhasil Dihapus');
    }
    public function approve($id = null)
    {
        $data = [
            'progres' => 7,
            'approve' => 1,
        ];
        $this->permintaan->update($id, $data);
        session()->remove('temp_data');
        return redirect()->to(site_url('permintaan'))->with('success', 'Data telah update, menunggu ttd staff');
    }
    public function exportPdf($id = null)
    {
        $permintaan = $this->permintaan->find($id);
        $data['nama_data'] = $permintaan;
        $units = $this->unit->where(['id_unit' => $data['nama_data']->id_unit])->get()->getRow();
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

        $tanggal = tanggal_indonesia($data['nama_data']->tanggal_pfi);
        $this->pdf->SetFont('Arial', '', 9);
        $this->pdf->SetXY(40, 33);
        $this->pdf->cell(5, 5, $units->nama_unit, 0, 0, 'L', 0);

        $this->pdf->SetXY(40, 39);

        $this->pdf->cell(5, 5, $tanggal, 0, 0, 'L', 0);

        $this->pdf->SetXY(40, 45);
        $this->pdf->cell(5, 5, $data['nama_data']->pengguna, 0, 0, 'L', 0);

        $this->pdf->SetXY(40, 51);
        $this->pdf->cell(5, 5, $data['nama_data']->dept, 0, 0, 'L', 0);

        $this->pdf->SetXY(100, 33);
        $this->pdf->cell(5, 5, 'URGENT     :', 0, 0, 'L', 0);

        $this->pdf->SetXY(125, 34);
        if ($data['nama_data']->prioritas == 0) {
            $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);
        } else {
            $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);
        }

        $this->pdf->SetXY(100, 44);
        $this->pdf->cell(5, 5, 'NORMAL     :', 0, 0, 'L', 0);

        $this->pdf->SetXY(125, 45);
        if ($data['nama_data']->prioritas == 1) {
            $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);
        } else {
            $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);
        }

        $this->pdf->SetXY(160, 33);
        $this->pdf->cell(5, 5, 'HARDWARE     :', 0, 0, 'L', 0);
        $this->pdf->SetXY(190, 33);
        if ($data['nama_data']->type == 1) {
            $this->pdf->cell(3, 3, '', 1, 0, 'L', 1);
        } else {
            $this->pdf->cell(3, 3, '', 1, 0, 'L', 0);
        }
        $this->pdf->SetXY(160, 44);
        $this->pdf->cell(5, 5, 'SOFTWARE     :', 0, 0, 'L', 0);
        $this->pdf->SetXY(190, 45);
        if ($data['nama_data']->type == 0) {
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
        $this->pdf->SetFont('Arial', '', 8);

        $no = 1;
        // $barang = $this->barang->where(['id_pfi']->$id)->get();
        $barang['data'] = $this->barang->where(['id_pfi' => $id])->findAll();
        // $barang['nama_data'] = $this->barang->where(['id_pfi' => $id])->get();
        foreach ($barang['data'] as $hasil) :
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
            $rp1 = rupiah($hasil->total_barang);
            $this->pdf->Cell(20, ($line * $cellHeight), $rp, 1, 0, 'C');
            $this->pdf->Cell(20, ($line * $cellHeight), $rp1, 1, 0, 'C');
            $this->pdf->MultiCell(40, $cellHeight, $hasil->keterangan, 1);
            $rp2[] = $hasil->total_barang;

        endforeach;
        $barang = $this->barang->selectSum('total_barang')->get()->getRowArray();
        $sum = rupiah($barang['total_barang']);
        $this->pdf->Cell(125, ($line * $cellHeight), 'TOTAL', 1, 0, 'R');
        $this->pdf->Cell(60, ($line * $cellHeight), $sum, 1, 0, 'L');
        $this->pdf->ln(10);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(185, ($line * $cellHeight), '         Alasan Kebutuhan : ', 0, 1, 'L');
        $this->pdf->ln(1);
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->MultiCell(185, $cellHeight, $data['nama_data']->alasan_kebutuhan, 1, 0, 'L');

        $this->pdf->ln(10);



        $this->pdf->Cell(46, ($line * $cellHeight), 'Dibuat Oleh', 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'Diperiksa Oleh', 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'Diketahui Oleh', 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'Disetujui Oleh', 0, 1, 'L');

        $nama = $data['nama_data']->nama_staff;
        $users = $this->user->where('name_user', $nama)->get()->getRow();
        $gambarPath = 'uploads/ttd/' . $users->ttd;

        $nama = $data['nama_data']->nama_fat;
        $users = $this->user->where('name_user', $nama)->get()->getRow();
        $gambarPath1 = 'uploads/ttd/' . $users->ttd;

        $nama = $data['nama_data']->nama_gm;
        $users = $this->user->where('name_user', $nama)->get()->getRow();
        $gambarPath2 = 'uploads/ttd/' . $users->ttd;

        $gambarPath3 = 'uploads/ttd/1699027317_f1c36b4b7f4b6cdf9fbe.png';

        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 1, 'C');
        if ($data['nama_data']->progres == 1) {
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath, $xPos, $yPos - 7, 35), 0, 0, 'C');
        } else {
        }
        if ($data['nama_data']->progres == 2) {
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath, $xPos, $yPos - 7, 35), 0, 0, 'C');
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath1, $xPos - 5, $yPos - 12, 35), 0, 0, 'C');
        } else {
        }
        if ($data['nama_data']->progres == 3) {
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath, $xPos, $yPos - 7, 35), 0, 0, 'C');
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath1, $xPos - 5, $yPos - 12, 35), 0, 0, 'C');
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath2, $xPos - 5, $yPos - 12, 35), 0, 0, 'C');
        } else {
        }
        if ($data['nama_data']->progres == 4) {
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath, $xPos, $yPos - 7, 35), 0, 0, 'C');
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath1, $xPos - 5, $yPos - 12, 35), 0, 0, 'C');
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath2, $xPos - 5, $yPos - 12, 35), 0, 0, 'C');
            $xPos = $this->pdf->GetX();
            $yPos = $this->pdf->GetY();
            $this->pdf->Cell(46, ($line * $cellHeight), $this->pdf->Image($gambarPath3, $xPos - 10, $yPos - 7, 35), 0, 1, 'C');
        } else {
            $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
            $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
            $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
            $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 1, 'C');
        }

        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 0, 'C');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 1, 'C');
        $this->pdf->SetFont('Arial', 'U', 8);
        $this->pdf->Cell(46, ($line * $cellHeight), $data['nama_data']->nama_staff, 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), $data['nama_data']->nama_fat, 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), $data['nama_data']->nama_gm, 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'Ferdian Yusman', 0, 1, 'L');
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->Cell(46, ($line * $cellHeight), 'Staff ICT', 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'Manager FAT', 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'General Manager', 0, 0, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'Div. Head ICT', 0, 1, 'L');

        $this->pdf->ln(5);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(185, ($line * $cellHeight), '         Permohonan Pembuatan PTA : ', 0, 1, 'L');
        $this->pdf->SetFont('Arial', '', 8);
        $this->pdf->MultiCell(185, $cellHeight, 'Mengingat permintaan barang tersebut diatas tidak kami anggarkan ditahun ini, maka mohon dibuatkan Permintaan Tambahan Anggaran (PTA) atas barang tersebut, dengan alasan :', 0, 'L');
        $this->pdf->Cell(185, ($line * $cellHeight), '1. Tambahan anggaran digunakan untuk :', 0, 1, 'L');
        $this->pdf->Cell(185, ($line * $cellHeight), '.........................................................................................................................................................................................................................................', 0, 1, 'L');
        $this->pdf->Cell(185, ($line * $cellHeight), '2. Anggaran tidak dicantumkan ditahun ini, karena :', 0, 1, 'L');
        $this->pdf->Cell(185, ($line * $cellHeight), '.........................................................................................................................................................................................................................................', 0, 1, 'L');
        $this->pdf->Cell(185, ($line * $cellHeight), '3. Tambahan anggaran diadakan karena :', 0, 1, 'L');
        $this->pdf->Cell(185, ($line * $cellHeight), '.........................................................................................................................................................................................................................................', 0, 1, 'L');
        $this->pdf->ln(5);
        $this->pdf->Cell(46, ($line * $cellHeight), 'Disetujui Oleh', 0, 1, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), 'Dept. Head Budget & Control', 0, 1, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 1, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 1, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), '', 0, 1, 'L');
        $this->pdf->Cell(46, ($line * $cellHeight), '(..........................................)', 0, 1, 'L');
        //Geser posisi ke 1,5 cm dari bawah
        $this->pdf->SetY(-15);
        //Pilih font Arial italic 8
        $this->pdf->SetFont('Arial', 'I', 8);
        //Tampilkan nomor halaman rata tengah
        $this->pdf->Cell(0, 5, 'Page ' . $this->pdf->PageNo(), 0, 0, 'C');
        // Output the PDF
        $pdfContent = $this->pdf->Output('', 'S'); // 'S' mengembalikan konten sebagai string

        // Mengatur header HTTP untuk menampilkan PDF di browser
        return $this->response
            ->setStatusCode(200)
            ->setContentType('application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="laporan.pdf"')
            ->setBody($pdfContent);
    }
    public function tes()
    {
        $permintaan = $this->permintaan->find(8);
        $data['nama_data'] = $permintaan;
        $nama = $data['nama_data']->nama_staff;
        $users = $this->user->where('name_user', $nama)->get()->getRow();
        // $gambarPath = 'uploads/ttd/' . $users->ttd;
        print_r($nama);
    }
}
