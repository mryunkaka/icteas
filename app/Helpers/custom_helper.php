<?php
function userLogin()
{
    $db = \Config\Database::connect();
    return $db->table('users')->where('id_user', session('id_user'))->get()->getRow();
}

function countData($table)
{
    $db = \Config\Database::connect();
    return $db->table($table)->countAllResults();
}

function rupiah($angka)
{
    $result = "Rp " . number_format($angka, 0, ',', '.');
    return $result;
}

function tanggal_indonesia($tanggal)
{
    // Daftar nama bulan dalam bahasa Indonesia
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // Memecah tanggal menjadi bagian-bagian (hari, bulan, tahun)
    $pecah_tanggal = explode('-', $tanggal);
    $tahun = $pecah_tanggal[0];
    $bulan_num = (int)$pecah_tanggal[1];
    $bulan_teks = $bulan[$bulan_num];
    $hari = (int)$pecah_tanggal[2];

    // Format tanggal Indonesia
    $tanggal_indonesia = $hari . ' ' . $bulan_teks . ' ' . $tahun;

    return $tanggal_indonesia;
}
function getRandomName($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomName = '';

    for ($i = 0; $i < $length; $i++) {
        $randomName .= '' . $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomName;
}
