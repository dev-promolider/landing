<?php

//para envio de correo
function setUpMail()
{
	require_once('phpmailer/PHPMailerAutoload.php');
	//include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail             = new PHPMailer();

	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	                                           // 1 = errors and messages
	                                           // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "sc1.conectarhosting.com"; // sets the SMTP server
	$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "flowerfullsistema@promoliderv.org"; // SMTP account username
	$mail->Password   = "flowerfullsistema";        // SMTP account password
	$mail->SMTPSecure = 'ssl';
	$mail->isHTML(true);  

	$mail->SetFrom('flowerfullsistema@promoliderv.org', 'Flowerful');

	return $mail;

	//$mail->AddReplyTo('reservaciones@newtokyojapaneserestaurant.com', 'Sistema de Reservaciones New Tokyo');

	//$mail->AltBody    = "Para ver el mensaje, por favor utilice un cliente de correo compatible con HTML."; // optional, comment out and test

	// hasta aqui
}


function enviarCodigoRegistro($nombre,$apellido,$correo,$nvirtual)
{
	$mail = setUpMail();

    $mail->AddAddress($correo);

    $mensaje = "
    <div align='center' id='cuerpo'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<style>
	body{
		font-family: 'Open Sans', sans-serif;
		color: #333333;
	}		
	#cuerpo{
		margin: 0% 5% 10% 5%;
	}
	table{
		border-style: none;	
		table-layout: fixed;
	}
	</style>
	<h2>Informacion de usuario</h2>	
	<table border='0px'>
		<tr>
			<td width='500px' align='center'><strong>Datos del usuario</strong></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width='500px'><strong>Nombre:</strong>&nbsp;".$nombre."</td>
		</tr>
		<tr>
			<td><strong>Apellido:</strong>&nbsp;".$apellido."</td>
		</tr>
		<tr>
			<td width='500px'><strong>Usuario:</strong>&nbsp;".$nvirtual."</td>
		</tr>
		<tr>
			<td><strong>Correo:</strong>&nbsp;".$correo."</td>
		</tr>

	</table>
	<br>
	<table border='0px'>
		<tr>
			<td width='500px' align='center'>Usa este link para que tus amigos sean referidos por ti :</td>
		</tr>
		<tr>
			<td width='500px' align='center'><strong><a href='http://promoliderv.org/".$nvirtual."' target='_blank'>http://promoliderv.org/".$nvirtual."</a></strong></td>
		</tr>
	</table>		
	<br>	
	<strong>Enviado el ".date('d-m-Y')." a las ".date('H:i:s').". </strong>
	";
	
	$mail->MsgHTML(utf8_decode($mensaje)); //no olvidar el decode
	$mail->Subject = utf8_decode("Registro Flowerful - Link referencial");
	
	if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
	} 

}

function enviarMail($mensaje,$correo,$titulo)
{
	$mail = setUpMail();

    $mail->AddAddress($correo);

    $mensaje = "
    <div align='center' id='cuerpo'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<style>
	body{
		font-family: 'Open Sans', sans-serif;
		color: #333333;
	}		
	#cuerpo{
		margin: 0% 5% 10% 5%;
	}
	table{
		border-style: none;	
		table-layout: fixed;
	}
	</style>
	".$mensaje."
	<br>	
	<strong>Enviado el ".date('d-m-Y')." a las ".date('H:i:s').". </strong>
	";
	
	$mail->MsgHTML(utf8_decode($mensaje)); //no olvidar el decode
	$mail->Subject = utf8_decode($titulo);
	
	if(!$mail->Send()) {
			  echo "Mailer Error: " . $mail->ErrorInfo;
	} 

}
?>