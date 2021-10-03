<?php

// init
$nama = '';
$genre_id = '';
$tgl_tayang = '';
$description = '';
$harga = '';
$thumbnail = '';
$durasi = '';


if (isset($_GET['id'])) {
    foreach (select('film', '*', "id = '$_GET[id]'") as $film) {
    }
    $nama = $film['nama'];
    $genre_id = $film['genre_id'];
    $tgl_tayang = date('Y-m-d', strtotime($film['tgl_tayang']));
    $description = $film['description'];
    $harga = $film['harga'];
    $thumbnail = $film['thumbnail'];
    $durasi = $film['durasi'];
}

// save
if (isset($_POST['simpan'])) {

    if ($_POST['id'] == 0) {
        $dirUpload = "assets/thumbnails/";
        $ext = explode(".", $_FILES["thumbnailImg"]["name"]);
        $randomName = uniqid() . uniqid() . '.' . end($ext);
        $terupload = move_uploaded_file($_FILES['thumbnailImg']['tmp_name'], $dirUpload . $randomName);

        $exec = insert('film', [
            'nama' => $_POST['nama'],
            'tgl_tayang' => $_POST['tgl_tayang'],
            'genre_id' => $_POST['genre_id'],
            'description' => $_POST['desc'],
            'harga' => $_POST['harga'],
            'thumbnail' => $randomName,
            'durasi' => $_POST['durasi']
        ]);
        $msg = 'Berhasil Insert';
    } else {
        $thumbnailName = $thumbnail;
        if (isset($_FILES['thumbnailImg']) && !empty($_FILES['thumbnailImg'])) {
            $dirUpload = "assets/thumbnails/";
            $ext = explode(".", $_FILES["thumbnailImg"]["name"]);
            $randomName = uniqid() . uniqid() . '.' . end($ext);
            $terupload = move_uploaded_file($_FILES['thumbnailImg']['tmp_name'], $dirUpload . $randomName);
            $thumbnailName = $randomName;
        }
        $exec = update('film',  [
            'nama' => $_POST['nama'],
            'tgl_tayang' => $_POST['tgl_tayang'],
            'genre_id' => $_POST['genre_id'],
            'description' => $_POST['desc'],
            'harga' => $_POST['harga'],
            'durasi' => $_POST['durasi'],
            'thumbnail' => $thumbnailName
        ], "id = '$_POST[id]'");
        $msg = 'Berhasil Update';
    }

    if ($exec) {
        echo "<script>alert('$msg')</script>";
        echo "<script>window.location = 'index.php?r=film'</script>";
        die();
    } else {
        echo "<script>alert('Gagal Insert')</script>";
    }
}

?>

<div class="container pt-4 mb-4">
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '0' ?>">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="<?= $nama ?>" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <label for="genre">Genre</label>
            <select name="genre_id" id="" class="form-control">
                <option selected disabled>Pilih Genre</option>
                <?php foreach (select('genre', '*', 'true') as $genre) { ?>
                    <option value="<?= $genre['id'] ?>" <?= $genre_id == $genre['id'] ? 'selected' : '' ?>><?= $genre['nama'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="desc">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" autocomplete="off" value="<?= $harga ?>" placeholder="Harga" required>
        </div>
        <div class="form-group">
            <label for="tgl_tayang">Tanggal Tayang</label>
            <input type="date" class="form-control datepicker" id="tgl_tayang" name="tgl_tayang" autocomplete="off" value="<?= $tgl_tayang ?>" placeholder="tgl_tayang" required>
        </div>
        <div class="form-group">
            <label for="durasi">Durasi (Menit)</label>
            <input type="number" class="form-control" id="durasi" name="durasi" autocomplete="off" value="<?= $durasi ?>" placeholder="Durasi" required>
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <textarea class="form-control" id="desc" name="desc" placeholder="Desc" required><?= $description ?></textarea>
        </div>
        <div class="form-group">
            <label for="desc">Thumbnail</label>
            <input type="file" class="form-control" id="customFile" accept="image/*" <?php if (!isset($_GET['id'])) echo 'required' ?> name="thumbnailImg" />
            <span style="color:grey;font-size:0.8em">*Kosongkan jika tidak ingin mengganti</span>
            <?php if ($thumbnail != '') { ?>
                <div>
                    <img src="assets/thumbnails/<?= $thumbnail ?>" alt="" style="width: 200px;">
                </div>
            <?php } ?>
        </div>
        <button type="submit" name="simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
        <a href="index.php?r=film" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
    </form>
</div>