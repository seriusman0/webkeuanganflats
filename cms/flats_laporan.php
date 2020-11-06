<?php 
    


?>
<style>

    @page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
    }

    @media print{
        #formReport {
            display: none;
        }
        .footer {
            display: none;
        }
        #title {
            display: none;
        }
    }

</style>
  <script src="js/jquery-3.5.1.min.js"></script>
        <h4 style='padding-top:15px' id="title">Laporan Pengeluaran</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                 <form class="form-horizontal" action="p_laporan2.php" method="POST" data-validate="parsley" enctype='multipart/form-data' id="formReport">      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Mahasiswa</label>
                            <div class="col-lg-9">
                            <?php $ambil=mysqli_query($conn, "SELECT * FROM mahasiswa"); ?>
                            <select name='nama_mhs' class="form-control" id="namaMhs">
                                <option value="" ></option>
                                <?php
                                while($r=mysqli_fetch_array($ambil)){ 
                                  echo "<option value=$r[nif]>$r[nama_mhs]</option>"; 
                                } ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Semester</label>
                            <div class="col-lg-9">
                            <select name='semester' class="form-control">
                                <option value=''></option>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                                <option value='6'>6</option>
                                <option value='7'>7</option>
                                <option value='8'>8</option>
                                <option value='9'>9</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                                <option value='13'>13</option>
                                <option value='14'>14</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-9 pull-right">    
                            <button type="submit" id="submit" class="btn btn-info">Print</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <button id="refresh" class="fa fa-refresh btn btn-default"></button>
                            </div>
                        </div>
                    </form>
                    
                    <div id="reportTable">

                        <!-- filenya di sini -->

                    </div>


                    
                </div>
            </div>
            </div>
<div class="footer">            <!-- /Basic Data Tables Example --> 
    <?php 
include "footer.php";
?>
</div>
<script>
$(document).ready(function(){
  $("#refresh").mouseover(function(){
    $.ajax({  
    url:"p_laporan2.php",  
    method:"POST",  
    data:$('#formReport').serialize(),  
      
    success:function(data){  
     $('#reportTable').html(data);  
    }  
   });
  });
});
</script>


              