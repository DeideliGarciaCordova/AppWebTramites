<?php 
    		 $v0=$v1= $v2= $v3= $v4= $v5= $v6=$v7=$disabled=' ';				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '<input type="hidden" name="txt0" value="' . $id .' ">';
				$v1=htmlentities($obj->idusuario);
				$v2=htmlentities($obj->idchofer);
				$v3=htmlentities($obj->idvehiculo);
				$v4=htmlentities($obj->idbien);
				$v5=htmlentities($obj->sal_numvale);
				$v6=htmlentities($obj->sal_fecha); 
				$v7=htmlentities($obj->sal_cantidad);

				$select1 = $this->modelo->mostrar_chofer($v2);	
				$select2 = $this->modelo->mostrar_vehiculo($v3);
				$select3 = $this->modelo->mostrar_bien($v4);	
				//$disabled="disabled"	;

				$method="edi";
			}else{
				$title = "CREAR  " . strtoupper($this->archivo); 
				$method="add";		
			}
			
		?>
			<form id="idForm" onsubmit="return fn_validar(this)" class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
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
							<label for="txt1" class="col-sm-3 col-form-label">Chofer</label>
							<div class=" col-lg-9">
								<select class="form-control w-100 " name="txt1" id="txt1"  required>
									<?php
										if (!empty($select1)) {
											echo '<option value="' . $select1->idchofer . '" selected>' . $select1->cho_nombres. '</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="txt2" class="col-sm-3 col-form-label">Vehiculo</label>
							<div class=" col-lg-9">
								<select class="form-control w-100 " name="txt2" id="txt2"  required>
									<?php
										if (!empty($select2)) {
											echo '<option value="' . $select2->idvehiculo . '" selected>' . $select2->veh_nombre. '</option>';
										}
									?>
								</select> 
							</div>
						</div>
						<div class="form-group row">
							<label for="txt3" class="col-sm-3 col-form-label">Tipo Bien</label>
							<div class=" col-lg-9">
								<select class="form-control w-100 " name="txt3" id="txt3"  required>
									<?php
										if (!empty($select3)) {
											echo '<option value="' . $select3->idbien . '" selected>' . $select3->bie_nombre. '</option>';
										}
									?>
								</select>   
							</div>
						</div>
						<div class="form-group row">
							<label for="txt5" class="col-sm-3 col-form-label">Numero Vale</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt4" id="txt4" value="<?php echo $v5; ?>"  required />
							</div>
						</div>
						<div class="form-group row">
							<label for="txt6" class="col-sm-3 col-form-label">Cantidad</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt5" id="txt5" value="<?php echo $v7; ?>"  <?php echo $disabled; ?>  required />
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

<?php 

    include "scripts/salida.php";
?>