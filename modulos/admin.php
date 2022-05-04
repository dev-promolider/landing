<?php

if(isset($q)){
	$q = clear($q);
	mysqli_query($connection, "UPDATE datosdeusuarios SET rol = 0 WHERE identificador = '$q'");
	alert("Administracion retirada");
	redir("?p=admin");
}

if(isset($enviar)){
	$usuario_adm = clear($usuario_adm);
	$s = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE nvirtual = '$usuario_adm'");

	if(mysqli_num_rows($s)<1){
		alert("EL USUARIO INDICADO NO EXISTE!.");
		redir("");
	}

	mysqli_query($connection, "UPDATE datosdeusuarios SET rol = 1 WHERE nvirtual = '$usuario_adm'");
	alert($usuario_adm." Ha sido nombrado administrador");
	redir("");
}
?>
<form method="post" action="">
<h3><i class="fa fa-user"></i> Introduzca el usuario a nombrar administrador.</i></h3><br>
<div class="form-group">
<input class="form-control" placeholder="Usuario..." name="usuario_adm"/><br>
<input type="submit" class="btn btn-primary" value="Nombrar Administrador" name="enviar"/>
</div>
</form><br>
<hr>
<h3><i class="fa fa-users"></i> Lista de administradores</h3><br>
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Correo</th>
<th>Acciones</th>
</tr>
<?php
$sa = mysqli_query($connection, "SELECT * FROM datosdeusuarios WHERE rol=1 AND nvirtual != 'administrador'");
while($ra=mysqli_fetch_array($sa)){
	?>
	<tr>
	<td><?=$ra['nvirtual']?></td>
	<td><?=nombre_usuario($ra['nvirtual'])?></td>
	<td><?=apellido_usuario($ra['nvirtual'])?></td>
	<td><?=$ra['correo']?></td>
	<td>
		<a href="?p=admin&q=<?=$ra['identificador']?>" data-toggle="tooltip" data-placement="top" title="Quitar Administracion">&times;</a>
	</td>
	</tr>
	<?php
}
?>
</table>