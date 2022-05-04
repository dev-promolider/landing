<?php
include "../config/conection.php";
?>
<h3><i class="fa fa-sitemap"></i> Volumen Derecho</h3>
<hr>
<table class="table table-striped">
<tr>
		<th>Puntos</th>
		<th>Razon</th>
	</tr>
<?php
$tp = 0;
$s = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$_SESSION['nvirtual']."' AND pierna = 2");
while($r=mysqli_fetch_array($s)){
	$tp = $tp + $r['puntos'];
	?>
	<tr>
		<th><?=$r['puntos']?></th>
		<th><?=$r['razon']?></th>
	</tr>
	<?php
}
?>
</table>
<h1><span class="text-green"><?=$tp?></span> Puntos</h1>