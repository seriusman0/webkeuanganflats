<?php
if ($_GET['aksi'] == '') {
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_user where id_user='$_SESSION[login]'"));
    if (isset($_POST['update'])) {
        $passw = md5($_POST['b']);
        if ($_POST['b'] == '') {
            mysqli_query($conn, "UPDATE phpmu_user SET username       = '$_POST[a]',
                                                       nama_lengkap   = '$_POST[c]',
                                                       alamat_email   = '$_POST[d]',
                                                       no_telpon      = '$_POST[e]',
                                                       alamat_lengkap = '$_POST[f]' where id_user='$_SESSION[login]'");
            echo "<script>window.alert('Sukses Update Data Profile anda.');
                                    window.location='account'</script>";
        } else {
            mysqli_query($conn, "UPDATE phpmu_user SET username       = '$_POST[a]',
                                                       password       = '$passw',
                                                       nama_lengkap   = '$_POST[c]',
                                                       alamat_email   = '$_POST[d]',
                                                       no_telpon      = '$_POST[e]',
                                                       alamat_lengkap = '$_POST[f]' where id_user='$_SESSION[login]'");
            echo "<script>window.alert('Sukses Update Data Profile anda.');
                                    window.location='account'</script>";
        }
    }
    $ee = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_user where id_user='$_SESSION[login]'"));
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Informasi Data Login anda (<?php echo "Level : <b style='color:red; text-transform:capitalize'>$ee[level]</b>"; ?>)</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-4">
                            <input type="text" name="a" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e['username']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-4">
                            <input type="password" name="b" placeholder="" class="bg-focus form-control"> (<i>Kosongkan Jika Tidak Di Ganti</i>)
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                        <div class="col-lg-6">
                            <input type="text" name="c" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e['nama_lengkap']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Alamat Email</label>
                        <div class="col-lg-6">
                            <input type="email" name="d" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e['alamat_email']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">No Telpon</label>
                        <div class="col-lg-3">
                            <input type="text" name="e" placeholder="" data-required="true" class="form-control" value="<?php echo $e['no_telpon']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Alamat Lengkap</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='f' rows="5" class="form-control" data-trigger="keyup" data-rangelength="[20,1200]"><?php echo $e['alamat_lengkap']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-9 pull-right">
                            <button type="submit" name='update' class="btn btn-info">Update Data</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php } ?>

<footer id="footer">
    <div class="text-center clearfix">
        <p><small>&copy 2015 - Develop by Robby Prihandaya - www.phpmu.com</small>
            <br /><br />
            <a href="https://twitter.com/robbyprihandaya" class="btn btn-xs btn-circle btn-twitter"><i class="fa fa-twitter"></i></a>
            <a href="https://web.facebook.com/robbyprihandaya" class="btn btn-xs btn-circle btn-facebook"><i class="fa fa-facebook"></i></a>
            <a href="https://plus.google.com/106633506064864167239/posts" class="btn btn-xs btn-circle btn-gplus"><i class="fa fa-google-plus"></i></a>
        </p>
    </div>
</footer>