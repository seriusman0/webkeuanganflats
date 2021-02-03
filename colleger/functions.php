<?php
include "config.php";
function submissionTable($id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT pengajuan.subject, pengajuan.status 
    FROM pengajuan, detail_pengajuan, sub_detail_pengajuan
    WHERE pengajuan.id_pengajuan = detail_pengajuan.fid_pengajuan 
    AND detail_pengajuan.id_detail_pengajuan = sub_detail_pengajuan.fid_detail_pengajuan
    ");

    $no = 1;
?>
    <div id="form_table">
        <table class="border--round table--alternate-row">
            <thead>
                <tr align="center">
                    <th>No</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // var_dump($result);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>
                        <td align='center'>$no</td>
                        <td>$row[subject]</td>
                        <td>" . sub_status($row['status']) . "</td>
                        <td align='center'>
                        <a href='#' class='btn'>Hapus</a>
                        ";
                    if ($row['status'] == 0) {
                        echo "<a href='#'' class='btn'>Edit</a>
                            <a href='#' class='btn'>Send</a>
                            ";
                    }
                    echo "</td>
                                </tr>";

                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div><?php
        }
        function sub_status($stat)
        {
            switch ($stat) {
                case 0: {
                        return "Draft";
                        break;
                    }
                case 1: {
                        return "Not Verified";
                        break;
                    }
                case 2: {
                        return "Verified By Shepherd";
                        break;
                    }
                case 3: {
                        return "Proccessed By Biro";
                        break;
                    }
                case 4: {
                        return "Verified";
                        break;
                    }
                case 5: {
                        return "Decline";
                        break;
                    }
                default: {
                        return "Unknown Status";
                        break;
                    }
            }
        }

        function newPass($newPass)
        {
        }

        function upload()
        {

            $namaFile = $_FILES['gambar']['name'];
            $ukuranFile = $_FILES['gambar']['size'];
            $error = $_FILES['gambar']['error'];
            $tmpName = $_FILES['gambar']['tmp_name'];

            // cek apakah gambar di upload
            if ($error === 4) {
                echo "<script>
				alert ('Pilih Gambar terlebih dahulu');
			</script>";
                return false;
            }

            //cek apakah yang di upload adalah gambar
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                echo "<script>
				alert ('Yang Anda Upload Bukan Gambar');
			</script>";
                return false;
            }

            //cek jika ukuran terlalu besar 
            if ($ukuranFile > 3000000) {
                echo "<script>
				alert ('Ukuran Gambar telalu Besar');
			</script>";
                return false;
            }

            //lolos pengecekan
            //generate nama file baru
            $namaFileBaru = uniqid();
            $namaFileBaru .= '.';
            $namaFileBaru .= $ekstensiGambar;
            move_uploaded_file($tmpName, '../img/' . $namaFileBaru);
            return $namaFileBaru;
        }

        function test()
        {
            ?>
    <script>
        alert("Sampai disini")
    </script>
<?php
        }

        function completeMessage()
        {
?>
    <script>
        alert("Berhasil")
    </script>
<?php
        }

        function failedMessage()
        {
?>
    <script>
        alert("Berhasil")
    </script>
<?php
        }


        function qtest()
        {
            global $conn;
            mysqli_query(
                $conn,
                "INSERT INTO `pengajuan` 
    (`id_pengajuan`, 
    `nif`, 
    `keperluan_mhs`, 
    `other`, `nominal`, 
    `tgl`, 
    `status`, 
    `doc`) 
    VALUES 
    (NULL, 
    '1234576', 
    '12', 
    'sdfjskd', 
    '19898', 
    '2020-12-12', 
    '0', 
    NULL)"
            );
        }


        function cekLogin()
        {
            if ($_SESSION['login'] !== true) {
                header('Location:index.php');
                exit;
            }
        }
