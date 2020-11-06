<?php 
if (isset($_POST[login])){
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    $login=mysqli_query($conn, "SELECT * FROM flats_user
        WHERE username='$user' AND password='$pass' AND status='Y'");
    $cocok=mysqli_num_rows($login);
    $r=mysqli_fetch_array($login);

    if ($cocok > 0){
        $_SESSION[login]        = $r[id_user];
        $_SESSION[username]     = $r[username];
        $_SESSION[namalengkap]  = $r[nama_lengkap];
        $_SESSION[password]     = $r[password];
        $_SESSION[level]        = $r[level];
        $_SESSION[avatar]       = $r[foto];

        header('location:index.php');
    }else{
        echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                window.location=('index.php')</script>";
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login Web Keuangan FLATS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site Description Here">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/stack-interface.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/socicon.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/flickity.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/iconsmind.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/jquery.steps.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/theme.css" rel="stylesheet" type="text/css" media="all" />
        <link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Username" />
                                    </div>
                                    <div class="col-md-12">
                                        <input type="password" placeholder="Password" />
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn--primary type--uppercase" type="submit">Login</button>
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