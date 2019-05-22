!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<?php
		require 'connect.php';
		//error_reporting(0);
		$resultfilm = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM film WHERE  akhir_tayang > NOW()");
		$countfilm=1;
		while($datafilm = mysqli_fetch_array($resultfilm)){
			$kode_film[$countfilm] = $datafilm['kode_film'];
			$nama_film[$countfilm] = $datafilm['nama_film'];
			$poster_film[$countfilm] = $datafilm['poster_film'];
				
			$countfilm++;
		}

		$resultjadwal = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM jadwal");
		$countjadwal = 1;
		while($datajadwal = mysqli_fetch_array($resultjadwal)){
			$jam_mulai[$countjadwal] = $datajadwal['jam_mulai'];

			$countjadwal++;	
		}

		$resulttheater = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM theater");
		$counttheater = 1;
		while($datatheater = mysqli_fetch_array($resulttheater)){
			$no_theater[$counttheater] = $datatheater['nama_theater'];

			$counttheater++;
			
		}
	?>	
</head>
<body>
	<div class="header">
		<div class="title-header">
		NOTLIKETHIS
		<br>THEATER
				<table align="right">
			<td ><a href="ubah_film.php" class="menu-header">UBAH FILM</a></td>

		</table>
		</div>

	</div>
	<div class="row">		
		<div class="col-12">
		    <div class="white-box">
		    	<div class="title">
		    		JADWAL FILM <?php echo date('d')." ".date('m')." ".date('Y');?>
		    	</div>
		 				<form action="pesan.php" method="POST">	
			    			<table class="table-film">
			    			<?php $i=1;$a;$b;
			    			$queryfilm = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM film WHERE akhir_tayang > NOW()");
			    			while ($data = mysqli_fetch_array($queryfilm)){
			    			
			    				if($i%2!=0){
			    				
			    				?>	<tr>
			    					<td class="left">
			    					<table>
			    						<tr>
			    							<td colspan="2">
			    								<div id="checkbox-film-img">
			    									<label>
			    										<input type="radio" name="kode_film" value="<?php echo $kode_film[$i]?>">
			    											<span><img src="img/<?php echo $poster_film[$i] ?>" class="image"></span>
			    									</label>
			    								</div>			    								
			    							</td>
			    						</tr>
			    						<tr>
			    							<td>
			    								<div id="pilih-jadwal" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="kode_jadwal" value="<?php echo $i?>">
			    											<span><?php echo $jam_mulai[$i]?></span>
			    									</label>
			    								</div>

			    							</td>
			    							<td>
			    								<div id="pilih-jadwal" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="kode_jadwal" value="<?php echo $i+1 ?>">
			    											<span><?php echo $jam_mulai[$i+1]?></span>
			    									</label>
			    								</div>
			    							</td>
			    							<td>
			    							</td>
			    						</tr>
			    						<tr>
			    							<td>
			    								<div id="pilih-theater" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="no_theater" value=1>
			    											<span><?php echo $no_theater[1] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    							<td>
			    								<div id="pilh-theater" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="no_theater" value=3>
			    											<span><?php echo $no_theater[3] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    						</tr>
			    					</table>
			    					</td>    					
			    				
			    				<?php 
			    				}else { ?>
			    					<td class="right">
			    					<table>
			    						<tr>
			    							<td colspan="2">
			    								<div id="checkbox-film-img">
			    									<label>
			    										<input type="radio" name="kode_film" value="<?php echo $kode_film[$i]?>">
			    											<span><img src="img/<?php echo $poster_film[$i] ?>" class="image"></span>
			    									</label>
			    								</div>			    								
			    							</td>
			    						</tr>
			    						<tr>
			    							<td>
			    								<div id="pilih-jadwal" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="kode_jadwal" value="<?php echo $i-1?>">
			    											<span><?php echo $jam_mulai[$i-1]?></span>
			    									</label>
			    								</div>

			    							</td>
			    							<td>
			    								<div id="pilih-jadwal" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="kode_jadwal" value="<?php echo $i ?>">
			    											<span><?php echo $jam_mulai[$i]?></span>
			    									</label>
			    								</div>
			    							</td>
			    							<td>
			    							</td>
			    						</tr>
			    						<tr>
			    							<td>
			    								<div id="pilih-theater" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="no_theater" value=1>
			    											<span><?php echo $no_theater[2] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    							<td>
			    								<div id="pilh-theater" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="no_theater" value=3>
			    											<span><?php echo $no_theater[4] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    						</tr>
			    					</table>
			    					</td>
			    				</tr>
			    				<?php 
			    				}
			    				$i++;
			    			} ?>
			    				<tr>
			    					<td colspan="2">
			    						<button class="pemesanan">LANJUTKAN PEMESANAN</button>
			    					</td>
			    				</tr>
			    			</table>
			    		</form>	 
		  		</div> 
		  </div>
	</div>
</div>
</body>
</html>