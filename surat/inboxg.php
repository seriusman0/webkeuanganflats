<?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Semua Data Surat Masuk</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<?php if ($_SESSION[level]=='user_admin'){ ?>
                    	<a class='btn btn-primary' href='index.php?page=inboxg&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Masuk</a>
                    	<a class='btn btn-info' target='BLANK' href='inboxg-print.php'><i class='fa fa-print'></i> Print Surat Masuk</a>
    					<a class='btn btn-success' href='inboxg-excel.php'><i class='fa fa-file'></i> Export ke Excel</a>
                	<?php }elseif ($_SESSION[level]=='user_input'){ ?>
                		<a class='btn btn-primary' href='index.php?page=inboxg&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Masuk</a>
                	<?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th>No</th>
                        <th>No. Surat</th>
                        <th width='100px'>Tanggal Surat</th>
                        <th width='100px'>Tanggal Agenda</th>
                        <th>Pengirim</th>
                        <th>Lamp.</th>
                        <th>Nama Penerima</th>
                        <th>Unit</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $inbox = mysqli_query($conn, "SELECT a.* FROM phpmu_inbox_g a ORDER BY a.id_inbox ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($inbox)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[no_surat]</td>
                                    <td>".tgl_indo($i[tanggal_surat])."</td>
                                    <td>".tgl_indo($i[tanggal_masuk_agenda])."</td>
                                    <td>$i[pengirim]</td>
                                    <td>$i[lampiran]</td>
                                    <td>$i[nama_penerima]</td>
                                    <td>$i[unit_kerja]</td>";
                                    	if ($_SESSION[level]=='user_admin'){ 
	                                        echo "<td style='width:170px' class='text-right'><a class='btn' href='index.php?page=inboxg&aksi=detail&id=$i[id_inbox]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
	                                        	  <a class='btn' target='BLANK' href='inboxg-print-satu.php?id=$i[id_inbox]' title='Print Surat ini'><i class='fa fa-print'></i></a>
	                                       		  <a class='btn' href='index.php?page=inboxg&aksi=edit&id=$i[id_inbox]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>
	                                        	  <a class='btn' href='index.php?page=inboxg&aksi=hapus&id=$i[id_inbox]' title='Hapus Surat ini'><i class='fa fa-trash-o'></i></a>";
                						}elseif ($_SESSION[level]=='user_input'){ 
                							echo "<td style='width:90px' class='text-right'><a class='btn' href='index.php?page=inboxg&aksi=detail&id=$i[id_inbox]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
	                                       		  <a class='btn' href='index.php?page=inboxg&aksi=edit&id=$i[id_inbox]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>";
                						}else{
                							echo "<td style='width:50px' class='text-right'><a class='btn' href='index.php?page=inboxg&aksi=detail&id=$i[id_inbox]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>";
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
	mysqli_query($conn, "DELETE FROM phpmu_inbox_g where id_inbox='$_GET[id]'");
	echo "<script>window.alert('Data Surat Masuk Berhasil Di Hapus.');
                                window.location='inboxg'</script>";

}elseif ($_GET[aksi]=='tambah'){ 
    if (isset($_POST[simpan])){
        if ($_SESSION[unit] == '0'){
            $unit = $_POST[unit];
        }else{
            $unit = $_SESSION[unit];
        }
            $dir_gambar = 'surat_masuk/';
            $filename = basename($_FILES['h']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {            
                        mysqli_query($conn, "INSERT INTO phpmu_inbox_g (no_surat, tanggal_surat, tanggal_masuk_agenda, pengirim, lampiran, nama_penerima, id_perihal, file_surat, id_user, unit_kerja)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]','$filename','$_SESSION[login]','$unit')");
                        
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Masuk.');
                                window.location='inboxg'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Menambahkan Data Surat Masuk.');
                                window.location='index.php?page=inboxg&aksi=tambah'</script>";
                    }
                }else{
                        mysqli_query($conn, "INSERT INTO phpmu_inbox_g (no_surat, tanggal_surat, tanggal_masuk_agenda, pengirim, lampiran, nama_penerima, id_perihal, id_user, unit_kerja)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[g]','$_SESSION[login]','$unit')");
                                     
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Masuk .');
                                window.location='inboxg'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Surat Masuk</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Surat</label>
                            <div class="col-lg-6">
                            <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control">
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
                        <label class="col-lg-2 control-label">Pengirim</label>
                            <div class="col-lg-9">
                            <input type="text" name="d" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lampiran</label>
                            <div class="col-lg-3">
                            <input type="text" name="e" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Penerima</label>
                            <div class="col-lg-9">
                            <input type="text" name="f" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Isi Perihal</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='g' rows="4" class="form-control" data-trigger="keyup"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Cari File</label>
                            <div class="col-lg-10">
                            <input type="file" name="h" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <?php if ($_SESSION[unit] == '0'){ ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Unit Kerja</label>
                            <div class="col-lg-4">
                            <select name='unit' class="form-control">
                                <option value=''>- Pilih Unit Kerja -</option>
                                <option value='G'>Unit Kerja G</option>
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
	$e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_inbox_g where id_inbox='$_GET[id]'"));

    if (isset($_POST[update])){
            $dir_gambar = 'surat_masuk/';
            $filename = basename($_FILES['h']['name']);
            $uploadfile = $dir_gambar . $filename;
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['h']['tmp_name'], $uploadfile)) {            
                        mysqli_query($conn, "UPDATE phpmu_inbox_g SET no_surat		        = '$_POST[a]',
                                                            tanggal_surat           = '$_POST[b]',
                                                            tanggal_masuk_agenda    = '$_POST[c]',
                        									pengirim		        = '$_POST[d]',
                        									lampiran		        = '$_POST[e]',
                        									nama_penerima 		    = '$_POST[f]',
                                                            id_perihal              = '$_POST[g]',
                        									file_surat 		        = '$filename'  where id_inbox='$_GET[id]'");
                        
                        echo "<script>window.alert('Sukses Update Data Surat Masuk.');
                                window.location='inboxg'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Update Data Surat Masuk.');
                                window.location='index.php?page=inboxg&aksi=edit&id=$_GET[id]'</script>";
                    }
                }else{
                        mysqli_query($conn, "UPDATE phpmu_inbox_g SET no_surat              = '$_POST[a]',
                                                            tanggal_surat           = '$_POST[b]',
                                                            tanggal_masuk_agenda    = '$_POST[c]',
                                                            pengirim                = '$_POST[d]',
                                                            lampiran                = '$_POST[e]',
                                                            nama_penerima           = '$_POST[f]',
                                                            id_perihal              = '$_POST[g]'  where id_inbox='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Masuk .');
                                window.location='inboxg'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Surat Masuk</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Surat</label>
                            <div class="col-lg-6">
                            <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e[no_surat]; ?>">
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
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="c" value="<?php echo $e[tanggal_masuk_agenda]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Pengirim</label>
                            <div class="col-lg-9">
                            <input type="text" name="d" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[pengirim]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lampiran</label>
                            <div class="col-lg-3">
                            <input type="text" name="e" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[lampiran]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Penerima</label>
                            <div class="col-lg-9">
                            <input type="text" name="f" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[nama_penerima]; ?>">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-lg-2 control-label">Isi Perihal</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='g' rows="4" class="form-control" data-trigger="keyup"><?php echo $e[id_perihal]; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Ganti File</label>
                            <div class="col-lg-10">
                            <input type="file" name="h" title="Pilih File" class="btn-success btn-small"> 
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
	$in = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_inbox_g where id_inbox='$_GET[id]'"));
	echo "<h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class='col-md-12'>
            <div class='panel panel-default'>
            <div class='panel-heading'><strong>Detail Data Surat Masuk</strong></div>
                <div class='panel-body'>
                	<form action='' class='form-horizontal' data-validate='parsley' enctype='multipart/form-data'>
                
                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>No Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[no_surat]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Tanggal Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            	".tgl_indo($in[tanggal_surat])."
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Masuk Agenda</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                ".tgl_indo($in[tanggal_masuk_agenda])."
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Pengirim</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[pengirim]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Lampiran</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[lampiran]
                            </div>
                        </div>
                
                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Nama Penerima</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                           		 $in[nama_penerima] <br><br>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Isi Perihal</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[id_perihal] <br><br>
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>File Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                <a href='download.php?file=$in[file_surat]'>Download File Surat</a>
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