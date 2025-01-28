<?php 
include "vga/nav.php"; 
include "vga/asider.php";
include "vga/header.php";
?>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css"/>
<style>.swal-overlay {background-color: transparent !important;}.swal-modal {box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;}.modal-backdrop {background-color: #fff;}</style>
<section class="content">
    <div class="row"> 
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                      <form class="form-horizontal" action="<?php echo URL?>/reportelicenciafunc/reporte" method="get">
                        <div class="form-group row">
                          <label for="txt1" class="col-sm-2 col-form-label">Fecha Inicio</label>
                          <div class="col-lg-3">
                            <input type="date" class="form-control w-100" name="txt1" id="txt1"  required />
                          </div>
                          <label for="txt2" class="col-sm-2 col-form-label">Fecha Final</label>
                          <div class=" col-lg-3">
                            <input type="date" class="form-control w-100" name="txt2" id="txt2"  required />
                          </div>
                          <div class="col-lg-2">
                              <div class="btn-group ">
                                <button type="button" class="btn btn-primary " value="r1" onclick="filtrar_fecha(this)"><span class="d-none d-sm-inline-block"> </span> &nbsp;<i class="fas fa-search"></i></button>
                                <button type="submit" class="btn btn-danger " name="valor" value="r1" formtarget="_blank"><span class="d-none d-sm-inline-block"></span> &nbsp;<i class="fas fa-file-pdf"></i></button>
                              </div>
                          </div>
                        </div>
                      </form>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="tbreporte" width="100%" cellspacing="0">
                            <thead>
                                <tr> 
                                  <th>Codigo</th>
                                  <th>Razon Social</th>
                                  <th>Nombre Comercial</th>
                                  <th>Ruc</th>
                                  <th>Dni</th>
                                  <th>Ubicación</th>
                                  <th>Giro de</th>
                                  <th>Area</th>
                                  <th>Horario Atencion</th>
                                  <th>Tipo Licencia</th>
                                  <th>Expediente</th>
                                  <th>F Registro</th>
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
</section>


<div id="resp"></div>

<?php 
    include "vga/footer.php";
    //include "vga/jscrud.php";
?>

<script>



    function filtrar_fecha(e) {

       var table= $('#tbreporte').dataTable().fnDestroy();
            // Iniciamos el DataTable
            var dataTable = $('#tbreporte').DataTable({
           'processing': true, 
            'serverSide': true,
             'paging': true,
            'serverMethod': 'post',
            'searching': true,
            'ordering': false,            
             ajax: {
                'url':'<?php echo URL . '/' ?>reportelicenciafunc/filtrar_x_fecha',
                'data': function(data){
                // Leer valores de fecha
                var txt1 = $('#txt1').val();
                var txt2 = $('#txt2').val();

                // Append to data
                data.f1 = txt1;
                data.f2 = txt2;

                }
            }
        });

           // table.ajax.reload(null, false);

     //dataTable.draw();
    }


    function mostrar_comprobante(e,id) {
        $("#ifrboleta").attr('src','<?php echo URL ?>/ventas/boleta?id='+id)

        $("#ifrticked").attr('src','<?php echo URL ?>/ventas/ticked?id='+id)
        $("#modalcomprobante").modal("show");
    }


    function mostrar_detalle(e,id) {

         
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
                'url':'<?php echo URL . '/' ?>ventas/mostrar_detalle_venta',
                'data': function(data){

                data.id = id;

                }
            }
        });

     //dataTable.draw();
    }




</script>
</body>

</html>