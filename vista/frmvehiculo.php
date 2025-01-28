<?php 
    		 $v0=$v1= $v2=' ';				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '<input type="hidden" name="txt0" value="' . $id .' ">';
				$v1=htmlentities($obj->veh_nombre);
$v2=htmlentities($obj->veh_placa);

				
						
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
							<label for="txt1" class="col-sm-3 col-form-label">Nombre Vehiculo</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt1" id="txt1" value="<?php echo $v1; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt2" class="col-sm-3 col-form-label">Placa</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt2" id="txt2" value="<?php echo $v2; ?>"  required />
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
			