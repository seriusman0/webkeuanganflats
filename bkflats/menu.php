
<ul style='margin-top:25px' id="dashboard-menu">
              <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php">
                    <i style='margin-top:-11px; color:#fff' class="fa fa-laptop"></i>
                    <span>Dashboard</span>
                </a>
            </li>  

            <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=pengeluaran">
                    <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                    <span>Pengeluaran</span>
                </a>
            </li>
            <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=laporan">
                    <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                    <span>Laporan</span>
                </a>
            </li>

            <?php if ($_SESSION[level] == 'user_admin' || $_SESSION[level] == 'user_owner'){ ?>  
            <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php?page=kaskecil">
                    <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                    <span>Kas Kecil</span>
                </a>
            </li>
            <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php?page=kaskecil">
                    <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                    <span>Data Mahasiswa</span>
                </a>
            </li>
            <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php?page=kampus">
                    <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                    <span>Data Kampus</span>
                </a>
            </li>
            <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php?page=keperluanmhs">
                    <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                    <span>Keperluan</span>
                </a>
            </li>
            <li>
                <a style='padding-top:8px; color:#fff; border-radius:0px; background:#865531; text-align:left; padding-left:15px' class="btn dropdown-toggle" href="#">              
                    <i style='margin-top:-11px; color:#fff' class="fa fa-table"></i>
                    <span>Data User</span> <b class="caret"></b>
                </a>
                 <ul class="submenu">
                    <li><a href="#">Data User Biasa</a></li>
                    <li><a href="#">Data User Input</a></li>
                    <?php if ($_SESSION[level] == 'user_admin'){ ?>
                    <li><a href="#">Data User Admin</a></li>
                    <?php } ?>

                </ul>
            </li>            

            <?php } ?>

             

           
        </ul>