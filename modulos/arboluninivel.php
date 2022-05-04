<?php
$s = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);
$avatar = avatar($_SESSION['nvirtual']);
?>
<h3><i class="fa fa-sitemap"></i> Arbol Uninivel</h3><hr>
<center>
<img data-toggle="tooltip" data-placement="top" title="<?=nombre_apellido_usuario($_SESSION['nvirtual'])?>" src="img/avatares/<?=$avatar?>" class="img-circle" style="width:150px;height:150px;"/>
<br><br>
<table>
<tr>
<td style="border-right:1px solid #eaeaea;">
<?php
$s2 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$_SESSION['nvirtual']."' AND lado = 1");
while($r2=mysqli_fetch_array($s2)){
	$avatar2  = avatar($r2['nvirtual']);
	?>
	<section style="display:inline-block;">
		<a href="#" onclick="ver_user_arbol('<?=$r2['nvirtual']?>');">
			<img src="img/avatares/<?=$avatar2?>" class="img-circle" style="width:100px;height:100px;" data-toggle="tooltip" data-placement="top" title="<?=nombre_apellido_usuario($r2['nvirtual'])?>"/>
		</a>
		<br><br>
		<table>
		<tr>
		<td>
			<?php
			$s4 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 1");
			if(mysqli_num_rows($s4)>0){
				$r4 = mysqli_fetch_array($s4);
				$avatar4 = avatar($r4['nvirtual']);
				?>
					<a href="#" onclick="ver_user_arbol('<?=$r4['nvirtual']?>');">
						<img src="img/avatares/<?=$avatar4?>" class="img-circle" style="width:100px;height:100px;" data-toggle="tooltip" data-placement="top" title="<?=nombre_apellido_usuario($r4['nvirtual'])?>"/>
					</a>
				<?php
			}else{
				echo "<section style='width:100px;height:100px;'>&nbsp;</section>";
			}
			?>
		</td>
		<td style="border-left:1px solid #eaeaea;">
			<?php
			$s5 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."' AND lado = 2");
			if(mysqli_num_rows($s5)>0){
				$r5 = mysqli_fetch_array($s5);
				$avatar5 = avatar($r5['nvirtual']);
				?>
					<a href="#" onclick="ver_user_arbol('<?=$r5['nvirtual']?>');">
						<img src="img/avatares/<?=$avatar5?>" class="img-circle" style="width:100px;height:100px;" data-toggle="tooltip" data-placement="top" title="<?=nombre_apellido_usuario($r5['nvirtual'])?>"/>
					</a>
				<?php
			}else{
				echo "<section style='width:100px;height:100px;'>&nbsp;</section>";
			}
			?>
		</td>
		</tr>
		</table>
	</section>
	<?php
}
?>
</td>


<td  style="border-left:1px solid #eaeaea;">
<?php
$s3 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$_SESSION['nvirtual']."' AND lado = 2");
if(mysqli_num_rows($s3)>0){
while($r3=mysqli_fetch_array($s3)){
	$avatar3  = avatar($r3['nvirtual']);
	?>
	<section style="display:inline-block;">
		<a href="#" onclick="ver_user_arbol('<?=$r3['nvirtual']?>');">
			<img src="img/avatares/<?=$avatar3?>" class="img-circle" style="width:100px;height:100px;" data-toggle="tooltip" data-placement="top" title="<?=nombre_apellido_usuario($r3['nvirtual'])?>"/>
		</a>
	</section>
	<?php
}
}else{
	echo "<section style='width:100px;height:100px;'>&nbsp;</section>";
}
?>
</td>
</tr>
</table>
</section>
</center>

<style>
table tr td{
	vertical-align: top;
}
</style>