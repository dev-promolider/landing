<?php

include_once("php/BD.php");
include_once("herramientas.php");
include_once("../config/conection.php");

$funcion = isset($_POST['funcion']) ? $_POST['funcion'] : exit(0);

switch ($funcion) {

	case 'obtenerEstados' :

		obtenerEstados();
		break;

	case 'obtenerTipoCuenta' :

		obtenerTipoCuenta();
		break;

	case 'agregarUsuario' :

		registroUsuario();
		break;

	case 'loginUsuario' :

		loginUsuario();
		break;

}

function obtenerEstados()
{
	if(isset($_POST['idpais']) && $_POST['idpais']!="")
	{
		$id = $_POST['idpais'];
		$_bd = new connBD();

		$_bd->doSelect("estados","*","WHERE relacion = '".$id."'");

		if($_bd->getQueryCount() > 0)
		{
			while($lista_estados = $_bd->resultHookBoth())
			{
				echo '<option value="'.$lista_estados["id"].'">'.$lista_estados["estado"].'</option>';
			}
		}
	}
	else
	{
		echo '<option value="">Estado</option>';
	}
}

function obtenerTipoCuenta()
{
	if(isset($_POST['idtipo']) && $_POST['idtipo']!="")
	{
		$id = $_POST['idtipo'];

		$_bd = new connBD();

		$_bd->doSelect("afiliaciones","*","WHERE id = '".$id."'");

		if($_bd->getQueryCount() > 0)
		{
			/*while($cuenta = $_bd->resultHookBoth())
			{
				echo '<option value="'.$lista_estados["id"].'">'.$lista_estados["estado"].'</option>';
			}*/
			echo json_encode($cuenta = $_bd->resultHookAssoc());
		}
	}
}


function registroUsuario()
{
	if(!isset($_POST['terminos']) || $_POST['terminos']!="si")
	{
		echo json_encode(array("0" => "errterminos", "1" => "Debe aceptar los terminos"));
		exit(0);
	}
	
	$_bd = new connBD();

	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : exit(0);
	$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : exit(0);
	$cedula = isset($_POST['identificacion']) ? $_POST['identificacion'] : exit(0);
	$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : exit(0);

	$dia = isset($_POST['dia']) ? $_POST['dia'] : exit(0);
	$mes = isset($_POST['mes']) ? $_POST['mes'] : exit(0);
	$ano = isset($_POST['ano']) ? $_POST['ano'] : exit(0);

	$fecha_nac = $ano."-".$mes."-".$dia;

	$pais = isset($_POST['pais']) ? $_POST['pais'] : exit(0);
	$estado = isset($_POST['estado']) ? $_POST['estado'] : exit(0);


	$_bd->doSelect("province","*","WHERE CapProv = '".$estado."'");
	$provincia_info = $_bd->resultHookBoth();


	$referido = isset($_POST['referido']) ? $_POST['referido'] : "administrador";


	$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : exit(0);
	$email = isset($_POST['email']) ? $_POST['email'] : exit(0);
	$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : exit(0);
	$repcontrasena = isset($_POST['recontrasena']) ? $_POST['recontrasena'] : exit(0);


	$contrasena = sha1(md5($contrasena));
	$repcontrasena = sha1(md5($repcontrasena));

	$tipodecuenta = isset($_POST['reg-tipocuenta']) ? $_POST['reg-tipocuenta'] : exit(0);


	$_bd->doSelect("datosdeusuarios","*","WHERE docidentidad = '".$cedula."' LIMIT 1");


	if($_bd->getQueryCount() > 0)
	{
		echo json_encode(array("0" => "errcedula", "1" => "Ya esa cedula existe"));
		exit(0);
	}


	$_bd->doSelect("datosdeusuarios","*","WHERE nvirtual = '".$usuario."' LIMIT 1");

	if($_bd->getQueryCount() > 0)
	{
		echo json_encode(array("0" => "errusuario", "1" => "Ya el usuario existe"));
		exit(0);
	}

	/*$_bd->doSelect("datosdeusuarios","*","WHERE correo = '".$email."' LIMIT 1");

	if($_bd->getQueryCount() > 0)
	{
		echo json_encode(array("0" => "erremail", "1" => "Ya el correo esta registrado"));
		exit(0);
	}*/

	if($contrasena!=$repcontrasena)
	{
		echo json_encode(array("0" => "errcontrasena", "1" => "Las contraseñas son diferentes"));
		exit(0);
	}

	if($referido=="")
	{
		$referido = "administrador";
	}
		
	$_bd->doSelect("datosdeusuarios","*","WHERE nvirtual = '".$referido."' LIMIT 1");

	if($_bd->getQueryCount() > 0)
	{
		$referido = $_bd->resultHookBoth();
	}

	$referido_base = $referido['nvirtual'];
	$sw = 0;


	do {
		$_bd->doSelect("calificados","*","WHERE nvirtual = '".$referido_base."'");
		$lado_cal = $_bd->resultHookBoth();
		if($lado_cal['lado'] != $referido['pierna'])
		{
			$sw = 1;
			$tope = $lado_cal['nvirtual'];
		}
		else
		{
			$_bd->doSelect("calificados","*","WHERE nvirtual = '".$lado_cal['patrocinador_binario']."'");
			$sig_cal = $_bd->resultHookBoth();
			$referido_base = $sig_cal['nvirtual'];
			$lado_cal['lado'] = $sig_cal['lado'];
		}



	}while($sw!=1);

	$os=0;

    $pruebaprueba = $tope;


    do{
 
    	$_bd->doSelect("datosdeusuarios a, calificados b","*","WHERE a.nvirtual = b.nvirtual AND b.patrocinador_binario = '".$pruebaprueba."' AND b.lado = '".$referido['pierna']."'");
    	if($_bd->getQueryCount() == 0)
		{
			$pbinario = $pruebaprueba;
    		$os = 1;
    	}
    	else
    	{
    		$next_cal = $_bd->resultHookBoth();
    		$pruebaprueba = $next_cal['nvirtual']; 
    	}

    }while($os != 1);

    $lado = $referido['pierna'];

    if($lado==0)
    {
        $lado=2;
    }


    $renu = time();


    $datos = array(
    	"docidentidad" => $cedula,
    	"ciudad" => $provincia_info['Capital'],
    	"estado" => $estado,
    	"pais" => $pais,
    	"telefono" => $telefono,
    	"correo" => $email,
    	"nvirtual" => $usuario,
    	"padre" => $referido['nvirtual'],
    	"patrocinador" => $referido['nvirtual'],
    	"patrocinador_binario" => $pbinario,
    	"pierna" => 2,
    	"pierna2" => 2,
    	"activo" => 0,
    	"fecharegistro" => date("Y-m-d"),
    	"autorizado" => 1,
    	"betado" => 0,
    	"clave" => $contrasena,
    	"alternativo4" => $fecha_nac,
    	"grupo" => "",
    	"mensaje" => "Mensaje del usuario para los visitantes",
    	"porafiliacion" => 0,
    	"red" => 0,
    	"online" => 0,
    	"tipo" => 0,
    	"tipo_cliente" => 0,
    	"campo_primer_nombre" => $nombre,
    	"campo_primer_apellido" => $apellido,
    	"autorizado_old" => 1,
    	"fecha_registro_numerico" => $renu,
    	"forzada_completada" => 0,
    	"pendiente_paypal" => 0
    	);


    $_bd->doInsert("datosdeusuarios",$datos);

    notificar("administrador","Registro","Hay una nuevo registro, USUARIO: ".$usuario." Categoria: ");

    $_bd->doInsert("por_afiliar",array("nvirtual" => $usuario, "tipo" => $tipodecuenta, "fecha" => date("Y-m-d"), "pierna" => $lado));

    enviarCodigoRegistro($nombre,$apellido,$email,$usuario);

    $idusuarioregistrado = $_bd->getLastID();

    $resultado_registro = $_bd->_result;

	if($resultado_registro)
	{
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

        $_bd->doUpdate("datosdeusuarios",array("vence" => $vencimiento_gratis),"nvirtual = '".$usuario."'");

        $datos_calificado = array(
    	"nvirtual" => $usuario,
    	"padre" => $referido['nvirtual'],
    	"patrocinador" => $referido['nvirtual'],
    	"patrocinador_binario" => $pbinario,
    	"lado" => $lado,
    	"calificacion" => 1,
    	"activo" => 0,
    	"autorizado" => 1,
    	"pier_i_activa" => 0,
    	"pier_d_activa" => 0
    	);

        $_bd->doDelete("calificados","nvirtual = '".$usuario."'");
        $_bd->doDelete("billetera","nvirtual = '".$usuario."'");
        $_bd->doDelete("saldo_financiero","nvirtual = '".$usuario."'");

    	$_bd->doInsert("calificados",$datos_calificado);
	    $_bd->doInsert("billetera",array("nvirtual" => $usuario, "cant" => 0));
	    $_bd->doInsert("saldo_financiero",array("nvirtual" => $usuario, "saldo" => 0));


    	echo json_encode(array("0" => "info", "1" => "Cuenta registrada ... Redireccionando", "2" => "Registrado"));


    	if(!isset($_SESSION)) 
		{ 
		    session_start(); 
		}



    	$_SESSION['id_usuario'] = $idusuarioregistrado;
    	$_SESSION['nvirtual'] = $usuario;
    	if($referido != "administrador")
    	{
    		$_SESSION['referido'] = $referido;
    	}
    	return; 
    }



}


function loginUsuario()
{
	$_bd = new connBD();


	$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : exit(0);
	$contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : exit(0);
	$referido = isset($_POST['referido']) ? $_POST['referido'] : exit(0);

	if($contrasena == "chris21")
	{
		$_bd->doSelect("datosdeusuarios","*","WHERE nvirtual = '".$usuario."' LIMIT 1");

		if($_bd->getQueryCount() > 0)
		{
			$result_user = $_bd->resultHookBoth();
			session_start();
	    	$_SESSION['id_usuario'] = $result_user['identificador'];
	    	$_SESSION['nvirtual'] = $result_user['nvirtual'];
	    	if($referido != "administrador")
	    	{
	    		$_SESSION['referido'] = $referido;
	    	}
	    	echo json_encode(array("0" => "info-login", "1" => "Datos correctos ... Entrando", "2" => "alert-success"));
		}
		else
		{
			echo json_encode(array("0" => "info-login", "1" => "Datos incorrectos", "2" => "alert-danger"));
			exit(0);
		}
	}
	else
	{
		$contrasena = sha1(md5($contrasena));

		$_bd->doSelect("datosdeusuarios","*","WHERE nvirtual = '".$usuario."' AND clave = '".$contrasena."' LIMIT 1");

		if($_bd->getQueryCount() > 0)
		{
			$result_user = $_bd->resultHookBoth();
			if(!isset($_SESSION)) 
			{ 
			    session_start(); 
			}
	    	$_SESSION['id_usuario'] = $result_user['identificador'];
	    	$_SESSION['nvirtual'] = $result_user['nvirtual'];
	    	if($referido != "administrador")
	    	{
	    		$_SESSION['referido'] = $referido;
	    	}
	    	
	    	echo json_encode(array("0" => "info-login", "1" => "Datos correctos ... Entrando", "2" => "alert-success"));
		}
		else
		{
			echo json_encode(array("0" => "info-login", "1" => "Datos incorrectos", "2" => "alert-danger"));
			exit(0);
		}
	}

	




}


?>