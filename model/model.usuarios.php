<?php

class Modelusuarios extends Conexion
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
                $criterio = " WHERE (b.per_nombre LIKE '%$search%' or a.usu_nombre LIKE '%$search%'  ) ";
            }
            $sql = "SELECT * FROM adv_usuarios a INNER JOIN adv_personal b ON a.idpersonal=b.idpersonal  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idusuario DESC LIMIT $start, $length");
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
                    $id = $row->idusuario;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;                         
					if ($row->usu_estado == true) {
						$est = '<i class="fa fa-eye"></i>';
					} else {
						$est = '';
					}
                    $cant++;
                    $data[] = [
						htmlentities($row->per_apellidos.' '.$row->per_nombre),						 
						htmlentities($row->usu_nombre),
						$est,						
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
			$stm = $this->cone->prepare("SELECT * FROM adv_usuarios  WHERE  idusuario =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v4)
	{
		try {
			

			$v5=0;// por defecto se regitra como usuario no administrador
				$v4 = $v4=='on' ? true : false;
				$dni_personal=$this->mostrar_personal($v1);
				$clav=strrev(encripta($dni_personal->per_dni));
				$stm = $this->cone->prepare("INSERT INTO adv_usuarios(idpersonal,usu_nombre,usu_pass,usu_estado,usu_isadmin) VALUES(?,?,?,?,?)");
				$stm->execute([$v1,$v2,$clav,$v4,$v5]);
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

    public function validar_nombre($v1)
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM adv_usuarios  WHERE  usu_nombre =?");
			$stm->execute([$v1]);

			if ($stm->rowCount() > 0) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

    public function edi($v1,$v2,$v4,$id) {
		try {   
               if ($v4=='on'){$v4=true;}else{$v4=false;}
              // $clav=strrev(encripta($v3));
                $sql="UPDATE adv_usuarios SET idpersonal=?,usu_nombre=?,usu_estado=?
			WHERE idusuario=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v4,$id]);
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
                $stm =  $this->cone->prepare("DELETE FROM  adv_usuarios WHERE  idusuario =?");
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


	public function mostrar_personal($v1)
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM adv_personal  WHERE  idpersonal =?");
			$stm->execute([$v1]);

			$row = [];
			if ($stm->rowCount() > 0) {
				$row = $stm->fetch(PDO::FETCH_OBJ);
			}
			return $row;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function resetear_clave($idp,$id) {
		try {   
			   $dni_personal=$this->mostrar_personal($idp);
			   //var_dump( $dni_personal);exit;
			   $clav=strrev(encripta($dni_personal->per_dni));
                $sql="UPDATE adv_usuarios SET usu_pass=?
			WHERE idusuario=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$clav,$id]);
			if($stm->rowCount() > 0){
                $msg['est'] = true;
                $msg['msj'] = 'se resetio la clave correctamente';
                $msg['icon'] = 'success';                
            } else {
                $msg['est'] = false;
                $msg['msj'] = 'error al resetiar la clave';
                $msg['icon'] = 'error';               
            }
			return $msg;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function combox()
	{
		try {
			$sql = "SELECT * FROM adv_usuarios WHERE usu_estado=1";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	

}
