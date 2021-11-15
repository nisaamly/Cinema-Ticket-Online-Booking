<?php

include 'db.php';
include 'constant.php';
session_start();

if (!isset($_SESSION['_uid_'])) {
    header('Location: login.php');
    die();
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
<!-- 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet"/> -->
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet"/>
    <script src="jquery.simple-dtpicker.js"></script>
    <link type="text/css" href="assets/jquery.simple-dtpicker.css" rel="stylesheet" />
    <title>Sistem Informasi Book Tiket</title>
    <style>
        .center-flex {
            flex-direction: column;
            align-items: center;
        }

        .btn-filter {
            position: absolute;
            bottom: 15px;
            width: 85%;
        }
    </style>
</head>

<body>
    <!-- <h1>Hello, world!</h1> -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <div class="mx-auto order-0">
                <a class="navbar-brand mx-auto" href="index.php">SI Online Book</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php if (isset($_GET['r']) && $_GET['r'] == 'transaksi') echo 'active' ?>">
                        <a class="nav-link" href="index.php?r=transaksi">Transaksi</a>
                    </li>
                    <li class="nav-item <?php if (isset($_GET['r']) && $_GET['r'] == 'film') echo 'active' ?>">
                        <a class="nav-link" href="index.php?r=film"> Film</a>
                    </li>
                    <li class="nav-item <?php if (isset($_GET['r']) && $_GET['r'] == 'genre') echo 'active' ?>">
                        <a class="nav-link" href="index.php?r=genre"> Genre</a>
                    </li>
                    <li class="nav-item <?php if (isset($_GET['r']) && $_GET['r'] == 'jadwal') echo 'active' ?>">
                        <a class="nav-link" href="index.php?r=jadwal"> Jadwal Tayang</a>
                    </li>
                    <li class="nav-item <?php if (isset($_GET['r']) && $_GET['r'] == 'kursi') echo 'active' ?>">
                        <a class="nav-link" href="index.php?r=kursi"> Kursi</a>
                    </li>
                    <li class="nav-item <?php if (isset($_GET['r']) && $_GET['r'] == 'user') echo 'active' ?>">
                        <a class="nav-link" href="index.php?r=user"> User</a>
                    </li>
                    <?php if (isset($_SESSION['_name_'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php" id="userLogin">Logout ( <?= strtoupper($_SESSION['_name_']) ?> )</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_GET['r']) && !empty($_GET['r'])) {
        include 'route.php';
    } else { ?>
        <div class="jumbotron d-flex center-flex">
            <h1 class="display-4">Selamat Datang!</h1>
            <p class="lead">Sistem Informasi Booking Film PHP MySQL Bootstrap</p>
            <hr class="my-4">
            <p>Pilih menu untuk melihat fitur yang tersedia</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="index.php?r=film" role="button">Film</a>
                <a class="btn btn-primary btn-lg" href="index.php?r=genre" role="button">Genre</a>
                <a class="btn btn-primary btn-lg" href="index.php?r=kursi" role="button">Kursi</a>
                <a class="btn btn-primary btn-lg" href="index.php?r=user" role="button">User</a>
            </p>
        </div>
    <?php } ?>
</body>

<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"
></script>

<script src="assets/jquery.simple-dtpicker.js"></script>



</html>