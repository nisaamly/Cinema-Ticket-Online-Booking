<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    if (delete('kursi', "id = '$_GET[id]'")) {
        echo "<script>window.location = 'index.php?r=kursi'</script>";
        die();
    }
}

?>
<div class="container pt-4 mb-4">
    <div class="row">
        <div class="col">
            <h3>Daftar Kursi</h3>
        </div>
        <div class="col-auto">
            <a href="index.php?r=kursi_form" class="btn btn-success mb-2 pull-right"> <i class="fa fa-plus"></i> Tambah Kursi</a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nomor</th>
                    <th>Abjad</th>
                    <th>Studio</th>
                    <th>Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach (select('kursi', '*', 'true') as $kursi) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $kursi['nomor_kursi'] ?></td>
                        <td><?= $kursi['abjad'] ?></td>
                        <td><?= getKelasById($kursi['kelas_studio']) ?></td>
                        <td><?= $kursi['tersedia'] == '1' ? "Ya" : "Tidak" ?></td>
                        <td>
                            <a href="index.php?r=kursi_form&id=<?= $kursi['id'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="index.php?r=kursi&id=<?= $kursi['id'] ?>?" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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