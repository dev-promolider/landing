<?php
include "../config/conection.php";
?>
<form method="post">
<h3><i class="fa fa-fa-arrow-circle-right"></i> Comprarle a un Directo</h3><hr>
<div class="form-group">
<select required name="directo" class="form-control">
<option value="">Seleccione su directo</option>
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
<select required name="produto" class="form-control">
<option value="">Seleccione el producto</option>
<?php
$sp = mysqli_query($connection,"SELECT * FROM productos ORDER BY categoria DESC");
while($rp=mysqli_fetch_array($sp)){
?>
<option value="<?=$rp['id']?>"><?=$rp['producto']?> - Precio: <?=number_format($rp['precio'],2)?> <?=$rp['simbolo_moneda']?></option>
<?php
}
?>
</select>
</div>

<div class="form-group">
<?php
$s = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);
$saldo = $r['cant'];
?>
Saldo Disponible: <?=number_format($saldo,2)?> $
</div>
<div class="form-group">
<button class="btn btn-success" type="submit" name="enviar">Realizar Compra</button>
</div>

</form>