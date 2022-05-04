<?php
include "../config/conection.php";
$idm = clear($idm);
$s = mysqli_query($connection,"SELECT * FROM bandeja_salida WHERE id = '$idm'");
if(mysqli_num_rows($s)>0){


	$r = mysqli_fetch_array($s);


	$su = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$r['nvirtual']."'");
	$ru = mysqli_fetch_array($su);

	if(file_exists("img/avatares/".$ru['nvirtual'].".jpg")){
		$avatar = "img/avatares".$ru['nvirtual'].".jpg";
	}else{
		$avatar = "0.png";
	}
	?>
	<center>
<table class="table">
			<tr>
			<td align="left" style="padding:50px 70px;">
				<h2>

				<?php
				if(empty($ru['campo_primer_nombre']) && empty($ru['campo_primer_apellido'])){
					echo "Administrador";
				}else{
					?>
						<?=$ru['campo_primer_nombre']?> <?=$ru['campo_primer_apellido']?>
					<?php
				}
				?>

				

				</h2>
			</td>
			<td style="padding:2px 20px" align="right"><img src="img/avatares/<?=$avatar?>" style="width:130px;height:130px;" class="img-circle"/></td>
			
			</tr>
			</table>
			</center>


			<br>
		<div class="box box-solid box-success">
			<div class="box-header">
				<h3 class="box-title">
					<?=$r['asunto']?>
				</h3>
			</div>
			<div class="box-body">
			<?=$r['mensaje']?><br>
			<small class="pull-right" style="color:#aaa;"><i class="fa fa-clock-o"></i> <?=fecha_hora($r['fecha'])?></small>

			<br>

			<buttom class="btn btn-success" onclick="enviar_mensaje('<?=$ru['nvirtual']?>');">Enviar Otro Mensaje</buttom>
			
			</div>
		</div>
	<?php
}else{
	?>
	<script type="text/javascript">
		bandeja_salida();
	</script>
	<?php
}
?>