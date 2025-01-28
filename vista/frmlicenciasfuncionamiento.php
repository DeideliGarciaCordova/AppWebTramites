 		<?php 
    		 $v0=$v1= $v2= $v3= $v4= $v5= $v6= $v7= $v8= $v9= $v10= $v11= ' ';				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '<input type="hidden" name="txt0" value="' . $id .' ">';
				$v1=htmlentities($obj->lf_razonsocial);
				$v2=htmlentities($obj->lf_nombrecomercial);
				$v3=htmlentities($obj->lf_ruc);
				$v4=htmlentities($obj->lf_dni);
				$v5=htmlentities($obj->lf_ubicacion);
				$v6=htmlentities($obj->lf_girode);
				$v7=htmlentities($obj->lf_area);
				$v8=htmlentities($obj->lf_horarioatencion);
				$v9=$obj->lf_tipolicencia;
				$v10=htmlentities($obj->lf_numexpediente);
				$v11=htmlentities($obj->idnivelriesgo);
				$v12=$obj->lf_fechaemision;
				$select1 = $this->modelo->mostrar_nivelriesgo($v11);	
						
			}else{
				$title = "CREAR  " . strtoupper($this->archivo); 
				$v9='INDETERMINAD0';		
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
										<label for="txt1" class="col-sm-3 col-form-label">Razon Social</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-100" name="txt1" id="txt1" value="<?php echo $v1; ?>"  required />
										</div>
									</div>
									 <div class="form-group row">
										<label for="txt2" class="col-sm-3 col-form-label">Nombre Comercial</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-100" name="txt2" id="txt2" value="<?php echo $v2; ?>"  required />
										</div>
									</div>
									 <div class="form-group row">
										<label for="txt3" class="col-sm-3 col-form-label">Ruc</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-50" name="txt3" id="txt3" value="<?php echo $v3; ?>" minlength="11" maxlength="12"  required />
										</div>
									</div>
									<div class="form-group row">
										<label for="txt4" class="col-sm-3 col-form-label">Dni</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-50" name="txt4" id="txt4" minlength="8" maxlength="9" value="<?php echo $v4; ?>"  required />
										</div>
									</div>
									 <div class="form-group row">
										<label for="txt5" class="col-sm-3 col-form-label">Ubicacion</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-100" name="txt5" id="txt5" value="<?php echo $v5; ?>"  required />
										</div>
									</div>
									<div class="form-group row">
										<label for="txt6" class="col-sm-3 col-form-label">Giro de</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-100" name="txt6" id="txt6" value="<?php echo $v6; ?>"  required />
										</div>
									</div>
									 <div class="form-group row">
										<label for="txt7" class="col-sm-3 col-form-label">Area</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-50" name="txt7" id="txt7" value="<?php echo $v7; ?>"  required />
										</div>
									</div>
									<div class="form-group row">
										<label for="txt8" class="col-sm-3 col-form-label">Horario Atención</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-50" name="txt8" id="txt8" value="<?php echo $v8; ?>"  required />
										</div>
									</div>									
									<div class="form-group row">
										<label for="txt9" class="col-sm-3 col-form-label">Tipo Licencia</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-50" name="txt9" id="txt9" value="<?php echo $v9; ?>"  required />
										</div>
									</div>
									<div class="form-group row">
										<label for="txt10" class="col-sm-3 col-form-label">Num Expediente</label>
										<div class=" col-lg-9">
											<input type="text" class="form-control w-100" name="txt10" id="txt10" value="<?php echo $v10; ?>"   />											
										</div>
									</div>

									<div class="form-group row">
										<label for="txt11" class="col-sm-3 col-form-label">Nivel Riesgo</label>
										<div class=" col-lg-9">
											 <select class="form-control w-100 " name="txt11" id="txt11"  required>
							                  <?php
													if (!empty($select1)) {
														echo '<option value="' . $select1->idnivelriesgo . '" selected>' . $select1->nr_nombre. '</option>';
													}
												?>
							                </select>										
										</div>
									</div>
									<div class="form-group row">
										<label for="txt12" class="col-sm-3 col-form-label">Fecha Emisión</label>
										<div class=" col-lg-9">
											<input type="date" class="form-control w-100" name="txt12" id="txt12" value="<?php echo $v12; ?>" required  />											
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
				$('#txt11').select2({
					theme: 'bootstrap4',
					dataType: 'json',
					placeholder: 'Seleccione Nivel',
					ajax: { 
						type: 'POST',
						url: '<?php echo URL . '/licenciasfuncionamiento/b_nivelriesgo'; ?>',
					},
					cache: false
				});
			</script>