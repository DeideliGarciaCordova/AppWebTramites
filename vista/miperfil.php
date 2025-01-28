<?php
    include "vga/nav.php";
    include "vga/asider.php";
    include "vga/header.php";
    $tabla = 'cambiar clave ';
    ?>
 
 <section class="content">
     <div class="container-fluid">
       <div class="row">
          <div class="col-md-3">

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Hacerca de mi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo URL ?>/img/user.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $obj->per_nombre.' '.$obj->per_apellidos;?></h3>

                <p class="text-muted text-center"><?php echo $objperfil->car_nombre;?></p>
                <hr>
                <strong><i class="fas fa-book mr-1"></i> DNI</strong>

                <p class="text-muted">
                  <?php echo $objperfil->per_dni;?>
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>

                <p class="text-muted"><?php echo $objperfil->per_direc;?></p>

                <hr>

                <strong><i class="fas fa-phone-alt mr-1"></i> Telefono</strong>

                <p class="text-muted">                
                  <span class="tag tag-primary"><?php echo $objperfil->per_telefonos;?></span>
                </p>

                <hr>

                <strong><i class="fa-solid fa-envelope"></i> E-Mail</strong>

                <p class="text-muted"><?php echo $objperfil->per_mail;?></p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">
                  
                  <div class=" active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-warning">
                          Información General
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user-pen bg-success"></i>

                        <div class="timeline-item">
                        

                          <h3 class="timeline-header">Datos de Usuario</h3>

                          <div class="timeline-body">
                            <form id="form"  class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" name="txt0" value="<?php echo $objperfil->idpersonal;?>">
                                <div class="form-group row">
                                    <label for="txt3" class="col-lg-2 col-form-label">Dni</label>
                                    <div class=" col-lg-4">
                                        <input type="text" class="form-control" id="txt3" name="txt3" value="<?php echo $objperfil->per_dni;?>" placeholder="Ingrese DNI" maxlength="8" required="">
                                    </div>
                                
                                </div>
                                <div class="form-group row">
                                    <label for="txt7" class="col-sm-2 col-form-label">Cargos</label>
                                    <div class=" col-lg-10">
                                        <input type="hidden" name="txt7"  id="txt7"  value="<?php echo $objperfil->idcargo;?>" >
                                       <input type="text" readonly class="form-control"  value="<?php echo $objperfil->car_nombre;?>"  required="" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txt1" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class=" col-lg-10">
                                        <input type="text" class="form-control" id="txt1" name="txt1" value="<?php echo $objperfil->per_nombre;?>" placeholder="Ingrese el Nombre" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="txt2" class="col-sm-2 col-form-label">Apellidos</label>
                                    <div class=" col-lg-10">
                                        <input type="text" class="form-control" id="txt2" name="txt2" value="<?php echo $objperfil->per_apellidos;?>" placeholder="Ingrese los apellidos" required="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="txt4" class="col-sm-2 col-form-label">Direccion</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="txt4" name="txt4" placeholder="Ingrese Direccion" required="" value="<?php echo $objperfil->per_direc;?>" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txt5" class="col-sm-2 col-form-label">E_Mail</label>
                                    <div class=" col-lg-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="txt5" placeholder="Ingrese E-Mail" required="" value="<?php echo $objperfil->per_mail;?>" />
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="txt6" class="col-sm-2 col-form-label">Telefono</label>
                                    <div class=" col-lg-10">
                                        <input type="text" class="form-control" name="txt6" style="width: 160px" placeholder="Ingrese Telefono" value="<?php echo $objperfil->per_telefonos;?>" />
                                    </div>
                                </div>
                                <div class="timeline-footer">
                                    <button type="submit" class="btn btn-primary btn-sm" >Guardar</button>
                                    <a href="<?php echo URL.'/'.$this->archivo; ?>" class="btn btn-danger btn-sm">Cancelar</a>
                                </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-circle bg-gray"></i>
                      </div>
                    </div>
                  </div>
                 
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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


$('#form').on('submit', function(e) {
    e.preventDefault();
    var serialize = $(this).serialize();
    $.post("<?php echo URL.'/'.$this->archivo ?>/edi", serialize, function(data,
        textStatus, jqXHR) {
        var json = jQuery.parseJSON(data);
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
        console.log(data);
    });
});

 </script>
 </body>

 </html>