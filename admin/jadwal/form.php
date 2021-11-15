<?php

// init
$waktu_mulai = '';
$waktu_selesai = '';
$film = 0;
$nama_film = '';


if (isset($_GET['id'])) {
    foreach (select("jadwal j INNER JOIN film f ON j.id_film = f.id", "f.id AS film_id, j.id AS id, j.waktu_mulai AS waktu_mulai, j.waktu_selesai AS waktu_selesai, f.nama AS nama_film", "j.id = " . $_GET['id'] . "") as $jadwal) {
    }
    $waktu_mulai = $jadwal['waktu_mulai'];
    $waktu_selesai = $jadwal['waktu_selesai'];
    $film = $jadwal['film_id'];
    $nama_film = $jadwal['nama_film'];
}

// save
if (isset($_POST['simpan'])) {
    if ($_POST['id'] == 0) {
        $exec = insert('jadwal', [
            'waktu_mulai' => $_POST['waktu_mulai'],
            'waktu_selesai' => $_POST['waktu_selesai'],
            'id_film' => $_POST['id_film'],
        ]);
        $msg = 'Berhasil Insert';
    } else {
        $exec = update('jadwal',  [
            'waktu_mulai' => $_POST['waktu_mulai'],
            'waktu_selesai' => $_POST['waktu_selesai'],
            'id_film' => $_POST['id_film'],
        ], "id = '$_GET[id]'");
        $msg = 'Berhasil Update';
    }

    if ($exec) {
        echo "<script>alert('$msg')</script>";
        echo "<script>window.location = 'index.php?r=jadwal'</script>";
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
            <label for="tgl_tayang">Waktu Mulai</label>
        <div class="form-outline datetimepicker">
                <input type="text" class="form-control" value="<?= $waktu_selesai != '' ? date('dd/mm/yyyy, H:i', strtotime($jadwal['waktu$waktu_selesai'])) : '22/12/2021, 16:12' ?>" id="waktu_selesai" name="waktu_selesai"/>
            <label for="datetimepickerExample" class="form-label">Pilih Waktu</label>
        </div>
        </div>
        <div class="form-group">
            <label for="tgl_tayang">Waktu Selesai</label>
            <div class="form-outline datetimepicker">
                <input type="text" class="form-control" value="<?= $waktu_mulai != '' ? date('dd/mm/yyyy, H:i', strtotime($jadwal['waktu_mulai'])) : '22/12/2021, 16:12' ?>" id="waktu_selesai" name="waktu_selesai"/>
            <label for="datetimepickerExample" class="form-label">Pilih Waktu</label>
        </div>
        </div>
        <div class="form-group">
            <label for="id_film">Film</label>
            <select name="id_film" id="id_film" class="form-control">
                <option selected disabled><?=$nama_film == '' ? 'Pilih Film' : $nama_film ?></option>
                <?php foreach (select("film", "*", 'true') as $data) { ?>
                    <option value="<?= $data['id'] ?>"><?= $data['nama']?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" name="simpan" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
        <a href="index.php?r=jadwal" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
    </form>
</div>

<script>
$('*[name=waktu_mulai]').appendDtpicker({

// current date/time
"current": null,

// e.g. DD.MM.YY H:mmTT
"dateFormat": "DD/MM/YY H:i",

"locale": "id",

// enable/disable animation
"animation": true,

// minute interval
"minuteInterval": 30,

// 0 = Sunday
"firstDayOfWeek": 0,

// closes the calendar after selection
"closeOnSelected": false,

// enables mouse scroll on the calendar
"calendarMouseScroll": true,

// shows today button
"todayButton": true,

// shows close button
"closeButton": true,

// date picker only
"dateOnly": false,

// time picker only
"timeOnly": false,

// only allows future datetimes
"futureOnly": false,

// min/max dates
"minDate": null,
"maxDate": null,

// auto sets date on start
"autodateOnStart": true,

// min/max times
"minTime": "00:00",
"maxTime": "23:59",

// allowed days
"allowWdays": null,

// shows AM/PM in the time list
"amPmInTimeList": false,

// external local
"externalLocale": null,

"onShow": function(){
    // on show
  },

  "onHide":  function(){
    // on hide
  },

  "onSelect":  function(){
    // on select
  }

});
</script>

