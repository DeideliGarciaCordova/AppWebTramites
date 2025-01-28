<?php 
    		 $v0=$v1= $v2= $v3= $v4= $v5= $v6= $v7= $v8= $v9= $v10= $v11= $v12= $v13= $v14= $v15= $v16= $v17= $v18= $v19= $v20= $v21= $v22= $v23= $v24= $v25= $v26=' ';				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '<input type="hidden" name="txt0" value="' . $id .' ">';
				$v1=htmlentities($obj->idusuario);$v2=htmlentities($obj->idanio);$v3=htmlentities($obj->idtipofuncion);$v4=htmlentities($obj->idnivelriesgo);$v5=htmlentities($obj->idtiposolicitante);$v6=htmlentities($obj->si_area);$v7=htmlentities($obj->si_numeropisos);$v8=htmlentities($obj->si_pisoestablecimiento);$v9=htmlentities($obj->si_nombresapellidos);$v10=htmlentities($obj->si_dni);$v11=htmlentities($obj->si_domicilio);$v12=htmlentities($obj->si_correosolicitante);$v13=htmlentities($obj->si_telefonosolicitante);$v14=htmlentities($obj->si_razonsocial);$v15=htmlentities($obj->si_ruc);$v16=htmlentities($obj->si_nombrecomercial);$v17=htmlentities($obj->si_telefonoestablecimiento);$v18=htmlentities($obj->si_ubicacion);$v19=htmlentities($obj->si_referenciadirección);$v20=htmlentities($obj->si_localidad);$v21=htmlentities($obj->si_distrito);$v22=htmlentities($obj->si_provincia);$v23=htmlentities($obj->si_departamento);$v24=htmlentities($obj->si_giro);$v25=htmlentities($obj->si_horarioatencion);$v26=htmlentities($obj->si_numexpediente);
				
						
			}else{
				$title = "CREAR  " . strtoupper($this->archivo); 
						
			}
			
		?>
			<form id="idForm" onsubmit="return fn_submit(this)" class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
					<div class="modal fade" id="modalForm" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg " role="document">
							<div class="modal-content border-0 rounded-0 shadow-lg">
								<div class="modal-header border-0 rounded-0 text-white <?php echo 'bg-' . COLOR_PRINCIPAL; ?> " style="cursor: move">
									<h5 class="modal-title" id="modalForm"><?php echo $title ?> </h5>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php echo $v0 ?>								
                    
									 <div class="form-group row">
							<label for="txt1" class="col-sm-3 col-form-label">idusuario</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt1" id="txt1" value="<?php echo $v1; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt2" class="col-sm-3 col-form-label">idanio</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt2" id="txt2" value="<?php echo $v2; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt3" class="col-sm-3 col-form-label">idtipofuncion</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt3" id="txt3" value="<?php echo $v3; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt4" class="col-sm-3 col-form-label">idnivelriesgo</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt4" id="txt4" value="<?php echo $v4; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt5" class="col-sm-3 col-form-label">idtiposolicitante</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt5" id="txt5" value="<?php echo $v5; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt6" class="col-sm-3 col-form-label">si_area</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt6" id="txt6" value="<?php echo $v6; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt7" class="col-sm-3 col-form-label">si_numeropisos</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt7" id="txt7" value="<?php echo $v7; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt8" class="col-sm-3 col-form-label">si_pisoestablecimiento</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt8" id="txt8" value="<?php echo $v8; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt9" class="col-sm-3 col-form-label">si_nombresapellidos</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt9" id="txt9" value="<?php echo $v9; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt10" class="col-sm-3 col-form-label">si_dni</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt10" id="txt10" value="<?php echo $v10; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt11" class="col-sm-3 col-form-label">si_domicilio</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt11" id="txt11" value="<?php echo $v11; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt12" class="col-sm-3 col-form-label">si_correosolicitante</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt12" id="txt12" value="<?php echo $v12; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt13" class="col-sm-3 col-form-label">si_telefonosolicitante</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt13" id="txt13" value="<?php echo $v13; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt14" class="col-sm-3 col-form-label">si_razonsocial</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt14" id="txt14" value="<?php echo $v14; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt15" class="col-sm-3 col-form-label">si_ruc</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt15" id="txt15" value="<?php echo $v15; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt16" class="col-sm-3 col-form-label">si_nombrecomercial</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt16" id="txt16" value="<?php echo $v16; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt17" class="col-sm-3 col-form-label">si_telefonoestablecimiento</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt17" id="txt17" value="<?php echo $v17; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt18" class="col-sm-3 col-form-label">si_ubicacion</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt18" id="txt18" value="<?php echo $v18; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt19" class="col-sm-3 col-form-label">si_referenciadirección</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt19" id="txt19" value="<?php echo $v19; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt20" class="col-sm-3 col-form-label">si_localidad</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt20" id="txt20" value="<?php echo $v20; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt21" class="col-sm-3 col-form-label">si_distrito</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt21" id="txt21" value="<?php echo $v21; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt22" class="col-sm-3 col-form-label">si_provincia</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt22" id="txt22" value="<?php echo $v22; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt23" class="col-sm-3 col-form-label">si_departamento</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt23" id="txt23" value="<?php echo $v23; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt24" class="col-sm-3 col-form-label">si_giro</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt24" id="txt24" value="<?php echo $v24; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt25" class="col-sm-3 col-form-label">si_horarioatencion</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt25" id="txt25" value="<?php echo $v25; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt26" class="col-sm-3 col-form-label">si_numexpediente</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt26" id="txt26" value="<?php echo $v26; ?>"  required />
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
			