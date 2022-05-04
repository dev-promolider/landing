<?php
include "../config/conection.php";
$busq = clear($busq);
$su = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE campo_primer_nombre LIKE '%$busq%' OR campo_primer_apellido LIKE '%$busq%' OR docidentidad LIKE '%$busq%' OR ciudad LIKE '%$busq%' OR estado LIKE '%$busq%' OR pais LIKE '%$busq%' OR telefono LIKE '%$busq%' OR correo LIKE '%$busq%' OR nvirtual LIKE '%$busq%'");
$sp = mysqli_query($connection,"SELECT * FROM productos WHERE producto LIKE '%$busq%'");
?>

<section id="ocontent">

<div class="box box-solid box-info">
<div class="box-header">
<h3 class="box-title">
Resultado de busqueda de usuarios
</h3>
</div>
<div class="box-body">
<?php
if(mysqli_num_rows($su)>0){
while($ru=mysqli_fetch_array($su)){
	if(file_exists("../img/avatares/".$ru['nvirtual'].".jpg")){
		$avatar = $ru['nvirtual'].".jpg";
	}else{
		$avatar = "0.png";
	}
	?>
	<div class="box box-solid box-primary" id="cadamiembro">
		<div class="box-header" >
			<h3 class="box-title" style="text-align:center"><center><?=nombre_apellido_usuario($ru['nvirtual'])?></center></h3>
		</div>
		<div class="box-body" style="padding:0;margin:0;">
		<img src="img/avatares/<?=$avatar?>" style="width:245px;height:245px;";/>
		<br>

		<p class="pull-left" style="position:relative;top:3px;left:5px;"><i class="fa fa-circle text-success"></i> En Linea</p>
		<?php
		if($ru['nvirtual']!=$_SESSION['nvirtual']){
			?>
			<a href="?p=mailbox&em=<?=$ru['nvirtual']?>" class="pull-right" data-toggle="tooltip" data-placement="top" title="Enviar un mensaje"><i class="fa fa-envelope fa-2x"></i> &nbsp; </a>
			<?php
		}else{
			?>
			<a class="pull-right" style="color:#999"><i class="fa fa-envelope fa-2x"></i> &nbsp; </a>
			<?php
		}
		?>
			
		</div>
	</div>
	<?php
}
}else{
	echo "<i>No se encontro nada por <b>$busq</b></i>";
}
?>
</div>
</div>

<br>
<div class="box box-solid box-info">
<div class="box-header">
<h3 class="box-title">
Resultado de busqueda de productos
</h3>
</div>
<div class="box-body">

<?php
if(mysqli_num_rows($sp)>0){
while($r=mysqli_fetch_array($sp)){
	if($r['activo']==1){
		$si = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$r['id']."'");
		$ri = mysqli_fetch_array($si);
		?>
			<div class="box box-success" id="cajaproducto">
				<div class="titulo">
					<?=$r['producto']?>
				</div>
				<div class="imagen_producto">
					<img src="img/productos/<?=$ri['RutaImagen']?>" style="width:250px;height:200px;"/>
				</div>
				<div class="footer_producto">
					<p class="pull-left" style="position:relative;top:8px;">
						<?=$r['precio']?>
						<?=$r['simbolo_moneda']?>
					</p>
					<p class="pull-right">
						<button onclick="aggcar(<?=$r['id']?>);window.location='?p=carrito';" class="btn btn-success"><span class="fa fa-shopping-cart"></span> Agregar</button>
					</p>
				</div>
			</div>
		<?php
	}
}
}else{
	echo "<i>No se encontro nada por <b>$busq</b></i>";
}
?>


</div>
</div>

</section>