<?php
include "../config/conection.php";
check_conectado();
?>
<h3><b>$</b> Solicitud de Fondos</h3><hr>
<form method="post" action="">
<div class="form-group">
<input type="text" class="form-control" name="cant" required placeholder="Cantidad"/>
</div>
<div class="form-group">
<input type="submit" class="btn btn-success" value="Enviar Peticion" name="enviar"/>
</div>
</form>