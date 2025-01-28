
<?php
class ModelChofer extends Conexion
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
                $criterio = " WHERE (idchofer LIKE '%$search%'  OR cho_nombres LIKE '%$search%'  OR cho_dni LIKE '%$search%'  OR cho_telefono LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM alm_chofer  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idchofer DESC LIMIT $start, $length");
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
                    $id = $row->idchofer;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;
                           

                    
                    $cant++;
                    $data[] =[
						//htmlentities($row->idchofer),
htmlentities($row->cho_nombres),
htmlentities($row->cho_dni),
htmlentities($row->cho_telefono),
                        
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
			$stm = $this->cone->prepare("SELECT * FROM alm_chofer  WHERE  idchofer =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3 )
	{
		try {
			$sql = "INSERT INTO alm_chofer(cho_nombres,cho_dni,cho_telefono ) VALUES(?,?,? )";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3 ]);
			if($stm->rowCount() > 0){
				$msg["est"] = true;
				$msg["msj"] = "se registró correctamente";
				$msg["icon"] = "success";               
			} else {
				$msg["est"] = false;
				$msg["msj"] = "error al registrar";
				$msg["icon"] = "error";
			}
			return $msg;
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
    }


     public function edi($v1,$v2,$v3 ,$id) {
		try {   
            $sql="UPDATE alm_chofer SET cho_nombres=?,cho_dni=?,cho_telefono=?  WHERE idchofer  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3 ,$id]);
			if($stm->rowCount() > 0){
				$msg["est"] = true;
				$msg["msj"] = "se actualizó correctamente";
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
				$sql = "DELETE FROM alm_chofer WHERE  idchofer = ?";
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
			$sql = "SELECT * FROM alm_chofer ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
}
