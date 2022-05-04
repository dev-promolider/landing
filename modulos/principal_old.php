 <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        $contpr = 0;
                                        $sppr = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$_SESSION['nvirtual']."' AND pierna = 1");
                                        while($rppr=mysqli_fetch_array($sppr)){
                                            $contpr=$contpr + $rppr['puntos'];
                                        }

                                        echo $contpr.".00";
                                        ?>
                                    </h3>
                                    <p>
                                        Volumen Izquierdo
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="?p=recauda" class="small-box-footer">
                                    Detalles <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                         <?php
                                        $contpr2 = 0;
                                        $sppr2 = mysqli_query($connection,"SELECT * FROM puntos_por_dar WHERE nvirtual = '".$_SESSION['nvirtual']."' AND pierna = 2");
                                        while($rppr2=mysqli_fetch_array($sppr2)){
                                            $contpr2=$contpr2 + $rppr2['puntos'];
                                        }

                                        echo $contpr2.".00";
                                        ?>   
                                    </h3>
                                    <p>
                                        Volumen Derecho
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="./?p=recauda" class="small-box-footer">
                                    Detalles <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?=mysqli_num_rows(mysqli_query($connection,"SELECT * FROM datosdeusuarios WHERE patrocinador = '".$_SESSION['nvirtual']."' AND nvirtual != '".$_SESSION['nvirtual']."'"))?>
                                    </h3>
                                    <p>
                                        Mis Directos
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="?p=arbol" class="small-box-footer">
                                    Ver <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                    <?php
                                    $spb = mysqli_query($connection,"SELECT * FROM billetera WHERE nvirtual = '".$_SESSION['nvirtual']."'");
                                    $rpb = mysqli_fetch_array($spb);
                                    $pb = $rpb['cant'];
                                    ?>
                                        <?=$pb?> <span style="font-size:14px;">$</span>
                                    </h3>
                                    <p>
                                        Billetera
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Detalles <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                         <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                    <?php
                                    $ssf = mysqli_query($connection,"SELECT * FROM saldo_financiero WHERE nvirtual = '".$_SESSION['nvirtual']."'");
                                    $rsf = mysqli_fetch_array($ssf);
                                    $sf = $rsf['saldo'];
                                    ?>
                                        <?=$sf?> <span style="font-size:14px;">$</span>
                                    </h3>
                                    <p>
                                        Saldo Financiero
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bar-chart-o"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Detalles <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->

                         <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        if(pierna($_SESSION['nvirtual'])==1){
                                            ?>
                                                <button class="btn btn-flat btn-primary" onclick="ajustar_pierna(1);" id="btnizquierda">Izquierda</button><button id="btnderecha" onclick="ajustar_pierna(2);" class="btn btn-flat btn-default">Derecha</button>
                                            <?php
                                        }else{
                                            ?>
                                                <button class="btn btn-flat btn-default" onclick="ajustar_pierna(1);" id="btnizquierda">Izquierda</button><button id="btnderecha" onclick="ajustar_pierna(2);" class="btn btn-flat btn-primary">Derecha</button>
                                            <?php
                                        }
                                        ?>
                                    </h3>
                                    <p>
                                        Ajuste de pierna
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cog"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                   &nbsp;
                                </a>
                            </div>
                        </div><!-- ./col -->

                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <section id="box-content-notice"><i class="fa fa-file-text"></i> Noticias</section>
                            <section class="content-notice">
                            <?php
                            $sn = mysqli_query($connection,"SELECT * FROM noticias ORDER BY id_noticia DESC");
                            if(mysqli_num_rows($sn)>0){
                                while($rn=mysqli_fetch_array($sn)){
                                    ?>
                                     <a href="?p=noticia&ver=<?=$rn['id_noticia']?>">
                                    <section class="sep-not">
                                    <table>
                                    <tr>
                                    <th>
                                        <img src="img/administrador.jpg" class="img-circle" style="max-width:50px;"/>
                                     </th>
                                     <th>
                                     &nbsp;
                                     </th>
                                     <th>
                                        <?=$rn['titulo']?><br>
                                        <span style="color:#333"><?=fecha_hora($rn['fecha'])?></span>
                                     </th>
                                     </tr>
                                     </table>
                                    </section>
                                    </a>
                                    <?php
                                }
                            }else{
                                echo "<i>Actualmente no existen noticias</i>";
                            }
                            ?>
                            </section>
                        </div>
                    </div>