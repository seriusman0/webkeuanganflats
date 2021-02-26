 <?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Semua Data Surat Laporan</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($_SESSION[level]=='user_admin'){ ?>
                        <a class='btn btn-primary' href='index.php?page=laporan&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat laporan</a>
                        <a class='btn btn-info' target='BLANK' href='laporan-print.php'><i class='fa fa-print'></i> Print Surat laporan</a>
                        <a class='btn btn-success' href='laporan-excel.php'><i class='fa fa-file'></i> Export ke Excel</a>
                    <?php }elseif ($_SESSION[level]=='user_input'){ ?>
                        <a class='btn btn-primary' href='index.php?page=laporan&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat laporan</a>
                    <?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead  class='alert-success'>
                    <tr>
                        <th>No</th>
                        <th>Pengirim</th>
                        <th width='100px'>Tanggal Surat</th>
                        <th width='100px'>Masuk Agenda</th>
                        <th>No Surat</th>
                        <th>Perihal</th>
                        <th>Lokasi Arsip</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $outbox = mysqli_query($conn, "SELECT * FROM phpmu_laporan ORDER BY id_laporan ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($outbox)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[pengirim]</td>
                                    <td>".tgl_indo($i[tanggal_surat])."</td>
                                    <td>".tgl_indo($i[masuk_agenda])."</td>
                                    <td>$i[no_surat]</td>
                                    <td>$i[id_perihal]</td>
                                    <td>$i[lokasi_arsip]</td>";
                                        if ($_SESSION[level]=='user_admin'){ 
                                            echo "<td style='width:170px' class='text-right'><a class='btn' href='index.php?page=laporan&aksi=detail&id=$i[id_laporan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
                                                  <a class='btn' target='BLANK' href='laporan-print-satu.php?id=$i[id_laporan]' title='Print Surat ini'><i class='fa fa-print'></i></a>
                                                  <a class='btn' href='index.php?page=laporan&aksi=edit&id=$i[id_laporan]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=laporan&aksi=hapus&id=$i[id_laporan]' title='Hapus Surat ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"><i class='fa fa-trash-o'></i></a>";
                                        }elseif ($_SESSION[level]=='user_input'){ 
                                            echo "<td style='width:90px' class='text-right'><a class='btn' href='index.php?page=laporan&aksi=detail&id=$i[id_laporan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
                                                  <a class='btn' href='index.php?page=laporan&aksi=edit&id=$i[id_laporan]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>";
                                        }else{
                                            echo "<td style='width:50px' class='text-right'><a class='btn' href='index.php?page=laporan&aksi=detail&id=$i[id_laporan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>";
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
    mysqli_query($conn, "DELETE FROM phpmu_laporan where id_laporan='$_GET[id]'");
    echo "<script>window.alert('Data Surat Laporan Berhasil Di Hapus.');
                                window.location='laporan'</script>";

}elseif ($_GET[aksi]=='tambah'){ 
    if (isset($_POST[simpan])){
        $dir_gambar = 'surat_laporan/';
            $filename = basename($_FILES['g']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['g']['tmp_name'], $uploadfile)) {            
                         mysqli_query($conn, "INSERT INTO phpmu_laporan (pengirim, tanggal_surat, masuk_agenda, no_surat, id_perihal, disposisi, upload_file, lokasi_arsip, waktu_eksekusi, id_user)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$filename','$_POST[h]','$tanggaleks','$_SESSION[login]')");
                                       
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Laporan .');
                                window.location='laporan'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Menambahkan Data Surat Laporan.');
                                window.location='index.php?page=laporan&aksi=tambah'</script>";
                    }
                }else{
                       mysqli_query($conn, "INSERT INTO phpmu_laporan (pengirim, tanggal_surat, masuk_agenda, no_surat, id_perihal, disposisi, lokasi_arsip, waktu_eksekusi, id_user)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[h]','$tanggaleks','$_SESSION[login]')");
                                       
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Laporan .');
                                window.location='laporan'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Surat Laporan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                    	<div class="form-group">
                            <label class="col-lg-2 control-label">Pengirim</label>
                            <div class="col-lg-6">
                                <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal Surat</label>
                            <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="b" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Masuk Agenda</label>
                            <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="c" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Surat</label>
                            <div class="col-lg-6">
                                <input type="text" name="d" placeholder="" data-required="true" class="bg-focus form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Perihal</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='e' rows="3" class="form-control" data-trigger="keyup"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Disposisi</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='f' rows="3" class="form-control" data-trigger="keyup"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Cari File</label>
                            <div class="col-lg-10">
                            <input type="file" name="g" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                            <div class="col-lg-4">
                            <input type="text" name="h" placeholder="" class="bg-focus form-control" data-required="true">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_laporan where id_laporan='$_GET[id]'"));
    if (isset($_POST[update])){
    	    $dir_gambar = 'surat_laporan/';
            $filename = basename($_FILES['g']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['g']['tmp_name'], $uploadfile)) {            
                         mysqli_query($conn, "UPDATE phpmu_laporan SET pengirim			= '$_POST[a]',
                         									  tanggal_surat		= '$_POST[b]',
                         									  masuk_agenda 		= '$_POST[c]',
                         									  no_surat		    = '$_POST[d]',
                         									  id_perihal		= '$_POST[e]',
                         									  disposisi		    = '$_POST[f]',
                         									  upload_file		= '$filename',
                         									  lokasi_arsip		= '$_POST[h]' where id_laporan='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Laporan .');
                                window.location='laporan'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Update Data Surat Laporan.');
                                window.location='laporan'</script>";
                    }
                }else{
                       mysqli_query($conn, "UPDATE phpmu_laporan SET pengirim           = '$_POST[a]',
                                                              tanggal_surat     = '$_POST[b]',
                                                              masuk_agenda      = '$_POST[c]',
                                                              no_surat          = '$_POST[d]',
                                                              id_perihal        = '$_POST[e]',
                                                              disposisi         = '$_POST[f]',
                                                              lokasi_arsip      = '$_POST[h]' where id_laporan='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Laporan .');
                                window.location='laporan'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Surat Laporan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Pengirim</label>
                            <div class="col-lg-6">
                                <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control " value="<?php echo $e[pengirim]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal Surat</label>
                            <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="b" value="<?php echo $e[tanggal_surat]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Masuk Agenda</label>
                            <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="c" value="<?php echo $e[masuk_agenda]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Surat</label>
                            <div class="col-lg-6">
                                <input type="text" name="d" placeholder="" data-required="true" class="bg-focus form-control " value="<?php echo $e[no_surat]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Perihal</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='e' rows="3" class="form-control" data-trigger="keyup"><?php echo $e[disposisi]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Disposisi</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='f' rows="3" class="form-control" data-trigger="keyup"><?php echo $e[disposisi]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Ganti File</label>
                            <div class="col-lg-10">
                            <input type="file" name="g" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                            <div class="col-lg-4">
                            <input type="text" name="h" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[lokasi_arsip]; ?>">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_laporan where id_laporan='$_GET[id]'"));
    echo "<h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class='col-md-12'>
            <div class='panel panel-default'>
            <div class='panel-heading'><strong>Detail Data Surat Laporan</strong></div>
                <div class='panel-body'>
                    <form action='' class='form-horizontal' data-validate='parsley' enctype='multipart/form-data'>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Pengirim</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[pengirim]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Tanggal Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[tanggal_surat]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Masuk Agenda</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[masuk_agenda]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>No Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[no_surat]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Perihal</label>
                        <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[nama_perihal]
                        </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Disposisi</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $e[disposisi]
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
                                 <a href='download_laporan.php?file=$e[upload_file]'>Download File Surat</a>
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