 <?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Semua Data Surat Keluar</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($_SESSION[level]=='user_admin'){ ?>
                        <a class='btn btn-primary' href='index.php?page=outbox&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Keluar</a>
                        <a class='btn btn-info' target='BLANK' href='outbox-print.php'><i class='fa fa-print'></i> Print Surat Keluar</a>
                        <a class='btn btn-success' href='outbox-excel.php'><i class='fa fa-file'></i> Export ke Excel</a>
                    <?php }elseif ($_SESSION[level]=='user_input'){ ?>
                        <a class='btn btn-primary' href='index.php?page=outbox&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Keluar</a>
                    <?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead  class='alert-success'>
                    <tr>
                        <th>No</th>
                        <th>No. Surat</th>
                        <th>Perihal</th>
                        <?php if ($_SESSION[unit] != 'F'){ ?>
                        <th>Bidang</th>
                        <?php } ?>
                        <th width='100px'>Tanggal Terima</th>
                        <?php if ($_SESSION[unit] != 'F'){ ?>
                        <th>Penerima</th>
                        <?php } ?>
                        <th>Lokasi Arsip</th>
                        <th>Unit</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                    if ($_SESSION[unit] == '0'){
                        $outbox = mysqli_query($conn, "SELECT * FROM phpmu_outbox ORDER BY id_outbox ASC");
                    }else{
                        $outbox = mysqli_query($conn, "SELECT * FROM phpmu_outbox where unit_kerja='$_SESSION[unit]' ORDER BY id_outbox ASC");
                    }
                        $no = 1;
                        while ($i = mysqli_fetch_array($outbox)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[no_surat]</td>
                                    <td>$i[id_perihal]</td>";
                                    if ($_SESSION[unit] != 'F'){
                                        echo "<td>$i[bidang]</td>";
                                    }
                                    echo "<td>".tgl_indo($i[tanggal_surat])."</td>";
                                    if ($_SESSION[unit] != 'F'){
                                        echo "<td>$i[nama_penerima]</td>";
                                    }
                                    echo "<td>$i[lokasi_arsip]</td>
                                    <td>$i[unit_kerja]</td>";
                                        if ($_SESSION[level]=='user_admin'){ 
                                            echo "<td style='width:170px' class='text-right'><a class='btn' href='index.php?page=outbox&aksi=detail&id=$i[id_outbox]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
                                                  <a class='btn' target='BLANK' href='outbox-print-satu.php?id=$i[id_outbox]' title='Print Surat ini'><i class='fa fa-print'></i></a>
                                                  <a class='btn' href='index.php?page=outbox&aksi=edit&id=$i[id_outbox]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=outbox&aksi=hapus&id=$i[id_outbox]' title='Hapus Surat ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"><i class='fa fa-trash-o'></i></a>";
                                        }elseif ($_SESSION[level]=='user_input'){ 
                                            echo "<td style='width:90px' class='text-right'><a class='btn' href='index.php?page=outbox&aksi=detail&id=$i[id_outbox]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
                                                  <a class='btn' href='index.php?page=outbox&aksi=edit&id=$i[id_outbox]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>";
                                        }else{
                                            echo "<td style='width:50px' class='text-right'><a class='btn' href='index.php?page=outbox&aksi=detail&id=$i[id_outbox]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>";
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
    mysqli_query($conn, "DELETE FROM phpmu_outbox where id_outbox='$_GET[id]'");
    echo "<script>window.alert('Data Surat Keluar Berhasil Di Hapus.');
                                window.location='outbox'</script>";

}elseif ($_GET[aksi]=='tambah'){ 
    if (isset($_POST[simpan])){
        if ($_SESSION[unit] == '0'){
            $unit = $_POST[unit];
        }else{
            $unit = $_SESSION[unit];
        }
        $dir_gambar = 'surat_keluar/';
            $filename = basename($_FILES['g']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['g']['tmp_name'], $uploadfile)) {            
                         mysqli_query($conn, "INSERT INTO phpmu_outbox (no_surat, id_perihal, bidang, tujuan_surat, tanggal_surat, nama_penerima, file_surat, lokasi_arsip, waktu_eksekusi, id_user, unit_kerja)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$filename','$_POST[h]','$tanggaleks','$_SESSION[login]','$unit')");
                                       
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Keluar .');
                                window.location='outbox'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Menambahkan Data Surat Keluar.');
                                window.location='index.php?page=outbox&aksi=tambah'</script>";
                    }
                }else{
                       mysqli_query($conn, "INSERT INTO phpmu_outbox (no_surat, id_perihal, bidang, tujuan_surat, tanggal_surat, nama_penerima, lokasi_arsip, waktu_eksekusi, id_user, unit_kerja)           
                                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]','$_POST[h]','$tanggaleks','$_SESSION[login]','$unit')");

                        echo "<script>window.alert('Sukses Menambahkan Data Surat Keluar .');
                                window.location='outbox'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Surat Keluar</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                    	<div class="form-group">
                            <label class="col-lg-2 control-label">No Surat</label>
                            <div class="col-lg-6">
                                <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Perihal</label>
                            <div class="col-lg-8">
                            <textarea placeholder="" name='b' rows="6" class="textarea form-control" data-trigger="keyup"></textarea>
                            </div>
                        </div>

                        <?php if ($_SESSION[unit] != 'F'){ ?>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Bidang</label>
                            <div class="col-lg-6">
                            <input type="text" name="c" placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <?php } ?>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Tujuan Surat</label>
                            <div class="col-lg-9">
                            <input type="text" name="d" placeholder="Masukkan Tujuan Surat ..." class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal Surat</label>
                            <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="e" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <?php if ($_SESSION[unit] != 'F'){ ?>

                		<div class="form-group">
                        <label class="col-lg-2 control-label">Nama Penerima</label>
                            <div class="col-lg-7">
                            <input type="text" name="f" placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <?php } ?>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Cari File</label>
                            <div class="col-lg-10">
                            <input type="file" name="g" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                            <div class="col-lg-4">
                            <input type="text" name="h" placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <?php if ($_SESSION[unit] == '0'){ ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Unit Kerja</label>
                            <div class="col-lg-4">
                            <select name='unit' class="form-control">
                                <option value=''>- Pilih Unit Kerja -</option>
                                <option value='A'>Unit Kerja A</option>
                                <option value='F'>Unit Kerja F</option>
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_outbox where id_outbox='$_GET[id]'"));
    if (isset($_POST[update])){
    	    $dir_gambar = 'surat_keluar/';
            $filename = basename($_FILES['g']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['g']['tmp_name'], $uploadfile)) {            
                         mysqli_query($conn, "UPDATE phpmu_outbox SET no_surat			= '$_POST[a]',
                         									  id_perihal		= '$_POST[b]',
                         									  bidang 			= '$_POST[c]',
                         									  tujuan_surat		= '$_POST[d]',
                         									  tanggal_surat		= '$_POST[e]',
                         									  nama_penerima		= '$_POST[f]',
                         									  file_surat		= '$filename',
                         									  lokasi_arsip		= '$_POST[h]' where id_outbox='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Keluar .');
                                window.location='outbox'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Update Data Surat Keluar.');
                                window.location='outbox'</script>";
                    }
                }else{
                       mysqli_query($conn, "UPDATE phpmu_outbox SET no_surat			= '$_POST[a]',
                         									  id_perihal		= '$_POST[b]',
                         									  bidang 			= '$_POST[c]',
                         									  tujuan_surat		= '$_POST[d]',
                         									  tanggal_surat		= '$_POST[e]',
                         									  nama_penerima		= '$_POST[f]',
                         									  lokasi_arsip		= '$_POST[h]' where id_outbox='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Keluar .');
                                window.location='outbox'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Surat Keluar</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">No Surat</label>
                            <div class="col-lg-6">
                                <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e[no_surat]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Perihal</label>
                            <div class="col-lg-8">
                            <textarea placeholder="" name='b' rows="6" class="textarea form-control" data-trigger="keyup"><?php echo $e[id_perihal]; ?></textarea>
                            </div>
                        </div>

                        <?php if ($_SESSION[unit] != 'F'){ ?>
                        <div class="form-group">
                        <label class="col-lg-2 control-label">Bidang</label>
                            <div class="col-lg-6">
                            <input type="text" name="c" placeholder="" class="bg-focus form-control" value="<?php echo $e[bidang]; ?>">
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Tujuan Surat</label>
                            <div class="col-lg-9">
                            <input type="text" name="d" placeholder="Masukkan Tujuan Surat ..." class="bg-focus form-control" value="<?php echo $e[tujuan_surat]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal Surat</label>
                            <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="e" value="<?php echo $e[tanggal_surat]; ?>">
                            </div>
                        </div>

                        <?php if ($_SESSION[unit] != 'F'){ ?>
                		<div class="form-group">
                        <label class="col-lg-2 control-label">Nama Penerima</label>
                            <div class="col-lg-7">
                            <input type="text" name="f" placeholder="" class="bg-focus form-control" value="<?php echo $e[nama_penerima]; ?>">
                            </div>
                        </div>
                        <?php } ?>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Ganti File</label>
                            <div class="col-lg-10">
                            <input type="file" name="g" title="Pilih File" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                            <div class="col-lg-4">
                            <input type="text" name="h" placeholder="" class="bg-focus form-control" value="<?php echo $e[lokasi_arsip]; ?>">
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
    $in = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_outbox where id_outbox='$_GET[id]'"));
    echo "<h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class='col-md-12'>
            <div class='panel panel-default'>
            <div class='panel-heading'><strong>Detail Data Surat Keluar</strong></div>
                <div class='panel-body'>
                    <form action='' class='form-horizontal' data-validate='parsley' enctype='multipart/form-data'>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>No Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[no_surat]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Perihal</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[id_perihal]
                            </div>
                        </div>";

                        if ($_SESSION[unit] != 'F'){
                        echo "<div class='form-group'>
                            <label class='col-lg-2 control-label'>Bidang</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[bidang]
                            </div>
                        </div>";
                        }

                        echo "<div class='form-group'>
                        <label class='col-lg-2 control-label'>Tujuan Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[tujuan_surat]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Tanggal Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                ".tgl_indo($in[tanggal_surat])."
                            </div>
                        </div>";

                        if ($_SESSION[unit] != 'F'){
                        echo "<div class='form-group'>
                            <label class='col-lg-2 control-label'>Nama Penerima</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[nama_penerima]
                            </div>
                        </div>";
                        }

                        echo "<div class='form-group'>
                            <label class='col-lg-2 control-label'>Lokasi Arsip</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[lokasi_arsip] 
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>File Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 <a href='download_outbox.php?file=$in[file_surat]'>Download File Surat</a>
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