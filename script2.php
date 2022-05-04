<?php
include "config/conection.php";
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios");
while($r=mysqli_fetch_array($s)){
	mysqli_query($connection,"INSERT INTO saldo_financiero (nvirtual,saldo) VALUES ('".$r['nvirtual']."',0)");
}
echo "Listo.";
?>