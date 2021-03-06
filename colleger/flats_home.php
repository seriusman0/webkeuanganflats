<?php
//cek login

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>FLATS Home</title>
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
  <link href="css/font-rubiklato.css" rel="stylesheet" type="text/css" media="all" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700%7CRubik:300,400,500" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class=" ">
  <?php
  if ($_SESSION["status"] == 0) { ?>
    <div class="modal-container" data-autoshow="1000">
      <div class="modal-content">
        <div class="container">
          <p>Untuk menjaga keamanan informasi Keuangan Saudara-saudari</p>
          <p>Sangat di sarankan untuk mengganti password default</p>
          <p>Password anda dienkiripsi dengan algoritma khusus yang menjamin keamanan password</p>
          <form action="insert.php" method="POST" id="newPass">
            <div class="col-md-12">
              <label>New Password :</label>
              <input type="text" name="pass1" placeholder="Type New Password Here" id="pass1" />
            </div>
            <div class="col-md-12">
              <label>Re-enter Password:</label>
              <input type="text" name="pass2" placeholder="Re-enter Password" id="pass2" />
            </div>
            <div>
              <input type="submit" value="SUBMIT" name="submit" id="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php  }  ?>
  <a id="start"></a>
  <?php include "navbar.php" ?>
  <div class="main-container">
    <section class="cover height-100 text-center imagebg parallax" data-overlay="1">
      <div class="background-image-holder">
        <img alt="background" src="img/tourism-4.jpg" />
      </div>
      <div class="container pos-vertical-center">
        <div class="row">
          <div class="col-md-12">
            <h1>Welcome To Home Page FLATS. God Bless You.</h1>



            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="boxed boxed--border col-md-6  bg--secondary boxed--lg box-shadow">
                    <h5>Keperluan Anda . . .</h5>
                    <p>
                      Pilih salah satu tombol di bawah . . .
                    </p>
                    <a class="btn btn--primary" href="index.php?page=submission">
                      <span class="btn__text">
                        SUBMISSION
                      </span>
                    </a>
                    <a class="btn btn--primary" href="index.php?page=ip">
                      <span class="btn__text">
                        UPDATE IPk/s
                      </span>
                    </a>
                  </div>
                </div>
              </div>
              <!--end of row-->
            </div>
            <!--end of container-->



            <div class="modal-instance block">
              <div class="video-play-icon modal-trigger"></div>
              <div class="modal-container">
                <div class="modal-content bg-dark" data-width="60%" data-height="60%">
                  <iframe data-src="https://www.youtube.com/embed/uvTtusQ9oRg?autoplay=1" allowfullscreen="allowfullscreen"></iframe>
                </div>
                <!--end of modal-content-->
              </div>
              <!--end of modal-container-->
            </div>
            <!--end of modal instance-->

          </div>
        </div>
        <!--end of row-->
      </div>
      <!--end of container-->
    </section>
    <section class="text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8">
            <span class="h1">Web Biro Keuangan Flats.</span>
            <p class="lead">
              Selamat pagi saudara saudari. Tuhan Yesus Memberkati
            </p>

          </div>
        </div>
        <!--end of row-->
      </div>
      <!--end of container-->
    </section>
    <section class="height-80 parallax imagebg">
      <div class="background-image-holder">
        <img alt="background" src="img/flats_landing.jpg" />
      </div>
    </section>

    <footer class="text-center space--sm footer-5 bg--dark  ">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="heading-block">
              <ul class="list-inline list--hover">
                <li>
                  <a href="#">
                    <span>Biro Keuangan Flats</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>Updates</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>What's Announce</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <span>Yayasan Kaki Dian Emas</span>
                  </a>
                </li>
              </ul>
            </div>
            <div>
              <ul class="social-list list-inline list--hover">
                <li>
                  <a href="#">
                    <i class="socicon socicon-google icon icon--xs"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="socicon socicon-twitter icon icon--xs"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="socicon socicon-facebook icon icon--xs"></i>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="socicon socicon-instagram icon icon--xs"></i>
                  </a>
                </li>
              </ul>
            </div>
            <div>
              <span class="type--fine-print">FLATS INDONESIA</span>
              <img alt="Image" class="flag" src="img/flats_icon.png" />
            </div>
            <div>
              <span class="type--fine-print"></span>
            </div>
          </div>
        </div>
        <!--end of row-->
      </div>
      <!--end of container-->
    </footer>
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
  <script>
    $(document).ready(function() {
      // Begin Aksi Insert
      $('#newPass').on("submit", function(event) {
        event.preventDefault();
        if ($('#pass1').val() != $('#pass2').val()) {
          alert("Password did't match ");
          $('#newPass')[0].reset();
        } else {
          $.ajax({
            url: "insert.php?act=upPass",
            method: "POST",
            data: $('#newPass').serialize(),
            beforeSend: function() {

              // alert("Before send");
            },
            success: function(data) {
              alert("Update Password Success. Please Re-Login. God Bless You");
              window.location = 'logout.php';
            }
          });
        }
      });
      //END Aksi Insert
    });
  </script>
</body>

</html>