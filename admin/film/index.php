<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if (delete('film', "id = '$_GET[id]'")) {
        echo "<script>window.location = 'index.php?r=film'</script>";
        die();
    }
}

?>
<div class="container pt-4 mb-4">
    <div class="row">
        <div class="col">
            <h3>Daftar Film</h3>
        </div>
        <div class="col-auto">
            <a href="index.php?r=film_form" class="btn btn-success mb-2 pull-right"> <i class="fa fa-plus"></i> Tambah Film</a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Genre</th>
                    <th>Harga</th>
                    <th>Tgl Tayang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach (select('film a join genre b on a.genre_id = b.id', 'a.*,b.nama as genre', 'true') as $film) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $film['nama'] ?></td>
                        <td><?= $film['genre'] ?></td>
                        <td><?= number_format($film['harga']) ?></td>
                        <td><?= $film['tgl_tayang'] ?></td>
                        <td>
                            <a href="index.php?r=film_form&id=<?= $film['id'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="index.php?r=film&id=<?= $film['id'] ?>?" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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