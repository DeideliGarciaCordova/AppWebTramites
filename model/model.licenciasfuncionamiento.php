
<?php
class ModelLicenciasfuncionamiento extends Conexion
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
		$search=strtoupper($search);
        $data = [];
        $total = $criterio = $btnedit=$btndel = "";
		$editar=$eliminar="d-none";
        $cant=0;
        try {
            $db = $this->cone;
            if (!empty($search)) {
                $criterio = " WHERE (idlicenciafuncionamiento LIKE '%$search%'  OR usu_nombre LIKE '%$search%'  OR lf_codigo LIKE '%$search%'  OR lf_razonsocial LIKE '%$search%'  OR lf_nombrecomercial LIKE '%$search%'  OR lf_ruc LIKE '%$search%'  OR lf_dni LIKE '%$search%'  OR lf_ubicacion LIKE '%$search%'  OR lf_girode LIKE '%$search%'  OR lf_area LIKE '%$search%'  OR lf_horarioatencion LIKE '%$search%'    OR lf_tipolicencia LIKE '%$search%'  OR lf_numexpediente LIKE '%$search%' OR if_fecharegistro  LIKE '%$search%' OR nr_nombre  LIKE '%$search%' ) ";

            }
            $sql = " SELECT * FROM stm_licencias_funcionamiento a INNER JOIN adv_usuarios  b on a.idusuario=b.idusuario INNER JOIN  stm_nivelriesgo c on a.idnivelriesgo=c.idnivelriesgo   $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idlicenciafuncionamiento DESC LIMIT $start, $length");
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
                    $id = $row->idlicenciafuncionamiento;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>'
					    .'<a title="ver constancia" href="'.URL.'/licenciasfuncionamiento/licencia?id='.$id.'" class="btn btn-success btn-sm"><i class="fas fa-file"></i></a>';
					$acc =$btnedit.$btndel ;
                           

                    
                    $cant++;
                    $data[] =[
						htmlentities($row->idlicenciafuncionamiento),
						htmlentities($row->usu_nombre),
						htmlentities($row->lf_codigo),
						htmlentities($row->lf_razonsocial),
						htmlentities($row->lf_nombrecomercial),
						htmlentities($row->lf_ruc),
						htmlentities($row->lf_dni),
						htmlentities($row->lf_ubicacion),
						htmlentities($row->lf_girode),
						htmlentities($row->lf_area),
						htmlentities($row->lf_horarioatencion),
						htmlentities($row->lf_tipolicencia),
						htmlentities($row->lf_numexpediente),
						$row->if_fecharegistro,
						htmlentities($row->nr_nombre),
						$row->lf_fechaemision,
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
			$stm = $this->cone->prepare(" SELECT * FROM stm_licencias_funcionamiento a INNER JOIN adv_usuarios  b on a.idusuario=b.idusuario  WHERE  idlicenciafuncionamiento =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	

	public function add($v1,$ida,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15 )
	{
		try {
			$sql = "INSERT INTO stm_licencias_funcionamiento(idusuario,idanio,lf_codigo,lf_razonsocial,lf_nombrecomercial,lf_ruc,lf_dni,lf_ubicacion,lf_girode,lf_area,lf_horarioatencion,lf_tipolicencia,lf_numexpediente,if_fecharegistro,idnivelriesgo,lf_fechaemision) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$ida,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15]);
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


     public function edi($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12 ,$id) {                                               
		try {   
            $sql="UPDATE stm_licencias_funcionamiento SET lf_razonsocial=?,lf_nombrecomercial=?,lf_ruc=?,lf_dni=?,lf_ubicacion=?,lf_girode=?,lf_area=?,lf_horarioatencion=?,lf_tipolicencia=?,lf_numexpediente=?,idnivelriesgo=?,lf_fechaemision=? WHERE idlicenciafuncionamiento  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$id]);
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
				$sql = "DELETE FROM stm_licencias_funcionamiento WHERE  idlicenciafuncionamiento = ?";
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
			$sql = "SELECT * FROM stm_licencias_funcionamiento ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}



	 public function countxanio($v1)
	{
		try {
			$sql = "SELECT * FROM stm_licencias_funcionamiento a INNER JOIN stm_anio b on a.idanio=b.idanio where  b.idanio = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1]);
			return $stm->rowCount();
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


	 public function mostrar_nivelriesgo($v1)
	{
		$row = [];
		try {
			$stm = $this->cone->prepare("SELECT * FROM stm_nivelriesgo  WHERE idnivelriesgo=? ");
			$stm->execute([$v1]);

			if ($stm->rowCount() > 0) {
				$row =  $stm->fetch(PDO::FETCH_OBJ);
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $row;
	}



	public function b_nivelriesgo($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND nr_nombre LIKE '%$b%' ";
			}
			$sql = "SELECT * FROM stm_nivelriesgo WHERE 1 $buscar ORDER BY idnivelriesgo  DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idnivelriesgo ,
						'text' => $row->nr_nombre
					];
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $data;
	}
	
}
