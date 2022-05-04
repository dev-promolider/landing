<?php
if(isset($enviar)){
	$banco = clear($banco);
	$tipo_pago = clear($tipo_pago);
	$numero_proceso = clear($numero_proceso);
	$descripcion = clear($descripcion);
	$monto = clear($monto);

	$suc = mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE nvirtual = '".$_SESSION['nvirtual']."'");
	$ruc = mysqli_fetch_array($suc);

	$patrocinador = $ruc['patrocinador'];

	mysqli_query($connection,"INSERT INTO pagos (nvirtual,patrocinador,descripcion,monto,documento,tipodepago,fechacompra,banco) VALUES ('".$_SESSION['nvirtual']."','$patrocinador','$descripcion','$monto','$numero_proceso','$tipo_pago',NOW(),'$banco')");

	alert("Pago realizado, porfavor espere a que sea autorizado.");
	redir("./");

}
?>
            <form action="" method="post">

                    <div class="form-group">
                   
                   <select class="form-control" required name="banco">
						<option value="">Seleccione el banco</option>
						<?php
						$s = mysqli_query($connection,"SELECT * FROM bancos");
						while($r=mysqli_fetch_array($s)){
							?>
							<option value="<?=$r['id']?>"><?=$r['banco']?></option>
							<?php
						}
						?>
					</select>
					</div>
					
					<div class="form-group">
					<input type="radio" required name="tipo_pago" value="Transferencia"/> Numero de Transferencia &nbsp;
					</div>
					<div class="form-group">
					<input type="radio" required name="tipo_pago" value="Deposito"/> Numero de Voucher
					</div>
					<br>
					<div class="form-group">
					<input required class="form-control" placeholder="Numero de Transferencia / Voucher" name="numero_proceso"/>
					</div>

					<div class="form-group">
					<input required class="form-control" placeholder="Monto" name="monto"/>
					</div>

					<div class="form-group">
					<textarea class="form-control" style="resize:none;height:150px;" required placeholder="Descripcion del pago" name="descripcion"></textarea>
					</div>

					<br><br>


				<center>
					Cancela tu pago vía Paypal <br><br>
					<a href="#"><img src="img/credit/paypal.png"/></a>
				</center>
<br><br>
                   
           
                <div class="footer">                                                               
                    <button type="submit" name="enviar" class="btn bg-aqua btn-block">Realizar Pago</button>
                </div>
            </form>

