<?php
if ($_GET['aksi'] == '') {

?>
    <h4 style='padding-top:15px'>Semua Data Pengeluaran</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php if ($_SESSION['level'] == '0' || $_SESSION['level'] == '1' || $_SESSION['level'] == '3') { ?>
                    <a class='btn btn-primary' href='index.php?page=pengeluaran&aksi=tambah'><i class='fa fa-plus'></i> Tambah Pengeluaran</a>
                    <a class='btn btn-success' href='db_to_excell_pengeluaran.php'><i class='fa fa-file'></i> Export ke Excel</a>
                <?php } ?>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
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
                        $pengeluaran = mysqli_query($conn, "SELECT 
                        pengeluaran.id_pengeluaran, 
                        mahasiswa.nama_mhs,
                        mahasiswa.angkatan, 
                        pengeluaran.semester,
                        kampus.nama_kampus, 
                        pengeluaran.ta, 
                        keperluan.nama_keperluan,
                        pengeluaran.ket, 
                        pengeluaran.nominal, 
                        pengeluaran.tgl, 
                        user_management.user_name
                        FROM pengeluaran, mahasiswa, kampus, keperluan, user_management 
                        WHERE  pengeluaran.nif = mahasiswa.nif && pengeluaran.keperluan= keperluan.id_keperluan && pengeluaran.iBy = user_management.id_user && mahasiswa.kampus = kampus.npsn
                        ORDER BY pengeluaran.id_pengeluaran DESC LIMIT 500");
                        $no = 1;
                        while ($i = mysqli_fetch_array($pengeluaran)) {
                            $semPeriod = "Ganjil";
                            if ((intval($i['semester'] % 2)) == 0) {
                                $semPeriod = "Genap";
                            }

                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama_mhs]</td>
                                    <td align=center>$i[angkatan]</td>
                                    <td align=center>$i[semester]</td>
                                    <td>$i[nama_kampus]</td>
                                    <td>$i[ta] $semPeriod</td>
                                    <td>$i[nama_keperluan]  <b><i>$i[ket]</i></b></td>
                                    <td>" . rupiah($i['nominal']) . "</td>
                                    <td>$i[user_name]</td>
                                    <td>$i[tgl]</td>";
                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=pengeluaran&aksi=edit&id=$i[id_pengeluaran]' title='Edit Data Pengeluaran ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=pengeluaran&aksi=hapus&id=$i[id_pengeluaran]' title='Hapus Pengeluaran ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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
    mysqli_query($conn, "DELETE FROM pengeluaran where id_pengeluaran='$_GET[id]'");
    echo "<script>window.alert('Data Pengeluaran Berhasil Di Hapus.');
                                window.location='index.php?page=pengeluaran'</script>";
} elseif ($_GET['aksi'] == 'tambah') {
    if (isset($_POST['simpan'])) {

        mysqli_query($conn, "INSERT INTO pengeluaran VALUES(NULL,'$_POST[nama_mhs]','$_POST[semester]','$_POST[ta]','$_POST[keperluan]','$_POST[other]','$_POST[nominal]','$_POST[tgl_tr]','$_SESSION[id]')");

        echo "<script>window.alert('Sukses Menambahkan Data Pengeluaran .');
                window.location='index.php?page=pengeluaran&aksi=tambah'</script>";
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Pengeluaran</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Mahasiswa</label>
                        <div class="col-lg-9">
                            <?php $ambil = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama_mhs"); ?>
                            <select name='nama_mhs' class="form-control" required="true" autofocus>
                                <option value=''></option>
                                <?php
                                while ($r = mysqli_fetch_array($ambil)) {
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
                            <?php $qkeperluan = mysqli_query($conn, "SELECT * FROM keperluan ORDER BY id_keperluan"); ?>
                            <select name='keperluan' class="form-control">
                                <option value=''></option>
                                <?php
                                while ($r = mysqli_fetch_array($qkeperluan)) {
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

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
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
                        $pengeluaran = mysqli_query($conn, "SELECT 
                        pengeluaran.id_pengeluaran, 
                        mahasiswa.nama_mhs,
                        mahasiswa.angkatan, 
                        pengeluaran.semester,
                        kampus.nama_kampus, 
                        pengeluaran.ta, 
                        keperluan.nama_keperluan,
                        pengeluaran.ket, 
                        pengeluaran.nominal, 
                        pengeluaran.tgl, 
                        user_management.user_name
                        FROM pengeluaran, mahasiswa, kampus, keperluan, user_management 
                        WHERE  pengeluaran.nif = mahasiswa.nif && pengeluaran.keperluan= keperluan.id_keperluan && pengeluaran.iBy = user_management.id_user && mahasiswa.kampus = kampus.npsn
                        ORDER BY pengeluaran.id_pengeluaran DESC LIMIT 10");
                        $no = 1;
                        while ($i = mysqli_fetch_array($pengeluaran)) {
                            $semPeriod = "Ganjil";
                            if ((intval($i['semester'] % 2)) == 0) {
                                $semPeriod = "Genap";
                            }

                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama_mhs]</td>
                                    <td align=center>$i[angkatan]</td>
                                    <td align=center>$i[semester]</td>
                                    <td>$i[nama_kampus]</td>
                                    <td>$i[ta] $semPeriod</td>
                                    <td>$i[nama_keperluan]  <b><i>$i[ket]</i></b></td>
                                    <td>" . rupiah($i['nominal']) . "</td>
                                    <td>$i[user_name]</td>
                                    <td>$i[tgl]</td>";
                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=pengeluaran&aksi=edit&id=$i[id_pengeluaran]' title='Edit Data Pengeluaran ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=pengeluaran&aksi=hapus&id=$i[id_pengeluaran]' title='Hapus Pengeluaran ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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
<?php
} elseif ($_GET['aksi'] == 'edit') {
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pengeluaran WHERE id_pengeluaran='$_GET[id]'"));

    if (isset($_POST['simpan'])) {
        mysqli_query($conn, "UPDATE pengeluaran SET nif       = '$_POST[nama_mhs]',
                                                            semester    = '$_POST[semester]',
                                                            ta    = '$_POST[ta]',
                                                            keperluan    = '$_POST[keperluan]',
                                                            ket      = '$_POST[other]',
                                                            nominal         = '$_POST[nominal]',
                                                            tgl        = '$_POST[tgl_tr]',
                                                            iBy    = '$_SESSION[id]'
                                                            WHERE id_pengeluaran ='$_GET[id]'");

        echo "<script>window.alert('Sukses Update Data Pengeluaran.');
                                window.location='index.php?page=pengeluaran'</script>";
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Pengeluaran</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Mahasiswa</label>
                        <div class="col-lg-9">
                            <?php
                            $ambil = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY nama_mhs");
                            $rNamaMhs = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nif='$e[nif]'"));
                            ?>
                            <select name='nama_mhs' class="form-control" required="true" autofocus>
                                <option value='<?= $e["nif"] ?>'><?= $rNamaMhs['nama_mhs']; ?></option>
                                <?php
                                while ($r = mysqli_fetch_array($ambil)) {
                                    echo "<option value=$r[nif]>$r[nama_mhs]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Semester</label>
                        <div class="col-lg-9">
                            <select name='semester' class="form-control" required="true">
                                <option value='<?= $e["semester"] ?>'><?= $e['semester']; ?></option>
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
                                <option value='<?= $e["ta"] ?>'><?= $e["ta"] ?></option>
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
                            $qkeperluan = mysqli_query($conn, "SELECT * FROM keperluan ORDER BY id_keperluan");
                            $rKeperluan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM keperluan WHERE id_keperluan='$e[keperluan]'"));
                            ?>
                            <select name='keperluan' class="form-control">
                                <option value='<?= $e["keperluan"] ?>'><?= $rKeperluan['nama_keperluan']; ?></option>
                                <?php
                                while ($r = mysqli_fetch_array($qkeperluan)) {
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