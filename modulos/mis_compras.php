<table class="table table-striped">
<tr>
<th>Fecha</th>
<th>Estado de la compra</th>
<th>Acciones</th>
</tr>
<?php
$s = mysqli_query($connection,"SELECT * FROM compra_espera WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY id DESC");
while($r=mysqli_fetch_array($s)){
	if($r['desautorizado']==0){
		$estado = "No Revisado";
	}elseif($r['desautorizado']==1){
		$estado = "<span style=color:red>No Aprobado</span>";
	}else{
		$estado = "<span style=color:green>Aprobado</span>";
	}
	?>
	<tr>
		<th><?=fecha_hora($r['fecha'])?></th>
		<th><?=$estado?></th>
		<th>
			<a href="#" title="Ver Productos" onclick="cargarproductos(<?=$r['id']?>);" data-toggle="modal" data-target="#compose-modal" >
				<i class="fa fa-eye"></i>
			</a>
			
			&nbsp; &nbsp;
			
			<?php
			if($r['desautorizado']==2){
			?>
			<a href="?p=verfactura&compra=<?=$r['id']?>" data-toggle="tooltip" data-placement="top" title="Ver Factura">
				<i class="fa fa-file-text"></i>
			</a>
			<?php
			}
			?>
			
		</th>
	</tr>
	<?php
}
?>
</table>