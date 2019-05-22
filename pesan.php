<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>NOTLIKETHIS THEATER</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/form.css"> 
	<script type="text/javascript" src="js/jquery-2.1.4.js"></script>
	<?php
		require 'connect.php';
		$kode_film = $_POST['kode_film'];
		$kode_jadwal = $_POST['kode_jadwal'];
		$no_theater = $_POST['no_theater'];	
		$theater = "kursi";

		date_default_timezone_set('Asia/Jakarta');
		$tanggal = date('Y-m-d');

		$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT film.nama_film, jadwal.harga,jadwal.jam_mulai,theater.kapasitas FROM film,jadwal,theater WHERE film.kode_film= $kode_film AND jadwal.kode_jadwal=$kode_jadwal AND theater.no_theater=$no_theater");
		while ($data =mysqli_fetch_array($result)){
			$tampil_film = $data['nama_film'];
			$tampil_jam = $data['jam_mulai'];
			$harga = $data['harga'];
			$kapasitas = $data['kapasitas'];
		}

		$resultKursi = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT COUNT(*) FROM transaksi WHERE kode_jadwal= $kode_jadwal AND no_theater=$no_theater AND waktu_transaksi LIKE '$tanggal%'");
		while ($dataKursiTotal = mysqli_fetch_array($resultKursi)){
			$jumlahKursi = $dataKursiTotal['COUNT(*)'];
		} 

		$sisaKursi = $kapasitas - $jumlahKursi;
	?>
	<script>
	function kursiSementara(kursiChecked){
		var count;
		count = parseInt(document.getElementById('sisaKursi').value);
		if(kursiChecked.checked){
			count--;
			document.getElementById('sisaKursi').value = +count;}
		else {
			count++;
			document.getElementById('sisaKursi').value = +count;
		}
		/*
		var jumlahKursiTerpilih = $('input[name="no_kursi[]"]:checked').length;
		var totalKursi = $('input:checkbox').length;
		var countKursi = parseInt(document.getElementById('sisaKursi').value);
		var temp = totalKursi-countKursi;
		sisaKursi = totalKursi - 3 - jumlahKursiTerpilih;
		document.getElementById('sisaKursi').value = +sisaKursi;
		*/
	}

	</script>
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
		    		<div class="title">
		    		 <?php echo "PILIH KURSI FILM ".$tampil_film." JAM ".$tampil_jam ?>
		    		</div>
		    		<form action="input_pesan.php" method="POST" name="pesanKursi">	
			    		<table cellspacing =0 align="center" class="table-kursi">
			    			<tr>
			    			<td colspan="13">
				    			<div class="title-sisaKursi">  
					    			<label>  			
					    				Kursi Tersisa : <input type="text" id="sisaKursi"  value="<?php echo $sisaKursi;?>">	
					    			</label>
				    			</div>
			    			</td>
			    			</tr>		    	
			    			<tr>
								<?php
									$result1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM kursi WHERE no_theater=$no_theater AND no_kursi LIKE '%A'");
									while ($A1 = mysqli_fetch_array($result1)){
										$query1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transaksi WHERE kode_jadwal=$kode_jadwal AND no_theater=$no_theater AND no_kursi LIKE'%A' AND waktu_transaksi LIKE '$tanggal%'");
										while($datakursi= mysqli_fetch_array($query1)){
	   									if ($datakursi['id_kursi'] == $A1['id_kursi']){					
	   										$check_kursi=$A1['id_kursi'];
	   										$disabled = "disabled";
											}
								}?>
								<td>
									<div id="ck-button">
										<label style="<?php if ($A1['id_kursi']!=$check_kursi){
											 $disabled = "";
										}else
										echo "background: #D50000;";?>" class="<?php echo "$disabled";?>">
											<input type="checkbox" name="no_kursi[]" onchange="kursiSementara(this)" value="<?php echo $A1['id_kursi'];?> ">
												<span><?php echo $A1['no_kursi'];?></span>
										</label>
									</div>
								</td>
								<?php }?>
							</tr>
							<tr>
								<?php
									$result2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM kursi WHERE no_theater=$no_theater AND no_kursi LIKE '%B'");
									while ($B1 = mysqli_fetch_array($result2)){	
										$query2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transaksi WHERE kode_jadwal=$kode_jadwal AND no_theater=$no_theater AND no_kursi LIKE'%B' and waktu_transaksi LIKE '$tanggal%'");
										while($datakursi2= mysqli_fetch_array($query2)){
										if ($datakursi2['id_kursi'] == $B1['id_kursi']){
											$check_kursi= $B1['id_kursi'];
											$disabled = "disabled";
										}
									}?>
								<td>
									<div id="ck-button">
	   									<label style="<?php if ($B1['id_kursi']!=$check_kursi) {
	   										$disabled = "";		
										}else 
										echo "background: #D50000;";?>" class="<?php echo $disabled;?>">
											<input type="checkbox" name="no_kursi[]" onchange="kursiSementara(this)" value="<?php echo $B1['id_kursi'];?>">
												<span><?php echo $B1['no_kursi'];?></span>
										</label>
									</div>
									<?php 
									}?>
								</td>
							</tr>
							<tr>
								<?php
									$result3 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM kursi WHERE no_theater=$no_theater AND no_kursi LIKE '%C'");
									while ($C1 = mysqli_fetch_array($result3)){
										$query3 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transaksi WHERE kode_jadwal=$kode_jadwal AND no_theater=$no_theater AND no_kursi LIKE'%C' and waktu_transaksi LIKE '$tanggal%'");
										while ($datakursi3= mysqli_fetch_array($query3)){
											if($datakursi3['id_kursi']==$C1['id_kursi']){
												$check_kursi= $C1['id_kursi'];
												$disabled = "disabled";
											}
									}?>
								<td>
									<div id="ck-button">
										<label style="<?php if ($C1['id_kursi']!=$check_kursi){	
											$disabled = "";	
										} 
											else echo "background: #D50000;";?>" class="<?php echo $disabled;?>">
												<input type="checkbox" name="no_kursi[]" onchange="kursiSementara(this)" value="<?php echo $C1['id_kursi'];?>">
													<span><?php echo $C1['no_kursi'];?></span>
										</label>
									</div>
										<?php 
									}?>
								</td>
							</tr>
							<tr>
								<?php 
									$result4 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM kursi WHERE no_theater=$no_theater AND no_kursi LIKE '%D'");
									while ($D1 = mysqli_fetch_array($result4)){
										$query4 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transaksi WHERE kode_jadwal=$kode_jadwal AND no_theater=$no_theater AND no_kursi LIKE'%D' and waktu_transaksi LIKE '$tanggal%'");
										while($datakursi4 = mysqli_fetch_array($query4)){
											if($datakursi4['id_kursi'] == $D1['id_kursi']){
												$check_kursi = $D1['id_kursi'];
												$disabled = "disabled";
											}
									}?>
								<td>
									<div id="ck-button">
										<label style="<?php if ($D1['id_kursi']!=$check_kursi){
											$disabled= "";			
										}
											else echo "background: #D50000;";?>" class="<?php echo $disabled;?>">
												<input type="checkbox" name="no_kursi[]" onchange="kursiSementara(this)" value="<?php echo $D1['id_kursi'];?>">
													<span><?php echo $D1['no_kursi'];?></span>
										</label>
									</div>
									<?php
									}?>
								</td>
							</tr>
							<tr>
								<?php
									$result5 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM kursi WHERE no_theater=$no_theater AND no_kursi LIKE '%E'");
									while ($E1=mysqli_fetch_array($result5)){
										$query5= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transaksi WHERE kode_jadwal=$kode_jadwal AND no_theater=$no_theater AND no_kursi LIKE '%E' and waktu_transaksi LIKE '$tanggal%'");
										while($datakursi5 = mysqli_fetch_array($query5)){
											if ($datakursi5['id_kursi'] == $E1['id_kursi']){
												$check_kursi = $E1['id_kursi'];
												$disabled = "disabled";
											}
									}?>
								<td>
									<div id="ck-button">
										<label style="<?php if ($E1['id_kursi']!=$check_kursi) {
											$disabled = "";
										}	
											else echo "background: #D50000;";?>" class="<?php echo $disabled;?>">
												<input type="checkbox" name="no_kursi[]"" onchange="kursiSementara(this)" value="<?php echo $E1['id_kursi'];?>">
													<span><?php echo $E1['no_kursi'];?></span>
										</label>
									</div>
									<?php
									}?>		
								</td>
							</tr>	
							<tr>
								<td colspan="13" class="btn-simpan-kursi"><button type="submit">SIMPAN</button></td>
							</tr>			
							</table>						
							<input type="hidden" name="input_kode_film" value="<?php echo $kode_film ?>">
							<input type="hidden" name="input_kode_jadwal" value="<?php echo $kode_jadwal ?>">
							<input type="hidden" name="harga" value="<?php echo $harga ?>">
							<input type="hidden" name="input_no_theater" value="<?php echo $no_theater ?>">
					      		<?php 
								
							$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM transaksi WHERE kode_jadwal=$kode_jadwal AND no_theater=$no_theater");
							while($datakursi= mysqli_fetch_array($query)){
							?>
							<input type="hidden" name="" value="<?php echo $datakursi['id_kursi']?>">
							<?php }?>
						</form>		    					
		  			</div> 
		  	</div>
</div>
</div>
</body>
</html>