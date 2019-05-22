<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/tiket.css">
	<?php require 'connect.php';
	date_default_timezone_set('Asia/Jakarta');
	$nama_film	= $_GET['nama_film'];
	$jam_mulai	= $_GET['jam_mulai'];
	$no_kursi	= $_GET['no'];
	$no_theater = $_GET['no_theater'];
	$harga		= $_GET['harga'];
	$waktu		= $_GET['tanggal'];
	$tanggalwaktu = new DateTime($waktu);
	
	$tanggal 	= $tanggalwaktu->format('d-M-Y');
	$tanggal1    =$tanggalwaktu->format('Y-m-d');
//	$jam	 	= $tanggalwaktu->format('H:i');

	for($i=0;$i<sizeof($no_kursi);$i++){
		if (strlen($no_kursi[$i])==2){
			$seat_kursi[$i]	= substr($no_kursi[$i],0,1);
			$row_kursi[$i] 	= substr($no_kursi[$i],1);
		}else{
			$seat_kursi[$i]	= substr($no_kursi[$i],0,2);
			$row_kursi[$i]	= substr($no_kursi[$i], 2);
		}
	}

	for($i=0;$i<sizeof($no_kursi);$i++){
		 
	$result= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT id_transaksi FROM transaksi where nama_film='$nama_film' AND jam_mulai='$jam_mulai' AND no_kursi='$no_kursi[$i]' AND no_theater='$no_theater' AND waktu_transaksi LIKE '$waktu%'");
		while($data=mysqli_fetch_array($result)){
			$id_transaksi[$i]=$data['id_transaksi'];
		}
	}
//	echo $tanggal;
//	echo $jam;
	?>
</head>
<body><?php for ($i=0;$i<sizeof($no_kursi);$i++){?>
	<table  style="border-bottom:2px dashed black">
		<tbody>
			<tr  style="border-bottom:2px solid black">
				<td valign="bottom" class="tiket-bag1" style="border-bottom:2px solid black">NLT</td>
				<td colspan="4"  class="tiket-title">NOTLIKETHIS</td>
			</tr>
			<tr>
				<td valign="top" class="tiket-bag1"><?php echo $nama_film?></td>
				<td colspan="3" class="tiket-isi"><?php echo $nama_film?></td>
				<td rowspan="2" style="font-size: 60px; font-weight: bold;text-align: right;"><?php echo $no_theater?></td>
			</tr>
			<tr>
				<td class="tiket-bag1"><?php echo $tanggal ?></td>
				<td>Date</td>
				<td> : </td>
				<td class="tiket-isi"><?php echo $tanggal ?></td>
			</tr>
			<tr>
				<td class="tiket-bag1"><?php echo $jam_mulai?></td>
				<td>Time </td>
				<td> : </td>
				<td class="tiket-isi"><?php echo $jam_mulai ?></td>
				<td rowspan="5" valign="bottom"><img src='https://api.qrserver.com/v1/create-qr-code/?data=http%3A%2F%2Flocalhost%2Fmybioskop%2Ftiket.php%3Fno%255B%255D%3D<?php echo $no_kursi[$i] ?>%26nama_film%3D<?php echo $nama_film ?>%26no_theater%3D<?php echo $no_theater ?>%26jam_mulai%3D<?php echo $jam_mulai?>%26harga%3D<?php echo $harga ?>%26tanggal%3D<?php echo $waktu ?>&size=100x100'></td>
			</tr>
			<tr>
				<td class="tiket-bag1">Row <?php echo $row_kursi[$i]?> Seat <?php echo $seat_kursi[$i]?></td>
				<td>Row </td>
				<td> : </td>
				<td><span class="tiket-isi"><?php echo $row_kursi[$i]?></span> &nbsp;&nbsp;&nbsp;&nbsp;
					Seat : <span class="tiket-isi"><?php echo $seat_kursi[$i]?></span></td>
			</tr>
			<tr>
				<td class="tiket-bag1">Theater <?php echo $no_theater ?></td>
			</tr>
			<tr >
				<td class="tiket-bag1">Rp<?php echo $harga ?></td>
				<td>Price </td>
				<td>:</td>
				<td class="tiket-isi">Rp <?php echo $harga ?></td>
			</tr>
			<tr>
				<td class="tiket-bag1">Tx ID #<?php echo $id_transaksi[$i] ?></td>
				<td class="tiket-isi">#<?php echo $id_transaksi[$i]; ?></td>

			</tr>
		</tbody>
	</table>
	<?php }?>
		<a href="index.php">HomePage</a>
		<form method="POST">
		<input type="date" name="date">
		<button>submit</button>
		</form>
		<?php 
		$date=@$_POST['date'];
		echo "$date";
		?>
		<!--session_start();
if(isset($_SESSION['view']))
{
 $_SESSION['view']=$_SESSION['view']+1;
}
else
{
 $_SESSION['view']=1;
}-->
</body>
</html>