<?php
include 'admin/db.php';

$films = select('film', '*', 'true');

// handle session cart
session_start();

// TODO : PESAN -> LOGIN
$isAuth = isset($_SESSION['CUST_ID']) ? '1' : '0';
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
    <div class="container">
        <input type="hidden" value="<?= $isAuth ?>" id="checkAuth">
        <div class="parent">
            <?php foreach ($films as $film) { ?>
                <div class="child">
                    <div class="ctr">
                        <img src="admin/assets/thumbnails/<?= $film['thumbnail'] ?>" alt="Avatar" class="image">
                        <div class="middle">
                            <div class="text" styl><?= $film['nama'] ?></div>
                            <div>
                                <a href="view.php?id=<?= $film['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                                <button data-rowid="<?= $film['id'] ?>" onclick="pesanFilm(this)" class="btn btn-success btn-sm">Pesan</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>


    <script>
        function pesanFilm(el) {
            const id = $(el).data('rowid')
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