<?php

$v0 = $v1 = $v2 = $v3 = $v33 = $v4 = $v5 = $v6 = $estado = '';

if (isset($id, $obj)) {
    $title = 'EDITAR ' .strtoupper($this->archivo);

    $v0 = '<input type="hidden" name="txt0" value="' . $id . '">';
    $v1 = htmlentities($obj->idmenu);
    $v2 = htmlentities($obj->sm_nombre);
    $v3 = htmlentities($obj->sm_icono);
    $v4=htmlentities($obj->sm_estado);
    $v5 = htmlentities($obj->sm_control);
    $v6 = htmlentities($obj->sm_orden);

    if ($obj->sm_estado == true) {
        $estado = ' checked=true';
    }
} else {
    $title = 'CREAR ' .strtoupper($this->archivo);
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
                            <select name="txt1" class="form-control w-100" required>
                                <option value="">Seleccionar</option>
                                <?php
                                foreach ($cbomenu as $row) {
                                    $seld = '';
                                    if($row->idmenu == $v1){
                                        $seld = 'selected';
                                    }
                                    echo '<option value="'. $row->idmenu .'" '. $seld .'>'. $row->mnu_nombre .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt2" class="col-sm-2 col-form-label">Sub Menu</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt2" value="<?php echo $v2; ?>" placeholder="Ingrese el submenu">             
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt3" class="col-lg-2 col-form-label">Icono</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt3" value="<?php echo $v3; ?>" placeholder="usar clases fontawesome">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt4" class="col-sm-2 col-form-label">Estado</label>
                        <div class="col-lg-10">
                            <input type="checkbox" class="" name="txt4" <?php echo $estado; ?> />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt5" class="col-sm-2 col-form-label">Controlador</label>
                        <div class=" col-lg-10">
                            <div class="input-group">
                                <input type="text" class="form-control" name="txt5" value="<?php echo $v5; ?>" />
                                             
                            </div>                                   
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt6" class="col-sm-2 col-form-label">Orden</label>
                            <div class=" col-lg-10">
                                <input type="text" class="form-control" name="txt6" value="<?php echo $v6; ?>" />
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