<?php 
include "vga/nav.php"; 
include "vga/asider.php";
include "vga/header.php";
?>


<style>.swal-overlay {background-color: transparent !important;}.swal-modal {box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;}.modal-backdrop {background-color: #fff;}</style>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"> 
                   <nav class="navbar navbar-light bg-light">
                       
                        <h4 class="col-12 col-lg-8 text-<?php echo COLOR_PRINCIPAL; ?> ">Listado de <?php echo $this->archivo; ?></h4>
                        <div class=" text-right">
                            <button onclick="fn_add(this)" class="btn   btn btn-sm btn-outline-success <?php echo $crear;?>"><i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block"> Nuevo</span></button>
                            <a href="<?php echo URL . "/" . $this->archivo ?>" class="btn btn-sm btn-outline-primary btn "><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Recargar</span></a>
                        </div>
                        <div class="card-tools">
                            
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool d-none" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </nav>
                    
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                   <th>idsolicituditse</th><th>idusuario</th><th>idanio</th><th>idtipofuncion</th><th>idnivelriesgo</th><th>idtiposolicitante</th><th>si_area</th><th>si_numeropisos</th><th>si_pisoestablecimiento</th><th>si_nombresapellidos</th><th>si_dni</th><th>si_domicilio</th><th>si_correosolicitante</th><th>si_telefonosolicitante</th><th>si_razonsocial</th><th>si_ruc</th><th>si_nombrecomercial</th><th>si_telefonoestablecimiento</th><th>si_ubicacion</th><th>si_referenciadirección</th><th>si_localidad</th><th>si_distrito</th><th>si_provincia</th><th>si_departamento</th><th>si_giro</th><th>si_horarioatencion</th><th>si_numexpediente</th>
                                   <th ></th>
                                </tr>
                            </thead>
                            
                               
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="resp"></div>

<?php 
    include "vga/footer.php";
    include "vga/jscrud.php";
?>
<script src="<?php echo URL ?>/dist/js/sweetalert.min.js"></script>


</body>

</html>