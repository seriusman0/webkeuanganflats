<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan-surat-masuk_b.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

session_start();
error_reporting(0);
include "koneksi.php";
?>

<head>
  <title>Print - Semua Data Surat Masuk</title>
  <style>
    .input1 {
      height: 20px;
      font-size: 12px;
      padding-left: 5px;
      margin: 5px 0px 0px 5px;
      width: 97%;
      border: none;
      color: red;
    }

    #kiri {
      width: 50%;
      float: left;
    }

    #kanan {
      width: 50%;
      float: right;
      padding-top: 20px;
      margin-bottom: 9px;
    }

    td {
      border: 1px solid #000;
    }

    th {
      border: 2px solid #000;
    }
  </style>
</head>

<body onload="window.print()">
  <table class="basic" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" colspan="12"><strong>PEMERINTAHAN KOTA PADANG <br>
          DINAS PENDIDIKAN TEKNOLOGI INFORMASI <br>
          PRIVATE TRAINING WEB DEVELOPMENT PADANG</strong></td>
    </tr>
    <tr>
      <td align="center" colspan="12">
        <p>Jln. Lintas Manggopoh Pasaman (Simpang Sago) <br> Telp. (0752) 76458, Kode Pos. 26451</p>
      </td>
    </tr>
  </table>
  <br><br>
  <?php
  echo "<table width=100% border=1>
					<tr bgcolor='green'>
                        <th>No</th>
                        <th>No. Surat</th>
                        <th>Pengirim</th>
                        <th width='100px'>Tanggal Surat</th>
                        <th width='100px'>Masuk Agenda</th>
                        <th>Perihal</th>
                        <th>Isi Disposisi A</th>
                        <th>Isi Disposisi B</th>
                        <th>Isi Disposisi C</th>
                        <th width='50px'>Lamp.</th>
                        <th width='60px'>Status</th>
                        <th width='95px'>Lokasi Arsip</th>";
  if ($_SESSION['level'] == 'user_admin') {
    echo "<th width=40px>Unit</th>";
  }
  echo "
                    </tr>
                    </thead>
                    <tbody>";
  if ($_SESSION['unit'] == '0') {
    $inbox = mysqli_query($conn, "SELECT * FROM phpmu_inbox_b ORDER BY id_inbox_b ASC");
  } else {
    $inbox = mysqli_query($conn, "SELECT * FROM phpmu_inbox_b where unit_kerja='$_SESSION[unit]' ORDER BY id_inbox_b ASC");
  }
  $no = 1;
  while ($i = mysqli_fetch_array($inbox)) {
    echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td valign=top>$i[no_surat]</td>
                                    <td valign=top>$i[pengirim]</td>
                                    <td valign=top>" . tgl_indo($i['tanggal_surat']) . "</td>
                                    <td valign=top>" . tgl_indo($i['tanggal_masuk_agenda']) . "</td>
                                    <td valign=top>$i[id_perihal]</td>
                                    <td valign=top>$i[isi_disposisi_a]</td>
                                    <td valign=top>$i[isi_disposisi_b]</td>
                                    <td valign=top>$i[isi_disposisi_c]</td>
                                    <td valign=top>$i[jumlah_lampiran]</td>
                                    <td valign=top>$i[status]</td>
                                    <td valign=top>$i[lokasi_arsip]</td>";
    if ($_SESSION['level'] == 'user_admin') {
      echo "<th width=40px>$i[unit_kerja]</th>";
    }
    echo "
                                 </tr>";
    $no++;
  }
  ?>

  <table width=100%>
    <tr>
      <td width="230" align="center" colspan="3">Mengetahui <br> Direktur PHP[mu]</td>
      <td align="center" colspan="4">Mengetahui <br> Manager Keuangan</td>
    </tr>
    <tr>
      <td align="center" colspan="3"><br /><br /><br /><br /><br />
        ( ...................................... )<br /><br /><br /></td>
      <td align="center" colspan="4"><br /><br /><br /><br /><br />
        ( ...................................... )<br />
      </td>
    </tr>
  </table>