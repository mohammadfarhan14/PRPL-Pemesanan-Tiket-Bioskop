<!DOCTYPE html>
<html>
<head>
<script>
function myFunction() {
	var count=0;
    document.getElementById("myText").value = "Johnny Bravo"+count;
}

function myFunction2() {
    document.getElementById("myText").value = "Johnny Bravo2";
}
</script>

</head>
<body>
<?php $ph1="notlikethis" ;

$char=50;
$result=$char/5;
echo$result;?>

Name: <input type="text" id="myText" value="<?php echo $ph1 ?>" >
?>

<div id="myText2">Click the button to change the value of the text field.</div>

<button onclick="myFunction(this)">Try it</button>
<button onclick="myFunction2()">Try it</button>
<?php 
for($char="A";$char<="E";$char++){
for($numb=1;$numb<=$result;$numb++)
	{
	echo $numb.$char." ";
}
}

?>
<script type="text/javascript">
	alert("test");
</script>
</body>
</html>
