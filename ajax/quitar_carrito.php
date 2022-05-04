<?php
include "../config/conection.php";
$idp = clear($idp);
$s = mysqli_query($connection,"SELECT * FROM carrito WHERE producto = '$idp' AND nvirtual = '".$_SESSION['nvirtual']."'");
if(mysqli_num_rows($s)>0){
	$r = mysqli_fetch_array($s);
	$idcarrito = $r['id'];
	mysqli_query($connection,"DELETE FROM carrito WHERE id = '$idcarrito'");
}
?>