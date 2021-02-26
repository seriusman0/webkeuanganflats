<?php
if ($_GET['aksi'] == '') {

?>
    <h4 style='padding-top:15px'>Semua Data Pengajuan</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php if ($_SESSION['level'] == '0' || $_SESSION['level'] == '1' || $_SESSION['level'] == '3') { ?>

                <?php } ?>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead class='alert-info'>
                        <tr class='gradeX'>
                            <th>No</th>
                            <th>Nama</th>
                            <th style='width:10px' class='text-right'>Angkatan</th>
                            <th>Kampus</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pengajuan = mysqli_query(
                            $conn,
                            "SELECT 
                                pengajuan.id_pengajuan, 
                                mahasiswa.nama_mhs, 
                                mahasiswa.angkatan, 
                                kampus.nama_kampus, 
                                pengajuan.subject, 
                                pengajuan.status, 
                                pengajuan.update_at
                        FROM pengajuan, mahasiswa, kampus, keperluan 
                        WHERE 	pengajuan.nif = mahasiswa.nif && 
                            mahasiswa.kampus = kampus.npsn GROUP BY pengajuan.id_pengajuan 
                    ORDER BY pengajuan.update_at DESC "
                        );

                        $no = 1;
                        while ($i = mysqli_fetch_array($pengajuan)) {
                            $semPeriod = "Ganjil";
                            if ((intval($i['semester'] % 2)) == 0) {
                                $semPeriod = "Genap";
                            }
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama_mhs]</td>
                                    <td align=center>$i[angkatan]</td>
                                    <td>$i[nama_kampus]</td>
                                    <td>$i[subject]</td>
                                    <td>" . $i['status'] . "</td>
                                    <td>" . tgl_indo($i['update_at']) . "</td>";
                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=pengajuanmhs&aksi=edit&id=$i[id_pengajuan]' title='Edit Data pengajuan ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=pengajuanmhs&aksi=hapus&id=$i[id_pengajuan]' title='Hapus pengajuan ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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

    <br>
    <h4 style='padding-top:15px'>TODAY</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php if ($_SESSION['level'] == '0' || $_SESSION['level'] == '1' || $_SESSION['level'] == '3') { ?>
                <?php } ?>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead class='alert-info'>
                        <tr class='gradeX'>
                            <th>No</th>
                            <th>Nama</th>
                            <th style='width:10px' class='text-right'>Angkatan</th>
                            <th>Kampus</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pengajuan = mysqli_query(
                            $conn,
                            "SELECT 
                                pengajuan.id_pengajuan, 
                                mahasiswa.nama_mhs, 
                                mahasiswa.angkatan, 
                                kampus.nama_kampus, 
                                pengajuan.subject, 
                                pengajuan.status, 
                                pengajuan.update_at
                        FROM pengajuan, mahasiswa, kampus, keperluan 
                        WHERE 	pengajuan.nif = mahasiswa.nif && 
                            mahasiswa.kampus = kampus.npsn GROUP BY pengajuan.id_pengajuan 
                    ORDER BY pengajuan.update_at DESC "
                        );

                        $no = 1;
                        while ($i = mysqli_fetch_array($pengajuan)) {
                            $semPeriod = "Ganjil";
                            if ((intval($i['semester'] % 2)) == 0) {
                                $semPeriod = "Genap";
                            }
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama_mhs]</td>
                                    <td align=center>$i[angkatan]</td>
                                    <td>$i[nama_kampus]</td>
                                    <td>$i[subject]</td>
                                    <td>" . $i['status'] . "</td>
                                    <td>" . tgl_indo($i['update_at']) . "</td>";
                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=pengajuanmhs&aksi=edit&id=$i[id_pengajuan]' title='Edit Data pengajuan ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=pengajuanmhs&aksi=hapus&id=$i[id_pengajuan]' title='Hapus pengajuan ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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


    <br>
    <h4 style='padding-top:15px'>3 Days Ago</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php if ($_SESSION['level'] == '0' || $_SESSION['level'] == '1' || $_SESSION['level'] == '3') { ?>
                <?php } ?>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead class='alert-info'>
                        <tr class='gradeX'>
                            <th>No</th>
                            <th>Nama</th>
                            <th style='width:10px' class='text-right'>Angkatan</th>
                            <th>Kampus</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pengajuan = mysqli_query(
                            $conn,
                            "SELECT 
                                pengajuan.id_pengajuan, 
                                mahasiswa.nama_mhs, 
                                mahasiswa.angkatan, 
                                kampus.nama_kampus, 
                                pengajuan.subject, 
                                pengajuan.status, 
                                pengajuan.update_at
                        FROM pengajuan, mahasiswa, kampus, keperluan 
                        WHERE 	pengajuan.nif = mahasiswa.nif && 
                            mahasiswa.kampus = kampus.npsn GROUP BY pengajuan.id_pengajuan 
                    ORDER BY pengajuan.update_at DESC "
                        );

                        $no = 1;
                        while ($i = mysqli_fetch_array($pengajuan)) {
                            $semPeriod = "Ganjil";
                            if ((intval($i['semester'] % 2)) == 0) {
                                $semPeriod = "Genap";
                            }
                            echo "<tr class='gradeX'>
                                    <td>$no</td>
                                    <td>$i[nama_mhs]</td>
                                    <td align=center>$i[angkatan]</td>
                                    <td>$i[nama_kampus]</td>
                                    <td>$i[subject]</td>
                                    <td>" . $i['status'] . "</td>
                                    <td>" . tgl_indo($i['update_at']) . "</td>";
                            echo "<td style='width:80px' class='text-right'>
                                                  <a class='btn' href='index.php?page=pengajuanmhs&aksi=edit&id=$i[id_pengajuan]' title='Edit Data pengajuan ini'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=pengajuanmhs&aksi=hapus&id=$i[id_pengajuan]' title='Hapus pengajuan ini' onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\" ><i class='fa fa-trash-o'></i></a>";
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
    mysqli_query($conn, "DELETE FROM pemasukkan where id_pemasukkan='$_GET[id]'");
    echo "<script>window.alert('Data Pemasukkan Berhasil Di Hapus.');
                                window.location='index.php?page=pemasukkan'</script>";
} elseif ($_GET['aksi'] == 'tambah') {
    if (isset($_POST['simpan'])) {

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
                        <div class="col-lg-9 ">
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
                        <label class="control-label">Semester</label>
                        <div class="">
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
                        <label>Tahun Ajaran</label>
                        <div>
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
        </div>
    </div>
<?php
} elseif ($_GET['aksi'] == 'edit') {

    //ambil data pengajuan
    $idPengajuan = $_GET['id'];

    $query = "SELECT * FROM pengajuan WHERE pengajuan.id_pengajuan = $idPengajuan";

    if ($r = array_filter(mysqli_fetch_array(mysqli_query($conn, $query)))) {
        $ips = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ips WHERE ips.nif='$r[nif]'"));
        $ipk = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ipk WHERE ipk.nif='$r[nif]'"));
        $dataMhs = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mahasiswa, kampus
                    WHERE  mahasiswa.nif = '$r[nif]' and mahasiswa.kampus = kampus.npsn"));
    }

?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">

    </div>


    <div class="col-md-12">
        <div class="panel panel-default">
            <form action="test2.php" method="POST" aria-readonly="true">
                <div class="panel-heading"><strong>Proses Pengajuan</strong>
                    <input type="submit" name="acc" id="acc" value="ACC" class='btn btn-success'>
                    <input type="submit" name="return" id="return" value="REVISI" class='btn btn-danger'>

                </div>
                <div class="panel-body">
                    <div align='center'>
                        <img src="../colleger/img/flats_cop.png" alt="">
                        <div class="container col-md-12" align="center">
                            <table width="100%" class="table table-striped table-bordered table-hover dataTables-example">
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                                <th width="20%"></th>
                                <th width="20%"></th>
                                <tbody>
                                    <font size="10">
                                        <tr>
                                            <td>Nama</td>
                                            <td>
                                                <input type="text" value="<?= $dataMhs['nama_mhs'] ?>" class="bg-focus form-control">
                                            </td>
                                            <td></td>
                                            <td>Kampus</td>
                                            <td colspan="2">
                                                <input type="text" value="<?= $dataMhs['nama_kampus'] ?>" class="bg-focus form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>FLATS / Semester</td>
                                            <td>
                                                <input type="text" value="<?= $dataMhs['angkatan'] ?>" class="bg-focus form-control">
                                            </td>
                                            <!-- <td>/</td> -->
                                            <td><input type="number" name="semester" min="1" max="14" placeholder="semester" id="semester" value="<?= $r['semester'] ?>" class="bg-focus form-control" required></td>
                                            <td>Tahun Ajaran</td>
                                            <td colspan="2" width="200%">
                                                <input type="text" min="2015" max="2050" name="ta" id="ta" value="<?= $r['ta'] ?>" required oninvalid="this.setCustomValidity('Jangan Lupa isi Tahun Ajaran')" oninput="setCustomValidity('')">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No HP</td>
                                            <td>
                                                <input type="text" name="nohp" id="nohp" placeholder="cth 0821xxxxxxxx" value="<?= $r['nohp'] ?>" class="bg-focus form-control">
                                            </td>
                                            <td></td>
                                            <td>IPS / IPK </td>
                                            <td>
                                                <input type="number" name="ips" id="ips" value="<?= $ips[$r['semester'] - 1] ?>" max="4">
                                            </td>

                                            <td>
                                                <input type="number" name="ipk" id="ipk" value="<?= $ipk[$r['semester'] - 1] ?>" max="4">
                                            </td>
                                        </tr>
                                    </font>
                                </tbody>
                            </table>
                            <br>

                            <table class="table table-striped table-bordered table-hover dataTables-example">

                                <tbody>
                                    <tr>
                                        <td>Catatan Mahasiswa : </td>
                                        <td>Catatan Gembala : </td>
                                        <td align="center">Catatan Biro : </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <textarea name="note_c" id="note_c" rows="5" readonly placeholder="Diisi oleh Mahasiswa"><?php note($idPengajuan, 0) ?></textarea>
                                        </td>
                                        <td>
                                            <textarea name="note_s" id="note_s" rows="5" disabled placeholder="Diisi oleh Gembala"></textarea>
                                        </td>
                                        <td>
                                            <textarea name="note_b" id="note_b" rows="5" placeholder="Diisi oleh Biro"><?php note($idPengajuan, 2) ?></textarea>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                            <table class="table table-striped table-bordered table-hover dataTables-example">

                                <tr>
                                    <td colspan="3">Tanggal Pengajuan:</td>
                                    <td colspan="3">Tanggal Revisi Ke-1</td>
                                    <td colspan="3">Tanggal Revisi Ke-2</td>
                                    <td colspan="3">Tanggal Pencairan</td>
                                </tr>
                                <tr>
                                    <td colspan="3"><input type="date" name="tgl_sub" id="tgl_sub" value="<?= $r['tgl_sub'] ?>"></td>
                                    <td colspan="3"><input type="date" name="rev_1" id="rev_1" value="<?= $r['rev_1'] ?>"></td>
                                    <td colspan="3"><input type="date" name="rev_2" id="rev_2" value="<?= $r['rev_2'] ?>"></td>
                                    <td colspan="3"><input type="date" name="acc" id="acc" value="<?= $r['acc'] ?>"></td>
                                </tr>
                            </table>
                            <br>

                            <!-- TABEL PENGAJUAN -->
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Pengajuan Biaya Pokok</th>
                                        <th>Besaran(Rp.)</th>
                                        <th>Acc Biro(Rp.)</th>
                                        <th>Biro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <input type="date" name="tgl1" id="tgl1" value="<?= item($idPengajuan, 1)['tglP'] ?>" class="bg-focus form-control">
                                        </td>
                                        <td><input type="text" name="item1" id="item1" value="<?= item($idPengajuan, 1)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP1" id="vP1" value="<?= rupiah(item($idPengajuan, 1)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc1" id="vAcc1" value="<?= item($idPengajuan, 1)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status1" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 1, 'status')['status']) ?> name="status1" />
                                                <label for="status1"></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="date" name="tgl2" id="tgl2" value="<?= item($idPengajuan, 2)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item2" id="item2" value="<?= item($idPengajuan, 2)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP2" id="vP2" value="<?= rupiah(item($idPengajuan, 2)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc2" id="vAcc2" value="<?= item($idPengajuan, 2)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status2" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 2, 'status')['status']) ?> name="status2" />
                                                <label for="status2"></label>
                                            </div>
                                        </td>

                                    <tr>
                                        <td>3</td>
                                        <td><input type="date" name="tgl3" id="tgl3" value="<?= item($idPengajuan, 3)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item3" id="item3" value="<?= item($idPengajuan, 3)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP3" id="vP3" value="<?= rupiah(item($idPengajuan, 3)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc3" id="vAcc3" value="<?= item($idPengajuan, 3)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status3" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 3, 'status')['status']) ?> value="1" name="status3" />
                                                <label for="status3"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td><input type="date" name="tgl4" id="tgl4" value="<?= item($idPengajuan, 4)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item4" id="item4" value="<?= item($idPengajuan, 4)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP4" id="vP4" value="<?= rupiah(item($idPengajuan, 4)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc4" id="vAcc4" value="<?= item($idPengajuan, 4)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status4" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 4, 'status')['status']) ?> value="1" name="status4" />
                                                <label for="status4"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td><input type="date" name="tgl5" id="tgl5" value="<?= item($idPengajuan, 5)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item5" id="item5" value="<?= item($idPengajuan, 5)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP5" id="vP5" value="<?= rupiah(item($idPengajuan, 5)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc5" id="vAcc5" value="<?= item($idPengajuan, 5)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status5" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 5, 'status')['status']) ?> value="1" name="status5" />
                                                <label for="status5"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>6</td>
                                        <td><input type="date" name="tgl6" id="tgl6" value="<?= item($idPengajuan, 6)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item6" id="item6" value="<?= item($idPengajuan, 6)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP6" id="vP6" value="<?= rupiah(item($idPengajuan, 6)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc6" id="vAcc6" value="<?= item($idPengajuan, 6)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status6" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 6, 'status')['status']) ?> value="1" name="status6" />
                                                <label for="status6"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>7</td>
                                        <td><input type="date" name="tgl7" id="tgl7" value="<?= item($idPengajuan, 7)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item7" id="item7" placeholder="Apresiasi/Depresiasi" value="<?= item($idPengajuan, 7)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP7" id="vP7" value="<?= rupiah(item($idPengajuan, 7)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc7" id="vAcc7" value="<?= item($idPengajuan, 7)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status7" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 7, 'status')['status']) ?> value="1" name="status7" />
                                                <label for="status7"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>8</td>
                                        <td><input type="date" name="tgl8" id="tgl8" value="<?= item($idPengajuan, 8)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item8" id="item8" placeholder="Sanksi Pelanggaran" value="<?= item($idPengajuan, 8)['itemP'] ?>" class="bg-primary form-control"></td>
                                        <td><input type="text" name="vP8" id="vP8" value="<?= rupiah(item($idPengajuan, 8)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc8" id="vAcc8" value="<?= item($idPengajuan, 8)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status8" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 8, 'status')['status']) ?> value="1" name="status8" />
                                                <label for="status8"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>9</td>
                                        <td><input type="date" name="tgl9" id="tgl9" value="<?= item($idPengajuan, 9)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item9" id="item9" value="<?= item($idPengajuan, 9)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP9" id="vP9" value="<?= rupiah(item($idPengajuan, 9)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc9" id="vAcc9" value="<?= item($idPengajuan, 9)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status9" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 9, 'status')['status']) ?> value="1" name="status9" />
                                                <label for="status9"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>10</td>
                                        <td><input type="date" name="tgl10" id="tgl10" value="<?= item($idPengajuan, 10)['tglP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="item10" id="item10" value="<?= item($idPengajuan, 10)['itemP'] ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vP10" id="vP10" value="<?= rupiah(item($idPengajuan, 10)['valP']) ?>" class="bg-focus form-control"></td>
                                        <td><input type="text" name="vAcc10" id="vAcc10" value="<?= item($idPengajuan, 10)['valAcc'] ?>" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="status10" type="checkbox" value="1" <?php checkStat(item($idPengajuan, 10, 'status')['status']) ?> value="1" name="status10" />
                                                <label for="status10"></label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3" align="right" class="bg--secondary">TOTAL</td>
                                        <td><input type="text" id="totalP" class="bg-focus form-control"></td>
                                        <td><input type="text" id="totalAcc" class="bg-focus form-control"></td>
                                        <td>
                                            <div class="input-checkbox">
                                                <input id="checkbox20" type="checkbox" name="agree" />
                                                <label for="checkbox20"></label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- TABEL PELANGGARAN -->
                            <br>
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead align="center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Catatan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center">1</td>
                                        <td><input type="date" name="tglP1" id="tglP1" class="bg-focus form-control"></td>
                                        <td><input type="text" name="itemP1" id="itemP1" value="Pencapaian jurnal semester" class="bg-focus form-control"></td>
                                        <td><input type="text" name="valueP1" id="valueP1" class="bg-focus form-control"></td>

                                    </tr>
                                    <tr>
                                        <td align="center">2</td>
                                        <td><input type="date" name="tglP2" id="tglP2" class="bg-focus form-control"></td>
                                        <td><input type="text" name="itemP2" id="itemP2" value="Kelebihan hari Libur" class="bg-focus form-control"></td>
                                        <td><input type="text" name="valueP2" id="valueP2" class="bg-focus form-control"></td>

                                    <tr>
                                        <td align="center">3</td>
                                        <td><input type="date" name="tglP3" id="tglP3" class="bg-focus form-control"></td>
                                        <td><input type="text" name="itemP3" id="itemP3" class="bg-focus form-control"></td>
                                        <td><input type="text" name="valueP3" id="valueP3" class="bg-focus form-control"></td>

                                    </tr>
                                    <tr>
                                        <td align="center">4</td>
                                        <td><input type="date" name="tglP4" id="tglP4" class="bg-focus form-control"></td>
                                        <td><input type="text" name="itemP4" id="itemP4" class="bg-focus form-control"></td>
                                        <td><input type="text" name="valueP4" id="valueP4" class="bg-focus form-control"></td>

                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-striped table-bordered table-hover dataTables-example">

                                <tr align="center">
                                    <td>Mahasiswa</td>
                                    <td>Gembala</td>
                                    <td>Keuangan FLATS</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="efata" id="efata" value="******" class="bg-focus form-control"></td>
                                    <td><input type="text" class="bg-focus form-control"></td>
                                    <td><input type="text" class="bg-focus form-control"></td>
                                </tr>
                                <input type="number" name="idPengajuan" id="idPengajuan" value="<?= $idPengajuan ?>">
            </form>
            </table>
            <div class="text-primary">
                <i><b>
                        *No. Efata wajib diisi 6 digit terakhir sebagai pengganti tanda tangan untuk keperluan verifikasi form.
                    </b></i>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        var rupiah = document.getElementById('vP10');
        rupiah.addEventListener('keyPressed', function(e) {
            // tambahkan 'Rp.' pada saat ketik nominal di form kolom input
            // gunakan fungsi formatRupiah() untuk mengubah nominal angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });
        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        $(document).ready(function() {
            $("#vAcc1, #vAcc2, #vAcc3, #vAcc4, #vAcc5, #vAcc6, #vAcc7, #vAcc8, #vAcc9, #vAcc10").keyup(function() {
                var vAcc1 = $("#vAcc1").val();
                var vAcc2 = $("#vAcc2").val();
                var vAcc3 = $("#vAcc3").val();
                var vAcc4 = $("#vAcc4").val();
                var vAcc5 = $("#vAcc5").val();
                var vAcc6 = $("#vAcc6").val();
                var vAcc7 = $("#vAcc7").val();
                var vAcc8 = $("#vAcc8").val();
                var vAcc9 = $("#vAcc9").val();
                var vAcc10 = $("#vAcc10").val();

                var total = Number(vAcc1) + Number(vAcc2) + Number(vAcc3) + Number(vAcc4) + Number(vAcc5) + Number(vAcc6) + Number(vAcc7) + Number(vAcc8) + Number(vAcc9) + Number(vAcc10);
                // total = formatRupiah(total);
                $("#totalAcc").val(total);
            });
        });
    </script>



<?php
}

include "footer.php";
?>