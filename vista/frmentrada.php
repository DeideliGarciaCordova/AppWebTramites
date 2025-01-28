<?php 
    		 $v0=$v1= $v2= $v3= $v4= $v5=' ';				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '<input type="hidden" name="txt0" value="' . $id .' ">';
				$v1=htmlentities($obj->idusuario);
				$v2=htmlentities($obj->idtipocomprobante);
				$v3=htmlentities($obj->ent_numcomprobante);
				$v4=htmlentities($obj->ent_total);
				$v5=htmlentities($obj->ent_fecha);

				
						
			}else{
				$title = "CREAR  " . strtoupper($this->archivo); 
						
			}  
			
		?>
			<form id="frmentrada"  class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
					<div class="modal fade " id="modalForm" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl " role="document">
							<div class="modal-content border-0 rounded-0 shadow-xl">
								<div class="modal-header border-0 rounded-0 text-white <?php echo 'bg-' . COLOR_PRINCIPAL; ?> " style="cursor: move">
									<h5 class="modal-title" id="modalForm"><?php echo $title ?> </h5>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php echo $v0 ?>	 							
                    
									
									<div class="form-group row"> 
										<label for="txt4" class="col-sm-2 col-form-label">Tipo Comprobante</label>
										<div class=" col-lg-6">
											<select class="form-control form-control-sm w-100 " name="txt1" id="txt1" required >                                              
											 </select>
										</div>
								
										<label for="txt2" class="col-sm-2 col-form-label">Cod Comprobante</label>
										<div class=" col-lg-2">
											<input type="text" class="form-control w-100" name="txt2" id="txt2"  required />
										</div>
									</div>							
			
										<div class="form-group row">
											<label for="txt3" class="col-sm-2 col-form-label">Buscar Bienes</label>
											<div class=" col-lg-10">
												<div class="input-group  date" >
													<select class="form-control form-control-sm w-100 " name="txt3" id="txt3" required >                                              
														</select>
													<div class="input-group-append" id="btnMostrarclientes" >
														<div class="input-group-text"  onclick="agregarDetalle($('#txt1').val())"  ><i class="fa-solid fa-cart-plus fa-beat text-danger" ></i></div>
													</div>
												</div>
											</div>
										</div> 
										<br>
										<!--tabla-->
										<div class="table-responsive">
											<table class="table table-bordered  table-sm" id="detalles">
												<thead> 
												<tr>
													<th>Acción</th>
													<th>Nombre Bien</th>
													<th>Precio</th>
													<th>Cantidad</th>
													<th  style="text-align: right;">Total</th>
													
												</tr>
												</thead>
												<tbody>
								
												</tbody>
											</table>
											<hr>
											
											<div class="no-block " style="background:#645223;">
												<div class="float-left mr-2 mb-0">
													<h3  class="ml-2 mb-0">Importe Total :</h3>
												</div>
												
												<div class="float-right mr-2 mb-0">
												<h3 id="h5total_valor" class="mb-0">0.00</h3><input type="text" name="importe_total" id="importe_total" class="">
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
			
<?php 

    include "scripts/entrada.php";
?>