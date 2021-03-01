<ul style='margin-top:25px' id="dashboard-menu">
    <li>
        <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-success" href="index.php">
            <i style='margin-top:-11px; color:#fff' class="fa fa-laptop"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <?php if ($_SESSION['unit'] == '0') { ?>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=inbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Inbox A, F</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=binbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Inbox B, C, D, E</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=inboxg">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Inbox G</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#bd2220; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=outbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Outbox A, F</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#bd2220; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=boutbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Outbox B. C. D. E</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#bd2220; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=outboxg">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Outbox G</span>
            </a>
        </li>
        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#f25237; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=undangan">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Undangan</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#929e31; text-align:left; padding-left:15px' class="btn " href="index.php?page=laporan">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Laporan</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#666b66; text-align:left; padding-left:15px' class="btn " href="index.php?page=kendaraan">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Kendaraan</span>
            </a>
        </li>

    <?php } elseif ($_SESSION['unit'] == 'F') { ?>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=inbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Masuk</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#bd2220; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=outbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Keluar</span>
            </a>
        </li>

    <?php } elseif ($_SESSION['unit'] == 'G') { ?>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=inboxg">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Masuk</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#bd2220; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=outboxg">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Keluar</span>
            </a>
        </li>

    <?php } elseif ($_SESSION['unit'] == 'A') { ?>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=inbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Masuk</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#bd2220; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=outbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Keluar</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#f25237; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=undangan">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Undangan</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#929e31; text-align:left; padding-left:15px' class="btn " href="index.php?page=laporan">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Laporan</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#666b66; text-align:left; padding-left:15px' class="btn " href="index.php?page=kendaraan">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Kendaraan</span>
            </a>
        </li>

    <?php } else { ?>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; text-align:left; padding-left:15px' class="btn btn-info" href="index.php?page=binbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Masuk</span>
            </a>
        </li>

        <li>
            <a style='padding-top:8px; color:#fff; border-radius:0px; background:#bd2220; text-align:left; padding-left:15px' class="btn btn-danger" href="index.php?page=boutbox">
                <i style='margin-top:-11px; color:#fff' class="fa fa-files-o"></i>
                <span>Surat Keluar</span>
            </a>
        </li>

    <?php } ?>

    <li>
        <a style='padding-top:8px; color:#fff; border-radius:0px; background:#865531; text-align:left; padding-left:15px' class="btn dropdown-toggle" href="#">
            <i style='margin-top:-11px; color:#fff' class="fa fa-table"></i>
            <span>Data User</span> <b class="caret"></b>
        </a>
        <ul class="submenu">
            <li><a href="index.php?page=user&stat=1">Data User Biasa</a></li>
            <li><a href="index.php?page=user&stat=2">Data User Input</a></li>
            <?php if ($_SESSION['level'] == 'user_admin') { ?>
                <li><a href="index.php?page=user&stat=3">Data User Admin</a></li>
            <?php } ?>

        </ul>
    </li>


</ul>