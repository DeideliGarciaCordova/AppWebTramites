<?php 
include "vga/nav.php"; 
include "vga/asider.php";
include "vga/header.php";
?>
<!-- Main content -->
<style>
.swal-overlay {
    background-color: transparent !important;
}

.swal-modal {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
}

.modal-backdrop {
    background-color: #fff;
}
</style>
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
                            <form class="inline-form" method="get" action="<?php echo URL.'/'.$this->archivo ?>/rptactas">
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
                                        <label for="f2" class="col-form-label">Tipo Acta: </label>
                                    </div>
                                    <div class="col-auto">

                                    <select name="txt1" class="form-control form-control-sm">
                                            <option value="">Seleccionar</option>
                                            <?php
                                            foreach ($comb_ta as $row) {
                                                $seld = '';
                                                if($row->idtipoacta == $v1){
                                                    $seld = 'selected';
                                                }
                                                echo '<option value="'. $row->idtipoacta .'" '. $seld .'>'. $row->ta_nombre .'</option>';
                                            }
                                            ?>
                                        </select>              
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
                                    <th width="20">N°</th>
                                    <th width="150">Tipo Acta</th>
                                    <th width="200">Persona</th>
                                    <th width="50">Dni</th>
                                    <th width="50">Fecha Nacimiento</th>
                                    <th width="120">Fecha</th>
                                    <th width="50">Precio</th>
                                    <th width="40"> Num Recivo</th>

                                </tr>
                            </thead>



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


<?php 
    include "vga/footer.php";
    include "vga/jscrud.php";
?>
<script src="<?php echo URL ?>/dist/js/sweetalert.min.js"></script>


</body>

</html>