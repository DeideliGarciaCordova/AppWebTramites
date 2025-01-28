<?php 
 
class Stseguridad{
private $objseg;

	public function __construct(){
		
		include_once 'model/model.stseguridad.php';
        $this->objseg=new Modelstseguridad();

		
		
	}

	public function listar(){
		include_once 'vista/frmlogin.php';
		
	}

	public function login(){
		if (isset($_POST) && !empty($_POST)) {
			
				$usu=$_POST['usu'];
				$pas=$_POST['pas'];
				$obj= $this->objseg->validar($usu,$pas);   
				if ($obj!=false) {
					$_SESSION['st_idusuario']  = $obj->idusuario;
	                $_SESSION['st_usuario']    = $obj->usu_nombre;
	                $_SESSION['st_personal']= $obj->per_nombre;
	                $_SESSION['st_isadmin'] = $obj->usu_isadmin;
	                $_SESSION['st_idcargo']  = $obj->idcargo;
	                $_SESSION['st_idpersonal']  = $obj->idpersonal;
	                $_SESSION["st_clave"]=$obj->usu_pass;
					
	                header("Location:".URL."accedi");

				 } else{
				 	
                    $error = ['titulo' => 'Error de usuario', 'texto' => 'los datos son incorrectos'];
				 	include_once 'vista/frmlogin.php';
				 } 
				 
				  
		} else {
			include_once 'vista/frmlogin.php';
		}
		
		
	}

	
}

?>
