<?php
include "config.php";

$nif = "0420206";
$semester = 4;
$ta = 2021;
$nohp = "082274839576";
$note_c = "c colleger";
$note_s = "nnote spep";
$note_b = "note b";
$tgl_sub = "2020-12-21";
$rev_1 = "2020-12-22";
$rev_2 = "2020-12-23";
$acc = "2020-12-24";
$status = 0;

$query = "INSERT INTO `pengajuan` 
(`id_pengajuan`, `nif`, `semester`, `ta`, `nohp`, `note_c`, `note_s`, `note_b`, `tgl_sub`, `rev_1`, `rev_2`, `acc`, `status`) 
VALUES 
(NULL, '$nif', '$semester', '$ta', '$nohp', '$note_c', '$note_s', '$note_b', '$tgl_sub', '$rev_1', '$rev_2', '$acc', '$status')";

if (mysqli_query($conn, $query)) {
    echo "input berhasil ke database";
    $lastId = mysqli_insert_id($conn);
    echo "last id = " . $lastId . " . ";
} else {
    echo "gagal";
}
