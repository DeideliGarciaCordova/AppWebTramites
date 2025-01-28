<?php

class ModelMenus extends Conexion
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
                $criterio = " WHERE (idmenu LIKE '%$search%'  OR mnu_nombre LIKE '%$search%'  OR mnu_icono LIKE '%$search%'  OR mnu_estado LIKE '%$search%'  OR mnu_control LIKE '%$search%'  OR mnu_orden LIKE '%$search%'   ) ";
            }
            $sql = " SELECT * FROM adv_menus  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idmenu DESC LIMIT $start, $length");
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
                    $id = $row->idmenu;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;
                           
					if ($row->mnu_estado == true) {
						$est = '<i class="fa fa-eye"></i>';
					} else {
						$est = '';
					}
                    
                    $cant++;
                    $data[] = [
						//htmlentities($row->idarchivo),
                        htmlentities($cant),
                        htmlentities($row->mnu_nombre),
                        htmlentities($row->mnu_icono),
                        $est,
						htmlentities($row->mnu_control),
						htmlentities($row->mnu_orden),
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
			$stm = $this->cone->prepare("SELECT * FROM adv_menus  WHERE  idmenu =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1, $v2, $v3, $v4, $v5)
	{
		try {
			if ($v3 == 'on') {
				$v3 = true;
			} else {
				$v3 = false;
			}
			$stm = $this->cone->prepare("INSERT INTO adv_menus(mnu_nombre,mnu_icono,mnu_estado,mnu_control,mnu_orden) VALUES(?,?,?,?,?)");
			$stm->execute([$v1, $v2, $v3, $v4, $v5]);
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

	public function edi($v1, $v2, $v3, $v4, $v5, $id)
	{ 
		try {
			if ($v3 == 'on') {
				$v3 = 1;
			} else {
				$v3 = 0;
			}
			//echo 'hola'. $v3;
			$sql = "UPDATE adv_menus SET mnu_nombre=?,mnu_icono=?,mnu_estado=?,mnu_control=?,mnu_orden=?
			WHERE idmenu=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1, $v2, $v3, $v4, $v5, $id]);
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

	public function del($id)
	{
		try {
			$stm =  $this->cone->prepare("DELETE FROM  adv_menus WHERE  idmenu =?");
			$stm->execute([$id]);
			if ($stm->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function combox()
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
}
?>