<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan-surat-masuk.xls"); //ganti nama sesuai keperluan
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
      <td align="center" colspan="8"><strong>PEMERINTAHAN KOTA PADANG <br>
          DINAS PENDIDIKAN TEKNOLOGI INFORMASI <br>
          PRIVATE TRAINING WEB DEVELOPMENT PADANG</strong></td>
    </tr>
    <tr>
      <td align="center" colspan="8">
        <p>Jln. Lintas Manggopoh Pasaman (Simpang Sago) <br> Telp. (0752) 76458, Kode Pos. 26451</p>
      </td>
    </tr>
  </table>
  <br><br>
  <?php
  echo "<table width=100% border=1>
					<tr bgcolor='green'>
                        <th>No</th>
                        <th>Pengirim</th>
                        <th width='100px'>Tanggal Surat</th>
                        <th width='100px'>Masuk Agenda</th>
                        <th>No. Surat</th>
                        <th>Perihal</th>
                        <th width='100px'>Lokasi Arsip</th>
                        <th>Disposisi</th>
                    </tr>
                    </thead>
                    <tbody>";
  if ($_SESSION['unit'] == '0') {
    $inbox = mysqli_query($conn, "SELECT * FROM phpmu_inbox ORDER BY id_inbox ASC");
  } else {
    $inbox = mysqli_query($conn, "SELECT * FROM phpmu_inbox where unit_kerja='$_SESSION[unit]' ORDER BY id_inbox ASC");
  }
  $no = 1;
  while ($i = mysqli_fetch_array($inbox)) {
    echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[asal_surat]</td>
                                    <td>" . tgl_indo($i['tanggal_surat']) . "</td>
                                    <td>" . tgl_indo($i['tanggal_masuk_agenda']) . "</td>
                                    <td>$i[no_surat]</td>
                                    <td>$i[id_perihal]</td>
                                    <td>$i[lokasi_arsip]</td>
                                    <td>$i[disposisi]</td>
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