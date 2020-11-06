<?php  
  //index.php
  include "koneksi.php";
  $result = mysqli_query($conn, "SELECT * FROM pengajuan ORDER BY id_pengajuan DESC");
  $qkeperluan=mysqli_query($conn, "SELECT * FROM keperluan ORDER BY id_keperluan DESC");
?> 

<!DOCTYPE html>  
<html>  
 <head>  
  <title>Input Proposal</title>  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
 </head>  
 <body>  
  
  <div class="container">
  <br \> 
   <h3 align="center" class="">Form Pengajuan Bantuan Keuangan</h3>  
   <br />  
   <div class="table-responsive">
    <div align="right">
     <button type="button" name="age" id="age" data-toggle="modal" data-target="#input_pengajuan" class="btn btn-warning">Add Proposal Item</button>
    </div>
    <br />
    <div id="pengajuan_table">
     
      <?php include "tableForm.php" ?>

    </div>
   </div> 
  </div>
 </body>  
</html>  
 
<div id="input_pengajuan" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Input Pengajuan</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
   </div>
   <div class="modal-body">
    <form method="post" id="input_form" enctype="multipart/form-data">
     <label>Keperluan</label>
    <select name='keperluan' id="keperluan" class="form-control">
      <option value=''></option>
      <?php
      while($r=mysqli_fetch_array($qkeperluan)){ 
        echo "<option value=$r[id_keperluan]>$r[nama_keperluan]</option>"; 
      } ?>
    </select>
     <br />
     <label>Rincian</label>
     <textarea name="rincian" id="rincian" class="form-control"></textarea>
     <br />
     <label>Nominal</label>
     <input type="number" name="nominal" id="nominal" class="form-control" />
     <br />
     <input type='file' name='attachment' id='attachment'/>
     <br />  
     <input type="submit" name="tambah" id="tambah" value="Tambah" class="btn btn-success" />
    </form>
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
 
<div id="dataModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Detail Data Karyawan</h4>
   </div>
   <div class="modal-body" id="detail_karyawan">
     
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
 
 
<div id="editModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Data Karyawan</h4>
   </div>
   <div class="modal-body" id="form_edit">
     
   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   </div>
  </div>
 </div>
</div>
 
<script>  
  
$(document).ready(function(){
// Begin Aksi Insert
 $('#input_form').on("submit", function(event){  
  event.preventDefault();

  const attachment = $('#attachment').prop('files')[0];
  let formData = new FormData();
  formData.append('attachment', attachment);

  if($('#keperluan').val() == "")  
  {  
   alert("Mohon Isi Keperluan ");  
  }  
  else if($('#nominal').val() == '')  
  {  
   alert("Mohon Isi nominal");  
  }  
  
  else 
  {
   $.ajax({  
    url:"tambah_pengajuan.php",  
    method:"POST",  
    data:$('#input_form').serialize(),  
    beforeSend:function(){  
     $('#tambah').val("Menambahkan");  
    },  
    success:function(data){  
     $('#input_form')[0].reset();  
     $('#input_pengajuan').modal('hide');  
     $('#pengajuan_table').html(data);  
    }  
   });  
  }  
 });
//END Aksi Insert
 
//Begin Tampil Detail Karyawan
 $(document).on('click', '.view_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"select.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
    $('#detail_karyawan').html(data);
    $('#dataModal').modal('show');
   }
  });
 });
//End Tampil Detail Karyawan
Begin Tampil Form Edit
  $(document).on('click', '.edit_data', function(){
  var employee_id = $(this).attr("id");
  $.ajax({
   url:"editProposal.php",
   method:"POST",
   data:{employee_id:employee_id},
   success:function(data){
    $('#form_edit').html(data);
    $('#editModal').modal('show');
   }
  });
 });
End Tampil Form Edit
 
//Begin Aksi Delete Data
 $(document).on('click', '.hapus_data', function(){
  var proposal_id = $(this).attr("id");
  $.ajax({
   url:"deleteProposal.php",
   method:"POST",
   data:{proposal_id:proposal_id},
   success:function(data){
   $('#pengajuan_table').html(data);  
   }
  });
 });
}); 
//End Aksi Delete Data
 </script>