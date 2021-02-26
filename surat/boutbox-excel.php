<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan-surat-keluar_b.xls"); //ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

session_start();
error_reporting(0);
include "koneksi.php";
?>

<head>
  <title>Print - Semua Data Surat Keluar</title>
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
      <td align="center" colspan="13"><strong>PEMERINTAHAN KOTA PADANG <br>
          DINAS PENDIDIKAN TEKNOLOGI INFORMASI <br>
          PRIVATE TRAINING WEB DEVELOPMENT PADANG</strong></td>
    </tr>
    <tr>
      <td align="center" colspan="13">
        <p>Jln. Lintas Manggopoh Pasaman (Simpang Sago) <br> Telp. (0752) 76458, Kode Pos. 26451</p>
      </td>
    </tr>
  </table>
  <br><br>
  <?php
  echo "<table width=100% border=1>
					<tr bgcolor='green'>
                        <th width=30px>No</th>
                        <th>No. Surat</th>
                        <th width='100px'>Tanggal Surat</th>
                        <th>Tujuan Surat</th>
                        <th>Perihal</th>
                        <th>Tembusan</th>
                        <th>Lamp.</th>
                        <th>Diproses 1</th>
                        <th>Diproses 2</th>
                        <th>Diproses 3</th>
                        <th>Diproses 4</th>
                        <th>Penandatangan</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>";
  if ($_SESSION['unit'] == '0') {
    $outbox = mysqli_query($conn, "SELECT * FROM phpmu_outbox_b ORDER BY a.id_outbox_b ASC");
  } else {
    $outbox = mysqli_query($conn, "SELECT * FROM phpmu_outbox_b where unit_kerja='$_SESSION[unit]' ORDER BY id_outbox_b ASC");
  }
  $no = 1;
  while ($i = mysqli_fetch_array($outbox)) {
    echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[no_surat]</td>
                                    <td>" . tgl_indo($i['tanggal_surat']) . "</td>
                                    <td>$i[tujuan_surat]</td>
                                    <td>$i[id_perihal]</td>
                                    <td>$i[tembusan]</td>
                                    <td>$i[jumlah_lampiran]</td>
                                    <td>$i[diproses_1]</td>
                                    <td>$i[diproses_2]</td>
                                    <td>$i[diproses_3]</td>
                                    <td>$i[diproses_4]</td>
                                    <td>$i[penandatanganan]</td>
                                    <td>$i[status]</td>
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