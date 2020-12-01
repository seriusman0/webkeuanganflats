<?php 
    if ($_GET[aksi]==''){

        if ($_GET[stat]=='1'){
            $status = 'User Biasa';
            $level = 'user_biasa';
        }elseif ($_GET[stat]=='2'){
            $status = 'User Input';
            $level = 'user_input';
        }else{
            $status = 'User Admin';
            $level = 'user_admin';
        }
?>
        <h4 style='padding-top:15px'>Laporan Pengeluaran</h4>
            <!-- Basic Data Tables Example -->
            <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-body">
                 <form action='p_laporan.php' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>      

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Nama Mahasiswa</label>
                            <div class="col-lg-9">
                            <?php $ambil=mysqli_query($conn, "SELECT * FROM flats_mahasiswa ORDER BY nama"); ?>
                            <select name='nama_mhs' class="form-control">
                                <?php
                                while($r=mysqli_fetch_array($ambil)){ 
                                  echo "<option value=$r[id]>$r[nama]</option>"; 
                                } ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Semester</label>
                            <div class="col-lg-9">
                            <select name='semester' class="form-control">
                                <option value='PKA'>PKA</option>
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
                            <button type="submit" name='report' class="btn btn-info">Report</button>                  
                            <button type="reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
            <!-- /Basic Data Tables Example --> 

<?php } 
include "footer.php";
?>

              