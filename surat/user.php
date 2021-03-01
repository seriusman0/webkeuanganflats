<?php 
    if ($_GET[aksi]==''){

        if ($_GET[stat]=='1'){
            $status = 'User Biasa';
            $level = 'user_biasa';
        }elseif ($_GET[stat]=='2'){
            $status = 'User Input';
            $level = 'user_input';
        }else{
            $status = 'User Admin';
            $level = 'user_admin';
        }
?>
        <h4 style='padding-top:15px'>Semua Data User <?php echo $status; ?></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($_SESSION[level]=='user_admin' OR $_SESSION[level]=='user_input'){ ?>
                        <a class='btn btn-primary' href='index.php?page=user&stat=<?php echo $_GET[stat]; ?>&aksi=tambah'><i class='fa fa-plus'></i> Tambah <?php echo $status; ?></a>
                    <?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat Email</th>
                        <th>No Telpon</th>
                        <th>Alamat Lengkap</th>
                        <th>Unit</th>
                        <th>Status</th>
                        <?php if ($_SESSION[level]=='user_admin' OR $_SESSION[level]=='user_input'){ ?>
                        <th>Action</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if ($_SESSION[unit]=='0'){
                            $inbox = mysqli_query($conn, "SELECT * FROM phpmu_user where level='$level' ORDER BY id_user DESC");
                        }else{
                            $inbox = mysqli_query($conn, "SELECT * FROM phpmu_user where level='$level' AND unit_kerja='$_SESSION[unit]' ORDER BY id_user DESC");
                        }
                        $no = 1;
                        while ($i = mysqli_fetch_array($inbox)){
                            if ($i[status] == 'Y'){ $stat = '<b style="color:green">Aktif</b>'; }else{ $stat = '<b style="color:red">Non Aktif</b>'; }
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama_lengkap]</td>
                                    <td>$i[alamat_email]</td>
                                    <td>$i[no_telpon]</td>
                                    <td>$i[alamat_lengkap]</td>
                                    <td>$i[unit_kerja]</td>
                                    <td>$stat</td>";
                                        if ($_SESSION[level]=='user_admin'){ 
                                            echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=user&stat=$_GET[stat]&aksi=edit&id=$i[id_user]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=user&stat=$_GET[stat]&aksi=hapus&id=$i[id_user]' title='Hapus User ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='index.php?page=user&stat=$_GET[stat]&aksi=aktif&id=$i[id_user]&akt=$i[status]' title='Aktifkan atau Non Aktifkan User ini'><i class='fa fa-user'></i></a>";
                                        }elseif ($_SESSION[level]=='user_input'){ 
                                            echo "<td style='width:45px' class='text-right'><a class='btn' href='index.php?page=user&stat=$_GET[stat]&aksi=edit&id=$i[id_user]'><i class='fa fa-pencil-square-o'></i></a>";
                                        }
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
}elseif ($_GET[aksi]=='hapus'){ 
    mysqli_query($conn, "DELETE FROM phpmu_user where id_user='$_GET[id]'");
    echo "<script>window.alert('Data User Berhasil Di Hapus.');
                                window.location='index.php?page=user&stat=$_GET[stat]'</script>";

}elseif ($_GET[aksi]=='aktif'){ 
    if ($_GET[akt]=='N'){
        $status = 'Y';
        $aktiv = 'Aktifkan';
    }else{
        $status = 'N';
        $aktiv = 'Non Aktifkan';
    }
    mysqli_query($conn, "UPDATE phpmu_user SET status='$status' where id_user='$_GET[id]'");
    echo "<script>window.alert('Data User Berhasil Di $aktiv.');
                                window.location='index.php?page=user&stat=$_GET[stat]'</script>";

}elseif ($_GET[aksi]=='tambah'){ 
        if ($_GET[stat]=='1'){
            $status = 'User Biasa';
            $level = 'user_biasa';
        }elseif ($_GET[stat]=='2'){
            $status = 'User Input';
            $level = 'user_input';
        }else{
            $status = 'User Admin';
            $level = 'user_admin';
        }
            if (isset($_POST[simpan])){
                $passw = md5($_POST[b]);
                mysqli_query($conn, "INSERT INTO phpmu_user (username, password, nama_lengkap, alamat_email, no_telpon, alamat_lengkap, level, status, waktu_daftar, unit_kerja)           
                     VALUES('$_POST[a]','$passw','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$level','Y','$tanggaleks','$_POST[unit]')");
                echo "<script>window.alert('Sukses Menambahkan Data $status.');
                                window.location='index.php?page=user&stat=$_GET[stat]'</script>";
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data <?php echo $status; ?></strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                            <div class="col-lg-4">
                            <input type="text" name="a" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-4">
                            <input type="password" name="b" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Lengkap</label>
                            <div class="col-lg-6">
                            <input type="text" name="c" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat Email</label>
                            <div class="col-lg-6">
                            <input type="email" name="d" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Telpon</label>
                            <div class="col-lg-3">
                            <input type="text" name="e" placeholder="" data-required="true" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat Lengkap</label>
                            <div class="col-lg-8">
                            <textarea placeholder="" name='f' rows="5" class="form-control" data-trigger="keyup" data-rangelength="[20,1200]"></textarea>
                            </div>
                        </div>

                        <?php if ($_SESSION[unit] == '0'){ ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Unit Kerja</label>
                            <div class="col-lg-4">
                            <select name='unit' class="form-control">
                                <option value=''>- Pilih Unit Kerja -</option>
                                <option value='A'>Unit Kerja A</option>
                                <option value='B'>Unit Kerja B</option>
                                <option value='C'>Unit Kerja C</option>
                                <option value='D'>Unit Kerja D</option>
                                <option value='E'>Unit Kerja E</option>
                                <option value='F'>Unit Kerja F</option>
                                <option value='G'>Unit Kerja G</option>
                            </select>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Unit Kerja</label>
                            <div class="col-lg-4">
                            <select name='unit' class="form-control">
                                <option value='<?php echo $_SESSION[unit]; ?>'>Unit Kerja <?php echo $_SESSION[unit]; ?></option>
                            </select>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                            <div class="col-lg-9 pull-right">    
                            <button type="submit" name='simpan' class="btn btn-info">Simpan Data</button>                  
                            <button type="reset" class="btn btn-default">Reset</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>

<?php 
}elseif ($_GET[aksi]=='edit'){ 
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_user where id_user='$_GET[id]'"));
        if ($_GET[stat]=='1'){
            $status = 'User Biasa';
            $level = 'user_biasa';
        }elseif ($_GET[stat]=='2'){
            $status = 'User Input';
            $level = 'user_input';
        }else{
            $status = 'User Admin';
            $level = 'user_admin';
        }
            if (isset($_POST[update])){
                $passw = md5($_POST[b]);
                if ($_POST[b] == ''){
                    mysqli_query($conn, "UPDATE phpmu_user SET username       = '$_POST[a]',
                                                       nama_lengkap   = '$_POST[c]',
                                                       alamat_email   = '$_POST[d]',
                                                       no_telpon      = '$_POST[e]',
                                                       alamat_lengkap = '$_POST[f]',
                                                       unit_kerja     = '$_POST[unit]' where id_user='$_GET[id]'");
                    echo "<script>window.alert('Sukses Update Data $status.');
                                    window.location='index.php?page=user&stat=$_GET[stat]'</script>";
                }else{
                    mysqli_query($conn, "UPDATE phpmu_user SET username       = '$_POST[a]',
                                                       password       = '$passw',
                                                       nama_lengkap   = '$_POST[c]',
                                                       alamat_email   = '$_POST[d]',
                                                       no_telpon      = '$_POST[e]',
                                                       alamat_lengkap = '$_POST[f]',
                                                       unit_kerja     = '$_POST[unit]' where id_user='$_GET[id]'");
                    echo "<script>window.alert('Sukses Update Data $status.');
                                    window.location='index.php?page=user&stat=$_GET[stat]'</script>";
                }
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data <?php echo $status; ?></strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                            <div class="col-lg-4">
                            <input type="text" name="a" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[username]; ?>">
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
                            <input type="text" name="c" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e[nama_lengkap]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat Email</label>
                            <div class="col-lg-6">
                            <input type="email" name="d" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e[alamat_email]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Telpon</label>
                            <div class="col-lg-3">
                            <input type="text" name="e" placeholder="" data-required="true" class="form-control" value="<?php echo $e[no_telpon]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat Lengkap</label>
                            <div class="col-lg-8">
                            <textarea placeholder="" name='f' rows="5" class="form-control" data-trigger="keyup" data-rangelength="[20,1200]"><?php echo $e[alamat_lengkap]; ?></textarea>
                            </div>
                        </div>
                        <?php if ($_SESSION[unit] == '0'){ ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Unit Kerja</label>
                            <div class="col-lg-4">
                            <select name='unit' class="form-control">
                                <option value='<?php echo $e[unit_kerja]; ?>'>Unit Kerja <?php echo $e[unit_kerja]; ?></option>
                                <option value='A'>Unit Kerja A</option>
                                <option value='B'>Unit Kerja B</option>
                                <option value='C'>Unit Kerja C</option>
                                <option value='D'>Unit Kerja D</option>
                                <option value='E'>Unit Kerja E</option>
                                <option value='F'>Unit Kerja F</option>
                                <option value='G'>Unit Kerja G</option>
                            </select>
                            </div>
                        </div>
                        <?php }else{ ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Unit Kerja</label>
                            <div class="col-lg-4">
                            <select name='unit' class="form-control">
                                <option value='<?php echo $_SESSION[unit]; ?>'>Unit Kerja <?php echo $_SESSION[unit]; ?></option>
                            </select>
                            </div>
                        </div>
                        <?php } ?>
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