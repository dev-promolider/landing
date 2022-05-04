<?php
include "../config/conection.php";
$s = mysqli_query($connection,"SELECT * FROM bancos");
while($r=mysqli_fetch_array($s)){
	?>
	Banco: <b><?=$r['banco']?></b><br>
	Cuenta: <b><?=$r['cuenta']?></b><br>
	Titular: <b><?=$r['titular']?></b><br><br>

	<?php
	$s2 = mysqli_query($connection,"SELECT * FROM bancos_opcionales WHERE id_banco = '".$r['id']."'");
	while($r2=mysqli_fetch_array($s2)){
		?>
		<?=$r2['titulo']?>: <b><?=$r2['campo']?></b><br>
		<?php
	}
	echo "<hr>";
}
?>