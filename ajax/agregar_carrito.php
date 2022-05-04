<?php
include "../config/conection.php";
$idp = clear($idp);

if($idp!=4 && $idp!=5 && $idp!=6 && $idp!=7){
	$s = mysqli_query($connection,"SELECT * FROM carrito WHERE producto = '$idp' AND nvirtual = '".$_SESSION['nvirtual']."'");
	if(mysqli_num_rows($s)>0){
		$r = mysqli_fetch_array($s);
		mysqli_query($connection,"UPDATE carrito SET cantidad = cantidad + 1 WHERE id = '".$r['id']."'");
	}
}
?>