<?php
check_admin();

if(isset($enviar)){
	$difdiv = clear($difdiv);
	mysqli_query($connection,"UPDATE divisa SET difdiv = '$difdiv'");
	alert("Divisa configurada.");
	redir("");
}

$s= mysqli_query($connection,"SELECT * FROM divisa");
$r = mysqli_fetch_array($s);
$difdiv = $r['difdiv'];


?>
<form method="post" action="">
<div class="from-group">
$ Dolar Americano
<input type="text" class="form-control" value="<?=$difdiv?>" name="difdiv"/>
<input type="submit" class="btn btn-primary" value="Configurar" name="enviar"/>
</div>
</form>