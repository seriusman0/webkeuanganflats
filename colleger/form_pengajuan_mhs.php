<?php
cekLogin();

if (isset($_POST['submit'])) {

    $nif = $_SESSION['nif'];
    $semester = $_POST['semester'];
    $ta = $_POST['ta'];
    $nohp = $_POST['nohp'];
    $note_c = $_POST['note_c'];
    $tgl_sub = $_POST['tgl_sub'];
    $rev_1 = $_POST['rev_1'];
    $rev_2 = $_POST['rev_2'];
    $acc = $_POST['acc'];
    $status = 1;

    // INPUT PENGAJUAN 
    $query = "INSERT INTO `pengajuan` 
(`id_pengajuan`, `nif`, `semester`, `ta`, `nohp`, `tgl_sub`, `rev_1`, `rev_2`, `acc`, `status`) 
VALUES (NULL, '$nif', '$semester', '$ta', '$nohp', '$tgl_sub', '$rev_1', '$rev_2', '$acc', '$status')";
    if (mysqli_query($conn, $query)) {
        if ($note_c != '') {
            $lastId = mysqli_insert_id($conn);
            $note_arr = array($note_c, $note_s, $note_b);
            $input_comment = "INSERT INTO note(note_fid_pengajuan, note_fill, note_by) VALUES ('$lastId', '$note_c', '0')";
            if (mysqli_query($conn, $input_comment)  == true) {
                echo "<script>alert('Input comment Berhasil')</script>";
            } else {
                echo "<script>alert('Input comment Gagal')</script>";
            }
        }

        // INPUT ITEM PENGAJUAN
        $tgl = array($_POST["tgl1"], $_POST["tgl2"], $_POST["tgl3"], $_POST["tgl4"], $_POST["tgl5"], $_POST["tgl6"]);
        $item = array($_POST["item1"], $_POST["item2"], $_POST["item3"], $_POST["item4"], $_POST["item5"], $_POST["item6"]);
        $vP = array($_POST["vP1"], $_POST["vP2"], $_POST["vP3"], $_POST["vP4"], $_POST["vP5"], $_POST["vP6"]);
        $vAcc = array($_POST["vAcc1"], $_POST["vAcc2"], $_POST["vAcc3"], $_POST["vAcc4"], $_POST["vAcc5"], $_POST["vAcc6"]);
        $status = array($_POST["status1"], $_POST["status2"], $_POST["status3"], $_POST["status4"], $_POST["status5"], $_POST["status6"]);

        $count = 0;

        while ($count < 6) {
            if ($item[$count] == '') {
                break;
            } else {
                $row = $count + 1;
                mysqli_query($conn, "INSERT INTO detail_pengajuan values (NULL,'$lastId','$row')");
                $lastIdDetailPengajuan = mysqli_insert_id($conn);
                $updateNow = date('Y-m-d H:i:s');
                mysqli_query($conn, "INSERT INTO `sub_detail_pengajuan` (`id_sub_detail_pengajuan`, `fid_detail_pengajuan`, `tglP`, `itemP`, `valP`, `valAcc`, `status`) 
                        VALUES (NULL, '$lastIdDetailPengajuan', '$tgl[$count]', 
                        '$item[$count]', '$vP[$count]', '$vAcc[$count]', '0')");
            }
            $count += 1;
        }

        echo "<script>alert('Input Pengajuan Berhasil. Silakan Tunggu Proses Selanjutnya  . . . .')</script>";
    } else {
        echo "Gagal Input Pengajuan";
    }
}

?>
<html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Form Pengajuan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site Description Here">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/stack-interface.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/socicon.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/flickity.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/iconsmind.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/jquery.steps.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/theme.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,400,400i,500,600,700%7CMerriweather:300,300i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="container">
    <?php if ($_GET['act'] == '') { ?>
        <div class="boxed boxed--border">
            <h1 align="center" class="text-primary">Pengajuan dan Rekapitulasi
                Penggunaan Dana Beasiswa FLATS</h1>
            <table class="border--round table--alternate-column">
                <tbody>
                    <form action="" method="POST">
                        <tr>
                            <td>Nama</td>
                            <td width=40% colspan="3">
                                <input type="text" name="name" id="name" value="<?= $_SESSION['name'] ?>" disabled>
                            </td>
                            <td>Kampus</td>
                            <td width=40% colspan="3">
                                <input type="text" name="kampus" id="kampus" value="<?= $_SESSION['kampus'] ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>FLATS / Semester</td>
                            <td>
                                <input type="text" name="kampus" id="kampus" value="<?= $_SESSION['angkatan'] ?>" disabled>
                            </td>
                            <td>/</td>
                            <td><input type="number" name="semester" min="1" max="14" placeholder="semester" id="semester" required></td>
                            <td>Tahun Ajaran</td>
                            <td colspan="3">
                                <input type="text" min="2015" max="2050" name="ta" id="ta" required oninvalid="this.setCustomValidity('Jangan Lupa isi Tahun Ajaran')" oninput="setCustomValidity('')">
                            </td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td colspan="3">
                                <input type="text" name="nohp" id="nohp" placeholder="cth 0821xxxxxxxx" required>
                            </td>
                            <td>IPS / IPK </td>
                            <td>
                                <input type="number" name="ips" id="ips" disabled max="4">
                            </td>
                            <td>/</td>
                            <td>
                                <input type="number" name="ipk" id="ipk" disabled max="4">
                            </td>
                        </tr>
                </tbody>
            </table>

            <table class="border--round">

                <tbody>
                    <tr>
                        <td>Catatan Mahasiswa : </td>
                        <td>Catatan Gembala : </td>
                        <td>Catatan Biro : </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea name="note_c" id="note_c" rows="5" placeholder="Diisi oleh Mahasiswa"></textarea>
                        </td>
                        <td>
                            <textarea name="note_s" id="note_s" rows="5" placeholder="Diisi oleh Gembala" disabled></textarea>
                        </td>
                        <td>
                            <textarea name="note_b" id="note_b" rows="5" placeholder="Diisi oleh Biro" disabled></textarea>
                        </td>
                    </tr>

                </tbody>
            </table>

            <table>

                <tr>
                    <td>Tanggal Pengajuan:</td>
                    <td>Tanggal Revisi Ke-1</td>
                    <td>Tanggal Revisi Ke-2</td>
                    <td>Tanggal Pencairan</td>
                </tr>
                <tr>
                    <td><input type="date" name="tgl_sub" id="tgl_sub" value="<?= date('Y-m-d') ?>"></td>
                    <td><input type="date" name="rev_1" id="rev_1"></td>
                    <td><input type="date" name="rev_2" id="rev_2"></td>
                    <td><input type="date" name="acc" id="acc"></td>
                </tr>
            </table>


            <!-- TABEL PENGAJUAN -->
            <table class="border--round">
                <thead class="bg-primary">
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
                        <td><input type="date" name="tgl1" id="tgl1"></td>
                        <td><input type="text" value="UKT" name="item1" id="item1"></td>
                        <td><input type="number" name="vP1" id="vP1"></td>
                        <td><input type="number" name="vAcc1" id="vAcc1" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status1" type="checkbox" value="1" name="status1" disabled />
                                <label for="status1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><input type="date" name="tgl2" id="tgl2"></td>
                        <td><input type="text" name="item2" id="item2"></td>
                        <td><input type="text" name="vP2" id="vP2"></td>
                        <td><input type="number" name="vAcc2" id="vAcc2" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status2" type="checkbox" value="1" name="status2" disabled />
                                <label for="status2"></label>
                            </div>
                        </td>

                    <tr>
                        <td>3</td>
                        <td><input type="date" name="tgl3" id="tgl3"></td>
                        <td><input type="text" name="item3" id="item3"></td>
                        <td><input type="text" name="vP3" id="vP3"></td>
                        <td><input type="number" name="vAcc3" id="vAcc3" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status3" type="checkbox" value="1" name="status3" disabled />
                                <label for="status3"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td><input type="date" name="tgl4" id="tgl4"></td>
                        <td><input type="text" name="item4" id="item4"></td>
                        <td><input type="text" name="vP4" id="vP4"></td>
                        <td><input type="number" name="vAcc4" id="vAcc4" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status4" type="checkbox" value="1" name="status4" disabled />
                                <label for="status4"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td><input type="date" name="tgl5" id="tgl5"></td>
                        <td><input type="text" name="item5" id="item5"></td>
                        <td><input type="text" name="vP5" id="vP5"></td>
                        <td><input type="number" name="vAcc5" id="vAcc5" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status5" type="checkbox" value="1" name="status5" disabled />
                                <label for="status5"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>6</td>
                        <td><input type="date" name="tgl6" id="tgl6"></td>
                        <td><input type="text" name="item6" id="item6"></td>
                        <td><input type="text" name="vP6" id="vP6"></td>
                        <td><input type="number" name="vAcc6" id="vAcc6" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status6" type="checkbox" value="1" name="status6" disabled />
                                <label for="status6"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>7</td>
                        <td><input type="date" name="tgl7" id="tgl7" disabled></td>
                        <td><input type="text" name="item7" id="item7" placeholder="Apresiasi/Depresiasi" class="bg-primary" disabled></td>
                        <td><input type="text" name="vP7" id="vP7" disabled></td>
                        <td><input type="number" name="vAcc7" id="vAcc7" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status7" type="checkbox" value="1" name="status7" disabled />
                                <label for="status7"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>8</td>
                        <td><input type="date" name="tgl8" id="tgl8" disabled></td>
                        <td><input type="text" name="item8" id="item8" placeholder="Sanksi Pelanggaran" class="bg-danger" disabled></td>
                        <td><input type="text" name="vP8" id="vP8" disabled></td>
                        <td><input type="number" name="vAcc8" id="vAcc8" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status8" type="checkbox" value="1" name="status8" disabled />
                                <label for="status8"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>9</td>
                        <td><input type="date" name="tgl9" id="tgl9" disabled></td>
                        <td><input type="text" name="item9" id="item9" disabled></td>
                        <td><input type="text" name="vP9" id="vP9" disabled></td>
                        <td><input type="number" name="vAcc9" id="vAcc9" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status9" type="checkbox" value="1" name="status9" disabled />
                                <label for="status9"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>10</td>
                        <td><input type="date" name="tgl10" id="tgl10" disabled></td>
                        <td><input type="text" name="item10" id="item10" disabled></td>
                        <td><input type="text" name="vP10" id="vP10" disabled></td>
                        <td><input type="number" name="vAcc10" id="vAcc10" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status10" type="checkbox" value="1" name="status10" disabled />
                                <label for="status10"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" align="right" class="bg--secondary">TOTAL</td>
                        <td><input type="text" id="totalP" disabled></td>
                        <td><input type="text" id="totalAcc" disabled></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="checkbox20" type="checkbox" name="agree" disabled />
                                <label for="checkbox20"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- TABEL PELANGGARAN -->
            <table class="border--round">
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
                        <td><input type="date" name="tglP1" id="tglP1" disabled></td>
                        <td><input type="text" name="itemP1" id="itemP1" value="Pencapaian jurnal semester" disabled></td>
                        <td><input type="number" name="valueP1" id="valueP1" disabled></td>

                    </tr>
                    <tr>
                        <td align="center">2</td>
                        <td><input type="date" name="tglP2" id="tglP2" disabled></td>
                        <td><input type="text" name="itemP2" id="itemP2" value="Kelebihan hari Libur" disabled></td>
                        <td><input type="number" name="valueP2" id="valueP2" disabled></td>

                    <tr>
                        <td align="center">3</td>
                        <td><input type="date" name="tglP3" id="tglP3" disabled></td>
                        <td><input type="text" name="itemP3" id="itemP3" disabled></td>
                        <td><input type="number" name="valueP3" id="valueP3" disabled></td>

                    </tr>
                    <tr>
                        <td align="center">4</td>
                        <td><input type="date" name="tglP4" id="tglP4" disabled></td>
                        <td><input type="text" name="itemP4" id="itemP4" disabled></td>
                        <td><input type="number" name="valueP4" id="valueP4" disabled></td>

                    </tr>
                </tbody>
            </table>

            <table>

                <tr align="center">
                    <td>Mahasiswa</td>
                    <td>Gembala</td>
                    <td>Keuangan FLATS</td>
                </tr>
                <tr>
                    <td><input type="text" required></td>
                    <td><input type="text" disabled></td>
                    <td><input type="text" disabled></td>
                </tr>
            </table>
            <div class="text-primary">
                <i><b>
                        *No. Efata wajib diisi 6 digit terakhir sebagai pengganti tanda tangan untuk keperluan verifikasi form.
                    </b></i>
            </div>
        </div>

        <input type="submit" class="bg-primary" name="submit" id="submit" value="KIRIM">
    <?php } ?>

    <script src="js/flickity.min.js"></script>
    <script src="js/easypiechart.min.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/typed.min.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/isotope.min.js"></script>
    <script src="js/ytplayer.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/granim.min.js"></script>
    <script src="js/jquery.steps.min.js"></script>
    <script src="js/countdown.min.js"></script>
    <script src="js/twitterfetcher.min.js"></script>
    <script src="js/spectragram.min.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/scripts.js"></script>

    <script type="text/javascript">
        var rupiah = document.getElementsByClassName('vp');
        rupiah.addEventListener('keyup', function(e) {
            // tambahkan 'Rp.' pada saat form di ketik
            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
            rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

</body>
</form>
<footer>

</footer>

</html>