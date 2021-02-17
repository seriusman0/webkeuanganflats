<?php

if (isset($_POST['simpan'])) {
    $ips = array(isEmpty($_POST["ips1"]), isEmpty($_POST["ips2"]), isEmpty($_POST["ips3"]), isEmpty($_POST["ips4"]), isEmpty($_POST["ips5"]), isEmpty($_POST["ips6"]), isEmpty($_POST["ips7"]), isEmpty($_POST["ips8"]), isEmpty($_POST["ips9"]), isEmpty($_POST["ips10"]), isEmpty($_POST["ips11"]), isEmpty($_POST["ips12"]), isEmpty($_POST["ips13"]), isEmpty($_POST["ips14"]));
    $ipk = array(isEmpty($_POST["ipk1"]), isEmpty($_POST["ipk2"]), isEmpty($_POST["ipk3"]), isEmpty($_POST["ipk4"]), isEmpty($_POST["ipk5"]), isEmpty($_POST["ipk6"]), isEmpty($_POST["ipk7"]), isEmpty($_POST["ipk8"]), isEmpty($_POST["ipk9"]), isEmpty($_POST["ipk10"]), isEmpty($_POST["ipk11"]), isEmpty($_POST["ipk12"]), isEmpty($_POST["ipk13"]), isEmpty($_POST["ipk14"]));

    $insertips = "INSERT INTO `ips` VALUES ('$_SESSION[nif]', '$_POST[ips1]', '$_POST[ips2]', '$_POST[ips3]', '$_POST[ips4]', '$_POST[ips5]', '$_POST[ips6]', '$_POST[ips7]', '$_POST[ips8]', '$_POST[ips9]', '$_POST[ips10]', '$_POST[ips11]', '$_POST[ips12]', '$_POST[ips13]', '$_POST[ips14]')";
    $insertipk = "INSERT INTO `ipk` VALUES ('$_SESSION[nif]', '$_POST[ipk1]', '$_POST[ipk2]', '$_POST[ipk3]', '$_POST[ipk4]', '$_POST[ipk5]', '$_POST[ipk6]', '$_POST[ipk7]', '$_POST[ipk8]', '$_POST[ipk9]', '$_POST[ipk10]', '$_POST[ipk11]', '$_POST[ipk12]', '$_POST[ipk13]', '$_POST[ipk14]')";

    if (mysqli_query($conn, $insertips)) {
        echo "<script>alert('Input IPS Sukses')</script>";
    } else {
        echo "<script>alert('Input IPS Gagal')</script>";
    }

    if (mysqli_query($conn, $insertipk)) {
        echo "<script>alert('Input IPK Sukses')</script>";
    } else {
        echo "<script>alert('Input IPK Gagal')</script>";
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
</head>

<body class=" ">

    <?php include 'navbar.php' ?>
    <form action="test.php" method="POST">
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
                            <input type="number" step="0.01" name="ips1" id="ips1">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk1" id="ipk1">
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <input type="number" step="0.01" name="ips2" id="ips2">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk2" id="ipk2">
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <input type="number" step="0.01" name="ips3" id="ips3">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk3" id="ipk3">
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            <input type="number" step="0.01" name="ips4" id="ips4">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk4" id="ipk4">
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>
                            <input type="number" step="0.01" name="ips5" id="ips5">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk5" id="ipk5">
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>
                            <input type="number" step="0.01" name="ips6" id="ips6">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk6" id="ipk6">
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>
                            <input type="number" step="0.01" name="ips7" id="ips7">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk7" id="ipk7">
                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>
                            <input type="number" step="0.01" name="ips8" id="ips8">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk8" id="ipk8">
                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>
                            <input type="number" step="0.01" name="ips9" id="ips9">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk9" id="ipk9">
                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>
                            <input type="number" step="0.01" name="ips10" id="ips10">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk10" id="ipk10">
                        </td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>
                            <input type="number" step="0.01" name="ips11" id="ips11">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk11" id="ipk11">
                        </td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>
                            <input type="number" step="0.01" name="ips12" id="ips12">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk12" id="ipk12">
                        </td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>
                            <input type="number" step="0.01" name="ips13" id="ips13">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk13" id="ipk13">
                        </td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>
                            <input type="number" step="0.01" name="ips14" id="ips14">
                        </td>
                        <td>
                            <input type="number" step="0.01" name="ipk14" id="ipk14">
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