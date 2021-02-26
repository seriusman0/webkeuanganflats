<title>Print Data Surat Laporan</title>
<body onload="window.print()">
<?php
error_reporting(0);
session_start();
include "koneksi.php"; 
?>
<table class="basic"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><strong><p style='margin-bottom:-9px'>PEMERINTAHAN KOTA PADANG </p> <p style='margin-bottom:-9px'>DINAS PENDIDIKAN TEKNOLOGI INFORMASI </p> <p style='margin-bottom:9px'>PRIVATE TRAINING WEB DEVELOPMENT PADANG</p></strong></td>
  </tr>
  <tr>
    <td align="center"><p>Jln. Lintas Manggopoh Pasaman (Simpang Sago) <br> Telp. (0752) 76458, Kode Pos. 26451</p></td>
  </tr>   
</table>
<br><br>
<?php	
$e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_kendaraan where id_kendaraan='$_GET[id]'"));
  echo "<table>
            <tr>
                <td width='160'>Jenis Kendaraan</td>
                <td width=20px> : </td>
                <td>$e[jenis_kendaraan]</td>
            </tr>

                        <tr>
                        <td>Merk</td>
                        <td width=20px> : </td>
                            <td>
                            $e[merk]
                            </td>
                        </tr>

                        <tr>
                        <td>Type</td>
                        <td width=20px> : </td>
                            <td>
                            $e[type]
                            </td>
                        </tr>

                        <tr>
                        <td>Nomor Polisi</td>
                        <td width=20px> : </td>
                            <td>
                             $e[nomor_polisi]
                            </td>
                        </tr>

                        <tr>
                        <td>Nomor Rangka</td>
                        <td width=20px> : </td>
                            <td>
                            $e[nomor_rangka]
                            </td>
                        </tr>

                        <tr>
                        <td>Nomor Mesin</td>
                        <td width=20px> : </td>
                            <td>
                            $e[nomor_mesin]
                            </td>
                        </tr>

                        <tr>
                        <td>Warna</td>
                        <td width=20px> : </td>
                            <td>
                            $e[warna]
                            </td>
                        </tr>

                        <tr>
                        <td>Tahun</td>
                        <td width=20px> : </td>
                            <td>
                            $e[tahun]
                            </td>
                        </tr>

                        <tr>
                        <td>Kondisi Kendaraan</td>
                        <td width=20px> : </td>
                            <td>
                            $e[kondisi_kendaraan]
                            </td>
                        </tr>

                        <tr>
                        <td>Lokasi Kendaraan</td>
                        <td width=20px> : </td>
                            <td>
                            $e[lokasi_kendaraan]
                            </td>
                        </tr>

                        <tr>
                        <td>SK Pemegang</td>
                        <td width=20px> : </td>
                            <td>
                            $e[sk_pemegang]
                            </td>
                        </tr>

                        <tr>
                        <td>Nama Pemegang</td>
                        <td width=20px> : </td>
                            <td>
                            $e[nama_pemegang]
                            </td>
                        </tr>

                        <tr>
                        <td>Kapasitas Mesin</td>
                        <td width=20px> : </td>
                            <td>
                            $e[kapasitas_mesin]
                            </td>
                        </tr>

                        <tr>
                        <td>Keberadaaan BPKB</td>
                        <td width=20px> : </td>
                            <td>
                            $e[keberadaan_bpkb]
                            </td>
                        </tr>

                        <tr>
                        <td>Nomor BPKB</td>
                        <td width=20px> : </td>
                            <td>
                            $e[nomor_bpkb]
                            </td>
                        </tr>

                        <tr>
                        <td>Posisi BPKB</td>
                        <td width=20px> : </td>
                            <td>
                            $e[posisi_bpkb]
                            </td>
                        </tr>

                        <tr>
                        <td>Keberadaan Kendaraan</td>
                        <td width=20px> : </td>
                            <td>
                            $e[keberadaan_kendaraan]
                            </td>
                        </tr>

                        <tr>
                        <td>Asal Usul</td>
                        <td width=20px> : </td>
                            <td>
                            $e[asal_usul]
                            </td>
                        </tr>

                        <tr>
                        <td>Sumber Dana</td>
                        <td width=20px> : </td>
                            <td>
                             $e[sumber_dana]
                            </td>
                        </tr>

                        <tr>
                        <td>Harga</td>
                        <td width=20px> : </td>
                            <td>
                            Rp ".number_format($e[harga])."
                            </td>
                        </tr>

                        <tr>
                        <td valign=top>Foto Kendaraan</td>
                        <td width=20px valign=top> : </td>
                            <td>
                                <img style='width:300px' src='foto_kendaraan/$e[foto_kendaraan]'>
                            </td>
                        </tr>

                        

                        <tr>
                            <td valign=top>Keterangan</td>
                            <td width=20px valign=top> : </td>
                            <td>
                            $e[keterangan]
                            </td>
                        </tr>

        </table><br><br>";
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