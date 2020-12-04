<?php
if ($_GET[aksi] == '') {

?>
    <h4 style='padding-top:15px'>Semua Data Pengeluaran</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php if ($_SESSION['level'] == 'user_admin' || $_SESSION['level'] == 'user_input' || $_SESSION['level'] == 'user_owner') { ?>
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
                            <th>IPK/IPS</th>
                            <th>Tahun Ajaran</th>
                            <th>Keperluan</th>
                            <th>Nominal</th>
                            <th>Uang Tinggal</th>
                            <th>Lainnya</th>
                            <th>Nominal Lainnya</th>
                            <th>Tanggal</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pengeluaran = mysqli_query($conn, "SELECT * FROM flats_pengeluaran ORDER BY id DESC");
                        $no = 1;
                        while ($i = mysqli_fetch_array($pengeluaran)) {
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama]</td>
                                    <td align=center>$i[angkatan]</td>
                                    <td align=center>$i[semester]</td>
                                    <td>$i[kampus]</td>
                                    <td align=center>$i[ip]</td>
                                    <td>$i[tahun_ajaran]</td>
                                    <td>$i[keperluan]</td>
                                    <td>" . rupiah($i['nominal']) . "</td>
                                    <td>" . rupiah($i['uang_tinggal']) . "</td>
                                    <td>$i[other]</td>
                                    <td>" . rupiah($i['other_nominal']) . "</td>
                                    <td>$i[tgl_tr]</td>";
                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=pengeluaran&aksi=edit&id=$i[id]' title='Edit Data Pengeluaran ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=pengeluaran&aksi=hapus&id=$i[id]' title='Hapus Pengeluaran ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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
    mysqli_query($conn, "DELETE FROM flats_pengeluaran where id='$_GET[id]'");
    echo "<script>window.alert('Data Pengeluaran Berhasil Di Hapus.');
                                window.location='index.php?page=pengeluaran'</script>";
} elseif ($_GET['aksi'] == 'tambah') {
    if (isset($_POST['simpan'])) {
        //ambil data mahasiswa terkait
        $keperluanmhs = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_keperluan_mhs where id='$_POST[keperluan]'"));
        $q_datmhs = mysqli_query($conn, "SELECT * FROM flats_mahasiswa WHERE id='$_POST[nama_mhs]'");
        $datmhs = mysqli_fetch_array($q_datmhs);
        $id_mhs = $datmhs[id];
        $nmhs = $datmhs[nama];
        $batchmhs = $datmhs[angkatan];
        $cammhs = $datmhs[kampus];

        mysqli_query($conn, "INSERT INTO flats_pengeluaran (id, id_mhs, nama, angkatan, semester, kampus, ip, tahun_ajaran, keperluan, nominal, uang_tinggal, other, other_nominal, tgl_tr)           
                                        VALUES('','$id_mhs','$nmhs','$batchmhs','$_POST[semester]','$cammhs','$_POST[ip]','$_POST[ta]','$keperluanmhs[keperluan]','$_POST[nominal]','$_POST[uang_tinggal]','$_POST[other]','$_POST[other_nominal]','$_POST[tgl_tr]')");

        echo "<script>window.alert('Sukses Menambahkan Data Pengeluaran .');
                                window.location='index.php?page=pengeluaran'</script>";
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
                            <?php $ambil = mysqli_query($conn, "SELECT * FROM flats_mahasiswa ORDER BY nama"); ?>
                            <select name='nama_mhs' class="form-control" required="true" autofocus>
                                <option value=''></option>
                                <?php
                                while ($r = mysqli_fetch_array($ambil)) {
                                    echo "<option value=$r[id]>$r[nama]</option>";
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
                        <label class="col-lg-2 control-label">IPK/IPS</label>
                        <div class="col-lg-9">
                            <input type="number" step="0.01" min="0" max="4" name="ip" placeholder="" class="bg-focus form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tahun Ajaran</label>
                        <div class="col-lg-9">
                            <select name='ta' class="form-control">
                                <option value='2019 Ganjil'>2019 Ganjil</option>
                                <option value='2020 Genap'>2020 Genap</option>
                                <option value='2020 Ganjil'>2020 Ganjil</option>
                                <option value='2021 Genap'>2021 Genap</option>
                                <option value='2021 Ganjil'>2021 Ganjil</option>
                                <option value='2022 Genap'>2022 Genap</option>
                                <option value='2022 Ganjil'>2022 Ganjil</option>
                                <option value='2023 Genap'>2023 Genap</option>
                                <option value='2023 Ganjil'>2023 Ganjil</option>
                                <option value='2024 Genap'>2024 Genap</option>
                                <option value='2024 Ganjil'>2024 Ganjil</option>
                                <option value='2025 Genap'>2025 Genap</option>
                                <option value='2025 Ganjil'>2025 Ganjil</option>
                                <option value='2026 Genap'>202 Genap</option>
                                <option value='2026 Ganjil'>2026 Ganjil</option>
                                <option value='2027 Genap'>2027 Genap</option>
                                <option value='2027 Ganjil'>2027 Ganjil</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Keperluan</label>
                        <div class="col-lg-9">
                            <?php $qkeperluan = mysqli_query($conn, "SELECT * FROM flats_keperluan_mhs ORDER BY id"); ?>
                            <select name='keperluan' class="form-control">
                                <option value=''></option>
                                <?php
                                while ($r = mysqli_fetch_array($qkeperluan)) {
                                    echo "<option value=$r[id]>$r[keperluan]</option>";
                                } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nominal</label>
                        <div class="col-lg-9">
                            <input type="number" name="nominal" placeholder="" class="bg-focus form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Uang Tinggal</label>
                        <div class="col-lg-9">
                            <input type="number" name="uang_tinggal" placeholder="" class="bg-focus form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Lainnya</label>
                        <div class="col-lg-9">
                            <input type="text" name="other" placeholder="" class="bg-focus form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nominal Lainnya</label>
                        <div class="col-lg-9">
                            <input type="number" name="other_nominal" placeholder="" class="bg-focus form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tanggal</label>
                        <div class="col-lg-8">
                            <input type="date" name="tgl_tr">
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
} elseif ($_GET[aksi] == 'edit') {
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_pengeluaran WHERE id='$_GET[id]'"));

    if (isset($_POST['update'])) {
        mysqli_query($conn, "UPDATE flats_pengeluaran SET semester       = '$_POST[semester]',
                                                            ip    = '$_POST[ip]',
                                                            tahun_ajaran    = '$_POST[ta]',
                                                            keperluan    = '$_POST[keperluan]',
                                                            nominal      = '$_POST[nominal]',
                                                            uang_tinggal         = '$_POST[uang_tinggal]',
                                                            other        = '$_POST[other]',
                                                            other_nominal    = '$_POST[other_nominal]',
                                                            tgl_tr     = '$_POST[tgl_tr]' WHERE id ='$_GET[id]'");

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
                            $eambil = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM flats_pengeluaran where id=$_GET[id]"));

                            ?>
                            <input type="text" name="nama_mhs" placeholder="true" value="<?php echo $eambil[nama]; ?>" disabled class="bg-focus form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Semester</label>
                        <div class="col-lg-9">
                            <input type="number" max="14" name="semester" placeholder="" class="bg-focus form-control" value="<?php echo $eambil[semester]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">IPK/IPS</label>
                        <div class="col-lg-9">
                            <input type="number" step="0.01" min="0" max="4" name="ip" placeholder="" class="bg-focus form-control" value="<?php echo $eambil[ip]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tahun Ajaran</label>
                        <div class="col-lg-9">
                            <select name='ta' class="form-control">
                                <option value='<?php echo $eambil[tahun_ajaran]; ?>'><?php echo $eambil[tahun_ajaran]; ?></option>
                                <option value='2020 Ganjil'>2020 Ganjil</option>
                                <option value='2020 Genap'>2020 Genap</option>
                                <option value='2021 Ganjil'>2021 Ganjil</option>
                                <option value='2021 Genap'>2021 Genap</option>
                                <option value='2022 Ganjil'>2022 Ganjil</option>
                                <option value='2022 Genap'>2022 Genap</option>
                                <option value='2023 Ganjil'>2023 Ganjil</option>
                                <option value='2023 Genap'>2023 Genap</option>
                                <option value='2024 Ganjil'>2024 Ganjil</option>
                                <option value='2024 Genap'>2024 Genap</option>
                                <option value='2025 Ganjil'>2025 Ganjil</option>
                                <option value='2025 Genap'>2025 Genap</option>
                                <option value='2026 Ganjil'>2026 Ganjil</option>
                                <option value='2026 Genap'>2026 Genap</option>
                                <option value='2027 Ganjil'>2027 Ganjil</option>
                                <option value='2027 Genap'>2027 Genap</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Keperluan</label>
                        <div class="col-lg-9">
                            <input type="text" name="keperluan" placeholder="" class="bg-focus form-control" value="<?php echo $eambil[keperluan]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nominal</label>
                        <div class="col-lg-9">
                            <input type="number" name="nominal" placeholder="" class="bg-focus form-control" value="<?php echo $eambil[nominal]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Uang Tinggal</label>
                        <div class="col-lg-9">
                            <input type="number" name="uang_tinggal" placeholder="" class="bg-focus form-control" value="<?php echo $eambil[uang_tinggal]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Lainnya</label>
                        <div class="col-lg-9">
                            <input type="text" name="other" placeholder="" class="bg-focus form-control" value="<?php echo $eambil[other]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nominal Lainnya</label>
                        <div class="col-lg-9">
                            <input type="number" name="other_nominal" placeholder="" class="bg-focus form-control" value="<?php echo $eambil[other_nominal]; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Tanggal</label>
                        <div class="col-lg-8">
                            <input type="date" name="tgl_tr" value="<?php echo $eambil[tgl_tr]; ?>">
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