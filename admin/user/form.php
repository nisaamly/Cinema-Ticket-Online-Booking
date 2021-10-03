<?php

// init
$nama = '';
$email = '';
$password = '';

if (isset($_GET['id'])) {
    foreach (select('user', '*', "id = '$_GET[id]'") as $user) {
    }
    $nama = $user['name'];
    $email = $user['email'];
}

// save
if (isset($_POST['simpan'])) {
    if ($_POST['id'] == 0) {
        $exec = insert('user', [
            'name' => $_POST['nama'],
            'email' => $_POST['email'],
            'password' => md5($_POST['password'])
        ]);
        $msg = 'Berhasil Insert';
    } else {
        $arr = [
            'name' => $_POST['nama'],
            'email' => $_POST['email'],
            'password' => md5($_POST['password'])
        ];
        if ($_POST['password'] == '') unset($arr['password']);

        $exec = update('user', $arr, "id = '$_GET[id]'");
        $msg = 'Berhasil Update';
    }

    if ($exec) {
        echo "<script>alert('$msg')</script>";
        echo "<script>window.location = 'index.php?r=user'</script>";
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
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?= $email ?>" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" autocomplete="off" placeholder="<?= isset($_GET['id']) && !empty($_GET['id']) ? 'Kosongkan jika tidak merubah password' : 'Password' ?>" <?= isset($_GET['id']) && !empty($_GET['id']) ? '' : 'required' ?>>
        </div>
        <button type="submit" name="simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
        <a href="index.php?r=user" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
    </form>
</div>