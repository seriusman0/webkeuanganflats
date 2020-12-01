<?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Keperluan Mahasiswa</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($_SESSION[level]=='user_admin' OR $_SESSION[level]=='user_owner'){ ?>
                        <a class='btn btn-primary' href='index.php?page=keperluanmhs&aksi=tambah'><i class='fa fa-plus'></i> Tambah Keperluan</a>
                    <?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th>No</th>
                        <th>Keperluan</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                            $keperluanmhs = mysqli_query($conn, "SELECT * FROM flats_keperluan_mhs ORDER BY id DESC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($keperluanmhs)){
                            echo "<tr class='gradeX'>
                                    <td width=50 >$no</td>
                                    <td>$i[keperluan]</td>";
                                            echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=keperluanmhs&aksi=edit&id=$i[id]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=keperluanmhs&aksi=hapus&id=$i[id]' title='Hapus Keperluan Ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='#' title='Keperluan Mahasiswa'><i class='fa fa-user'></i></a>";
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
    mysqli_query($conn, "DELETE FROM flats_keperluan_mhs where id='$_GET[id]'");
    echo "<script>window.alert('Keperluan Mahasiswa Berhasil Dihapus.');
                                window.location='index.php?page=keperluanmhs'</script>";

}elseif ($_GET[aksi]=='tambah'){ 

            if (isset($_POST[simpan])){
                mysqli_query($conn, "INSERT INTO flats_keperluan_mhs (keperluan) VALUES ('$_POST[keperluan]')");
                echo "<script>window.alert('Sukses Menambahkan Keperluan Mahasiswa.');
                                window.location='index.php?page=keperluanmhs'</script>";
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Keperluan Mahasiswa</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Keperluan</label>
                            <div class="col-lg-4">
                            <input type="text" name="keperluan" autofocus="true" placeholder="" class="bg-focus form-control" data-required="true">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_keperluan_mhs where id='$_GET[id]'"));
        
            if (isset($_POST[update])){
                    mysqli_query($conn, "UPDATE flats_keperluan_mhs SET keperluan ='$_POST[keperluan]' where id='$_GET[id]'");
                    echo "<script>window.alert('Sukses Update Keperluan Mahasiswa.');
                                    window.location='index.php?page=keperluanmhs'</script>";
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Keperluan Mahasiswa</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Keperluan</label>
                            <div class="col-lg-4">
                            <input type="text" name="keperluan" placeholder="" class="bg-focus form-control" data-required="true" value="<?= $e[keperluan]; ?>">
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

             