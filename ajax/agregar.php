<?php
include "../config/conection.php";
$idp = clear($idp);
$cant = clear($cant);

$sc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$rc = mysqli_fetch_array($sc);

if($idp==5){
	$cant=1;
	if($rc['calificacion']>=2){
		alert("No puedes comprar este producto");
		die();
	}
	$cant=1;
}

if($idp==6){
	if($rc['calificacion']>=3){
		alert("No puedes comprar este producto");
		die();
	}
	$cant=1;
}

if($idp==7){
	if($rc['calificacion']>=4){
		alert("No puedes comprar este producto");
		die();
	}
	$cant=1;
}
if($idp==4){
	$cant=1;
}

if($idp>=5 && $idp<=7){

	$srr2 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 4");
	if(mysqli_num_rows($srr2)>0){
		alert("No puedes colocar una membresia Safip junto a una recompra.");
		die();
	}

	$sc1 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 5");
	$sc2 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 6");
	$sc3 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 7");

	if(mysqli_num_rows($sc1)>0 || mysqli_num_rows($sc2)>0 || mysqli_num_rows($sc3)>0){
		alert("Ya tienes una membresia Safip incluida en el carrito, borra la que tienes primero");
		die();
	}
}

if($idp==4){
	$srr = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 4");
	if(mysqli_num_rows($srr)>0){
		alert("Ya tienes una recompra agregada al carrito");
		die();
	}

	$sc4 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 5");
	$sc5 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 6");
	$sc6 = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = 7");

	if(mysqli_num_rows($sc4)>0 || mysqli_num_rows($sc5)>0 || mysqli_num_rows($sc6)>0){
		alert("No puedes colocar una recompra en el carrito junto a una membresia Safip");
		die();
	}
}

$s = mysqli_query($connection,"SELECT * FROM productos WHERE id = '$idp'");

$su = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$ru = mysqli_fetch_array($su);
$patrocinador = $ru['patrocinador'];


if(mysqli_num_rows($s)>0){
	$sec = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = '$idp'");
	if(mysqli_num_rows($sec)<1){
		
		$q = mysqli_query($connection,"INSERT INTO carrito (nvirtual,patrocinador,producto,fecha,cantidad) VALUES ('".$_SESSION['nvirtual']."','$patrocinador','$idp',NOW(),'$cant')");
	}else{
		
		$q = mysqli_query($connection,"UPDATE carrito SET cantidad = cantidad + '$cant', fecha = NOW() WHERE nvirtual = '".$_SESSION['nvirtual']."' AND producto = '$idp'");
	}
}

if(!$q){
	alert(mysqli_error());
}

?>