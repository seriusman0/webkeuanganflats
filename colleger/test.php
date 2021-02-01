<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Form Pengajuan</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Site Description Here">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/stack-interface.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/socicon.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/flickity.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/iconsmind.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/jquery.steps.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/theme.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="container">
  <div class="boxed boxed--border">
    <h1 align="center" class="text-primary">Pengajuan dan Rekapitulasi
      Penggunaan Dana Beasiswa FLATS</h1>

    <table class="border--round table--alternate-column">

      <tbody>
        <tr>
          <td>Nama</td>
          <td width=40% colspan="3">
            <input type="text">
          </td>
          <td>Kampus</td>
          <td width=40% colspan="3">
            <input type="text">
          </td>
        </tr>
        <tr>
          <td>FLATS / Semester</td>
          <td>
            <input type="text">
          </td>
          <td>/</td>
          <td><input type="text"></td>
          <td>Tahun Ajaran</td>
          <td colspan="3">
            <input type="text">
          </td>
        </tr>
        <tr>
          <td>No HP</td>
          <td colspan="3">
            <input type="text">
          </td>
          <td>IPS / IPK </td>
          <td>
            <input type="text">
          </td>
          <td>/</td>
          <td>
            <input type="text" name="" id="">
          </td>
        </tr>
      </tbody>
    </table>

    <table class="border--round">

      <tbody>
        <tr>
          <td>Catatan Mahasiswa : </td>
          <td>Catatan Gembala : </td>
          <td>Catatan Biro : </td>
        </tr>
        <tr>
          <td>
            <textarea name="note_c" id="note_c" rows="5"></textarea>
          </td>
          <td>
            <textarea name="note_c" id="note_c" rows="5"></textarea>
          </td>
          <td>
            <textarea name="note_c" id="note_c" rows="5"></textarea>
          </td>
        </tr>

      </tbody>
    </table>

    <table>

      <tr>
        <td>Tanggal Pengajuan:</td>
        <td>Tanggal Revisi Ke-1</td>
        <td>Tanggal Revisi Ke-2</td>
        <td>Tanggal Pencairan</td>
      </tr>
      <tr>
        <td><input type="date"></td>
        <td><input type="date"></td>
        <td><input type="date"></td>
        <td><input type="date"></td>
      </tr>
    </table>


    <!-- TABEL PENGAJUAN -->
    <table class="border--round">
      <thead class="bg-primary">
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Pengajuan Biaya Pokok</th>
          <th>Besaran(Rp.)</th>
          <th>Acc Biro(Rp.)</th>
          <th>Biro</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><input type="date"></td>
          <td><input type="text" value="UKT"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox1" type="checkbox" name="agree" />
              <label for="checkbox1"></label>
            </div>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td><input type="date"></td>
          <td><input type="text"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox2" type="checkbox" name="agree" />
              <label for="checkbox2"></label>
            </div>
          </td>

        <tr>
          <td>3</td>
          <td><input type="date"></td>
          <td><input type="text"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox3" type="checkbox" name="agree" />
              <label for="checkbox3"></label>
            </div>
          </td>
        </tr>

        <tr>
          <td>4</td>
          <td><input type="date"></td>
          <td><input type="text"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox4" type="checkbox" name="agree" />
              <label for="checkbox4"></label>
            </div>
          </td>
        </tr>

        <tr>
          <td>5</td>
          <td><input type="date"></td>
          <td><input type="text"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox5" type="checkbox" name="agree" />
              <label for="checkbox5"></label>
            </div>
          </td>
        </tr>

        <tr>
          <td>6</td>
          <td><input type="date"></td>
          <td><input type="text" placeholder="Apresiasi/Depresiasi" class="bg-primary"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox6" type="checkbox" name="agree" />
              <label for="checkbox6"></label>
            </div>
          </td>
        </tr>

        <tr>
          <td>7</td>
          <td><input type="date"></td>
          <td><input type="text" placeholder="Sanksi Pelanggaran" class="bg-danger"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox7" type="checkbox" name="agree" />
              <label for="checkbox7"></label>
            </div>
          </td>
        </tr>

        <tr>
          <td>8</td>
          <td><input type="date"></td>
          <td><input type="text"></td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox8" type="checkbox" name="agree" />
              <label for="checkbox8"></label>
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="3" align="right" class="bg--secondary">TOTAL</td>
          <td><input type="number"></td>
          <td><input type="number"></td>
          <td>
            <div class="input-checkbox">
              <input id="checkbox9" type="checkbox" name="agree" />
              <label for="checkbox9"></label>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- TABEL PELANGGARAN -->
    <table class="border--round">
      <thead align="center">
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Catatan</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="center">1</td>
          <td><input type="date"></td>
          <td>Pencapaian jurnal semester</td>
          <td><input type="number"></td>

        </tr>
        <tr>
          <td align="center">2</td>
          <td><input type="date"></td>
          <td>Kelebihan Hari Libur</td>
          <td><input type="number"></td>

        <tr>
          <td align="center">3</td>
          <td><input type="date"></td>
          <td><input type="text"> </td>
          <td><input type="number"></td>

        </tr>
        <tr>
          <td align="center">4</td>
          <td><input type="date"></td>
          <td><input type="text"></td>
          <td><input type="number"></td>

        </tr>
      </tbody>
    </table>

    <table>

      <tr align="center">
        <td>Mahasiswa</td>
        <td>Gembala</td>
        <td>Keuangan FLATS</td>
      </tr>
      <tr>
        <td><input type="text"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
      </tr>
    </table>
    <div class="text-primary">
      <i><b>
          *No. Efata wajib diisi 6 digit terakhir sebagai pengganti tanda tangan untuk keperluan verifikasi form.
        </b></i>
    </div>
  </div>

  <input type="button" class="bg-primary" value="KIRIM">


  <script src="js/flickity.min.js"></script>
  <script src="js/easypiechart.min.js"></script>
  <script src="js/parallax.js"></script>
  <script src="js/typed.min.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/isotope.min.js"></script>
  <script src="js/ytplayer.min.js"></script>
  <script src="js/lightbox.min.js"></script>
  <script src="js/granim.min.js"></script>
  <script src="js/jquery.steps.min.js"></script>
  <script src="js/countdown.min.js"></script>
  <script src="js/twitterfetcher.min.js"></script>
  <script src="js/spectragram.min.js"></script>
  <script src="js/smooth-scroll.min.js"></script>
  <script src="js/scripts.js"></script>
</body>

<footer>

</footer>

</html>