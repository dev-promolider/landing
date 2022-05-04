Estas saliendo del sistema...
<?php
@session_start(); 
if(isset($_SESSION['nvirtual']))
{

    $referido = isset($_SESSION['referido']) ? $_SESSION['referido'] : "0";
    session_unset();
    session_destroy();

    ?>
    <script type="text/javascript">
    window.location="../<?php echo ($referido != "0") ? '?ref='.$referido : ''; ?>";
    </script>
    <?php

}
else
{
	?>
	<script type="text/javascript">
	window.location="http://promoliderv.org/login.php";
	</script>
	<?php
}

?>