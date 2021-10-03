<?php
include 'admin/db.php';
include 'admin/constant.php';

// handle session cart
session_start();
if(!isset($_SESSION['CUST_ID'])){
    header('Location: index.php?auth');
    die();
}

if(isset($_GET['del']) && !empty($_GET['del'])){
    $id = $_GET['del'];
    // delete keranjang 
    delete('keranjang',"id = $id");
    header("Location:cart.php");
}

$total = 0;
$id  = $_SESSION['CUST_ID'];
$dataKeranjang = select(' keranjang a JOIN tiket b ON a.tiket_id = b.id JOIN film c ON b.film_id = c.id JOIN kursi d ON b.kursi_id = d.id', 'a.id, b.atas_nama, b.nomor_hp, c.nama as film, CONCAT(d.abjad,d.nomor_kursi) as kursi, d.kelas_studio as kelas,thumbnail,harga', "user_id = '$id' and ISNULL(transaksi_id) and is_cart = 1");

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container mt-4">
        <h2>Keranjang Anda</h2>
        <div class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Film</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor Hp</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Kursi</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataKeranjang as $keranjang) {
                        $total += $keranjang['harga']
                    ?>
                        <tr>
                            <td style="width:10%">
                                <img src="admin/assets/thumbnails/<?= $keranjang['thumbnail'] ?>" alt="Avatar" width="50%">
                            </td>
                            <td class="align-middle" style="width: 20%;"><?= $keranjang['film'] ?></td>
                            <td class="align-middle"><?= $keranjang['atas_nama'] ?></td>
                            <td class="align-middle"><?= $keranjang['nomor_hp'] ?></td>
                            <td class="align-middle"><?= getKelasById($keranjang['kelas']) ?></td>
                            <td class="align-middle"><?= $keranjang['kursi'] ?></td>
                            <td class="align-middle"><?= number_format($keranjang['harga']) ?></td>
                            <td class="align-middle">
                                <a href="cart.php?del=<?= $keranjang['id'] ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if ($total > 0) { ?>
            <div class="mt-4">
                <h2>Summary</h2>
                <div class="row">
                    <div class="col-4">
                        <form action="cart_s.php" method="post">
                            <div class="mb-3">
                                <label class="form-label">Total Keranjang</label>
                                <input type="text" value="<?= number_format($total) ?>" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Metode Bayar</label>
                                <select name="method_bayar" id="" class="form-control">
                                    <option value="" selected disabled>Pilih Metode Bayar</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Debit</option>
                                </select>
                            </div>
                            <button type="submit" name="checkout" class="btn btn-success">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>