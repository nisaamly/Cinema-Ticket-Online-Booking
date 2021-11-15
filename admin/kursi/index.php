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
                    <th>Jadwal Tayang</th>
                    <th>Durasi</th>
                    <th>Jadwal Film</th>
                    <th>Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach (select("kursi k INNER JOIN jadwal j ON k.id_jadwal = j.id INNER JOIN film f ON j.id_film = f.id", "k.id AS id_kursi, k.nomor_kursi AS nomor_kursi, k.abjad AS abjad, k.kelas_studio AS kelas_studio, k.tersedia AS tersedia, j.waktu_mulai AS waktu_tayang, f.nama as nama_film, CONCAT( TIMESTAMPDIFF(HOUR, j.waktu_mulai, j.waktu_selesai), ' Jam ', MOD(TIMESTAMPDIFF(SECOND, j.waktu_mulai, j.waktu_selesai), 3600), ' Menit') AS durasi", "true") as $kursi) { ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $kursi['nomor_kursi'] ?></td>
                        <td><?= $kursi['abjad'] ?></td>
                        <td><?= getKelasById($kursi['kelas_studio']) ?></td>
                        <td><?= date('d F Y', strtotime($kursi['waktu_tayang'])) ?> pukul <?= date('H:i', strtotime($kursi['waktu_tayang'])) ?> WIB</td>
                        <td><?= $kursi['durasi'] ?></td>
                        <td><?= $kursi['nama_film'] ?></td>
                        <td><?= $kursi['tersedia'] == '1' ? "Ya" : "Tidak" ?></td>
                        <td>
                            <a href="index.php?r=kursi_form&id=<?= $kursi['id_kursi'] ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                            <a href="index.php?r=kursi&id=<?= $kursi['id_kursi'] ?>?" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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