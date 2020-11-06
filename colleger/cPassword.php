<?php 
	include 'koneksi.php';
	session_start();
	if (isset($_POST['oke'])){
		if( $_POST['cPassword1'] != $_POST['cPassword2']){
			echo "<script>
						prompt('Password yang anda masukkan tidak cocok');
					</script>";
			header ("location:logout.php");
		}	else {
			$pBaru = password_hash($_POST['cPassword1'], PASSWORD_DEFAULT);
 	
		 	//tambahkan user ke dalam database
		 	mysqli_query($conn, "UPDATE mahasiswa SET 
				password_mhs = '$pBaru', 
				status = '1'
				WHERE nif = '$_SESSION[nif]'");

				echo "<script>alert('Password Berhasil di Update');</script>";
				$_SESSION['status'] = '1';
				header ("Location: index.php");
		}
	}

 ?>