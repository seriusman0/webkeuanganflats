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

  @media print {
    #menu {
      display: none;
    }
  }
</style>
<div class="bs-docs-section">
  <h4 style='padding-top:15px'>Selamat Datang <?= "$_SESSION[nama] Di"; ?> Aplikasi Keuangan FLATS ...</h4>
  <p style='margin-left:17px'>Aplikasi keuangan FLATS ini di kembangkan berdasarkan kebutuhan dalam pengelelolaan data data keuangan di Program Beasiswa FLATS, Silahkan Mengelola Semua Data yang ada Melalui menu-menu yang telah tersedia di bawah ini : </p><br>
  <div style='margin-left:20px' class="bs-glyphicons" id="menu">
    <ul class="bs-glyphicons-list">


      <a href='index.php'>
        <li>
          <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
          <span class="glyphicon-class">Dashboard</span>
        </li>
      </a>

      <a href='index.php?page=pemasukkan'>
        <li>
          <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
          <span class="glyphicon-class">Pemasukkan</span>
        </li>
      </a>

      <a href='index.php?page=pengeluaran'>
        <li>
          <span class="glyphicon glyphicon-eject" aria-hidden="true"></span>
          <span class="glyphicon-class">Pengeluaran</span>
        </li>
      </a>

      <a href='index.php?page=laporan'>
        <li>
          <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
          <span class="glyphicon-class">Laporan</span>
        </li>
      </a>

      <?php if ($_SESSION['level'] == '0') { ?>

        <a href='index.php?page=kaskecil'>
          <li>
            <span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>
            <span class="glyphicon-class">Kas Kecil</span>
          </li>
        </a>

        <a href='index.php?page=datauser'>
          <li>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <span class="glyphicon-class">Data User</span>
          </li>
        </a>

        <a href='index.php?page=mahasiswa'>
          <li>
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            <span class="glyphicon-class">Data Mahasiswa</span>
          </li>
        </a>

        <a href='index.php?page=kampus'>
          <li>
            <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
            <span class="glyphicon-class">Data Kampus</span>
          </li>
        </a>

        <a href='index.php?page=keperluanmhs'>
          <li>
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            <span class="glyphicon-class">Keperluan Mahasiswa</span>
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