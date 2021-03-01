<?php
include "config.php";
include "functions.php";
session_start();
if (isset($_POST['submit'])) {

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
        $lastId = mysqli_insert_id($conn);
        echo "last id = " . $lastId . " . ";
        $note_arr = array($note_c, $note_s, $note_b);
        $count = 0;
        while ($count < count($note_arr)) {
            $input_comment = "INSERT INTO note(note_fid_pengajuan, note_fill, note_by) VALUES ('$lastId', '$note_arr[$count]', '$count')";
            if (mysqli_query($conn, $input_comment)  == true) {
            }
            $count += 1;
        }

        // INPUT ITEM PENGAJUAN
        $tgl = array($_POST["tgl1"], $_POST["tgl2"], $_POST["tgl3"], $_POST["tgl4"], $_POST["tgl5"], $_POST["tgl6"], $_POST["tgl7"], $_POST["tgl8"], $_POST["tgl9"], $_POST["tgl10"]);
        $item = array($_POST["item1"], $_POST["item2"], $_POST["item3"], $_POST["item4"], $_POST["item5"], $_POST["item6"], $_POST["item7"], $_POST["item8"], $_POST["item9"], $_POST["item10"]);
        $vP = array($_POST["vP1"], $_POST["vP2"], $_POST["vP3"], $_POST["vP4"], $_POST["vP5"], $_POST["vP6"], $_POST["vP7"], $_POST["vP8"], $_POST["vP9"], $_POST["vP10"]);
        $vAcc = array($_POST["vAcc1"], $_POST["vAcc2"], $_POST["vAcc3"], $_POST["vAcc4"], $_POST["vAcc5"], $_POST["vAcc6"], $_POST["vAcc7"], $_POST["vAcc8"], $_POST["vAcc9"], $_POST["vAcc10"]);
        $status = array($_POST["status1"], $_POST["status2"], $_POST["status3"], $_POST["status4"], $_POST["status5"], $_POST["status6"], $_POST["status7"], $_POST["status8"], $_POST["status9"], $_POST["status10"]);

        $count = 0;

        while ($count < 10) {
            if ($item[$count] == '') {
                break;
            } else {
                $row = $count + 1;
                mysqli_query($conn, "INSERT INTO detail_pengajuan values (NULL,'$lastId','$row')");
                $lastIdDetailPengajuan = mysqli_insert_id($conn);
                $updateNow = date('Y-m-d H:i:s');
                mysqli_query($conn, "INSERT INTO `sub_detail_pengajuan` (`id_sub_detail_pengajuan`, `fid_detail_pengajuan`, `tglP`, `itemP`, `valP`, `valAcc`, `status`) 
                        VALUES (NULL, '$lastIdDetailPengajuan', '$tgl[$count]', 
                        '$item[$count]', '$vP[$count]', '$vAcc[$count]', '1')");
            }
            $count += 1;
        }


        // INPUT PENALTY
        $tglP = array($_POST["tglP1"], $_POST["tglP2"], $_POST["tglP3"], $_POST["tglP4"]);
        $itemP = array($_POST["itemP1"], $_POST["itemP2"], $_POST["itemP3"], $_POST["itemP4"]);
        $valueP = array($_POST["valueP1"], $_POST["valueP2"], $_POST["valueP3"], $_POST["valueP4"]);
        $idCount = 0;
        while ($idCount < 4) {
            if ($itemP[$idCount] == '') {
                break;
            } else {
                mysqli_query($conn, "INSERT INTO `penalty` (`idPenalty`, `idPengajuan`, `tglPenalty`, `itemPenalty`, `valuePenalty`, `updatePon`) 
                                                    VALUES (NULL, '$lastId','$tglP[$idCount]', '$itemP[$idCount]', '$valueP[$idCount]', NULL)");
            }
            $idCount += 1;
        }
        echo "<script>alert('Input Pengajuan Berhassil. Silakan Tunggu Proses Selanjutnya  . . . .');
            
        </script>";
    } else {
        echo "Gagal Input Pengajuan";
    }
}
