<head>
    <?php
    include "koneksi.php";

    // Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
    $angkatan = 42;
    $semester = 2;
    $period = "Genap";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename= Angkatan " . $angkatan . ".xls");
    ?>
</head>

<body>
    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the initial value */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }

        html {
            background-color: #FFFFFF;
            margin: 0px;
            /* this affects the margin on the html before sending to printer */
        }

        body {
            /*border: solid 1px blue ;*/
            margin: 10mm 15mm 10mm 15mm;
            /* margin you want for the content */
        }
    </style>
    <?php
    // error_reporting(0);
    // session_start();
    // $laporan = mysqli_query($conn, "SELECT * FROM flats_pengeluaran where id_mhs='$_POST[nama_mhs]' AND semester='$_POST[semester]' ");
    // $data = mysqli_fetch_array($laporan);
    $no = 1;
    $t1 = 0;
    $t2 = 0;
    $ts = 0;

    ?>
    <table class="table table-striped table-bordered table-hover dataTables-example">
        <thead class='alert-info'>
            <tr class='gradeX'>
                <th rowspan="2">No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">Kampus</th>
                <th colspan="14"><?= $period ?> 2019/2020</th>
            </tr>
            <tr>
                <th>Semester</th>
                <th>UKT</th>
                <th>UKA</th>
                <th>Biaya Penghidupan</th>
                <th>Biaya Ospek</th>
                <th>Uang Tinggal</th>
                <th>Biaya Kuliah Lapangan</th>
                <th>Biaya Kuliah Literatur</th>
                <th>Biaya Skripsi</th>
                <th>Biaya Mata Kuliah</th>
                <th>Biaya Perbankan Mahasiswa</th>
                <th>FTT</th>
                <th>Apresiasi</th>
                <th>Lainnya</th>


            </tr>
        </thead>
        <tbody>
            <?php
            $NifMhs = mysqli_query($conn, "SELECT kampus.nama_kampus as Kampus, mahasiswa.nif as NIF, mahasiswa.nama_mhs as Nama from mahasiswa, kampus where mahasiswa.angkatan =  '$angkatan' AND mahasiswa.kampus = kampus.npsn ORDER BY mahasiswa.nama_mhs asc");

            $no = 1;
            while ($i = mysqli_fetch_array($NifMhs)) {
                $uka = mysqli_fetch_array(mysqli_query($conn, "SELECT  sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 4 AND pengeluaran.semester = '$semester'"));
                $penghidupan = mysqli_fetch_array(mysqli_query($conn, "SELECT  sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 1 AND pengeluaran.semester = '$semester'"));
                $ospek = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 2 AND pengeluaran.semester = '$semester'"));
                $uangTinggal = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 5 AND pengeluaran.semester = '$semester'"));
                $kuliahLapangan = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 6 AND pengeluaran.semester = '$semester'"));
                $literatur = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 7 AND pengeluaran.semester = '$semester'"));
                $skripsi = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 8 AND pengeluaran.semester = '$semester'"));
                $matKul = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 9 AND pengeluaran.semester = '$semester'"));
                $bank = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 10 AND pengeluaran.semester = '$semester'"));
                $ftt = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 11 AND pengeluaran.semester = '$semester'"));
                $apresiasi = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 12 AND pengeluaran.semester = '$semester'"));
                $lainnya = mysqli_fetch_array(mysqli_query($conn, "SELECT sum(nominal) as nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 13 AND pengeluaran.semester = '$semester'"));
                echo "<tr>
                <th>$no</th>
                <th>$i[Nama]</th>
                <th>$i[Kampus]</th>
                <th>$semester</th>
                <th>UKT</th>
                <th>$uka[nominal]</th>
                <th>$penghidupan[nominal]</th>
                <th>$ospek[nominal]</th>
                <th>$uangTinggal[nominal]</th>
                <th>$kuliahLapangan[nominal]</th>
                <th>$literatur[nominal]</th>
                <th>$skripsi[nominal]</th>
                <th>$matKul[nominal]</th>
                <th>$bank[nominal]</th>
                <th>$ftt[nominal]</th>
                <th>$apresiasi[nominal]</th>
                <th>$lainnya[nominal]</th> </tr>";
                $no++;
            }
            ?>

        </tbody>
    </table>
</body>