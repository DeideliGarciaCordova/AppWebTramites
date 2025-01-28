<!DOCTYPE html>
<html> 
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>"SISTEMA DE ACTAS"</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL;?>/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo URL;?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL;?>/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


</head>
<style type="text/css">

 #marco{

/* Ubicación de la imagen */

 background-image: url(<?php echo URL.'/img/logo-picot.png'?>); /* Para dejar la imagen de fondo centra{da, vertical y horizontalmente */
  background-position: center center;
   /* Para que la imagen de fondo no se repita */
    background-repeat: no-repeat; 
    /* La imagen se ﬁja en la ventana de visualización para que la altura de la imagen no supere a la del contenido */
     background-attachment:fixed; /* La imagen de fondo se reescala automáticamente con el cambio del ancho de ventana del navegador */ background-size: cover; /* Se muestra un color de fondo mientras se está cargando la imagen de fondo o si hay problemas para cargarla */
    



}
</style>
<body class="hold-transition login-page" id="marco"  >


  <div class="login-box" >
    
   
    <!-- /.login-logo -->
    <div class="card"  >
      <div class="card-body login-card-body">
      <div class="login-logo"  >
      <img class="rounded-circle border border-primary shadow-lg" style="width: 160px;height: 160px;" src="<?php echo URL ?>/img/logo-picota.png" >
      </div>
        <p class="h2 text-center">INICIAR CESION</p>
        <p class="login-box-msg">ACCEDER</p>
        
        <?php
        if(isset($error)){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>'. $error['titulo'] .'</strong> '. $error['texto'].'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
          </div>';
        }
        ?>
      </script>
      <form action="<?php echo URL;?>/stseguridad/login" method="post" >
        <div class="input-group mb-3">
          <input name="usu" type="text" class="form-control" placeholder="Usuario" id="usu">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="pas" type="password" class="form-control" placeholder="Contraseña" id="pas">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="ml-auto col-4">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>      
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo URL;?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URL;?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL;?>/dist/js/adminlte.min.js"></script>


</body>
</html>
