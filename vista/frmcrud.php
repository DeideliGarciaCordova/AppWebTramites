<?php
    include "vga/nav.php";
    include "vga/asider.php";
    include "vga/header.php";
    $tabla = 'cambiar clave ';
    ?>
 
 <section class="content">
     <div class="container-fluid">
         <div class="row">
              <!-- left column -->
             <div class="col-md-7">
                 <!-- general form elements -->
                 <div class="card  <?php echo 'card-' . COLOR_PRINCIPAL; ?>">
                     <div class="card-header">
                         <h3 class="card-title">Registro de <?php echo $tabla; ?></h3>
                         <div class="card-tools">
                             <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                 data-toggle="tooltip" title="Collapse">
                                 <i class="fas fa-minus"></i></button>
                         </div>
                     </div>
                     <!-- /.card-header -->

                     <div class="card-body" >
                         <!-- form start -->
                         <form id="form" class="was-validated">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="txt1">Nombre de clase</label>
                                    <input type="" name="txt1" class="form-control"> 
                                </div>
                                <div class="form-group">
                                    <label for="txt2">Nombre tabla</label>
                                    <input type="" name="txt2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="txt3">Campos</label>
                                    <textarea class="form-control" rows="8" name="txt3"></textarea>
                                </div>
                             
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                          </form>
                     </div>
                     <!-- /.card-body -->
                 </div> 
                 <!-- /.card -->
             </div>
             <!--/.col (left) -->
         </div>
         <!-- /.row -->
     </div><!-- /.container-fluid -->
 </section>
 <!-- /.content -->
 <?php
    include_once "vga/footer.php";
    ?>
     <script src="<?php echo URL ?>/dist/js/sweetalert.min.js"></script>
<script >
    
    $('#form').on('submit', function(e) {
        e.preventDefault();
        var serialize = $(this).serialize();
        $.post("<?php echo URL ?>/crud/generar", serialize, function(data,
            textStatus, jqXHR) {
            if (textStatus == 'success') {
                if (data == "ok") {
                    swal("Datos Registrado!","se genero correctamente", "success");
                    setTimeout(function() {
                       //location.reload();
                    }, 1000);
                } else {
                    swal("Error!!!", "Error al generar los archivos", "error");
                }
            }
            console.log(data);
        });
    });
</script>
 </body>

 </html>