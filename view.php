<?php
include 'admin/db.php';

session_start();
if (!isset($_GET['id'])) {
    header('Location: index.php');
    die();
}

$isAuth = isset($_SESSION['CUST_ID']) ? '1' : '0';

$id = $_GET['id'];
$findData = select('film a join genre b on a.genre_id = b.id', 'a.*,b.nama as genre', "a.id = $id");
foreach ($findData as $film) {
}

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
        <input type="hidden" value="<?= $isAuth ?>" id="checkAuth">
        <input type="hidden" value="<?= $_GET['id'] ?>" id="id">
        <div class="row">
            <div class="col-4">
                <img src="admin/assets/thumbnails/<?= $film['thumbnail'] ?>" alt="Avatar" width="90%">
            </div>
            <div class="col-8">
                <h1><?= $film['nama']  ?></h1>
                <div class="row mt-4">
                    <div class="col-2">
                        <h5>Genre </h5>
                        <h5>Tanggal </h5>
                        <h5>Deskripsi </h5>
                    </div>
                    <div class="col">
                        <h5><?= $film['genre'] ?></h5>
                        <h5><?= date('d F Y H:i', strtotime($film['tgl_tayang'])) ?></h5>
                        <h5><?= $film['description'] ?></h5>
                    </div>
                </div>
                <button onclick="pesanFilm()" class="btn btn-success">
                    Pesan Ticket
                </button>
            </div>
        </div>
    </div>

    <script>
        function pesanFilm(el) {
            const id = $('#id').val()
            if ($('#checkAuth').val() == 1) {
                location.href = 'pesan.php?id=' + id
            } else {
                $('#modalSignin').modal('show')
            }
        }
    </script>

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