<title>Print Data Surat Keluar</title>
<body onload="window.print()">
<?php
error_reporting(0);
session_start();
include "koneksi.php"; 
?>
<table class="basic"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    <td width="550" align="center">&nbsp;</td>
	<td width="65" rowspan="6"><img src="images/logo.jpg" width="90" height="90"></td>
  </tr>
  <tr>
    <td align="center"><strong><p style='margin-bottom:-9px'>PEMERINTAHAN KOTA PADANG </p> <p style='margin-bottom:-9px'>DINAS PENDIDIKAN TEKNOLOGI INFORMASI </p> <p style='margin-bottom:9px'>PRIVATE TRAINING WEB DEVELOPMENT PADANG</p></strong></td>
  </tr>
  <tr>
    <td align="center"><p>Jln. Lintas Manggopoh Pasaman (Simpang Sago) <br> Telp. (0752) 76458, Kode Pos. 26451</p></td>
  </tr>   
</table>
<br><br>
<?php	
	echo "<table width=100% border=1>
					<tr bgcolor='green'>
                        <th width=30px>No</th>
                        <th>No. Surat</th>
                        <th>Perihal</th>
                        <th>Bidang</th>
                        <th>Tujuan Surat</th>
                        <th width='100px'>Tanggal Terima</th>
                        <th>Penerima</th>
                        <th>Lokasi Arsip</th>
                    </tr>
                    </thead>
                    <tbody>";
                      if ($_SESSION[unit] == '0'){
                        $inbox = mysqli_query($conn, "SELECT * FROM phpmu_outbox ORDER BY id_outbox ASC");
                      }else{
                        $inbox = mysqli_query($conn, "SELECT * FROM phpmu_outbox where unit_kerja='$_SESSION[unit]' ORDER BY id_outbox ASC");
                      }
                        $no = 1;
                        while ($i = mysqli_fetch_array($inbox)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[no_surat]</td>
                                    <td>$i[id_perihal]</td>
                                    <td>$i[bidang]</td>
                                    <td>$i[tujuan_surat]</td>
                                    <td>".tgl_indo($i[tanggal_surat])."</td>
                                    <td>$i[nama_penerima]</td>
                                    <td>$i[lokasi_arsip]</td>
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