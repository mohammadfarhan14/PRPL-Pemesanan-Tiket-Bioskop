<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/form.css"> 
	<?php 
		require 'connect.php';
		$key= $_POST['search'];
	?>
</head>
<body> 	 
	<div class="header">
		<div class="title-header">
		NOTLIKETHIS
		<br>THEATER
		</div>
	</div>
	<div class="row">		
		<div class="col-12">
		    <div class="white-box">
				<div class="title">HASIL PENCARIAN</div>
					<table class="table-laporan" align="center">
					<?php 
							if($key<>""){
							$result =mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM film where nama_film like '%$key%' or kode_film like '%$key%'");
							while($data = mysqli_fetch_array($result)){
								?>
						<thead>

							<tr>
								<th>Kode Film</th>
								<th>Nama Film</th>
								<th>Tanggal Rilis</th>
								<th>Awal Tayang</th>
								<th>Akhir Tayang</th>
							</tr>
						</thead>
						<tbody>
								<tr>
									<td><?php echo $data['kode_film']; ?></td>
									<td><?php echo $data['nama_film']; ?></td>
									<td><?php echo $data['tgl_rilis']; ?></td>
									<td><?php echo $data['awal_tayang']; ?></td>
									<td><?php echo $data['akhir_tayang'];?></td>
								</tr>
						</tbody>
					</table>
					<?php 
							}
						}							
					else {
								echo "<center> HASIL TIDAK DITEMUKAN </center>";
						}?>
			</div>
		</div>
	</div>
</body>
</html>