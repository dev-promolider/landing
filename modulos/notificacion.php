<?php
check_conectado();
$id = clear($ver);
$s = mysqli_query($connection,"SELECT * FROM notificaciones WHERE nvirtual = '".$_SESSION['nvirtual']."' AND id = '$ver'");
if(mysqli_num_rows($s)<1){
	redir("./login.php");
}

if(isset($elim) && $elim=="si"){
	mysqli_query($connection,"DELETE FROM notificaciones WHERE id = '$id'");
	alert("Notificación eliminada.");
	redir("./login.php");
}

$r = mysqli_fetch_array($s);

mysqli_query($connection,"UPDATE notificaciones SET visto = 1 WHERE id = '$id'");
?>

<section id="titulito"><?=$r['titulo']?></section>
<section id="contenidito"><?=$r['mensaje']?><br><br><span style="color:#999"><?=fecha_hora($r['fecha'])?></span></section>
<br>
<a href="?p=notificacion&ver=<?=$id?>&elim=si">
<input type="submit" class="btn bg-aqua" value="Eliminar Notificación">
</a>