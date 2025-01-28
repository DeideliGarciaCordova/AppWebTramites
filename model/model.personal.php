<?php

class Modelpersonal extends Conexion
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
            	$criterio = " WHERE ( b.car_nombre LIKE '%$search%' or a.per_nombre LIKE '%$search%' or a.per_apellidos LIKE '%$search%' or a.per_dni LIKE '%$search%' or a.per_direc LIKE '%$search%'  or a.per_mail LIKE '%$search%' or a.per_telefonos LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM adv_personal a INNER JOIN adv_cargos b ON a.idcargo=b.idcargo   $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idpersonal DESC LIMIT $start, $length");
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
                    $id = $row->idpersonal;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;                         
					
                    $cant++;
                    $data[] = [
						htmlentities($row->car_nombre),
						htmlentities($row->per_dni),
                        htmlentities($row->per_apellidos.' '.$row->per_nombre),
						htmlentities($row->per_direc),
						htmlentities($row->per_mail),
						htmlentities($row->per_telefonos),
						
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

	public function add($v1, $v2, $v3, $v4, $v5, $v6, $v7)
	{
		try {
			if (self::validar_dni($v3) == true) {
				$msg['est'] = false;
				$msg['msj'] = 'DNI ya exites';
				$msg['icon'] = 'error';
			}else{
				$sql = "INSERT INTO adv_personal(per_nombre,per_apellidos,per_dni,per_direc,per_mail,per_telefonos,idcargo) VALUES(?,?,?,?,?,?,?)";
				$stm = $this->cone->prepare($sql);
				$stm->execute([$v1, $v2, $v3, $v4, $v5, $v6, $v7]);
				if($stm->rowCount() > 0){
					$msg['est'] = true;
					$msg['msj'] = 'se registró correctamente';
					$msg['icon'] = 'success';               
				} else {
					$msg['est'] = false;
					$msg['msj'] = 'error al registrar';
					$msg['icon'] = 'error';
				}
			}
			
            return $msg;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function validar_dni($v1)
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM adv_personal  WHERE  per_dni =?");
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

	public function mostrar($v1)
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


	public function del($id)
	{
		try {

			$stm =  $this->cone->prepare("DELETE FROM  adv_personal WHERE  idpersonal = ?");
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

	public function buscar($v1 = '')
	{
		try {
			$sql = "SELECT * FROM adv_personal WHERE per_nombre LIKE '%$v1%' OR per_apellidos LIKE '%$v1%' OR per_dni LIKE '%$v1'";
			//$u='SELECT * FROM vga_personal WHERE per_nombre LIKE "%'.$v1.'%" AND per_apellidos LIKE "%'.$v1.'%"'
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			$obj=  $stm->fetchAll(PDO::FETCH_OBJ);
			$res = [];
			foreach($obj as $row){
				$name = $row->per_apellidos . ' ' . $row->per_nombre;
				$res[] = [
					"id" => $row->idpersonal,
					"name" => $name
				];
			}
			echo json_encode($res);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function combox()
	{
		try {
			$sql = "SELECT * FROM adv_personal";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
