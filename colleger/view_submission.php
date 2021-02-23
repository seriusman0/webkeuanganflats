<?php

$idPengajuan = $_GET['id'];

$query = "SELECT * FROM pengajuan WHERE pengajuan.id_pengajuan = $idPengajuan";

if ($r = mysqli_fetch_array(mysqli_query($conn, $query))) {
    // var_dump($r);
    // echo "<script>alert('masuk pak eko')</script>";
}

?>
<html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Preview Pengajuan</title>
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
                    <!-- <form action="" method="POST" aria-readonly="true"> -->
                    <tr>
                        <td>Nama</td>
                        <td width=40% colspan="3">
                            <input type="text" value="<?= $_SESSION['name'] ?>" readonly>
                        </td>
                        <td>Kampus</td>
                        <td width=40% colspan="3">
                            <input type="text" value="<?= $_SESSION['kampus'] ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>FLATS / Semester</td>
                        <td>
                            <input type="text" value="<?= $_SESSION['angkatan'] ?>" readonly>
                        </td>
                        <td>/</td>
                        <td><input type="number" name="semester" min="1" max="14" placeholder="semester" id="semester" readonly value="<?= $r['semester'] ?>" required></td>
                        <td>Tahun Ajaran</td>
                        <td colspan="3">
                            <input type="text" min="2015" max="2050" name="ta" id="ta" readonly value="<?= $r['ta'] ?>" required oninvalid="this.setCustomValidity('Jangan Lupa isi Tahun Ajaran')" oninput="setCustomValidity('')">
                        </td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td colspan="3">
                            <input type="text" name="nohp" id="nohp" placeholder="cth 0821xxxxxxxx" readonly value="<?= $r['nohp'] ?>">
                        </td>
                        <td>IPS / IPK </td>
                        <td>
                            <input type="number" name="ips" id="ips" readonly max="4">
                        </td>
                        <td>/</td>
                        <td>
                            <input type="number" name="ipk" id="ipk" readonly max="4">
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
                            <textarea name="note_c" id="note_c" rows="5" placeholder="Diisi oleh Mahasiswa" readonly><?php note($idPengajuan, 0) ?></textarea>
                        </td>
                        <td>
                            <textarea name="note_s" id="note_s" rows="5" placeholder="Diisi oleh Gembala" readonly></textarea>
                        </td>
                        <td>
                            <textarea name="note_b" id="note_b" rows="5" placeholder="Diisi oleh Biro" readonly> <?php note($idPengajuan, 2) ?></textarea>
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
                    <td><input type="text" name="tgl_sub" id="tgl_sub" value="<?= tgl_indo($r['tgl_sub']) ?>" readonly></td>
                    <td><input type="text" name="rev_1" id="rev_1" value="<?= tgl_indo($r['rev_1']) ?>" readonly></td>
                    <td><input type="text" name="rev_2" id="rev_2" value="<?= tgl_indo($r['rev_2']) ?>" readonly></td>
                    <td><input type="text" name="acc" id="acc" value="<?= tgl_indo($r['acc']) ?>" readonly></td>
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
                        <td><input type="text" name="tgl1" id="tgl1" value="<?= tgl_indo(item($idPengajuan, 1)['tglP']) ?>" readonly></td>
                        <td><input type="text" name="item1" id="item1" value="<?= item($idPengajuan, 1)['itemP'] ?>" readonly></td>
                        <td><input type="text" name="vP1" id="vP1" value="<?= rupiah(item($idPengajuan, 1)['valP']) ?>" readonly></td>
                        <td><input type="number" name="vAcc1" id="vAcc1" value="<?= item($idPengajuan, 1)['valAcc'] ?>" readonly></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status1" type="checkbox" <?php checkStat(item($idPengajuan, 1, 'status')['status']) ?> name="status1" disabled />
                                <label for="status1"></label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><input type="text" name="tgl2" id="tgl2" value="<?= tgl_indo(item($idPengajuan, 2)['tglP']) ?>" readonly></td>
                        <td><input type="text" name="item2" id="item2" value="<?= item($idPengajuan, 2)['itemP'] ?>" readonly></td>
                        <td><input type="text" name="vP2" id="vP2" value="<?= rupiah(item($idPengajuan, 2)['valP']) ?>" readonly></td>
                        <td><input type="number" name="vAcc2" id="vAcc2" readonly value="<?php item($idPengajuan, 2, 'valAcc') ?>" readonly></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status2" type="checkbox" <?php checkStat(item($idPengajuan, 2, 'status')['status']) ?> name="status2" disabled />
                                <label for="status2"></label>
                            </div>
                        </td>

                    <tr>
                        <td>3</td>
                        <td><input type="text" name="tgl3" id="tgl3" value="<?= tgl_indo(item($idPengajuan, 3)['tglP']) ?>" readonly></td>
                        <td><input type="text" name="item3" id="item3" value="<?= item($idPengajuan, 3)['itemP'] ?>" readonly></td>
                        <td><input type="text" name="vP3" id="vP3" value="<?= rupiah(item($idPengajuan, 3)['valP']) ?>" readonly></td>
                        <td><input type="number" name="vAcc3" id="vAcc3" readonly value="<?= item($idPengajuan, 3)['valAcc'] ?>" readonly></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status3" type="checkbox" <?php checkStat(item($idPengajuan, 3, 'status')['status']) ?> value="1" name="status3" disabled />
                                <label for="status3"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>4</td>
                        <td><input type="text" name="tgl4" id="tgl4" value="<?= tgl_indo(item($idPengajuan, 4)['tglP']) ?>" readonly></td>
                        <td><input type="text" name="item4" id="item4" value="<?= item($idPengajuan, 4)['itemP'] ?>" readonly></td>
                        <td><input type="text" name="vP4" id="vP4" value="<?= rupiah(item($idPengajuan, 4)['valP']) ?>" readonly></td>
                        <td><input type="number" name="vAcc4" id="vAcc4" readonly value="<?= item($idPengajuan, 4)['valAcc'] ?>" readonly></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status4" type="checkbox" <?php checkStat(item($idPengajuan, 4, 'status')['status']) ?> value="1" name="status4" disabled />
                                <label for="status4"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>5</td>
                        <td><input type="text" name="tgl5" id="tgl5" value="<?= tgl_indo(item($idPengajuan, 5)['tglP']) ?>" readonly></td>
                        <td><input type="text" name="item5" id="item5" value="<?= item($idPengajuan, 5)['itemP'] ?>" readonly></td>
                        <td><input type="text" name="vP5" id="vP5" value="<?= rupiah(item($idPengajuan, 5)['valP']) ?>" readonly></td>
                        <td><input type="number" name="vAcc5" id="vAcc5" readonly value="<?= item($idPengajuan, 5)['valAcc'] ?>" readonly></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status5" type="checkbox" <?php checkStat(item($idPengajuan, 5, 'status')['status']) ?> value="1" name="status5" disabled />
                                <label for="status5"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>6</td>
                        <td><input type="text" name="tgl6" id="tgl6" value="<?= tgl_indo(item($idPengajuan, 6)['tglP']) ?>" readonly></td>
                        <td><input type="text" name="item6" id="item6" value="<?= item($idPengajuan, 6)['itemP'] ?>" readonly></td>
                        <td><input type="text" name="vP6" id="vP6" value="<?= rupiah(item($idPengajuan, 6)['valP']) ?>" readonly></td>
                        <td><input type="number" name="vAcc6" id="vAcc6" readonly value="<?= item($idPengajuan, 6)['valAcc'] ?>" readonly></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status6" type="checkbox" <?php checkStat(item($idPengajuan, 6, 'status')['status']) ?> value="1" name="status6" disabled />
                                <label for="status6"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>7</td>
                        <td><input type="text" name="tgl7" id="tgl7" readonly value="<?= tgl_indo(item($idPengajuan, 7)['tglP']) ?>"></td>
                        <td><input type="text" name="item7" id="item7" placeholder="Apresiasi/Depresiasi" class="bg-primary" readonly value="<?= item($idPengajuan, 7)['itemP'] ?>"></td>
                        <td><input type="text" name="vP7" id="vP7" readonly value="<?= rupiah(item($idPengajuan, 7)['valP']) ?>"></td>
                        <td><input type="number" name="vAcc7" id="vAcc7" readonly value="<?= item($idPengajuan, 6)['valAcc'] ?>"></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status7" type="checkbox" <?php checkStat(item($idPengajuan, 7, 'status')['status']) ?> value="1" name="status7" disabled />
                                <label for="status7"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>8</td>
                        <td><input type="text" name="tgl8" id="tgl8" readonly value="<?= tgl_indo(item($idPengajuan, 8)['tglP']) ?>"></td>
                        <td><input type="text" name="item8" id="item8" placeholder="Sanksi Pelanggaran" class="bg-danger" readonly value="<?= item($idPengajuan, 8)['itemP'] ?>"></td>
                        <td><input type="text" name="vP8" id="vP8" readonly value="<?= rupiah(item($idPengajuan, 8)['valP']) ?>"></td>
                        <td><input type="number" name="vAcc8" id="vAcc8" readonly value="<?= item($idPengajuan, 8)['valAcc'] ?>"></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status8" type="checkbox" <?php checkStat(item($idPengajuan, 8, 'status')['status']) ?> value="1" name="status8" disabled />
                                <label for="status8"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>9</td>
                        <td><input type="text" name="tgl9" id="tgl9" readonly value="<?= tgl_indo(item($idPengajuan, 9)['tglP']) ?>"></td>
                        <td><input type="text" name="item9" id="item9" readonly value="<?= item($idPengajuan, 9)['itemP'] ?>"></td>
                        <td><input type="text" name="vP9" id="vP9" readonly value="<?= rupiah(item($idPengajuan, 9)['valP']) ?>"></td>
                        <td><input type="number" name="vAcc9" id="vAcc9" readonly value="<?= item($idPengajuan, 9)['valAcc'] ?>"></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status9" type="checkbox" <?php checkStat(item($idPengajuan, 9, 'status')['status']) ?> value="1" name="status9" disabled />
                                <label for="status9"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>10</td>
                        <td><input type="text" name="tgl10" id="tgl10" readonly value="<?= tgl_indo(item($idPengajuan, 10)['tglP']) ?>"></td>
                        <td><input type="text" name="item10" id="item10" readonly value="<?= item($idPengajuan, 10)['itemP'] ?>"></td>
                        <td><input type="text" name="vP10" id="vP10" readonly value="<?= rupiah(item($idPengajuan, 10)['valP']) ?>"></td>
                        <td><input type="number" name="vAcc10" id="vAcc10" readonly value="<?= item($idPengajuan, 10)['valAcc'] ?>"></td>
                        <td>
                            <div class="input-checkbox">
                                <input id="status10" type="checkbox" <?php checkStat(item($idPengajuan, 10, 'status')['status']) ?> value="1" name="status10" disabled />
                                <label for="status10"></label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" align="right" class="bg--secondary">TOTAL</td>
                        <td><input type="text" id="totalP" readonly></td>
                        <td><input type="text" id="totalAcc" readonly></td>
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
                        <td><input type="date" name="tglP1" id="tglP1" readonly></td>
                        <td><input type="text" name="itemP1" id="itemP1" value="Pencapaian jurnal semester" readonly></td>
                        <td><input type="number" name="valueP1" id="valueP1" readonly></td>

                    </tr>
                    <tr>
                        <td align="center">2</td>
                        <td><input type="date" name="tglP2" id="tglP2" readonly></td>
                        <td><input type="text" name="itemP2" id="itemP2" value="Kelebihan hari Libur" readonly></td>
                        <td><input type="number" name="valueP2" id="valueP2" readonly></td>

                    <tr>
                        <td align="center">3</td>
                        <td><input type="date" name="tglP3" id="tglP3" readonly></td>
                        <td><input type="text" name="itemP3" id="itemP3" readonly></td>
                        <td><input type="number" name="valueP3" id="valueP3" readonly></td>

                    </tr>
                    <tr>
                        <td align="center">4</td>
                        <td><input type="date" name="tglP4" id="tglP4" readonly></td>
                        <td><input type="text" name="itemP4" id="itemP4" readonly></td>
                        <td><input type="number" name="valueP4" id="valueP4" readonly></td>

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
                    <td><input type="text" name="efata" id="efata" value="******" readonly></td>
                    <td><input type="text" readonly></td>
                    <td><input type="text" readonly></td>
                </tr>
            </table>
            <div class="text-primary">
                <i><b>
                        *No. Efata wajib diisi 6 digit terakhir sebagai pengganti tanda tangan untuk keperluan verifikasi form.
                    </b></i>
            </div>
        </div>
        <input type="text" name="subject" id="subject" placeholder="Subject Pengajuan" value="<?= $r['subject'] ?>" readonly>
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
<!-- </form> -->
<footer>

</footer>

</html>