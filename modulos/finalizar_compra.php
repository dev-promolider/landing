<?php
require $_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/autoload.php';

//BitPay Setup code**********************************************************************

// See 002.php for explanation
$storageEngine = new \Bitpay\Storage\EncryptedFilesystemStorage('SITEnowA5720'); // Password may need to be updated if you changed it
$privateKey    = $storageEngine->load($_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/bitpay/php-client/examples/tmp/api.key');
$publicKey     = $storageEngine->load($_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/bitpay/php-client/examples/tmp/api.pub');
$client        = new \Bitpay\Client\Client();
//$network       = new \Bitpay\Network\Testnet();
$network       = new \Bitpay\Network\Livenet();
$adapter       = new \Bitpay\Client\Adapter\CurlAdapter();
$client->setPrivateKey($privateKey);
$client->setPublicKey($publicKey);
$client->setNetwork($network);
$client->setAdapter($adapter);
// ---------------------------

/**
 * The last object that must be injected is the token object.
 */
$token = new \Bitpay\Token();
$token->setToken('9UCGW93EsBpKxot5PQVqDmWWtHoijckqFrMp1tR5KH8U'); // UPDATE THIS VALUE

/**
 * Token object is injected into the client
 */
$client->setToken($token);

//End BitPay Setup code********************************************************************

$_SESSION['registrado']=0;
$s = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");

$su = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$ru = mysqli_fetch_array($su);


$tipo = $ru['calificacion'];

$sa = mysqli_query($connection,"SELECT * FROM afiliaciones WHERE id = '$tipo'");
$ra = mysqli_fetch_array($sa);
$descuento = "0.".$ra['descuento'];


if(!isset($paypal) && !isset($bitpay)){

?>
<table class="table table-striped">
<tr>
<th>Producto</th>
<th><center>Cantidad</center></th>
<th><center>Precio U.</center></th>
<th><center>Precio Total U.</center></th>
</tr>
<?php
}

$cont = 0;
$cantidad_descuento = 0;
while($r=mysqli_fetch_array($s)){
	$descuento_producto = "0";
	$sp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$r['producto']."'");
	$rp = mysqli_fetch_array($sp);

	

	$total = $rp['precio'] * $r['cantidad'];

	if($rp['descuento']==1 && esta_activo($_SESSION['nvirtual'])){
		$descuento_producto = $total * $descuento;
		$cantidad_descuento = $cantidad_descuento + ($total * $descuento);
	}else{
		$descuento_producto = "0";
	}

	$cont = $cont + $total;

	//creo que... esta aplicando descuento al contador y el contador no se trae el descuento... vamos a ver!!!
	
	
	$ivaxd = "0.".$rp['iva'];
	$iva = ($cont - $cantidad_descuento) * $ivaxd;
	if(!isset($paypal) && !isset($bitpay)){
	?>
	<tr>
		<td><?=$rp['producto']?></td>
		<td><center><?=$r['cantidad']?></center></td>
		<td><center><?=numero($rp['precio'])?> <?=$rp['simbolo_moneda']?></center></td>
		<td><center><?=numero($total)?> <?=$rp['simbolo_moneda']?></center></td>
	</tr>
	<?php
	}
}

$ptotal = $cont - $cantidad_descuento;
$pptotal = $ptotal + $iva;
if(!isset($paypal) && !isset($bitpay)){
?>
<tr>
<th></th>
<th></th>
<th></th>
<th style="background:black;color:white;"><center><b>Sub-Total</b></center></th>
</tr>
<tr>
<th></th>
<th></th>
<th></th>
<th><center>$ <?=numero($cont)?> </center></th>
</tr>

<tr>
<th></th>
<th></th>
<th></th>
<th  style="background:black;color:white;"><center><b>Total con descuento</b></center></th>
</tr>

<tr>
<th></th>
<th></th>
<th></th>
<th><center>$ <?=numero($ptotal)?></center></th>
</tr>


<tr>
<th></th>
<th></th>
<th></th>
<th style="background:black;color:white;"><center><b>IVA</b></center></th>
</tr>

<tr>
<th></th>
<th></th>
<th></th>
<th><center>$ <?=numero($iva)?></center></th>
</tr>

<tr>
<th></th>
<th></th>
<th></th>
<th style="background:black;color:white;"><center><b>Total con IVA</b></center></th>
</tr>

<?php
}
$tiva = $iva + $ptotal;
if(!isset($paypal) && !isset($bitpay)){
?>

<tr>
<th></th>
<th></th>
<th></th>
<th><center>$ <?=numero($tiva)?></center></th>
</tr>
</table>
<br>
<center style="display:flex; flex-wrap:wrap; justify-content:center;">

<a href="?p=finalizar_compra_depotra">
<buttom class="btn btn-success" style="flex:1; min-width:170px; max-width:170px; margin:10px;">
	<i class="fa fa-check fa-2x"></i><br>
	Realizar pago con <br>deposito o transferencia
</buttom>
</a>

&nbsp;
&nbsp;
&nbsp;

<?php
}
$sb = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$rb = mysqli_fetch_array($sb);

if($rb['cant']>=$tiva){
	if(!isset($paypal) && !isset($bitpay)){
?>
<a href="?p=finalizar_compra_billetera">
<buttom class="btn btn-success" style="flex:1; min-width:170px; max-width:170px; margin:10px;">
	<i class="fa fa-money fa-2x"></i><br>
	Realizar pago con <br>Billetera
</buttom>
</a>
<?php
}
}else{

	$sb = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	$rb = mysqli_fetch_array($sb);
	$billetera_disponible = $rb['cant'];
if(!isset($paypal) && !isset($bitpay)){
?>
<buttom class="btn btn-default" style="flex:1; min-width:170px; max-width:170px; margin:10px;" data-toggle="tooltip" data-placement="top" title="Disponible <?=$billetera_disponible?>$">
	<i class="fa fa-money fa-2x"></i><br>
	Realizar pago con <br>Billetera (Insuficiente)
</buttom>
<?php
}
}

if(!isset($paypal) && !isset($bitpay)){
?>

&nbsp;
&nbsp;
&nbsp;
<a href="?p=finalizar_compra&paypal=1">
<buttom class="btn btn-success" style="flex:1; min-width:170px; max-width:170px; margin:10px;">
	<i class="fa fa-dollar fa-2x"></i><br>
	Realizar pago con <br>PayPal
</buttom>
</a>

<?php
}

if(!isset($paypal) && !isset($bitpay)){
?>

&nbsp;
&nbsp;
&nbsp;
<a href="?p=finalizar_compra&bitpay=1">
<buttom class="btn btn-success" style="flex:1; min-width:170px; max-width:170px; margin:10px;">
	<i class="fa fa-dollar fa-2x"></i><br>
	Realizar pago con <br>BitPay
</buttom>
</a>



<?php
}

/* ------------------------------- Culqi Payment Integration ----------------------------  */
if(!isset($paypal) && !isset($bitpay)){
?>
	
	&nbsp;
	&nbsp;
	&nbsp;
	
	<a href="#">
		<buttom id="buyButton" class="btn btn-success" style="margin-top:10px; min-width:170px; max-width:170px;">
			<i class="fa fa-credit-card fa-2x"></i><br>
			Realizar pago con <br>tarjeta de crédito/débito
		</buttom>
	</a>
	<!-- Conversion de divisas -->
	<?php
		//API de conversión de divisas
		//Hace la conversión en tiempo real de $ a S/.
		function convertirDolaresASoles($monto){
			$id='420ec0881aac4b209c261c4e1269516c';
			$raiz = 'https://openexchangerates.org/api/latest.json?app_id=';
			$solicitud = $raiz.$id;
			$respuesta = file_get_contents($solicitud);
			$respuesta_json = json_decode($respuesta, true);
			$valor_en_soles = $respuesta_json['rates']['PEN'];
			
			$monto = intval($monto);
			$monto *= $valor_en_soles;
			$monto_redondeado = round($monto, 2);

			$monto_convertido = strval($monto_redondeado);
			//Devuelve un string
			return $monto_convertido;
		}
		$tiva_en_soles = ceil(convertirDolaresASoles($tiva));
		
	?>
	<?php
		//Obtener lista de productos
		$products = array();
		$s = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
		$i=0;
		while($r=mysqli_fetch_array($s)){
			$sp = mysqli_query($connection,"SELECT * FROM productos WHERE id = '".$r['producto']."'");
			$rp = mysqli_fetch_array($sp);
			$producto = $rp['producto'];
			$cantidad = $r['cantidad'];
			$products[] = array("producto"=>$producto,"cantidad"=>$cantidad);
			$i++;
		}
		$data = json_encode($products);//al hacer encoding, se vuelve string
		// $data = $products;
 		// echo var_dump($data);
	?>
	<!-- Culqi Payment Script -->
	<script src="https://checkout.culqi.com/js/v3"></script>
	<script>

		var descripcion=<?php echo $data; ?>;
		
		//Formateo de listado de productos, y sus cantidades
		var stringX = "";
		var cant = Object.keys(descripcion).length;
		var aux = 0;
        for(let i in descripcion){
			aux++;
			for (let j in i) {
				if(cant>1 && aux!=cant){
					stringX=stringX.concat(descripcion[i]["producto"], " : ", descripcion[i]["cantidad"], ", ");
				} else{
					stringX=stringX.concat(descripcion[i]["producto"], " : ", descripcion[i]["cantidad"]);
				}
			}
		}
	    
	
		cant = 0;
		stringX = $.trim(stringX);
		/****************************************************************/
		//Llave pública de la cuenta del destinatario
		Culqi.publicKey = 'pk_test_c38e6c7dde5f4b75';
		
		
		precio = '<?php echo ($tiva_en_soles*100)?>';
		preciodolar = '<?php echo ($monto*100)?>';

		//Capturar el evento click del boton Pagar
		$('#buyButton').on('click', function(e) {
			//Enviar a Culqi la información sobre el pago
			Culqi.settings({
				title: 'Compra Promolide',
				currency: 'PEN',
				description: stringX,
				amount: precio
			});

			// Abre el formulario de pago
			Culqi.open();
			e.preventDefault();
		});

		function culqi() {
			//Evalua si los datos ingresados son correctos y se crea un objeto TOKEN con éxito
			if (Culqi.token) { 
				var token = Culqi.token.id;
				var email = Culqi.token.email;

				//En esta linea de codigo debemos enviar el "Culqi.token.id"
				//hacia tu servidor con Ajax
				
				$.ajax({
					type: "POST",
					url: "<?php echo 'finalizar_compra_culqi.php'?>",
					data: {
						email: email,
						token: token,
						precio: precio,
						descripcion: stringX
					},
					dataType:'json',
					// contentType: "application/json; charset=utf-8",
					success: function(data){
					    data = JSON.parse(JSON.stringify(data));
					   // console.log(data);
					    var response = "Ha ocurrido un error en la transacción. Revise sus datos o intente con con otra tarjeta.";
					    if(data.capture==true){
					        response = "Su transacción se ha realizado con éxito.";
                			setTimeout(function () {
                			    window.location.href = "login.php";
                			}, 2000);
                        }
                        alert(response);
					},
					error: function(error) {
						console.log(error.responseText); 
					}
				});
			}
			// ¡Hubo algún problema!
			else { 
				// Mostramos JSON de objeto error en consola
				console.log(Culqi.error);
				alert(Culqi.error.user_message);
			}
		};

		/****************************************************************/
	</script>


	</center>
	<?php
}
/* ------------------------------- // End Culqi Payment Integration ----------------------------  */

if(isset($paypal) && $paypal==1){

$p 				= new paypal_class(); // paypal class
$p->admin_mail 	= 'promoliderpagos@gmail.com'; // set notification email

$invoice = date("His").rand(1234, 9632);
$product_id = rand(1111, 99999);
	mysqli_query($connection,"INSERT INTO `purchases` (`invoice`, `product_id`, `product_name`, `product_quantity`, `product_amount`, `payer_fname`, `payer_lname`, `payer_address`, `payer_city`, `payer_state`, `payer_zip`, `payer_country`, `payer_email`, `payment_status`, `posted_date`) VALUES ('".$invoice."', '".$product_id."', 'Compra Promolider', '1', '$tiva', '".$_SESSION["nvirtual"]."', '".$_SESSION["nvirtual"]."', '', '', '', '', '', '', '', NOW())");
		$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		$p->add_field('business', 'promoliderpagos@gmail.com'); // Call the facilitator eaccount
		$p->add_field('cmd', '_cart'); // cmd should be _cart for cart checkout
		$p->add_field('upload', '1');
		$p->add_field('return', ''); // return URL after the transaction got over
		$p->add_field('cancel_return', ''); // cancel URL if the trasaction was cancelled during half of the transaction
		$p->add_field('notify_url', ''); // Notify URL which received IPN (Instant Payment Notification)
		$p->add_field('currency_code', 'USD');
		$p->add_field('invoice', $invoice);
		$p->add_field('item_name_1', 'Compra en Promolider org');
		$p->add_field('item_number_1', 1);
		$p->add_field('quantity_1', 1);
		$p->add_field('amount_1', $tiva);
		$p->add_field('first_name', nombre_usuario($_SESSION['nvirtual']));
		$p->add_field('last_name', apellido_usuario($_SESSION['nvirtual']));
		$p->add_field('address1', '');
		$p->add_field('city', '');
		$p->add_field('state', '');
		$p->add_field('country', '');
		$p->add_field('zip', '');
		$p->add_field('email', correo($_SESSION['nvirtual']));
		$p->submit_paypal_post();
		//$p->dump_fields();

	mysqli_query($connection,"INSERT INTO compra_espera (nvirtual,fecha,monto) VALUES ('".$_SESSION['nvirtual']."',NOW(),'$tiva')");
	$s = mysqli_query($connection,"SELECT * FROM compra_espera WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY id DESC LIMIT 1");
	$r = mysqli_fetch_array($s);
	$id_compra = $r['id'];
	
	$sc = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	while($rc=mysqli_fetch_array($sc)){
		mysqli_query($connection,"INSERT INTO productos_compra_espera (id_compra_espera,producto,cantidad) VALUES ('$id_compra','".$rc['producto']."','".$rc['cantidad']."')");
	}

	mysqli_query($connection,"INSERT INTO pago_compra_espera (id_compra_espera,banco,tipo,documento,fecha) VALUES ('$id_compra','','PayPal','',NOW())");

	mysqli_query($connection,"DELETE FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	
	$action = "ipn";
	
	$trasaction_id  = $_POST["txn_id"];
		$payment_status = strtolower($_POST["payment_status"]);
		$invoice		= $invoice;
		$log_array		= print_r($_POST, TRUE);
		$log_query		= "SELECT * FROM `paypal_log` WHERE `txn_id` = '$trasaction_id'";
		$log_check 		= mysqli_query($log_query);
		if(mysqli_num_rows($log_check) <= 0){
			mysqli_query($connection,"INSERT INTO `paypal_log` (`txn_id`, `log`, `posted_date`) VALUES ('$trasaction_id', '$log_array', NOW())");
		}else{
			mysqli_query($connection,"UPDATE `paypal_log` SET `log` = '$log_array' WHERE `txn_id` = '$trasaction_id'");
		} // Save and update the logs array
		$paypal_log_fetch 	= mysqli_fetch_array(mysqli_query($log_query));
		$paypal_log_id		= $paypal_log_fetch["id"];
		if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic
			mysqli_query($connection,"UPDATE `purchases` SET `trasaction_id` = '$trasaction_id ', `log_id` = '$paypal_log_id', `payment_status` = '$payment_status' WHERE `invoice` = '$invoice'");
			$subject = 'Instant Payment Notification - Recieved Payment';
			$p->send_report($subject); // Send the notification about the transaction
		}else{
			$subject = 'Instant Payment Notification - Payment Fail';
			$p->send_report($subject); // failed notification
		}

	notificar("administrador","Compra Paypal","Hay una compra paypal en espera por verificar.");
	

} elseif(isset($bitpay) && $bitpay==1){ //******************Start BitPay Integration***********************************************
//Creating invoice BitPay 
                $invoice = new \Bitpay\Invoice();
                $buyer = new \Bitpay\Buyer();
                $buyer->setEmail('buyer@correo.com');
                $invoice->setBuyer($buyer);
	
	//Configure item 
                $item = new \Bitpay\Item();
                $item->setCode(rand(1111, 99999));
                $item->setDescription('Pago de producto');
                $item->setPrice($tiva);
                // Configure the rest of the invoice
                $invoice->setItem($item);
                $invoice->setNotificationEmail('promoliderpagos@gmail.com');
                $invoice->setNotificationUrl('https://www.promolider.org/sistema/bitpay_config/vendor/bitpay/php-client/examples/tutorial/IPNlogger.php');
                $invoice->setRedirectUrl('https://www.promolider.org/sistema/login.php?p=tienda');
                $invoice->setCurrency(new \Bitpay\Currency('USD'));
                $invoice->setOrderId(rand(123, 963));
                
                //Try creation of invoice
                try {
                    $client->createInvoice($invoice);
                } catch (\Exception $e) {
                    echo "Exception occured: " . $e->getMessage().PHP_EOL;
                    $request  = $client->getRequest();
                    $response = $client->getResponse();
                    echo (string) $request.PHP_EOL.PHP_EOL.PHP_EOL;
                    echo (string) $response.PHP_EOL.PHP_EOL;
                    exit(1); // We do not want to continue if something went wrong
                }
                
    // Guardar compra
	mysqli_query($connection,"INSERT INTO compra_espera (nvirtual,fecha,monto) VALUES ('".$_SESSION['nvirtual']."',NOW(),'$tiva')");
	$s = mysqli_query($connection,"SELECT * FROM compra_espera WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY id DESC LIMIT 1");
	$r = mysqli_fetch_array($s);
	$id_compra = $r['id'];

	$sc = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	while($rc=mysqli_fetch_array($sc)){
		mysqli_query($connection,"INSERT INTO productos_compra_espera (id_compra_espera,producto,cantidad) VALUES ('$id_compra','".$rc['producto']."','".$rc['cantidad']."')");
	}
    $banco=14;
	mysqli_query($connection,"INSERT INTO pago_compra_espera (id_compra_espera,banco,tipo,documento,fecha) VALUES ('$id_compra','$banco','BitPay','',NOW())");

	// vaciar carrito
	mysqli_query($connection,"DELETE FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	
	//notificar al admin
	notificar("administrador","Compra BitPay","Hay una compra BitPay en espera por verificar.");
	//Redireccionar para que se realice el pago
    redir(strval($invoice->getUrl()));   
 //******************End BitPay Integration******************************************************************************
}
	

?>