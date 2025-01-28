<?php
include_once './model/model.stseguridad.php';
$vga_permisos = new Modelstseguridad();
$obj= $vga_permisos->ver_informacion_personal();


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>"SISTEMA DE ACTAS"</title>
    <link  rel="shortcut icon" href="<?php echo URL.'/img/logo.png'?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo URL ?>/plugins/fontawasome/fontawesome-6.4.0/css/all.css">
     <link rel="stylesheet" href="<?php echo URL ?>/plugins/fontawasome/fontawesome-6.4.0/css/all.min.css">
  
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4-->
    <link rel="stylesheet"
    href="<?php echo URL ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo URL ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo URL ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style-->
    <link rel="stylesheet" href="<?php echo URL ?>/dist/css/adminlte.min.css">
    <!-- Theme style
    <link rel="stylesheet" href="<?php echo URL ?>/plugins/bootstrap/css/bootstrap.min.css">-->
    <!-- summernote-->
    <link rel="stylesheet" href="<?php echo URL ?>/plugins/summernote/summernote-bs4.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo URL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL ?>/plugins/auto/jqueryui-autocomplete-bootstrap.css">

    <link rel="stylesheet" href="<?php echo URL ?>/plugins/toastr/toastr.min.css">
    <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo URL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo URL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo URL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
    
    <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo URL ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo URL ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->

   <!-- fullCalendar
   <link rel="stylesheet" href="<?php echo URL ?>/plugins/fullcalendar//css/styles.css">-->
<link rel='stylesheet' type='text/css' href='<?php echo URL ?>/plugins/fullcalendar/css/fullcalendar.css' /> 
    <style>
    .bs-autocomplete-menu{
        position: absolute;
        -ms-flex-direction: column!important;
        flex-direction: column!important;
        height: 10rem;
        width:100%;
        overflow-x: hidden;
        overflow-y: auto;
        z-index: 9999;
        background-color: #fff !important;
    }
    .ui-menu-item{
        display:block;
        width:100%;
    }
    .nav-pillsbs-autocomplete-menu .ui-menu-item-wrapper{
        display: block;
        padding: .5rem 1rem;
        cursor:pointer;
        border: 1px solid #ddd;
    }
    
    
    /* adaptar la columa a la longiud del texto en la datatable*/
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        margin: 0 auto;
    }
 
    div.container {
        width: 80%;
    }
</style>
</head>

<body class="hold-transition sidebar-mini ">
    <div class="wrapper" >
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark <?php echo 'bg-'.COLOR_PRINCIPAL; ?>  " >
            <!-- Left navbar links -->
            <ul class="navbar-nav " style="color: red;" >
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo URL; ?>" class="nav-link"><h4>Inicio</h4></a>
                </li>
<!--                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link"><?php //echo $_SESSION['vga_isadmin']; ?></a>
                </li>-->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->          
                <li class="nav-item dropdown">
                    <button class="btn" style="background-color:transparent;border: solid transparent 0px" data-toggle="dropdown">
                         <img src="<?php echo URL ?>/img/user.png" alt="user" class="rounded-circle" width="36">
                        <span class="ms-2 font-weight-medium"><?php echo $_SESSION['st_usuario']?></span><span class="fas fa-angle-down ms-2"></span>
                    </button>

                    
                    <!--<a class="btn text-white" data-toggle="dropdown" href="#">
                        <i class="fa-sharp fa-solid fa-camera-retro fa-2x"></i>
                    </a>-->

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right  animated flipInY ">
                             <div class="d-flex d-inline align-items-center p-3 text-white mb-2 bg-danger" >
                                <div class="mr-2">
                                    <i class="fa-solid fa-user-tie fa-2x" style="color: #fff;"></i>
                                </div>
                                <div class="ms-2">
                                      <h4 class="mb-0 text-white"><?php echo $obj->per_nombre.' '.$obj->per_apellidos;?></h4>
                                      <p class="mb-0"><?php echo $obj->per_mail;?></p>
                                    </div>
                            </div>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo URL.'/miperfil'; ?>" class="dropdown-item">
                            <i class="fa-solid fa-face-grin-wide" style="color: #f48a10;"></i> Mi perfil
                            <span class="float-right text-muted text-sm">
                            </span> </a> <div class="dropdown-divider">
                            </div>
                             <a href="<?php echo URL.'/cambiarclave'; ?>" class="dropdown-item">
                           <i class="fa-solid fa-key" style="color: #54cc28;"></i> Cambiar Contraseña
                            <span class="float-right text-muted text-sm">
                            </span> </a> <div class="dropdown-divider">
                            </div>
                            <div class="dropdown-divider">
                            </div>
                            <a href="<?php echo URL . '/salir' ?>" class="dropdown-item">
                               <i class="fa-solid fa-arrow-right-from-bracket" style="color: #db0f24;"></i> Cerrar sesión 
                                <span class="float-right text-muted text-sm">
                                </span> </a>
                                 <div class="dropdown-divider">
                                </div>
                        <a href="#" class="dropdown-item dropdown-footer text-white bg-danger" >MUNICIPALIDAD-PICOTA</a>
                    </div>
                </li>
                
            </ul>
        </nav>

        
                <!-- /.navbar -->