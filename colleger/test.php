<!-- //saya akan mencoba query di sini -->
<?php
include "config.php";

$idPengajuan = 152;

$query = "SELECT * FROM pengajuan, detail_pengajuan, sub_detail_pengajuan, note
            WHERE pengajuan.id_pengajuan = $idPengajuan 
            AND $idPengajuan = detail_pengajuan.fid_pengajuan 
            AND detail_pengajuan.id_detail_pengajuan = sub_detail_pengajuan.fid_detail_pengajuan 
            AND note.note_fid_pengajuan = $idPengajuan";

if ($r = mysqli_fetch_array(mysqli_query($conn, $query))) {
    var_dump($r);
    echo "<script>alert('masuk pak eko')</script>";
}

?>