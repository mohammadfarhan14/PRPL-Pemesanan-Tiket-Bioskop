<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/form.css"> 
	<?php 
		require 'connect.php';
		$kode_film = $_POST['input_kode_film'];
		$kode_jadwal = $_POST['input_kode_jadwal'];
		$no_theater = $_POST['input_no_theater'];
		$id_kursi = $_POST['no_kursi'];
		$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT film.nama_film, jadwal.jam_mulai,jadwal.harga FROM film,jadwal WHERE jadwal.kode_jadwal=$kode_jadwal and film.kode_film=$kode_film");
		while ($data = mysqli_fetch_array($result)){
			$tampil_film = $data['nama_film'];
			$tampil_jam = $data['jam_mulai'];
			$harga = $data['harga'];

		}
		for ($i=0; $i <sizeof($id_kursi) ; $i++) { 
			$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM kursi WHERE id_kursi =$id_kursi[$i]");
				while($datakursi = mysqli_fetch_array($query)){
					$tempat_kursi[$i] = $datakursi['no_kursi'];
				}
		}
		date_default_timezone_set('Asia/Jakarta');
		$waktu = date('d-M-Y H:i:s');
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
				<div class="title">KONFIRMASI PEMBAYARAN TIKET</div>
					<form class="form" method="POST" action="transaksi.php">
						<div class="form-row">
							<label>
								<span>Nama Film</span>
								<input type="text" name="nama_film" value="<?php echo $tampil_film ?>">
							</label>
						</div>
						<div class="form-row">
							<label>
								<span>Jam Ditayangkan</span>
								<input type="text" name="jam_mulai" value="<?php echo $tampil_jam ?>">
								</label>
						</div>
						<div class="form-row">
							<label> 
								<span>Nomor Kursi yang Dipesan</span>
									<?php for ($i=0; $i<sizeof($id_kursi) ; $i++) {?>
								<input type="text" name="no_kursi[]" value="<?php echo $tempat_kursi[$i];?>">
							</label>
									<?php } ?> 
						</div>
							<?php 
								$harga_total = $harga*sizeof($id_kursi);
								$format = number_format($harga_total,2,",",".");
							?>
						<div class="form-row">
							<label>
								<span>Ruang Theater</span>
								<input type="text" name="no_theater" value="<?php echo $no_theater?>">
							</label>
						</div>
						<div class="form-row">
							<label>
								<span>Total Pembayaran</span>
								<input type="text" name="harga_total" value="<?php echo "Rp $format" ;?>">
							</label>
						</div>
						<div class="form-row">
							<label>
								<span>Waktu Pemesanan</span>
								<input type="text" name="waktu_transaksi" value="<?php echo $waktu?>">
							</label>
						</div>
						<div class="form-row">						
								<button type="submit" class="btn-simpan">Konfirmasi</button>						
						</div>
							<?php for ($i=0; $i<sizeof($id_kursi) ; $i++) {?>
						<input type="hidden" name="id_kursi[]" value="<?php echo $id_kursi[$i] ?>">
							<?php } ?>
						<input type="hidden" name="kode_jadwal" value="<?php echo $kode_jadwal ?>" >
				</form>
			</div>
		</div>
	</div>
</body>
</html>