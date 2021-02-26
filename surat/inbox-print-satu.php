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
  $in = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_inbox where id_inbox='$_GET[id]'"));
  echo "<table>
            <tr>
                <td width='170'>Pengirim</td>
                <td width=20px> : </td>
                <td>$in[asal_surat]</td>
            </tr>

            <tr>
                <td>Tanggal Surat</td>
                <td width=20px> : </td>
                <td>" . tgl_indo($in['tanggal_surat']) . "</td>
            </tr>

            <tr>
                <td>Tanggal Masuk Agenda</td>
                <td width=20px> : </td>
                <td>" . tgl_indo($in['tanggal_masuk_agenda']) . "</td>
            </tr>

            <tr>
                <td>No Surat</td>
                <td width=20px> : </td>
                <td>$in[no_surat]</td>
            </tr>

            <tr>
                <td>Perihal </td>
                <td width=20px> : </td>
                <td>$in[id_perihal]</td>
            </tr>
                
            <tr>
                <td valign=top>Disposisi </td>
                <td width=20px valign=top> : </td>
                <td>$in[disposisi]</td>
            </tr>

            <tr>
                <td valign=top>Isi Disposisi </td>
                <td width=20px valign=top> : </td>
                <td>$in[isi_disposisi]</td>
            </tr>

            <tr>
                <td valign=top>Lokasi Arsip </td>
                <td width=20px valign=top> : </td>
                <td>$in[lokasi_arsip]</td>
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