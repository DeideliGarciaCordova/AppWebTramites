<?php 
$vga_tabla = 'cargos';
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
                       
                        <h4 class="col-12 col-lg-8 text-<?php echo COLOR_PRINCIPAL; ?> ">Lista de no inscritos de matrimonio</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </nav>
                    
                    <div class="card-header d-none1">
										<div class="row d-flex p-1 justify-content-between align-items-center">
											<h4 class="col-12 col-lg-8 text-primary"></h4>
											<div class="col-12 col-lg-4 text-right">
												<button onclick="fn_add(this)" class="btn btn-sm btn-outline-success  <?php echo $crear;?>"><i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block"> Nuevo</span></button>
												<a href="<?php echo URL . '/' . $this->archivo ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Recargar</span></a>
											</div>
										</div>
					</div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="20">Nº</th>
                                    <th width="200">Persona</th>
                                    <th width="50">Dni</th>
                                    <th width="50">Casado</th>
                                    <th width="100"> Fecha</th>
                                    <th width="60"></th>
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