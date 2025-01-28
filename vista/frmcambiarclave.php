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
                         <form id="formcc" class="was-validated">
                             <div class="form-group row">
                                 <label for="txt1" class="col-sm-2 col-form-label">Usuario</label>
                                 <div class=" col-lg-10">
                                     <input type="text" class="form-control w-75" name="txt1"  id="txt1" value="<?php echo $_SESSION["st_usuario"]; ?>"
                                         required />
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="txt2" class="col-lg-2 col-form-label">Clave Actual</label>
                                 <div class="col-lg-10">
                                     <input type="text" class="form-control w-50" name="txt2"  id="txt2" required
                                        />
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="txt2" class="col-lg-2 col-form-label">Clave nueva</label>
                                 <div class="col-lg-10">
                                     <input type="text" class="form-control w-50" name="txt3"  id="txt3" required
                                        " />
                                 </div>
                             </div>
                             <div class="card-footer">
                                 <button type="submit" class="btn btn-primary ">Registrar</button>
                                 <a href="<?php echo URL . '/' . $this->archivo ?>" class="btn  btn-danger"><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Cancelar</span></a>
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
 <script>
$('#formcc').on('submit', function(e) {
    e.preventDefault();
   
    var clave=$("#txt2").val();
    var clavenueva=$("#txt3").val();
    $.post("<?php echo URL ?>/cambiarclave/verificarclave_1y2", {clave:clave}, function(data,textStatus, jqXHR) {
            
       // alert(data);
        if(data=="ok"){
            var serialize = $("#formcc").serialize();
            $.post("<?php echo URL ?>/cambiarclave/listar", serialize, function(response,  textStatus, jqXHR) {
                   // alert(datas);
                   var json = jQuery.parseJSON(response);
                        console.log(json);
                        swal({
                            position: 'top-end',
                            title: json.msj,
                            icon: json.icon,
                            button: {
                                text: "Cerrar",
                                className: "btn btn-secondary btn-sm",
                                closeModal: true,
                            },
                        });
                        setTimeout(function() {
                            window.location.href = "<?php echo URL ?>/salir";
                        }, 1000);
                      

            });

        }else{
            swal({
            title: " Clave  no coincide con la clave actual",
            text: "Ingrese la clave correcta",
            icon: "error",
            buttons: ["No", "Si"],
            dangerMode: true
        }).then((willDelete) => {
                    if (willDelete) {
                        $("#txt2").val("");
                        $("#txt2").focus();
                    }
                });
        }
    });

       
});


 </script>
 </body>

 </html>