<?php
include "koneksi.php";
if (isset($_POST['return'])) {

    var_dump($_POST);
    // //ambil nilai nilainya;
    $idPengajuan = $_POST['idPengajuan'];

    // $subject = $_POST['subject'];
    $tgl_sub = isDateEmpty($_POST['tgl_sub']);
    $rev_1 = isDateEmpty($_POST['rev_1']);
    $rev_2 = isDateEmpty($_POST['rev_2']);
    $acc = isDateEmpty($_POST['acc']);
    $status = 3;

    $note_b = isNoteEmpty($_POST['note_b']);

    $tgl = array($_POST["tgl7"], $_POST["tgl8"], $_POST["tgl9"], $_POST["tgl10"]);
    $item = array($_POST["item1"], $_POST["item2"], $_POST["item3"], $_POST["item4"], $_POST["item5"], $_POST["item6"], $_POST["item7"], $_POST["item8"], $_POST["item9"], $_POST["item10"]);
    $vAcc = array($_POST["vAcc1"], $_POST["vAcc2"], $_POST["vAcc3"], $_POST["vAcc4"], $_POST["vAcc5"], $_POST["vAcc6"], $_POST["vAcc7"], $_POST["vAcc8"], $_POST["vAcc9"], $_POST["vAcc10"]);
    $status = array($_POST["status1"], $_POST["status2"], $_POST["status3"], $_POST["status4"], $_POST["status5"], $_POST["status6"], $_POST["status7"], $_POST["status8"], $_POST["status9"], $_POST["status10"]);


    $count = 0;

    //TAMBAHAN DARI BIRO
    $baseCount2 = 0;
    $count2 = 6;

    while ($count2 < 10) {
        if ($item[$count2] == '') {
            break;
        } else {
            $row = $count2 + 1;

            $query4 = "SELECT `detail_pengajuan`.`id_detail_pengajuan` FROM `detail_pengajuan` WHERE detail_pengajuan.fid_pengajuan = '$idPengajuan' AND `detail_pengajuan`.`row` = '7'";
            $query3 = "UPDATE `sub_detail_pengajuan`, `detail_pengajuan`, `pengajuan` SET 
                            `sub_detail_pengajuan`.`tglP` = '$tgl[$baseCount2]',
                            `sub_detail_pengajuan`.`itemP` = '$item[$count2]',
                            `sub_detail_pengajuan`.`valAcc` = '$vAcc[$count2]',
                            `sub_detail_pengajuan`.`status` = '" . statItemCheck($status[$baseCount2]) . "'
                WHERE `sub_detail_pengajuan`.`fid_detail_pengajuan` = `detail_pengajuan`.`id_detail_pengajuan` 
                AND `detail_pengajuan`.`row` = '$row'
                AND `detail_pengajuan`.`fid_pengajuan` = `pengajuan`.`id_pengajuan`
                AND `pengajuan`.`id_pengajuan` = '$idPengajuan'";
            $query2 = "INSERT INTO `detail_pengajuan` VALUES (NULL,'$idPengajuan','$row')";
            if (mysqli_query($conn, $query4)->num_rows > 0) {
                // jika terdapat tambahan biro sebelumnya maka
                echo "<script>alert('Tambahan Biro Sudah ada, akan di update')</script>";
                if (mysqli_query($conn, $query3)) {
                    echo "<script>alert('UPDATE BERHASIL')</script>";
                } else {
                    echo "<script>alert('UPDATE GAGAL')</script>";
                }
            } else {
                echo "<script>alert('Tambahan Biro Belum Pernah ada')</script>";
                if (mysqli_query($conn, $query2)) {
                    $lastIdDetailPengajuan = mysqli_insert_id($conn);
                    $updateNow = date('Y-m-d H:i:s');
                    if (mysqli_query($conn, "INSERT INTO `sub_detail_pengajuan` (`id_sub_detail_pengajuan`, `fid_detail_pengajuan`, `tglP`, `itemP`, `valAcc`, `status`) 
                        VALUES (NULL, '$lastIdDetailPengajuan', '$tgl[$baseCount2]', 
                        '$item[$count2]', '$vAcc[$count2]', '$status[$count2]')")) {

                        echo "<script>alert('Item Tambahan Biro berhasil')</script>";
                    } else {
                        echo "<script>alert('Item Tambahan Biro GAGAL')</script>";
                    }
                } else {
                    echo "<script>alert('Tambahan Baru Biro GAGAL di tambahkan')</script>";
                }
            }
        }
        $count += 1;
        $count2 += 1;
        $baseCount2 += 1;
    }
}
