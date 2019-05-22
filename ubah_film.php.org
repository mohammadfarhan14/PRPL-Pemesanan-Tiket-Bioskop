<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/form.css"> 
	<?php 
		require 'connect.php';
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
				<div class="title">FORM PEMBAHARUAN FILM</div>
				<form class="form" method="POST" action="ubah_film_connect.php" enctype="multipart/form-data">
					<div class="form-row">
						<label>
							<span>Nama Film ke-1</span>
							<input type="text" name="nama_film1">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Poster Film</span>
							<input type="file" name="poster_film1">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Tanggal Rilis</span>
							<input type="date" name="tanggal_rilis1">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Nama Film ke-2</span>
							<input type="text" name="nama_film2">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Poster Film</span>
							<input type="file" name="poster_film2">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Tanggal Rilis</span>
							<input type="date" name="tanggal_rilis2">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Nama Film ke-3</span>
							<input type="text" name="nama_film3">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Poster Film</span>
							<input type="file" name="poster_film3">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Tanggal Rilis</span>
							<input type="date" name="tanggal_rilis3">
						</label>
					<div class="form-row">
						<label>
							<span>Nama Film ke-4</span>
							<input type="text" name="nama_film4">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Poster Film</span>
							<input type="file" name="poster_film4">
						</label>
					</div>
					<div class="form-row">
						<label>
							<span>Tanggal Rilis</span>
							<input type="date" name="tanggal_rilis4">
						</label>
					</div>
					<div class="form-row">
						<button type="submit" class="btn-simpan" onclick="sukses()">
							Konfirmasi
						</button>
						<script type="text/javascript">
							function sukses(){
								alert("Film Berhasil Diperbaharui");
							}
						</script>
					</div>
				</form>
			</div>		
		</div>
	</div>
</body>
</html>