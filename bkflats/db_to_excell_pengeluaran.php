<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=pengeluaran.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

  session_start();
  error_reporting(0);
  include "koneksi.php";
?>
<head>
<title> Export To Excell </title>
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
#kiri{
width:50%;
float:left;
}

#kanan{
width:50%;
float:right;
padding-top:20px;
margin-bottom:9px;
}

td { border:1px solid #000; }
th { border:2px solid #000; }
</style>
</head>
<body onload="window.print()">
<table class="basic"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" colspan="13"><strong>PROGRAM BEASISWA FLATS <br>
    									   ========================= <br>
    									   =========================</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="13"><p>========================================================================</p></td>
  </tr>   
</table>
<br><br>
<?php	
	echo "<table width=100% border=1>
					<tr bgcolor='green'>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Angkatan</th>
                        <th>Semester</th>
                        <th>Kampus</th>
                        <th>IPK/IPS</th>
                        <th>Tahun Ajaran</th>
                        <th>Keperluan</th>
                        <th>Nominal</th>
                        <th>Uang Tinggal</th>
                        <th>Lainnya</th>
                        <th>Nominal Lainnya</th>
                        <th>Waktu Input</th>
                        <th>Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>";
                        $kredit = mysqli_query($conn, "SELECT * FROM flats_pengeluaran ORDER BY id DESC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($kredit)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama]</td>
                                    <td>$i[angkatan]</td>
                                    <td>$i[semester]</td>
                                    <td>$i[kampus]</td>
                                    <td>$i[ip]</td>
                                    <td>$i[tahun_ajaran]</td>
                                    <td>$i[keperluan]</td>
                                    <td>$i[nominal]</td>
                                    <td>$i[uang_tinggal]</td>
                                    <td>$i[other]</td>
                                    <td>$i[other_nominal]</td>
                                    <td>$i[tgl_tr]</td>
                                 </tr>";
                            $no++;
                        }
?>


