<?php
class Modelconstancianomatrimonio extends Conexion
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
        $total = $criterio = '';
        $editar=$eliminar="d-none";
        $cant=0;
        try {
            $db = $this->cone;
            if (!empty($search)) {
                $criterio = " WHERE (cons_nombres LIKE '%$search%' OR cons_dni LIKE '%$search%' OR cons_fecha LIKE '%$search%' ) ";
            }
            $sql = "SELECT * FROM stm_constancia_no_matrimonio a INNER JOIN stm_anio b on a.idanio=b.idanio  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();

            $stm = $db->prepare($sql . " ORDER BY idcontancianomatrimonio DESC LIMIT $start, $length");
            $stm->execute();

            if ($stm->rowCount() > 0) {

                $rows = $stm->fetchAll(PDO::FETCH_OBJ);
				
				$controlador=substr(get_class(),5) ;//obtener el nombre del controlador o sm_control del submenu

				$obj=$this->objstacciones->mostrar_permisosid($controlador,$_SESSION["st_idusuario"]);

				$obj1=$this->objstacciones->mostrar_acciones($obj->idpermiso);

					//var_dump($obj1);exit;
					foreach($obj1 as $row){
						if($row->idaccion==2 && $row->pa_estado==1){$editar="";}
						if($row->idaccion==3 && $row->pa_estado==1){$eliminar="";}
					}
                    

                foreach ($rows as $row) {
                    $id = $row->idcontancianomatrimonio;


                    $acc = '<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>'
                            . '<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>'
                            . '<a title="ver constancia" href="'.URL.'/constancianomatrimonio/mostrarpdf?id='.$id.'" class="btn btn-warning btn-sm"><i class="fas fa-file"></i></a>';

                   
                    $cant++;
                    $data[] = [
						//htmlentities($row->idarchivo),
                        htmlentities($cant),
                        htmlentities($row->cons_nombres),
                        htmlentities($row->cons_dni),
                        htmlentities($row->cons_casado),
                        htmlentities($row->cons_fecha),
                  
                    
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
			$sql = "SELECT * FROM stm_constancia_no_matrimonio a INNER JOIN stm_anio b on a.idanio=b.idanio where  idcontancianomatrimonio = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3,$v4,$v5,$v6)
	{ 
       // var_dump($v6);exit;
		try {
			$sql = "INSERT INTO stm_constancia_no_matrimonio (idusuario,idanio,cons_nombres,cons_dni,cons_casado,cons_fecha) VALUES(?,?,?,?,?,?)";
			$stm = $this->cone->prepare($sql); 
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6]);
			if($stm->rowCount() > 0){
                $msg['est'] = true;
                $msg['msj'] = 'se registró correctamente';
                $msg['icon'] = 'success';
                return $msg;
            } else {
                $msg['est'] = false;
                $msg['msj'] = 'error al registrar';
                $msg['icon'] = 'error';
                return $msg;
            }
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
    }

    public function edi($v3,$v4,$v5,$id) {
		try {   
                $sql="UPDATE stm_constancia_no_matrimonio SET cons_nombres=?,cons_dni=?,cons_casado=? WHERE idcontancianomatrimonio=?";
                $stm = $this->cone->prepare($sql);
			    $stm->execute([$v3,$v4,$v5,$id]);
            
            	
			if($stm->rowCount() > 0){
                $msg['est'] = true;
                $msg['msj'] = 'se actualizó correctamente';
                $msg['icon'] = 'success';
                return $msg;
            } else {
                $msg['est'] = false;
                $msg['msj'] = 'error al actualizar';
                $msg['icon'] = 'error';
                return $msg;
            }
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
	}
	
	public function del($id) {
            try{	
				$sql = "DELETE FROM stm_constancia_no_matrimonio WHERE  idcontancianomatrimonio = ?";
                $stm =  $this->cone->prepare($sql);
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


    public function print($v1,$v2,$id) {
		try {   

                $sql="UPDATE stm_constancia_no_matrimonio SET arc_numrecivo=?, arc_fecha=? WHERE idcontancianomatrimonio=?";
                $stm = $this->cone->prepare($sql);
			    $stm->execute([$v1,$v2,$id]);
           
                if($stm->rowCount() > 0){
                    $msg['est'] = true;
                    $msg['msj'] = 'se registró correctamente';
                    $msg['icon'] = 'success';
                    $msg['id'] = $id;
                    return $msg;
                } else {
                    $msg['est'] = false;
                    $msg['msj'] = 'error al registrar';
                    $msg['icon'] = 'error';
                    $msg['id'] = $id;
                    return $msg;
                }
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
	}
	

	public function nombre_anio()
	{
		try {
			$sql = "SELECT  * FROM stm_anio WHERE ani_estado!=0 order by idanio DESC LIMIT 1";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

    public function combox()
	{
		try {
			$sql = "SELECT * FROM stm_constancia_no_matrimonio";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


}
