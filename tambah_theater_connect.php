<?php

require 'connect.php';

$no_theater	= $_POST['no_theater'];
$nama_theater = $_POST['nama_theater'];
$kapasitas 	= $_POST ['kapasitas'];
$totalKursi = $kapasitas/5;


if(isset($kapasitas) and (strlen($nama_theater)>0)){
	$errorStatus =1;
}else{
	$errorStatus =0;
	$_SESSION['errMsg'] = "Jumlah kapasitas belum dipilih atau nama theater masih kosong";
}

if($errorStatus==1){
	$insert_theater=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO theater (nama_theater,kapasitas) VALUES ('$nama_theater','$kapasitas')");
	for($row="A";$row<="E";$row++){
		for($kursi=1;$kursi<=$totalKursi;$kursi++){
			$no_kursi = $kursi.$row;
			$insert_kursi=mysqli_query($GLOBALS["___mysqli_ston"], "INSERT INTO kursi (no_theater,no_kursi) VALUES ('$no_theater','$no_kursi')");
		}
	}
}

if(isset($insert_kursi)){
	//$pesan ="Penambahan Theater telah berhasil!!";
	//echo "<script> alert('$pesan');
	$_SESSION['status'] = 1;
	header('location:tambah_theater.php#open-modal');
}else{
	$_SESSION['status'] = 0;
	header('location:tambah_theater.php#open-modal');
}
?>