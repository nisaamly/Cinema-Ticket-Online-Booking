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
            <h3>Jadwal Tayang</h3>
        </div>
        <div class="col-auto">
            <a href="index.php?r=jadwal_form" class="btn btn-success mb-2 pull-right"> <i class="fa fa-plus"></i> Tambah Jadwal</a>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Film</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ( select("jadwal j INNER JOIN film f ON j.id_film = f.id", "j.id AS id, j.waktu_mulai AS waktu_mulai, j.waktu_selesai AS waktu_selesai, f.nama AS nama_film", "true") as $jadwal) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= date('d F Y', strtotime($jadwal['waktu_mulai'])) ?> pukul <?= date('H:i', strtotime($jadwal['waktu_mulai'])) ?> WIB</td>
                        <td><?= date('d F Y', strtotime($jadwal['waktu_selesai'])) ?> pukul <?= date('H:i', strtotime($jadwal['waktu_selesai'])) ?> WIB</td>
                        <td><?= $jadwal['nama_film'] ?></td>
                        <td>
                            <a href="index.php?r=jadwal_form&id=<?= $jadwal['id'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="index.php?r=jadwal&id=<?= $jadwal['id'] ?>?" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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