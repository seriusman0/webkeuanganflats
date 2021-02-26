 <?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Semua Data Surat Undangan</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($_SESSION[level]=='user_admin'){ ?>
                        <a class='btn btn-primary' href='index.php?page=undangan&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Undangan</a>
                        <a class='btn btn-info' target='BLANK' href='undangan-print.php'><i class='fa fa-print'></i> Print Surat Undangan</a>
                        <a class='btn btn-success' href='undangan-excel.php'><i class='fa fa-file'></i> Export ke Excel</a>
                    <?php }elseif ($_SESSION[level]=='user_input'){ ?>
                        <a class='btn btn-primary' href='index.php?page=undangan&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Undangan</a>
                    <?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead  class='alert-success'>
                    <tr>
                        <th>No</th>
                        <th>Asal Instansi</th>
                        <th>No Undangan</th>
                        <th>Tempat</th>
                        <th>Hari, Tgl, Jam</th>
                        <th>Acara</th>
                        <th>Lokasi Arsip</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $undangan = mysqli_query($conn, "SELECT * FROM phpmu_undangan ORDER BY id_undangan ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($undangan)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[asal_instansi]</td>
                                    <td>$i[no_undangan]</td>
                                    <td>$i[tempat]</td>
                                    <td>$i[hari_tanggal_jam]</td>
                                    <td>$i[acara]</td>
                                    <td>$i[lokasi_arsip]</td>";
                                        if ($_SESSION[level]=='user_admin'){ 
                                            echo "<td style='width:170px' class='text-right'><a class='btn' href='index.php?page=undangan&aksi=detail&id=$i[id_undangan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
                                                  <a class='btn' target='BLANK' href='undangan-print-satu.php?id=$i[id_undangan]' title='Print Surat ini'><i class='fa fa-print'></i></a>
                                                  <a class='btn' href='index.php?page=undangan&aksi=edit&id=$i[id_undangan]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=undangan&aksi=hapus&id=$i[id_undangan]' title='Hapus Surat ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"><i class='fa fa-trash-o'></i></a>";
                                        }elseif ($_SESSION[level]=='user_input'){ 
                                            echo "<td style='width:90px' class='text-right'><a class='btn' href='index.php?page=undangan&aksi=detail&id=$i[id_undangan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
                                                  <a class='btn' href='index.php?page=undangan&aksi=edit&id=$i[id_undangan]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>";
                                        }else{
                                            echo "<td style='width:50px' class='text-right'><a class='btn' href='index.php?page=undangan&aksi=detail&id=$i[id_undangan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>";
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
    mysqli_query($conn, "DELETE FROM phpmu_undangan where id_undangan='$_GET[id]'");
    echo "<script>window.alert('Data Surat Undangan Berhasil Di Hapus.');
                                window.location='undangan'</script>";

}elseif ($_GET[aksi]=='tambah'){ 
    if (isset($_POST[simpan])){
        $dir_gambar = 'surat_undangan/';
            $filename = basename($_FILES['h']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {            
                         mysqli_query($conn, "INSERT INTO phpmu_undangan (asal_instansi, no_undangan, tempat, hari_tanggal_jam, acara, disposisi, isi_disposisi, upload_file, lokasi_arsip, waktu_eksekusi, id_user)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]','$filename','$_POST[i]','$tanggaleks','$_SESSION[login]')");
                                       
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Undangan .');
                                window.location='undangan'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Menambahkan Data Surat Undangan.');
                                window.location='index.php?page=undangan&aksi=tambah'</script>";
                    }
                }else{
                       mysqli_query($conn, "INSERT INTO phpmu_undangan (asal_instansi, no_undangan, tempat, hari_tanggal_jam, acara, disposisi, isi_disposisi, lokasi_arsip, waktu_eksekusi, id_user)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]','$_POST[i]','$tanggaleks','$_SESSION[login]')");
                                       
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Undangan .');
                                window.location='undangan'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Surat Undangan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Asal Instansi</label>
                            <div class="col-lg-8">
                                <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control ">
                            </div>
                        </div>

                    	<div class="form-group">
                            <label class="col-lg-2 control-label">No Undangan</label>
                            <div class="col-lg-6">
                                <input type="text" name="b" placeholder="" data-required="true" class="bg-focus form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tempat</label>
                            <div class="col-lg-6">
                                <input type="text" name="c" placeholder="" data-required="true" class="bg-focus form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Hari, Tanggal, Jam</label>
                            <div class="col-lg-9">
                            <input type="text" name="d" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Acara</label>
                            <div class="col-lg-9">
                            <input type="text" name="e" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                		<div class="form-group">
                            <label class="col-lg-2 control-label">Disposisi</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='f' rows="3" class="form-control" data-trigger="keyup"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Isi Disposisi</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='g' rows="9" class="textarea form-control" data-trigger="keyup"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Cari File</label>
                            <div class="col-lg-10">
                            <input type="file" name="h" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                            <div class="col-lg-4">
                            <input type="text" name="i" placeholder="" class="bg-focus form-control" data-required="true">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_undangan where id_undangan='$_GET[id]'"));
    if (isset($_POST[update])){
    	    $dir_gambar = 'surat_undangan/';
            $filename = basename($_FILES['h']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {            
                         mysqli_query($conn, "UPDATE phpmu_undangan SET asal_instansi     = '$_POST[a]',
                                                              no_undangan       = '$_POST[b]',
                                                              tempat            = '$_POST[c]',
                                                              hari_tanggal_jam  = '$_POST[d]',
                                                              acara             = '$_POST[e]',
                                                              disposisi         = '$_POST[f]',
                                                              isi_disposisi     = '$_POST[g]',
                                                              upload_file       = '$filename',
                                                              lokasi_arsip      = '$_POST[i]' where id_undangan='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Undangan .');
                                window.location='undangan'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Update Data Surat Undangan.');
                                window.location='undangan'</script>";
                    }
                }else{
                       mysqli_query($conn, "UPDATE phpmu_undangan SET asal_instansi     = '$_POST[a]',
                                                              no_undangan       = '$_POST[b]',
                                                              tempat            = '$_POST[c]',
                                                              hari_tanggal_jam  = '$_POST[d]',
                                                              acara             = '$_POST[e]',
                                                              disposisi         = '$_POST[f]',
                                                              isi_disposisi     = '$_POST[g]',
                                                              lokasi_arsip      = '$_POST[i]' where id_undangan='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Undangan .');
                                window.location='undangan'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Surat Undangan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Asal Instansi</label>
                            <div class="col-lg-8">
                                <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e[asal_instansi]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Undangan</label>
                            <div class="col-lg-6">
                                <input type="text" name="b" placeholder="" data-required="true" class="bg-focus form-control " value="<?php echo $e[no_undangan]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tempat</label>
                            <div class="col-lg-6">
                                <input type="text" name="c" placeholder="" data-required="true" class="bg-focus form-control " value="<?php echo $e[tempat]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Hari, Tanggal, Jam</label>
                            <div class="col-lg-9">
                            <input type="text" name="d" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[hari_tanggal_jam]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Acara</label>
                            <div class="col-lg-9">
                            <input type="text" name="e" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[acara]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Disposisi</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='f' rows="3" class="form-control" data-trigger="keyup"><?php echo $e[disposisi]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Isi Disposisi</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='g' rows="9" class="textarea form-control" data-trigger="keyup"><?php echo $e[isi_disposisi]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Cari File</label>
                            <div class="col-lg-10">
                            <input type="file" name="h" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                            <div class="col-lg-4">
                            <input type="text" name="i" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[lokasi_arsip]; ?>">
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
<?php     
}elseif ($_GET[aksi]=='detail'){  
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_undangan where id_undangan='$_GET[id]'"));
    echo "<h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class='col-md-12'>
            <div class='panel panel-default'>
            <div class='panel-heading'><strong>Detail Data Surat Undangan</strong></div>
                <div class='panel-body'>
                    <form action='' class='form-horizontal' data-validate='parsley' enctype='multipart/form-data'>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Asal Instansi</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $e[asal_instansi]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>No Undangan</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[no_undangan]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Tempat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[tempat]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Hari, Tanggal, Jam</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[hari_tanggal_jam]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Acara</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[acara]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Disposisi</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[disposisi]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Isi Disposisi</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[isi_disposisi]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Lokasi Arsip</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[lokasi_arsip]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>File Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 <a href='download_undangan.php?file=$e[upload_file]'>Download File Surat</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>";
} 
?>
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