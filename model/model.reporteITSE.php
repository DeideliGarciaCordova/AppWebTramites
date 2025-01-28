<?php
class ModelReporteITSE extends Conexion
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
                $criterio = " WHERE (act_persona LIKE '%$search%' OR act_dni LIKE '%$search%' OR act_fnacimiento LIKE '%$search%'  OR act_numrecibo LIKE '%$search%' OR act_numrecibo LIKE '%$search%' OR ta_nombre LIKE '%$search%' ) ";
          
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
					    
                        $archivo='<a title="ver constancia" href="'.URL.'/certificadoITSE/certificadoITSE?id='.$id.'" class="btn btn-warning btn-sm"><i class="fas fa-file"></i></a>'
                        .'<a title="ver constancia" href="'.URL.'/certificadoITSE/certificadoITSE2?id='.$id.'" class="btn btn-success btn-sm"><i class="fas fa-file"></i></a>';
                       

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
			$sql = "SELECT * FROM stm_certificado_itse a INNER JOIN stm_anio b on a.idanio=b.idanio where  idcertificadoitse = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

    public function rptITSE($f1,$f2)
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM stm_certificado_itse  WHERE  ci_fresolucion >=? and ci_fresolucion<=? ");
			$stm->execute([$f1,$f2]);

		
            return $stm->fetchAll(PDO::FETCH_OBJ);
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
