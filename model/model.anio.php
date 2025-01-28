
<?php
class ModelAnio extends Conexion
{
	public $cone;
	public $objstacciones;
	public function __construct()
	{
		$this->cone = parent::conectar();

		require_once "model.stacciones.php";
		$this->objstacciones = new ModelStacciones();
	}

		public function listar($draw, $start, $length, $search = "") {
        $data = [];
        $total = $criterio = $btnedit=$btndel = "";
		$editar=$eliminar="d-none";
        $cant=0;
        try {
            $db = $this->cone;
            if (!empty($search)) {
                $criterio = " WHERE (idanio LIKE '%$search%'  OR ani_anio LIKE '%$search%'  OR ani_nombre LIKE '%$search%'  OR ani_estado LIKE '%$search%'  OR ani_eslogan LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM stm_anio  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idanio DESC LIMIT $start, $length");
            $stm->execute();

            if ($stm->rowCount() > 0) {

                $rows = $stm->fetchAll(PDO::FETCH_OBJ);
				
				if($_SESSION["st_idcargo"]!=1){
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
                    $id = $row->idanio;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;
                           
					if ($row->ani_estado == true) {
						$est = '<i class="fa fa-eye"></i>';
					} else {
						$est = '';
					}
                    
                    $cant++;
                    $data[] =[
						htmlentities($row->idanio),
						htmlentities($row->ani_anio),
						htmlentities($row->ani_nombre),
						$est,
						htmlentities($row->ani_eslogan),
                        
                        '<div class="btn-group">' . $acc . '</div>'
                    ];
					
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return [
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "recordsFiltered" => $total,
            "data" => $data
        ];
    }

    public function mostrar($v1)
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM stm_anio  WHERE  idanio =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

    public function add($v1,$v2,$v3,$v4 )
	{
		try {
		//actuaiza todos los estados del ano en estado inactivo
			$rpt=$this->ediEstadoAll();
            
			$sql = "INSERT INTO stm_anio(ani_anio,ani_nombre,ani_estado,ani_eslogan ) VALUES(?,?,?,? )";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4 ]);
		
			if($stm->rowCount() > 0){
				$msg["est"] = true;
				$msg["msj"] = "se registro correctamente";
				$msg["icon"] = "success";               
			} else {
				$msg["est"] = false;
				$msg["msj"] = "error al registrar";
				$msg["icon"] = "error";
			}
			
		//var_dump($msg);exit;
		return $msg;
			

			
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
    }


     public function edi($v1,$v2,$v4 ,$id) {
		try {   
            $sql="UPDATE stm_anio SET ani_anio=?,ani_nombre=?,ani_eslogan=?  WHERE idanio  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v4 ,$id]);
			if($stm->rowCount() > 0){
				$msg["est"] = true;
				$msg["msj"] = "se actualizo correctamente";
				$msg["icon"] = "success";               
			} else {
				$msg["est"] = false;
				$msg["msj"] = "error al actualizar";
				$msg["icon"] = "error";
			}
			return $msg;
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
	}


	public function del($id) {
            try{	
				$sql = "DELETE FROM stm_anio WHERE  idanio = ?";
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

	public function combox()
	{
		try {
			$sql = "SELECT * FROM stm_anio ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


	 public function ediEstadoAll() {
		try {   
            $sql="UPDATE stm_anio SET ani_estado=0";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			if($stm->rowCount() > 0){
				return true;       
			} else {
				return false;
			}
			return $msg;
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
	}
	
}
