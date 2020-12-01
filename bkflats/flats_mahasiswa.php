<?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Data Nama Nama Mahasiswa Binaan Flats</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <a class='btn btn-primary' href='index.php?page=mahasiswa&aksi=tambah'><i class='fa fa-plus'></i> Tambah Mahasiswa</a>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th width="10">No</th>
                        <th>Nama Lengkap</th>
                        <th width="75">Angkatan</th>
                        <th>Kampus</th>
                        <?php if ($_SESSION[level]=='user_admin' OR $_SESSION[level]=='user_input'){ ?>
                        <th>Action</th>
                        <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if ($_SESSION[level]=='user_admin'){
                            $mahasiswa = mysqli_query($conn, "SELECT * FROM flats_mahasiswa ORDER BY nama ASC");
                        }else{
                            $mahasiswa = mysqli_query($conn, "SELECT * FROM phpmu_user where level='$level' AND unit_kerja='$_SESSION[unit]' ORDER BY id_user DESC");
                        }
                        $no = 1;
                        while ($i = mysqli_fetch_array($mahasiswa)){
                            if ($i[status] == 'Y'){ $stat = '<b style="color:green">Aktif</b>'; }else{ $stat = '<b style="color:red">Non Aktif</b>'; }
                            echo "<tr class='gradeX'>
                                    <td width=50 >$no</td>
                                    <td>$i[nama]</td>
                                    <td>$i[angkatan]</td>
                                    <td>$i[kampus]</td>";
                                        if ($_SESSION[level]=='user_admin'){ 
                                            echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=mahasiswa&aksi=edit&id=$i[id]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=mahasiswa&aksi=hapus&id=$i[id]' title='Hapus Mahasiswa ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='#' title='Lihat Data Keuangan Mahasiswa Ini'><i class='fa fa-user'></i></a>";
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
    mysqli_query($conn, "DELETE FROM flats_mahasiswa where id='$_GET[id]'");
    echo "<script>window.alert('Data User Berhasil Di Hapus.');
                                window.location='index.php?page=mahasiswa'</script>";

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
        $nkampus = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_kampus where id='$_POST[kampus]'"));    
        
            if (isset($_POST['simpan'])){
                $nama = $_POST['nama_lengkap'];
                mysqli_query($conn, "INSERT INTO flats_mahasiswa (nama, angkatan, kampus)           
                     VALUES('$nama', '$_POST[angkatan]', '$nkampus[kampus]')");
                echo "<script>window.alert('Sukses Menambahkan Data Kampus.');
                                window.location='index.php?page=mahasiswa'</script>";
            }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Mahasiswa</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                            <div class="col-lg-4">
                            <input type="text" name="nama_lengkap" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Angkatan</label>
                            <div class="col-lg-4">
                            <input type="number" min="35" name="angkatan" placeholder="" data-required="true" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">

                            <label class="col-lg-2 control-label">Kampus</label>
                            <div class="col-lg-9">
                            <?php $ambil=mysqli_query($conn, "SELECT * FROM flats_kampus ORDER BY kampus"); ?>
                            <select name='kampus' class="form-control" required="true" autofocus>
                                <option value=''></option>
                                <?php
                                while($r=mysqli_fetch_array($ambil)){ 
                                  echo "<option value=$r[id]>$r[kampus]</option>"; 
                                } ?>
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
}elseif ($_GET[aksi]=='edit'){ 
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_mahasiswa where id='$_GET[id]'"));

    //ambil nama kampus
    $nkampus = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_kampus where id='$_POST[kampus]'"));    
            if (isset($_POST[update])){
                    mysqli_query($conn, "UPDATE flats_mahasiswa SET
                                                       nama   = '$_POST[nama]',
                                                       angkatan   = '$_POST[angkatan]',
                                                       kampus      = '$nkampus[kampus]'
                                                       where id='$_GET[id]'");
                    echo "<script>window.alert('Sukses Update Data Mahasiswa.');
                                    window.location='index.php?page=mahasiswa'</script>";
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
                        <label class="col-lg-2 control-label">Nama Mahasiswa</label>
                            <div class="col-lg-4">
                            <input type="text" name="nama" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[nama]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Angkatan</label>
                            <div class="col-lg-4">
                            <input type="number" name="angkatan" placeholder="" class="bg-focus form-control" value="<?php echo $e[angkatan]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Kampus</label>
                            <div class="col-lg-9">
                            <?php $ambil=mysqli_query($conn, "SELECT * FROM flats_kampus ORDER BY id"); ?>
                            <select name='kampus' class="form-control" required="true" autofocus>
                                <option value=''></option>
                                <?php
                                while($r=mysqli_fetch_array($ambil)){ 
                                  echo "<option value=$r[id]>$r[kampus]</option>"; 
                                } ?>
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

