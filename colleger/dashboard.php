<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="bootstrap-4.5.2-dist/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="js/jquery-3.5.1.min.js"></script>
<script src="js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php 
      include "navbar.php"; 
    ?>
    <!-- END NAVBAR -->
    
    <!-- MODAL -->

     <div class="modal" tabindex="-1" id="gantiPassword">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
          <form action="cPassword.php" method="POST">
            <div class="modal-body">
            <p>Untuk menjaga privasi akun Saudara Saudari, Maka Silakan Ganti password default Anda dengan Password yang baru.</p>
                  <input type="password" name="cPassword1" min="4" max="10" required placeholder="Masukkan Password Baru" >
                  <input type="password" name="cPassword2" min="4" max="10" required placeholder="Konfirmasi Password Baru" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="oke">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- END MODAL -->



    <div class="container  p- margin-right: 1rem" id="konten">
      <?php include "home.php";
          if ($_SESSION['status'] == '0'){ ?>
          <script>$('#gantiPassword').modal('show');</script>
      <?php } ?>
    </div>
</body>
</html>

<script>
  
  function form(){
  		$.get("form.php", function(data) {
		  $( "#konten" ).html(data);
		});
  }

  function home(){
      $.get("home.php", function(data) {
      $( "#konten" ).html(data);
    });
  }
</script>
