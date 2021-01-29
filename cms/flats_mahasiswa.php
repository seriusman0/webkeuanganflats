<?php
if ($_GET['aksi'] == '') {
?>
    <h4 style='padding-top:15px'>Data Nama-Nama Mahasiswa Binaan FLATS</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class='btn btn-primary' href='index.php?page=mahasiswa&aksi=tambah'><i class='fa fa-plus'></i> Tambah Mahasiswa</a>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead class='alert-info'>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Angkatan</th>
                            <th>Kampus</th>
                            <th>UKT</th>
                            <th>Gembala</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $mahasiswa = mysqli_query($conn, "SELECT mahasiswa.nama_mhs, mahasiswa.angkatan, kampus.nama_kampus, mahasiswa.ukt, gembala.nama_gembala 
                        FROM mahasiswa, kampus, gembala 
                        WHERE mahasiswa.kampus = kampus.npsn && mahasiswa.gembala_mhs = gembala.nig 
                        ORDER BY mahasiswa.angkatan DESC");

                        $no = 1;
                        while ($i = mysqli_fetch_array($mahasiswa)) {
                            echo "<tr class='gradeX'>
                                    <td width=7% align='center'>$no</td>
                                    <td width=20%>$i[nama_mhs]</td>
                                    <td width=7% align=center>$i[angkatan]</td>
                                    <td>$i[nama_kampus]</td>
                                    <td>" . rupiah($i['ukt']) . "</td>
                                    <td>$i[nama_gembala]</td>";
                            echo "<td style='width:130px' class='text-right'><a class='btn' href='index.php?page=mahasiswa&aksi=edit&id=$i[nif]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=mahasiswa&aksi=hapus&id=$i[nif]'  onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"  title='Hapus Mahasiswa ini'><i class='fa fa-trash-o'></i></a>
                                                  <a class='btn' href='#' title='Lihat Data Keuangan Mahasiswa Ini'><i class='fa fa-user'></i></a>";
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
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE nif='$_GET[id]'");
    echo "<script>window.alert('Data User Berhasil Di Hapus.');
                                window.location='index.php?page=mahasiswa'</script>";
} elseif ($_GET['aksi'] == 'tambah') {

    if (isset($_POST['simpan'])) {

        //cek apakah ada yang sama
        $ceknif    = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nif = '$_POST[nif]'"));
        if ($ceknif > 0) {
            echo "<script>window.alert('NIF yang digunakan sudah ada.');
                        window.location='index.php?page=mahasiswa'</script>";
        } else {

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            mysqli_query($conn, "INSERT INTO mahasiswa VALUES 
                    ('$_POST[nif]', '$_POST[nama_lengkap]', '$_POST[angkatan]', '$_POST[kampus]', '$_POST[username]', '$password', '','$_POST[gembala]','$_POST[repo_mhs]')");
            echo "<script>window.alert('Sukses Menambahkan Mahasiswa.');
                        window.location='index.php?page=mahasiswa'</script>";
        }
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Data Mahasiswa</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">NIF</label>
                        <div class="col-lg-4">
                            <input type="text" name="nif" max="7" placeholder="nif maks 7 character" autofocus class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                        <div class="col-lg-4">
                            <input type="text" name="nama_lengkap" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Angkatan</label>
                        <div class="col-lg-4">
                            <select name="angkatan" class="form-control">
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kampus</label>
                        <div class="col-lg-4">
                            <?php $ambil = mysqli_query($conn, "SELECT * FROM kampus ORDER BY nama_kampus ASC"); ?>
                            <select name='kampus' class="form-control" required="true">
                                <option value=''></option>
                                <?php
                                while ($r = mysqli_fetch_array($ambil)) {
                                    echo "<option value=$r[npsn]>$r[nama_kampus]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-4">
                            <input type="text" name="username" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-4">
                            <input type="text" name="password" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gembala</label>
                        <div class="col-lg-4">
                            <?php $ambil = mysqli_query($conn, "SELECT * FROM gembala ORDER BY nama_gembala ASC"); ?>
                            <select name='gembala' class="form-control" required="true">
                                <option value=''></option>
                                <?php
                                while ($r = mysqli_fetch_array($ambil)) {
                                    echo "<option value=$r[nig]>$r[nama_gembala]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Repository</label>
                        <div class="col-lg-4">
                            <input type="text" name="repo_mhs" class="bg-focus form-control">
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
    $e = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nif = '$_GET[id]'"));

    //ambil nama kampus
    if (isset($_POST['update'])) {
        if ($_POST['password'] != '') {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            mysqli_query($conn, "UPDATE mahasiswa SET
                                                                           nama_mhs   = '$_POST[nama_lengkap]',
                                                                           angkatan   = '$_POST[angkatan]',
                                                                           kampus      = '$_POST[kampus]',
                                                                           username_mhs      = '$_POST[username]',
                                                                           password_mhs      = '$password',
                                                                           gembala_mhs      = '$_POST[gembala]',
                                                                           repo      = '$_POST[repo_mhs]'
                                                                           WHERE nif = '$_GET[id]'");
            // echo "<script>window.alert('Password Di update.');</script>";
        } else {
            mysqli_query($conn, "UPDATE mahasiswa SET
                                                                           nama_mhs   = '$_POST[nama_lengkap]',
                                                                           angkatan   = '$_POST[angkatan]',
                                                                           kampus      = '$_POST[kampus]',
                                                                           username_mhs      = '$_POST[username]',
                                                                           gembala_mhs      = '$_POST[gembala]',
                                                                           repo      = '$_POST[repo_mhs]'
                                                                           WHERE nif = '$_GET[id]'");
            // echo "<script>window.alert('Password Masih tetap sama.');</script>";
        }
        echo "<script>window.alert('Sukses Update Data Mahasiswa.');
                                    window.location='index.php?page=mahasiswa'</script>";
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Data Mahasiswa</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Lengkap</label>
                        <div class="col-lg-4">
                            <input type="text" name="nama_lengkap" value="<?= $e['nama_mhs'] ?>" autofocus placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Angkatan</label>
                        <div class="col-lg-4">
                            <select name="angkatan" class="form-control">
                                <option value="<?= $e['angkatan'] ?>"><?= $e['angkatan'] ?></option>
                                <option value="36">36</option>
                                <option value="37">37</option>
                                <option value="38">38</option>
                                <option value="39">39</option>
                                <option value="40">40</option>
                                <option value="41">41</option>
                                <option value="42">42</option>
                                <option value="43">43</option>
                                <option value="44">44</option>
                                <option value="45">45</option>
                                <option value="46">46</option>
                                <option value="47">47</option>
                                <option value="48">48</option>
                                <option value="49">49</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kampus</label>
                        <div class="col-lg-4">
                            <?php
                            $ambil = mysqli_query($conn, "SELECT * FROM kampus ORDER BY nama_kampus ASC");
                            $qNKampus = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kampus WHERE npsn = '$e[kampus]'"));

                            ?>
                            <select name='kampus' class="form-control" required="true">
                                <option value="<?= $e['kampus'] ?>"><?= $qNKampus['nama_kampus'] ?></option>
                                <?php
                                while ($r = mysqli_fetch_array($ambil)) {
                                    echo "<option value=$r[npsn]>$r[nama_kampus]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-4">
                            <input type="text" name="username" value="<?= $e['username_mhs'] ?>" placeholder="" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-4">
                            <input type="text" name="password" placeholder="kosongkan jika tidak ada perubahan" class="bg-focus form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gembala</label>
                        <div class="col-lg-4">
                            <?php $ambil = mysqli_query($conn, "SELECT * FROM gembala ORDER BY nama_gembala ASC");
                            $qNGembala = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM gembala where nig = '$e[gembala_mhs]'")); ?>
                            <select name='gembala' class="form-control" required="true">
                                <option value="<?= $e['gembala_mhs'] ?>"><?= $qNGembala['nama_gembala'] ?></option>
                                <?php
                                while ($r = mysqli_fetch_array($ambil)) {
                                    echo "<option value=$r[nig]>$r[nama_gembala]</option>";
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Repository</label>
                        <div class="col-lg-4">
                            <input type="text" name="repo_mhs" value="<?= $e['repo'] ?>" class="bg-focus form-control">
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
<?php }
include "footer.php";
?>