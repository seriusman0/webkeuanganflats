<?php
// session_start();
cekLogin();
?>
<!doctype html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
</head>

<body class=" ">

    <?php include 'navbar.php' ?>
    <div class="main-container">
        <section class="bg--primary ">
            <div class="container">
                <div class="">
                    <div class="boxed boxed--border">

                        <div class="modal-instance">
                            <a class="btn" href="index.php?page=form_submission">
                                <span class="btn__text">
                                    ADD SUBMISSION
                                </span>
                            </a>
                            <div class="modal-container">

                            </div>
                        </div>
                        <!--end of modal instance-->
                        <div id="form_table">
                            <?php submissionTable($_SESSION["nif"]) ?>
                        </div>
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