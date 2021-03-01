<?php
include "config.php";
include "functions.php";

// item(152, 1, 'itemP');

$id = "SELECT detail_pengajuan.id_detail_pengajuan FROM detail_pengajuan WHERE detail_pengajuan.fid_pengajuan='152' AND detail_pengajuan.row='2'";
if ($idItem = mysqli_fetch_array(mysqli_query($conn, $id))) {
    $idItem2 = "SELECT * FROM sub_detail_pengajuan WHERE sub_detail_pengajuan.fid_detail_pengajuan = '$idItem[id_detail_pengajuan]'";
    $result = mysqli_fetch_array(mysqli_query($conn, $idItem2));
    // echo $result['itemP'];
    var_dump($result['status']);
}

// if (mysqli_query($conn, $id)) {
//     $idItem = "SELECT * FROM sub_detail_pengajuan WHERE sub_detail_pengajuan.fid_detail_pengajuan = '$id'";
//     $result = mysqli_fetch_array(mysqli_query($conn, $idItem));
//     echo $result['itemP'];
// }
