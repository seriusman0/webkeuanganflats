<?php
include "config.php";
session_start();

$nif = $_SESSION['nif'];
$semester = $_POST['semester'];
$ta = $_POST['ta'];
$nohp = $_POST['nohp'];
$note_c = $_POST['note_c'];
$note_s = $_POST['note_s'];
$note_b = $_POST['note_b'];
$tgl_sub = $_POST['tgl_sub'];
$rev_1 = $_POST['rev_1'];
$rev_2 = $_POST['rev_2'];
$acc = $_POST['acc'];
$status = 0;

// INPUT PENGAJUAN 
$query = "INSERT INTO `pengajuan` 
(`id_pengajuan`, `nif`, `semester`, `ta`, `nohp`, `tgl_sub`, `rev_1`, `rev_2`, `acc`, `status`) 
VALUES (NULL, '$nif', '$semester', '$ta', '$nohp', '$tgl_sub', '$rev_1', '$rev_2', '$acc', '$status')";

if (mysqli_query($conn, $query)) {
    echo "input berhasil ke database";
    $lastId = mysqli_insert_id($conn);

    echo "last id = " . $lastId . " . ";

    $note_arr = array($note_c, $note_s, $note_b);
    $count = 0;
    while ($count < count($note_arr)) {
        $input_comment = "INSERT INTO note(note_fid_pengajuan, note_fill, note_by) VALUES ('$lastId', '$note_arr[$count]', '$count')";
        if (mysqli_query($conn, $input_comment)  == true) {
            echo "input comment berhasil\n";
        }
        $count += 1;
    }
} else {
    echo "gagal";
}
