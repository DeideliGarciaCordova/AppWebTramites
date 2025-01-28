<?php 
    		 $v0=$v1= $v2= $v3= $v4= $v5= $v6=$required= ' ';				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '<input type="hidden" name="txt0" value="' . $id .' ">';
				$v1=htmlentities($obj->emp_razonsocial);
				$v2=htmlentities($obj->emp_ruc);
				$v3=htmlentities($obj->emp_logo);
				$v4=htmlentities($obj->emp_telefono);
				$v5=htmlentities($obj->emp_correo);
				$v6=htmlentities($obj->emp_direccion);

				
						
			}else{
				$title = "CREAR  " . strtoupper($this->archivo); 
				$required= 'required';			
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
						</div> <div class="form-group row">
							<label for="txt2" class="col-sm-3 col-form-label">RUC</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-25" name="txt2" id="txt2" value="<?php echo $v2; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt3" class="col-sm-3 col-form-label">Logo</label>
							<div class=" col-lg-9">
								<input type="file" class="form-control w-100" name="txt3" id="txt3"  accept="image/*"   <?php echo $required;?>  />
							</div>
						</div> <div class="form-group row">
							<label for="txt4" class="col-sm-3 col-form-label">Telefono</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-25" name="txt4" id="txt4" value="<?php echo $v4; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt5" class="col-sm-3 col-form-label">Correo</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt5" id="txt5" value="<?php echo $v5; ?>"  required />
							</div>
						</div> <div class="form-group row">
							<label for="txt6" class="col-sm-3 col-form-label">Direccion</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt6" id="txt6" value="<?php echo $v6; ?>"  required />
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



$('input[type="file"]').on('change', function(){
  var ext = $(this ).val().split('.').pop();
  if ($(this ).val() != '') {
    if(ext != "png" && ext != "jpg" && ext != "jpeg"){
     $( this ).val('');
       swal({ 
            position: 'top-end',
           	title: 'Extensión no permitida: ' + ext+', solo acepta archivos  png y jpg',
            icon: 'error',
            button: {
                text: "Cerrar",
                className: "btn btn-secondary btn-sm",
                closeModal: true,
            },
        });
    }
    
  }
});
 

</script>