<?php

$v0 = $v1 = $v2 = $v3 = $v33 = $v4 = $v5 = $v6 = $estado = '';

if (isset($id, $obj)) {
    $title = 'EDITAR  ' . strtoupper($this->archivo); 

    $v0 = '<input type="hidden" name="txt0" value="' . $id . '">';
    $v1 = htmlentities($obj->mnu_nombre);
    $v2 = htmlentities($obj->mnu_icono);
    //$v3=htmlentities($obj->mnu_estado);
    $v4 = htmlentities($obj->mnu_control);
    $v5 = htmlentities($obj->mnu_orden);

    if ($obj->mnu_estado == true) {
        $estado = ' checked=true';
    }
} else {
    $title = 'CREAR '.strtoupper($this->archivo); 
}

?>

<form id="idForm" onsubmit="return fn_submit(this)" class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
    <div class="modal fade" id="modalForm" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg " role="document">
            <div class="modal-content border-0 rounded-0 shadow-lg">
                <div class="modal-header border-0 rounded-0  text-white <?php echo 'bg-' . COLOR_PRINCIPAL; ?> " style="cursor: move">
                    <h5 class="modal-title" id="modalForm"><?php echo $title ?> </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>                                    
                </div>
                <div class="modal-body">
                    <?php echo $v0 ?>

                    <div class="form-group row">
                        <label for="txt1" class="col-sm-2 col-form-label">Menu</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt1" value="<?php echo $v1; ?>" placeholder="Ingrese el menu">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt2" class="col-lg-2 col-form-label">Icono</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt2" value="<?php echo $v2; ?>" placeholder="usar clases fontawesome">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt3" class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-lg-10">
                            <input type="checkbox" class="" name="txt3" <?php echo $estado; ?> />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt4" class="col-sm-2 col-form-label">Controlador</label>
                        <div class=" col-lg-10">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txt4" value="<?php echo $v4; ?>" />
                            </div>
                                     <!-- /.input group -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt5" class="col-sm-2 col-form-label">Orden</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" id="" name="txt5" value="<?php echo $v5; ?>" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>