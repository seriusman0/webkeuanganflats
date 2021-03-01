<?php 
    if ($_GET[aksi]==''){
?>
        <h4 style='padding-top:15px'>Semua Data Surat Kendaraan</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<?php if ($_SESSION[level]=='user_admin'){ ?>
                    	<a class='btn btn-primary' href='index.php?page=kendaraan&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Kendaraaan</a>
                    	<a class='btn btn-info' target='BLANK' href='kendaraan-print.php'><i class='fa fa-print'></i> Print Surat Kendaraaan</a>
    					<a class='btn btn-success' href='kendaraan-excel.php'><i class='fa fa-file'></i> Export ke Excel</a>
                	<?php }elseif ($_SESSION[level]=='user_input'){ ?>
                		<a class='btn btn-primary' href='index.php?page=kendaraan&aksi=tambah'><i class='fa fa-plus'></i> Tambah Surat Kendaraaan</a>
                	<?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Merek</th>
                        <th>Type</th>
                        <th>No Polisi</th>
                        <th>No Rangka</th>
                        <th>No Mesin</th>
                        <th>Warna</th>
                        <th>Tahun</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $kendaraan = mysqli_query($conn, "SELECT * FROM phpmu_kendaraan ORDER BY id_kendaraan ASC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($kendaraan)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[jenis_kendaraan]</td>
                                    <td>$i[merk]</td>
                                    <td>$i[type]</td>
                                    <td>$i[nomor_polisi]</td>
                                    <td>$i[nomor_rangka]</td>
                                    <td>$i[nomor_mesin]</td>
                                    <td>$i[warna]</td>
                                    <td>$i[tahun]</td>";
                                    	if ($_SESSION[level]=='user_admin'){ 
	                                        echo "<td style='width:170px' class='text-right'><a class='btn' href='index.php?page=kendaraan&aksi=detail&id=$i[id_kendaraan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
	                                        	  <a class='btn' target='BLANK' href='kendaraan-print-satu.php?id=$i[id_kendaraan]' title='Print Surat ini'><i class='fa fa-print'></i></a>
	                                       		  <a class='btn' href='index.php?page=kendaraan&aksi=edit&id=$i[id_kendaraan]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>
	                                        	  <a class='btn' href='index.php?page=kendaraan&aksi=hapus&id=$i[id_kendaraan]' title='Hapus Surat ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"><i class='fa fa-trash-o'></i></a>";
                						}elseif ($_SESSION[level]=='user_input'){ 
                							echo "<td style='width:90px' class='text-right'><a class='btn' href='index.php?page=kendaraan&aksi=detail&id=$i[id_kendaraan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>
	                                       		  <a class='btn' href='index.php?page=kendaraan&aksi=edit&id=$i[id_kendaraan]' title='Edit Data Surat ini'><i class='fa fa-pencil-square-o'></i></a>";
                						}else{
                							echo "<td style='width:50px' class='text-right'><a class='btn' href='index.php?page=kendaraan&aksi=detail&id=$i[id_kendaraan]' title='Lihat Detail Surat ini'><i class='fa fa-folder-open'></i></a>";
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
	mysqli_query($conn, "DELETE FROM phpmu_kendaraan where id_kendaraan='$_GET[id]'");
	echo "<script>window.alert('Data Surat Kendaraaan Berhasil Di Hapus.');
                                window.location='kendaraan'</script>";

}elseif ($_GET[aksi]=='tambah'){ 
    if (isset($_POST[simpan])){
            $dir_gambar = 'foto_kendaraan/';
            $filename = basename($_FILES['u']['name']);
            $uploadfile = $dir_gambar . $filename;
            $tanggaleks = date("Y-m-d H:i:s");
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['u']['tmp_name'], $uploadfile)) {            
                        mysqli_query($conn, "INSERT INTO phpmu_kendaraan (jenis_kendaraan, 
                                                                  merk, 
                                                                  type, 
                                                                  nomor_polisi, 
                                                                  nomor_rangka, 
                                                                  nomor_mesin, 
                                                                  warna, 
                                                                  tahun, 
                                                                  kondisi_kendaraan, 
                                                                  lokasi_kendaraan,
                                                                  sk_pemegang, 
                                                                  nama_pemegang, 
                                                                  kapasitas_mesin, 
                                                                  keberadaan_bpkb, 
                                                                  nomor_bpkb, 
                                                                  posisi_bpkb, 
                                                                  keberadaan_kendaraan, 
                                                                  asal_usul, 
                                                                  sumber_dana, 
                                                                  harga, 
                                                                  foto_kendaraan, 
                                                                  keterangan, 
                                                                  waktu_eksekusi, 
                                                                  id_user)           
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
                                                                  '$_POST[l]',
                                                                  '$_POST[m]',
                                                                  '$_POST[n]',
                                                                  '$_POST[o]',
                                                                  '$_POST[p]',
                                                                  '$_POST[q]',
                                                                  '$_POST[r]',
                                                                  '$_POST[s]',
                                                                  '$_POST[t]',
                                                                  '$filename',
                                                                  '$_POST[v]',
                                                                  '$tanggaleks',
                                                                  '$_SESSION[login]')");
                        
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Kendaraaan.');
                                window.location='kendaraan'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Menambahkan Data Surat Kendaraaan.');
                                window.location='index.php?page=kendaraan&aksi=tambah'</script>";
                    }
                }else{
                        mysqli_query($conn, "INSERT INTO phpmu_kendaraan (jenis_kendaraan, 
                                                                  merk, 
                                                                  type, 
                                                                  nomor_polisi, 
                                                                  nomor_rangka, 
                                                                  nomor_mesin, 
                                                                  warna, 
                                                                  tahun, 
                                                                  kondisi_kendaraan, 
                                                                  lokasi_kendaraan,
                                                                  sk_pemegang, 
                                                                  nama_pemegang, 
                                                                  kapasitas_mesin, 
                                                                  keberadaan_bpkb, 
                                                                  nomor_bpkb, 
                                                                  posisi_bpkb, 
                                                                  keberadaan_kendaraan, 
                                                                  asal_usul, 
                                                                  sumber_dana, 
                                                                  harga, 
                                                                  keterangan, 
                                                                  waktu_eksekusi, 
                                                                  id_user)           
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
                                                                  '$_POST[l]',
                                                                  '$_POST[m]',
                                                                  '$_POST[n]',
                                                                  '$_POST[o]',
                                                                  '$_POST[p]',
                                                                  '$_POST[q]',
                                                                  '$_POST[r]',
                                                                  '$_POST[s]',
                                                                  '$_POST[t]',
                                                                  '$_POST[v]',
                                                                  '$tanggaleks',
                                                                  '$_SESSION[login]')");
                        
                        echo "<script>window.alert('Sukses Menambahkan Data Surat Kendaraaan.');
                                window.location='kendaraan'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Surat Kendaraaan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Jenis Kendaraan</label>
                            <div class="col-lg-5">
                            <input type="text" name="a" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Merk</label>
                            <div class="col-lg-5">
                            <input type="text" name="b" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Type</label>
                            <div class="col-lg-3">
                            <input type="text" name="c" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor Polisi</label>
                            <div class="col-lg-3">
                            <input type="text" name="d" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor Rangka</label>
                            <div class="col-lg-5">
                            <input type="text" name="e" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor Mesin</label>
                            <div class="col-lg-5">
                            <input type="text" name="f" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Warna</label>
                            <div class="col-lg-3">
                            <input type="text" name="g" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Tahun</label>
                            <div class="col-lg-2">
                            <input type="text" name="h" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Kondisi Kendaraan</label>
                            <div class="col-lg-5">
                            <input type="text" name="i" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Kendaraan</label>
                            <div class="col-lg-7">
                            <input type="text" name="j" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">SK Pemegang</label>
                            <div class="col-lg-5">
                            <input type="text" name="k" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Pemegang</label>
                            <div class="col-lg-4">
                            <input type="text" name="l" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Kapasitas Mesin</label>
                            <div class="col-lg-4">
                            <input type="text" name="m" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Keberadaaan BPKB</label>
                            <div class="col-lg-6">
                            <input type="text" name="n" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor BPKB</label>
                            <div class="col-lg-5">
                            <input type="text" name="o" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Posisi BPKB</label>
                            <div class="col-lg-5">
                            <input type="text" name="p" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Keberadaan Kendaraan</label>
                            <div class="col-lg-6">
                            <input type="text" name="q" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Asal Usul</label>
                            <div class="col-lg-8">
                            <input type="text" name="r" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Sumber Dana</label>
                            <div class="col-lg-8">
                            <input type="text" name="s" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Harga</label>
                            <div class="col-lg-3">
                            <input type="text" name="t" placeholder="" class="bg-focus form-control" data-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Foto Kendaraan</label>
                            <div class="col-lg-10">
                            <input type="file" name="u" title="Cari Foto" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Keterangan</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='v' rows="9" class="textarea form-control" data-trigger="keyup"></textarea>
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
	$e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_kendaraan where id_kendaraan='$_GET[id]'"));

    if (isset($_POST[update])){
            $dir_gambar = 'foto_kendaraan/';
            $filename = basename($_FILES['u']['name']);
            $uploadfile = $dir_gambar . $filename;
                if ($filename != ''){
                    if (move_uploaded_file($_FILES['u']['tmp_name'], $uploadfile)) {            
                        mysqli_query($conn, "UPDATE phpmu_kendaraan SET jenis_kendaraan         = '$_POST[a]',
                                                                 merk                   = '$_POST[b]',
                                                                 type                   = '$_POST[c]',
                                                                 nomor_polisi           = '$_POST[d]',
                                                                 nomor_rangka           = '$_POST[e]',
                                                                 nomor_mesin            = '$_POST[f]',
                                                                 warna                  = '$_POST[g]',
                                                                 tahun                  = '$_POST[h]',
                                                                 kondisi_kendaraan      = '$_POST[i]',
                                                                 lokasi_kendaraan       = '$_POST[j]',
                                                                 sk_pemegang            = '$_POST[k]',
                                                                 nama_pemegang          = '$_POST[l]',
                                                                 kapasitas_mesin        = '$_POST[m]',
                                                                 keberadaan_bpkb        = '$_POST[n]',
                                                                 nomor_bpkb             = '$_POST[o]',
                                                                 posisi_bpkb            = '$_POST[p]',
                                                                 keberadaan_kendaraan   = '$_POST[q]',
                                                                 asal_usul              = '$_POST[r]',
                                                                 sumber_dana            = '$_POST[s]',
                                                                 harga                  = '$_POST[t]',
                                                                 foto_kendaraan         = '$filename',
                                                                 keterangan             = '$_POST[v]' where id_kendaraan='$_GET[id]'");
                        
                        echo "<script>window.alert('Sukses Update Data Surat Kendaraan.');
                                window.location='kendaraan'</script>";
                    }else{
                        echo "<script>window.alert('Gagal Update Data Surat Kendaraan.');
                                window.location='index.php?page=kendaraan&aksi=edit&id=$_GET[id]'</script>";
                    }
                }else{
                        mysqli_query($conn, "UPDATE phpmu_kendaraan SET jenis_kendaraan         = '$_POST[a]',
                                                                 merk                   = '$_POST[b]',
                                                                 type                   = '$_POST[c]',
                                                                 nomor_polisi           = '$_POST[d]',
                                                                 nomor_rangka           = '$_POST[e]',
                                                                 nomor_mesin            = '$_POST[f]',
                                                                 warna                  = '$_POST[g]',
                                                                 tahun                  = '$_POST[h]',
                                                                 kondisi_kendaraan      = '$_POST[i]',
                                                                 lokasi_kendaraan       = '$_POST[j]',
                                                                 sk_pemegang            = '$_POST[k]',
                                                                 nama_pemegang          = '$_POST[l]',
                                                                 kapasitas_mesin        = '$_POST[m]',
                                                                 keberadaan_bpkb        = '$_POST[n]',
                                                                 nomor_bpkb             = '$_POST[o]',
                                                                 posisi_bpkb            = '$_POST[p]',
                                                                 keberadaan_kendaraan   = '$_POST[q]',
                                                                 asal_usul              = '$_POST[r]',
                                                                 sumber_dana            = '$_POST[s]',
                                                                 harga                  = '$_POST[t]',
                                                                 keterangan             = '$_POST[v]' where id_kendaraan='$_GET[id]'");
                                       
                        echo "<script>window.alert('Sukses Update Data Surat Kendaraan .');
                                window.location='kendaraan'</script>";
                }
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Surat Kendaraan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Jenis Kendaraan</label>
                            <div class="col-lg-5">
                            <input type="text" name="a" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[jenis_kendaraan]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Merk</label>
                            <div class="col-lg-5">
                            <input type="text" name="b" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[merk]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Type</label>
                            <div class="col-lg-3">
                            <input type="text" name="c" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[type]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor Polisi</label>
                            <div class="col-lg-3">
                            <input type="text" name="d" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[nomor_polisi]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor Rangka</label>
                            <div class="col-lg-5">
                            <input type="text" name="e" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[nomor_rangka]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor Mesin</label>
                            <div class="col-lg-5">
                            <input type="text" name="f" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[nomor_mesin]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Warna</label>
                            <div class="col-lg-3">
                            <input type="text" name="g" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[warna]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Tahun</label>
                            <div class="col-lg-2">
                            <input type="text" name="h" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[tahun]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Kondisi Kendaraan</label>
                            <div class="col-lg-5">
                            <input type="text" name="i" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[kondisi_kendaraan]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lokasi Kendaraan</label>
                            <div class="col-lg-7">
                            <input type="text" name="j" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[lokasi_kendaraan]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">SK Pemegang</label>
                            <div class="col-lg-5">
                            <input type="text" name="k" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[sk_pemegang]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Pemegang</label>
                            <div class="col-lg-4">
                            <input type="text" name="l" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[nama_pemegang]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Kapasitas Mesin</label>
                            <div class="col-lg-4">
                            <input type="text" name="m" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[kapasitas_mesin]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Keberadaaan BPKB</label>
                            <div class="col-lg-6">
                            <input type="text" name="n" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[keberadaan_bpkb]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nomor BPKB</label>
                            <div class="col-lg-5">
                            <input type="text" name="o" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[nomor_bpkb]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Posisi BPKB</label>
                            <div class="col-lg-5">
                            <input type="text" name="p" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[posisi_bpkb]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Keberadaan Kendaraan</label>
                            <div class="col-lg-6">
                            <input type="text" name="q" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[keberadaan_kendaraan]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Asal Usul</label>
                            <div class="col-lg-8">
                            <input type="text" name="r" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[asal_usul]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Sumber Dana</label>
                            <div class="col-lg-8">
                            <input type="text" name="s" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[sumber_dana]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Harga</label>
                            <div class="col-lg-3">
                            <input type="text" name="t" placeholder="" class="bg-focus form-control" data-required="true" value="<?php echo $e[harga]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Foto Kendaraan</label>
                            <div class="col-lg-10">
                                <img style='width:300px' src='foto_kendaraan/<?php echo $e[foto_kendaraan]; ?>'>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Ganti Foto Kendaraan</label>
                            <div class="col-lg-10">
                            <input type="file" name="u" title="Cari Foto" class="btn-success btn-small"> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Keterangan</label>
                            <div class="col-lg-9">
                            <textarea placeholder="" name='v' rows="9" class="textarea form-control" data-trigger="keyup"><?php echo $e[keterangan]; ?></textarea>
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
	$e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM phpmu_kendaraan where id_kendaraan='$_GET[id]'"));
	echo "<h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class='col-md-12'>
            <div class='panel panel-default'>
            <div class='panel-heading'><strong>Detail Data Surat Kendaraan</strong></div>
                <div class='panel-body'>
                	<form action='' class='form-horizontal' data-validate='parsley' enctype='multipart/form-data'>
                
                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Jenis Kendaraan</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                             $e[jenis_kendaraan]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Merk</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[merk]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Type</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[type]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Nomor Polisi</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                             $e[nomor_polisi]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Nomor Rangka</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[nomor_rangka]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Nomor Mesin</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[nomor_mesin]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Warna</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[warna]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Tahun</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[tahun]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Kondisi Kendaraan</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[kondisi_kendaraan]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Lokasi Kendaraan</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[lokasi_kendaraan]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>SK Pemegang</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[sk_pemegang]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Nama Pemegang</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[nama_pemegang]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Kapasitas Mesin</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[kapasitas_mesin]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Keberadaaan BPKB</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[keberadaan_bpkb]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Nomor BPKB</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[nomor_bpkb]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Posisi BPKB</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[posisi_bpkb]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Keberadaan Kendaraan</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[keberadaan_kendaraan]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Asal Usul</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[asal_usul]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Sumber Dana</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                             $e[sumber_dana]
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Harga</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            Rp ".number_format($e[harga])."
                            </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-lg-2 control-label'>Foto Kendaraan</label>
                            <div class='col-lg-10'>
                                <img style='width:300px' src='foto_kendaraan/$e[foto_kendaraan]'>
                            </div>
                        </div>

                        

                        <div class='form-group'>
                            <label class='col-lg-2 control-label'>Keterangan</label>
                            <div style='border-bottom:1px solid #e3e3e3' class='col-lg-9'>
                            $e[keterangan]
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