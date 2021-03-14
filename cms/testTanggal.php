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
$startToday = date('Y-m-d 0:0:0');
$endToday = date('Y-m-d H:i:s');

// echo 'daftar transaksi 7 hari terakhir periode ' . $start . ' hingga ' . $end;
// $dtr = "SELECT * FROM pengajuan WHERE `update_at` BETWEEN '$startToday' AND '$endToday' ORDER BY update_at DESC";
$dtr = "SELECT * FROM `pengajuan` WHERE `update_at` =  'date('Y-m-d)' ORDER BY update_at DESC";
$result = mysqli_query($conn, $dtr);

?>
<table border="1" width="100%">
    <tr>
        <th>Subject</th>
        <th>Update AT</th>
    </tr>
    <!-- <?php while ($row = mysqli_fetch_array($result)) { ?> -->
    <tr>
        <td><?php echo $row['subject']; ?></td>
        <td><?php echo $row['update_at']; ?></td>
    </tr>
<?php } ?>
</table>

<?php

$dtr2 = "SELECT DAY(`update_at`) FROM pengajuan WHERE `update_at` BETWEEN SUBDATE(CURRENTDATE(), 1) AND '$end' ORDER BY update_at DESC";
// echo mysqli_fetch_array(mysqli_query($conn, $dtr2))["update_at"];
var_dump(mysqli_fetch_array(mysqli_query($conn, $dtr2)));
echo "<br />";
echo date('Y-m-d');

?>