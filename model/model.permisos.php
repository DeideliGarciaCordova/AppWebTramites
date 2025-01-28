<?php

class ModelPermisos extends Conexion
{
	public $cone;
	public $objstacciones;
	public function __construct()
	{
		
		$this->cone = parent::conectar();
		
		require_once 'model.stacciones.php';
		$this->objstacciones = new ModelStacciones();
	} 

 
    public function listar($draw, $start, $length, $search = '') {
        $data = [];
        $total = $criterio = $btnedit=$btndel = '';
		$editar=$eliminar="d-none";
        $cant=0;
        try {
            $db = $this->cone;
            if (!empty($search)) {
                $criterio = " WHERE (t4.mnu_nombre LIKE '%$search%' OR t2.sm_nombre LIKE '%$search%' OR t3.usu_nombre LIKE '%$search%'  ) ";
            }
            $sql = "SELECT * FROM adv_permisos t1 INNER JOIN adv_submenus t2 ON t2.idsubmenu=t1.idsubmenu
			inner join adv_usuarios t3 on t1.idusuario=t3.idusuario INNER JOIN adv_menus t4 ON t4.idmenu=t2.idmenu  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idpermiso DESC LIMIT $start, $length");
            $stm->execute();

            if ($stm->rowCount() > 0) {

                $rows = $stm->fetchAll(PDO::FETCH_OBJ);

				
				if($_SESSION['st_isadmin']!=1){
					$controlador=substr(get_class(),5) ;//obtener el nombre del controlador o sm_control del submenu

					$obj=$this->objstacciones->mostrar_permisosid($controlador,$_SESSION["st_idusuario"]);

					$obj1=$this->objstacciones->mostrar_acciones($obj->idpermiso);

					//var_dump($obj1);exit;
					foreach($obj1 as $row){
						if($row->idaccion==2 && $row->pa_estado==1){$editar="";}
						if($row->idaccion==3 && $row->pa_estado==1){$eliminar="";}
					}
				}else{
					$editar="";
					$eliminar="";
				}

                foreach ($rows as $row) {
                    $id = $row->idpermiso;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;
                           
                
                    
                    $cant++;
                    $data[] = [
						//htmlentities($row->idarchivo),
                        htmlentities($cant),
                        htmlentities($row->mnu_nombre),
                        htmlentities($row->sm_nombre),
                        htmlentities($row->usu_nombre),
                        '<div class="btn-group">' . $acc . '</div>',
                    ];
					
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return [
            'draw' => intval($draw),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        ];
    }

	public function mostrar($v1)
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM adv_permisos t1
			INNER JOIN adv_submenus t2 ON t2.idsubmenu=t1.idsubmenu
			INNER JOIN adv_menus t3 ON t3.idmenu=t2.idmenu WHERE  idpermiso =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


	





	
	public function add($v1,$v2,$chk1,$chk2,$chk3)
	{
		try {
			$sql = "INSERT INTO adv_permisos(idsubmenu,idusuario) VALUES(?,?)";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2]);
			$id = $this->cone->lastInsertId();
			  //echo $id ;exit;
			//	insertamos las acciones que  tendra acceso

			if ($chk1 == 'on') {$this->objstacciones->add_permiso_acciones($id,'1',1);}else{$this->objstacciones->add_permiso_acciones($id,'1',0);} 
			if ($chk2 == 'on') {$this->objstacciones->add_permiso_acciones($id,'2',1);}else{$this->objstacciones->add_permiso_acciones($id,'2',0);} 
			if ($chk3 == 'on') {$this->objstacciones->add_permiso_acciones($id,'3',1);}else{$this->objstacciones->add_permiso_acciones($id,'3',0);} 
			

			if($stm->rowCount() > 0){
                $msg['est'] = true;
                $msg['msj'] = 'se registró correctamente';
                $msg['icon'] = 'success';               
            } else {
                $msg['est'] = false;
                $msg['msj'] = 'error al registrar';
                $msg['icon'] = 'error';
            }
             return $msg;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
    }

	

	public function edi($v1,$v2,$chk1,$chk2,$chk3,$id) {
		try {

            $sql="UPDATE adv_permisos SET idsubmenu=?,idusuario=? WHERE idpermiso=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$id]);


			$obj=$this->objstacciones->mostrar_acciones($id);


			$c=0;
			foreach($obj as $row){
				if($chk1 == 'on'){
					if($row->idaccion==1){
						$this->objstacciones->adi_permiso_acciones($id,'1',1,$row->idpermisoacciones);  $c++;
					}
				}else{
					if($row->idaccion==1){
						$this->objstacciones->adi_permiso_acciones($id,'1',0,$row->idpermisoacciones); $c++;
					}
				}

				if($chk2 == 'on'){
					if($row->idaccion==2){
						$this->objstacciones->adi_permiso_acciones($id,'2',1,$row->idpermisoacciones); $c++;
					}
				}else{
					if($row->idaccion==2){
						$this->objstacciones->adi_permiso_acciones($id,'2',0,$row->idpermisoacciones);$c++;
					}
				}

				if($chk3 == 'on'){
					if($row->idaccion==3){
						$this->objstacciones->adi_permiso_acciones($id,'3',1,$row->idpermisoacciones); $c++;
					}
				}else{
					if($row->idaccion==3){
						$this->objstacciones->adi_permiso_acciones($id,'3',0,$row->idpermisoacciones); $c++;
					}
				}

			}
			
			if($stm->rowCount() > 0  ||  $c>0){
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
    
	public function del($id) {
            try{
                $stm =  $this->cone->prepare("DELETE FROM  adv_permisos WHERE  idpermiso =?");
                $stm->execute([$id]);
                if($stm->rowCount() > 0){
                        return true;
                }else{
                        return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
	}


	public function permisos($v1, $v2)
	{
		try {
			$sql = "SELECT * FROM adv_permisos t1
			INNER JOIN adv_submenus t2 ON t2.idsubmenu=t1.idsubmenu
			INNER JOIN adv_menus t3 ON t3.idmenu=t2.idmenu WHERE  t1.idusuario=? AND t2.sm_control=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


	public function comboxmenu()
	{
		try {
			$sql = "SELECT * FROM adv_menus WHERE mnu_estado=1";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function comboxsubmenu($id)
	{
		try {
			$sql = "SELECT * FROM adv_submenus WHERE idmenu=? AND sm_estado=1";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$id]);
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function comboxsubmenu2($id)
	{
		try {
			$sql = "SELECT * FROM adv_permisos t1 INNER JOIN vga_submenus t2 ON t2.idsubmenu=t1.idsubmenu WHERE idmenu=? AND sm_estado=1";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$id]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function comboxusuarios()
	{
		try {
			$sql = "SELECT * FROM adv_usuarios";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
