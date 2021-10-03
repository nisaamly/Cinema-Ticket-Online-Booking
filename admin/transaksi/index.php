<?php

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    foreach(select('tiket','*',"transaksi_id = $id") as $tiket){
        update('kursi', ['tersedia' => 0], "id = $tiket[kursi_id]");
    }
    update('transaksi', ['telah_dibayar' => 1], "id = $id");
    echo "<script>window.location = 'index.php?r=transaksi'</script>";
    die();
}

$dataTransaksi = select('transaksi a join user b on a.user_id = b.id', 'a.*, b.name', "true");

?>
<div class="container pt-4 mb-4">
    <div class="row">
        <div class="col">
            <h3>Daftar Transaksi</h3>
        </div>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nomor Transaksi</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Metode Bayar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataTransaksi as $key => $transaksi) { ?>
                    <span style="display: none;" id="img<?= $transaksi['id'] ?>"><?= $transaksi['bukti_bayar'] ?></span>
                    <tr>
                        <td class="align-middle"><?= ++$key ?></td>
                        <td class="align-middle"><?= $transaksi['nomor_transaksi'] ?></td>
                        <td class="align-middle"><?= $transaksi['name'] ?></td>
                        <td class="align-middle"><?= date('d/m/Y', strtotime($transaksi['tgl_transaksi'])) ?></td>
                        <td class="align-middle"><?= number_format($transaksi['total']) ?></td>
                        <td class="align-middle"><?= getMethodBayarById($transaksi['metode_bayar']) ?></td>
                        <td class="align-middle"><?= $transaksi['telah_dibayar'] == 0 ? ($transaksi['bukti_bayar'] == NULL ? 'Menunggu Pembayaran' : 'Menunggu Konfirmasi Admin') : 'Selesai' ?></td>
                        <td class="align-middle">
                            <button class="btn btn-success btn-sm" data-rowid="<?= $transaksi['id'] ?>" onclick="openModalBuktiBayar(this)">Bukti Bayar</button>
                            <button class="btn btn-primary btn-sm" data-rowid="<?= $transaksi['id'] ?>" onclick="openModalDetail(this)">Detail</button>
                            <?php if ($transaksi['telah_dibayar'] == 0) { ?>
                                <a href="index.php?r=transaksi&id=<?= $transaksi['id'] ?>" class="btn btn-warning btn-sm" data-rowid="<?= $transaksi['id'] ?>">Konfirmasi</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Bukti Bayar -->
<div class="modal fade" id="modalBuktiBayar" tabindex="-1" aria-labelledby="modalBuktiBayarLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuktiBayarLabel">Bukti Bayar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="mb-2" id="divBuktiBayarTerupload">
                    <label class="form-label" for="customFile">Bukti Bayar Terupload</label>
                    <div>
                        <img id="imgBuktiBayarPreview" width="300vw">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailLabel">Detail Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Film</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nomor Hp</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Kursi</th>
                            <th scope="col">Harga</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyDetail">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const pathBuktiBayar = 'assets/buktiBayar/'

    function openModalBuktiBayar(el) {
        const id = $(el).data('rowid')
        $('#idTransaksi').val(id)
        $('#modalBuktiBayar').modal('show')

        const img = $('#img' + id).html();
        if (img != '') {
            $('#divBuktiBayarTerupload').show()
            $('#imgBuktiBayarPreview').attr('src', pathBuktiBayar + img)
        } else {
            $('#divBuktiBayarTerupload').hide()
        }

    }

    async function openModalDetail(el) {
        const id = $(el).data('rowid')
        $('#modalDetail').modal('show')

        const req = await fetch('../api.php?type=getDetailTransaksi&param=' + id)
        const res = await req.json();
        let tbody = ''
        res.map(detail => {
            tbody += ` <tr>
                    <td style="width:10%">
                        <img src="assets/thumbnails/${detail.thumbnail}" alt="Avatar" width="50px">
                    </td>
                    <td class="align-middle">${detail.film}</td>
                    <td class="align-middle">${detail.atas_nama}</td>
                    <td class="align-middle">${detail.nomor_hp}</td>
                    <td class="align-middle">${detail.kelas}</td>
                    <td class="align-middle">${detail.kursi}</td>
                    <td class="align-middle">${detail.harga}</td>
                </tr>`
        })
        $('#tbodyDetail').html(tbody)
    }
</script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>