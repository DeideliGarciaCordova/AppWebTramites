<?php include_once 'vga/nav.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include_once 'vga/asider.php'; ?>
<style type="text/css">
--content-wrapper{


 
/* Ubicación de la imagen */
 background-image: url(<?php echo URL.'/img/log.png'?>); /* Para dejar la imagen de fondo centrada, vertical y horizontalmente */
  background-position: center center;
   /* Para que la imagen de fondo no se repita */
    background-repeat: no-repeat; 
    /* La imagen se ﬁja en la ventana de visualización para que la altura de la imagen no supere a la del contenido */
     background-attachment:fixed; /* La imagen de fondo se reescala automáticamente con el cambio del ancho de ventana del navegador */ background-size: cover; /* Se muestra un color de fondo mientras se está cargando la imagen de fondo o si hay problemas para cargarla */
    



}


</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper fondo-blur" >
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">

          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                  <h3 class="text-muted text-center">BIENVENIDOS A SISTEMA DE TRAMITES </h3>
                   <h2 class="text-center text-primary" style=" font-family: Helvetica, Arial, sans-serif;text-transform: capitalize;"><?php echo $obj->per_nombre.' '.$obj->per_apellidos;?></h2>
                </div>
            </div>
          </div>
            
        </div>
    </div><!--/. container-fluid -->
  </section>
  

</div>
<!-- /.row -->

<!-- /.row (main row) -->


</section>
<!-- /.content -->
<!-- /.content-wrapper -->
<?php include_once 'vga/footer.php'; ?>
<!-- jQuery -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
</body>
</html>