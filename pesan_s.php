<?php

include 'admin/db.php';
session_start();

if (!isset($_POST['submit'])) {
    header('Location: index.php');
    die();
}

$data = $_POST;
$film = $data['film'];

$nomor = $data['nomor'];
$abjad = $data['abjad'];
$kelas = $data['kelas'];
$jadwal = $data['jadwal'];

$nama = $data['nama'];
$hp = $data['hp'];

// find kursi 
$findKursi = select('kursi', '*', "nomor_kursi = '$nomor'and abjad = '$abjad' and kelas_studio = '$kelas' and tersedia = 1");
foreach ($findKursi as $kursi) {
}

// change kursi last_chart
update('kursi', ['last_chart' => date('Y-m-d H:i:s')], "id = '$kursi[id]'");

// add tiket
$arrTiket = [
    'atas_nama' => $nama,
    'nomor_hp' => $hp,
    'film_id' => $film,
    'kursi_id' => $kursi['id'],
    'is_cart' => 1
];
$addTiket = insert('tiket', $arrTiket);


// add keranjang
$arrKeranjang = [
    'user_id' => $_SESSION['CUST_ID'],
    'tiket_id' => $addTiket
];
$addKeranjang = insert('keranjang', $arrKeranjang);

header('Location: cart.php');
