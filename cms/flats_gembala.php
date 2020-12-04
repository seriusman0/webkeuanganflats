<?php
if ($_GET['aksi'] == '') {
?>
    <h4 style='padding-top:15px'>Data Gembala</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class='btn btn-primary' href='index.php?page=gembala&aksi=tambah'><i class='fa fa-plus'></i> Tambah Gembala</a>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead class='alert-info'>
                        <tr>
                            <th>NIG</th>
                            <th>Nama Lengkap</th>
                            <th>Contact</th>
                            <th>Token</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $gembala = mysqli_query($conn, "SELECT * FROM gembala ORDER BY nama_gembala ASC");

                        $no = 1;
                        while ($i = mysqli_fetch_array($gembala)) {
                            echo "<tr class='gradeX'>
                                    <td width=7% align='center'>$no</td>
                                    <td width=20%>$i[nama_gembala]</td>
                                    <td width=7% align=center>$i[contact_gembala]</td>
                                    <td>$i[token_gembala]</td>
                                    <td>$i[username_gembala]</td>";
                            echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=gembala&aksi=edit&id=$i[nig]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=gembala&aksi=hapus&id=$i[nig]'  onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"  title='Hapus Gembala ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='#' title='Lihat Data Gembala'><i class='fa fa-user'></i></a>";
                            echo "</td>
                                 </tr>";
                            $no++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Basic Data Tables Example -->
<?php
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($conn, "DELETE FROM gembala where nig='$_GET[id]'");
    echo "<script>window.alert('Data gembala Berhasil Di Hapus.');
                                window.location='index.php?page=gembala'</script>";
} elseif ($_GET['aksi'] == 'tambah') {

    if (isset($_POST['simpan'])) {

        //cek apakah adayan yang sama
        $ceknig    = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gembala WHERE nif = '$_POST[gembala]'"));
        if ($ceknig > 0) {
            echo "<script>window.alert('NIG yang digunakan sudah ada.');
                        window.location='index.php?page=gembala'</script>";
        } else {

            $password = password_hash($_POST['password_gembala'], PASSWORD_DEFAULT);

            mysqli_query($conn, "INSERT INTO gembala VALUES 
                    ('$_POST[nig]', '$_POST[nama_gembala]', '$_POST[contact_gembala]', '$_POST[token_gembala]', '$_POST[username_gembala]', '$password')");
            echo "<script>window.alert('Sukses Menambahkan Gembala.');
                        window.location='index.php?page=gembala'</script>";
        }
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Gembala</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">NIG</label>
                        <div class="col-lg-4">
                            <input type="text" name="nig" max="10" placeholder="nig maks 7 character" autofocus class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                        <div class="col-lg-4">
                            <input type="text" name="nama_gembala" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Contact Gembala</label>
                        <div class="col-lg-4">
                            <input type="text" name="contact_gembala" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Token</label>
                        <div class="col-lg-4">
                            <input type="text" name="token_gembala" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-4">
                            <input type="text" name="username_gembala" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-4">
                            <input type="text" name="password_gembala" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-9 pull-right">
                            <button type="submit" name='simpan' class="btn btn-info">Simpan Data</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>

                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead class='alert-info'>
                            <tr>
                                <th>NIG</th>
                                <th>Nama Lengkap</th>
                                <th>Contact</th>
                                <th>Token</th>
                                <th>Username</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $gembala = mysqli_query($conn, "SELECT * FROM gembala ORDER BY nama_gembala ASC");

                            $no = 1;
                            while ($i = mysqli_fetch_array($gembala)) {
                                echo "<tr class='gradeX'>
                                    <td width=7% align='center'>$no</td>
                                    <td width=20%>$i[nama_gembala]</td>
                                    <td width=7% align=center>$i[contact_gembala]</td>
                                    <td>$i[token_gembala]</td>
                                    <td>$i[username_gembala]</td>";
                                echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=gembala&aksi=edit&id=$i[nig]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=gembala&aksi=hapus&id=$i[nig]'  onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"  title='Hapus Gembala ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='#' title='Lihat Data Gembala'><i class='fa fa-user'></i></a>";
                                echo "</td>
                                 </tr>";
                                $no++;
                            }
                            ?>

                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

<?php
} elseif ($_GET['aksi'] == 'edit') {
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM gembala WHERE nig = '$_GET[id]'"));

    //ambil nama kampus
    if (isset($_POST['update'])) {
        if ($_POST['password_gembala'] != '') {
            $password = password_hash($_POST['password_gembala'], PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE gembala SET
                                                                           nama_gembala   = '$_POST[nama_gembala]',
                                                                           contact_gembala   = '$_POST[contact_gembala]',
                                                                           token_gembala   = '$_POST[token_gembala]',
                                                                           username_gembala      = '$_POST[username_gembala]',
                                                                           password_gembala      = '$password'
                                                                           WHERE nig = '$_GET[id]'");
            echo "<script>window.alert('Password Di update.');</script>";
        } else {
            mysqli_query($conn, "UPDATE gembala SET
                                                                           nama_gembala   = '$_POST[nama_gembala]',
                                                                           contact_gembala   = '$_POST[contact_gembala]',
                                                                           token_gembala   = '$_POST[token_gembala]',
                                                                           username_gembala      = '$_POST[username_gembala]'
                                                                           WHERE nig = '$_GET[id]'");
            // echo "<script>window.alert('Password Masih tetap sama.');</script>";
        }
        echo "<script>window.alert('Sukses Update Data Gembala.');
                                    window.location='index.php?page=gembala'</script>";
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Gembala</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                        <div class="col-lg-4">
                            <input type="text" name="nama_gembala" value="<?= $e['nama_gembala'] ?>" autofocus placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Contact</label>
                        <div class="col-lg-4">
                            <input type="text" name="contact_gembala" value="<?= $e['contact_gembala'] ?>" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Token</label>
                        <div class="col-lg-4">
                            <input type="text" name="token_gembala" value="<?= $e['token_gembala'] ?>" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-4">
                            <input type="text" name="username_gembala" value="<?= $e['username_gembala'] ?>" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-4">
                            <input type="text" name="password_gembala" placeholder="kosongkan jika tidak ada perubahan" class="bg-focus form-control">
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
<?php }
include "footer.php";
?>