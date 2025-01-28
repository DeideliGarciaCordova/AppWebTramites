<?php
class ModelMiperfil extends Conexion
{
	public $cone;
	public function __construct()
	{
		$this->cone = parent::conectar();
	}

	public function ver_informacion_personal()
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM  adv_usuarios a inner join adv_personal b on a.idpersonal=b.idpersonal INNER JOIN  adv_cargos  c on b.idcargo=c.idcargo where a.idusuario=?");
			$stm->execute([$_SESSION['st_idusuario']]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


  public function edi($v1, $v2, $v3, $v4, $v5, $v6, $v7, $id)
	{
		try {
			
				$stm = $this->cone->prepare("UPDATE adv_personal SET per_nombre=?,per_apellidos=?,per_dni=?,per_direc=?,per_mail=?,per_telefonos=?,idcargo=? WHERE idpersonal=?");
				$stm->execute([$v1, $v2, $v3, $v4, $v5, $v6, $v7, $id]);
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
