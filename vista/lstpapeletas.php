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
                    <form class="form-horizontal" action="<?php echo URL?>/reportelicenciafunc/reporte" method="get">
                        <div class="form-group row">
                          <label for="txt1" class="col-sm-1 col-form-label">Fecha Inicio</label>
                          <div class="col-lg-3">
                            <input type="date" class="form-control w-100" name="txt1" id="txt1"  required />
                          </div>
                          <label for="txt2" class="col-sm-1 col-form-label">Fecha Final</label>
                          <div class=" col-lg-3">
                            <input type="date" class="form-control w-100" name="txt2" id="txt2"  required />
                          </div>
                          <div class="col-lg-4">
                              <div class="btn-group ">
                                <button type="button" class="btn btn-primary  " value="r1" onclick="filtrar_fecha(this)"><i class="fa fa-search"></i> <span class="d-none d-sm-inline-block"> Buscar</span></button>
                                <button onclick="fn_add(this)" class="btn     btn-outline-success <?php echo $crear;?>"><i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block"> Nuevo</span></button>
                            <a href="<?php echo URL . "/" . $this->archivo ?>" class="btn  btn-outline-primary btn "><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Recargar</span></a>
                            </div>
                          </div>
                        </div>
                      </form>
                   
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NOMBRES Y APELLIDOS</th>
                                    <th>DEPENDENCIA</th>
                                    <th>FECHA/HORA SALIDA</th>
                                    <th>FECHA/HORA RETORNO</th>
                                    <th>DESTINO</th>
                                    <th>MOTIVO SALIDA</th>
                                    <th>FUNDAMENTACION</th>

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

<script>



    function filtrar_fecha(e) {

       var table= $('#dataTable').dataTable().fnDestroy();
            // Iniciamos el DataTable
            var dataTable = $('#dataTable').DataTable({
           'processing': true, 
            'serverSide': true,
             'paging': true,
            'serverMethod': 'post',
            'searching': true,
            'ordering': false,            
             ajax: {
                'url':'<?php echo URL . '/' ?>papeletas/filtrar_x_fecha',
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



</script>

</body>

</html>