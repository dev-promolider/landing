<?php
include "../config/conection.php";
$s = mysqli_query($connection,"SELECT * FROM bandeja_entrada WHERE nvirtual = '".$_SESSION['nvirtual']."' AND estatus = 0");
$cant = mysqli_num_rows($s);
echo $cant;
?>