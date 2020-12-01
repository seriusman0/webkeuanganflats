<?php 
    if ($_GET['aksi']==''){
    
?>
        <h4 style='padding-top:15px'>Semua Data Pemasukkan</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if ($_SESSION['level']=='0' || $_SESSION['level']=='1' || $_SESSION['level']=='3'){ ?>
                        <a class='btn btn-primary' href='index.php?page=pemasukkan&aksi=tambah'><i class='fa fa-plus'></i> Tambah Pemasukkan</a>
                        <a class='btn btn-success' href='#.php'><i class='fa fa-file'></i> Export ke Excel</a>
                    <?php } ?>
                </div>

                <div class="panel-body">
                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead class='alert-info'>
                    <tr class='gradeX'>
                        <th>No</th>
                        <th>Nama</th>
                        <th style='width:10px' class='text-right'>Angkatan</th>
                        <th>Semester</th>
                        <th>Kampus</th>
                        <th>Tahun Ajaran</th>
                        <th>Keperluan</th>
                        <th>Nominal</th>
                        <th>inBy</th>
                        <th>Tanggal</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $pemasukkan = mysqli_query($conn, "SELECT * FROM pemasukkan ORDER BY id_pemasukkan DESC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($pemasukkan)){
                            $qPemasukkan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nif = '$i[nif]'"));
                            $qkampus = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kampus WHERE npsn = '$qPemasukkan[kampus]'"));
                            $qkeperluan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM keperluan WHERE id_keperluan = '$i[keperluan]'"));
                            $qinBy = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM user_management WHERE id_user = '$i[iBy]'"));

                            $semPeriod = "Ganjil";
                            if ((intval($i['semester']%2)) == 0) {
                                $semPeriod = "Genap";
                            }
                             
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$qPemasukkan[nama_mhs]</td>
                                    <td align=center>$qPemasukkan[angkatan]</td>
                                    <td align=center>$i[semester]</td>
                                    <td>$qkampus[nama_kampus]</td>
                                    <td>$i[ta] $semPeriod</td>
                                    <td>$qkeperluan[nama_keperluan]  <b><i>$i[ket]</i></b></td>
                                    <td>".rupiah($i['nominal'])."</td>
                                    <td>$qinBy[user_name]</td>
                                    <td>$i[tgl]</td>";
                                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=pemasukkan&aksi=edit&id=$i[id_pemasukkan]' title='Edit Data Pemasukkan ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=pemasukkan&aksi=hapus&id=$i[id_pemasukkan]' title='Hapus Pemasukkan ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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
    mysqli_query($conn, "DELETE FROM pemasukkan where id_pemasukkan='$_GET[id]'");
    echo "<script>window.alert('Data Pemasukkan Berhasil Di Hapus.');
                                window.location='index.php?page=pemasukkan'</script>";

}elseif ($_GET['aksi']=='tambah'){ 
    if (isset($_POST['simpan'])){

        mysqli_query($conn, "INSERT INTO pemasukkan VALUES('','$_POST[nama_mhs]','$_POST[semester]','$_POST[ta]','$_POST[keperluan]','$_POST[other]','$_POST[nominal]','$_POST[tgl_tr]','$_SESSION[id]')");
                     
        echo "<script>window.alert('Sukses Menambahkan Data Pemasukkan .');
                window.location='index.php?page=pemasukkan'</script>";
                
    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Pemasukkan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Mahasiswa</label>
                            <div class="col-lg-9">
                            <?php $ambil=mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama_mhs"); ?>
                            <select name='nama_mhs' class="form-control" required="true" autofocus>
                                <option value=''></option>
                                <?php
                                while($r=mysqli_fetch_array($ambil)){ 
                                  echo "<option value=$r[nif]>$r[nama_mhs]</option>"; 
                                } ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Semester</label>
                            <div class="col-lg-9">
                            <select name='semester' class="form-control" required="true">
                                <option value=''></option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                                <option value='13'>13</option>
                                <option value='14'>14</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tahun Ajaran</label>
                            <div class="col-lg-9">
                            <select name='ta' class="form-control">
                                <option value='2019'>2019</option>
                                <option value='2020'>2020</option>
                                <option value='2021'>2021</option>
                                <option value='2022'>2022</option>
                                <option value='2023'>2023</option>
                                <option value='2024'>2024</option>
                                <option value='2025'>2025</option>
                                <option value='2026'>2026</option>
                                <option value='2027'>2027</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Keperluan</label>
                            <div class="col-lg-9">
                            <?php $qkeperluan=mysqli_query($conn, "SELECT * FROM keperluan ORDER BY id_keperluan"); ?>
                            <select name='keperluan' class="form-control">
                                <option value=''></option>
                                <?php
                                while($r=mysqli_fetch_array($qkeperluan)){ 
                                  echo "<option value=$r[id_keperluan]>$r[nama_keperluan]</option>"; 
                                } ?>
                                
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lainnya</label>
                            <div class="col-lg-9">
                            <input type="text" name="other" placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nominal</label>
                            <div class="col-lg-9">
                            <input type="number" name="nominal" placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-8">
                            <input type="date" name="tgl_tr" value="<?= date('d-m-Y'); ?>">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pemasukkan WHERE id_pemasukkan='$_GET[id]'"));

    if (isset($_POST['simpan'])){
                        mysqli_query($conn, "UPDATE pemasukkan SET nif       = '$_POST[nama_mhs]',
                                                            semester    = '$_POST[semester]',
                                                            ta    = '$_POST[ta]',
                                                            keperluan    = '$_POST[keperluan]',
                                                            ket      = '$_POST[other]',
                                                            nominal         = '$_POST[nominal]',
                                                            tgl        = '$_POST[tgl_tr]',
                                                            iBy    = '$_SESSION[id]'
                                                            WHERE id_pemasukkan ='$_GET[id]'");
                        
                        echo "<script>window.alert('Sukses Update Data Pemasukkan.');
                                window.location='index.php?page=pemasukkan'</script>";
                    }
?>

                <h4 style='padding-top:15px'></h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Pemasukkan</strong></div>
                <div class="panel-body">
                    <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Mahasiswa</label>
                            <div class="col-lg-9">
                            <?php 
                                $ambil=mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama_mhs");
                                $rNamaMhs= mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nif='$e[nif]'"));
                            ?>
                            <select name='nama_mhs' class="form-control" required="true" autofocus>
                                <option value='<?= $e["nif"] ?>'><?=$rNamaMhs['nama_mhs'];?></option>
                                <?php
                                while($r=mysqli_fetch_array($ambil)){ 
                                  echo "<option value=$r[nif]>$r[nama_mhs]</option>"; 
                                } ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Semester</label>
                            <div class="col-lg-9">
                            <select name='semester' class="form-control" required="true">
                                <option value='<?= $e["semester"] ?>'><?=$e['semester'];?></option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                                <option value='13'>13</option>
                                <option value='14'>14</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tahun Ajaran</label>
                            <div class="col-lg-9">
                            <select name='ta' class="form-control">
                                <option value='<?= $e["ta"]?>'><?= $e["ta"]?></option>
                                <option value='2019'>2019</option>
                                <option value='2020'>2020</option>
                                <option value='2021'>2021</option>
                                <option value='2022'>2022</option>
                                <option value='2023'>2023</option>
                                <option value='2024'>2024</option>
                                <option value='2025'>2025</option>
                                <option value='2026'>2026</option>
                                <option value='2027'>2027</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Keperluan</label>
                            <div class="col-lg-9">
                            <?php 
                                $qkeperluan=mysqli_query($conn, "SELECT * FROM keperluan ORDER BY id_keperluan");  
                                $rKeperluan=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM keperluan WHERE id_keperluan='$e[keperluan]'"));
                            ?>
                            <select name='keperluan' class="form-control">
                                <option value='<?= $e["keperluan"] ?>'><?=$rKeperluan['nama_keperluan'];?></option>
                                <?php
                                while($r=mysqli_fetch_array($qkeperluan)){ 
                                  echo "<option value=$r[id_keperluan]>$r[nama_keperluan]</option>"; 
                                } ?>
                                
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Lainnya</label>
                            <div class="col-lg-9">
                            <input type="text" name="other" placeholder="" value='<?= $e["ket"] ?>' class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-lg-2 control-label">Nominal</label>
                            <div class="col-lg-9">
                            <input type="number" name="nominal" value='<?= $e["nominal"] ?>' placeholder="" class="bg-focus form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Tanggal</label>
                            <div class="col-lg-8">
                            <input type="date" name="tgl_tr" value="<?= $e['tgl']; ?>">
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
}
include "footer.php"; 
?>
