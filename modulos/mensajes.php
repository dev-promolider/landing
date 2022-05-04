<?php
check_admin();

if(isset($eliminar)){
$eliminar = clear($eliminar);

$s = mysqli_query($connection,"SELECT * FROM mensaje WHERE id = '$eliminar'");
$r = mysqli_fetch_array($s);

if($r['estado']==0){
	$nestado = 1;
	$xd = "Habilitado";
}else{
	$nestado = 0;
	$xd = "Deshabilitado";
}

mysqli_query($connection,"UPDATE mensaje SET estado = $nestado WHERE id = '$eliminar'");
alert("Mensaje ".$xd);
redir("?p=mensajes");
}

if(isset($actdes)){
}
?>
<h3><i class="fa fa-envelope"></i> Mensajes de Pantalla Principal</h3><hr>
<table class="table table-striped">
<tr>
<th>Mensaje</th>
<th>Fecha</th>
<th><i class="fa fa-cog"></i></th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM mensaje ORDER BY fecha DESC");
while($r=mysqli_fetch_array($s)){
	if($r['estado']==0){
		$color = "red";
	}else{
		$color = "green";
	}
	?>
		<tr>
			<td><table style="width:100%;"><tr><td><i class="fa fa-circle text-<?=$color?>"></i></td><td><?=$r['mensaje']?></td></tr></table></td>
			<td><?=fecha_hora($r['fecha'])?></td>
			<td>
				<?php
				if($r['estado']==0){
					?>
					<a data-toggle="tooltip" data-placement="top" title="Habilitar" href="?p=mensajes&eliminar=<?=$r['id']?>"><i class="fa fa-check"></i></a>
					<?php
				}else{
					?>
					<a  data-toggle="tooltip" data-placement="top" title="Deshabilitar" href="?p=mensajes&eliminar=<?=$r['id']?>"><i class="fa fa-times"></i></a>
					<?php
				}
				?>
				
			</td>
		</tr>
	<?php
}
?>
</table><br>
<a href="?p=agregarmensaje"><button class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Mensaje</button></a>