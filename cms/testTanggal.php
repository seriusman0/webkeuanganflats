<?php
// include "koneksi.php";
// $query = "SELECT * FROM pengajuan";
// var_dump(mysqli_fetch_array(mysqli_query($conn, $query))['update_at']);
// echo "<br />";

// $pinjam            = date("d-m-Y");
// $tujuh_hari        = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
// $kembali          = date("d-m-Y", $tujuh_hari);

// echo "Tgl Pinjam : $pinjam ";
// echo "<br />";
// echo "Tgl Kembali : $kembali";


include 'koneksi.php';
$nows = strtotime(date('Y-m-d'));
// date('Y-m-d H:i:s');
$start = date('Y-m-d H:i:s', strtotime('-7 day', $nows));
$end = date('Y-m-d H:i:s');
echo 'daftar transaksi 7 hari terakhir periode ' . $start . ' hingga ' . $end;
$dtr = "SELECT * FROM pengajuan WHERE `update_at` between '$start' AND '$end' ORDER BY update_at DESC";
$result = mysqli_query($conn, $dtr);

?>
<table border="1" width="100%">
    <tr>
        <th>Update AT</th>
    </tr>
    <!-- <?php while ($row = mysqli_fetch_array($result)) { ?> -->
    <tr>
        <td><?php echo $row['update_at']; ?></td>
    </tr>
<?php } ?>
</table>