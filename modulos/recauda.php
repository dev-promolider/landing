<table class="table table-striped table-bordered">
<tr>
	<th class="bg-blue" colspan="2"><center><h4>PUNTOS RECAUDADOS</h4></center></th>
</tr>

<tr>
	<th class="info"><center>IZQUIERDA</center></th>
	<th class="info"><center>DERECHA</center></th>
</tr>
<?php
$contviz=0;
$contvde=0;
$st = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$_SESSION['nvirtual']."'");
while($rt=mysqli_fetch_array($st)){
	if($rt['pierna']==1){
		$contviz = $contviz + $rt['puntos'];
		?>
		<tr>
		<td><center><?=$rt['puntos']?> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?=$rt['razon']?>"></i></center></td>
		<td><center>0</center></td>
		</tr>
		<?php
	}else{
		$contvde = $contvde + $rt['puntos'];
		?>
		<tr>
		<td><center>0</center></td>
		<td><center><?=$rt['puntos']?> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="<?=$rt['razon']?>"></i></center></td>
		</tr>
		<?php
	}
}
?>
<tr>
<th class="bg-green"><center><?=$contviz?></center></th>
<th class="bg-green"><center><?=$contvde?></center></th>
</tr>
</table>
<br>
<table class="table table-striped">
<tr>
<th colspan="3" class="bg-blue"><center><h4>LISTA DETALLADA DE PUNTOS RECAUDADOS</h4></th>
</tr>
<tr>
<th>Puntos</th>
<th>Pierna</th>
<th>Razon</th>
</tr>
<?php
$stpp = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$_SESSION['nvirtual']."'");
while($rtpp=mysqli_fetch_array($stpp)){
	
	if($rtpp['pierna']==1){
		$izqde="Izquierda";
	}else{
		$izqde="Derecha";
	}
	?>
	<tr>
	<td><?=$rtpp['puntos']?></td>
	<td><?=$izqde?></td>
	<td><?=$rtpp['razon']?></td>
	</tr>
	<?php
}
?>
</table>