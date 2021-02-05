<?php
include "config.php";

$nif = "0420206";
$semester = 4;
$ta = 2021;
$nohp = "082274839576";
$note_c = "ini adalah masukkan mahasiswa";
$note_s = "ini adalah masukkan gembala";
$note_b = "ini adalah masukkan Biro";
$tgl_sub = "2020-12-21";
$rev_1 = "2020-12-22";
$rev_2 = "2020-12-23";
$acc = "2020-12-24";
$status = "0";




// INPUT PENGAJUAN 
$query = "INSERT INTO `pengajuan` 
(`id_pengajuan`, `nif`, `semester`, `ta`, `nohp`, `tgl_sub`, `rev_1`, `rev_2`, `acc`, `status`) 
VALUES 
(NULL, '$nif', '$semester', '$ta', '$nohp', '$tgl_sub', '$rev_1', '$rev_2', '$acc', '$status')";

if (mysqli_query($conn, $query)) {
    echo "input berhasil ke database";
    $lastId = mysqli_insert_id($conn);

    echo "last id = " . $lastId . " . ";

    // var_dump($comment_before);

    $note_arr = array($note_c, $note_s, $note_b);
    $count = 0;
    while ($count < count($note_arr)) {
        //cek data ada sebelumnya 
        // $cek_before = mysqli_query($conn, "in")
        $input_comment = "INSERT INTO note(note_fid_pengajuan, note_fill, note_by) VALUES ('$lastId', '$note_arr[$count]', '$count')";
        if (mysqli_query($conn, $input_comment)  == true) {
            echo "input comment berhasil\n";
        }
        $count += 1;
    }


    //data di dalam tabel
    //row 1





















} else {
    echo "gagal";
}
