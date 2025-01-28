<?php 
include "vga/nav.php"; 
include "vga/asider.php";
include "vga/header.php";
?>
<!-- Main content -->
<style>.swal-overlay {background-color: transparent !important;}.swal-modal {box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;}.modal-backdrop {background-color: #fff;}</style>
<section class="content">
    <div class="row"> 
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <nav class="navbar navbar-light bg-light">
                       
                        <h4 class="col-12 col-lg-8 text-<?php echo COLOR_PRINCIPAL; ?> ">Listado de <?php echo $this->archivo; ?></h4>
                        <div class=" text-right">

                            <a href="<?php echo URL . "/" . $this->archivo ?>" class="btn btn-sm btn-outline-primary btn "><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Recargar</span></a>
                        </div>
                        <div class="card-tools">
                            
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool d-none" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </nav>
                    <div class="card-header ">
						<div class="row d-flex p-1 justify-content-between align-items-center">
                            <form class="inline-form" method="get" action="<?php echo URL.'/'.$this->archivo ?>/rptITSE">
                                <div class="row  align-items-center ">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Desde: </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" id="f1" name="f1"  class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-auto">
                                        <label for="f2" class="col-form-label">Hasta: </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" id="f2" name="f2" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Reporte</button>
                                                    
                                    </div>                
                                    
                                </div>
                            </form>
							
						</div>
					</div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr> 
                                    <th >Nº</th>
                                    <th >Expediente</th>
                                    <th >Solicitante</th>
                                    <th width="100%" >Establecimiento</th>
                                    <th >Dirección</th>
                                    <th > Voucher</th>
                                    <th > Monto</th>
                                    <th > F Inspección</th>
                                    <th > Inspector</th>
                                    <th > Condiciones</th>
                                    <th > Nivel Riesgo</th>
                                     <th ></th>
                                </tr>
                            </thead>
                            <tbody> 
                            </tbody>
                        </table>
                    </div>
                    <!--.responsive-->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card --> 
        </div>
        <!-- /.col --> 
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<div id="resp"></div>
<!-- Modal -->
<form id="idprint"  class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">				
    <div id="frm_num_recivo" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del modal -->
            <div class="modal-content">
                <div class="modal-header <?php echo 'bg-' . COLOR_PRINCIPAL; ?>">
                <h5 class="modal-title" >Recibo</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden"  name="txt0" id="txt0">
                    <div class="form-group">
                        <label class="col-form-label" for="inputSuccess">Numero recibo</label>
                        <input type="text" class="form-control" name="txt1" id="txt1" placeholder="Ingresar ..." required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="inputSuccess">precio</label>
                        <input type="text" class="form-control" name="txt2" id="txt2" placeholder="Ingresar ..." required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php 
    include "vga/footer.php"; 
    include "vga/jscrud.php";
   // include "vga/funcionesjs.php";
?>

<script src="<?php echo URL ?>/dist/js/sweetalert.min.js"></script>

</body>

</html>