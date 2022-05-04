<?php
check_admin();

if(isset($enviar)){
$mensaje = clear($mensaje);
mysqli_query($connection,"INSERT INTO mensaje (mensaje,fecha) VALUES ('$mensaje',NOW())");
alert("Mensaje Agregado.");
redir("?p=mensajes"); 
}

?>
<h3><i class="fa fa-envelope"></i> Agregar Mensaje</h3><hr>
<form method="post" action="">
<div class="form-group">
<input type="text" class="form-control" name="mensaje" placeholder="Mensaje..."/>
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" name="enviar" value="Guardar"/>
</div>
</form>