<?php
check_admin();
?>
<h3><i class="fa"><strong>$</strong></i> Fondos de Billetera de los Usuarios</h3><hr>
<table class="table table-striped">
<tr>
<th>Usuario</th>
<th>Monto Disponible</th>
</tr>
<?php
if(!isset($busq)){
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios");
}else{
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual LIKE '%$busq%'");
}
$totalmontos = 0;
while($r=mysqli_fetch_array($s)){
$sb = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$r['nvirtual']."'");
$rb = mysqli_fetch_array($sb);

$totalmontos = $totalmontos + $rb['cant'];

if($rb['cant']>0){
?>
<tr>
<td>
<?=nombre_apellido_usuario($r['nvirtual'])?>
</td>
<td>$ <?=number_format($rb['cant'],2)?></td>
</tr>
<?php
}
}
?>
</table>
<h3>Total: <b style="color:green"> $<?=number_format($totalmontos,2)?></b></h3>