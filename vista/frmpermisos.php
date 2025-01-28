<?php
					
                    $v0 = $v1 = $v2 =$v3= '';
					$crear=$editar=$eliminar="";
                   // $valchk1=$valchk2=$valchk3="on";
					if (isset($id, $obj)) {
						$title = 'EDITAR ' .strtoupper($this->archivo);
						
						$v0 = '<input type="hidden" name="txt0" id="txt0" value="' . $id . '">';
						
						$v1 = htmlentities($obj->idmenu);
						$v2 = htmlentities($obj->idsubmenu);
						$v3 = htmlentities($obj->idusuario);
						  
                        //acciones checkbox
                        
                        foreach($objacciones as $row){
                            if($row->idaccion==1 && $row->pa_estado==1){$crear="checked";}
                            if($row->idaccion==2 && $row->pa_estado==1){$editar="checked";}
                            if($row->idaccion==3 && $row->pa_estado==1){$eliminar="checked";}
                        }
					}else{
						$title = 'CREAR ' .strtoupper($this->archivo);
						
					}
					
				?>
				
				<form id="idForm" onsubmit="return fn_submit(this)" class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
					<div class="modal fade" id="modalForm" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg " role="document">
							<div class="modal-content border-0 rounded-0 shadow-lg">
								<div class="modal-header border-0 rounded-0  text-white <?php echo 'bg-'. COLOR_PRINCIPAL; ?> " style="cursor: move">
									<h5 class="modal-title" id="modalForm"><?php echo $title ?> </h5>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php echo $v0 ?>
                                    <div class="form-group row">
                                 <label for="txt1" class="col-sm-2 col-form-label">Menu</label>
                                 <div class=" col-lg-10">
                                     <select name="txt1" id="txt1" class="form-control w-100" required>
                                         <option value="">Seleccionar</option>
                                         <?php
                                            foreach ($cbomenu as $row) {
                                                $seld = '';
                                                if ($row->idmenu == $v1) {
                                                    $seld = 'selected';
                                                }
                                                echo '<option value="' . $row->idmenu . '" ' . $seld . '>' . $row->mnu_nombre . '</option>';
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </div>
                             <div class="form-group row">
                                 <label for="txt2" class="col-sm-2 col-form-label">Sub Menu</label>
                                 <div class=" col-lg-10">
                                     <select name="txt2" id="txt2" class="form-control w-100" required>
                                         <option value="">Seleccionar</option>
                                     </select>
                                 </div>
                             </div>

                             <div class="form-group row">
                                 <label for="txt3" class="col-sm-2 col-form-label">Usuario</label>
                                 <div class=" col-lg-10">
                                     <select name="txt3" class="form-control w-100" required>
                                         <?php
                                            foreach ($cbousuarios as $row) {
                                                $seld = '';
                                                if ($row->idusuario == $v3) {
                                                    $seld = 'selected';
                                                }
                                                echo '<option value="' . $row->idusuario . '" ' . $seld . '>' . $row->usu_nombre . '</option>';
                                            }
                                            ?>
                                     </select>
                                 </div>
                             </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Acciones</label>
                                 <div class=" col-lg-10">  

                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="chkCr" name="chkCr"  <?php echo $crear; ?>>
                                        <label class="form-check-label" for="chkCr" >Crear</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="chkEd" name="chkEd"  <?php echo $editar; ?> >
                                        <label class="form-check-label" for="chkEd">Editar</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input" type="checkbox" id="chkEl" name="chkEl"  <?php echo $eliminar; ?> >
                                        <label class="form-check-label" for="chkEl">Eliminar</label>
                                    </div>
                                </div> 
                            </div>

					            </div>							
								
								<div class="modal-footer border-0 bg-light">
									<button type="button" class="btn btn-secondary" data-dismiss="modal"  id="btndei">Cerrar</button>
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</div>
						</div>
					</div>

					
				</form>
                <script>
                    
                    function combox() {
                        var data = {
                            idp: $('#txt0').val(),
                            idm: $('#txt1').val()
                        };
                       // alert($('#txt0').val());
                        //alert($('#txt1').val());
                        $.post("<?php echo URL ?>/permisos/combox1", data, function(data, textStatus, jqXHR) {
                            $('#txt2').html(data);
                            //console.log(data);
                        });
                    }
                    combox();

                    $(function() {
                        $('#txt1').change(function(e) {
                            e.preventDefault();
                            combox();
                        });
                    });

                </script>
