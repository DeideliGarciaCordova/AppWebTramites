<?php

class ModelStacciones extends Conexion
{
	public $cone;
	public function __construct()
	{
		
		$this->cone = parent::conectar();
		
		
	} 


	public function mostrar_acciones($v1)
	{
		$data=[];
		try {
			$stm = $this->cone->prepare("SELECT a.idpermisoacciones,a.idpermiso,a.idaccion,a.pa_estado FROM  adv_permisos_acciones a INNER JOIN adv_permisos b
			on a.idpermiso=b.idpermiso INNER join adv_acciones c on a.idaccion=c.idaccion WHERE  a.idpermiso =?");
			$stm->execute([$v1]);
			return $stm->fetchAll(PDO::FETCH_OBJ);
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}


	public function mostrar_permisosid($v1,$v2)
	{
		$data=[];
		try {
			$stm = $this->cone->prepare("SELECT * FROM adv_permisos a INNER JOIN adv_submenus b on 
			a.idsubmenu=b.idsubmenu where b.sm_control =? and a.idusuario=? ORDER BY  a.idpermiso DESC LIMIT 1");
			$stm->execute([$v1,$v2]);
			$rows= $stm->fetch(PDO::FETCH_OBJ);
			return $rows;
			
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $data;
	}






	public function mostrar_idpermiso($v1,$v2)
	{
		$data=[];
		try {
			$stm = $this->cone->prepare("SELECT * FROM  adv_permisos WHERE  a.idsubmenu =?,a.idusuario=?");
			$stm->execute([$v1]);
			$rows= $stm->fetchAll(PDO::FETCH_OBJ);

			foreach($rows as $row){
				$data[]=[
					"idpermiso"=>$row->idpermiso,
					"accion"=>$row->acc_nombre
				];
			}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}

		return $data;
	}

	

	public function add_permiso_acciones($v1,$v2,$v3)
	{
		try {
			$sql = "INSERT INTO adv_permisos_acciones(idpermiso, idaccion,pa_estado) VALUES(?,?,?)";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3]);
			if($stm->rowCount() > 0){                
                return true;
            } else {              
                return false;
            }
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
    }

	
    public function adi_permiso_acciones($v1,$v2,$v3,$id) {
		try {

            $sql="UPDATE adv_permisos_acciones SET idpermiso=?, idaccion=?,pa_estado=? WHERE idpermisoacciones=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$id]);
			
			if($stm->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

    

	
	
}
