<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=laporan-surat-kendaraan.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");

  session_start();
  error_reporting(0);
  include "koneksi.php";
?>
<head>
<title>Print - Semua Data Surat Kendaraan</title>
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
    <td align="center" colspan="22"><strong>PEMERINTAHAN KOTA PADANG <br>
    									   DINAS PENDIDIKAN TEKNOLOGI INFORMASI <br>
    									   PRIVATE TRAINING WEB DEVELOPMENT PADANG</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="22"><p>Jln. Lintas Manggopoh Pasaman (Simpang Sago) <br> Telp. (0752) 76458, Kode Pos. 26451</p></td>
  </tr>   
</table>
<br><br>
<?php	
	echo "<table width=100% border=1>
					<tr bgcolor='green'>
                        <th width=30px>No</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Type</th>
                        <th>No Polisi</th>
                        <th>No Rangka</th>
                        <th>No Mesin</th>
                        <th>Warna</th>
                        <th>Tahun</th>
                        <th>Kondisi Kendaraan</th>
                        <th>Lokasi Kendaraan</th>
                        <th>SK Pemegang</th>
                        <th>Nama Pemegang</th>
                        <th>Kapasitas Mesin</th>
                        <th>Keberadaan BPKB</th>
                        <th>Nomor BPKB</th>
                        <th>Posisi BPKB</th>
                        <th>Keberadaan Kendaraan</th>
                        <th>Asal Usul</th>
                        <th>Sumber Dana</th>
                        <th>Harga</th>
                        <th>keterangan</th>
                        
                    </tr>
                    </thead>
                    <tbody>";
                        $kendaraan = mysqli_query($conn, "SELECT * FROM phpmu_kendaraan ORDER BY id_kendaraan ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($kendaraan)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[jenis_kendaraan]</td>
                                    <td>$i[merk]</td>
                                    <td>$i[type]</td>
                                    <td>$i[nomor_polisi]</td>
                                    <td>$i[nomor_rangka]</td>
                                    <td>$i[nomor_mesin]</td>
                                    <td>$i[warna]</td>
                                    <td>$i[tahun]</td>
                                    <td>$i[kondisi_kendaraan]</td>
                                    <td>$i[lokasi_kendaraan]</td>
                                    <td>$i[sk_pemegang]</td>
                                    <td>$i[nama_pemegang]</td>
                                    <td>$i[kapasitas_mesin]</td>
                                    <td>$i[keberadaan_bpkb]</td>
                                    <td>$i[nomor_bpkb]</td>
                                    <td>$i[posisi_bpkb]</td>
                                    <td>$i[keberadaan_kendaraan]</td>
                                    <td>$i[asal_usul]</td>
                                    <td>$i[sumber_dana]</td>
                                    <td>$i[harga]</td>
                                    <td>$i[keterangan]</td>
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
