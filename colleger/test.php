<?php
include "config.php";
include "functions.php";
if (isset($_POST['simpan'])) {
    $checkBefore = "SELECT COUNT(ips.nif) FROM `ips` WHERE `nif` = '" . $_SESSION['nif'] . "'";
    if ((int)mysqli_num_rows(mysqli_query($conn, $checkBefore)) > 0) {
        echo "<script>alert('Data Sudah Ada, Update')</script>";
        $query = "UPDATE `ips` SET 
            `1` = '$_POST[ips1]',
            `2` = '$_POST[ips2]',
            `3` = '$_POST[ips3]',
            `4` = '$_POST[ips4]',
            `5` = '$_POST[ips5]',
            `6` = '$_POST[ips6]',
            `7` = '$_POST[ips7]',
            `8` = '$_POST[ips8]',
            `9` = '$_POST[ips9]',
            `10` = '$_POST[ips10]',
            `11` = '$_POST[ips11]',
            `12` = '$_POST[ips12]',
            `13` = '$_POST[ips13]',
            `14` = '$_POST[ips14]' WHERE `nif` = '" . $_SESSION['nif'] . "'";
        echo "<script>alert('Input Terakhir Berhasil')</script>";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Update IPS Berhasil')</script>";
        } else {
            echo "<script>alert('Input Gagal')</script>";
        }
    } else {
        echo "<script>alert('Data baru, di tambahkan')</script>";
        $query = "INSERT INTO ips VALUES ('" . $_SESSION['nif'] . "', NULL, NULL, NULL, '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Input Berhasil')</script>";
        } else {
            echo "<script>alert('Input Gagal')</script>";
        }
    }
    // mysqli_query($conn, "INSERT INTO ipk VALUES ('0420209', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");
}
