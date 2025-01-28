<?php 
    		 $v0=$v1= $v2= $v3= $v4= $v5= $v6= $v7=' ';				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '<input type="hidden" name="txt0" value="' . $id .' ">';
				$v1=htmlentities($obj->pap_nombres);
				$v2=htmlentities($obj->pap_dependencias);
				$v3=htmlentities($obj->pap_fechasalida);
				$v4=htmlentities($obj->pap_fecharetorno);
				$v5=htmlentities($obj->pap_destino);
				$v6=$obj->idmotivosalida;
				$v7=htmlentities($obj->pap_fundamentacion);

				$select1 = $this->modelo->mostrar_motivosalida($v6);
				//var_dump($select1);exit;
						
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
							<label for="txt1" class="col-sm-3 col-form-label">NOMBRES Y APELLIDOS</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt1" id="txt1" value="<?php echo $v1; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt2" class="col-sm-3 col-form-label">DEPENDENCIA</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt2" id="txt2" value="<?php echo $v2; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt3" class="col-sm-3 col-form-label">FECHA/HORA SALIDA</label>
							<div class=" col-lg-9">
								<input type="datetime-local" class="form-control w-50" name="txt3" id="txt3" value="<?php echo $v3; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt4" class="col-sm-3 col-form-label">FECHA/HORA RETORNO</label>
							<div class=" col-lg-9">
								<input type="datetime-local" class="form-control w-50" name="txt4" id="txt4" value="<?php echo $v4; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt5" class="col-sm-3 col-form-label">DESTINO</label>
							<div class=" col-lg-9 ">
								<input type="text" class="form-control w-100" name="txt5" id="txt5" value="<?php echo $v5; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt6" class="col-sm-3 col-form-label">MOTIVO SALIDA</label>
							<div class=" col-lg-9">
							<select class="form-control w-100 " name="txt6" id="txt6"  required>
								<?php
									if (!empty($select1)) {
										echo '<option value="' . $select1->idmotivosalida  . '" selected>' . $select1->ms_motivo. '</option>';
										
									}
								?>
							</select>
							</div>
						</div> <div class="form-group row">
							<label for="txt7" class="col-sm-3 col-form-label">FUNDAMENTACIÓN</label>
							<div class=" col-lg-9">
								<textarea rows="3" class="form-control w-100" name="txt7" id="txt7"   required >
								<?php echo $v7; ?>
								</textarea>
							
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
				$('#txt6').select2({
					theme: 'bootstrap4',
					dataType: 'json',
					placeholder: 'Seleccione motivo salida',
					ajax: { 
						type: 'POST',
						url: '<?php echo URL . '/papeletas/b_motivosalida'; ?>',
					},
					cache: false
				});
			</script>