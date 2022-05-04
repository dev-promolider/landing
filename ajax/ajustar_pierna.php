<?php
include "../config/conection.php";
$l = clear($l);

$pierna = pierna($_SESSION['nvirtual']);

if($l==1){
	mysqli_query($connection,"UPDATE datosdeusuarios SET pierna = '$l', pierna2 = '$l' WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	echo 1;
}elseif($l==2){
	mysqli_query($connection,"UPDATE datosdeusuarios SET pierna = '$l', pierna2 = '$l' WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	echo 2;
}else{
	echo $pierna;
}
?>