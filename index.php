<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	
	<?php
		require 'connect.php';
		//error_reporting(0);

		$resultjadwal = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM jadwal");
		$countjadwal = 1;
		while($datajadwal = mysqli_fetch_array($resultjadwal)){
			
			$jam_mulai[$countjadwal] = $datajadwal['jam_mulai'];

			$countjadwal++;	
		}

		$resulttheater = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM theater");
		$counttheater = 1;
		while($datatheater = mysqli_fetch_array($resulttheater)){
			
			$nama_theater[$counttheater] = $datatheater['nama_theater'];

			$counttheater++;
			
		}
	?>	
</head>
<body>
	<div class="header">
		<div class="title-header">
	<table class="menu-top" align="right">
		<tr>
			<td>
			<a href="tambah_theater.php" class="list-header">TAMBAH THEATER</a>
			</td>
			<form action="search.php" method="POST">
			<td>
			<input type="search" name="search" class="menu-top" placeholder="cari film...">
			</td>
			<td>
			<button>cari</button> 
			</td>
			</form>
		</tr>
	</table>
		
		NOTLIKETHIS
		<br>THEATER

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
			    			<?php $i=1;$a=1;$b;$countfilm=1;$j=1;
			    			$queryfilm = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM film WHERE akhir_tayang > NOW()");
			    			while ($datafilm = mysqli_fetch_array($queryfilm)){
			    				$kode_film[$countfilm] = $datafilm['kode_film'];
								$nama_film[$countfilm] = $datafilm['nama_film'];
								$poster_film[$countfilm] = $datafilm['poster_film'];
								$resultfilm = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT theater.nama_theater,jadwal.jam_mulai,penayangan.id_theater,penayangan.id_jadwal,penayangan.id_film from penayangan left join jadwal on jadwal.kode_jadwal=penayangan.id_jadwal left join theater on theater.no_theater=penayangan.id_theater where penayangan.id_film=$kode_film[$countfilm] GROUP BY penayangan.id_theater,penayangan.id_jadwal order by theater.nama_theater") ;
								while ($datafilm=mysqli_fetch_array($resultfilm)) {
									
										
										$kode_jadwal[$a] = $datafilm['id_jadwal'];
										$no_theater[$a] = $datafilm['id_theater'];
										$namajadwal[$a]=$datafilm['jam_mulai'];
										$namatheater[$a]=$datafilm['nama_theater'];
										
									
										$a++;
								
								}
								
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
			    										<input type="radio" name="kode_jadwal" value="<?php echo $kode_jadwal[$j]?>">
			    											<span><?php echo $namajadwal[$j]?></span>
			    									</label>
			    								</div>

			    							</td>
			    							<td>
			    								<div id="pilih-jadwal" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="kode_jadwal" value="<?php echo $kode_jadwal[$j+1] ?>">
			    											<span><?php echo $namajadwal[$j+1]?></span>
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
			    										<input type="radio" name="no_theater" value="<?php echo $no_theater[$j] ?>">
			    											<span><?php echo $namatheater[$j] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    							<td>
			    								<div id="pilh-theater" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="no_theater" value="<?php echo $no_theater[$j+2] ?>">
			    											<span><?php echo $namatheater[$j+2] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    						</tr>
			    					</table>
			    					</td>    					
			    					
			    				<?php
			    				$j=$j+4; 
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
			    										<input type="radio" name="kode_jadwal" value="<?php echo $kode_jadwal[$j]?>">
			    											<span><?php echo $namajadwal[$j]?></span>
			    									</label>
			    								</div>

			    							</td>
			    							<td>
			    								<div id="pilih-jadwal" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="kode_jadwal" value="<?php echo $kode_jadwal[$j+1]?>">
			    											<span><?php echo $namajadwal[$j+1]?></span>
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
			    										<input type="radio" name="no_theater" value="<?php echo $no_theater[$j] ?>">
			    											<span><?php echo $namatheater[$j] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    							<td>
			    								<div id="pilh-theater" class="checkbox-film">
			    									<label>
			    										<input type="radio" name="no_theater" value="<?php echo $no_theater[$j+2] ?>">
			    											<span><?php echo $namatheater[$j+2] ?></span>
			    									</label>
			    								</div>
			    							</td>
			    						</tr>
			    					</table>
			    					</td>
			    				</tr>
			    				<?php 
			    				$j=$j+4; 
			    				}
			    				$i++;
			    				$countfilm++;
			    			
			    			} ?>
			    				<tr>
			    					<td colspan="2">
			    						<!--<div class="form-row-simpan">
			    						    <a href="#open-modal" class="btn-close">LANJUTKAN PEMILIHAN</a>
			    						</div>
			    						-->
			    						<button class="pemesanan">LANJUTKAN PEMILIHAN</button>
			    					</td>
			    				</tr>
			    			</table>
	 				<!--<div class="modal" id="open-modal">
	                	<div class="modal-dialog">
	                    	<div class="modal-header">
	                   		 	<span><a href="#" class="close" aria-hidden="true">&times;</a></span> 
	                        <h2>KONFIRMASI PEMESANAN</h2>
	                        CHANGED TO "#close"
	                    	</div>
		                    <div class="modal-body">
		                        <h3>Film yang dipilih masih memiliki kursi yang tersedia</h3>
		                    </div>
		                    <div class="modal-footer">
		                        <button>OK</button>
		                    </div>
	                	</div>
	                </div>
	                -->
				    </form>	 
		    </div>    
	</div>
</div>
</body>
</html>