<?php

// require_once "config/conection.php";
// Incluir librerias Requests y CulqiPHP
require_once '../libraries/Requests/library/Requests.php';
Requests::register_autoloader();
require_once '../libraries/culqi-php/lib/culqi.php';

//Guarda los datos enviados en la DB
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$email = $_POST['email'];
$token = $_POST['token'];

try {
	//Crear el cargo(para crear un cargo se necesita el token de autorización)
	$SECRET_KEY = "sk_live_fddfcb5d2c8ddbb0";
	$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));
	$charge = $culqi->Charges->create(
	array(
		"amount" => (INT)$precio,
		"capture" => true,
		"currency_code" => "PEN",
		"description" => $descripcion,
		"installments" => 0,
		"email" => $email,
		"source_id" => $token,
	));
    $data = json_encode($charge);
    echo $data;
    // $data = json_decode($data, true);
	$id_compra = $data['reference_code'];
	$banco = $data['source']['iin']['issuer']['name'];

	//Formateo del precio de formato Culqi a formato normal
	$precio/=100;

	// Guardar compra
	// mysqli_query($connection,"INSERT INTO compra_espera (nvirtual,fecha,monto) VALUES ('".$_SESSION['nvirtual']."',NOW(),'$precio')");
	// $s = mysqli_query($connection,"SELECT * FROM compra_espera WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY id DESC LIMIT 1");
	// $r = mysqli_fetch_array($s);
	// $id_compra = $r['id'];

	// $sc = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	// while($rc=mysqli_fetch_array($sc)){
	// 	mysqli_query($connection,"INSERT INTO productos_compra_espera (id_compra_espera,producto,cantidad) VALUES ('$id_compra','".$rc['producto']."','".$rc['cantidad']."')");
	// }

 	// mysqli_query($connection,"INSERT INTO pago_compra_espera (id_compra_espera,banco,tipo,documento,fecha) VALUES ('$id_compra','$banco','Culqi','',NOW())");

	// vaciar carrito
	// mysqli_query($connection,"DELETE FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	
	//notificar al admin
	// notificar("administrador","Compra Culqi","Hay una compra Culqi en espera por verificar.");
} catch (Exception $e) {
	echo json_encode($e->getMessage());
}
