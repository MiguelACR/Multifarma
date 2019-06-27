<?php
  session_start();

  if(isset($_GET["cerrar_session"]) and $_GET["cerrar_session"]==true){
    session_destroy();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Multi | farma</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="stylesheet" href="Recursos/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Recursos/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="Recursos/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="Recursos/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="Recursos/dist/css/skins/skin-blue.min.css">
  
 <!--<link href="./Recursos/css/base/jquery-ui-1.9.2.custom.css" rel="stylesheet">-->
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body background="Recursos/img/fondo.jpg">
<div class="login-box">
  <div class="login-logo">
    <a href="#" style="color:white"><b>Multi</b>Farma</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Autentiquese para inciar sesión</p>

    <form id="login-form" action="" method="post">
      <div class="form-group has-feedback">
        <input type="type" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
        <span class="form-control-feedback"><i class="fa fa-street-view"></i></span>
      </div>
      <div class="form-group">
      <div class="input-group col-sm-12">
      <input type="password" id="password" name="password" class="form-control" placeholder="Clave">
      <span class="input-group-btn">
      <button class="btn btn-block btn-primary ocultarC" type="button"><i class="fa fa-key"></i></button>  
      </span> 
      </div>                    
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="ingresar" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
        <input type="hidden" value="login" name="accion">
      </div>
    </form>

   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.2/sweetalert2.all.js"></script>
<script src="./Recursos/js/funcionesLogin.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
        $(".ocultarC").mousedown(function(){ 
            $("#password").removeAttr('type');
        });
        $(".ocultarC").mouseup(function(){
            $("#password").attr('type','password');
        });
    $(document).ready(login);
</script>


</body>
</html>