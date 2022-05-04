<?php
include "../config/conection.php";
$idp = clear($idp);
echo $afp;
$s = mysqli_query($connection,"SELECT * FROM carrito WHERE producto = '$idp' AND nvirtual = '".$_SESSION['nvirtual']."'");
if(mysqli_num_rows($s)>0){
	$r = mysqli_fetch_array($s);
	if($r['cantidad']>1){
		mysqli_query($connection,"UPDATE carrito SET cantidad = cantidad - 1 WHERE id = '".$r['id']."'");
	}else{
		mysqli_query($connection,"DELETE FROM carrito WHERE id = '".$r['id']."'");
	}
}
?>