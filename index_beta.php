<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/form.css"> 
	<?php 
		require 'connect.php';
		date_default_timezone_set('Asia/Jakarta');
		$tanggal= date("Y-m-d");
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
				<div class="title">JADWAL FILM <?php echo date ('d')." ".date('m')." ".date('Y');?>
				
				</div>
				<?php
					$result1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM film WHERE akhir_tayang >NOW()");
					while ($data1 = mysqli_fetch_array($result1)) {
						$kode_film = $data1['kode_film'];
						$poster_film = $data1['poster_film'];
						
					?>
						<td colspan="2">
							<div id="checkbox-film-img">
								<label>
									<input type="radio" name="kode_film" value="<?php echo $kode_film?>">
										<span><img src="img/<?php echo $poster_film ?>"" class="image"></span>
								</label>
							</div>
						</td> 
							<?php 
								$result2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT theater.nama_theater,jadwal.jam_mulai,penayangan.id_theater,penayangan.id_jadwal from penayangan left join jadwal on jadwal.kode_jadwal=penayangan.id_jadwal left join theater on theater.no_theater=penayangan.id_theater order by theater.nama_theater");
								while ($data2 = mysqli_fetch_array($result2)){
									$no_theater = $data2['id_theater'];
									$nama_theater = $data2['nama_theater'];
									$kode_jadwal = $data2['id_jadwal'];
									$jam_mulai = $data2['jam_mulai'];
									?>
						<tr>
							<td>
								<div id="pilih-jadwal" class="checkbox-film">
									<label>
										<input type="radio" name="kode_jadwal" value="<?php echo $kode_jadwal?>">
											<span><?php echo $jam_mulai?></span>
									</label>
								</div>
							</td>
						</tr>
						<tr>
						</tr>
								<?php} ?>
									
						<td>
							<?php
						 }?>

					
			</div>
		</div>
	</div>
</body>
</html>