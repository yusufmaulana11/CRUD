<?php 
	
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "dbpendaftar";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	if(isset($_POST['simpan']))
	{
		if ($_GET['hal'] == "edit")
		{
			$edit = mysqli_query($koneksi, "UPDATE tb_calonmhs set
										   	Nama = '$_POST[nama]', 
											NIK  = '$_POST[nik]',
											Alamat ='$_POST[Alamat]', 
										  	Tempat_lahir ='$_POST[tempat]', 
										  	Tanggal_lahir ='$_POST[tanggal]', 
										  	email ='$_POST[email]', 
										  	agama ='$_POST[agama]', 
										  	pil1 ='$_POST[pil1]', 
										  	pil2 ='$_POST[pil2]', 
										  	foto ='$_FILES[photo]',
										  	WHERE id = '$_GET[id]'
										  ");

			if($edit)
			{
				echo "<script>
						alert('Edit Data Berhasil!');
						document.location='home.php';
					  </script>";
			}else
			{
				echo "<script>
						alert('Edit Data Gagal');
						document.location='home.php';
					  </script>";
			}	
		} 
		else
		{
			$simpan = mysqli_query($koneksi, "INSERT INTO tb_calonmhs (Nama, NIK, Alamat, Tempat_lahir, Tanggal_lahir, email, agama, pil1, pil2, foto)
										  VALUES ('$_POST[nama]', 
										  		 '$_POST[nik]',
										  		 '$_POST[Alamat]', 
										  		 '$_POST[tempat]', 
										  		 '$_POST[tanggal]', 
										  		 '$_POST[email]', 
										  		 '$_POST[agama]', 
										  		 '$_POST[pil1]', 
										  		 '$_POST[pil2]', 
										  		 '$_FILES[photo]')
										  ");
					
			if($simpan)
			{
				echo "<script>
						alert('Data Berhasil Disimpan!');
						document.location='home.php';
					  </script>";
			}else
			{
				echo "<script>
						alert('GAGAL menyimpan data');
						document.location='home.php';
					  </script>";
			}	
		}

	}



//
	if(isset($_GET['hal']))
	{
		if($_GET['hal'] == "edit")
		{
			$tampil = mysqli_query($koneksi, "SELECT * FROM tb_calonmhs WHERE id = '$_GET[id]' ");
			$data = mysqli_fetch_array($tampil);
			if($data)
			{
				$vnama = $data['Nama']; 
				$vnik = $data['NIK'];
				$valamat = $data['Alamat'];
				$vtempat = $data['Tempat_lahir'];
				$vtanggal = $data['Tanggal_lahir'];
				$vemail = $data['email'];
				$vagama = $data['agama'];
				$vpil1 = $data['pil1'];
				$vpil2 = $data['pil2'];
				$vfoto = $data['foto'];										  
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>UTS CRUD PROMNET 2021 + Bootstrap 4</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
	
	<h1 style="text-align: center;">Formulir Pendaftaran PTS Kota Bandung</h1>

	<!-- awal page -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Pendaftaran Peserta Didik PTS Kota Bandung 2021
	  </div>
	  <div class="card-body">
	    <form method="post" action="" enctype="multipart/form-data">
	    	<div class="form-group">
	    		<label>Nama Peserta</label>
	    		<input type="text" name="nama" value="<?=@$vnama?>" class="form-control" placeholder="Masukkan Nama Anda" required>
	    	</div>
	    	<div class="form-group">
	    		<label>NIK</label>
	    		<input type="number" name="nik" value="<?=@$vnik?>" class="form-control" placeholder="Masukkan NIK Anda" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Alamat</label>
	    		<textarea type="textarea" name="Alamat" class="form-control" placeholder="Masukkan Alamat Anda" required><?=@$valamat?></textarea>
	    	</div>
	    	<div class="form-group">
	    		<label>Tempat Lahir</label>
	    		<input type="text" name="tempat" value="<?=@$vtempat?>" class="form-control" placeholder="Masukkan Tempat Lahir Anda" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Tanggal Lahir</label>
	    		<input type="date" name="tanggal" value="<?=@$vtanggal?>" class="form-control" required>
	    	</div>
			<div class="form-group">
	    		<label>Email</label>
	    		<input type="email" name="email" value="<?=@$vemail?>" class="form-control" placeholder="Masukkan email Anda" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Agama</label>
	    		<select class="form-control" name="agama">
	    			<option value="<?=@$vagama?>"><?=@$vagama?></option>
	    			<option value="Islam">Islam</option>
	    			<option value="Kristen">Kristen</option>
	    			<option value="Hindu">Hindu</option>
	    			<option value="Budha">Budha</option>
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label>Pilihan Pertama PTS Kota Bandung</label>
	    		<input type="text" name="pil1" value="<?=@$vpil1?>" class="form-control" placeholder="Input Nama Universitas Pilihan ke-1 Anda (cth: Universitas Widyatama)" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Pilihan Kedua PTS Kota Bandung</label>
	    		<input type="text" name="pil2" value="<?=@$vpil2?>" class="form-control" placeholder="Input Nama Universitas Pilihan ke-2 Anda (cth: Universitas Pasundan)" required>
	    	</div>
	    	<div class="form-group">
            	<label for="exampleInputFile">Photo Peserta</label>
            	<br>
            	<input type="file" name="photo" value="<?=@$vfoto?>" id="exampleInputFile">
          	</div>
	    
			<button type="submit" class="btn btn-success" name="simpan">Save</button>
	  		<button type="reset" class="btn btn-danger" name="reset">Reset</button>
	    </form>
	  </div>
	  <button onclick="window.location.href='home.php'">Back to Home</button>
	</div>
	<!-- Akhir Page form -->

	</div>

	<footer>
		<p style="text-align: center; margin-top: 100px;"> @copyright | Muhamad Yusuf Maulana Pilkom B-2019 </p>
	</footer>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>