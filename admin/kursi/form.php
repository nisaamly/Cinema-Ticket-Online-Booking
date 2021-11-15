<?php

// init
$nomor = '';
$abjad = '';
$kelas = '';
$jadwal = '';
$tersedia = '';


if (isset($_GET['id'])) {
    foreach (select("kursi k INNER JOIN jadwal j ON k.id_jadwal = j.id INNER JOIN film f ON j.id_film = f.id", "k.nomor_kursi AS nomor_kursi, k.abjad AS abjad, k.kelas_studio AS kelas_studio, k.tersedia AS tersedia, CONCAT('Waktu tayang ', j.waktu_mulai,' | Film ', f.nama, ' | Durasi ', TIMESTAMPDIFF(HOUR, j.waktu_mulai, j.waktu_selesai), ' Jam ', MOD(TIMESTAMPDIFF(SECOND, j.waktu_mulai, j.waktu_selesai), 3600), ' Menit') AS jadwal", "k.id = " . $_GET['id'] ."") as $kursi) {
    }
    $nomor = $kursi['nomor_kursi'];
    $abjad = $kursi['abjad'];
    $kelas = $kursi['kelas_studio'];
    $jadwal = $kursi['jadwal'];
    $tersedia = $kursi['tersedia'];
}

// save
if (isset($_POST['simpan'])) {
    if ($_POST['id'] == 0) {
        $exec = insert('kursi', [
            'nomor_kursi' => $_POST['nomor'],
            'abjad' => $_POST['abjad'],
            'kelas_studio' => $_POST['kelas'],
            'tersedia' => $_POST['tersedia'],
            'id_jadwal' => $_POST['jadwal'],
        ]);
        $msg = 'Berhasil Insert';
    } else {
        $exec = update('kursi',  [
            'nomor_kursi' => $_POST['nomor'],
            'abjad' => $_POST['abjad'],
            'kelas_studio' => $_POST['kelas'],
            'tersedia' => $_POST['tersedia'],
            'id_jadwal' => $_POST['jadwal'],
        ], "id = '$_GET[id]'");
        $msg = 'Berhasil Update';
    }

    if ($exec) {
        echo "<script>alert('$msg')</script>";
        echo "<script>window.location = 'index.php?r=kursi'</script>";
        die();
    } else {
        echo "<script>alert('Gagal Insert')</script>";
    }
}

?>

<div class="container pt-4 mb-4">
    <form method="POST">
        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '0' ?>">
        <div class="form-group">
            <label for="nomor">Nomor</label>
            <input type="text" class="form-control" id="nomor" name="nomor" autocomplete="off" value="<?= $nomor ?>" placeholder="nomor" required>
        </div>
        <div class="form-group">
            <label for="abjad">Abjad</label>
            <input type="text" class="form-control" id="abjad" name="abjad" autocomplete="off" value="<?= $abjad ?>" placeholder="abjad" required>
        </div>
        <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" class="form-control">
                <option selected disabled><?= $kelas != '' ? 'Kelas saat ini : ' . ($kelas == 1 ? 'Standar' : ($kelas == 2 ? 'Premium' : 'Max Movie')) : 'Pilih Kelas' ?></option>
                <?php foreach ($dataKelas as $data) { ?>
                    <option value="<?= $data['id'] ?>"><?= $data['nama'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="jadwal">Jadwal</label>
            <select name="jadwal" id="jadwal" class="form-control">
                <option selected disabled><?=$jadwal == '' ? 'Pilih Jadwal' : $jadwal ?></option>
                <?php foreach (select('jadwal j INNER JOIN film f ON j.id_film = f.id', "j.id AS id, f.nama AS nama, CONCAT('Waktu tayang ', j.waktu_mulai,' | Film ', f.nama, ' | Durasi ', TIMESTAMPDIFF(HOUR, j.waktu_mulai, j.waktu_selesai), ' Jam ', MOD(TIMESTAMPDIFF(SECOND, j.waktu_mulai, j.waktu_selesai), 3600), ' Menit') AS jadwal", 'true') as $data) { ?>
                    <option value="<?= $data['id'] ?>"><?= $data['jadwal']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tersedia">Tersedia</label>
            <select name="tersedia" id="" class="form-control">
                <option value="1" <?= $tersedia == '1' || $tersedia == '' ? 'selected' : '' ?>>Ya</option>
                <option value="0" <?= $tersedia == '0' ? 'selected' : '' ?>>Tidak</option>
            </select>
        </div>
        <button type="submit" name="simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
        <a href="index.php?r=film" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
    </form>
</div>