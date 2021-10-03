<?php
session_start();
include 'admin/db.php';

$total = 0;
$nomorTransaksi = generateNomor();
$id = $_SESSION['CUST_ID'];
$findKeranjang = select('keranjang a join tiket b on a.tiket_id = b.id join film c on b.film_id = c.id', '*', "a.user_id = '$id'");
foreach ($findKeranjang as $temp) $total += $temp['harga'];

// craete transaksi
$transaksiId = insert('transaksi', [
    'nomor_transaksi' => $nomorTransaksi,
    'total' => $total,
    'metode_bayar' => $_POST['method_bayar'],
    'user_id' => $id,
]);

// udpate tiket fill transaksi_id
foreach ($findKeranjang as $keranjang) {
    $tiketId = $keranjang['tiket_id'];
    // update tiket 
    update('tiket', ['is_cart' => 0, 'transaksi_id' => $transaksiId], "id = '$tiketId'");
    // find tiket and update kursi 
    foreach (select('tiket', "*", "id = $tiketId") as $tiket) {
        $kursiId = $tiket['kursi_id'];
        update('kursi',['last_cart' => date('Y-m-d H:i:s')],"id = $kursiId");
    }
}

header('Location: history.php');
