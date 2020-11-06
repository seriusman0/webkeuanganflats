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
        <h4 style='padding-top:15px'>Kampus Kampus Penyebaran Mahasiswa Binaan Flats</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($_SESSION[level]=='user_admin' OR $_SESSION[level]=='user_input'){ ?>
                        <a class='btn btn-primary' href='index.php?page=kampus&aksi=tambah'><i class='fa fa-plus'></i> Tambah Data Kampus</a>
                    <?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th>No</th>
                        <th>Nama Kampus</th>
                        <?php if ($_SESSION[level]=='user_admin' OR $_SESSION[level]=='user_input'){ ?>
                        <th>Action</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if ($_SESSION[level]=='user_admin'){
                            $campus = mysqli_query($conn, "SELECT * FROM flats_kampus ORDER BY id DESC");
                        }else{
                            $campus = mysqli_query($conn, "SELECT * FROM phpmu_user where level='$level' AND unit_kerja='$_SESSION[unit]' ORDER BY id_user DESC");
                        }
                        $no = 1;
                        while ($i = mysqli_fetch_array($campus)){
                            if ($i[status] == 'Y'){ $stat = '<b style="color:green">Aktif</b>'; }else{ $stat = '<b style="color:red">Non Aktif</b>'; }
                            echo "<tr class='gradeX'>
                                    <td width=50 >$no</td>
                                    <td>$i[kampus]</td>";
                                        if ($_SESSION[level]=='user_admin'){ 
                                            echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=kampus&aksi=edit&id=$i[id]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=kampus&aksi=hapus&id=$i[id]' title='Hapus Kampus ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='#' title='Mahasiswa Flats di Kampus Ini'><i class='fa fa-user'></i></a>";
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
    mysqli_query($conn, "DELETE FROM flats_kampus where id='$_GET[id]'");
    echo "<script>window.alert('Data Kampus Berhasil Di Hapus.');
                                window.location='index.php?page=kampus'</script>";

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
                mysqli_query($conn, "INSERT INTO flats_kampus (kampus)           
                     VALUES('$_POST[nama_kampus]')");
                echo "<script>window.alert('Sukses Menambahkan Data Kampus.');
                                window.location='index.php?page=kampus'</script>";
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Kampus</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Kampus</label>
                            <div class="col-lg-4">
                            <input type="text" name="nama_kampus" autofocus="true" placeholder="" class="bg-focus form-control" data-required="true">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_kampus where id='$_GET[id]'"));
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
                    mysqli_query($conn, "UPDATE flats_kampus SET kampus ='$_POST[nama_kampus]' where id='$_GET[id]'");
                    echo "<script>window.alert('Sukses Update Data Kampus.');
                                    window.location='index.php?page=kampus'</script>";
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Kampus</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Kampus</label>
                            <div class="col-lg-4">
                            <input type="text" name="nama_kampus" placeholder="" class="bg-focus form-control" data-required="true">
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

             