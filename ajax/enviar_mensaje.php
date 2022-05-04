<?php
include "../config/conection.php";
$nvirtual = clear($nvirtual);

$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '$nvirtual'");

if(mysqli_num_rows($s)<1){
	?>
	<script>
		bandeja_entrada();
	</script>
	<?php
	die();
}

$r = mysqli_fetch_array($s);

if(empty($r['campo_primer_apellido']) && empty($r['campo_primer_nombre'])){
	$nombre = "Administrador";
}else{
	$nombre = $r['campo_primer_nombre']." ".$r['campo_primer_apellido'];
}
?>
<div class="box box-solid box-success">
<div class="box-header" style="background:black;">
<h3 class="box-title"><center>Enviar nuevo mensaje</center></h3>
</div>
<div class="box-body">
<div class="form-group">
Para:
<input class="form-control" readonly="true" value="<?=$nombre?>">
<input type="hidden" name="nvirtual" value="<?=$r['nvirtual']?>"/>
</div>
<div class="form-group">
<input id="asunto" type="text" class="form-control" placeholder="Escriba un asunto..."/>
</div>
<div class="form-group">
<textarea id="mensaje_a_enviar" class="form-control" style="resize:none;" rows="6" placeholder="Escriba un mensaje..."></textarea>
</div>
<br>
<buttom class="btn btn-success" onclick="enviar_m('<?=$nvirtual?>');">Enviar Mensaje</buttom>
</div>
</div>