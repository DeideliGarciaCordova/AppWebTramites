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
												<button onclick="fn_add(this)" class="btn btn-sm btn-outline-success <?php echo $crear;?>"><i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block"> Nuevo</span></button>
												<a href="<?php echo URL . '/' . $this->archivo ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Recargar</span></a>
											</div>
										</div>
					</div>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr> 
                                    <th width="20">Nº</th>
                                    <th width="200">Acta</th>
                                    <th width="200">Persona</th>
                                    <th width="50">Dni</th>
                                    <th width="50">F Nacimiento</th>
                                    <th width="100"> Fecha</th>
                                    <th width="60"> Precio</th>
                                    <th width="40"> Nº Recibo</th>
                                     <th width="60"></th>
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

<script >

 
function fn_print(e, id) {  
        $("#txt0").val(id);      
      //alert(id);
        var btn = $(e);
        btn.attr('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        var _url = url + '/print/';
        $.get(_url, {
            id: id
        }, function (data, textStatus, jqXHR) {
            if (textStatus == 'success') {
                btn.attr('disabled', false);
                btn.html('<i class="fas fa-print"></i>');
                $('#resp').html(data);
                $('#frm_num_recivo').modal('show');
                var idform = $('#idprint');
                idform.attr('data-action', _url);
                idform.attr('data-method', 'print');
            }
        });
    } ;
   

    $('#idprint').on('submit', function(e) {
        e.preventDefault();
        var nr= $("#txt1").val();
       // alert(nr);
        $.post("<?php echo  URL ?>/actas/vali_numrecibo",{nr:nr}, function(response){       
            if (response != "ok") {

                var serialize = $('#idprint').serialize();
                $.post("<?php echo  URL ?>/actas/print",serialize, function(data){     
                    var json = jQuery.parseJSON(data);
                    if (json.icon == 'success') {                        
                            $('#frm_num_recivo').modal('hide');
                            window.location.href ='<?php echo  URL ?>/actas/mostrarpdf?id='+json.id;

                    }

                    
                });
                    
            }else{
                swal("Error!!!","El numero de recibo ya existe", "error");
            }

            
        });
    });
    
</script>
</body>

</html>