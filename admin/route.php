<?php

switch ($_GET['r']) {
    case 'transaksi':
        $file = 'transaksi/index.php';
        break;
    case 'user':
        $file = 'user/index.php';
        break;
    case 'laporan':
        $file = 'laporan/index.php';
        break;
    case 'film':
        $file = 'film/index.php';
        break;
    case 'genre':
        $file = 'genre/index.php';
        break;
    case 'kursi':
        $file = 'kursi/index.php';
        break;

    case 'transaksi_form':
        $file = 'transaksi/form.php';
        break;
    case 'user_form':
        $file = 'user/form.php';
        break;
    case 'film_form':
        $file = 'film/form.php';
        break;
    case 'genre_form':
        $file = 'genre/form.php';
        break;
    case 'kursi_form':
        $file = 'kursi/form.php';
        break;
}

if (file_exists($file)) {
    include $file;
} else {
    echo "<script>window.location = 'index.php'</script>";
}
