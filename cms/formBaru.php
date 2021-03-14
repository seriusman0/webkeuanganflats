<?php

include 'koneksi.php';
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Format Sementara</title>
</head>

<body>
    <table class="table table-striped table-bordered table-hover dataTables-example">
        <thead class='alert-info'>
            <tr class='gradeX'>
                <th>No</th>
                <th>Nama</th>
                <th>Kampus</th>
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
            $angkatan = 39;
            $NifMhs = mysqli_query($conn, "SELECT kampus.nama_kampus as Kampus, mahasiswa.nif as NIF, mahasiswa.nama_mhs as Nama from mahasiswa, kampus where mahasiswa.angkatan =  '$angkatan' AND mahasiswa.kampus = kampus.npsn ORDER BY mahasiswa.nama_mhs asc");

            $no = 1;
            while ($i = mysqli_fetch_array($NifMhs)) {
                $semester = 7;
                $penghidupan = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 1 AND pengeluaran.semester = '$semester'"));
                $ospek = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 2 AND pengeluaran.semester = '$semester'"));
                $uangTinggal = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 5 AND pengeluaran.semester = '$semester'"));
                $kuliahLapangan = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 6 AND pengeluaran.semester = '$semester'"));
                $literatur = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 7 AND pengeluaran.semester = '$semester'"));
                $skripsi = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 8 AND pengeluaran.semester = '$semester'"));
                $matKul = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 9 AND pengeluaran.semester = '$semester'"));
                $bank = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 10 AND pengeluaran.semester = '$semester'"));
                $ftt = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 11 AND pengeluaran.semester = '$semester'"));
                $apresiasi = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 12 AND pengeluaran.semester = '$semester'"));
                $lainnya = mysqli_fetch_array(mysqli_query($conn, "SELECT pengeluaran.nominal FROM pengeluaran WHERE pengeluaran.nif = '$i[NIF]' AND pengeluaran.keperluan = 13 AND pengeluaran.semester = '$semester'"));
                echo "<tr>
                <th>$no</th>
                <th>$i[Nama]</th>
                <th>$i[Kampus]</th>
                <th>$semester</th>
                <th>UKT</th>
                <th>UKA</th>
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
                <th>$lainnya[nominal]</th>";
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
</body>

</html>