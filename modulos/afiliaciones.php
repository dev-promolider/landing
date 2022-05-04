<?php
if(isset($eliminar)){
	mysqli_query($connection, "DELETE FROM afiliaciones WHERE id = '$eliminar'");
	alert("Afiliacion eliminada");
	redir("?p=afiliaciones");
}
?>
<h3><i class="fa fa-dollar"></i> Afiliaciones</h3><hr>
<table class="table table-striped">
<tr>
<th>Nombre</th>
<th>Precio</th>
<th>Iva</th>
<th>Descuento en compras</th>
<th>% pago en corte binario</th>
<th>% Ganancia en Compras</th>
<th>% Ganancia en Compras 2da Generacion</th>
<th>Comisionable</th>
<th>Acciones</th>
</tr>
<?php
$s = mysqli_query($connection, "SELECT * FROM afiliaciones ORDER BY id DESC");
while($r=mysqli_fetch_array($s)){
	?>
	<tr>
		<td><?=$r['nombre']?></td>
		<td><?=$r['precio']?></td>
		<td><?=$r['iva']?></td>
		<td><?=$r['descuento']?></td>
		<td><?=$r['porcentaje_pago_corte']?></td>
        <td><?=$r['ganancia']?></td>
        <td><?=$r['ganancia2']?></td>
		<td><?=$r['comisionable']?></td>
		<td>
			<a data-toggle="tooltip" data-placement="top" title="Eliminar" href="#" onclick="eliminarafiliacion(<?=$r['id']?>);" style="font-weight:bold;">&times;</a>
			&nbsp; &nbsp;
			<a data-toggle="tooltip" data-placement="top" title="Modificar" href="?p=modificar_afiliacion&id=<?=$r['id']?>"><i class="fa fa-edit"></i></a>
		</td>
	</tr>
	<?php
}
?>
</table>

<br>

<a href="?p=agregar_afiliacion">
	<button class="btn btn-primary">Agregar Afiliacion</button>
</a>

<script>
function eliminarafiliacion(id){
	var seg = confirm("¿Estas seguro de querer eliminar esta afiliacion?");

	if(seg){
		window.location="?p=afiliaciones&eliminar="+id;
	}

}
</script>