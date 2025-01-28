<?php 
 
class Modelstseguridad extends Conexion
{ 
	private $cone=null; 
	function __construct()
	{
		$this->cone=parent::conectar();
	}

	public function validar($usu,$pas){
		try{
			$clav=strrev(encripta($pas));
			$stm=$this->cone->prepare("SELECT * FROM adv_usuarios a inner join adv_personal b on a.idpersonal=b.idpersonal WHERE usu_nombre=? and usu_pass=? and usu_estado=1");
			$stm->execute([$usu,$clav]);
			return $stm->fetch(PDO::FETCH_OBJ);

		}catch(Exception $m){
			$m->getMessage();
		}

	} 

	public function lstmenus()
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM adv_menus where mnu_estado=1  order by mnu_orden");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	//lista los submenus disponibles segun permisos del ususario
	public function lstsubmenus($v1)
	{
		$v2 = $_SESSION['st_idusuario'];

		try {
			//condicion esuqees el usuario un superadministrador o no para retornar los menus segn suspermisos otorgados
			if($_SESSION['st_isadmin']==1){
				$sql="SELECT * FROM adv_submenus a  where idmenu=? and sm_estado=1  order by a.sm_orden";
				$stm = $this->cone->prepare($sql);
				$stm->execute([$v1]);
			}else{
				$sql="SELECT * FROM adv_submenus a INNER JOIN adv_permisos b on a.idsubmenu=b.idsubmenu where idmenu=?  and b.idusuario=? and sm_estado=1  order by a.sm_orden";
				$stm = $this->cone->prepare($sql);
				$stm->execute([$v1,$v2]);
			}
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	//listar submenus 

	public function listtarsubmenus($v1)
	{

		try {
			//condicion esuqees el usuario un superadministrador o no para retornar los menus segn suspermisos otorgados

			if ($_SESSION['st_isadmin']==true) {
				$sql="SELECT * FROM  adv_submenus where sm_estado=1";
				$stm = $this->cone->prepare($sql);
				$stm->execute();
			}else{
				$sql="SELECT * FROM adv_permisos a INNER JOIN adv_submenus b on a.idsubmenu=b.idsubmenu INNER JOIN adv_usuarios c on a.idusuario=c.idusuario WHERE a.idusuario=? and  sm_estado=1";
				$stm = $this->cone->prepare($sql);
				$stm->execute([$v1]);
			}

				
			
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function verlogo()
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM `adv_empresa` ORDER by idempresa  DESC LIMIT 1");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


	public function ver_informacion_personal()
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM  adv_usuarios a inner join adv_personal b on a.idpersonal=b.idpersonal where idusuario=?");
			$stm->execute([$_SESSION['st_idusuario']]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
?>
