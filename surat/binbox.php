<?php
if ($_GET[aksi] == '') {
?>
    <h4 style='padding-top:15px'>Semua Data Surat Masuk</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php if ($_SESSION['level'] == 'user_admin') { ?>
                    <a class='btn btn-primary' href='index.php?page=binbox&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Masuk</a>
                    <a class='btn btn-info' target='BLANK' href='binbox-print.php'><i class='fa fa-print'></i> Print Surat Masuk</a>
                    <a class='btn btn-success' href='binbox-excel.php'><i class='fa fa-file'></i> Export ke Excel</a>
                <?php } elseif ($_SESSION['level'] == 'user_input') { ?>
                    <a class='btn btn-primary' href='index.php?page=binbox&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Masuk</a>
                <?php } ?>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead class='alert-info'>
                        <tr>
                            <th>No</th>
                            <th>No. Surat</th>
                            <th>Pengirim</th>
                            <th width='100px'>Tanggal Surat</th>
                            <th width='100px'>Masuk Agenda</th>
                            <th>Perihal</th>
                            <th width='50px'>Lamp.</th>
                            <th width='60px'>Status</th>
                            <th width='95px'>Lokasi Arsip</th>
                            <th width=40px>Unit</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($_SESSION['unit'] == '0') {
                            $inbox = mysqli_query($conn, "SELECT * FROM phpmu_inbox_b ORDER BY id_inbox_b ASC");
                        } else {
                            $inbox = mysqli_query($conn, "SELECT * FROM phpmu_inbox_b where unit_kerja='$_SESSION[unit]' ORDER BY id_inbox_b ASC");
                        }
                        $no = 1;
                        while ($i = mysqli_fetch_array($inbox)) {
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[no_surat]</td>
                                    <td>$i[pengirim]</td>
                                    <td>" . tgl_indo($i['tanggal_surat']) . "</td>
                                    <td>" . tgl_indo($i['tanggal_masuk_agenda']) . "</td>
                                    <td>$i[id_perihal]</td>
                                    <td>$i[jumlah_lampiran]</td>
                                    <td>$i[status]</td>
                                    <td>$i[lokasi_arsip]</td>
                                    <td>$i[unit_kerja]</td>";
                            if ($_SESSION['level'] == 'user_admin') {
                                echo "<td style='width:165px' class='text-right'><a class='btn' href='index.php?page=binbox&aksi=detail&id=$i[id_inbox_b]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
	                                        	  <a class='btn' target='BLANK' href='binbox-print-satu.php?id=$i[id_inbox_b]' title='Print Surat ini'><i class='fa fa-print'></i></a>
	                                       		  <a class='btn' href='index.php?page=binbox&aksi=edit&id=$i[id_inbox_b]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>
	                                        	  <a class='btn' href='index.php?page=binbox&aksi=hapus&id=$i[id_inbox_b]' title='Hapus Surat ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"><i class='fa fa-trash-o'></i></a>";
                            } elseif ($_SESSION['level'] == 'user_input') {
                                echo "<td style='width:90px' class='text-right'><a class='btn' href='index.php?page=binbox&aksi=detail&id=$i[id_inbox_b]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
	                                       		  <a class='btn' href='index.php?page=binbox&aksi=edit&id=$i[id_inbox_b]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>";
                            } else {
                                echo "<td style='width:50px' class='text-right'><a class='btn' href='index.php?page=binbox&aksi=detail&id=$i[id_inbox_b]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>";
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
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($conn, "DELETE FROM phpmu_inbox_b where id_inbox_b='$_GET[id]'");
    echo "<script>window.alert('Data Surat Masuk Berhasil Di Hapus.');
                                window.location='binbox'</script>";
} elseif ($_GET['aksi'] == 'tambah') {
    if (isset($_POST['simpan'])) {
        if ($_SESSION['unit'] == '0') {
            $unit = $_POST['unit'];
        } else {
            $unit = $_SESSION['unit'];
        }
        $dir_gambar = 'surat_masuk/';
        $filename = basename($_FILES['l']['name']);
        $uploadfile = $dir_gambar . $filename;
        $tanggaleks = date("Y-m-d H:i:s");
        if ($filename != '') {
            if (move_uploaded_file($_FILES['l']['tmp_name'], $uploadfile)) {
                mysqli_query($conn, "INSERT INTO phpmu_inbox_b (no_surat, 
                                                                pengirim,
                                                                tanggal_surat, 
                                                                tanggal_masuk_agenda, 
                                                                id_perihal, 
                                                                isi_disposisi_a, 
                                                                isi_disposisi_b, 
                                                                isi_disposisi_c,
                                                                jumlah_lampiran,
                                                                status,
                                                                lokasi_arsip,
                                                                upload_file,
                                                                tanggal_eksekusi, 
                                                                id_user,
                                                                unit_kerja)           
                                                         VALUES('$_POST[a]',
                                                                '$_POST[b]',
                                                                '$_POST[c]',
                                                                '$_POST[d]',
                                                                '$_POST[e]',
                                                                '$_POST[f]',
                                                                '$_POST[g]',
                                                                '$_POST[h]',
                                                                '$_POST[i]',
                                                                '$_POST[j]',
                                                                '$_POST[k]',
                                                                '$filename',
                                                                '$tanggaleks',
                                                                '$_SESSION[login]',
                                                                '$unit')");

                echo "<script>window.alert('Sukses Menambahkan Data Surat Masuk.');
                                window.location='binbox'</script>";
            } else {
                echo "<script>window.alert('Gagal Menambahkan Data Surat Masuk.');
                                window.location='index.php?page=binbox&aksi=tambah'</script>";
            }
        } else {
            mysqli_query($conn, "INSERT INTO phpmu_inbox_b (no_surat, 
                                                                pengirim,
                                                                tanggal_surat, 
                                                                tanggal_masuk_agenda, 
                                                                id_perihal, 
                                                                isi_disposisi_a, 
                                                                isi_disposisi_b, 
                                                                isi_disposisi_c,
                                                                jumlah_lampiran,
                                                                status,
                                                                lokasi_arsip,
                                                                tanggal_eksekusi, 
                                                                id_user,
                                                                unit_kerja)           
                                                         VALUES('$_POST[a]',
                                                                '$_POST[b]',
                                                                '$_POST[c]',
                                                                '$_POST[d]',
                                                                '$_POST[e]',
                                                                '$_POST[f]',
                                                                '$_POST[g]',
                                                                '$_POST[h]',
                                                                '$_POST[i]',
                                                                '$_POST[j]',
                                                                '$_POST[k]',
                                                                '$tanggaleks',
                                                                '$_SESSION[login]',
                                                                '$unit')");

            echo "<script>window.alert('Sukses Menambahkan Data Surat Masuk.');
                                window.location='binbox'</script>";
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
                        <label class="col-lg-2 control-label">Pengirim</label>
                        <div class="col-lg-9">
                            <input type="text" name="b" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tanggal Surat</label>
                        <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="c" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Masuk Agenda</label>
                        <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="d" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Perihal</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='e' rows="6" class="textarea form-control" data-trigger="keyup"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Isi Disposisi A</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='f' rows="6" class="textarea form-control" data-trigger="keyup"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Isi Disposisi B</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='g' rows="6" class="textarea form-control" data-trigger="keyup"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Isi Disposisi C</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='h' rows="6" class="textarea form-control" data-trigger="keyup"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Jumlah Lampiran</label>
                        <div class="col-lg-3">
                            <input type="text" name="i" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Status</label>
                        <div class="col-lg-5">
                            <input type="text" name="j" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Cari File</label>
                        <div class="col-lg-10">
                            <input type="file" name="l" title="Pilih File" class="btn-success btn-small">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                        <div class="col-lg-6">
                            <input type="text" name="k" placeholder="" data-required="true" class="bg-focus form-control">
                        </div>
                    </div>

                    <?php if ($_SESSION['unit'] == '0') { ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Unit Kerja</label>
                            <div class="col-lg-4">
                                <select name='unit' class="form-control">
                                    <option value=''>- Pilih Unit Kerja -</option>
                                    <option value='B'>Unit Kerja B</option>
                                    <option value='C'>Unit Kerja C</option>
                                    <option value='D'>Unit Kerja D</option>
                                    <option value='E'>Unit Kerja E</option>
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
} elseif ($_GET['aksi'] == 'edit') {
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_inbox_b where id_inbox_b='$_GET[id]'"));

    if (isset($_POST['update'])) {
        $dir_gambar = 'surat_masuk/';
        $filename = basename($_FILES['l']['name']);
        $uploadfile = $dir_gambar . $filename;
        if ($filename != '') {
            if (move_uploaded_file($_FILES['l']['tmp_name'], $uploadfile)) {
                mysqli_query($conn, "UPDATE phpmu_inbox_b SET no_surat         = '$_POST[a]',
                                                            pengirim		   = '$_POST[b]',
                                                            tanggal_surat      = '$_POST[c]',
                                                            tanggal_masuk_agenda    = '$_POST[d]',
                        									id_perihal		   = '$_POST[e]',
                        									isi_disposisi_a	   = '$_POST[f]',
                                                            isi_disposisi_b    = '$_POST[g]',
                                                            isi_disposisi_c    = '$_POST[h]',
                                                            jumlah_lampiran    = '$_POST[i]',
                                                            status             = '$_POST[j]',
                        									lokasi_arsip 	   = '$_POST[k]',
                                                            upload_file        = '$filename' where id_inbox_b='$_GET[id]'");

                echo "<script>window.alert('Sukses Update Data Surat Masuk.');
                                window.location='binbox'</script>";
            } else {
                echo "<script>window.alert('Gagal Update Data Surat Masuk.');
                                window.location='index.php?page=binbox&aksi=edit&id=$_GET[id]'</script>";
            }
        } else {
            mysqli_query($conn, "UPDATE phpmu_inbox_b SET no_surat         = '$_POST[a]',
                                                            pengirim           = '$_POST[b]',
                                                            tanggal_surat      = '$_POST[c]',
                                                            tanggal_masuk_agenda    = '$_POST[d]',
                                                            id_perihal         = '$_POST[e]',
                                                            isi_disposisi_a    = '$_POST[f]',
                                                            isi_disposisi_b    = '$_POST[g]',
                                                            isi_disposisi_c    = '$_POST[h]',
                                                            jumlah_lampiran    = '$_POST[i]',
                                                            status             = '$_POST[j]',
                                                            lokasi_arsip       = '$_POST[k]' where id_inbox_b='$_GET[id]'");

            echo "<script>window.alert('Sukses Update Data Surat Masuk.');
                                window.location='binbox'</script>";
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
                            <input type="text" name="a" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e['no_surat']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Pengirim</label>
                        <div class="col-lg-9">
                            <input type="text" name="b" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e['pengirim']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tanggal Surat</label>
                        <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="c" value="<?php echo $e['tanggal_surat']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Masuk Agenda</label>
                        <div class="col-lg-8">
                            <input type="text" class="combodate form-control" data-format="YYYY-MM-DD" data-template="D  MMM  YYYY" name="d" value="<?php echo $e['tanggal_masuk_agenda']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Isi Disposisi A</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='e' rows="6" class="textarea form-control" data-trigger="keyup"><?php echo $e['id_perihal']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Isi Disposisi A</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='f' rows="6" class="textarea form-control" data-trigger="keyup"><?php echo $e['isi_disposisi_a']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Isi Disposisi B</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='g' rows="6" class="textarea form-control" data-trigger="keyup"><?php echo $e['isi_disposisi_b']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Isi Disposisi C</label>
                        <div class="col-lg-8">
                            <textarea placeholder="" name='h' rows="6" class="textarea form-control" data-trigger="keyup"><?php echo $e['isi_disposisi_c']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Jumlah Lampiran</label>
                        <div class="col-lg-3">
                            <input type="text" name="i" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e['jumlah_lampiran']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Status</label>
                        <div class="col-lg-5">
                            <input type="text" name="j" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e['status']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Ganti File</label>
                        <div class="col-lg-10">
                            <input type="file" name="l" title="Pilih File" class="btn-success btn-small">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Arsip</label>
                        <div class="col-lg-6">
                            <input type="text" name="k" placeholder="" data-required="true" class="bg-focus form-control" value="<?php echo $e[lokasi_arsip]; ?>">
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
} elseif ($_GET['aksi'] == 'detail') {
    $in = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_inbox_b where id_inbox_b='$_GET[id]'"));
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
                        <label class='col-lg-2 control-label'>Pengirim</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            	$in[pengirim]
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Tanggal Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            	" . tgl_indo($in['tanggal_surat']) . "
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Masuk Agenda</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                " . tgl_indo($in['tanggal_masuk_agenda']) . "
                            </div>
                        </div>

                        

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Perihal</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                $in[id_perihal]
                            </div>
                        </div>
                
                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Isi Disposisi A</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[isi_disposisi_a] <br><br>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Isi Disposisi B</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[isi_disposisi_b] <br><br>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Isi Disposisi C</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[isi_disposisi_c] <br><br>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Jumlah Lampiran</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[jumlah_lampiran] <br><br>
                            </div>
                        </div>

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Status</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[status] <br><br>
                            </div>
                        </div>


                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Lokasi Arsip</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                 $in[lokasi_arsip] <br><br>
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>File Surat</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                                <a href='download_binbox.php?file=$in[upload_file]'>Download File Surat</a>
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