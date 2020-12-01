  <title><?= $_POST['nama_mhs']; ?></title>
<body>
  <style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    body
    {
        /*border: solid 1px blue ;*/
        margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */
    }
    </style>
<?php
error_reporting(0);
session_start();
include "koneksi.php"; 
$laporan = mysqli_query($conn, "SELECT * FROM flats_pengeluaran where id_mhs='$_POST[nama_mhs]' AND semester='$_POST[semester]' ");
$data = mysqli_fetch_array($laporan);
$no = 1;
$t1 = 0;
$t2 = 0;
$ts = 0;

?>
<table class="basic"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
    
	<td align="center"><img src="images/kop.bmp"></td>
  </tr>
  <tr>
    <td align="center"><strong><br>
    	<p style='margin-bottom:-9px'>Rekapitulasi Penggunaan Dana Beasiswa FLaTS </p> <br>
  </tr>
</table>
<br>
<table width=100% class="basic"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <th align="left">Nama</th>
    <th align="center" width="5%">:</th>
    <th align="left"><?php echo $data['nama']; ?></th>
    <th align="left">Kampus</th>
    <th align="center" width="5%">:</th>
    <th align="left"><?php echo $data['kampus']; ?></th>
  </tr>
  <tr>
    <th align="left">Angkatan</th>
    <th align="center" width="5%">:</th>
    <th align="left"><?php echo $data['angkatan']; ?></th>
    <th align="left">Tahun Ajaran</th>
    <th align="center" width="5%">:</th>
    <th align="left"><?php echo $data['tahun_ajaran']; ?></th>
  </tr>
  <tr>
    <th align="left">Semester</th>
    <th align="center" width="5%">:</th>
    <th align="left"><?php echo $data['semester']; ?></th>
    <th align="left">IPK/IPS</th>
    <th align="center" width="5%">:</th>
    <th align="left"><?php echo $data['ip']; ?></th>
  </tr>
</table>
<br>
<?php	
	echo "<table width=100% border=1>
					<tr bgcolor='green'>
                        <th width=30px align=center>No</th>
                        <th>Keperluan (items)</th>
                        <th width=150px>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>";
                        $laporan = mysqli_query($conn, "SELECT * FROM flats_pengeluaran where id_mhs='$_POST[nama_mhs]' AND semester='$_POST[semester]' ");

                        $no = 1;
                        while ($i = mysqli_fetch_array($laporan)){
                            if ( $i[nominal] != 0 ){  
                              echo "<tr>
                                      <td align=center>$no</td>
                                      <td>$i[keperluan]</td>
                                      <td align='right'>".rupiah($i['nominal'])."</td>
                                    </tr>";
                              $no++;
                              }
                              $t1 += $i['nominal'];
                            }
                        $styleb=$no;
                        while($styleb <= 10){
                          echo "<tr>
                                  <td align=center>$styleb</td>
                                  <td></td>
                                  <td></td>
                                </tr>";
                        $styleb++;
                        }
  echo "<tr align=right>
          <td colspan=2 align=center><b>Total</b></td>
          <td><b>".rupiah($t1)."</b></td>
        </tr></table>";
?>

<br>

<?php
$noo = 1;
 echo "<table width=100% border=1>
          <tr bgcolor='green'>
                        <th colspan=2>Lain-lain</th>
                        <th width=150px>Jumlah</th>
                    </tr>
                    </thead>
                    <tbody>";
                        $laporan = mysqli_query($conn, "SELECT * FROM flats_pengeluaran where id_mhs='$_POST[nama_mhs]' AND semester='$_POST[semester]' ");
                            while ($i = mysqli_fetch_array($laporan)){
                            if( $i[other] != "" OR $i[other_nominal] != 0){
                              echo "<tr>
                                      <td width=30px align=center>$noo</td>
                                      <td>$i[other]</td>
                                      <td align='right'>".rupiah($i['other_nominal'])."</td>
                                   </tr>";
                              $noo++;
                            }
                            $t2 += $i['other_nominal'];
                            }
                        $styleb2=$no;
                        while($styleb2 <= 3){
                          echo "<tr>
                                  <td align=center>$styleb2</td>
                                  <td></td>
                                  <td></td>
                                </tr>";
                        $styleb2++;
                        }
  echo "<tr align=right>
          <td colspan=2 align=center><b>Total</b></td>
          <td><b>".rupiah($t2)."</b></td>
        </tr></table>";
?>
<br>
<table width="100%" border="1">
  <tr>
    <td align="center" colspan="2"><b>HASIL AKHIR YANG KELUAR</b></td>
    <td align="right" width="150px"><b><?= rupiah($t1-$t2); ?></b></td>
  </tr>
</table>
<br>
<table width=100%>
  <tr>
    <td align="center" colspan="2">Penerima</td>
    <td align="center" colspan="2">Pendamping</td>
    <td align="center" colspan="2">Keuangan Flats</td>
  <tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
  <tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
  <tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
  <tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
  <tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
  <tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
    <td align="center" colspan="2"><?= $data['nama'];?></td>
    <td align="center" colspan="2">(___________________)</td>
    <td align="center" colspan="2"> Ir. Amelia, MM </td>
  </tr>
</table> 
</body>