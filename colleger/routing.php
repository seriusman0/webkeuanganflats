<?php
if ($_GET['page'] == '') {
    include "flats_home.php";
} elseif ($_GET['page'] == 'pemasukkan') {
    include "flats_pemasukkan.php";
} elseif ($_GET['page'] == 'pengeluaran') {
    include "flats_pengeluaran.php";
} elseif ($_GET['page'] == 'laporan') {
    include "flats_laporan.php";
} elseif ($_GET['page'] == 'laporan') {
    include "laporan.php";
} elseif ($_GET['page'] == 'mahasiswa') {
    include "flats_mahasiswa.php";
} elseif ($_GET['page'] == 'kampus') {
    include "flats_kampus.php";
} elseif ($_GET['page'] == 'kaskecil') {
    include "flats_kaskecil.php";
} elseif ($_GET['page'] == 'datauser') {
    include "flats_datauser.php";
} elseif ($_GET['page'] == 'keperluanmhs') {
    include "flats_keperluan_mhs.php";
}
