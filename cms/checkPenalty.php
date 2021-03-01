<?php
include "koneksi.php";
$idPengajuan = 152;
// $row = 1;


$tglP = array($_POST['tglP1'], $_POST['tglP2'], $_POST['tglP3'], $_POST['tglP4']);
$itemP = array($_POST['itemP1'], $_POST['itemP2'], $_POST['itemP3'], $_POST['itemP4']);
$valueP = array($_POST['valueP1'], $_POST['valueP2'], $_POST['valueP3'], $_POST['valueP4']);

if (isset($_POST['submit'])) {
    // $query = "INSERT INTO `penalty`
    // (`idPenalty`, `row`, `idPengajuan`, `tglPenalty`, `itemPenalty`, `valuePenalty`) 
    //     VALUES (NULL, '$row', '$idPengajuan', '$_POST[tglPenalty]', '$_POST[itemPenalty]', '$_POST[valuePenalty]')";
    // if (mysqli_query($conn, $query)) {
    //     echo "<script>alert('berhasil input penalty')</script>";
    // } else {
    //     echo "<script>alert('gagal input penalty')</script>";
    // }

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
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Input Penalty</title>
</head>

<body>
    <form action="" method="post">
        <table class="table table-striped table-bordered table-hover dataTables-example">
            <thead align="center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Catatan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="center">1</td>
                    <td><input type="date" name="tglP1" id="tglP1" class="bg-focus form-control"></td>
                    <td><input type="text" name="itemP1" id="itemP1" value="Pencapaian jurnal semester" class="bg-focus form-control"></td>
                    <td><input type="text" name="valueP1" id="valueP1" class="bg-focus form-control"></td>

                </tr>
                <tr>
                    <td align="center">2</td>
                    <td><input type="date" name="tglP2" id="tglP2" class="bg-focus form-control"></td>
                    <td><input type="text" name="itemP2" id="itemP2" value="Kelebihan hari Libur" class="bg-focus form-control"></td>
                    <td><input type="text" name="valueP2" id="valueP2" class="bg-focus form-control"></td>

                <tr>
                    <td align="center">3</td>
                    <td><input type="date" name="tglP3" id="tglP3" class="bg-focus form-control"></td>
                    <td><input type="text" name="itemP3" id="itemP3" class="bg-focus form-control"></td>
                    <td><input type="text" name="valueP3" id="valueP3" class="bg-focus form-control"></td>

                </tr>
                <tr>
                    <td align="center">4</td>
                    <td><input type="date" name="tglP4" id="tglP4" class="bg-focus form-control"></td>
                    <td><input type="text" name="itemP4" id="itemP4" class="bg-focus form-control"></td>
                    <td><input type="text" name="valueP4" id="valueP4" class="bg-focus form-control"></td>

                </tr>
            </tbody>
        </table>
        <input type="submit" name="submit" id="submit">
    </form>
</body>

</html>