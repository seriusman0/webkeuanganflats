<?php 
    if ($_GET[aksi]==''){

        //hitung debit
        $debet =0;
        $kredit =0;
        $hitung = mysqli_query($conn, "SELECT * FROM kaskecil ORDER BY tgl_tr DESC");
        while ($c = mysqli_fetch_array($hitung)){
            $debet += $c[debet];
            $kredit += $c[kredit];
        }

        $saldo=$debet-$kredit;

?>
        <h4 style='padding-top:15px'>Kas Kecil</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<?php if ($_SESSION['level']=='user_admin' || $_SESSION['level']=='user_owner'){ ?>
                    	<a class='btn btn-primary' href='index.php?page=kaskecil&aksi=tambah'><i class='fa fa-plus'></i> Tambah Data</a>
    					<a class='btn btn-success' href='db_to_excell_pengeluaran.php'><i class='fa fa-file'></i> Export ke Excel</a>
                	<?php } ?>

<div align="right">
    <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Saldo : <?= rupiah($saldo); ?>" data-content="And here's some amazing content. It's very engaging. Right?">Saldo : <?= rupiah($saldo); ?></button>
    <button type="button" class="btn btn-lg btn-success" data-toggle="popover" title="Debit <?= rupiah($debet); ?>" data-content="And here's some amazing content. It's very engaging. Right?">Debit <?= rupiah($debet); ?></button>
    <button type="button" class="btn btn-lg btn-info" data-toggle="popover" title="Kredit <?= rupiah($kredit); ?>" data-content="And here's some amazing content. It's very engaging. alert?">Kredit <?= rupiah($kredit); ?></button>
</div>
                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr class='gradeX'>
                        <th width="30px" align="center">No</th>
                        <th>Keperluan</th>
                        <th width="10%">Debet</th>
                        <th width="10%">Kredit</th>
                        <th width="8%">Tanggal</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $dbkas = mysqli_query($conn, "SELECT * FROM flats_kaskecil ORDER BY id DESC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($dbkas)){
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[keperluan]</td>
                                    <td align=right>".rupiah($i['debet'])."</td>
                                    <td align=right>".rupiah($i['kredit'])."</td>
                                    <td align=right>$i[tgtr]</td>";
                                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=kaskecil&aksi=edit&id=$i[id]' title='Edit Data ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=kaskecil&aksi=hapus&id=$i[id]' title='Hapus Data ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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
	mysqli_query($conn, "DELETE FROM flats_kaskecil where id='$_GET[id]'");
	echo "<script>window.alert('Data Kas Kecil Berhasil Di Hapus.');
                                window.location='index.php?page=kaskecil'</script>";

}elseif ($_GET['aksi']=='tambah'){ 
    if (isset($_POST['simpan'])){
                        mysqli_query($conn, "INSERT INTO flats_kaskecil (id, keperluan, debet, kredit, tgtr)           
                                        VALUES('','$_POST[keperluan]','$_POST[debet]','$_POST[kredit]','$_POST[tgtr]')");
                                     
                        echo "<script>window.alert('Sukses Menambahkan Data Kas Kecil .');
                                window.location='index.php?page=kaskecil'</script>";
                
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Kas Kecil</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

						<div class="form-group">
                            <label class="col-lg-2 control-label">Keperluan</label>
                            <div class="col-lg-9">
                            <select name='keperluan' class="form-control">
                                <option value=''></option>
                                <option value='Gaji Pegawai'>Gaji Pegawai</option>
                                <option value='Bensin'>Bensin</option>
                                <option value='Biaya Operasional N.38'>Biaya Operasional N.38</option>
                                <option value='E-Tol'>E-Tol</option>
                                <option value='Biaya Konsumsi PKA Lawang'>Biaya Konsumsi PKA Lawang</option>
                                <option value='Biaya Operasional PKA Lawang'>Biaya Operasional PKA Lawang</option>
                                <option value='Listrik PKA Lawang'>Listrik PKA Lawang</option>
                                <option value='Internet PKA Lawang'>Internet PKA Lawang</option>
                                <option value='Persembahan Ahli Hukum'>Persembahan Ahli Hukum</option>
                                <option value='Lainnya'>Lainnya</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">debet</label>
                            <div class="col-lg-9">
                            <input type="number" name="debet" placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Kredit</label>
                            <div class="col-lg-9">
                            <input type="number" name="kredit" placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-8">
                            <input type="date" name="tgtr">
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
	$e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_kaskecil WHERE id='$_GET[id]'"));

    if (isset($_POST['update'])){
                        mysqli_query($conn, "UPDATE flats_kaskecil SET keperluan		 = '$_POST[keperluan]',
                                                            debet    = '$_POST[debet]',
                                                            kredit    = '$_POST[kredit]',
                                                            tgtr    = '$_POST[tgtr]',
                                                             WHERE id ='$_GET[id]'");
                        
                        echo "<script>window.alert('Sukses Update Data Kas Kecil.');
                                window.location='index.php?page=kaskecil'</script>";
                    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Kas Kecil</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      
                        
						<div class="form-group">
                        <label class="col-lg-2 control-label">Keperluan</label>
                            <div class="col-lg-9">
                            <input type="text" name="keperluan" placeholder="" class="bg-focus form-control" value="<?php echo $e[keperluan]; ?>">
                            </div>
                        </div>

						<div class="form-group">
                        <label class="col-lg-2 control-label">Debet</label>
                            <div class="col-lg-9">
                            <input type="number" name="debet" placeholder="" class="bg-focus form-control" value="<?php echo $e[debet]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Kredit</label>
                            <div class="col-lg-9">
                            <input type="number" name="kredit" placeholder="" class="bg-focus form-control" value="<?php echo $e[kredit]; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label" value="<?php echo $e[tgtr]; ?>">Tanggal</label>
                            <div class="col-lg-8">
                            <input type="date" name="tgtr">
                            </div>
                        </div>                 	

                        <div class="form-group">
                            <div class="col-lg-9 pull-right">    
                            <button type="submit" name='update' class="btn btn-info">Simpan Data</button>                  
                            <button type="reset" class="btn btn-default">Reset</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
<?php            
}
include "footer.php"; 
?>
