<?php

include "config.php";
if (isset($_POST["submit"])) {
    // echo "Berhasil Masuk Ke tombol Submit";
    $tgl = array($_POST["tgl1"], $_POST["tgl2"], $_POST["tgl3"], $_POST["tgl4"], $_POST["tgl5"], $_POST["tgl6"], $_POST["tgl7"], $_POST["tgl8"], $_POST["tgl9"], $_POST["tgl10"]);
    $item = array($_POST["item1"], $_POST["item2"], $_POST["item3"], $_POST["item4"], $_POST["item5"], $_POST["item6"], $_POST["item7"], $_POST["item8"], $_POST["item9"], $_POST["item10"]);
    $vP = array($_POST["vP1"], $_POST["vP2"], $_POST["vP3"], $_POST["vP4"], $_POST["vP5"], $_POST["vP6"], $_POST["vP7"], $_POST["vP8"], $_POST["vP9"], $_POST["vP10"]);
    $vAcc = array($_POST["vAcc1"], $_POST["vAcc2"], $_POST["vAcc3"], $_POST["vAcc4"], $_POST["vAcc5"], $_POST["vAcc6"], $_POST["vAcc7"], $_POST["vAcc8"], $_POST["vAcc9"], $_POST["vAcc10"]);
    $status = array($_POST["status1"], $_POST["status2"], $_POST["status3"], $_POST["status4"], $_POST["status5"], $_POST["status6"], $_POST["status7"], $_POST["status8"], $_POST["status9"], $_POST["status10"]);

    $count = 0;
    $lastId = 2;

    while ($count < 10) {
        if ($item[$count] == '') {
            break;
        } else {
            $row = $count + 1;
            mysqli_query($conn, "INSERT INTO detail_pengajuan values (NULL,'$lastId','$row')");
            $lastIdDetailPengajuan = mysqli_insert_id($conn);
            $updateNow = date('Y-m-d H:i:s');
            mysqli_query($conn, "INSERT INTO `sub_detail_pengajuan` 
            (`id_sub_detail_pengajuan`, `fid_detail_pengajuan`, `tglP`, 
            `itemP`, `valP`, `valAcc`, `status`) 
            VALUES (NULL, '$lastIdDetailPengajuan', '$tgl[$count]', 
            '$item[$count]', '$vP[$count]', '$vAcc[$count]', '1')");
            echo "<script>alert('Input Pengajuan Berhasil')</script>";
        }
        $count += 1;
    }
}
