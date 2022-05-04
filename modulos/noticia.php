<?php
check_conectado();
$ver = clear($ver);
$s = mysqli_query($connection,"SELECT * FROM noticias WHERE id = '$ver'");
$r = mysqli_fetch_array($s);
?>