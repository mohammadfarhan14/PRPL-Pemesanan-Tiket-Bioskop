<div style="display:none">
<?php
	session_start();
	($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root"));
	mysqli_select_db($GLOBALS["___mysqli_ston"], mybioskop);
?>
</div>