<?php
include 'admin/db.php';
include 'admin/constant.php';
session_start();

if (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'getAbjad':
            getAbjad();
            break;
        case 'getKelas':
            getKelas();
            break;
        case 'getNomor':
            getNomor();
            break;
        case 'checkEmail':
            checkEmail();
            break;
        case 'getDetailTransaksi':
            getDetailTransaksi();
            break;
    }
}

function getAbjad()
{
    $nomor = $_GET['nomor'];
    $res = [];
    foreach (select('kursi', 'abjad', "tersedia = 1 and nomor_kursi = '$nomor' group by abjad") as $abjad) {
        $res[] = $abjad;
    }

    echo json_encode($res);
}

function getKelas()
{
    $nomor = $_GET['nomor'];
    $abjad = $_GET['abjad'];
    $res = [];
    foreach (select('kursi', 'kelas_studio as kelas', "tersedia = 1 and nomor_kursi = '$nomor' and abjad = '$abjad' group by kelas_studio") as $abjad) {
        $abjad['alias'] = getKelasById($abjad['kelas']);
        $res[] = $abjad;
    }

    echo json_encode($res);
}

function getNomor()
{
    $kelas = $_GET['kelas'];
    $res = [];
    foreach (select('kursi', 'nomor_kursi as nomor', "tersedia = 1 and kelas_studio = '$kelas' group by nomor_kursi") as $abjad) {
        // $abjad['alias'] = getKelasById($abjad['kelas']);
        $res[] = $abjad;
    }

    echo json_encode($res);
}

function checkEmail()
{
    $param = $_GET['param'];
    $flag = true;
    foreach (select('user', '*', "email like '%$param%'") as $user) {
        $flag = false;
    }

    echo json_encode([
        'success' => $flag
    ]);
}

function getDetailTransaksi()
{
    $res = [];
    $id = $_GET['param'];
    foreach (select('tiket b JOIN film c ON b.film_id = c.id JOIN kursi d ON b.kursi_id = d.id', 'b.atas_nama, b.nomor_hp, c.nama AS film, CONCAT( d.abjad, d.nomor_kursi ) AS kursi, d.kelas_studio AS kelas, thumbnail, harga', "b.transaksi_id = $id") as $detail) {
        $detail['kelas'] = getKelasById($detail['kelas']);
        $detail['harga'] = number_format($detail['harga']);
        $res[] = $detail;
    }

    echo json_encode($res);
}
