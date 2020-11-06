<?php
//insert.php
include "koneksi.php";

session_start();

        if(!empty($_POST))
        {
            
            $keperluan = mysqli_real_escape_string($conn, $_POST["keperluan"]);  
            $idmhs = $_SESSION["nif"];
            $rincian = mysqli_real_escape_string($conn, $_POST["rincian"]);  
            $nominal = mysqli_real_escape_string($conn, $_POST["nominal"]);  
            $tgl = date('Y-m-d');


            // $attachment = upload();
            //             if (!$attachment) {
            //                 return false;
            //             }
            $select_query = "SELECT * FROM pengajuan ORDER BY id_pengajuan DESC";
            $result = mysqli_query($conn, $select_query);
            $query = "
            INSERT INTO pengajuan VALUES('','$idmhs', '$keperluan', '$rincian','$nominal', '$tgl', '0','')";
            if(mysqli_query($conn, $query))
            {
                $output = '<label class="text-success">Data Berhasil Masuk</label>';
             echo tabelPengajuan();
            }else{
                $output .= mysqli_error($conn);
            }
            echo $output;
        }
?>