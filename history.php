<?php
include 'admin/db.php';
include 'admin/constant.php';

session_start();
if(!isset($_SESSION['CUST_ID'])){
    header('Location: index.php?auth');
    die();
}

$total = 0;
$id  = $_SESSION['CUST_ID'];
$dataTransaksi = select('transaksi', '*', "user_id = '$id'");

// handle upload bukti bayar
if (isset($_POST['uploadBukti'])) {
    $id = $_POST['id'];
    $dirUpload = "admin/assets/buktiBayar/";
    $ext = explode(".", $_FILES["imgBuktiBayar"]["name"]);
    $randomName = uniqid() . uniqid() . '.' . end($ext);
    $terupload = move_uploaded_file($_FILES['imgBuktiBayar']['tmp_name'], $dirUpload . $randomName);

    update('transaksi', ['bukti_bayar' => $randomName], "id = $id");
    header("Refresh:0");
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container mt-4">
        <h2>Transaksi Anda</h2>
        <div class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total</th>
                        <th scope="col">Metode Bayar</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataTransaksi as $key => $transaksi) {
                        $total += $transaksi['total']
                    ?>
                        <span style="display: none;" id="img<?= $transaksi['id'] ?>"><?= $transaksi['bukti_bayar'] ?></span>
                        <tr>
                            <td class="align-middle"><?= ++$key ?></td>
                            <td class="align-middle"><?= $transaksi['nomor_transaksi'] ?></td>
                            <td class="align-middle"><?= date('d/m/Y', strtotime($transaksi['tgl_transaksi'])) ?></td>
                            <td class="align-middle"><?= number_format($transaksi['total']) ?></td>
                            <td class="align-middle"><?= getMethodBayarById($transaksi['metode_bayar']) ?></td>
                            <td class="align-middle"><?= $transaksi['telah_dibayar'] == 0 ? ($transaksi['bukti_bayar'] == NULL ? 'Menunggu Pembayaran' : 'Menunggu Konfirmasi Admin') : 'Selesai' ?></td>
                            <td class="align-middle">
                                <button class="btn btn-success btn-sm" data-rowid="<?= $transaksi['id'] ?>" onclick="openModalBuktiBayar(this)">Bukti Bayar</button>
                                <button class="btn btn-primary btn-sm" data-rowid="<?= $transaksi['id'] ?>" onclick="openModalDetail(this)">Detail</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="idTransaksi" name="id">
                        <div class="mb-2" id="divBuktiBayarTerupload">
                            <label class="form-label" for="customFile">Bukti Bayar Terupload</label>
                            <div>
                                <img id="imgBuktiBayarPreview" width="300vw">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <label class="form-label" for="customFile">Upload Bukti Bayar</label>
                                    <input type="file" class="form-control" id="customFile" accept="image/*" required name="imgBuktiBayar" />
                                </div>
                                <div class="col-2" style="position:relative">
                                    <button type="submit" class="btn btn-success" style="position: absolute;bottom:0" name="uploadBukti">Upload</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const pathBuktiBayar = 'admin/assets/buktiBayar/'

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

            const req = await fetch('api.php?type=getDetailTransaksi&param=' + id)
            const res = await req.json();
            let tbody = ''
            res.map(detail => {
                tbody += ` <tr>
                    <td style="width:10%">
                        <img src="admin/assets/thumbnails/${detail.thumbnail}" alt="Avatar" width="50px">
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>