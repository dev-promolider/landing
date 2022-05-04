<?php 

ini_set("display_errors",0);
require "../config/conection.php";
require $_SERVER['DOCUMENT_ROOT'].'/sistema/bitpay_config/vendor/autoload.php';
include "../paypal_class.php";


@session_start();


if(!isset($_GET['ref']) || $_GET['ref']==""){
    $ref = "administrador";
}


$ref = clear($_GET['ref']);

$sref2 = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$ref'");
$rref2 = mysqli_fetch_array($sref2);

if(mysqli_num_rows($sref2)<1){
    $ref = "administrador";
}

$sref = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$ref'");
$rref = mysqli_fetch_array($sref);

if(mysqli_num_rows($sref)<1){
    $rref['nvirtual'] = "administrador";
}

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

//////////////////////////////////////////////////////////////////////


?>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Promolider - Registro</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="../css/sahum.css" rel="stylesheet" type="text/css" />
        <link href="../css/v-payment.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="https://alignet-flex-demo.s3.amazonaws.com/css/flex-capture.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        
    </head>
<?php

if(isset($_POST['enviar'])){
    $nombre = clear($_POST['nombre']);
    $snombre = clear($_POST['snombre']);
    $apellido = clear($_POST['apellido']);
    $sapellido = clear($_POST['sapellido']);
    $identificacion = clear($_POST['identificacion']);
    $fecha_nace = clear($_POST['fecha_nace']);
    $tlf = clear($_POST['tlf']);
    $tlf_h = clear($_POST['tlf_h']);
    $pais = clear($_POST['pais']);
    $estado = clear($_POST['estado']);
    $cpostal = clear($_POST['cpostal']);
    $email = clear($_POST['email']);
    $usuario = clear($_POST['usuario']);
    $passw = clear($_POST['passw']);
    $cpassw = clear($_POST['cpassw']);
    $referrer = clear($_POST['referrer']);
    $twitter = clear($_POST['twitter']);
    $facebook = clear($_POST['facebook']);
    $skype = clear($_POST['skype']);
    $tipoc = clear($_POST['tipoc']);
    $paspas = $passw;
   

    $si = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE docidentidad = '$identificacion'");
    if(mysqli_num_rows($si)>0){
        alert("La identificación que introdujo ya esta en uso, vuelva a intentarlo.");
        redir("");
    }

    $hoy = date("Y-m-d");
    if($fecha_nace>$hoy){
        alert("Seleccione una fecha de nacimiento correcta.");
        redir("");
    }

    if($tipopago!="" && $numero_proceso != ""){
        $svp = mysqli_query($connection, "SELECT * FROM pagos WHERE tipodepago = '$tipopago' AND documento = '$numero_proceso'");
        if(mysqli_num_rows($svp)){
            alert("El número de registro ya existe, verifique el número de transacción");
            redir("");
        }
    }


    //$se=mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE correo = '$email'");
    //if(mysql_num_rows($se)>0){
        //alert("El email que introdujo ya esta en uso, porfavor use otro e intentelo de nuevo.");
        //redir("");
    //}

    $su = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$usuario'");
    if(mysqli_num_rows($su)>0){
        alert("El usuario que introdujo ya esta en uso, porfavor use otro e intentelo de nuevo.");
        redir("");
    }
    
    

    if($passw!=$cpassw){
        alert("Las contraseñas no coinciden, vuelva a intentarlo (".$passw." : ".$cpassw.")");
        redir("");
    }

    $spa = mysqli_query($connection, "SELECT * FROM paises WHERE id = '$pais'");
    $rpa = mysqli_fetch_array($spa);
    $ses = mysqli_query($connection, "SELECT * FROM estados WHERE id = '$estado'");
    $res = mysqli_fetch_array($ses);
    $sci = mysqli_query($connection, "SELECT * FROM province WHERE CapProv = '".$res['estado']."'");
    $rci = mysqli_fetch_array($sci);

    /*

    $spb = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE patrocinador = '$referrer' ORDER BY identificador DESC LIMIT 1");
    if(mysql_num_rows($spb)>0){
        $rpb = mysql_fetch_array($spb);
        $spb2 = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE patrocinador = '".$rpb['nvirtual']."'ORDER BY identificador DESC LIMIT 1");
            if(mysql_num_rows($spb2)>0){
                $rpb2 = mysql_fetch_array($spb2);
                $pbinario = $rpb2['nvirtual'];
            }
    }else{
        $tope = "";
        $referrer2 = $referrer;

        do{

            //chequear pierna izquierda o derecha la ultima que este afiliada que no sea de la rama es el tope,
            //EJ: Izq Izq Izq Izq Izq Derecha (Tope)
            $scuc = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '$referrer2'");
            $rcuc = mysql_fetch_array($scuc);
                if($rcuc['lado'] != $rref['pierna']){
                    $tope = $tope;
                }else{
                    $sas = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '$referrer2'");
                    $rar = mysql_fetch_array();
                    $referrer2 = "";
                }

        }while($tope!="");

        $pbinario = $referrer;
    }
    */

    //////////////////////////////////////////////////

    $ladopierna = $rref['pierna'];
    $patrocinador_prueba = $rref['nvirtual'];
    $tope = "";
    $sw = 0;
    do{
        
         $sasas = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$patrocinador_prueba'");
         $raras = mysqli_fetch_array($sasas);

         $ladopp = $raras['lado'];

         if($ladopp != $ladopierna){
            $sw=1;
            $tope = $raras['nvirtual'];
         }else{
            $sot = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '".$raras['patrocinador_binario']."'");
            $rot = mysqli_fetch_array($sot);

            $patrocinador_prueba = $rot['nvirtual'];
            $ladopp = $rot['lado'];

         }


    }while($sw!=1);
    

    $os=0;

    $pruebaprueba = $tope;

/*
    do{

        $sultb = mysqli_query($connection,"SELECT * FROM datosdeusuarios a, calificados b WHERE a.nvirtual = b.nvirtual AND a.patrocinador = '$pruebaprueba' AND b.lado = '".$rref['pierna']."' ORDER BY identificador DESC");
        $rultb = mysql_fetch_array($sultb);

        if(mysql_num_rows($sultb)==0){
            $pbinario = $pruebaprueba;
            $os=1;
        }else{
        $conti++;
        alert($conti.": ".$pruebaprueba);
            $sduu = mysqli_query($connection,"SELECT * FROM datosdeusuarios a, calificados b  WHERE a.nvirtual = b.nvirtual AND b.lado = '".$rref['pierna']."' AND a.patrocinador = '$pruebaprueba' ORDER BY identificador DESC");
            $rduu = mysql_fetch_array($sduu);
            $pruebaprueba = $rduu['nvirtual'];
        }

    }while($os != 1);
    
    */
    
    do{
    	$sultb = mysqli_query($connection, "SELECT * FROM datosdeusuarios a, calificados b WHERE a.nvirtual = b.nvirtual AND b.patrocinador_binario = '$pruebaprueba' AND b.lado = '".$rref['pierna']."'");
    	$rultb = mysqli_fetch_array($sultb);
    	if(mysqli_num_rows($sultb)==0){
    		$pbinario = $pruebaprueba;
    		$os = 1;
    	}else{
    		$pruebaprueba = $rultb['nvirtual']; 
    	}
    }while($os != 1);

/*

    $sultb = mysqli_query($connection,"SELECT * FROM datosdeusuarios a, calificados b WHERE a.nvirtual = b.nvirtual AND a.patrocinador = '$tope' AND b.lado = '".$rref['pierna']."' ORDER BY identificador DESC");
    $rultb = mysql_fetch_array($sultb);

    if(mysql_num_rows($sultb)>0){

        $sultb2 = mysqli_query($connection,"SELECT * FROM datosdeusuarios a, calificados b WHERE a.nvirtual = b.nvirtual AND a.patrocinador = '".$rultb['nvirtual']."' AND b.lado = '".$rref['pierna']."' ORDER BY identificador DESC");
        $rultb2 = mysql_fetch_array($sultb2);
        if(mysql_num_rows($sultb2)>0){
           

            $pbinario = $rultb2['nvirtual'];
        }else{
            $pbinario = $rultb['nvirtual'];
        }
    } else{
        $pbinario = $tope;
    }  

    */
    


    //////////////////////////////////////////////////



    $passwe = sha1(md5($passw));

    $renu = time();

    $lado = $rref['pierna'];

    if($lado==0){
        $lado=2;
    }


    $q = mysqli_query($connection, "INSERT INTO datosdeusuarios (docidentidad,ciudad,estado,pais,telefono,cpostal,correo,nvirtual,padre,patrocinador,patrocinador_binario,pierna,pierna2,activo,fecharegistro,autorizado,betado,clave,alternativo1,alternativo2,alternativo3,alternativo4,alternativo5,grupo,mensaje,porafiliacion,red,online,tipo,tipo_cliente,campo_primer_nombre,campo_primer_apellido,campo_segundo_nombre,campo_segundo_apellido,autorizado_old,fecha_registro_numerico,forzada_completada,pendiente_paypal) VALUES ('$identificacion','".$rci['Capital']."','".$res['estado']."','".$rpa['pais']."','$tlf','$cpostal','$email','$usuario','$referrer','$referrer','$pbinario',2,2,0,NOW(),1,0,'$passwe','$skype','$twitter','$facebook','$fecha_nace','$tlf_h','','Mensaje del usuario para los visitantes',0,0,0,0,0,'$nombre','$apellido','$snombre','$sapellido',1,'$renu',0,0)");

    if(!$q){
        alert(mysqli_error());
        redir("./");
        die();
    }

    if($tipoc > 1){

        //echo 'kkkkkkkkkk'; exit();
        $banco = clear($banco);
        
        if(isset($tipo_pago)){
            $tipo_pago = clear($tipo_pago);
        }else{
            $tipo_pago = "";
        }

        if(isset($numero_proceso)){
            $numero_proceso = clear($numero_proceso);
        }else{
            $numero_proceso = "";
        }

        $sm = mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = '$tipoc'");
        $rm = mysqli_fetch_array($sm);

        $monto = $rm['precio'];
        $ivaxd = "0.".$rm['iva'];

        $montototalxd = ($monto * $ivaxd) + $monto;


        if($tipo_pago==1){
            $tipopago= "Transferencia";
        }elseif($tipo_pago==2){
            $tipopago= "Deposito";
        }else{
            $tipopago = "Pago en linea";
        }

        $slb = mysqli_query($connection, "SELECT * FROM bancos WHERE id = '$banco'");
        $rlb = mysqli_fetch_array($slb);

        

        if($banco==0){
            $nbanco = "PayPal";
        }else{
            $nbanco = $rlb['banco'];
        }

        
        notificar("administrador","RegistroPendiente","Hay una nueva Afiliacion pendiente por revisar, USUARIO: ".$usuario);

        mysqli_query($connection, "INSERT INTO pagos (nvirtual,patrocinador,descripcion,monto,documento,tipodepago,fechacompra,banco,autorizado,historico) VALUES ('$usuario','$referrer','Afiliación','$montototalxd','$numero_proceso','$tipopago',NOW(),'$nbanco',0,0)");

        mysqli_query($connection, "INSERT INTO por_afiliar (nvirtual,tipo,fecha,pierna) VALUES ('$usuario','$tipoc',NOW(),'$lado')");

        //mysqli_query($connection, "INSERT INTO calificados (id,nvirtual,padre,patrocinador,patrocinador_binario,lado,calificacion,activo,autorizado,pier_i_activa,pier_d_activa) VALUES ('0','$usuario','$referrer','$referrer','$pbinario','$lado','$tipoc',0,1,0,0)");

    }else{
        $dia_v = date("d");
        $mes_v = date("m");
        $ano_v = date("Y");

        if($mes_v==10){
            $mes_v="01";
            $ano_v++;
        }elseif($mes_v==11){
            $mes_v="02";
            $ano_v++;
        }elseif($mes_v==12){
            $mes_v="03";
            $ano_v++;
        }else{
            $mes_v = $mes_v + 3;
        }

        if(strlen($mes_v)<2){
            $mes_v = "0".$mes_v;
        }

        $vencimiento_gratis = $ano_v."-".$mes_v."-".$dia_v;
 
        mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$vencimiento_gratis' WHERE nvirtual = '$usuario'");

          
        mysqli_query($connection, "INSERT INTO calificados (id,nvirtual,padre,patrocinador,patrocinador_binario,lado,calificacion,activo,autorizado,pier_i_activa,pier_d_activa) VALUES ('0','$usuario','$referrer','$referrer','$pbinario','$lado',1,0,1,0,0)");

    }

//echo "INSERT INTO calificados (id,nvirtual,padre,patrocinador,patrocinador_binario,lado,calificacion,activo,autorizado,pier_i_activa,pier_d_activa) VALUES ('0','$usuario','$referrer','$referrer','$pbinario','$lado',1,0,1,0,0)"; exit();

    mysqli_query($connection, "INSERT INTO billetera (nvirtual,cant) VALUES ('$usuario',0)");
    mysqli_query($connection, "INSERT INTO saldo_financiero (nvirtual,saldo) VALUES ('$usuario',0)");


    if(isset($compra)){


        mysqli_query($connection, "INSERT INTO carrito (id,nvirtual,patrocinador,producto,fecha,cantidad) VALUES (0,'$usuario','$ref','$compra','".date('Y-m-d H:m:s')."',1)");

       

        	mysqli_query($connection, "INSERT INTO carrito (id,nvirtual,patrocinador,producto,fecha,cantidad) VALUES (0,'$usuario','$ref',15,'".date('Y-m-d H:m:s')."',1)");


        	$sasasa = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$usuario'");
        	$rarara = mysqli_fetch_array($sasasa);

        $_SESSION['id_usuario'] = $rarara['identificador'];
        $_SESSION['nvirtual'] = $rarara['nvirtual'];
        $_SESSION['registrado'] = 1;

        

    }



    if(!$q){
        alert(mysqli_error());
        redir("./");
    }else{

        if($tipoc!=1){
        if($banco==0 && !isset($compra)){

            $p = new paypal_class(); // paypal class
            $p->admin_mail  = 'promoliderpagos@gmail.com'; // set notification email


            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

           
            #https://promolider.org/img/logo2-net-menu.png
            $mensaje = "
            <center>
                <img src='https://promolider.org/sistema/img/logo2-net-menu.png' style='height: 80px; width: 250px;' />
            </center>
            <br>
            Felicitaciones Te has registrado con éxito en <b>Promolider.org</b>.<br><br>
            Tu Afiliación esta en proceso de activación, debes esperar a ser procesada por el administrador.<br><br>
            Tu Usuario es: <b>".$usuario."</b><br>
            Tu Contraseña es: <b>".$paspas."</b><br>
            Tu Oficina: https://promolider.org/sistema/user/?ref=".$usuario."<br><br>
            Ahora puedes invitar a tus amigos<br>
            Recibe un  Gran saludo de todo el Equipo de <b>Promolider.org</b>
            ";

            mail($email, "Registro Promolider.org", $mensaje , $headers);


            $invoice = date("His").rand(1234, 9632);
            $product_id = rand(1111, 99999);
                mysqli_query($connection, "INSERT INTO purchases ('invoice', 'product_id', 'product_name', 'product_quantity', 'product_amount', 'payer_fname', 'payer_lname', 'payer_address', 'payer_city', 'payer_state', 'payer_zip', 'payer_country', 'payer_email', 'payment_status', 'posted_date') VALUES ('".$invoice."', '".$product_id."', 'Compra Promolider', '1', '$tiva', '".$_SESSION["nvirtual"]."', '".$_SESSION["nvirtual"]."', '', '', '', '', '', '', '', NOW())");
                    $this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
                    $p->add_field('business', 'promoliderpagos@gmail.com'); // Call the facilitator eaccount
                    $p->add_field('cmd', '_cart'); // cmd should be _cart for cart checkout
                    $p->add_field('upload', '1');
                    $p->add_field('return', ''); // return URL after the transaction got over
                    $p->add_field('cancel_return', ''); // cancel URL if the trasaction was cancelled during half of the transaction
                    $p->add_field('notify_url', ''); // Notify URL which received IPN (Instant Payment Notification)
                    $p->add_field('currency_code', 'USD');
                    $p->add_field('invoice', $invoice);
                    $p->add_field('item_name_1', 'Registro Promolider ORG');
                    $p->add_field('item_number_1', 1);
                    $p->add_field('quantity_1', 1);
                    $p->add_field('amount_1',$montototalxd); //se modifico
                    $p->add_field('first_name', $nombre);
                    $p->add_field('last_name', $apellido);
                    $p->add_field('address1', '');
                    $p->add_field('city', '');
                    $p->add_field('state', '');
                    $p->add_field('country', '');
                    $p->add_field('zip', '');
                    $p->add_field('email', $email);
                    $p->submit_paypal_post();
                    //$p->dump_fields();

              
                $action = "ipn";
                
               $trasaction_id  = $_POST["txn_id"];
                    $payment_status = strtolower($_POST["payment_status"]);
                    $invoice        = $invoice;
                    $log_array      = print_r($_POST, TRUE);
                    $log_query      = "SELECT * FROM `paypal_log` WHERE `txn_id` = '$trasaction_id'";
                    $log_check      = mysqli_query($connection,$log_query);
                    if(mysqli_num_rows($log_check) <= 0){
                        mysqli_query($connection,"INSERT INTO `paypal_log` (`txn_id`, `log`, `posted_date`) VALUES ('$trasaction_id', '$log_array', NOW())");
                    }else{
                        mysqli_query($connection,"UPDATE `paypal_log` SET `log` = '$log_array' WHERE `txn_id` = '$trasaction_id'");
                    } // Save and update the logs array
                    $paypal_log_fetch   = mysqli_fetch_array(mysqli_query($connection,$log_query));
                    $paypal_log_id      = $paypal_log_fetch["id"];
                    if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic
                        mysqli_query($connection,"UPDATE `purchases` SET `trasaction_id` = '$trasaction_id ', `log_id` = '$paypal_log_id', `payment_status` = '$payment_status' WHERE `invoice` = '$invoice'");
                        $subject = 'Instant Payment Notification - Recieved Payment';
                        $p->send_report($subject); // Send the notification about the transaction
                    }else{
                        $subject = 'Instant Payment Notification - Payment Fail';
                        $p->send_report($subject); // failed notification
                    }

                notificar("administrador","Registro Paypal","Hay un Registro cancelado por paypal en espera por verificar.");
                die();
           
            }elseif ($banco==14 && !isset($compra)){ //******************Start BitPay Integration****************************
                
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            	$mensaje = "
                    <center>
                        <img src='https://promolider.org/sistema/img/logo2-net-menu.png' style='height: 80px; width: 250px;' />
                    </center>
                    <br>
                    Felicitaciones te has registrado con éxito en <b>Promolider.org</b>.<br><br>
                    Tu Afiliación ha sido activada por un administrador.<br><br>
                    Tu Usuario es: <b>".$usuario."</b><br>
                    Tu Contraseña es: <b>".$paspas."</b><br>
                    Tu Oficina: https://promolider.org/sistema/user/?ref=".$usuario."<br><br>
                    Desde hoy puedes empezar a ganar dinero invitando a tus amigos<br>
                    Recibe Un gran salud de todo el Equipo de <b>Promolider.org</b>
                    ";

                mail($email, "Registro Promolider.org", $mensaje , $headers);
                
                //Creating invoice BitPay 
                $invoice = new \Bitpay\Invoice();
                $buyer = new \Bitpay\Buyer();
                $buyer->setEmail($email);
                $invoice->setBuyer($buyer);
                
                //Configure item 
                $item = new \Bitpay\Item();
                $item->setCode(rand(1111, 99999));
                $item->setDescription('Pago de afiliación');
                $item->setPrice($montototalxd);
                
                // Configure the rest of the invoice
                $invoice->setItem($item);
                $invoice->setNotificationEmail('promoliderpagos@gmail.com');
                $invoice->setNotificationUrl('https://www.promolider.org/sistema/bitpay_config/vendor/bitpay/php-client/examples/tutorial/IPNlogger.php');
                $invoice->setRedirectUrl('https://promolider.org/sistema/login.php');
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
                
                alert("Felicidades, te has registrado satisfactoriamente. Realice el pago para acceder a su oficina.");
                redir(strval($invoice->getUrl()));
                //******************End BitPay Integration****************************
                
            }elseif ($banco==15 && !isset($compra)){
                
                /* --------------------------------------- Culqi Payment Integration ---------------------------------------  */
                /* ----------- API de conversión de divisas: Hace la conversión en tiempo real de $ a S/ --------------- */
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

                $montototalxd_en_soles = ceil(convertirDolaresASoles($montototalxd));
                
                /* ----------------------------------------------------- //End Culqi Payment Integration ------------------------------------------------  */
            }
            else{

            	$headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            	$mensaje = "
                    <center>
                        <img src='https://promolider.org/sistema/img/logo2-net-menu.png' style='height: 80px; width: 250px;' />
                    </center>
                    <br>
                    Felicitaciones te has registrado con éxito en <b>Promolider.org</b>.<br><br>
                    Tu Afiliación ha sido activada por un administrador.<br><br>
                    Tu Usuario es: <b>".$usuario."</b><br>
                    Tu Contraseña es: <b>".$paspas."</b><br>
                    Tu Oficina: https://promolider.org/sistema/user/?ref=".$usuario."<br><br>
                    Desde hoy puedes empezar a ganar dinero invitando a tus amigos<br>
                    Recibe Un gran salud de todo el Equipo de <b>Promolider.org</b>
                    ";

            mail($email, "Registro Promolider.org", $mensaje , $headers);

            alert("Felicidades, te has registrado satisfactoriamente. ahora puedes acceder a tu oficina.");
            redir("https://promolider.org/sistema/login.php");


            }

        }else{


            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            if($tipoc==0){
                 $mensaje = "
                    <center>
                        <img src='https://promolider.org/sistema/img/logo2-net-menu.png' style='height: 80px; width: 250px;' />
                    </center>
                    <br>
                    Felicitaciones Te has registrado con éxito en <b>PROMOLIDER.ORGl</b>.<br><br>
                    Tu Afiliación ha sido activada por un administrador.<br><br>
                    Tu Usuario es: <b>".$usuario."</b><br>
                    Tu Contraseña es: <b>".$paspas."</b><br>
                    Tu Oficina: https://promolider.org/sistema/user/?ref=".$usuario."<br><br>
                    Desde hoy puedes empezar a ganar diner invitando a tus amigo<br>
                    Recibe Un gran saludo de todo el Equipo  de <b>Promolider.org</b>
                    ";
            }else{

            $mensaje = "
            <center>
                <img src='https://promolider.org/sistema/img/logo2-net-menu.png' style='height: 80px; width: 250px;' />
            </center>
            <br>
            Te has registrado con éxito en <b>Promolider-org</b>.<br><br>
            Tu Afiliación esta en proceso de activación, debe esperar a ser procesada por el administrador.<br><br>
            Tu Usuario es: <b>".$usuario."</b><br>
            Tu Contraseña es: <b>".$paspas."</b><br>
            Tu Oficina: https://promolider.org/sistema/user/?ref=".$usuario."<br><br>
            Desde hoy puedes empezar a ganar dinero invitando a tus amigo<br>
            Recibe Un gran saludo de todo el Equipo  de <b>Promolider</b>
            ";

            }

            mail($email, "Registro Promolider.org", $mensaje , $headers);

            alert("Felicidades, te has registrado satisfactoriamente. ahora puedes acceder a tu oficina.");
            redir("https://promolider.org/sistema/login.php");
        }
    }

}    
?>

    <body style="background-color:#EEEEEE;">
    
    <div class="container">

        <div class="form-box" id="register-box">
            <div class="header" style="background-color: transparent;"> 
                <img src="https://promolider.org/sistema/img/logo2-net-menu.png" style="height: 80px; width: 250px;" />
            <br><br>
            <p style="color:#36424A; font-size:20px;" >Registro de Usuarios</p>
            </div>
            
    <form action="" method="post">
<div class="row">    
<div class="col-xs-12 col-md-4 col-lg-4">  
               <!-- <div class="body bg-gray">-->
                
                <h4 id="box-h4" style="background-color: #36424A;">Datos personales</h4>
                    <div class="form-group">
                        <input type="text" id="nombre" name="nombre" class="form-control" pattern="[A-Za-z\s]{3,250}" required placeholder="Nombre" title=" Nombre"/>
                    </div>
                    
                        <input type="hidden" name="snombre" class="form-control" title="Segundo nombre"/>
                    
                    <div class="form-group">
                        <input type="text" id="apellido" name="apellido" class="form-control" pattern="[A-Za-z\s]{3,250}" required placeholder="Apellido" title="Apellido"/>
                    </div>
                    
                        <input type="hidden" name="sapellido" class="form-control" title="Segundo apellido"/>
                    
                    <div class="form-group">
                        <input type="number" id="identificacion" name="identificacion" class="form-control" pattern="[0-9]{3,20}" required placeholder="Identificación" title="Documento de ientificación"/>
                    </div>
                    <div class="form-group">
                        <input type="date" name="fecha_nace" class="form-control" pattern="\d{1,2}/\d{1,2}/\d{4}" required placeholder="Fecha de Nacimiento" title="Fecha de nacimiento" />
                    </div>
                    <div class="form-group">
                        <input type="number" name="tlf" class="form-control" pattern="[\+0-9\-]{3,50}" required placeholder="Numero Telefonico" title="Numero telefonico"/>
                    </div>
                        <input type="hidden" name="tlf_h" class="form-control" title="Telefono de habitación"/>
                    <div class="form-group">
                    <select id="pais" title="Pais" required class="form-control" name="pais" >
                    <option value="">Seleccione su Pais</option>
                       <?php
                        $spais = mysqli_query($connection,"SELECT * FROM paises ORDER BY pais ASC"); 
                       while($rpais=mysqli_fetch_array($spais)){
                        ?>
                        <option value="<?=$rpais['id']?>">
                         <?=$rpais['pais']?>
                        </option>
                        <?php
                       }
                       ?>
                    </select>
                    </div>
                    
</div> <!--End First column-->
 <!--End first row-->

 
<div class="col-xs-12 col-md-4 col-lg-4">
                <h4 id="box-h4" style="background-color: #36424A;">Datos de la cuenta</h4>
                    <div class="form-group">
                        <input title="E-Mail" id="email" type="email" name="email" class="form-control" required placeholder="E-Mail"/>
                    </div>
                     <div class="form-group">
                        <input title="Usuario" type="text" name="usuario" class="form-control" pattern="[A-Za-z0-9]{2,250}" required placeholder="Usuario"/>
                    </div>
                     <div class="form-group">
                        <input title="password" type="password" name="passw" class="form-control" required placeholder="Contraseña"/>
                    </div>
                     <div class="form-group">
                        <input title="new-password" type="password" name="cpassw" class="form-control" required placeholder="Repita la contraseña"/>
                    </div>
                <h4 id="box-h4" style="background-color: #36424A;">Referidor / Patrocinante</h4>
                     <div class="form-group">
                        <input title="Patrocinador" type="text" name="referrer" readonly value="<?=$rref['nvirtual']?>" class="form-control" required placeholder="Referido"/>
                    </div>
</div>
 
<div class="col-xs-12 col-md-4 col-lg-4">                    
                <?php
                if(!isset($compra)){
                ?>
                <h4 id="box-h4" style="background-color: #36424A;">Tipo de cuenta</h4>
                 <div class="form-group">
                    <select title="Tipo de cuenta" required name="tipoc" id="afiliacion" class="form-control" onchange="cafiliacion();">
                        <option value="">Seleccione un tipo de cuenta</option>
                        <?php
                        $saf = mysqli_query($connection, "SELECT * FROM afiliaciones");
                        while($raf = mysqli_fetch_array($saf)){
                            ?>
                            <option value="<?=$raf['id']?>"><?=$raf['nombre']?></option>
                            <?php
                        }

                        ?>
                    </select>

                    <section id="afiliaciones">
                    <i>Seleccione un tipo de cuenta para ver los beneficios</i>
                    </section>
                    <section id="metodopago">

                    </section>

                </div>

                <?php
                }else{
                    ?>
                    <input type="hidden" name="tipoc" value="1"/>
                    <?php
                }
                ?>

                </div>

<?php
if(!isset($compra)){
?>

        <div class="form-control">
            <input title="Lea y tílde los Términos y Condiciones" type="checkbox" id="terminos" required/> Acepto que he leido los <a target="_blank" href="http://promolider.org/sistema/images/terminos.pdf">Términos y Condiciones</a>
                                                                 
            <button id="buyButton" type="submit" name="enviar" class="btn btn-block btn-lg" style="background-color: #5cc151; color: white;">Registrate</button>
        </div>
        <p id="success"></p>
<br><br>
    
<?php
}else{
	?>
    <div class="form-control">
        <button id="buyButton" type="submit" name="enviar" class="btn btn-block btn-lg" style="background-color: #5CC151; color: white;">Registrate</button>
    </div>

    <p id="success"></p>
	<?php
}
?>
                </div>
        </form>

</div><!--End First column-->


</div><!--End Container--->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div id="formulario">

                </div>
            </div>
        </div>

        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>  
        <script src="../js/promolid.js"></script>      

<?php

if(isset($_SESSION['menssage']) && $_SESSION['menssage'] != "")
{

  printf("<script type='text/javascript' language='javascript'>
    window.addEventListener('load',function(){
        alert('".$_SESSION['menssage']."');
    },false);

    </script>");

  unset($_SESSION['menssage']);

}

if (isset($_SESSION["number"])===false)
{
    $_SESSION['number']=1;
}else{
    $_SESSION['number']=$_SESSION['number']+1;
}
 ?>
        <script type="text/javascript" src="https://alignet-flex-demo.s3.amazonaws.com/flex-capture.min.js"></script>
        <script>
            function operacion(numero){
                if(numero<=10){
                    numero_operacion='00000'+numero;
                }else if(numero>=10 && numero<100){
                    numero_operacion='0000'+numero;
                }else if(numero>=100 && numero<1000){
                    numero_operacion='000'+numero;
                }else if(numero>=1000 && numero<10000){
                    numero_operacion='00'+numero;
                }else if(numero>=10000 && numero<100000){
                    numero_operacion='0'+numero;
                }else if(numero>=100000 && numero<1000000){
                    numero_operacion=numero;
                }
                return numero_operacion;
            }
            
            $('#buyButton').on('click', function() {
                nombre = $("#nombre").val();
                apellido = $("#apellido").val();
                identificacion = $("#identificacion").val();
                email = $("#email").val();
                total = $("#total").val();
                if($('#nombre').val()==='' && $('#apellido').val()===''){
                    alert('llene el formulario');
                }else if($('#terminos').prop('checked')){
                    $("#myModal").modal('show');
                    var payRequest = {
                        "action": "authorize",
                        "transaction": {
                            "currency": "840", // codigo 604 soles 840 dolares
                            "amount": total, // 
                            "meta": {
                                "internal_operation_number": operacion(<?= json_encode($_SESSION['number']) ?>), // NUMERO DE OPERACION CAMBIANTE CADA VEZ QUE SE INVOCA LA PASARELA
                                "description": "Pago de afiliacion",
                                "additional_fields": {
                                    "v_nombre" : nombre,
                                    "v_apellido" : apellido,
                                    "v_email" : email,
                                    "v_doc_type" : "DNI",
                                    "v_dni" : identificacion
                                }
                            }
                        },
                        "address": {
                            "billing": {
                                "first_name": nombre,
                                "last_name": apellido,
                                "email": email,
                                "phone": {
                                    "country_code": "51",
                                    "subscriber": "987654321"
                                },
                                "location": {
                                    "line_1": "Mi casa",
                                    "line_2": "Mi casa",
                                    "city": "LIMA",
                                    "state": "LIMA",
                                    "country": "PE",
                                    "zip_code": "18"
                                }
                            },
                            "shipping": {}
                        },
                        "card_holder": [{
                            "first_name": nombre,
                            "last_name": apellido,
                            "email_address": email,
                            "identity_document_country": "PE",
                            "identity_document_type": "DNI",
                            "identity_document_identifier": "87654321"
                        }]
                    };
                    var capture = new FlexCapture({
                        "key": "rp7X3ehM8Xcp7dHV.ZfaWHL8lPacrUcYT3nahWHQdkhLQaUy1TQhnzxskWh2gky6e0yxlgknKXNUserIK",
                        "payload": payRequest,
                        "additionalFields": []
                    });
                    capture.init(document.querySelector("#formulario"),reqCallback); 
                }else{
                    alert('debe aceptar los terminos y condiciones');
                }
            });
            function reqCallback(response) {
                console.log("-------Respuesta-------");
                console.log(response);
                if(response.success==="true"){
                    $("pre").show();
                    $("pre").empty();
                    var parrafo = document.createElement("p");
                    parrafo.id="respuesta";
                    parrafo.name="respuesta";
                    parrafo.textContent = "Felicidades, te has registrado satisfactoriamente. <br> ahora puedes acceder a tu oficina.";
                    $("pre").append(parrafo);
                    setTimeout(function () {
                        window.location.href = "https://promolider.org/sistema/login.php"
                    }, 1000);
                    <?php
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $mensaje = "
                        <center>
                            <img src='https://promolider.org/sistema/img/logo2-net-menu.png' style='height: 80px; width: 250px;' />
                        </center>
                        <br>
                        Felicitaciones Te has registrado con Ã©xito en <b>Promolider.org</b>.<br><br>
                        Tu AfiliaciÃ³n esta en proceso de activaciÃ³n, debes esperar a ser procesada por el administrador.<br><br>
                        Tu Usuario es: <b>".$usuario."</b><br>
                        Tu ContraseÃ±a es: <b>".$paspas."</b><br>
                        Tu Oficina: https://promolider.org/sistema/user/?ref=".$usuario."<br><br>
                        Ahora puedes invitar a tus amigos<br>
                        Recibe un  Gran saludo de todo el Equipo de <b>Promolider.org</b>
                        ";

                        mail($email, "Registro Promolider.org", $mensaje , $headers);
                    ?>
                }else{
                    $("pre").empty();
                    $("pre").show();
                    var parrafo = document.createElement("p");
                    parrafo.id="respuesta";
                    parrafo.name="respuesta";
                    parrafo.textContent = response.value;
                    $("pre").append(parrafo);
                }
            }
        </script>
<!--        <script>
                //colocar la llave publica
                //Culqi.publicKey = 'pk_live_bb31092d20cc0fac';
                Culqi.publicKey = 'pk_live_bb31092d20cc0fac';
                var total = '';
                //configuracion de culqi
                function configuracion(total) {
                    Culqi.settings({
                        title: 'Compra Promolider',
                        currency: 'USD',
                        description: 'Pago de afiliacion',
                        amount: total+'00' //finalAmount+000
                    });
                }
                
                //ejecutar el cuadro de culqi
                $('#buyButton').on('click', function(e) {
                    //convertir a entero el contenido de el objeto html total
                    total = parseInt($("#total").val());
                    //condicion para verificar si se aceptaron los terminos y condiciones
                    if($('#nombre').val()==='' && $('#apellido').val()===''){
                        alert('llene el formulario');
                    }else if($('#terminos').prop('checked')){
                        // Abre el formulario con las opciones de Culqi.settings
                        configuracion(total);
                        Culqi.open();
                        e.preventDefault();
                    }else{
                        alert('debe aceptar los terminos y condiciones');
                    }
                });
        
                function culqi() {
                    if (Culqi.token) { 
                        //console.log("El objeto Culqi.token existe");
                        var token = Culqi.token.id;
                        var email= Culqi.token.email;
                        var descripcion='Pago de afiliacion';
                        var precio = total+'00';
                        //console.log(precio);
                        //function waitForElement(){
                            //if(typeof precio === "string" && precio>300){
                                //precio = '<?php  //echo ($montototalxd*100);?>';
                                //precio = parseInt(precio);
                                //console.log("el valor de precio es "+precio);
                            //} else{
                                //setTimeout(waitForElement, 250);
                            //}
                        //};
        
                        //waitForElement();
                        if (descripcion!=='' && email!=='' && precio!=='') {
                            //console.log("Los valores descripcion, email y precio existen");
                            //console.log("El valor de precio final es:"+precio);
                            $.ajax({
                                //datos enviados por ajax
                                data: {
                                    email: email,
                                    token: token,
                                    precio: precio,
                                    descripcion: descripcion
                                },
                                //tipo de envio 
                                type: "POST",
                                //formato de datos que se espera de respuesta
                                dataType:"json",
                                //pagina a donde se envia la solicitud
                                url: "https://www.promolider.org/sistema/culqi_config/finalizar_compra_culqi_desde_registro.php",
                                //contentType: "application/json; charset=utf-8",
                                success: function(data){
                                    console.log(data);
                                    //var obj = JSON.parse(data);
                                    //console.log(obj);
                                    var response = "Ha ocurrido un error en la transacciÃ³n. Revise sus datos o intente con con otra tarjeta.";
                                    if(data.capture===true){
                                        response = "Felicidades, te has registrado satisfactoriamente. ahora puedes acceder a tu oficina.";
                                        setTimeout(function () {
                                            window.location.href = "https://promolider.org/sistema/login.php"
                                        }, 1000);
                                        <?php
//                                            $headers = "MIME-Version: 1.0" . "\r\n";
//                                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//                                            $mensaje = "
//                                            <center>
//                                                <img src='https://promolider.org/sistema/img/logo2-net-menu.png' style='height: 80px; width: 250px;' />
//                                            </center>
//                                            <br>
//                                            Felicitaciones Te has registrado con Ã©xito en <b>Promolider.org</b>.<br><br>
//                                            Tu AfiliaciÃ³n esta en proceso de activaciÃ³n, debes esperar a ser procesada por el administrador.<br><br>
//                                            Tu Usuario es: <b>".$usuario."</b><br>
//                                            Tu ContraseÃ±a es: <b>".$paspas."</b><br>
//                                            Tu Oficina: https://promolider.org/sistema/user/?ref=".$usuario."<br><br>
//                                            Ahora puedes invitar a tus amigos<br>
//                                            Recibe un  Gran saludo de todo el Equipo de <b>Promolider.org</b>
//                                            ";
//        
//                                            mail($email, "Registro Promolider.org", $mensaje , $headers);
                                        ?>
                                    }
                                    alert(response);
                                },
                                error: function(error) {
                                    console.log(JSON.parse(JSON.stringify(error.responseText))); 
                                }
                            });
                        } else{
                            console.log("Los valores descripcion, email y precio no existen");
                        }
                    } else {
                        console.log("El objeto Culqi.token no existe");
                        console.log(Culqi.error);
                        alert(Culqi.error.user_message);
                    }
                };
        </script>-->
    </body>
</html>
<!-- Jquery Latest Script -->
