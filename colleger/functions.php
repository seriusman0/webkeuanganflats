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
            <td>" . sub_status($row['status']) . "</td>
            <td>
            <div><input type='button' name='delete' value='Delete' id='$row[id_pengajuan]' class='btn btn--primary delete_sub' /></div>
            <div><input type='button' name='view' value='View' id='$row[id_pengajuan]' class='btn btn--primary view_sub' /></div>
            ";
        if ($row['status'] == 0) {
            echo "<div><input type='button' name='send' value='Send' id='$row[id_pengajuan]' class='btn btn--primary send_sub' /></div>";
        }
        echo "</td>
         </tr>";
        $no++;
    }
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
