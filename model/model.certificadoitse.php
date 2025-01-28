<?php
class ModelCertificadoitse extends Conexion
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
                $criterio = " WHERE (ci_expediente LIKE '%$search%' OR ci_solicitante LIKE '%$search%' OR ci_establecimiento
				 LIKE '%$search%'  OR ci_direccion LIKE '%$search%' OR ci_voucher LIKE '%$search%' OR ci_monto LIKE '%$search%'
				 OR ci_finforme LIKE '%$search%' OR ci_nombreinspector LIKE '%$search%'  ) ";
          
            }
            $sql = " SELECT * FROM stm_certificado_itse   $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idcertificadoitse DESC LIMIT $start, $length");
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
                    $id = $row->idcertificadoitse;
                    $archivo="";
					    $btnedit='<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

                        $archivo='<a title="ver constancia" href="'.URL.'/certificadoitse/certificadoitse?id='.$id.'" class="btn btn-warning btn-sm"><i class="fas fa-file"></i></a>'
                        .'<a title="ver constancia" href="'.URL.'/certificadoitse/certificadoitse2?id='.$id.'" class="btn btn-success btn-sm"><i class="fas fa-file"></i></a>';
                       

					$acc =$btnedit.$btndel ;
                           
                    if ($row->ci_cumplecondiciones == true) {
						$est = '<i class="fas fa-check text-success"></i>';
					} else {
						$est = '';
					}
                    
                    $cant++;
                    $data[] = [
						htmlentities($id),
                        htmlentities($row->ci_expediente),
                        htmlentities($row->ci_solicitante),
                        htmlentities($row->ci_establecimiento),
                        htmlentities($row->ci_direccion),
                        $row->ci_voucher,
                        htmlentities('S/'.$row->ci_monto),
                        $row->ci_finforme,
                        htmlentities($row->ci_nombreinspector),
                        $est,
                        htmlentities($row->ci_nivelriesgo),
                                               
                        '<div class="btn-group">' . $acc .$archivo . '</div>',
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
			$sql = "SELECT * FROM stm_certificado_itse a INNER JOIN stm_anio b on a.idanio=b.idanio  inner join sunat_ciiu c on a.idciiu =c.idciiu  where  idcertificadoitse = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

    public function countxanio($v1)
	{
		try {
			$sql = "SELECT * FROM stm_certificado_itse a INNER JOIN stm_anio b on a.idanio=b.idanio where  b.idanio = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1]);
			return $stm->rowCount();
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($idu,$ida,$codigo,$vf,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23)
	{ 
       // var_dump($v6);exit;
            if ($v14 == 'on') {
                $v14 = true;
            } else {
                $v14 = false;
            }
		try {
			$sql = "INSERT INTO stm_certificado_itse(`idusuario`, `idanio`,`ci_codigo`,`ci_fresolucion`,`ci_expediente`, `ci_fexpediente`, `ci_solicitante`, 
            `ci_establecimiento`, `ci_direccion`, `ci_distrito`, `ci_provincia`, `ci_departamento`, `ci_voucher`, 
            `ci_monto`, `ci_informe`, `ci_finforme`, `ci_nombreinspector`, `ci_cumplecondiciones`, `ci_nivelriesgo`,
             `ci_capacidadestablecimiento`, `ci_areaocupada`, `ci_vigencia`, `ci_lugar`, `ci_fexpedicion`, 
             `ci_fsolicitudrevalidacion`,`idciiu`,`ci_capacidadestablecimientoletras`)
             VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stm = $this->cone->prepare($sql); 
			$stm->execute([$idu,$ida,$codigo,$vf,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23]);
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

    public function edi($idu,$vf,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$id) {
        if ($v14 == 'on') {
            $v14 = 1;
        } else {
            $v14 = 0;
        }
		try {   

            $sql="UPDATE stm_certificado_itse SET `idusuario`=?,`ci_fresolucion`=?, `ci_expediente`=?, `ci_fexpediente`=?, `ci_solicitante`=?, 
            `ci_establecimiento`=?, `ci_direccion`=?, `ci_distrito`=?, `ci_provincia`=?, `ci_departamento`=?, `ci_voucher`=?, 
            `ci_monto`=?, `ci_informe`=?, `ci_finforme`=?, `ci_nombreinspector`=?, `ci_cumplecondiciones`=?, `ci_nivelriesgo`=?,
             `ci_capacidadestablecimiento`=?, `ci_areaocupada`=?, `ci_vigencia`=?, `ci_lugar`=?, `ci_fexpedicion`=?, 
             `ci_fsolicitudrevalidacion`=?,`idciiu`=?,`ci_capacidadestablecimientoletras`=? WHERE idcertificadoitse=?";
            $stm = $this->cone->prepare($sql);
			$stm->execute([$idu,$vf,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$id]);           
            	
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
				$sql = "DELETE FROM stm_certificado_itse WHERE  idcertificadoitse = ?";
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
	


    public function mostrar_ciiu($v1)
	{
		$row = [];
		try {
			$stm = $this->cone->prepare("SELECT * FROM sunat_ciiu WHERE idciiu=? ");
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


  public function combo_ciiu()
	{
		try {
		
			$sql = "SELECT * FROM sunat_ciiu  ORDER BY idciiu DESC  ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	
    public function b_ciiu($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND cii_nombre LIKE '%$b%'  ";
			}
			$sql = "SELECT * FROM sunat_ciiu WHERE 1 $buscar ORDER BY idciiu DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idciiu,
						'text' => $row->cii_nombre
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
