<?php 
	
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "dbpendaftar";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));


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
		else if ($_GET['hal'] == "hapus") 
		{
			$hapus = mysqli_query($koneksi, "DELETE FROM tb_calonmhs WHERE id = '$_GET[id]' ");
			if ($hapus) {
				echo "<script>
					alert('Data Terhapus!');
					document.location='home.php';
				  </script>";
			}
		}
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Tabel Data Pendaftar</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>

	<div class="card mt-3">
		<div class="card-header text-white" style="background-color: green;">
		    Tabel Data Pendaftar
		</div>
		<div class="card-body">
		  
		<table class="table table-bordered table-striped">
		<tr>
			<th>Nama Peserta</th>
		  	<th>NIK</th>
		  	<th>Alamat</th>
		  	<th>Tempat Lahir</th>
		  	<th>Tanggal Lahir</th>
		  	<th>Email</th>
		  	<th>Agama</th>
		  	<th>Pilihan 1</th>
		  	<th>Pilihan 2</th>
		  	<th>Profile Diri</th>
		  	<th>Aksi</th>
		 </tr>
		 
		 <?php
		  	$tampil = mysqli_query($koneksi, "SELECT * from tb_calonmhs order by id desc");
		  	while($data = mysqli_fetch_array($tampil)) :

		?>
		<tr>
		  	<td> <?=$data['Nama']?> </td>
		  	<td> <?=$data['NIK']?> </td>
		  	<td> <?=$data['Alamat']?> </td>
		  	<td> <?=$data['Tempat_lahir']?> </td>
		  	<td> <?=$data['Tanggal_lahir']?> </td>
		  	<td> <?=$data['email']?> </td>
		  	<td> <?=$data['agama']?> </td>
		  	<td> <?=$data['pil1']?> </td>
		  	<td> <?=$data['pil2']?> </td>
		  	<td> <img src=<?=$data['foto']?>> </td>
		  	<td>
		  		<a href="index.php?hal=edit&id=<?=$data['id']?>" class="btn btn-warning">Edit</a>
		  		<a href="tabel.php?hal=hapus&id=<?=$data['id']?>" onclick="return confirm('Penghapusan bersifat permanen, apakah anda yakin?')" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
	    <?php endwhile; ?> <!-- penutup while -->
	 	</table>

		</div>
	</div>
	
	<p>
		<button onclick="window.location.href='home.php'">Back to Home &raquo;</button>
    </p>


    <footer>
		<p style="text-align: center; margin-top: 100px;"> @copyright | Muhamad Yusuf Maulana Pilkom B-2019 </p>
	</footer>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>