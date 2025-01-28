<?php

class ModelSubmenus extends Conexion
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
                $criterio = " WHERE (t2.mnu_nombre LIKE '%$search%' OR sm_nombre LIKE '%$search%' OR sm_icono LIKE '%$search%' OR sm_estado LIKE '%$search%' OR sm_control LIKE '%$search%' OR sm_orden LIKE '%$search%'  ) ";
            }
            $sql = " SELECT * FROM adv_submenus t1 INNER JOIN adv_menus t2 ON t2.idmenu=t1.idmenu  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idsubmenu DESC LIMIT $start, $length");
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
                    $id = $row->idsubmenu;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;
                           
					if ($row->sm_estado == true) {
						$est = '<i class="fa fa-eye"></i>';
					} else {
						$est = '';
					}
                    
                    $cant++;
                    $data[] = [
						//htmlentities($row->idarchivo),
                        htmlentities($cant),
                        htmlentities($row->mnu_nombre),
						htmlentities($row->sm_nombre),
                        htmlentities($row->sm_icono),
                        $est,
						htmlentities($row->sm_control),
						htmlentities($row->sm_orden),
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
			$stm = $this->cone->prepare("SELECT * FROM adv_submenus  WHERE  idsubmenu =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3,$v4,$v5,$v6)
	{
		try {
			$v4 = $v4 == 'on' ? true : false;
			$stm = $this->cone->prepare("INSERT INTO adv_submenus(idmenu,sm_nombre,sm_icono,sm_estado,sm_control,sm_orden) VALUES(?,?,?,?,?,?)");
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6]);
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

    public function edi($v1,$v2,$v3,$v4,$v5,$v6,$id) {
		try {   
            $v4 = $v4 == 'on' ? 1 : 0;
            $sql="UPDATE adv_submenus SET idmenu=?,sm_nombre=?,sm_icono=?,sm_estado=?,sm_control=?,sm_orden=? WHERE idsubmenu=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$id]);
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
	
	public function del($id) {
            try{	
                $stm =  $this->cone->prepare("DELETE FROM  adv_submenus WHERE  idsubmenu =?");
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

	
}
