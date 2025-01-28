<?php
class ModelCambiarclave extends Conexion
{
	public $cone;
	public function __construct()
	{
		$this->cone = parent::conectar();
	}



    public function edi($v1,$v2,$id) {
		try {   
            $sql="UPDATE adv_usuarios SET usu_nombre = ?, usu_pass = ? WHERE idusuario = ?";
            $clav=strrev(encripta($v2));
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$clav,$id]);
			if($stm->rowCount() > 0){
				$msg['est'] = true;
				$msg['msj'] = 'se actualizó correctamente';
				$msg['icon'] = 'success';                
			} else {
				$msg['est'] = false;
				$msg['msj'] = 'error al actualizar';
				$msg['icon'] = 'error';               
			}
			return $msg;
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
	}
	
}
