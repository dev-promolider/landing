<?php
if(!isset($_SESSION['cant']) || $_SESSION['cant']==""){
	$_SESSION['cant']="10";
}else{
	$_SESSION['cant'] = $_SESSION['cant']+10;	
}
$cant = $_SESSION['cant'];
require "../config/conection.php";

 $smsj = mysqli_query($connection,"SELECT * FROM bandeja_salida WHERE nvirtualenviado = '".$_SESSION['nvirtual']."' ORDER BY fecha DESC LIMIT $cant,10");
                                                while($rmsj=mysqli_fetch_array($smsj)){
                                                    ?>

                                                <table class="table table-mailbox">
                                                    <?php

                                                        $rou = "readed";
                                                    

                                                    if(file_exists("img/avatares/".$rmsj['nvirtual'].".jpg")){
                                                        $avatar = $rmsj['nvirtual'].".jpg";
                                                    }else{
                                                        $avatar = "0.png";
                                                    }
                                                    ?>
                                                     <tr class="<?=$rou?>">
                                                        <td onclick="cargar_mensaje_salida(<?=$rmsj['id']?>);" class="small-col"><img src="img/avatares/<?=$avatar?>" class="img-circle" style="max-width:20px;" id="agrandarx5"/></td>
                                                        <td onclick="cargar_mensaje_salida(<?=$rmsj['id']?>);" class="name"><a href="#">
                                                        <?php
                                                        if(nombre_apellido_usuario($rmsj['nvirtual'])==" "){
                                                            echo "Administrador";
                                                        }else{
                                                            echo nombre_apellido_usuario($rmsj['nvirtual']);
                                                        }
                                                        ?>
                                                        </a></td>
                                                        <td onclick="cargar_mensaje_salida(<?=$rmsj['id']?>);" class="subject"><a href="#"><?=$rmsj['asunto']?></a></td>
                                                        <td onclick="cargar_mensaje_salida(<?=$rmsj['id']?>);" class="time"><small><li class="fa fa-clock-o"></li> <?=fecha_hora($rmsj['fecha'])?></small></td>
                                                    </tr>
                                                    
                                                </table>
                                                    <?php
                                                }
                                                ?>