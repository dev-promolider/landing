<?php
include "config/conection.php";
$s = mysqli_query($connection,"SELECT * FROM calificados WHERE nvirtual = '".$_SESSION['nvirtual']."'");
$r = mysqli_fetch_array($s);
$avatar = avatar($_SESSION['nvirtual']);
?>
<title>PROMOLIDER INTERACIONAL</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta charset='utf-8'/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="css/sahum.css" rel="stylesheet" type="text/css" />
                <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
         <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <script src="js/promolid.js" type="text/javascript"></script>     

<div id="lasteventimg">
<ul>
<img data-toggle="tooltip" data-placement="bottom" title="<?=nombre_apellido_usuario($_SESSION['nvirtual'])?>" src="img/avatares/<?=$avatar?>" class="img-circle" style="width:150px;height:150px;" id="prop"/>
<br><br>
<li><section style="display:inline-block;width:170px;">&nbsp;</section></li>
<?php
$s2 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$_SESSION['nvirtual']."'");
while($r2=mysqli_fetch_array($s2)){
	$avatar2  = avatar($r2['nvirtual']);
	?>
			<li><a href="#"><img onclick="ver_user_arbol('<?=$r2['nvirtual']?>');" src="img/avatares/<?=$avatar2?>" class="img-circle" style="width:100px;height:100px;" data-toggle="tooltip" data-placement="top" title="<?=nombre_apellido_usuario($r2['nvirtual'])?> [1er Nivel]"/></a></li>
	<?php
	$s3 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r2['nvirtual']."'");
	while($r3=mysqli_fetch_array($s3)){
		$avatar3 = avatar($r3['nvirtual']);
		?>
		
		<li><a href="#"><img onclick="ver_user_arbol('<?=$r3['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar3?>" class="img-circle" style="width:80px;height:80px;position:relative;top:100px;" title="<?=nombre_apellido_usuario($r3['nvirtual'])?> [2do Nivel]"/></a></li>
		<?php
		$s4 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r3['nvirtual']."'");
		while($r4=mysqli_fetch_array($s4)){
			$avatar4 = avatar($r4['nvirtual']);
			?>
			<li><a href="#"><img onclick="ver_user_arbol('<?=$r4['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar4?>" class="img-circle" style="width:70px;height:70px;position:relative;top:200px;" title="<?=nombre_apellido_usuario($r4['nvirtual'])?> [3er Nivel]"/></a></li>
			<?php
		$s5 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r4['nvirtual']."'");
		while($r5=mysqli_fetch_array($s5)){
			$avatar5 = avatar($r5['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r5['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar5?>" class="img-circle" style="width:60px;height:60px;position:relative;top:300px;" title="<?=nombre_apellido_usuario($r5['nvirtual'])?> [4to Nivel]"/></a></li>
			<?php
		$s6 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r5['nvirtual']."'");
		while($r6=mysqli_fetch_array($s6)){
			$avatar6 = avatar($r6['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r6['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar6?>" class="img-circle" style="width:50px;height:50px;position:relative;top:400px;" title="<?=nombre_apellido_usuario($r6['nvirtual'])?> [5to Nivel]"/></a></li>
			<?php
		$s7 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r6['nvirtual']."'");
		while($r7=mysqli_fetch_array($s7)){
			$avatar7 = avatar($r7['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r7['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar7?>" class="img-circle" style="width:45px;height:45px;position:relative;top:500px;" title="<?=nombre_apellido_usuario($r7['nvirtual'])?> [6to Nivel]"/></a></li>
			<?php
		$s8 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r7['nvirtual']."'");
		while($r8=mysqli_fetch_array($s8)){
			$avatar8 = avatar($r8['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r8['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar8?>" class="img-circle" style="width:40px;height:40px;position:relative;top:600px;" title="<?=nombre_apellido_usuario($r8['nvirtual'])?> [7mo Nivel]"/></a></li>
				<?php
		$s9 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r8['nvirtual']."'");
		while($r9=mysqli_fetch_array($s9)){
			$avatar9 = avatar($r9['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r9['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar9?>" class="img-circle" style="width:35px;height:35px;position:relative;top:700px;" title="<?=nombre_apellido_usuario($r9['nvirtual'])?> [8vo Nivel]"/></a></li>
		<?php
		$s10 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r9['nvirtual']."'");
		while($r10=mysqli_fetch_array($s10)){
			$avatar10 = avatar($r10['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r10['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar10?>" class="img-circle" style="width:30px;height:30px;position:relative;top:800px;" title="<?=nombre_apellido_usuario($r10['nvirtual'])?> [9no Nivel]"/></a></li>
				<?php
		$s11 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r10['nvirtual']."'");
		while($r11=mysqli_fetch_array($s11)){
			$avatar11 = avatar($r11['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r11['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar11?>" class="img-circle" style="width:25px;height:25px;position:relative;top:900px;" title="<?=nombre_apellido_usuario($r11['nvirtual'])?> [10mo Nivel]"/></a></li>
				<?php
		$s12 = mysqli_query($connection,"SELECT * FROM calificados WHERE patrocinador = '".$r11['nvirtual']."'");
		while($r12=mysqli_fetch_array($s12)){
			$avatar12 = avatar($r12['nvirtual']);
			?>
				<li><a href="#"><img onclick="ver_user_arbol('<?=$r12['nvirtual']?>');" data-toggle="tooltip" data-placement="top" src="img/avatares/<?=$avatar12?>" class="img-circle" style="width:20px;height:20px;position:relative;top:1000px;" title="<?=nombre_apellido_usuario($r12['nvirtual'])?> [11vo Nivel]"/></a></li>
				<?php
		}
		}
		}
		}
		}
		}
		
		
		}
		}
		}
	}
}
?>
<center>
</ul>
</div>


<style>
#lasteventimg {width:100%;overflow-x:scroll;overflow-y:hidden;height:1300px;}
ul {list-style:none; display:block;white-space:nowrap;}
li {width: 100px;display:inline;}
ul li img{
transition:.5s;
}
ul li img:hover{
	transform:rotate(360deg);
}
#prop{
transition:.5s;
}

#prop:hover{
transform:scale(1.1);
}
</style>

<section id="cajafixed">
<section id="xcajafixed"></section>
</section>
<section id="bgx"></section>
<section id="ajax-loader"></section>