<?php
require $_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/autoload.php';

//BitPay Setup code**********************************************************************

// See 002.php for explanation
$storageEngine = new \Bitpay\Storage\EncryptedFilesystemStorage('SITEnowA5720'); // Password may need to be updated if you changed it
$privateKey    = $storageEngine->load($_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/bitpay/php-client/examples/tmp/api.key');
$publicKey     = $storageEngine->load($_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/bitpay/php-client/examples/tmp/api.pub');
$client        = new \Bitpay\Client\Client();
$network       = new \Bitpay\Network\Testnet();
//$network       = new \Bitpay\Network\Livenet();
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
$token->setToken('FurmKKpiegDjFUWSqfLpN5uPToLj4QfasKokC4oUcvn6'); // UPDATE THIS VALUE

/**
 * Token object is injected into the client
 */
$client->setToken($token);

//End BitPay Setup code********************************************************************

$s = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);

if(isset($enviar)){
	$cant = clear($cant);
	if($cant>$r['cant']){
		alert("No tienes fondos suficientes.");
		redir("");
	}

	notificar("administrador","Solicitud de Fondos","El usuario ".nombre_apellido_usuario($_SESSION['nvirtual'])." Ha solicitado fondos.");
	mysqli_query($connection,"INSERT INTO peticiones (nvirtual,cant,fecha,estado) VALUES ('".$_SESSION['nvirtual']."','$cant',NOW(),0)");
}

if(isset($enviar_translado)){

	$cant = clear($cant);
	$directo = clear($directo);

	$scd = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE patrocinador = '".$_SESSION['nvirtual']."' AND nvirtual = '$directo'");
	if(mysqli_num_rows($scd)<1){
		alert("Ha ocurrido un error.");
		redir("");
	}

	$scb = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	$rcb = mysqli_fetch_array($scb);

	if($cant>$rcb['cant']){
		alert("No tienes fondos suficientes.");
		redir("");
	}

	log_billetera($_SESSION['nvirtual'],$cant,"Translado de fondos a ".nombre_apellido_usuario($directo),0);
	log_billetera($directo,$cant,"Translado de fondos recibido de ".nombre_apellido_usuario($_SESSION['nvirtual']),1);

	//$q = mysqli_query($connection,"INSERT INTO translado_pendiente (nvirtual_envia,nvirtual_recibe,cant,fecha,estado) VALUES ('".$_SESSION['nvirtual']."','$directo','$cant',NOW(),0)");
	
	mysqli_query($connection,"UPDATE billetera SET cant = cant + $cant WHERE nvirtual = '$directo'");
	mysqli_query($connection,"UPDATE billetera SET cant = cant - $cant WHERE nvirtual = '".$_SESSION['nvirtual']."'");

	
	alert("Translado realizado satisfactoriamente");
	redir("");
}

if(isset($recargar)){
	$banco = clear($banco);
	$tipo_pago = clear($tipo_pago);
	$numero_proceso = clear($numero_proceso);
	$monto = clear($monto);

	mysqli_query($connection,"INSERT INTO recargas (nvirtual,banco,tipo,numero_proceso,fecha,estado,monto) VALUES ('".$_SESSION['nvirtual']."','$banco','$tipo_pago','$numero_proceso',NOW(),0,'$monto')");
	

	if($banco==0){

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
			$p->add_field('item_name_1', 'Recarga de Fondos Promolider');
			$p->add_field('item_number_1', 1);
			$p->add_field('quantity_1', 1);
			$p->add_field('amount_1', $monto);
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

			alert("Recarga en proceso, espera a que sea revisada por el administrador.");
			redir("");
			die();
		} elseif ($banco==15) {
			/*------------------ Conversion de divisas ----------------*/
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
			// ceil();
			$monto_en_soles = convertirDolaresASoles($monto);
			/*------------------ Conversion de divisas ----------------*/
			/*------------------------  Culqi Payment Integration --------------------------*/
			?>
			<script src="https://checkout.culqi.com/js/v3"></script>
			<script>
				var montoFinal = '<?=($monto_en_soles*100)?>';
				C_CULQI(montoFinal);
					
				function getFinalAmount() {
					return montoFinal;
				};
				
				function C_CULQI(monto) {
            		Culqi.publicKey = 'pk_test_c38e6c7dde5f4b75';
            		Culqi.settings({
            			title: 'Compra Promolider',
            			currency: 'PEN',
            			description: 'Recarga de Fondos',
            			amount: monto
            		});
					Culqi.open();
				};
				/*------------------------ //End Culqi Payment Integration --------------------------*/
			</script>

			<?php
		}
		elseif ($banco==14) {
		    //******************Start BitPay Integration****************************
            //Creating invoice BitPay 
                $invoice = new \Bitpay\Invoice();
                $buyer = new \Bitpay\Buyer();
                $buyer->setEmail('buyer@correo.com');
                $invoice->setBuyer($buyer);
	
	        //Configure item 
                $item = new \Bitpay\Item();
                $item->setCode(rand(1111, 99999));
                $item->setDescription('Recarga de billetera');
                $item->setPrice($monto);
                // Configure the rest of the invoice
                $invoice->setItem($item);
                $invoice->setNotificationEmail('promoliderpagos@gmail.com');
                $invoice->setNotificationUrl('https://www.promolider.org/sistema/bitpay_config/vendor/bitpay/php-client/examples/tutorial/IPNlogger.php');
                $invoice->setRedirectUrl('https://www.promolider.org/sistema/login.php?p=billetera');
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
	         //Redireccionar para que se realice el pago
            redir(strval($invoice->getUrl()));   
             //******************End BitPay Integration****************************
		}
}
?>

<div class="box box-solid box-primary">
<div class="box-header" style="background:#1e1c16;">
	<h3> &nbsp; <b>$</b> Cantidad disponible en billetera</h3>
</div>
<div class="box-body">
<h1>
<?=numero($r['cant'])?>$</h1>
</h1>
</div>
</div>
<br>

<button data-toggle="modal" data-target="#compose-modal" onclick="solicitud();" class="btn btn-success">Solicitud de Fondos</button>
<button data-toggle="modal" data-target="#compose-modal" onclick="translado();" class="btn btn-success">Transladar Fondos</button>
<button data-toggle="modal" data-target="#compose-modal" onclick="recargar_fondos();" class="btn btn-success">Recargar Fondos</button>
<!-- <button data-toggle="modal" data-target="#compose-modal" onclick="comprar_directo();" class="btn btn-success">Comprale a Tus Directos</button>!-->
<hr>

<h3 style="background: white !important;"><i class="fa fa-clock-o"></i> Historial</h3>
<hr>
<table class="table table-striped">
<tr>
<th>Monto</th>
<th>Tipo</th>
<th>Fecha</th>
<th>Razon</th>
</tr>
<?php
$sh = mysqli_query($connection,"SELECT * FROM log_billetera WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY id DESC");
while($rh=mysqli_fetch_array($sh)){
	if($rh['tipo']==0){
		$tipo ="<span style=color:red>Debito</span>";
	}else{
		$tipo = "<span style=color:green>Credito</span>";
	}
	?>
	<tr>
		<th>$ <?=numero($rh['monto'])?> </th>
		<th><?=$tipo?></th>
		<th><?=fecha($rh['fecha'])?></th>
		<th><?=$rh['razon']?></th>
	</tr>
	<?php
}
?>
</table>