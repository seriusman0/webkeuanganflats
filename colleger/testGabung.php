<?php
include "config.php";

if (isset($_POST['submit'])) {
    // var_dump($_POST);
    $tglP = array($_POST["tglP1"], $_POST["tglP2"], $_POST["tglP3"], $_POST["tglP4"]);
    $itemP = array($_POST["itemP1"], $_POST["itemP2"], $_POST["itemP3"], $_POST["itemP4"]);
    $valueP = array($_POST["valueP1"], $_POST["valueP2"], $_POST["valueP3"], $_POST["valueP4"]);
    $lastId = 1;
    $idCount = 0;
    while ($idCount < 4) {

        echo $tglP[$idCount] . "</br>";
        echo $itemP[$idCount] . "</br>";
        echo $valueP[$idCount] . "</br>";
        echo $lastId . "</br>";


        if ($itemP[$idCount] == '') {
            break;
        } else {
            mysqli_query($conn, "INSERT INTO `penalty` (`idPenalty`, `idPengajuan`, `tglPenalty`, `itemPenalty`, `valuePenalty`, `updatePon`) 
                                                    VALUES (NULL, '$lastId','$tglP[$idCount]', '$itemP[$idCount]', '$valueP[$idCount]', NULL)");
            echo "<script>alert('berhasil upload data')</script>";
        }
        $idCount += 1;
    }
}
