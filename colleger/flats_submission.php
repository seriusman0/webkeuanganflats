<?php
include "functions.php";
include "config.php";
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
</head>

<body class=" ">

    <?php include 'navbar.php' ?>
    <div class="main-container">
        <section class="bg--secondary space--sm">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="boxed boxed--border">
                        <ul class="row row--list clearfix text-center">
                            <li class="col-md-3 col-6">
                                <span class="h6 type--uppercase type--fade">-------</span>
                                <span class="h3">-------</span>
                            </li>
                            <li class="col-md-3 col-6">
                                <span class="h6 type--uppercase type--fade">
                                    -------</span>
                                <span class="h3">-------</span>
                            </li>
                            <li class="col-md-3 col-6">
                                <span class="h6 type--uppercase type--fade">-------</span>
                                <span class="h3">-------</span>
                            </li>
                            <li class="col-md-3 col-6">
                                <span class="h6 type--uppercase type--fade">-------</span>
                                <span class="h3">-------</span>
                            </li>
                        </ul>
                        <div>
                            <div class="modal-instance">
                                <a class="btn modal-trigger" href="#">
                                    <span class="btn__text">
                                        ADD SUBMISSION
                                    </span>
                                </a>
                                <div class="modal-container">
                                    <div class="modal-content">
                                        <div class="boxed boxed--lg">
                                            <h2>FORM INPUT SUBMISSION</h2>
                                            <form action="insert.php" method="post" id="insert_form">
                                                <div class="input-select">
                                                    <label>Necessity:</label>
                                                    <?php $necessity = mysqli_query($conn, "SELECT id_keperluan, nama_keperluan FROM keperluan ORDER BY id_keperluan ASC"); ?>
                                                    <select id="form_necessity" name="necessity">
                                                        <option selected="" value="Default"></option>
                                                        <?php while ($i = mysqli_fetch_array($necessity)) { ?>
                                                            <option value="<?= $i['id_keperluan'] ?>"><?= $i['nama_keperluan']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-18">
                                                    <label>Description:</label>
                                                    <input type="text" name="description" id="form_desc" autocomplete="false" placeholder="describe the cost objectives" />
                                                </div>
                                                <div class="col-md-18">
                                                    <label>Value:</label>
                                                    <input type="text" name="value" id="form_value" autocomplete="false" placeholder="Money Value" />
                                                </div>
                                                <div>
                                                    <input type="submit" value="SUBMIT" name="add" id="add">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end of modal instance-->
                        </div>

                        <div class="modal-instance" hidden>
                            <a class="btn modal-trigger oke" href="#">
                                <span class="btn__text">
                                    TRIGGER MODAL
                                </span>
                            </a>
                            <div class="modal-container">
                                <div class="modal-content">
                                    <div class="boxed boxed--border" id="sub_detail">

                                    </div>
                                </div>
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

<script>
    $(document).ready(function() {
        // Begin Aksi Insert
        $('#insert_form').on("submit", function(event) {
            event.preventDefault();
            if ($('#form_necessity').val() == "") {
                alert("Mohon Isi Item Keperluan ");
            } else if ($('#form_desc').val() == '') {
                alert("Mohon Isi Deskripsi Keperluan");
            } else if ($('#form_value').val() == '') {
                alert("Mohon Isi Nilai Keperluan");
            } else {
                $.ajax({
                    url: "insert.php?act=add",
                    method: "POST",
                    data: $('#insert_form').serialize(),
                    beforeSend: function() {
                        $('#add').val("Inserting");
                    },
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        // $('#add_data_Modal').modal('hide');
                        $('#form_table').html(data);
                    }
                });
            }
        });
        //END Aksi Insert

        //Begin Tampil Detail Submission
        $(document).on('click', '.view_sub', function() {
            var sub_id = $(this).attr("id");
            $.ajax({
                url: "insert.php?act=view",
                method: "POST",
                data: {
                    sub_id: sub_id
                },
                success: function(data) {
                    $('#sub_detail').html(data);
                    $('.oke').click();
                }
            });
        });
        //End Tampil Detail Submission

        //Begin Send Submission
        $(document).on('click', '.send_sub', function() {
            var sub_id = $(this).attr("id");
            $.ajax({
                url: "insert.php?act=send",
                method: "POST",
                data: {
                    sub_id: sub_id
                },
                success: function(data) {
                    $('#form_table').html(data);
                }
            });
        });
        //End Send Submission

        //Begin Tampil Form Edit
        $(document).on('click', '.edit_data', function() {
            var employee_id = $(this).attr("id");
            $.ajax({
                url: "edit.php",
                method: "POST",
                data: {
                    employee_id: employee_id
                },
                success: function(data) {
                    $('#form_edit').html(data);
                    $('#editModal').modal('show');
                }
            });
        });
        //End Tampil Form Edit

        //Begin Aksi Delete Data
        $(document).on('click', '.delete_sub', function() {
            var sub_id = $(this).attr("id");
            $.ajax({
                url: "insert.php?act=del",
                method: "POST",
                data: {
                    sub_id: sub_id
                },
                success: function(data) {
                    $('#form_table').html(data);
                }
            });
        });
    });
    //End Aksi Delete Data
</script>

</html>