<?php
include "../config/conection.php";
check_conectado();	
?>
<h3><i class="fa fa-sign-in"></i> Transladar Fondos</h3><hr>
<form method="post" action="">
<div class="form-group">
<input type="text" class="form-control" name="cant" required placeholder="Cantidad"/>
</div>
<div class="form-group">
<select required class="form-control" name="directo">
<option value="">Seleccione un directo</option>
<?php
$sd = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE patrocinador = '".$_SESSION['nvirtual']."'");
while($rd=mysqli_fetch_array($sd)){
	?>
	<option value="<?=$rd['nvirtual']?>"><?=$rd['nvirtual']?> - <?=nombre_apellido_usuario($rd['nvirtual'])?></option>
	<?php
}
?>
</select>
</div>
<div class="form-group">
<input type="submit" class="btn btn-success" name="enviar_translado" value="Translador Fondos"/>
</div>
</form>