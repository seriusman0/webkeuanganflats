<?php
//insert.php
include "koneksi.php";

session_start();

        if(!empty($_POST))
        {   
            $output = '';
            $query = "DELETE FROM pengajuan WHERE id_pengajuan = '".$_POST["proposal_id"]."'";
            if(mysqli_query($conn, $query))
            {
                echo "Data Berhasil Di hapus";
                echo tabelPengajuan();
            }else{
                $output .= mysqli_error($conn);
            }
            echo $output;
        }
?>`