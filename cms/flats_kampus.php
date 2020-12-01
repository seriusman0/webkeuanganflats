<?php 
    if ($_GET['aksi']==''){
?>
        <h4 style='padding-top:15px'>Kampus-Kampus Penyebaran Mahasiswa Binaan FLATS</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <a class='btn btn-primary' href='index.php?page=kampus&aksi=tambah'><i class='fa fa-plus'></i> Tambah Data Kampus</a>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th>No</th>
                        <th width="50%">Nama Kampus</th>
                        <th>NPSN</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $campus = mysqli_query($conn, "SELECT * FROM kampus ORDER BY nama_kampus ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($campus)){
                            
                            echo "<tr class='gradeX'>
                                    <td width=50 >$no</td>
                                    <td>$i[nama_kampus]</td>
                                    <td>$i[npsn]</td>";
                                        if ($_SESSION['level']=='0' OR $_SESSION['level']=='1'){ 
                                            echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=kampus&aksi=edit&id=$i[npsn]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=kampus&aksi=hapus&id=$i[npsn]' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"  title='Hapus Kampus ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='#' title='Mahasiswa Flats di Kampus Ini'><i class='fa fa-user'></i></a>";
                                        }else{ 
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
}elseif ($_GET['aksi']=='hapus'){ 
    mysqli_query($conn, "DELETE FROM kampus where npsn='$_GET[id]'");
    echo "<script>window.alert('Data Kampus Berhasil Di Hapus.');
            window.location='index.php?page=kampus'</script>";
}elseif ($_GET['aksi']=='tambah'){ 
        
            if (isset($_POST[simpan])){
                mysqli_query($conn, "INSERT INTO kampus           
                     VALUES('$_POST[npsn]', '$_POST[nama_kampus]')");
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
                        <label class="col-lg-2 control-label">NPSN</label>
                            <div class="col-lg-4">
                            <input type="text" name="npsn" max="6" autofocus="true" placeholder="" class="bg-focus form-control" data-required="true">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kampus where npsn='$_GET[id]'"));
        
            if (isset($_POST['update'])){
                    mysqli_query($conn, "UPDATE kampus SET nama_kampus ='$_POST[nama_kampus]', npsn ='$_POST[npsn]'

                     where npsn='$_GET[id]'");
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
                            <input type="text" name="nama_kampus" value="<?= $e['nama_kampus'] ?>" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">NPSN</label>
                            <div class="col-lg-4">
                            <input type="text" name="npsn" value="<?= $e['npsn'] ?>" max="6" autofocus="true" placeholder="" class="bg-focus form-control" data-required="true">
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

             