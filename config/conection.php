<?php ini_set("display_errors",0);
@session_start();
@extract($_REQUEST);
date_default_timezone_set("America/Santiago");

$db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';


//$basededatos="promolid_millenium";
//$clave='VfG*i3[VI7b!';
//$usuariobd='promolid_cliente';

/*
$conex = mysqli_connect($host,$user,$pass)or die("No fue posible la Conexion al Servidor ".$host);
$sdb   = mysqli_select_db($db,$conex)or die("No se encontro la Base de Datos **** ".$db);

mysqli_query($connection, "SET NAMES 'utf8'");

 */
 
 // 1. Create a database connection
$connection = mysqli_connect($host,$user,$pass);
if (!$connection) {
    die("Database connection failed  xxx: " . mysqli_error());
}

// 2. Select a database to use 
$db_select = mysqli_select_db($connection, $db);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error());
}

function numero($var){
 $var = number_format($var,2,",",".");
 return $var;
}

function detect()
{
    $browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
    $os=array("WIN","MAC","LINUX");
    
    # definimos unos valores por defecto para el navegador y el sistema operativo
    $info['browser'] = "OTHER";
    $info['os'] = "OTHER";
    
    # buscamos el navegador con su sistema operativo
    foreach($browser as $parent)
    {
        $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
        $f = $s + strlen($parent);
        $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
        $version = preg_replace('/[^0-9,.]/','',$version);
        if ($s)
        {
            $info['browser'] = $parent;
            $info['version'] = $version;
        }
    }
    
    # obtenemos el sistema operativo
    foreach($os as $val)
    {
        if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
            $info['os'] = $val;
    }
    
    # devolvemos el array de valores
    return $info;
}

function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}
$ip = getRealIP();
$info=detect();

// echo "Sistema operativo: ".$info["os"];
// echo "Navegador: ".$info["browser"];
// echo "Versi¨®n: ".$info["version"];

/*
function clear($var){
    $var = mysqli_real_escape_string($var);
    return $var;
}*/

function clear($var){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
    $connection = mysqli_connect($host,$user,$pass);
    $db_select = mysqli_select_db($connection, $db);
    global $connection; 
    $var = mysqli_real_escape_string($connection , $var);
    return $var;
}

function alert($msj){
    ?>
    <script type="text/javascript">
    alert("<?=$msj?>");
    </script>
    <?php
}

function redir($url){
    ?>
    <script type="text/javascript">
    window.location="<?=$url?>";
    </script>
    <?php
    die();
}
function nombre_apellido_conectado(){

    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
    $connection = mysqli_connect($host,$user,$pass);
    $db_select = mysqli_select_db($connection, $db);

    if(isset($_SESSION['id_usuario'])){
        $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE identificador = '".$_SESSION['id_usuario']."'");
        $r = mysqli_fetch_array($s);

        if(empty($r['campo_primer_nombre']) && empty($r['campo_primer_apellido'])){
            return "Administrador";
        }else{
            return $r['campo_primer_nombre']." ".$r['campo_primer_apellido'];
        }
    }else{
        return "Desconocido.";
    }
}
function mes_inscripcion_conectado(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);

    if(isset($_SESSION['id_usuario'])){
        $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE identificador = '".$_SESSION['id_usuario']."'");
        $r = mysqli_fetch_array($s);
        $e = explode("-",$r['fecharegistro']);
        $mes = $e[1];
        if($mes=="01"){
            return "Enero";
        }elseif($mes=="02"){
            return "Febrero";
        }elseif($mes=="03"){
            return "Marzo";
        }elseif($mes=="04"){
            return "Abril";
        }elseif($mes=="05"){
            return "Mayo";
        }elseif($mes=="06"){
            return "Junio";
        }elseif($mes=="07"){
            return "Julio";
        }elseif($mes=="08"){
            return "Agosto";
        }elseif($mes=="09"){
            return "Septiembre";
        }elseif($mes=="10"){
            return "Octubre";
        }elseif($mes=="11"){
            return "Noviembre";
        }elseif($mes=="12"){
            return "Diciembre";
        }
    }else{
        return "Desconocido";
    }
}
function ano_inscripcion_conectado(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    if(isset($_SESSION['id_usuario'])){
        $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE identificador = '".$_SESSION['id_usuario']."'");
        $r = mysqli_fetch_array($s);
        $e = explode("-",$r['fecharegistro']);
        $ano = $e[0];
        return $ano;
    }else{
        return "Desconocido";
    }
}
function nombre_conectado(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    if(isset($_SESSION['id_usuario'])){
        $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE identificador = '".$_SESSION['id_usuario']."'");
        $r = mysqli_fetch_array($s);

        if(empty($r['campo_primer_nombre'])){
            return "Administrador";
        }else{
            return $r['campo_primer_nombre'];
        }

        
    }else{
        return "Desconocido.";
    }
}
function check_conectado(){
    if(!isset($_SESSION['nvirtual'])){
        redir("./");
    }
}
function check_admin(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."'");
    $r = mysqli_fetch_array($s);
    if($r['rol']<1){
        redir("./");
    }
}

function nombre_apellido_usuario($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);

    if(empty($r['campo_primer_apellido']) && empty($r['campo_primer_nombre'])){
        return "0";
    }else{

        return $r['campo_primer_nombre']." ".$r['campo_primer_apellido'];
    }
}

function fecha_hora($fecha){

    $fecha_exploded = explode("-",$fecha);
    list($ano,$mes,$dia) = $fecha_exploded;
    $div_hora = explode(" ",$dia);
    $dia = $div_hora[0];

    $horitas = explode(":",$div_hora[1]);
    list($h,$m,$s) = $horitas;    

    $ap = "AM";

    if($h==12){
        $ap="PM";
    }elseif($h==13){
        $h="01";
        $ap="PM";
    }elseif($h==14){
        $h="02";
        $ap="PM";
    }elseif($h==15){
        $h="03";
        $ap="PM";
    }elseif($h==16){
        $h="04";
        $ap="PM";
    }elseif($h==17){
        $h="05";
        $ap="PM";
    }elseif($h==18){
        $h="06";
        $ap="PM";
    }elseif($h==19){
        $h="07";
        $ap="PM";
    }elseif($h==20){
        $h="08";
        $ap="PM";
    }elseif($h==21){
        $h="09";
        $ap="PM";
    }elseif($h==22){
        $h="10";
        $ap="PM";
    }elseif($h==23){
        $h="11";
        $ap="PM";
    }elseif($h==00){
        $h="12";
    }


    echo $dia."/".mes($mes)."/".$ano." ".$h.":".$m." ".$ap;




}

function fecha($fecha){
    $fecha_exploded = explode("-",$fecha);
    list($ano,$mes,$dia) = $fecha_exploded;

    if($mes=="01"){
        $mes = "Ene";
    }elseif($mes=="02"){
        $mes = "Feb";
    }elseif($mes=="03"){
        $mes = "Mar";
    }elseif($mes=="04"){
        $mes = "Abr";
    }elseif($mes=="05"){
        $mes = "May";
    }elseif($mes=="06"){
        $mes = "Jun";
    }elseif($mes=="07"){
        $mes = "Jul";
    }elseif($mes=="08"){
        $mes = "Ago";
    }elseif($mes=="09"){
        $mes = "Sep";
    }elseif($mes=="10"){
        $mes = "Oct";
    }elseif($mes=="11"){
        $mes = "Nov";
    }elseif($mes=="12"){
        $mes = "Dic";
    }

    return $dia."/".$mes."/".$ano;
}

function mes($mes){
    if($mes=="01"){
        $mes = "Ene";
    }elseif($mes=="02"){
        $mes = "Feb";
    }elseif($mes=="03"){
        $mes = "Mar";
    }elseif($mes=="04"){
        $mes = "Abr";
    }elseif($mes=="05"){
        $mes = "May";
    }elseif($mes=="06"){
        $mes = "Jun";
    }elseif($mes=="07"){
        $mes = "Jul";
    }elseif($mes=="08"){
        $mes = "Ago";
    }elseif($mes=="09"){
        $mes = "Sep";
    }elseif($mes=="10"){
        $mes = "Oct";
    }elseif($mes=="11"){
        $mes = "Nov";
    }elseif($mes=="12"){
        $mes = "Dic";
    }

    return $mes;
}

function rol($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
//@$connection = mysqli_connect($host,$user,$pass);
//@$db_select = mysqli_select_db($connection, $db);
$connection = mysqli_connect($host,$user,$pass,$db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);
    return $r['rol'];
}
function difdiv(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $s = mysqli_query($connection, "SELECT * FROM divisa");
    $r = mysqli_fetch_array($s);
    return $r['difdiv'];
}
function notificar($nvirtual,$titulo,$mensaje){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $titulo = clear($titulo);
    $mensaje = clear($mensaje);

    $q = mysqli_query($connection, "INSERT INTO notificaciones (nvirtual,titulo,mensaje,fecha) VALUES ('$nvirtual','$titulo','$mensaje',NOW())");

	$correo = correo($nvirtual);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	
	mail($correo,$titulo,$mensaje,$headers);

    if(!$q){
        alert(mysqli_error());
    }

}
function check_activos_y_calificados(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $s = mysqli_query($connection, "SELECT * FROM checkeo");
    $r = mysqli_fetch_array($s);
    $hoy = date("Y-m-d");
    if($r['fecha']<$hoy){

        mysqli_query($connection, "UPDATE checkeo SET fecha = '$hoy'");

        $sd = mysqli_query($connection, "SELECT * FROM datosdeusuarios");
        while($rd = mysqli_fetch_array($sd)){
            if($rd['vence']>=$hoy){
                mysqli_query($connection, "UPDATE datosdeusuarios SET activo = 0 WHERE nvirtual = '".$rd['nvirtual']."'");
            }
        }

         $sa = mysqli_query($connection, "SELECT * FROM datosdeusuarios ORDER BY identificador ASC");
    while($ra=mysqli_fetch_array($sa)){

        $pi = true;
        $pd = false;

            $spi = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$ra['nvirtual']."' AND lado = 1");
            while($rpi=mysqli_fetch_array($spi)){
                if(esta_activo($rpi['nvirtual'])){
                    $pi=true;
                }
            }
            $spd = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$ra['nvirtual']."' AND lado = 2");
            while($rpd=mysqli_fetch_array($spd)){
                if(esta_activo($rpd['nvirtual'])){
                    $pd = true;
                }
            }

        if($pi==true && $pd == true){
            mysqli_query($connection, "UPDATE datosdeusuarios SET calificado = 1 WHERE nvirtual = '".$ra['nvirtual']."'");

        }else{
            mysqli_query($connection, "UPDATE datosdeusuarios SET calificado = 0 WHERE nvirtual = '".$ra['nvirtual']."'");
        }
    }
    }
}

function esta_calificado($nvirtual){

    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);

    $nvirtual = clear($nvirtual);

    if($nvirtual=="administrador"){
        
        return true;
   
    }else{

        $izq = 0;
        $der = 0;
        
        $s = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '$nvirtual' AND lado = 1");
        while($r=mysqli_fetch_array($s)){
            if($r['calificacion']>1){
                if(esta_activo($r['nvirtual'])){
                    $izq = 1;
                }
            }
        }

        $s2 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '$nvirtual' AND lado = 2");
        while($r2=mysqli_fetch_array($s2)){
            if($r2['calificacion']>1){
                if(esta_activo($r2['nvirtual'])){
                    $der = 1;
                }
            }
        }

        //alert($nvirtual." Izq: ".$izq." Der: ".$der);

        if($izq==1 && $der==1){
            return true;
        }else{
            return false;
        }
    }
}

function esta_activo($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
    $hoy = date("Y-m-d");
    $r = mysqli_fetch_array($s);
    if($r['vence']>=$hoy){
        //alert($nvirtual." Esta activo");
        return true;
    }else{
        //alert($nvirtual." No esta activo");
        return false;
    }
}
function nombre_usuario($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);
    if(is_null($r['campo_primer_nombre'])){
        return "Administrador";
    }else{
        return $r['campo_primer_nombre'];
    }
}

function apellido_usuario($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);
    if(is_null($r['campo_primer_apellido'])){
        return "Administrador";
    }else{
        return $r['campo_primer_apellido'];
    }
}

function activar_fecha_pago($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);
    $exp = explode("-",$r['fecharegistro']);
    $dia = $exp[2];
    $mes = $exp[1];
    $ano = $exp[0];

    if($mes==12){
        $mes="01";
        $ano++;
    }else{
        $mes++;
        if(strlen($mes)<2){
            $mes = "0".$mes;
        }
    }

    $vence = $ano."-".$mes."-".$dia;

    mysqli_query($connection, "UPDATE datosdeusuarios SET vence = '$vence' WHERE nvirtual = '$nvirtual'");
}

function tipo_afiliacion_conectado(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    if(isset($_SESSION['nvirtual'])){
        $nvirtual = clear($_SESSION['nvirtual']);

        $s = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$nvirtual'");
        $r = mysqli_fetch_array($s);

        $calificacion = $r['calificacion'];

        $sa = mysqli_query($connection, "SELECT * FROM afiliaciones WHERE id = '$calificacion'");
        $ra = mysqli_fetch_array($sa);

        return $ra['nombre'];

    }
}
function pierna($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);

    return $r['pierna'];
}

function check_generaciones(){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);

    $pgi = 0;
    $pgd = 0;
    $sgii = 0;
    $sgid = 0;
    $sgdi = 0;
    $sgdd = 0;

    $sgd = 0;
    $sgi = 0;

    $s = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$_SESSION['nvirtual']."' AND lado = 1");
    while($r=mysqli_fetch_array($s)){
        if($r['calificacion']>1){
            if(esta_activo($r['nvirtual'])){
                $pgi=1;

                $ss = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 1");
                while($rr=mysqli_fetch_array($ss)){
                    if($rr['calificacion']>1){
                        $sgii=1;
                    }
                }

                $ss2 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 2");
                while($rr2=mysqli_fetch_array($ss2)){
                    if($rr['calificacion']>1){
                        $sgdi=1;
                    }
                }

                 if($sgii==1 && $sgid == 1){
                    $sgi = 1;
                }else{
                    $sgii = 0;
                    $sgid = 0;
                }

            }
        }
    }

    $s2 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$_SESSION['nvirtual']."' AND lado = 2");
    while($r2=mysqli_fetch_array($s2)){
        if($r2['calificacion']>1){
            if(esta_activo($r2['nvirtual'])){
                $pgd=1;

                $ss3 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 1");
                while($rr3=mysqli_fetch_array($ss3)){
                    if($rr3['calificacion']>1){
                        $sgid=1;
                    }
                }

                $ss4 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 2");
                while($rr4=mysqli_fetch_array($ss4)){
                    if($rr4['calificacion']>1){
                        $sgdd=1;
                    }
                }

                if($sgid==1 && $sgdd == 1){
                    $sgd = 1;
                }else{
                    $sgid = 0;
                    $sgdd = 0;
                }

            }
        }
    }

    if($pgi==1 && $pgd == 1){
        $sep = mysqli_query($connection, "SELECT * FROM generaciones WHERE nvirtual = '".$_SESSION['nvirtual']."' AND generacion = 1");
        if(mysqli_num_rows($sep)<1){
            mysqli_query($connection, "INSERT INTO generaciones (nvirtual,generacion) VALUES ('".$_SESSION['nvirtual']."',1)");

            $pago1 = 250;
            //mysqli_query($connection, "UPDATE billetera SET cant = cant + $pago1 WHERE nvirtual = '".$_SESSION['nvirtual']."'");
        }
    }

    if($sgii == 1 && $sgid == 1 && $sgdi == 1 && $sgdd == 1){
        $sep2 = mysqli_query($connection, "SELECT * FROM generaciones WHERE nvirtual = '".$_SESSION['nvirtual']."' AND generacion = 2");
        if(mysqli_num_rows($sep2)<1){
             $pago2 = 300;
            //mysqli_query($connection, "UPDATE billetera SET cant = cant + $pago2 WHERE nvirtual = '".$_SESSION['nvirtual']."'");
        
        }
    }



}
function ber($nvirtual,$monto){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $monto = clear($monto);

    $s = mysqli_query($connection, "SELECT * FROM cont_ber WHERE nvirtual = '$nvirtual'");
    if(mysqli_num_rows($s)>0){
        mysqli_query($connection, "UPDATE cont_ber SET monto = monto + '$monto' WHERE nvirtual = '$nvirtual'");
    }else{
        mysqli_query($connection, "INSERT INTO cont_ber (nvirtual,monto) VALUES ('$nvirtual','$monto')");
    }
}
function log_billetera($nvirtual,$monto,$razon,$tipo){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $monto = clear($monto);
    $razon = clear($razon);
    $tipo = clear($tipo);

    mysqli_query($connection, "INSERT INTO log_billetera (nvirtual,monto,razon,tipo,fecha) VALUES ('$nvirtual','$monto','$razon',$tipo,NOW())");
}
function log_binario($nvirtual,$monto,$razon){
   $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $monto = clear($monto);
    $razon = clear($razon);

    mysqli_query($connection, "INSERT INTO log_binario (nvirtual,monto,razon,fecha) VALUES ('$nvirtual','$monto','$razon',NOW())");
}

function log_financiero($nvirtual,$monto,$razon){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $monto = clear($monto);
    $razon = clear($razon);

    mysqli_query($connection, "INSERT INTO log_financiero (nvirtual,monto,razon,fecha) VALUES ('$nvirtual','$monto','$razon',NOW())");
}
function no_es_imagen($ext){

    $ext = strtoupper($ext);

    if($ext!="PNG" && $ext!="JPG" && $ext!="JPEG" && $ext != "BMP"){
        return true;
    }else{
        return false;
    }
}

function avatar($nvirtual){
    $nvirtual = clear($nvirtual);
    if(file_exists("img/avatares/".$nvirtual.".jpg")){
        return $nvirtual.".jpg";
    }else{
        return "0.png";
    }
}

function correo($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
	$nvirtual = clear($nvirtual);
	$s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");
	$r = mysqli_fetch_array($s);
	return $r['correo'];
}
function log_mer($nvirtual,$cant){
   $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
	$nvirtual = clear($nvirtual);
	$cant = clear($cant);
	
	$s = mysqli_query($connection, "SELECT * FROM log_mer WHERE nvirtual = '$nvirtual'");
	if(mysqli_num_rows($s)>0){
		mysqli_query($connection, "UPDATE log_mer SET cant = cant + '$cant' WHERE nvirtual = '$nvirtual'");
	}else{
		mysqli_query($connection, "INSERT INTO log_mer (nvirtual,cant) VALUES ('$nvirtual','$cant')");
	}
}

function log_merr($nvirtual,$cant){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
	$nvirtual = clear($nvirtual);
	$cant = clear($cant);
	
	$s = mysqli_query($connection, "SELECT * FROM log_merr WHERE nvirtual = '$nvirtual'");
	if(mysqli_num_rows($s)>0){
		mysqli_query($connection, "UPDATE log_merr SET cant = cant + '$cant' WHERE nvirtual = '$nvirtual'");
	}else{
		mysqli_query($connection, "INSERT INTO log_merr (nvirtual,cant) VALUES ('$nvirtual','$cant')");
	}
}

function check_bono_inicio(){
   $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);

	 $s = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual != 'administrador' ORDER BY id ASC");

    
    while($r=mysqli_fetch_array($s)){


        if(bono_inicio($r['nvirtual'])==0){

            $swi = 0;
            $swd = 0;

            $sci = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 1");
            while($rci=mysqli_fetch_array($sci)){
                if(esta_activo($rci['nvirtual']) && esta_calificado($rci['nvirtual'])){
                    $swi = 1;
                }
            }


            $scd = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 2");
            while($rcd=mysqli_fetch_array($scd)){
                if(esta_activo($rcd['nvirtual']) && esta_calificado($rcd['nvirtual'])){
                    $swd = 1;
                }
            }



            if($swi==1 && $swd==1){
                $sbi = mysqli_query($connection, "SELECT * FROM bono_inicio");
                $rbi = mysqli_fetch_array($sbi);
                $bono_inicio = $rbi['precio'];

                mysqli_query($connection, "UPDATE calificados SET bono_inicio = '$bono_inicio' WHERE nvirtual = '".$r['nvirtual']."'");
                mysqli_query($connection, "INSERT INTO log_billetera (nvirtual,monto,tipo,fecha,razon) VALUES ('".$r['nvirtual']."','$bono_inicio',1,NOW(),'Bono de Inicio')");
                 mysqli_query($connection, "UPDATE billetera SET cant = cant + $bono_inicio WHERE nvirtual = '".$r['nvirtual']."'");

            }
        
        }
    

    }

    alert("Bono de Inicio Entregado");
    redir("./");

}



function check_bono_crecimiento(){
   $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
	
    $s = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual != 'administrador' ORDER BY id ASC");

    
    while($r=mysqli_fetch_array($s)){

        if(bono_crecimiento($r['nvirtual'])==0){

            $swi = 0;
            $swd = 0;

            $swii = 0;
            $swid = 0;

            $swdi = 0;
            $swdd = 0;

            $sci = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 1");
            while($rci=mysqli_fetch_array($sci)){
                if(esta_activo($rci['nvirtual']) && esta_calificado($rci['nvirtual'])){
                    $swi = 1;

                        $sci2 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$rci['nvirtual']."' AND lado = 1");

                        while($rci2=mysqli_fetch_array($sci2)){
                            if(esta_activo($rci2['nvirtual']) && esta_calificado($rci2['nvirtual'])){
                                $swii = 1;
                            }
                        }

                        $sci3 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$rci['nvirtual']."' AND lado = 2");

                        while($rci3=mysqli_fetch_array($sci3)){
                            if(esta_activo($rci3['nvirtual']) && esta_calificado($rci3['nvirtual'])){
                                $swid = 1;
                            }
                        }

                }
            }


            $scd = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$r['nvirtual']."' AND lado = 2");
            while($rcd=mysqli_fetch_array($scd)){
                if(esta_activo($rcd['nvirtual']) && esta_calificado($rcd['nvirtual'])){
                    $swd = 1;

                        $scd2 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$rcd['nvirtual']."' AND lado = 1");

                        while($rcd2=mysqli_fetch_array($scd2)){
                            if(esta_activo($rcd2['nvirtual']) && esta_calificado($rcd2['nvirtual'])){
                                $swdi = 1;
                            }
                        }

                        $scd3 = mysqli_query($connection, "SELECT * FROM calificados WHERE patrocinador = '".$rcd['nvirtual']."' AND lado = 2");

                        while($rcd3=mysqli_fetch_array($scd3)){
                            if(esta_activo($rcd3['nvirtual']) && esta_calificado($rcd3['nvirtual'])){
                                $swdd = 1;
                            }
                        }

                }
            }



            if($swi==1 && $swd==1 && $swii == 1 && $swdi == 1){
                $sbc = mysqli_query($connection, "SELECT * FROM bono_crecimiento");
                $rbc = mysqli_fetch_array($sbc);
                $bono_crecimiento = $rbc['precio'];

                mysqli_query($connection, "UPDATE calificados SET bono_crecimiento = '$bono_crecimiento' WHERE nvirtual = '".$r['nvirtual']."'");
                mysqli_query($connection, "INSERT INTO log_billetera (nvirtual,monto,tipo,fecha,razon) VALUES ('".$r['nvirtual']."','$bono_crecimiento',1,NOW(),'Bono de Crecimiento')");
                mysqli_query($connection, "UPDATE billetera SET cant = cant + $bono_crecimiento WHERE nvirtual = '".$r['nvirtual']."'");

            }


        }

    }

    alert("Bono de Crecimiento Entregado");
    redir("./");


}

function bono_inicio($nvirtual){
    $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);
    return $r['bono_inicio'];
}


function bono_crecimiento($nvirtual){
   $db   = "new_db_promolider";
$host = "localhost";
$user = "developerpro";
$pass = 'Developer@2021';
$connection = mysqli_connect($host,$user,$pass);
$db_select = mysqli_select_db($connection, $db);
    $nvirtual = clear($nvirtual);
    $s = mysqli_query($connection, "SELECT * FROM calificados WHERE nvirtual = '$nvirtual'");
    $r = mysqli_fetch_array($s);
    return $r['bono_crecimiento'];
}
?>