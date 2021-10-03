<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if (delete('user', "id = '$_GET[id]'")) {
        echo "<script>window.location = 'index.php?r=user'</script>";
        die();
    }
}

?>
<div class="container pt-4 mb-4">
    <div class="row">
        <div class="col">
            <h3>Daftar User</h3>
        </div>
        <div class="col-auto">
            <a href="index.php?r=user_form" class="btn btn-success mb-2 pull-right"> <i class="fa fa-plus"></i> Tambah User</a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach (select('user', '*', 'role = 1') as $user) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <a href="index.php?r=user_form&id=<?= $user['id'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="index.php?r=user&id=<?= $user['id'] ?>?" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>