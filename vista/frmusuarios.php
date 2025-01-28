<?php

$v0 = $v1 =$v2 =$estado=$btnrc='';

if (isset($id, $obj)) {
    $title = 'EDITAR  ' . strtoupper($this->archivo); 

    $v0 = '<input type="hidden" name="txt0" id="txt0"  value="' . $id . '">';
    $v1 = htmlentities($obj->idpersonal);
    $v2 = htmlentities($obj->usu_nombre);
    $v3 = htmlentities($obj->usu_pass);
   if($obj->usu_estado==true){$estado='checked';}
} else {
    $title = 'CREAR '.strtoupper($this->archivo); 
    $btnrc='d-none';
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
                                 <label for="txt1" class="col-sm-3 col-form-label">Personal</label>
                                 <div class=" col-lg-9">
                                     <select name="txt1" id="txt1" class="form-control   w-100" required>
                                        <option value="">Seleccionar</option>
                                        <?php
                                        foreach ($cbomenu as $row) {
                                            $seld = '';
                                            if($row->idpersonal == $v1){
                                                $seld = 'selected';
                                            }
                                            echo '<option value="'. $row->idpersonal .'" '. $seld .'>'. $row->per_apellidos . ', ' .$row->per_nombre .'</option>';
                                        }
                                        ?>
                                    </select>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="txt2" class="col-lg-3 col-form-label">Usuario</label>
                                 <div class=" col-lg-9">
                                     <input type="text" class="form-control " name="txt2" value="<?php echo $v2; ?>">

                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="txt3" class="col-sm-3 col-form-label">Contraseña</label>
                                 <div class="col-lg-9">
                                 <!--<p class=" <?php echo 'text-' . COLOR_PRINCIPAL; ?>"><b>Dni del usuario por defecto<b></p>
                                     <input type="password" class="form-control" name="txt3" value="<?php echo $v3; ?>" />-->
                                     <div class="input-group ">
                                        <input type="text" class="form-control "  value="Dni del usuario por defecto" disabled>
                                            <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat <?php echo $btnrc;?>"  onclick="restablecer_clave()">Restablecer Clave</button>
                                            </span>
                                        </div>
                                    </div>
                             </div>
                             <div class="form-group row">
                                 <label for="txt4" class="col-sm-3 col-form-label">Estado</label>
                                 <div class=" col-lg-9">
                                     <div class="input-group">
                                         <input type="checkbox" name="txt4" <?php echo $estado; ?> />
                                     </div>
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
<script>
                    
    function restablecer_clave(){
        //alert("hola");
        var data = {
            id: $('#txt0').val(),
            idp: $('#txt1').val()
        };
        swal({
            title: "¿Estás seguro de resetear contraseña?",
            text: "Una vez resetiado, ¡su clave sera su DNI por defecto!",
            icon: "warning",
            buttons: ["No", "Si"],
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                
                $.post("<?php echo URL ?>/usuarios/resetear_clave", data, function (data, textStatus, jqXHR) {
                    var json = jQuery.parseJSON(data);  
                    console.log(json);                        
                    swal({
                    position: 'top-end',
                    title: json.msj,
                    icon: json.icon,
                    button: {
                        text: "Cerrar",
                        className: "btn btn-secondary btn-sm",
                        closeModal: true,
                        },
                    });
                });
            }
        });


       
    }
</script>
