<?php

// init
$nama = '';


if (isset($_GET['id'])) {
    foreach (select('genre', '*', "id = '$_GET[id]'") as $genre) {
    }
    $nama = $genre['nama'];
}

// save
if (isset($_POST['simpan'])) {
    if ($_POST['id'] == 0) {
        $exec = insert('genre', [
            'nama' => $_POST['nama'],
        ]);
        $msg = 'Berhasil Insert';
    } else {
        $exec = update('genre',  [
            'nama' => $_POST['nama'],
        ], "id = '$_GET[id]'");
        $msg = 'Berhasil Update';
    }

    if ($exec) {
        echo "<script>alert('$msg')</script>";
        echo "<script>window.location = 'index.php?r=genre'</script>";
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
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="<?= $nama ?>" placeholder="Nama" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
        <a href="index.php?r=film" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
    </form>
</div>