<?php
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $r = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE username_mhs = '$user'");

    var_dump($_POST['username']);
    var_dump($r);
    if (mysqli_num_rows($r) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($r);
        if (password_verify($pass, $row["password_mhs"])) {
            $_SESSION["login"] = true;
            $_SESSION["name"] = $row["nama_mhs"];
            $_SESSION["nif"] = $row["nif"];
            $_SESSION["status"] = $row["status"];
            $_SESSION["repo"] = $row["repo"];
        }
        header('location:index.php');
    } else {
        echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                window.location('index.php');
            </script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include "header.php" ?>
</head>

<body class=" ">
    <a id="start"></a>
    <div class="nav-container ">
        <div class="bar bar--sm visible-xs">
            <div class="container">
                <div class="row">
                    <div class="col-3 col-md-2">
                        <a href="index.html">
                            <img class="logo logo-dark" alt="logo" src="img/flats_icon.png" />
                            <img class="logo logo-light" alt="logo" src="img/flats_icon.png" />
                        </a>
                    </div>
                    <div class="col-9 col-md-10 text-right">
                        <a href="#" class="hamburger-toggle" data-toggle-class="#menu1;hidden-xs">
                            <i class="icon icon--sm stack-interface stack-menu"></i>
                        </a>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </div>
        <!--end bar-->
        <nav id="menu1" class="bar bar--sm bar-1 hidden-xs bar--transparent bar--absolute">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-md-2 hidden-xs">
                        <div class="bar__module">
                            <a href="index.html">
                                <img class="logo logo-dark" alt="logo" src="img/flats_icon.png" />
                                <img class="logo logo-light" alt="logo" src="img/flats_icon.png" />
                            </a>
                        </div>
                        <!--end module-->
                    </div>
                    <div class="col-lg-11 col-md-12 text-right text-left-xs text-left-sm">
                        <!--end module-->
                        <div class="bar__module">
                            <a class="btn btn--sm type--uppercase" href="">
                                <span class="btn__text">
                                    As Shepherd
                                </span>
                            </a>
                            <a class="btn btn--sm btn--primary type--uppercase" href="../bkflats">
                                <span class="btn__text">
                                    As Admin
                                </span>
                            </a>
                        </div>
                        <!--end module-->
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </nav>
        <!--end bar-->
    </div>
    <div class="main-container">
        <section class="height-100 imagebg text-center" data-overlay="4">
            <div class="background-image-holder">
                <img alt="background" src="img/drone-1.jpg" />
            </div>
            <div class="container pos-vertical-center">
                <div class="row">
                    <div class="col-md-7 col-lg-5">
                        <h2>Login Your FLATS Account</h2>
                        <p class="lead">
                            Welcome, Brother and Sister
                        </p>
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" placeholder="Username" name="username" />
                                </div>
                                <div class="col-md-12">
                                    <input type="password" placeholder="Password" name="password" />
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn--primary type--uppercase" type="submit" name="login">Login</button>
                                </div>
                            </div>
                            <!--end of row-->
                        </form>
                        <!-- <span class="type--fine-print block">Dont have an account yet?
                                <a href="page-accounts-create-1.html">Create account</a>
                            </span>
                            <span class="type--fine-print block">Forgot your username or password?
                                <a href="page-accounts-recover.html">Recover account</a> -->
                        </span>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </section>
    </div>
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