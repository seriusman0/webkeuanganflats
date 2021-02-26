<title>Print Data Surat Keluar</title>

<body onload="window.print()">
  <?php
  error_reporting(0);
  session_start();
  include "koneksi.php";
  ?>
  <table class="basic" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="550" align="center">&nbsp;</td>
      <td width="65" rowspan="6"><img src="images/logo.jpg" width="90" height="90"></td>
    </tr>
    <tr>
      <td align="center"><strong>
          <p style='margin-bottom:-9px'>PEMERINTAHAN KOTA PADANG </p>
          <p style='margin-bottom:-9px'>DINAS PENDIDIKAN TEKNOLOGI INFORMASI </p>
          <p style='margin-bottom:9px'>PRIVATE TRAINING WEB DEVELOPMENT PADANG</p>
        </strong></td>
    </tr>
    <tr>
      <td align="center">
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
                        <th>Status</th>";
  if ($_SESSION['level'] == 'user_admin') {
    echo "<th width=40px>Unit</th>";
  }
  echo "
                    </tr>
                    </thead>
                    <tbody>";
  if ($_SESSION['unit'] == '0') {
    $outbox = mysqli_query($conn, "SELECT * FROM phpmu_outbox_b ORDER BY id_outbox_b ASC");
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
                                    <td>$i[status]</td>";
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
      <td colspan="2"></td>
      <td width="286"></td>
    </tr>
    <tr>
      <td width="230" align="center">Mengetahui <br> Direktur PHP[mu]</td>
      <td width="530"></td>
      <td align="center">Mengetahui <br> Manager Keuangan</td>
    </tr>
    <tr>
      <td align="center"><br /><br /><br /><br /><br />
        ( ...................................... )<br /><br /><br /></td>
      <td>&nbsp;</td>
      <td align="center" valign="top"><br /><br /><br /><br /><br />
        ( ...................................... )<br />
      </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</body>