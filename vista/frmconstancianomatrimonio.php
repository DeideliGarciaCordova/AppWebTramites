<?php
					
$v0 = $v1 = $v2 = $v3=$v33 = $v4 = $v5 = $v6 ='';
					
					if (isset($id, $obj)) {
						$title = 'EDITAR CONSTANCIA';
						
						$v0 = '<input type="hidden" name="txt0" value="' . $id . '">';
						$nombre_anio=$obj->ani_nombre;
						$v1=htmlentities($obj->cons_nombres);
                        $v2=htmlentities($obj->cons_dni);
						if($obj->cons_casado==1){$v3="checked";$v33="";}else{$v3="";$v33="checked";}
						//if($obj->cons_casado==0){$v3="";$v33="checked";}
                        //$v3=htmlentities($obj->cons_casado);
                        $v4=htmlentities($obj->cons_fecha);
						//var_dump($nombre_anio);
					}else{
						$title = 'CREAR CONSTANCIA';
						$v33="checked";
						$nombre_anio=$name_anio->ani_nombre;
						//var_dump($name_anio);
					}
					
				?>
				
				<form id="idForm" onsubmit="return fn_submit(this)" class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
					<div class="modal fade" id="modalForm" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg " role="document">
							<div class="modal-content border-0 rounded-0 shadow-lg">
								<div class="modal-header border-0 rounded-0  text-white <?php echo 'bg-' . COLOR_PRINCIPAL; ?>" style="cursor: move">
									<h5 class="modal-title" id="modalForm"><?php echo $title ?> </h5>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php echo $v0 ?>
									
                    <div class="form-group row">
							<label for="txt1" class="col-sm-3 col-form-label">Año</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control" name="txt1" id="txt1" value="<?php echo $nombre_anio;?>"  required disabled=""/>
							</div>
					</div>

                    <div class="form-group row">
							<label for="txt1" class="col-sm-3 col-form-label">Nombres/Apellidos</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control" name="txt2" id="txt2" value="<?php echo $v1; ?>"  required/>
							</div>
					</div>

                    <div class="form-group row">
							<label for="txt3" class="col-sm-3 col-form-label">Dni</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-50" name="txt3" id="txt3" value="<?php echo $v2; ?>"  required/>
							</div>
					</div>

                    <div class="form-group row">
							<label for="txt4" class="col-sm-3 col-form-label">Casado</label>
							<div class=" col-lg-9">
                                <div class="d-inline">
                                    <input type="radio" id="txt4" name="txt4" value="rbtsi" <?php echo $v3;?> >
                                    <label >Si</label>                                  
                                    &nbsp;
                                    <input type="radio" id="txt4" name="txt4" value="rbtno" <?php echo $v33;?>>
                                    <label >No</label>
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