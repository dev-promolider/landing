<?php
$_SESSION['cant']="";
?>
                <!-- Main content -->
                <section class="content">
                    <!-- MAILBOX BEGIN -->
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">MENSAJES</h3>
                                            </div>
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="active" onclick="bandeja_entrada();" id="rerecici"><a href="#"><i class="fa fa-inbox"></i> Recibidos
                                                    <?php
                                                    if(mysqli_num_rows(mysqli_query($connection,"SELECT * FROM bandeja_entrada WHERE nvirtual = '".$_SESSION['nvirtual']."' AND estatus = 0"))>0){
                                                        echo "(<span id='cant_no_leidos'>".mysqli_num_rows(mysqli_query($connection,"SELECT * FROM bandeja_entrada WHERE nvirtual = '".$_SESSION['nvirtual']."' AND estatus = 0"))."</span>)";
                                                    }
                                                    ?></a></li>
                                                    <li id="enenvivi" onclick="bandeja_salida();"><a href="#"><i class="fa fa-mail-forward"></i> Enviados</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                           

                                            <div class="table-responsive">
                                                <!-- THE MESSAGES -->
                                                <section id="mostrarmsjs">

                                                <table class="table table-mailbox">
                                                  <tr>
                                                <th colspan="2"><i class="fa fa-user"></i> Emisor</th>
                                                <th><i class="fa fa-file-o"></i> Asunto</th>
                                                <th><i class="fa fa-clock-o"></i> Fecha</th>
                                                </tr>
                                                <?php
                                                $smsj = mysqli_query($connection,"SELECT * FROM bandeja_entrada WHERE nvirtual = '".$_SESSION['nvirtual']."' ORDER BY fecha DESC LIMIT 10");
                                                while($rmsj=mysqli_fetch_array($smsj)){
                                                    ?>

                                                    <?php

                                                    if($rmsj['estatus']==0){
                                                        $rou = "unread";
                                                    }else{
                                                        $rou = "readed";
                                                    }

                                                    if(file_exists("img/avatares/".$rmsj['nvirtualenviado'].".jpg")){
                                                        $avatar = $rmsj['nvirtualenviado'].".jpg";
                                                    }else{
                                                        $avatar = "0.png";
                                                    }
                                                    ?>
                                                     <tr class="<?=$rou?>">
                                                        <td onclick="cargar_mensaje_entrada(<?=$rmsj['id']?>);" class="small-col"><img src="img/avatares/<?=$avatar?>" class="img-circle" style="max-width:20px;" id="agrandarx5"/></td>
                                                        <td onclick="cargar_mensaje_entrada(<?=$rmsj['id']?>);" class="name"><a href="#">
                                                        <?php
                                                        if(nombre_apellido_usuario($rmsj['nvirtualenviado'])==" "){
                                                            echo "Administrador";
                                                        }else{
                                                            echo nombre_apellido_usuario($rmsj['nvirtualenviado']);
                                                        }
                                                        ?>
                                                        </a></td>
                                                        <td onclick="cargar_mensaje_entrada(<?=$rmsj['id']?>);" class="subject"><a href="#"><?=$rmsj['asunto']?></a></td>
                                                        <td onclick="cargar_mensaje_entrada(<?=$rmsj['id']?>);" class="time"><small style="font-size:10px"><li class="fa fa-clock-o"></li> <?=fecha_hora($rmsj['fecha'])?></small></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                                </table>
                                               
                                                </section>
                                                <section id="mm">
                                                <table class="table table-mailbox">
                                                <tr>
                                                 <th align="center">
                                                <center style="cursor:pointer;" id="botonsisimo" onclick="cargarmasmensajes();">
                                                    <span>+</span> <small>Mostrar Mas</small>
                                                </center>
                                                </th>
                                                </tr>
                                                </table>
                                                </section>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                               
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

<?php
                     if(isset($cme)){
                        ?>
                        <script>
                            cargar_mensaje_entrada("<?=$cme?>");
                        </script>
                        <?php
                    }

                    if(isset($em)){
                        ?>
                        <script>
                             enviar_mensaje('<?=$em?>');
                        </script>
                        <?php
                    }
                    ?>