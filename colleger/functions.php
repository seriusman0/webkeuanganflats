<?php
    include "config.php";

    function submissionTable(){
        global $conn;
        $result = mysqli_query($conn, "SELECT keperluan.nama_keperluan, pengajuan.statusSub FROM pengajuan JOIN keperluan ON keperluan.id_keperluan = pengajuan.keperluan_mhs GROUP BY pengajuan.id_pengajuan ORDER BY pengajuan.tgl DESC ");
        $no=1;
        // var_dump($result);
        while($row = mysqli_fetch_array($result)){
            echo "<tr>
            <td>$no</td>
            <td>$row[nama_keperluan]</td>
            <td>$row[statusSub]</td>
            ";
            echo "</td>
         </tr>";
    $no++;
        }
    }
?>