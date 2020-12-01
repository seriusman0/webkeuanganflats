<?php 
    if ($_GET['aksi']==''){
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
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Username</th>
                        <th>ID</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php 
                        $user = mysqli_query($conn, "SELECT * FROM user_management ORDER BY id_user ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($user)){
                            $level = "Admin";
                            if ((intval($i['level'])) == 1) {
                                $level = "Owner";
                            }elseif((intval($i['level'])) == 3){
                                $level = "User Input";
                            }
                            echo "<tr class='gradeX'>
                                    <td width=50 >$no</td>
                                    <td>$i[full_name]</td>
                                    <td>$level</td>
                                    <td>$i[user_name]</td>
                                    <td>$i[id_user]</td>";
                            echo "<td style='width:130px' class='text-center'>
                                    <a class='btn' href='index.php?page=datauser&aksi=edit&id_user=$i[id_user]' title='Edit User Ini'><i class='fa fa-pencil-square-o'></i></a>
                                    <a class='btn' href='index.php?page=datauser&aksi=hapus&id_user=$i[id_user]'   onMouseOver=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"   title='Hapus User Ini'><i class='fa fa-trash-o'></i></a>";
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
}elseif ($_GET['aksi']=='hapus'){ 
    mysqli_query($conn, "DELETE FROM user_management WHERE id_user = '$_GET[id_user]'");
    echo "<script>window.alert('Data User Berhasil Di Hapus.');
            window.location='index.php?page=datauser'</script>";

}elseif ($_GET['aksi']=='tambah'){ 
        
            if (isset($_POST['simpan'])){
                $password = password_hash($_POST['user_pass'], PASSWORD_DEFAULT);
                 //upload gambar
                // $gambar = upload();
                // if (!$gambar) {
                //     return false;
                // }

                mysqli_query($conn, "INSERT INTO user_management          
                     VALUES('', '$_POST[user_name]', '$password', '$_POST[full_name]', '$_POST[level]', '')");
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
                            <input type="text" name="user_name" autofocus placeholder="" class="bg-focus form-control"  data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-4">
                            <input type="text" name="user_pass" autofocus placeholder="" class="bg-focus form-control"  data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Lengkap</label>
                            <div class="col-lg-4">
                            <input type="text" name="full_name" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Level</label>
                            <div class="col-lg-4">
                            <select name="level" class="form-control">
                                <option value=""></option>
                                <option value="0">Admin</option>
                                <option value="1">Owner</option>
                                <option value="3">User Input</option>
                            </select>
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
}elseif ($_GET['aksi']=='edit'){ 
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user_management where id_user='$_GET[id_user]'"));

            if (isset($_POST['update'])){
                    if($_POST['user_pass'] != ''){
                        $password = password_hash($_POST['user_pass'], PASSWORD_DEFAULT);
                        mysqli_query($conn, "UPDATE user_management SET
                                                           user_name   = '$_POST[user_name]',
                                                           user_pass   = '$password',
                                                           full_name   = '$_POST[full_name]',
                                                           level   = '$_POST[level]'
                                                           where id_user='$_GET[id_user]'");
                    }else{
                        mysqli_query($conn, "UPDATE user_management SET
                                                           user_name   = '$_POST[user_name]',
                                                           full_name   = '$_POST[full_name]',
                                                           level   = '$_POST[level]'
                                                           where id_user='$_GET[id_user]'");
                    }
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
                            <input type="text" name="user_name" value="<?= $e['user_name']; ?>" autofocus placeholder="" class="bg-focus form-control"  data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                            <div class="col-lg-4">
                            <input type="text" name="user_pass" autofocus placeholder="Kosongkan jika tidak berubah" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Lengkap</label>
                            <div class="col-lg-4">
                            <input type="text" name="full_name" value="<?= $e['full_name']; ?>" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Level</label>
                            <div class="col-lg-4">
                            <?php $qlevel = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user_management WHERE id_user = '$_GET[id_user]'")); 
                                $nlevel = 'Admin';
                                if ((intval($qlevel['level'])) == 1) {
                                    $nlevel = "Owner";
                                }elseif((intval($qlevel['level'])) == 3){
                                    $nlevel = "User Input";
                                }
                            ?>
                            <select name="level" class="form-control">
                                <option value="<?= $qlevel['level']?>"><?= $nlevel; ?></option>
                                <option value="0">Admin</option>
                                <option value="1">Owner</option>
                                <option value="3">User Input</option>
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

