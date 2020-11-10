<?php
include "config.php";
function submissionTable($id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT keperluan.nama_keperluan, pengajuan.status, pengajuan.id_pengajuan FROM pengajuan JOIN keperluan ON keperluan.id_keperluan = pengajuan.keperluan_mhs WHERE nif = '$id' GROUP BY pengajuan.id_pengajuan ORDER BY pengajuan.tgl DESC ");
    $no = 1;
    // var_dump($result);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>
            <td>$no</td>
            <td>$row[nama_keperluan]</td>
            <td>$row[status]</td>
            <td>
            <div><input type='button' name='delete' value='Delete' id='$row[id_pengajuan]' class='btn btn-danger btn-xs delete_sub' /></div>
            <div><input type='button' name='view' value='View' id='$row[id_pengajuan]' class='btn btn-info btn-xs view_sub' /></div>
            ";
        echo "</td>
         </tr>";
        $no++;
    }
}
