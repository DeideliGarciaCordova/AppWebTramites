<?php

$v0 = $v1 = $v2 = $v3 = $v33 = $v4 = $v5 = $v6 = $estado = '';

if (isset($id, $obj)) {
    $title = 'EDITAR ' .strtoupper($this->archivo);

    $v0 = '<input type="hidden" name="txt0" value="' . $id . '">';
    $v1 = htmlentities($obj->per_nombre);
    $v2 = htmlentities($obj->per_apellidos);
    $v3=htmlentities($obj->per_dni);
    $v4 = htmlentities($obj->per_direc);
    $v5=htmlentities($obj->per_mail);
    $v6 = htmlentities($obj->per_telefonos);
    $v7 = htmlentities($obj->idcargo);
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
                                <label for="txt3" class="col-lg-2 col-form-label">Dni</label>
                                <div class=" col-lg-4">
                                    <input type="text" class="form-control" id="txt3" name="txt3" value="<?php echo $v3; ?>" placeholder="Ingrese DNI" maxlength="8" required="">
                                </div>
                                <div class="col-lg-1 d-none">
                                    <button id="verdni" type="buttom" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt7" class="col-sm-2 col-form-label">Cargos</label>
                                <div class=" col-lg-10">
                                    <select name="txt7" class="form-control w-100" required="">
                                        <option value="">Seleccionar</option>
                                        <?php
                                        foreach ($cbocarg as $row) {
                                            $seld = '';
                                            if ($row->idcargo == $v7) {
                                                $seld = 'selected';
                                            }
                                            echo '<option value="' . $row->idcargo . '" ' . $seld . '>' . $row->car_nombre . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt1" class="col-sm-2 col-form-label">Nombre</label>
                                <div class=" col-lg-10">
                                    <input type="text" class="form-control" id="txt1" name="txt1" value="<?php echo $v1; ?>" placeholder="Ingrese el Nombre" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txt2" class="col-sm-2 col-form-label">Apellidos</label>
                                <div class=" col-lg-10">
                                    <input type="text" class="form-control" id="txt2" name="txt2" value="<?php echo $v2; ?>" placeholder="Ingrese los apellidos" required="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txt4" class="col-sm-2 col-form-label">Direccion</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="txt4" name="txt4" placeholder="Ingrese Direccion" required="" value="<?php echo $v4; ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt5" class="col-sm-2 col-form-label">E_Mail</label>
                                <div class=" col-lg-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="txt5" placeholder="Ingrese E-Mail" required="" value="<?php echo $v5; ?>" />
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt6" class="col-sm-2 col-form-label">Telefono</label>
                                <div class=" col-lg-10">
                                    <input type="text" class="form-control" name="txt6" style="width: 160px" placeholder="Ingrese Telefono" value="<?php echo $v6; ?>" />
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