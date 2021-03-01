<?php
// session_start();
// include "config.php";
// include "functions.php";
if (isset($_POST['simpan'])) {
    $nif = $_SESSION['nif'];
    $ipsSem1 = isEmpty($_POST["ips1"]);
    $ipsSem2 = isEmpty($_POST["ips2"]);
    $ipsSem3 = isEmpty($_POST["ips3"]);
    $ipsSem4 = isEmpty($_POST["ips4"]);
    $ipsSem5 = isEmpty($_POST["ips5"]);
    $ipsSem6 = isEmpty($_POST["ips6"]);
    $ipsSem7 = isEmpty($_POST["ips7"]);
    $ipsSem8 = isEmpty($_POST["ips8"]);
    $ipsSem9 = isEmpty($_POST["ips9"]);
    $ipsSem10 = isEmpty($_POST["ips10"]);
    $ipsSem11 = isEmpty($_POST["ips11"]);
    $ipsSem12 = isEmpty($_POST["ips12"]);
    $ipsSem13 = isEmpty($_POST["ips13"]);
    $ipsSem14 = isEmpty($_POST["ips14"]);


    $ipkSem1 = isEmpty($_POST["ipk1"]);
    $ipkSem2 = isEmpty($_POST["ipk2"]);
    $ipkSem3 = isEmpty($_POST["ipk3"]);
    $ipkSem4 = isEmpty($_POST["ipk4"]);
    $ipkSem5 = isEmpty($_POST["ipk5"]);
    $ipkSem6 = isEmpty($_POST["ipk6"]);
    $ipkSem7 = isEmpty($_POST["ipk7"]);
    $ipkSem8 = isEmpty($_POST["ipk8"]);
    $ipkSem9 = isEmpty($_POST["ipk9"]);
    $ipkSem10 = isEmpty($_POST["ipk10"]);
    $ipkSem11 = isEmpty($_POST["ipk11"]);
    $ipkSem12 = isEmpty($_POST["ipk12"]);
    $ipkSem13 = isEmpty($_POST["ipk13"]);
    $ipkSem14 = isEmpty($_POST["ipk14"]);

    $queryIps1 = "INSERT INTO `ips` VALUES ('$nif', '$ipsSem1', '$ipsSem2', '$ipsSem3', '$ipsSem4', '$ipsSem5', '$ipsSem6', '$ipsSem7', '$ipsSem8', '$ipsSem9', '$ipsSem10', '$ipsSem11', '$ipsSem12', '$ipsSem13', '$ipsSem14')";
    $queryIps2 = "UPDATE `ips` SET `1` = '$ipsSem1',
            `2` = '$ipsSem2',
            `3` = '$ipsSem3',
            `4` = '$ipsSem4',
            `5` = '$ipsSem5',
            `6` = '$ipsSem6',
            `7` = '$ipsSem7',
            `8` = '$ipsSem8',
            `9` = '$ipsSem9',
            `10` = '$ipsSem10',
            `11` = '$ipsSem11',
            `12` = '$ipsSem12',
            `13` = '$ipsSem13',
            `14` = '$ipsSem14' WHERE `nif` = '$nif'";

    if (mysqli_query($conn, $queryIps1)) {
        echo "Insert Successfully";
    } else {
        if (mysqli_query($conn, $queryIps2)) {
            echo "Update berhasil";
        } else {
            echo "update gagal";
        }
    }



    $queryIpk1 = "INSERT INTO `ipk` VALUES ('$nif', '$ipkSem1', '$ipkSem2', '$ipkSem3', '$ipkSem4', '$ipkSem5', '$ipkSem6', '$ipkSem7', '$ipkSem8', '$ipkSem9', '$ipkSem10', '$ipkSem11', '$ipkSem12', '$ipkSem13', '$ipkSem14')";
    $queryIpk2 = "UPDATE `ipk` SET `1` = '$ipkSem1',
            `2` = '$ipkSem2',
            `3` = '$ipkSem3',
            `4` = '$ipkSem4',
            `5` = '$ipkSem5',
            `6` = '$ipkSem6',
            `7` = '$ipkSem7',
            `8` = '$ipkSem8',
            `9` = '$ipkSem9',
            `10` = '$ipkSem10',
            `11` = '$ipkSem11',
            `12` = '$ipkSem12',
            `13` = '$ipkSem13',
            `14` = '$ipkSem14' WHERE `nif` = '$nif'";

    if (mysqli_query($conn, $queryIpk1)) {
        echo "Insert Successfully";
    } else {
        if (mysqli_query($conn, $queryIpk2)) {
            echo "Update berhasil";
        } else {
            echo "update gagal";
        }
    }

    header('Location:index.php?page=ip');
}


?>
<!doctype html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
</head>

<body class=" ">

    <?php include 'navbar.php';
    $ambilIps = "SELECT * FROM `ips` WHERE `nif` = '" . $_SESSION['nif'] . "'";
    $catchIps = mysqli_fetch_array(mysqli_query($conn, $ambilIps));

    $ambilIpk = "SELECT * FROM `ipk` WHERE `nif` = '" . $_SESSION['nif'] . "'";
    $catchIpk = mysqli_fetch_array(mysqli_query($conn, $ambilIpk));

    ?>
    <form action="" method="POST">
        <div class="container">
            <article class="masonry__item" data-masonry-filter="Announcements">
                <div class="article__title text-center">
                    <a href="#">
                        <h2>Update IPK dan IPS</h2>
                    </a>
                </div>
                <!--end article title-->
                <div class="article__body">
                    <h1><?= $_SESSION['name'] ?></h1>
                    <p>
                        Silakan Update IPK dan IPS di Kolom di bawah ini.
                        <kp>
                </div>
            </article>
            <!--end item-->
            <table class="border--round table--alternate-row">
                <thead align="center">
                    <tr>
                        <th width="50%">Semester</th>
                        <th width="120px">IPs</th>
                        <th width="120px">IPk</th>
                    </tr>
                </thead>
                <tbody align="center">
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips1" value="<?= $catchIps['1'] ?>" id="ips1">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk1" value="<?= $catchIpk['1'] ?>" id="ipk1">
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips2" value="<?= $catchIps['2'] ?>" id="ips2">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk2" value="<?= $catchIpk['2'] ?>" id="ipk2">
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips3" value="<?= $catchIps['3'] ?>" id="ips3">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk3" value="<?= $catchIpk['3'] ?>" id="ipk3">
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips4" value="<?= $catchIps['4'] ?>" id="ips4">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk4" value="<?= $catchIpk['4'] ?>" id="ipk4">
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips5" value="<?= $catchIps['5'] ?>" id="ips5">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk5" value="<?= $catchIpk['5'] ?>" id="ipk5">
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips6" value="<?= $catchIps['6'] ?>" id="ips6">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk6" value="<?= $catchIpk['6'] ?>" id="ipk6">
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips7" value="<?= $catchIps['7'] ?>" id="ips7">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk7" value="<?= $catchIpk['7'] ?>" id="ipk7">
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips8" value="<?= $catchIps['8'] ?>" id="ips8">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk8" value="<?= $catchIpk['8'] ?>" id="ipk8">
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips9" value="<?= $catchIps['9'] ?>" id="ips9">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk9" value="<?= $catchIpk['9'] ?>" id="ipk9">
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips10" value="<?= $catchIps['10'] ?>" id="ips10">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk10" value="<?= $catchIpk['10'] ?>" id="ipk10">
                        </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips11" value="<?= $catchIps['11'] ?>" id="ips11">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk11" value="<?= $catchIpk['11'] ?>" id="ipk11">
                        </td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips12" value="<?= $catchIps['12'] ?>" id="ips12">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk12" value="<?= $catchIpk['12'] ?>" id="ipk12">
                        </td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips13" value="<?= $catchIps['13'] ?>" id="ips13">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk13" value="<?= $catchIpk['13'] ?>" id="ipk13">
                        </td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ips14" value="<?= $catchIps['14'] ?>" id="ips14">
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" max="4" name="ipk14" value="<?= $catchIpk['14'] ?>" id="ipk14">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="submit" name="simpan" id="simpan" value="SIMPAN">
    </form>


    <!--<div class="loader"></div>-->
    <a class="back-to-top inner-link" href="#start" data-scroll-class="100vh:active">
        <i class="stack-interface stack-up-open-big"></i>
    </a>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/flickity.min.js"></script>
    <script src="js/easypiechart.min.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/typed.min.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/ytplayer.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/granim.min.js"></script>
    <script src="js/jquery.steps.min.js"></script>
    <script src="js/countdown.min.js"></script>
    <script src="js/twitterfetcher.min.js"></script>
    <script src="js/spectragram.min.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>