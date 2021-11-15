<?php
include 'admin/db.php';

$films = array();
$data = select('film a join jadwal b on b.id_film = a.id', 'a.*, MIN(b.waktu_mulai) AS waktu_mulai', 'true');
$parsedData = array();
if($data != false){
    foreach ($data as $datas) {
        array_push($parsedData, $datas);
    }
    $itemLength = count($parsedData);
    for ($i=0; $itemLength < 3 ? $i <= $itemLength-1 : $i<=2; $i++) { 
        array_push($films, $parsedData[$i]);
    }
}

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

    <title>Cinema Ticket Online Booking</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <section class="hero-container">
        <div>
            <div>
                <h1>Let's Watch Your Movies
                </h1>
                <p>why must order ticket online?</p>
            </div>
        </div>
        <img src="https://jatenglive.com/images/news/Perbedaan--Cinema-21-XXI--The-Premiere---IMAX-dan-CGV-news20180326-3005.jpeg" alt="hero">
    </section>
    <section class="description-container">
        <div>
            <div>
                <h2>Anda dapat memesan tiket kapanpun dan dimana saja</h2>
                <p>Cinema Ticket Online Booking adalah situs pemesanan tiket bioskop secara online tanpa perlu mengantri sehingga dapat menghemat waktu.</p>
            </div>
            <div class="description-left-footer">
                <p>Oktober 2021</p>
                <p class="font-weight-bold">Read more</p>
            </div>
        </div>
        <img src="admin/assets/book.jpg" alt="desc">
    </section>
    <section class="content-container">
    <input type="hidden" value="<?= $isAuth ?>" id="checkAuth">
        <?php foreach ($films as $film) { ?>
        <div class="card" data-rowid="<?= $film['id'] ?>" onclick="pesanFilm(this)">
            <img src="admin/assets/thumbnails/<?= $film['thumbnail'] ?>" alt="card1">
            <div class="card-body">
                <h3><?= $film['nama'] ?></h3>
                <p><?= substr($film['description'], 0, 200) ?>....</p>
            </div>
            <div class="card-footer">
                <p><?= date('d F Y', strtotime($film['waktu_mulai'])) ?> Pukul <?= date('H:i', strtotime($film['waktu_mulai'])) ?></p>
                <a href="view.php?id=<?= $film['id'] ?>" class="font-weigth-bold">Read more</a>
            </div>
        </div>
        <?php } ?>
    </section>
    <section class="what-is-container">
        <div>
            <div>
                <h1>COOMING SOON</h1>
                <h2>VENOM : LET THERE BE CARNAGE</h2>
                <p>Eddie (Tom Hardy) yang kini sudah berteman dengan Venom berusaha hidup normal, namun masalah datang saat ia bertemu dengan Cletus Kasady (Woody Harrelson) yang diketahui sebagai inang dari symbiote dengan sebutan Carnage...</p>
            </div>
            <div class="footer">
                <p>17 November 2021</p>
                <p class="font-weight-bold">Read more</p>
            </div>
        </div>
        <img src="admin/assets/venom.png" alt="what-is">
    </section>
    <section class="button-container">
        <button class="btn">See More Now</button>
    </section>
    <footer>
        <p><b>Cinema Ticket Online Booking</b> 2021 copyright all rights reserved</p>
    </footer>
    <!-- <div class="container">
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
    </div> -->


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