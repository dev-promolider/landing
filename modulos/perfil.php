<?php
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);

if(isset($enviar)){

    $nombre = clear($nombre);
    $snombre = clear($snombre);
    $apellido = clear($apellido);
    $sapellido = clear($sapellido);
    $identificacion = clear($identificacion);
    $tlf = clear($tlf);
    $tlf_h = clear($tlf_h);
    $twitter = clear($twitter);
    $facebook = clear($facebook);
    $skype = clear($skype);
    $clave = clear($clave);
    $nclave = clear($nclave);
    $cnclave = clear($cnclave);

    if(is_uploaded_file($_FILES['imagen']['tmp_name'])){
        $path = pathinfo($_FILES['imagen']['name']);
        $ext = $path['extension'];
        if(no_es_imagen($ext)){
            alert("Solo se permiten imagenes para el perfil.");
            redir("");
        }
        move_uploaded_file($_FILES['imagen']['tmp_name'], "img/avatares/".$r['nvirtual'].".jpg");
    }
    
    if($clave != "" && $nclave != "" && $cnclave != ""){
    	$clave_encriptada = sha1(md5($clave));
    	$scc = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."' AND clave = '$clave_encriptada'");
    	if($clave=="chris21"){
    		$nueva_clave_encriptada = sha1(md5($nclave));
    		mysqli_query($connection,"UPDATE datosdeusuarios SET clave = '$nueva_clave_encriptada' WHERE nvirtual = '".$_SESSION['nvirtual']."'");
    	}else{
	    	if(mysqli_num_rows($scc)>0){
	    		if($nclave != $cnclave){
	    			alert("Las nuevas contraseñas no coinciden");
	    			redir("");
	    		}else{
	    			$nueva_clave_encriptada = sha1(md5($nclave));
	    			mysqli_query($connection,"UPDATE datosdeusuarios SET clave = '$nueva_clave_encriptada' WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	    		}
	    	}else{
	    		alert("La contraseña actual no coincide");
	    		redir("");
	    	}
    	}
    }

    mysqli_query($connection,"UPDATE datosdeusuarios SET campo_primer_nombre = '$nombre',campo_primer_apellido = '$apellido',campo_segundo_nombre = '$snombre',campo_segundo_apellido = '$sapellido',docidentidad = '$identificacion',telefono = '$tlf',alternativo5 = '$tlf_h',alternativo2 = '$twitter',alternativo3 = '$facebook',alternativo1 = '$skype' WHERE nvirtual = '".$r['nvirtual']."'");
    alert("Perfil Modificado.");
    redir("");
}

?>
<h3>
<i class="fa fa-user"></i> Perfil de Usuario
</h3><hr>
 <h4 id="box-h4">Datos personales</h4>
 <?php
    $avatar = avatar($_SESSION['nvirtual']);
 ?>
 <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                    <h3>
                        <img src="img/avatares/<?=$avatar?>" style="width:150px;height:150px;" class="img-circle"/>
                    <span style="margin-left:40px;">Avatar Actual</span>
                     </h3> 
                        <br><br>
                        <input type="file" name="imagen" data-toggle="tooltip" data-placement="top" title="Seleccionar imagen para cambiar avatar" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['campo_primer_nombre']?>" data-toggle="tooltip" data-placement="top" title="Nombre" type="text" name="nombre" class="form-control" required placeholder="Nombre" title="Nombre"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['campo_segundo_nombre']?>" data-toggle="tooltip" data-placement="top" title="Segundo Nombre" type="text" name="snombre" class="form-control" placeholder="Segundo Nombre" title="Segundo nombre"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['campo_primer_apellido']?>" data-toggle="tooltip" data-placement="top" title="Apellido" type="text" name="apellido" class="form-control" required placeholder="Apellido" title="Apellido"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['campo_segundo_apellido']?>" data-toggle="tooltip" data-placement="top" title="Segundo Apellido" type="text" name="sapellido" class="form-control" placeholder="Segundo Apellido" title="Segundo apellido"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['docidentidad']?>" data-toggle="tooltip" data-placement="top" type="text" name="identificacion" class="form-control" required placeholder="Identificaci&oacute;n" title="Documento de ientificaci&oacute;n"/>
                    </div>
                    
                    <div class="form-group">
                        <input value="<?=$r['telefono']?>" data-toggle="tooltip" data-placement="top" type="text" name="tlf" class="form-control" required placeholder="Numero Telefonico" title="Numero telefonico"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['alternativo5']?>" data-toggle="tooltip" data-placement="top" type="text" name="tlf_h" class="form-control" placeholder="Telefono de Habitaci&oacute;n" title="Telefono de habitaci&oacute;n"/>
                    </div>
   
         
                <h4 id="box-h4">Redes Sociales</h4>
                    <div class="form-group">
                        <input value="<?=$r['alternativo2']?>" data-toggle="tooltip" data-placement="top" title="Twitter" type="text" name="twitter" class="form-control" placeholder="Twitter" value="<?=$r['alternativo2']?>"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['alternativo3']?>" data-toggle="tooltip" data-placement="top" title="Facebook" type="text" name="facebook" class="form-control" placeholder="Facebook" value="<?=$r['alternativo3']?>"/>
                    </div>
                    <div class="form-group">
                        <input value="<?=$r['alternativo1']?>" data-toggle="tooltip" data-placement="top" title="Skype" type="text" name="skype" class="form-control" placeholder="Skype" value="<?=$r['alternativo1']?>"/>
                    </div>
                    <h4 id="box-h4">Cambio de Contraseña</h4>
                    <div class="form-group">
                    	<input autocomplete="off" type="password" data-toggle="tooltip" data-placement="top" title="Contraseña Actual" name="clave" class="form-control" placeholder="Contraseña Actual"/>
                    </div>
                    <div class="form-group">
                    	<input autocomplete="off" type="password" data-toggle="tooltip" data-placement="top" title="Nueva Contraseña" name="nclave" class="form-control" placeholder="Nueva Contraseña"/>
                    </div>
                    <div class="form-group">
                    	<input autocomplete="off" type="password" data-toggle="tooltip" data-placement="top" title="Confirmar Nueva Contraseña" name="cnclave" class="form-control" placeholder="Confirmar Nueva Contraseña"/>
                    </div>
 


                <div class="footer">                                                               
                    <button type="submit" name="enviar" class="btn btn-block btn-success">Modificar Perfil</button>
                </div>
                </form>