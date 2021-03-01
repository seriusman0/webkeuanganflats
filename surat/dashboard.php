<style>
  .bs-glyphicons {
    margin: 5px 20px 20px 0px;
    overflow: hidden;
  }

  .bs-glyphicons-list {
    padding-left: 0;
    list-style: none;
  }

  .bs-glyphicons-list a {
    color: #8a8a8a !important;
  }

  ol,
  ul {
    margin-top: 0;
    margin-bottom: 10px;
  }

  .bs-glyphicons li {
    float: left;
    width: 20%;
    height: 155px;
    padding: 30px;
    font-size: 10px;
    line-height: 1.4;
    text-align: center;
    border: 1px solid #cecece;
    background-color: #ffffff;
  }

  .bs-glyphicons li:hover {
    background-color: #e3e3e3;
  }

  .bs-glyphicons .glyphicon {
    margin-top: 5px;
    margin-bottom: 10px;
    font-size: 74px;
  }

  .glyphicon {
    position: relative;
    top: 1px;
    display: inline-block;
    font-family: 'Glyphicons Halflings';
    font-style: normal;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  .bs-glyphicons .glyphicon-class {
    display: block;
    text-align: center;
    word-wrap: break-word;
  }
</style>
<div class="bs-docs-section">
  <h4 style='padding-top:15px'>Selamat Datang
    <?php
    if ($_SESSION['unit'] == '0') {
      echo "$_SESSION[namalengkap] Di";
    } else {
      echo "$_SESSION[namalengkap] Di <b style='color:red'>Unit Kerja $_SESSION[unit]</b>";
    }

    ?> Aplikasi Surat Menyurat ...</h4>
  <p style='margin-left:17px'>Aplikasi surat menyurat adalah aplikasi yang sengaja dibangun untuk mengelola semua data-data suarat masuk, surat keluar dan juga hak akses masing-masing user terhadap data-data surat masuk dan keluar pada sebuah perusahaan,
    Silahkan Mengelola Semua Data yang ada Melalui menu-menu yang telah tersedia di bawah ini : </p><br>
  <div style='margin-left:20px' class="bs-glyphicons">
    <ul class="bs-glyphicons-list">


      <a href='index.php'>
        <li>
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
          <span class="glyphicon-class">Dashboard</span>
        </li>
      </a>

      <?php if ($_SESSION['unit'] == '0') { ?>

        <a href='inbox'>
          <li>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
            <span class="glyphicon-class">Inbox A, F</span>
          </li>
        </a>

        <a href='binbox'>
          <li>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
            <span class="glyphicon-class">Inbox B, C, D, E</span>
          </li>
        </a>

        <a href='inboxg'>
          <li>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
            <span class="glyphicon-class">Inbox G</span>
          </li>
        </a>

        <a href='outbox'>
          <li>
            <span class="glyphicon glyphicon-paste" aria-hidden="true"></span>
            <span class="glyphicon-class">Outbox A, F</span>
          </li>
        </a>

        <a href='boutbox'>
          <li>
            <span class="glyphicon glyphicon-paste" aria-hidden="true"></span>
            <span class="glyphicon-class">Outbox B, C, D, E</span>
          </li>
        </a>

        <a href='outboxg'>
          <li>
            <span class="glyphicon glyphicon-paste" aria-hidden="true"></span>
            <span class="glyphicon-class">Outbox G</span>
          </li>
        </a>

        <a href='undangan'>
          <li>
            <span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Undangan</span>
          </li>
        </a>

        <a href='laporan'>
          <li>
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Laporan</span>
          </li>
        </a>

        <a href='kendaraan'>
          <li>
            <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Kendaraan</span>
          </li>
        </a>

      <?php } elseif ($_SESSION[unit] == 'F') { ?>

        <a href='inbox'>
          <li>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Masuk</span>
          </li>
        </a>

        <a href='outbox'>
          <li>
            <span class="glyphicon glyphicon-paste" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Keluar</span>
          </li>
        </a>

      <?php } elseif ($_SESSION[unit] == 'A') { ?>

        <a href='inbox'>
          <li>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Masuk</span>
          </li>
        </a>

        <a href='outbox'>
          <li>
            <span class="glyphicon glyphicon-paste" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Keluar</span>
          </li>
        </a>

        <a href='undangan'>
          <li>
            <span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Undangan</span>
          </li>
        </a>

        <a href='laporan'>
          <li>
            <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Laporan</span>
          </li>
        </a>

        <a href='kendaraan'>
          <li>
            <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Kendaraan</span>
          </li>
        </a>

      <?php } else { ?>

        <a href='binbox'>
          <li>
            <span class="glyphicon glyphicon-copy" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Masuk</span>
          </li>
        </a>

        <a href='boutbox'>
          <li>
            <span class="glyphicon glyphicon-paste" aria-hidden="true"></span>
            <span class="glyphicon-class">Surat Keluar</span>
          </li>
        </a>

      <?php } ?>

      <a href='index.php?page=user&stat=1'>
        <li>
          <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
          <span class="glyphicon-class">Data User Biasa</span>
        </li>
      </a>

      <a href='index.php?page=user&stat=2'>
        <li>
          <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>
          <span class="glyphicon-class">Data User Input</span>
        </li>
      </a>

      <?php if ($_SESSION['level'] == 'user_admin') { ?>
        <a href='index.php?page=user&stat=3'>
          <li>
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <span class="glyphicon-class">Data User Admin</span>
          </li>
        </a>
      <?php } ?>

      <a href='logout.php'>
        <li>
          <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          <span class="glyphicon-class">Logout</span>
        </li>
      </a>
    </ul>
  </div>
</div>