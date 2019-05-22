<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/form.css"> 
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="js/fusioncharts.js"></script>
	<script type="text/javascript" src="js/fusioncharts.charts.js"></script>
	<script type="text/javascript" src="js/themes/fusioncharts.theme.zune.js"></script>
	<script type="text/javascript" src="js/chart-theater.js"></script>
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
				<div class="title">LAPORAN THEATER </div>
				<table class="table-laporan" align="center">
					<thead>
						<tr>
							<th>No</th>
							<th>Ruang Theater</th>
							<th>Nama Film</th>
							<th>Jam Tayang</th>
							<th>Jumlah Penonton/th>
						</tr>
					</thead>
					<tbody>
						<?php
						$tanggal= date("Y-m-d");
						$no=0;
						$i=1;
						$j=1;
						
						$result= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT DISTINCT theater.nama_theater,jadwal.jam_mulai,film.nama_film,theater.kapasitas FROM theater,jadwal,film,transaksi WHERE theater.no_theater=transaksi.no_theater AND jadwal.kode_jadwal=transaksi.kode_jadwal AND film.nama_film=transaksi.nama_film  AND film.akhir_tayang > NOW() ORDER BY theater.nama_theater,jadwal.jam_mulai");
						$result1= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT DISTINCT theater.nama_theater,jadwal.jam_mulai,theater.kapasitas,film.nama_film, count(transaksi.id_transaksi) FROM theater JOIN jadwal  JOIN FILM  left JOIN transaksi on transaksi.no_theater=theater.no_theater and  transaksi.kode_jadwal=jadwal.kode_jadwal and transaksi.nama_film=film.nama_film and transaksi.waktu_transaksi like '2017-05-07%' where film.akhir_tayang > NOW() ORDER BY theater.nama_theater");
						while ($data = mysqli_fetch_array($result)){
							$no++;
							
						?>
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $data['nama_theater'];?></td>
							<td align="left"><?php echo $data['nama_film'];?></td>
							<td><?php echo $data['jam_mulai'];?></td>
							<td>
							<?php 
							$result1= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(*) FROM transaksi where no_theater=$i AND kode_jadwal=$j AND waktu_transaksi LIKE '$tanggal%'");
							while ($data1 = mysqli_fetch_array($result1)){
							echo $data1['COUNT(*)'] ;}
							?> / <?php echo $data['kapasitas'];?></td>
						<?php
						if ($j==4){
							$i++;
							$j=0;
						}
						$j++;
						}
						?>
						</tr>
					</tbody>
				</table>
				<br>
		    		<center>
		    			<div class="title">STATISTIK PENGUNJUNG BIOSKOP</div>
		    			<div id="chart-theater"></div>
		    		</center>
			</div>
		</div>
	</div>
</body>
</html>