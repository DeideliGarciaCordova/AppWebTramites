
<?php
class ModelEmpresa extends Conexion
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
                $criterio = " WHERE (idempresa LIKE '%$search%'  OR emp_razonsocial LIKE '%$search%'  OR emp_ruc LIKE '%$search%'  OR emp_logo LIKE '%$search%'  OR emp_telefono LIKE '%$search%'  OR emp_correo LIKE '%$search%'  OR emp_direccion LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM adv_empresa  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idempresa DESC LIMIT $start, $length");
            $stm->execute();

            if ($stm->rowCount() > 0) {

                $rows = $stm->fetchAll(PDO::FETCH_OBJ);
				
				if($_SESSION["st_isadmin"]!=1){
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
                    $id = $row->idempresa;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;
                           

                    
                    $cant++;
                    $data[] =[
						htmlentities($row->idempresa),
					htmlentities($row->emp_razonsocial),
					htmlentities($row->emp_ruc),
					' <a href="#" class="btn btn-sm d-none  " target="_blank"><i class="fas fa-download"></i> <span class="d-none d-sm-inline-block" ></span></a> <img width="50" src="data:image/jpg;base64,'.base64_encode($row->emp_logo).'">',
					htmlentities($row->emp_telefono),
					htmlentities($row->emp_correo),
					htmlentities($row->emp_direccion),
                        
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
			$stm = $this->cone->prepare("SELECT * FROM adv_empresa  WHERE  idempresa =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3,$v4,$v5,$v6 )
	{
		try {
			$sql = "INSERT INTO adv_empresa(emp_razonsocial,emp_ruc,emp_logo,emp_telefono,emp_correo,emp_direccion ) VALUES(?,?,?,?,?,? )";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6 ]);
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


     public function edi($v1,$v2,$v3,$v4,$v5,$v6 ,$id) {
		try {   

			if($v3!=""){
				$sql="UPDATE adv_empresa SET emp_razonsocial=?,emp_ruc=?,emp_logo=?,emp_telefono=?,emp_correo=?,emp_direccion=?  WHERE idempresa  = ?";
			    $stm = $this->cone->prepare($sql);
			    $stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$id]); 
			}else{
				 
				$sql="UPDATE adv_empresa SET emp_razonsocial=?,emp_ruc=?,emp_telefono=?,emp_correo=?,emp_direccion=?  WHERE idempresa  = ?";
			    $stm = $this->cone->prepare($sql);
			    $stm->execute([$v1,$v2,$v4,$v5,$v6,$id]);
			}
			
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
				$sql = "DELETE FROM adv_empresa WHERE  idempresa = ?";
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
			$sql = "SELECT * FROM adv_empresa ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
}
