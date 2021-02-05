<?php

include "config.php";
$tgl = array($_POST["tgl1"], $_POST["tgl2"], $_POST["tgl3"], $_POST["tgl4"], $_POST["tgl5"], $_POST["tgl6"], $_POST["tgl7"], $_POST["tgl8"], $_POST["tgl9"], $_POST["tgl10"]);
$item = array($_POST["item1"], $_POST["item2"], $_POST["item3"], $_POST["item4"], $_POST["item5"], $_POST["item6"], $_POST["item7"], $_POST["item8"], $_POST["item9"], $_POST["item10"]);
$vP = array($_POST["vP1"], $_POST["vP2"], $_POST["vP3"], $_POST["vP4"], $_POST["vP5"], $_POST["vP6"], $_POST["vP7"], $_POST["vP8"], $_POST["vP9"], $_POST["vP10"]);
$vAcc = array($_POST["vAcc1"], $_POST["vAcc2"], $_POST["vAcc3"], $_POST["vAcc4"], $_POST["vAcc5"], $_POST["vAcc6"], $_POST["vAcc7"], $_POST["vAcc8"], $_POST["vAcc9"], $_POST["vAcc10"]);
$status = array($_POST["status1"], $_POST["status2"], $_POST["status3"], $_POST["status4"], $_POST["status5"], $_POST["status6"], $_POST["status7"], $_POST["status8"], $_POST["status9"], $_POST["status10"]);

// var_dump($_POST);
if (isset($_POST["submit"])) {
    $count = 0;
    while ($count < 10) {
        echo ($tgl[$count] . " ");
        echo ($item[$count] . " ");
        echo ($vP[$count] . " ");
        echo ($vAcc[$count] . " ");
        echo ($status[$count] . " ");

        echo "\r\n";

        $count += 1;
    }
}
