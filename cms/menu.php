<style>
    @media print {
        #dashboard-menu {
            display: none;
        }

    }
</style>
<ul style='margin-top:25px' id="dashboard-menu">
    <li>
        <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php">
            <i style='margin-top:-11px; color:#fff' class="fa fa-laptop"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=pemasukkan">
            <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
            <span>Pemasukkan</span>
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

    <?php if ($_SESSION['level'] == '0' || $_SESSION['level'] == '1') { ?>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php?page=kaskecil">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Kas Kecil</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php?page=mahasiswa">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Data Mahasiswa</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php?page=gembala">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Data Gembala</span>
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
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=pengajuanmhs">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Pengajuan</span>
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
                <?php if ($_SESSION['level'] == '0') { ?>
                    <li><a href="#">Data User Admin</a></li>
                <?php } ?>

            </ul>
        </li>

    <?php } ?>




</ul>