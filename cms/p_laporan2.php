<?php
error_reporting(0);
include "koneksi.php";
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pengeluaran WHERE nif = '$_POST[nama_mhs]' AND semester = '$_POST[semester]' "));
$dataMhs = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nif = '$_POST[nama_mhs]'"));
$kampusMhs = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kampus WHERE npsn = '$dataMhs[kampus]'"));
?>
<!DOCTYPE html>
<html>

<head>
  <title><?= 'A' . $dataMhs['angkatan'] . ' ' . $dataMhs['nama_mhs'] . ' Sem ' . $data['semester']; ?></title>
  <style>
    @page {
      size: auto;
      /* auto is the initial value */
      margin: 10;
      /* this affects the margin in the printer settings */
    }
  </style>
  <base target='_blank' />
</head>

<body onload="window.print()">

  <!-- AWAL BAGIAN TABEL PENGELUARAN -->
  <table class="basic" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>

      <td align="center"><img src="images/kop.bmp"></td>
    </tr>
    <tr>
      <td align="center"><strong><br>
          <p style='margin-bottom:-9px'>Rekapitulasi Penggunaan Dana Beasiswa FLATS </p> <br>
    </tr>
  </table>
  <br>
  <table width=100% class="basic gradeX" border="0" cellpadding="2" cellspacing="0">
    <tr>
      <th align="left">Nama</th>
      <th align="center" width="5%">:</th>
      <th align="left"><?php echo $dataMhs['nama_mhs']; ?></th>
      <th align="left">Kampus</th>
      <th align="center" width="5%">:</th>
      <th align="left"><?php echo $kampusMhs['nama_kampus']; ?></th>
    </tr>
    <tr>
      <th align="left">Angkatan</th>
      <th align="center" width="5%">:</th>
      <th align="left"><?php echo $dataMhs['angkatan']; ?></th>
      <th align="left">Tahun Ajaran</th>
      <th align="center" width="5%">:</th>
      <th align="left"><?php echo $data['ta']; ?></th>
    </tr>
    <tr>
      <th align="left">Semester</th>
      <th align="center" width="5%">:</th>
      <th align="left"><?php echo $data['semester']; ?></th>
      <th align="left">IPK/IPS</th>
      <th align="center" width="5%">:</th>
      <th align="left"></th>
    </tr>
  </table>
  <!-- AKHIR BAGIAN TABEL PENGELUARAN -->
  <br>

  <!-- AWAL BAGIAN LAINNYA -->
  <?php
  echo "<table width=100% border=1 cellpadding=2>
          <tr bgcolor='green'>
                        <th width=30px align=center>No</th>
                        <th width=90px>Tanggal</th>
                        <th >Keperluan (items)</th>
                        <th width=150px>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>";
  $laporan = mysqli_query($conn, "SELECT * FROM pengeluaran WHERE nif='$_POST[nama_mhs]' AND semester='$_POST[semester]' ");
  $total = 0;
  $no = 1;
  while ($i = mysqli_fetch_array($laporan)) {
    $keperluanMhs = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM keperluan WHERE id_keperluan = '$i[keperluan]'"));

    echo "<tr>
                                      <td align=center>$no</td>
                                      <td align=center>$i[tgl]</td>
                                      <td>$keperluanMhs[nama_keperluan]        <i><b>$i[ket]</b></i></td>
                                      <td align='right'>" . rupiah($i['nominal']) . "</td>
                                    </tr>";
    $total += $i['nominal'];
    $no++;
  }
  $styleb = $no;
  while ($styleb <= 10) {
    echo "<tr>
                                  <td align=center>$styleb</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>";
    $styleb++;
  }
  $total1 = $total;
  echo "<tr align=right>
              <td colspan=3 align=center><b>Total</b></td>
              <td><b>" . rupiah($total) . "</b></td>
            </tr></table>";
  ?>
  <!-- AKHIR BAGIAN LAINNYA -->


  <br>

  <?php
  echo "<table width=100% border=1>
                  <tr bgcolor='green'>
                            <th width=30px align=center> No</th>
                            <th width=90px> Tanggal</th>
                            <th> lainnya (items)</th>
                            <th width=150px> Jumlah</th>
                  </tr>
                  </thead>
                  <tbody>";
  $lainnya = mysqli_query($conn, "SELECT * FROM pemasukkan WHERE nif='$_POST[nama_mhs]' AND semester='$_POST[semester]'");
  $total = 0;
  $no = 1;
  while ($i = mysqli_fetch_array($lainnya)) {
    $keperluanMhs = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM keperluan WHERE id_keperluan = '$i[keperluan]'"));

    echo "<tr rules='rows'>
                                          <td align=center>$no</td>
                                          <td align=center>$i[tgl]</td>
                                          <td>$keperluanMhs[nama_keperluan]        <i><b>$i[ket]</b></i></td>
                                          <td align='right'>" . rupiah($i['nominal']) . "</td>
                                        </tr>";
    $total += $i['nominal'];
    $no++;
  }
  $styleb = $no;
  while ($styleb <= 5) {
    echo "<tr>
                                      <td align=center>$styleb</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>";
    $styleb++;
  }
  echo "<tr align=right rules=cols>
                  <td colspan=3 align=center><b>Total</b></td>
                  <td><b>" . rupiah($total) . "</b></td>
                </tr>
                </table>";
  ?>
  <br>
  <table width=100% border='1' rules="rows">
    <tr>
      <td colspan=3 align=center width="85%"><b>HASIL AKHIR YANG KELUAR</b></td>
      <td align=right><b><?= rupiah($total1 - $total) ?></b></td>
    </tr>
  </table>
  <br>

  <table width=100% border='0'>
    <tr>
      <td align="center" width="30%">Penerima</td>
      <td align="center" width="40%">Pendamping</td>
      <td align="center" width="30%">Keuangan FLATS</td>
    </tr>
    <tr height="60"></tr>
    <tr>
      <td align="center"><?php echo $dataMhs['nama_mhs']; ?></td>
      <td align="center">(________________) </td>
      <td align="center">Ir. Amelia MM</td>
    </tr>
  </table>

</body>

</html>