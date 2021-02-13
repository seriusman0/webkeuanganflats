<?php
include "config.php";

$jhasil = mysqli_query($conn, "SELECT * FROM note WHERE note_fid_pengajuan='12'");
$hasil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM note WHERE note_fid_pengajuan='12'"));
// var_dump($hasil);
var_dump($hasil);
