<?php
require "../config/conection.php";
$id = clear($id);
$s = mysqli_query($connection,"SELECT * FROM estados WHERE relacion = '$id'");
?>
<select name="estado" class="form-control" required>
<option value="">Seleccione un Estado</option>
<?php
while($r=mysqli_fetch_array($s)){
	?>
	<option value="<?=$r['id']?>"><?=$r['estado']?></option>
	<?php
}
?>
</select>