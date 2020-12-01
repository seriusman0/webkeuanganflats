<?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Data User</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <a class='btn btn-primary' href='index.php?page=datauser&aksi=tambah'><i class='fa fa-plus'></i> Tambah User</a>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th width="10">No</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Alamat Lengkap</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php 
                        $mahasiswa = mysqli_query($conn, "SELECT * FROM flats_user ORDER BY id_user ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($mahasiswa)){
                            echo "<tr class='gradeX'>
                                    <td width=50 >$no</td>
                                    <td>$i[username]</td>
                                    <td>$i[nama_lengkap]</td>
                                    <td>$i[alamat_email]</td>
                                    <td>$i[no_telepon]</td>
                                    <td>$i[alamat_lengkap]</td>
                                    <td>$i[level]</td>
                                    <td>$i[status]</td>";
                                            echo "<td style='width:130px' class='text-center'>
                                                    <a class='btn' href='index.php?page=datauser&aksi=edit&id_user=$i[id_user]' title='Edit User Ini'><i class='fa fa-pencil-square-o'></i></a>
                                                    <a class='btn' href='index.php?page=datauser&aksi=hapus&id_user=$i[id_user]' title='Hapus User Ini'><i class='fa fa-trash-o'></i></a>";
                                        
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
    mysqli_query($conn, "DELETE FROM flats_user WHERE id_user='$_GET[id_user]'");
    echo "<script>window.alert('Data User Berhasil Di Hapus.');
                                window.location='index.php?page=datauser'</script>";
}elseif ($_GET[aksi]=='tambah'){ 
        
            if (isset($_POST['simpan'])){
             
                 //upload gambar
                $gambar = upload();
                if (!$gambar) {
                    return false;
                }

                 mysqli_query($conn, "INSERT INTO flats_user (username, password, nama_lengkap, alamat_email, no_telepon, alamat_lengkap, level, status, foto)           
                     VALUES('$_POST[username]', md5('$_POST[password]'), '$_POST[nama_lengkap]', '$_POST[email]', '$_POST[no_telepon]', '$_POST[alamat_lengkap]', '$_POST[level]', '$_POST[status]', '$gambar')");
                echo "<script>window.alert('Sukses Menambahkan Data User.');
                                window.location='index.php?page=datauser'</script>";
                
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan User</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                            <div class="col-lg-4">
                            <input type="text" name="username" autofocus placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-4">
                            <input type="text" min="8" name="password" placeholder="Hati-Hati, password hanya bisa diisi sekali" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Lengkap</label>
                            <div class="col-lg-4">
                            <input type="text" name="nama_lengkap" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-4">
                            <i><input type="email" name="email" placeholder="example@email.com" data-required="true" class="bg-focus form-control"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Telp</label>
                            <div class="col-lg-4">
                            <input type="text" max="13" name="no_telepon" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat Lengkap</label>
                            <div class="col-lg-4">
                            <input type="text" name="alamat_lengkap" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Level</label>
                            <div class="col-lg-9">
                            <select name='level' class="form-control">
                                <option value='user_admin'> Admin </option>
                                <option value='user_owner'> Owner </option>
                                <option value='user_input'> Input </option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Status</label>
                            <div class="col-lg-9">
                            <select name='status' class="form-control">
                                <option value='Y'> Aktif </option>
                                <option value='N'> Nonaktif </option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Foto</label>
                            <div class="col-lg-10">
                            <input type="file" name="gambar" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_user where id_user='$_GET[id_user]'"));

            if (isset($_POST[update])){
                    mysqli_query($conn, "UPDATE flats_user SET
                                                       username   = '$_POST[username]',
                                                       nama_lengkap   = '$_POST[nama_lengkap]',
                                                       alamat_email   = '$_POST[email]',
                                                       no_telepon   = '$_POST[no_telepon]',
                                                       alamat_lengkap   = '$_POST[alamat_lengkap]',
                                                       level   = '$_POST[level]',
                                                       status   = '$_POST[status]'
                                                       where id_user='$_GET[id_user]'");
                    echo "<script>window.alert('Sukses Update Data User.');
                                    window.location='index.php?page=datauser'</script>";
            }

?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Mahasiswa</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                            <div class="col-lg-4">
                            <input type="text" name="username" autofocus placeholder="" class="bg-focus form-control" value="<?= $e[username]; ?>" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Lengkap</label>
                            <div class="col-lg-4">
                            <input type="text" name="nama_lengkap" placeholder="" data-required="true" class="bg-focus form-control" value="<?= $e[nama_lengkap]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-4">
                            <i><input type="email" name="email" placeholder="example@email.com" data-required="true" class="bg-focus form-control" value="<?= $e[alamat_email]; ?>"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Telp</label>
                            <div class="col-lg-4">
                            <input type="text" max="13" name="no_telepon" placeholder="" data-required="true" class="bg-focus form-control" value="<?= $e[no_telepon]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Alamat Lengkap</label>
                            <div class="col-lg-4">
                            <input type="text" name="alamat_lengkap" placeholder="" data-required="true" class="bg-focus form-control" value="<?= $e[alamat_lengkap]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Level</label>
                            <div class="col-lg-9">
                            <select name='level' class="form-control">
                                <option value="<?= $e[level]; ?>">old level</option>
                                <option value='user_admin'> Admin </option>
                                <option value='user_owner'> Owner </option>
                                <option value='user_input'> Input </option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Status</label>
                            <div class="col-lg-9">
                            <select name='status' class="form-control">
                                <option value="<?= $e[status]; ?>">old status</option>
                                <option value='Y'> Aktif </option>
                                <option value='N'> Nonaktif </option>
                            </select>
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

