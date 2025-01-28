<?php

$v0 = $v1 = $v2 = $v3 = $v4 = $v5 = $v6=$v7=$v8=$v9 =$mostrarpdf=$required= '';
					
    if (isset($id, $obj)) {
        $title = 'EDITAR  ' . strtoupper($this->archivo); 
                            
        $v0 = '<input type="hidden" name="txt0" value="' . $id . '">';
                            
        $v1 = htmlentities($obj->idtipoacta);
        $v2 = htmlentities($obj->idusuario);
        $v3 = htmlentities($obj->act_persona);
        $v4 = htmlentities($obj->act_dni);
        $v5 = htmlentities($obj->act_fnacimiento);
        $v6 = htmlentities($obj->act_fecha);
        $v7 = htmlentities($obj->act_precio);
        $v8 = htmlentities($obj->act_numrecibo);
        $v9 = $obj->act_archivo;
        $mostrarpdf='form-group row';

	}else{
        $title = 'CREAR  ' . strtoupper($this->archivo); 
        $mostrarpdf=" form-group row d-none";
        $required= 'required';
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
                        <label for="txt1" class="col-sm-2 col-form-label">Tipo Acta</label>
                        <div class=" col-lg-10">
                            <select name="txt1" class="form-control w-100" id="txt1" required>
                                <option value="">Seleccionar</option>
                                <?php
                                foreach ($comb_ta as $row) {
                                    $seld = '';
                                    if($row->idtipoacta == $v1){
                                        $seld = 'selected';
                                    }
                                    echo '<option value="'. $row->idtipoacta .'" '. $seld .'>'. $row->ta_nombre .'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>				
                    <div class="form-group row">
                        <label for="lujq1" class="col-sm-2 col-form-label">Persona</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt2" id="txt2" value="<?php echo $v3; ?>"  required/>
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="tx2" class="col-sm-2 col-form-label">Dni</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt3" id="txt3" value="<?php echo $v4; ?>"  required/>
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="lujq3" class="col-sm-2 col-form-label" id="lblfecha">Fecha Nacimiento</label>
                        <div class=" col-lg-10">
                            <input type="date" class="form-control" name="txt4" id="txt4" value="<?php echo $v5; ?>"  required/>
                        </div>
                    </div>
                    <div class="form-group row d-none">
                        <label for="lujq3" class="col-sm-2 col-form-label">Precio</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt5" id="txt5" value="<?php echo $v7; ?>"  />
                        </div>
                    </div>           
                    <div class="form-group row">
                        <label for="txt6" class="col-sm-2 col-form-label">Archivo</label>
                        <div class=" col-lg-10">
                            <input type="file" class="form-control" name="txt6" id="txt6" <?php echo $required;?>  />
                        </div>
                    </div>
                                    
                    <div class="<?php echo $mostrarpdf ?>" >
                        <iframe height="500" class="w-100 m-4" src="data:application/pdf;base64,<?php echo base64_encode($v9) ?>" frameborde="0"></iframe>
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
    $("#txt1").on("click", function(){
    var id=$(this).val();
    console.log(id);
        switch (id) {
            case '1':
                $("#lblfecha").html("Fecha Nacimiento");
                break;
            case '2':
                $("#lblfecha").html("Fecha Defunción ");
                break;
            case '3':
                $("#lblfecha").html("Fecha Matrimonio");
                break;            
            default:
            $("#lblfecha").html("Fecha Nacimiento");
                break;
            }
    } );

</script>