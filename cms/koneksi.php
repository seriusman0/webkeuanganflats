<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "dbwebkeuangan";

$conn = mysqli_connect($server,$username,$password,$database) or die ("Gagal");
	function query($conn, $tableName){
		$query = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM $tableName GROUP BY nif"));
		return $query;
	}

	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

    function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;
	}

    function upload(){
	
		$namaFile= $_FILES['gambar']['name'];
		$ukuranFile = $_FILES['gambar']['size'];
		$error = $_FILES['gambar']['error'];
		$tmpName = $_FILES['gambar']['tmp_name'];

		// cek apakah gambar di upload
		if($error === 4){
			echo "<script>
					alert ('Pilih Gambar terlebih dahulu');
				</script>";
			return false;
		}

		//cek apakah yang di upload adalah gambar
		$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
		$ekstensiGambar = explode('.', $namaFile);
		$ekstensiGambar = strtolower(end($ekstensiGambar));
		if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
			echo "<script>
					alert ('Yang Anda Upload Bukan Gambar');
				</script>";
			return false;
		}

		//cek jika ukuran terlalu besar 
		if($ukuranFile > 3000000){
			echo "<script>
					alert ('Ukuran Gambar telalu Besar');
				</script>";
			return false;
		}

		//lolos pengecekan
		//generate nama file baru
		$namaFileBaru = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .=$ekstensiGambar;
		move_uploaded_file($tmpName, 'images/avatar/'. $namaFileBaru);
		return $namaFileBaru;
	}

	
	function tabelPengeluaran($conn, $tableName){
		$no = 1;
		$i = query($conn, $tableName);
		while($i){

		 $output = '';
		 $output .= '<label class="text-success">DATA</label>';
	     $select_query = "SELECT * FROM pengeluaran ORDER BY nif DESC limit 100";
	     $result = mysqli_query($conn, $select_query);
	     $output .= '
	      <table class="table table-bordered">  
                    <tr>  
                         <th width="55%">Nama Karyawan</th>  
                         <th width="15%">Lihat</th>  
                         <th width="15%">Edit</th>  
                         <th width="15%">Hapus</th>  
                    </tr>
     ';
		} 
     echo $output;
		
	}
	
?>