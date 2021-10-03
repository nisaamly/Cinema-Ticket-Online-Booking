<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if (delete('genre', "id = '$_GET[id]'")) {
        echo "<script>window.location = 'index.php?r=genre'</script>";
        die();
    }
}

?>
<div class="container pt-4 mb-4">
    <div class="row">
        <div class="col">
            <h3>Daftar Genre</h3>
        </div>
        <div class="col-auto">
            <a href="index.php?r=genre_form" class="btn btn-success mb-2 pull-right"> <i class="fa fa-plus"></i> Tambah Genre</a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jumlah Film</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach (select('genre a left join film b on b.genre_id = a.id', 'a.*,count(b.id) as res', 'true GROUP BY a.id') as $genre) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $genre['nama'] ?></td>
                        <td><?= $genre['res'] ?></td>
                        <td>
                            <a href="index.php?r=genre_form&id=<?= $genre['id'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="index.php?r=genre&id=<?= $genre['id'] ?>?" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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