<?php
session_start();
include 'config.php';
include 'functions.php';

if ($_GET['act'] == 'add') {

  $tgl = date('Y-m-d');
  mysqli_query($conn, "INSERT INTO pengajuan VALUES(
    '','$_SESSION[nif]','$_POST[necessity]', '$_POST[description]', 
    '$_POST[value]', '$tgl', '', '', '0', '')");
?>
  <script>
    alert("Sampai disini")
  </script>
<?php
  submissionTable("0420206");
} elseif ($_GET['act'] == 'view') {
  $row = mysqli_fetch_array(mysqli_query($conn, "SELECT *, keperluan.nama_keperluan FROM pengajuan JOIN keperluan ON keperluan.id_keperluan = pengajuan.keperluan_mhs WHERE id_pengajuan = '$_POST[sub_id]'"));
  echo "
    <div class='table-responsive'>  
    <table class='table table-bordered'>";
  echo "
    <tr>  
        <td width=30%><label>Submission ID</label></td>  
        <td width=70%>$row[id_pengajuan]</td>  
    </tr>
    <tr>  
        <td width=30%><label>Submission Purpose</label></td>  
        <td width=70%>$row[nama_keperluan]</td>  
    </tr>
    <tr>  
        <td width=30%><label>Description</label></td>  
        <td width=70%>$row[other]</td>  
    </tr>

    <tr>  
        <td width=30%><label>Value</label></td>  
        <td width=70%>$row[nominal]</td>  
    </tr>

    <tr>  
        <td width=30%><label>Submission Status</label></td>  
        <td width=70%>" . sub_status($row['status']) . "</td>  
    </tr>

    <tr>  
        <td width=30%><label>Attachment</label></td>  
        <td width=70%>$row[doc]</td>  
    </tr>";
  submissionTable("0420206");
  return;
} elseif ($_GET['act'] == 'send') {
  mysqli_query($conn, "UPDATE pengajuan SET status = '1' WHERE id_pengajuan = '$_POST[sub_id]'");
  submissionTable("0420206");
} elseif ($_GET['act'] == 'upPass') {
  $newPass = $_POST["pass1"];
  $newPass = password_hash($newPass, PASSWORD_DEFAULT);
  mysqli_query($conn, "UPDATE mahasiswa SET status = '1', password_mhs = '$newPass' WHERE nif = '$_SESSION[nif]'");
} else {
  mysqli_query($conn, "DELETE FROM pengajuan WHERE id_pengajuan = '$_POST[sub_id]'");
}

// 
