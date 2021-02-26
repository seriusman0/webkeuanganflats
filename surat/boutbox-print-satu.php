<title>Print Data Surat Masuk</title>

<body onload="window.print()">
  <?php
  error_reporting(0);
  session_start();
  include "koneksi.php";
  ?>
  <table class="basic" border="0" align="center" cellpadding="0" cellspacing="0">
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
  $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_outbox_b where id_outbox_b='$_GET[id]'"));
  echo "<table>
            

            <tr>
                <td width='150'>No Surat</td>
                <td width=20px> : </td>
                <td>$e[no_surat]</td>
            </tr>

            <tr>
                <td>Tanggal Surat</td>
                <td width=20px> : </td>
                <td>" . tgl_indo($e['tanggal_surat']) . "</td>
            </tr>

            <tr>
                <td>Tujuan Surat</td>
                <td width=20px> : </td>
                <td>$e[tujuan_surat]</td>
            </tr>

            <tr>
                <td>Perihal</td>
                <td width=20px> : </td>
                <td>$e[nama_perihal]</td>
            </tr>

            <tr>
                <td>Tembusan</td>
                <td width=20px> : </td>
                <td>$e[tembusan]</td>
            </tr>

            <tr>
                <td>Jumlah Lampiran</td>
                <td width=20px> : </td>
                <td>$e[jumlah_lampiran]</td>
            </tr>

            <tr>
                <td>Diproses 1</td>
                <td width=20px> : </td>
                <td>$e[diproses_1]</td>
            </tr>

            <tr>
                <td>Diproses 2</td>
                <td width=20px> : </td>
                <td>$e[diproses_2]</td>
            </tr>

            <tr>
                <td>Diproses 3</td>
                <td width=20px> : </td>
                <td>$e[diproses_3]</td>
            </tr>

            <tr>
                <td>Diproses 4</td>
                <td width=20px> : </td>
                <td>$e[diproses_4]</td>
            </tr>

            <tr>
                <td>Penandatangan</td>
                <td width=20px> : </td>
                <td>$e[penandatanganan]</td>
            </tr>

             <tr>
                <td>Status</td>
                <td width=20px> : </td>
                <td>$e[status]</td>
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