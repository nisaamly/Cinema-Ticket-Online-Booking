<?php
include 'admin/db.php';
session_start();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    die();
}

if(!isset($_SESSION['CUST_ID'])){
    header('Location: index.php?auth');
    die();
}

// var_dump($result);

$id = $_GET['id'];
$jadwal = select('jadwal', '*', 'id_film = ' . $id . '');
// var_dump($result);
if($jadwal == false){
    header('Location: error-notfound.php');
    die();
}
// if($jadwal != false){
//     foreach($jadwal as $schedule){
//     }
// }
$findData = select('film a join genre b on a.genre_id = b.id', 'a.*,b.nama as genre', "a.id = $id");
if($findData == false){
    header('Location: error-notfound.php');
    die();
}

if($findData != false){
    foreach ($findData as $film);

    if (count($film) < 1) {
        header('Location: error-notfound.php');
        die();
    }
}

$dataNomor = select('film f INNER JOIN jadwal j ON j.id_film = f.id INNER JOIN kursi k ON k.id_jadwal = j.id', 'k.nomor_kursi, k.abjad, k.kelas_studio, k.id', 'k.tersedia = 1 AND (TIMESTAMPDIFF(MINUTE, k.last_cart, NOW()) > 30 or ISNULL(k.last_cart)) GROUP BY k.kelas_studio');

$userId = $_SESSION['CUST_ID'];
$findUser = select('user', "*", "id = $userId");
foreach ($findUser as $user);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Pesan Tiket</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php' ?>
    <div class="container mt-4">
        <form action="pesan_s.php" method="post">
            <input type="hidden" name="film" value="<?= $id ?>">
            <div class="row">
                <div class="col">
                    <h3>Tiket</h3>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $user['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Hp</label>
                        <input type="number" class="form-control" name="hp" value="<?= $user['nomor_hp'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Film</label>
                        <input type="text" class="form-control" value="<?= $film['nama'] ?>" readonly>
                    </div>
                </div>
                <div class="col">
                    <h3>Kursi</h3>
                    <div class="mb-3">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control">
                            <option selected disabled>Pilih Kelas Studio</option>
                            <?php foreach ($dataNomor as $nomor) { ?>
                                <option value="<?= $nomor['kelas_studio'] ?>"><?= $nomor['kelas_studio'] == 1 ? 'Standar' : ($nomor['kelas_studio'] == 2 ? 'Premium' : 'Max Movie') ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor</label>
                        <select name="nomor" id="nomor" class="form-control"></select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Abjad</label>
                        <select name="abjad" id="abjad" class="form-control"></select>
                    </div>
                </div>
                <div class="col">
                    <h3>Jadwal</h3>
                    <div class="mb-3">
                        <label class="form-label">Waktu Tayang</label>
                        <select name="jadwal" id="jadwal" class="form-control">
                            <option selected disabled>Pilih Jadwal</option>
                            <?php foreach ($jadwal as $schedule) { ?>
                                <option value="<?= $schedule['id'] ?>"><?= date('d F Y', strtotime($schedule['waktu_mulai'])) ?> pukul <?= date('H:i', strtotime($schedule['waktu_mulai'])) ?> WIB s.d <?= date('H:i', strtotime($schedule['waktu_selesai'])) ?> WIB</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Checkout</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</body>

<script>
    $('#kelas').change(async function() {
        // reset('kelas')

        let el = '<option selected disabled>Pilih Nomor</option>';
        const req = await fetch('api.php?type=getNomor&kelas=' + $(this).val())
        const res = await req.json()
        console.log(res);

        if (res.length == 0) {
            $('#nomor').html('<option selected disabled>Tidak Ada Nomor Kursi Tersedia</option>')
            return
        }

        res.map(item => {
            el += `<option value='${item['nomor']}'>${item['nomor']}</option>`
        })
        $('#nomor').html(el)
    });
    $('#nomor').change(async function() {
        // reset('nomor')

        let el = '<option selected disabled>Pilih Abjad</option>';
        const req = await fetch('api.php?type=getAbjad&nomor=' + $(this).val())
        const res = await req.json()

        if (res.length == 0) {
            $('#abjad').html('<option selected disabled>Tidak Ada Abjad Tersedia</option>')
            return
        }

        res.map(item => {
            el += `<option value='${item.abjad}'>${item.abjad}</option>`
        })
        $('#abjad').html(el)
    });

    // $('#abjad').change(async function() {
    //     let el = '<option selected disabled>Pilih Kelas</option>';
    //     const req = await fetch(`api.php?type=getKelas&abjad=${$(this).val()}&nomor=${$('#nomor').val()}`)
    //     const res = await req.json()

    //     if (res.length == 0) {
    //         $('#kelas').html('<option selected disabled>Tidak Ada Kelas Tersedia</option>')
    //         return
    //     }

    //     res.map(item => {
    //         el += `<option value='${item.kelas}'>${item.alias}</option>`
    //     })
    //     $('#kelas').html(el)
    // });


    function reset(type) {
        // to reset

        if (type == 'nomor') {
            $('#abjad').html('<option selected disabled>Tidak Ada Abjad Tersedia</option>')
            $('#kelas').html('<option selected disabled>Pilih Kelas</option>')
        }

        if (type == 'abjad') {
            $('#kelas').html('<option selected disabled>Pilih Kelas</option>')
        }
    }
</script>

</html>