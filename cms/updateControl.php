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
    $status1 = 3;

    $note_b = isNoteEmpty($_POST['note_b']);

    $tgl = array($_POST["tgl7"], $_POST["tgl8"], $_POST["tgl9"], $_POST["tgl10"]);
    $item = array($_POST["item1"], $_POST["item2"], $_POST["item3"], $_POST["item4"], $_POST["item5"], $_POST["item6"], $_POST["item7"], $_POST["item8"], $_POST["item9"], $_POST["item10"]);
    $vAcc = array($_POST["vAcc1"], $_POST["vAcc2"], $_POST["vAcc3"], $_POST["vAcc4"], $_POST["vAcc5"], $_POST["vAcc6"], $_POST["vAcc7"], $_POST["vAcc8"], $_POST["vAcc9"], $_POST["vAcc10"]);
    $status = array($_POST["status1"], $_POST["status2"], $_POST["status3"], $_POST["status4"], $_POST["status5"], $_POST["status6"], $_POST["status7"], $_POST["status8"], $_POST["status9"], $_POST["status10"]);

    $tglP = array($_POST['tglP1'], $_POST['tglP2'], $_POST['tglP3'], $_POST['tglP4']);
    $itemP = array($_POST['itemP1'], $_POST['itemP2'], $_POST['itemP3'], $_POST['itemP4']);
    $valueP = array($_POST['valueP1'], $_POST['valueP2'], $_POST['valueP3'], $_POST['valueP4']);


    $count = 0;

    //UPDATE NILAI ACC TERHADAP ITEM PENGAJUAN
    while ($count < 6) {
        if ($item[$count] == '') {
            // echo "<script>alert('count = '$count)</script>";
            break;
        } else {
            $row = $count + 1;
            $tmpStr = "UPDATE `sub_detail_pengajuan`, `detail_pengajuan`, `pengajuan` SET 
            `sub_detail_pengajuan`.`valAcc` = '$vAcc[$count]', 
            `sub_detail_pengajuan`.`status` = '" . statItemCheck($status[$count]) . "'
            WHERE `sub_detail_pengajuan`.`fid_detail_pengajuan` = detail_pengajuan.id_detail_pengajuan 
            AND detail_pengajuan.fid_pengajuan = pengajuan.id_pengajuan 
            AND pengajuan.id_pengajuan='$idPengajuan' 
            AND detail_pengajuan.row = '$row'";
            mysqli_query($conn, $tmpStr);
        }
        $count += 1;
    }

    //UPDATE TAMBAHAN DARI BIRO TERHADAP PENGAJUAN MAHASISWA
    $baseCount2 = 0;
    $count2 = 6;

    while ($count2 < 10) {
        if ($item[$count2] == '') {
            // echo "<script>alert('item kosong')</script>";
            break;
        } else {
            $row = $count2 + 1;

            $query4 = "SELECT `detail_pengajuan`.`id_detail_pengajuan` FROM `detail_pengajuan` WHERE `detail_pengajuan`.`fid_pengajuan` = '$idPengajuan' AND `detail_pengajuan`.`row` = '$row'";
            $query3 = "UPDATE `sub_detail_pengajuan`, `detail_pengajuan`, `pengajuan` SET 
                            `sub_detail_pengajuan`.`tglP` = '$tgl[$baseCount2]',
                            `sub_detail_pengajuan`.`itemP` = '$item[$count2]',
                            `sub_detail_pengajuan`.`valAcc` = '$vAcc[$count2]',
                            `sub_detail_pengajuan`.`status` = '" . statItemCheck($status[$count2]) . "'
                WHERE `sub_detail_pengajuan`.`fid_detail_pengajuan` = `detail_pengajuan`.`id_detail_pengajuan` 
                AND `detail_pengajuan`.`row` = '$row'
                AND `detail_pengajuan`.`fid_pengajuan` = `pengajuan`.`id_pengajuan`
                AND `pengajuan`.`id_pengajuan` = '$idPengajuan'";
            $query2 = "INSERT INTO `detail_pengajuan` VALUES (NULL,'$idPengajuan','$row')";
            if (mysqli_query($conn, $query4)->num_rows > 0) {
                // jika terdapat tambahan biro sebelumnya maka
                // echo "<script>alert('Tambahan Biro Sudah ada, akan di update')</script>";
                if (mysqli_query($conn, $query3)) {
                    // echo "<script>alert('UPDATE BERHASIL')</script>";
                } else {
                    // echo "<script>alert('UPDATE GAGAL')</script>";
                }
            } else {
                // echo "<script>alert('Tambahan Biro Belum Pernah ada')</script>";
                if (mysqli_query($conn, $query2)) {
                    $lastIdDetailPengajuan = mysqli_insert_id($conn);
                    $updateNow = date('Y-m-d H:i:s');
                    if (mysqli_query($conn, "INSERT INTO `sub_detail_pengajuan` (`id_sub_detail_pengajuan`, `fid_detail_pengajuan`, `tglP`, `itemP`, `valAcc`, `status`) 
                        VALUES (NULL, '$lastIdDetailPengajuan', '$tgl[$baseCount2]', 
                        '$item[$count2]', '$vAcc[$count2]', '$status[$count2]')")) {

                        // echo "<script>alert('Item Tambahan Biro berhasil dengan id = '$lastIdDetailPengajuan)</script>";
                    } else {
                        // echo "<script>alert('Item Tambahan Biro GAGAL')</script>";
                    }
                } else {
                    // echo "<script>alert('Tambahan Baru Biro GAGAL di tambahkan')</script>";
                }
            }
        }
        // $count += 1;
        $count2 += 1;
        $baseCount2 += 1;
    }

    // UPDATE PENALTY

    $countPenalty = 0;
    while ($countPenalty < 4) {
        $rowPenalty = $countPenalty + 1;
        $lihat = "SELECT idPenalty FROM `penalty` WHERE `penalty`.`idPengajuan` = '$idPengajuan' AND `penalty`.`row` = '$rowPenalty'";
        $updatePenalty = "UPDATE `penalty` SET `tglPenalty` = '$tglP[$countPenalty]',
                                                `itemPenalty` = '$itemP[$countPenalty]',
                                                `valuePenalty` = '$valueP[$countPenalty]'
                        WHERE `penalty`.`idPengajuan` = '$idPengajuan' AND `penalty`.`row`='$rowPenalty'";
        $insertPenalty = "INSERT INTO `penalty` VALUES (NULL, '$rowPenalty', '$idPengajuan', '$tglP[$countPenalty]', '$itemP[$countPenalty]', '$valueP[$countPenalty]', NULL)";
        if ($itemP[$countPenalty] != '') {
            if (mysqli_query($conn, $lihat)->num_rows > 0) {
                echo "<script>alert('Item Penalty Sudah ada, akan di update')</script>";
                if (mysqli_query($conn, $updatePenalty)) {
                    echo "<script>alert('UPDATE PENALTY BERHASIL')</script>";
                } else {
                    echo "<script>alert('UPDATE GAGAL')</script>";
                }
            } else {
                if (mysqli_query($conn, $insertPenalty)) {
                    echo "<script>alert('INSERT PENALTY BERHASIL')</script>";
                } else {
                    echo "<script>alert('INSERT PENALTY GAGAL')</script>";
                }
            }
        } else {
            echo "<script>alert('ITEM KOSONG')</script>";
        }
        $countPenalty += 1;
    }





    //UPDATE INFO PENGAJUAN TERLEBIH DAHULU
    $query1 = "UPDATE `pengajuan` SET 
                `tgl_sub` = '$tgl_sub', 
                `rev_1` = '$rev_1', 
                `rev_2` = '$rev_2', 
                `acc` = '$acc',
                `status`= '$status1'
    WHERE pengajuan.id_pengajuan = '$idPengajuan'";
    $updateNow = date('Y-m-d H:i:s');
    if (mysqli_query($conn, $query1)) {
        echo "<script>alert('Berhasil Update Info Pengajuan')</script>";
        $query4 = "SELECT note.note_id FROM note WHERE note.note_fid_pengajuan = '$idPengajuan' AND note.note_by = 2";
        $query3 = "UPDATE note SET note.note_fill = '$note_b',
                                    note.note_update_at = '$updateNow' WHERE note.note_fid_pengajuan = '$idPengajuan' AND note.note_by = 2";
        $query2 = "INSERT INTO note VALUES (NULL, '$idPengajuan', '$note_b', '2', '$updateNow')";
        if (mysqli_query($conn, $query4)->num_rows > 0) {
            echo "<script>alert('Comment Biro Sudah ada, akan di update')</script>";
            mysqli_query($conn, $query3);
        } else {
            echo "<script>alert('Comment Biro Tidak Pernah Akan di tambahkan')</script>";
            if (mysqli_query($conn, $query2)) {
                echo "<script>alert('Comment Baru Biro Sudah di tambahkan')</script>";
            } else {
                echo "<script>alert('Comment Baru Biro GAGAL di tambahkan')</script>";
            }
        }
    } else {
        echo "<script>alert('GAGAL UPDATE INFO PENGAJUAN, MOHON PERIKSA KEMBALI KELENGKAPAN FORM')</script>";
    }
    // header('location:index.php?page=pengajuanmhs&aksi=edit&id=' . $idPengajuan);
}
