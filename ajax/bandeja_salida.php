<?php
include "../config/conection.php";
$_SESSION['cant']="";
?>
 <table class="table table-mailbox">
                                                <tr>
                                                <th colspan="2"><i class="fa fa-user"/> Receptor</th>
                                                <th><i class="fa fa-file-o"></i> Asunto</th>
                                                <th><i class="fa fa-clock-o"></i> Fecha</th>
                                                </tr>
<?php
                                                $smsj = mysqli_query($connection,"SELECT * FROM bandeja_salida WHERE nvirtualenviado = '".$_SESSION['nvirtual']."' ORDER BY fecha DESC LIMIT 10");
                                                while($rmsj=mysqli_fetch_array($smsj)){
                                                    ?>

                                               
                                                    <?php

                                                    $rou = "readed";
                                           

                                                    if(file_exists("img/avatares/".$rmsj['nvirtualenviado'].".jpg")){
                                                        $avatar = $rmsj['nvirtualenviado'].".jpg";
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
                                                        <td onclick="cargar_mensaje_salida(<?=$rmsj['id']?>);" class="time"><small style="font-size:10px"><li class="fa fa-clock-o"></li> <?=fecha_hora($rmsj['fecha'])?></small></td>
                                                    </tr>

                                                    <?php
                                                }
                                                ?>

                                                </table>