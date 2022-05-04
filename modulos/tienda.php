<div class="form-group">
<select class="form-control" onchange="window.location='?p=tienda&tipo='+$(this).val();">
<option value="">Seleccione un tipo de producto</option>
<?php
$st = mysqli_query($connection,"SELECT * FROM productos_categorias");
while($rt=mysqli_fetch_array($st)){
	?>
		<option value="<?=$rt['Id']?>"><?=$rt['Nombre']?></option>
	<?php
}
?>
</select><br>
<div class="input-group input-group-sm">
                                        <input id="busq" onkeyup="buscar_tienda();" type="text" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success btn-flat" onclick="buscar_tienda();" type="button">Buscar</button>
                                        </span>
                                    </div>
</div>
<center>

<section id="tienda">
<?php
if(isset($tipo)){
$tipo = clear($tipo);
$opcional = "AND categoria = '".$tipo."'";
}
$s = mysqli_query($connection,"SELECT * FROM productos WHERE activo = 1 $opcional ORDER BY id DESC");
while($r=mysqli_fetch_array($s)){
	if($r['activo']==1){
		$si = mysqli_query($connection,"SELECT * FROM productos_imagenes WHERE IdProducto = '".$r['id']."'");
		$ri = mysqli_fetch_array($si);
		?>
			<div class="box box-success" id="cajaproducto">
				<div class="titulo">
					<?=$r['producto']?>
				</div>
				<div class="imagen_producto">
					<img src="img/productos/<?=$ri['RutaImagen']?>" style="width:200px;height:150px;"/>
				</div>
				<div class="footer_producto">
					<p class="pull-left" style="position:relative;top:8px;">
						<?=numero($r['precio'])?>
						<?=$r['simbolo_moneda']?>
					</p>
					<p class="pull-right">
						<button onclick="aggcar(<?=$r['id']?>);" class="btn btn-success"><span class="fa fa-shopping-cart"></span> Agregar</button>
					</p>
				</div>
			</div>
		<?php
	}
}
?>
</section>
</center>

<section id="barra_carro_compra" class="btn btn-success btn-flat" onclick="opcar();">
<li class="fa fa-shopping-cart"></li> Carrito de compras
</section>
<section id="cuerpo_carro_compra">

</section>

<section id="boton_compra" class="primary">
<button class="btn btn-success" onclick='window.location="?p=carrito";'>Concretar</button>
<span class="pull-right" title="Total"><i class="fa fa-money text-green"></i> <span id="total"></span></span>
</section>

<section id="msjtienda">
</section>


<?php
$s = mysqli_query($connection,"SELECT * FROM carrito WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);
if(mysqli_num_rows($s)>0){
	?>
		<script type="text/javascript">
			$("#barra_carro_compra").click();
		</script>
	<?php
}
?>