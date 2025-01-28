
<?php
class ModelSolicituditse extends Conexion
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
                $criterio = " WHERE (idsolicituditse LIKE '%$search%'  OR idusuario LIKE '%$search%'  OR idanio LIKE '%$search%'  OR idtipofuncion LIKE '%$search%'  OR idnivelriesgo LIKE '%$search%'  OR idtiposolicitante LIKE '%$search%'  OR si_area LIKE '%$search%'  OR si_numeropisos LIKE '%$search%'  OR si_pisoestablecimiento LIKE '%$search%'  OR si_nombresapellidos LIKE '%$search%'  OR si_dni LIKE '%$search%'  OR si_domicilio LIKE '%$search%'  OR si_correosolicitante LIKE '%$search%'  OR si_telefonosolicitante LIKE '%$search%'  OR si_razonsocial LIKE '%$search%'  OR si_ruc LIKE '%$search%'  OR si_nombrecomercial LIKE '%$search%'  OR si_telefonoestablecimiento LIKE '%$search%'  OR si_ubicacion LIKE '%$search%'  OR si_referenciadirección LIKE '%$search%'  OR si_localidad LIKE '%$search%'  OR si_distrito LIKE '%$search%'  OR si_provincia LIKE '%$search%'  OR si_departamento LIKE '%$search%'  OR si_giro LIKE '%$search%'  OR si_horarioatencion LIKE '%$search%'  OR si_numexpediente LIKE '%$search%'   ) ";

            }
			$sql = " SELECT * FROM stm_solicitud_itse a INNER JOIN adv_usuarios b on a.idusuario=b.idusuario INNER JOIN stm_anio c on a.idanio=c.idanio  INNER JOIN
			 stm_nivelriesgo d on a.idnivelriesgo=d.idnivelriesgo  inner join stm_tipofuncion e on a.idtipofuncion=e.idtipofuncion inner join stm_tiposolicitante  f on a.idtiposolicitante=f.idtiposolicitante $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idsolicituditse DESC LIMIT $start, $length");
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
                    $id = $row->idsolicituditse;
					$btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					// $btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>';
					$btndel='<a title="ver solicitud " target="_blank" href="'.URL.'/solicituditse/solicitud?id='.$id.'" class="btn btn-success btn-sm"><i class="fas fa-file"></i></a>';

					$acc =$btnedit.$btndel ;
                           

                    
                    $cant++;
                    $data[] =[
						 $row->idsolicituditse,
						htmlentities($row->usu_nombre),
						htmlentities($row->ani_anio),
						htmlentities($row->fun_nombre)  ,
						htmlentities($row->nr_nombre),
						htmlentities($row->ts_nombre),
						htmlentities($row->si_area),
						htmlentities($row->si_numeropisos),
						htmlentities($row->si_pisoestablecimiento),
						htmlentities($row->si_nombresapellidos),
						htmlentities($row->si_dni),
						htmlentities($row->si_domicilio),
						htmlentities($row->si_correosolicitante),
						htmlentities($row->si_telefonosolicitante),
						htmlentities($row->si_razonsocial),
						htmlentities($row->si_ruc),
						htmlentities($row->si_nombrecomercial),
						htmlentities($row->si_telefonoestablecimiento),
						htmlentities($row->si_ubicacion),
						htmlentities($row->si_referenciadirección),
						htmlentities($row->si_localidad),
						htmlentities($row->si_distrito),
						htmlentities($row->si_provincia),
						htmlentities($row->si_departamento),
						htmlentities($row->si_giro),
						htmlentities($row->si_horarioatencion),
						htmlentities($row->si_numexpediente),                        
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
			$stm = $this->cone->prepare("SELECT * FROM stm_solicitud_itse a INNER JOIN adv_usuarios b on a.idusuario=b.idusuario INNER JOIN stm_anio c on a.idanio=c.idanio  INNER JOIN stm_nivelriesgo d on a.idnivelriesgo=d.idnivelriesgo  WHERE  idsolicituditse =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$v24,$v25,$v26 )
	{
		try {
			$sql = "INSERT INTO stm_solicitud_itse(idusuario,idanio,idtipofuncion,idnivelriesgo,idtiposolicitante,si_area,si_numeropisos,si_pisoestablecimiento,si_nombresapellidos,si_dni,si_domicilio,si_correosolicitante,si_telefonosolicitante,si_razonsocial,si_ruc,si_nombrecomercial,si_telefonoestablecimiento,si_ubicacion,si_referenciadirección,si_localidad,si_distrito,si_provincia,si_departamento,si_giro,si_horarioatencion,si_numexpediente ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$v24,$v25,$v26 ]);
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


     public function edi($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$v24,$v25,$v26 ,$id) {
		try {   
            $sql="UPDATE stm_solicitud_itse SET idusuario=?,idanio=?,idtipofuncion=?,idnivelriesgo=?,idtiposolicitante=?,si_area=?,si_numeropisos=?,si_pisoestablecimiento=?,si_nombresapellidos=?,si_dni=?,si_domicilio=?,si_correosolicitante=?,si_telefonosolicitante=?,si_razonsocial=?,si_ruc=?,si_nombrecomercial=?,si_telefonoestablecimiento=?,si_ubicacion=?,si_referenciadirección=?,si_localidad=?,si_distrito=?,si_provincia=?,si_departamento=?,si_giro=?,si_horarioatencion=?,si_numexpediente=?  WHERE idsolicituditse  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$v24,$v25,$v26 ,$id]);
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
				$sql = "DELETE FROM stm_solicitud_itse WHERE  idsolicituditse = ?";
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
			$sql = "SELECT * FROM stm_solicitud_itse ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
}
