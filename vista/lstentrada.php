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
                                   <!-- <th>Id</th>-->
                                    <th>Usuario</th>
                                    <th>Comprobante</th>
                                    <th>Num Comprobante</th>
                                    <th>Total</th>
                                    <th>Fecha</th>

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


 <!--Modal detalle--> 
 <div class="modal fade" id="modaldetalle" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="modaldetalle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl " role="document">
        <div class="modal-content border-0 rounded-0 shadow-xl">
            <div class="modal-header border-0 rounded-0 d-none  " style="cursor: move">
                <h5 class="modal-title" id="modaldetalle">Detalle de ventas </h5>
                <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                                    
            </div>
            <div class="modal-body">
                <div class="row "> 
                  <div class="col-md-12 col-lg-12" >  
                      <div class="card material-card "> 
                        <div class="card-body">                      
                      
                                <div class="form-group row">
                                    <label for="txt1" class="col-sm-2 col-form-label">Tipo Comprobante</label>
                                    <div class=" col-lg-4">
                                            <input type="text" class="form-control w-100" name="txt1" id="txt1"  readonly />
                                    </div>
                            
                                    <label for="txt2" class="col-sm-2 col-form-label">Cod Comprobante</label>
                                    <div class=" col-lg-4">
                                        <input type="text" class="form-control w-100" name="txt2" id="txt2"  readonly />
                                    </div>
                                </div>							

                               
                                                              
                           <br>      
                          <div class="row">
                            <div class="table-responsive">
                                  <table class="table table-bordered  table-sm" id="tbdetalles">
                                    <thead>
                                      <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th  style="text-align: right;">Total</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                    
                                    </tbody>
                                  </table>
                                  <hr>
                              
                                  <div class="no-block " >
                                    <label  class="ml-2 mb-0">Importe Total :</label>
                                     <div class="float-right mr-2 mb-0">
                                      <h5 id="h5importe_total" class="mb-0">0.00</h5><input type="hidden" name="importe_total" id="importe_total" class="">
                                    </div>
                                  </div>
                                </div>
                          </div>
                        </div>
                      </div>                            
                  </div> 
            </div>
            <div class="modal-footer border-0 bg-light">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
                  
            </div>                                 
        </div>
    </div>
  </div>

<?php 
    include "vga/footer.php";
    include "vga/jscrud.php";
?>
<script src="<?php echo URL ?>/dist/js/sweetalert.min.js"></script>

<script>

function mostrar_detalle(e,id) {
    
    //alert(id);exit;
    mostrar_entrada(id);
    $("#modaldetalle").modal("show");
     
    $('#tbdetalles').dataTable().fnDestroy();
        // Iniciamos el DataTable
        var dataTable = $('#tbdetalles').DataTable({
        'info': false,

       'processing': true, 
        'serverSide': true,
         'paging': false,
        'serverMethod': 'post',
        'searching': false,
        'ordering': false,
        language: {
                "lengthMenu": "Mostrar _MENU_ ",
                "zeroRecords": "Datos no encontrados.",
                "info": "Pagina _PAGE_ de _PAGES_",
                "infoEmpty": "No hay datos disponibles",
                "infoFiltered": "(filtrado de _MAX_ datos totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        ajax: {
            'url':'<?php echo URL . '/' ?>entrada/mostrar_detalle_entrada',
            'data': function(data){
                //console.log(data);exit;
            data.id = id;

            }
        }
    });
}



function mostrar_entrada(id){
           $.post( "<?php echo URL . '/entrada/mostrar_entrada'; ?>",{id:id}, function(data){
             var json=jQuery.parseJSON(data);

           $("#txt1").val(json.tc_nombre);
            $("#txt2").val(json.ent_numcomprobante);
                        
            $("#h5importe_total").html(json.ent_total);
           
          
          });
    }

</script>
</body>

</html>