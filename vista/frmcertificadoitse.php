<?php

$v0 = $v1 = $v2 = $v3 = $v4 = $v5 = $v6=$v7=$v8=$v9= $v10= $v11  = $v12 = $v13 = $v14 = $v15 = $v16=$v17=$v18=$v19=$v20=$v21=$v22=$v23=$estado = '';
		//var_dump($obj);			
    if (isset($id, $obj)) {
        $title = 'EDITAR  ' . strtoupper($this->archivo); 
        
       

        $v0 = '<input type="hidden" name="txt0" value="' . $id . '">';
        $vf = $obj->ci_fresolucion;                   
        $v1 = htmlentities($obj->ci_expediente);
        $v2 = $obj->ci_fexpediente;
        $v3 = htmlentities($obj->ci_solicitante);
        $v4 = htmlentities($obj->ci_establecimiento);
        $v5 = htmlentities($obj->ci_direccion);
        $v6 = htmlentities($obj->ci_distrito);
        $v7 = htmlentities($obj->ci_provincia);
        $v8 = htmlentities($obj->ci_departamento);
        $v9 = htmlentities($obj->ci_voucher);
        $v10 = htmlentities($obj->ci_monto);
        $v11 = htmlentities($obj->ci_informe);
        $v12 = htmlentities($obj->ci_finforme);
        $v13 = htmlentities($obj->ci_nombreinspector);
        $v14 = htmlentities($obj->ci_cumplecondiciones);
        $v15 = htmlentities($obj->ci_nivelriesgo);
        $v16 = htmlentities($obj->ci_capacidadestablecimiento);
        $v17 = htmlentities($obj->ci_areaocupada);
        $v18 = htmlentities($obj->ci_vigencia);
        $v19 = htmlentities($obj->ci_lugar);
        $v20 = $obj->ci_fexpedicion;
        $v21 = $obj->ci_fsolicitudrevalidacion;
        $v22 = $obj->idciiu;
        $v23 = $obj->ci_capacidadestablecimientoletras;
        //$select1 = $this->modelo->mostrar_ciiu($v22);

        if ($obj->ci_cumplecondiciones == true) {
            $estado = ' checked=true';
        }


	}else{
        $title = 'CREAR  ' . strtoupper($this->archivo); 

	}
					
?>

<style>#select2-txt22-container{line-height:12px;}</style>
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
                        <label for="txtf" class="col-sm-2 col-form-label">Fecha Resolución</label>
                        <div class=" col-lg-10">
                            <input type="date" class="form-control" name="txtf" id="txtf" value="<?php echo $vf; ?>"  required/>
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="txt1" class="col-sm-2 col-form-label">Nº expediente</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt1" id="txt1" value="<?php echo $v1; ?>"  required/>
                        </div>
                    </div>		
                    <div class="form-group row">
                        <label for="txt2" class="col-sm-2 col-form-label">Fecha Expediente</label>
                        <div class=" col-lg-10">
                            <input type="date" class="form-control" name="txt2" id="txt2" value="<?php echo $v2; ?>"  required/>
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="txt3" class="col-sm-2 col-form-label">Nombre Solicitante</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt3" id="txt3" value="<?php echo $v3; ?>"  required/>
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="txt4" class="col-sm-2 col-form-label" >Establecimiento</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt4" id="txt4" value="<?php echo $v4; ?>"  required/>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="lujq3" class="col-sm-2 col-form-label">Direccion Establecimiento</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt5" id="txt5" value="<?php echo $v5; ?>"  />
                        </div>
                    </div>           
                    <div class="form-group row">
                        <label for="txt6" class="col-sm-2 col-form-label">Distrito</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt6" id="txt6" value="<?php echo $v6; ?>"  />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt7" class="col-sm-2 col-form-label">Provincia</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt7" id="txt7" value="<?php echo $v7; ?>"  required/>
                        </div>
                    </div>		
                    <div class="form-group row">
                        <label for="txt8" class="col-sm-2 col-form-label">Departamento</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt8" id="txt8" value="<?php echo $v8; ?>"  required/>
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="txt9" class="col-sm-2 col-form-label">Nº Voucher</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt9" id="txt9" value="<?php echo $v9; ?>"  required/>
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="txt10" class="col-sm-2 col-form-label" id="lblfecha">Monto</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt10" id="txt10" value="<?php echo $v10; ?>"  required/>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="txt11" class="col-sm-2 col-form-label">Nº Informe</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt11" id="txt11" value="<?php echo $v11; ?>"  />
                        </div>
                    </div>           
                    <div class="form-group row">
                        <label for="txt12" class="col-sm-2 col-form-label">Fecha Inspección</label>
                        <div class=" col-lg-10">
                            <input type="date" class="form-control" name="txt12" id="txt12" value="<?php echo $v12; ?>"  />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt13" class="col-sm-2 col-form-label">Inspector</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt13" id="txt13" value="<?php echo $v13; ?>"  required/>
                        </div>
                    </div>		
                    <div class="form-group row">
                        <label for="txt14" class="col-sm-2 col-form-label">Comple condiciones</label>
                        <div class=" col-lg-10">
                        <input type="checkbox" class="" id="txt14" name="txt14" <?php echo $estado; ?> />
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="txt15" class="col-sm-2 col-form-label">Nivel Riesgo</label>
                        <div class=" col-lg-10"> 
                            <?php
                            $bajo=$medio=$alto=$muyalto="";
                                if (trim($v15) == "Bajo") {
                                    $bajo= "selected";
                                } 
                                if (trim($v15) == "Medio") {
                                    $medio= "selected";
                                } 
                                if (trim($v15) == "Alto") {
                                    $alto= "selected";
                                } 
                                if ($v15 == "Muy Alto") {
                                    $muyalto= "selected";
                                }
                            ?>
                            <select name="txt15" class="form-control w-100" required>
                                <option  value="">Seleccionar</option>
                                <option <?php echo $bajo; ?>  value="Bajo">Nivel Bajo</option>
                                <option <?php echo $medio; ?> value="Medio">Nivel Medio</option>
                                <option <?php echo $alto; ?> value="Alto">Nivel Alto</option>
                                <option <?php echo $muyalto; ?> value="Muy Alto">Nivel muy Alto</option>
                            </select>
                            <!--<input type="text" class="form-control" name="txt15" id="txt15" value="<?php echo $v15; ?>"  required/>-->
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="txt16" class="col-sm-2 col-form-label" id="lblfecha">Capacidad Establecimiento</label>
                        <div class="col-3 col-lg-3 col-sm-4 col-md-3">
                            <input type="number" class="form-control" name="txt16" id="txt16" value="<?php echo $v16; ?>" placeholder="Capacidad en digitos"  required/>
                        </div>
                        <div class="col-7 col-lg-7 col-sm-8 col-md-7">
                            <input type="text" class="form-control" name="txt23" id="txt23" value="<?php echo $v23; ?>" placeholder="Capacidad en letras" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt17" class="col-sm-2 col-form-label">Area Ocupada Edificación</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt17" id="txt17" value="<?php echo $v17; ?>"  />
                        </div>
                    </div>           
                    <div class="form-group row">
                        <label for="txt18" class="col-sm-2 col-form-label">Vigencia</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt18" id="txt18" value="<?php echo $v18; ?>"  />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt19" class="col-sm-2 col-form-label">Lugar</label>
                        <div class=" col-lg-10">
                            <input type="text" class="form-control" name="txt19" id="txt19" value="<?php echo $v19; ?>"  required/>
                        </div>
                    </div>		
                    <div class="form-group row">
                        <label for="txt20" class="col-sm-2 col-form-label">Fecha Expedición</label>
                        <div class=" col-lg-10">
                            <input type="date" class="form-control" name="txt20" id="txt20" value="<?php echo $v20; ?>"  required/>
                        </div>
                    </div>
                                    
                    <div class="form-group row">
                        <label for="txt21" class="col-sm-2 col-form-label">fecha Solicitud Revalidació</label>
                        <div class=" col-lg-10">
                            <input type="date" class="form-control" name="txt21" id="txt21" value="<?php echo $v21; ?>"  required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txt1" class="col-sm-2 col-form-label">Giro o Actividad</label>
                        <div class=" col-lg-10">
                            <select class="  " name="txt22" id="txt22"  required>
                                <option value="">Buscar</option>
                            <?php
                            
                                foreach ($comb_ciiu as $row) {
                                    
                                   if ($row->idciiu==$v22) {
									echo '<option class="mb-2"   value="' . $row->idciiu . '" selected>' . $row->cii_nombre . '</option>';
								   }else{
								        echo '<option class="mb-2"  value="' . $row->idciiu . '">' . $row->cii_nombre . '</option>';
								   }
								   
                                }
                                 
								
							?>
                            </select>
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
$('#txt22').select2();

/*
	$('#txt22').select2({
		theme: 'bootstrap4',
		dataType: 'json',
		placeholder: 'Buscar giro o actividad de la edificaciòn',
		ajax: { 
			type: 'POST',
			url: '<?php echo URL . '/certificadoitse/b_ciiu'; ?>',
		},
		cache: false
	});

   $('#txt22').select2({
      ajax: {
         type: 'POST',
        url: '<?php echo URL . '/certificadoitse/b_ciiu'; ?>',
        processResults: function (data) {
          console.log(data);
          
        }
      }
    });*/
        

</script>