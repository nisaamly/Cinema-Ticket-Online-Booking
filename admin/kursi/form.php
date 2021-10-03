<?php

// init
$nomor = '';
$abjad = '';
$kelas = '';
$tersedia = '';


if (isset($_GET['id'])) {
    foreach (select('kursi', '*', "id = '$_GET[id]'") as $kursi) {
    }
    $nomor = $kursi['nomor_kursi'];
    $abjad = $kursi['abjad'];
    $kelas = $kursi['kelas_studio'];
    $tersedia = $kursi['tersedia'];
}

// save
if (isset($_POST['simpan'])) {
    if ($_POST['id'] == 0) {
        $exec = insert('kursi', [
            'nomor_kursi' => $_POST['nomor'],
            'abjad' => $_POST['abjad'],
            'kelas_studio' => $_POST['kelas'],
            'tersedia' => $_POST['tersedia']
        ]);
        $msg = 'Berhasil Insert';
    } else {
        $exec = update('kursi',  [
            'nomor_kursi' => $_POST['nomor'],
            'abjad' => $_POST['abjad'],
            'kelas_studio' => $_POST['kelas'],
            'tersedia' => $_POST['tersedia']
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
            <select name="kelas" id="" class="form-control">
                <option selected disabled>Pilih Kelas</option>
                <?php foreach ($dataKelas as $data) { ?>
                    <option value="<?= $data['id'] ?>" <?= $kelas == $data['id'] ? 'selected' : '' ?>><?= $data['nama'] ?></option>
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