<?php
$s = mysqli_query($connection,"SELECT * FROM datosdeusuarios");
while($r=mysqli_fetch_array($s)){
	mysqli_query($connection,"INSERT INTO billetera (nvirtual,cant) VALUES ('".$r['nvirtual']."',0)");
}
echo "listo";
?>