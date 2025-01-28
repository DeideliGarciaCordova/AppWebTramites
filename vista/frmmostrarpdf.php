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
                       
                        <h4 class="col-12 col-lg-8 text-primary">Vista del documento</h4>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </nav>
                    
                    <div class="card-header d-none">
										<div class="row d-flex p-1 justify-content-between align-items-center">
											<h4 class="col-12 col-lg-8 text-primary"></h4>
											<div class="col-12 col-lg-4 text-right">
												
												<a href="<?php echo URL . '/' . $this->archivo ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Recargar</span></a>
											</div>
										</div>
					</div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
              
                    <iframe height="500" class="w-100" src="data:application/pdf;base64,<?php echo base64_encode($archivo) ?>" frameborde="0"></iframe>
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

<?php 
    include "vga/footer.php";
    include "vga/jscrud.php";
?>
<script src="<?php echo URL ?>/dist/js/sweetalert.min.js"></script>


</body>

</html>