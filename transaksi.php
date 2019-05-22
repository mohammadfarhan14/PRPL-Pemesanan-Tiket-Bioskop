<?php
	require 'connect.php';
	date_default_timezone_set('Asia/Jakarta');
	$nama_film  = $_POST['nama_film'];
	$jam_mulai  = $_POST['jam_mulai'];
	$no_theater = $_POST['no_theater'];
	$no_kursi   = $_POST['no_kursi'];
	$kode_jadwal= $_POST['kode_jadwal'];
	$id_kursi	= $_POST['id_kursi'];
	$waktu_transaksi = date('Y-m-d H:i:s');
	$theater    = "theater$no_theater";
	$tanggal    = date('Y-m-d');


	$result1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM jadwal WHERE jam_mulai LIKE '%$jam_mulai'");
	$data_jadwal = mysqli_fetch_array($result1);
	$kode_jadwal = $data_jadwal['kode_jadwal'];
	$harga		 = $data_jadwal['harga'];
	$jadwal      = "jadwal_$kode_jadwal";

	$result2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM film WHERE nama_film LIKE '%$nama_film%'");
	$data_film   = mysqli_fetch_array($result2);
	$kode_film   = $data_film['kode_film'];
	for ($i=0; $i <sizeof($id_kursi); $i++){
		$array_no_kursi = $no_kursi[$i];
		$array_id_kursi = $id_kursi[$i];

		$input_transaksi = mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO transaksi(nama_film,id_kursi,no_kursi,kode_jadwal,jam_mulai,no_theater,harga,waktu_transaksi) VALUES ('$nama_film','$array_id_kursi','$array_no_kursi','$kode_jadwal','$jam_mulai','$no_theater','$harga','$waktu_transaksi')");

		$kursi .= "no%5B%5D=$no_kursi[$i]&";
	}
	//MEMBUAT CHART TRANSAKSI
	$result3= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(harga),DATE(`waktu_transaksi`) AS tanggal_transaksi FROM `transaksi` WHERE `waktu_transaksi` BETWEEN '2017-03-30' AND '2017-06-30' GROUP BY DATE(`waktu_transaksi`)");
	$jsonArray=array();
		while($data_transaksi= mysqli_fetch_array($result3)) {
			$jsonArrayisi = array();
			$jsonArrayisi['label'] = $data_transaksi['tanggal_transaksi'];
			$jsonArrayisi['value'] = $data_transaksi['SUM(harga)'];
			array_push($jsonArray, $jsonArrayisi);
		}
	$update_transaksi = fopen('json/statistik_transaksi_harian.json', 'w');
	fwrite($update_transaksi, json_encode($jsonArray));
	fclose($update_transaksi);

	//MEMBUAT CHART STUDIO
	$result4= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT CONCAT(theater.nama_theater,' ', jadwal.jam_mulai) as theater_jamtayang, count(transaksi.id_transaksi) as jumlah from theater cross join jadwal left join transaksi on theater.no_theater = transaksi.no_theater and jadwal.kode_jadwal=transaksi.kode_jadwal and transaksi.waktu_transaksi like '$tanggal%' group by theater.no_theater, jadwal.kode_jadwal order by theater.nama_theater");
	$jsonArrayTheater=array();
		while($data_theater= mysqli_fetch_array($result4)){
			$jsonTheaterisi = array();
			$jsonTheaterisi['label'] = $data_theater['theater_jamtayang'];
			$jsonTheaterisi['value'] = $data_theater['jumlah'];
			array_push($jsonArrayTheater,$jsonTheaterisi);
		}
	$update_theater = fopen('json/statistik_theater_harian.json', 'w');
	fwrite($update_theater, json_encode($jsonArrayTheater)); 
	fclose($update_theater);
	
	//MEMBUAT CHART FILM
	$resultfilm=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM film ");
	while($data_film = mysqli_fetch_array($resultfilm)){
		$j = $data_film['kode_film'];
		$k = $data_film['nama_film'];
		echo $k; 

	$resultfilm1 =mysqli_query($GLOBALS["___mysqli_ston"], "SELECT SUM(harga)as total_penjualan,DATE(`waktu_transaksi`) as tanggal_transaksi,film.nama_film FROM `film` LEFT JOIN transaksi ON transaksi.nama_film=film.nama_film WHERE film.nama_film='$k' AND `waktu_transaksi` BETWEEN film.awal_tayang AND film.akhir_tayang GROUP BY DATE(`waktu_transaksi`),film.nama_film");
	$jsonArrayFilm1=array();
		while($data_film1=mysqli_fetch_array($resultfilm1)){
			$jsonFilmisi = array();
			
			$jsonFilmisi['label'] = $data_film1['tanggal_transaksi'];
			$jsonFilmisi['value'] = $data_film1['total_penjualan'];
			
			array_push($jsonArrayFilm1,$jsonFilmisi);
		}
		$update_film = fopen('json/statistik_film_'.$j.'.json', 'w');
		fwrite($update_film,json_encode($jsonArrayFilm1));
		fclose($update_film);

	}
	header('Content-type:application/json');



	if ($input_transaksi) {
		
		header("location:tiket.php?".$kursi."nama_film=$nama_film&no_theater=$no_theater&jam_mulai=$jam_mulai&harga=$harga&tanggal=$tanggal");
	}
	else{
		echo "gagal";
	}
?>