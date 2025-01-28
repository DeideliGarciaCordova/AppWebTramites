
<?php
class ModelReportelicenciafunc extends Conexion
{
	public $cone;
	public function __construct()
	{
		$this->cone = parent::conectar();

	}


    


	public function b_usuario($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND usu_nombre LIKE '%$b%' ";
				
			}
			$sql = "SELECT * FROM 	adv_usuarios WHERE 1 $buscar ORDER BY idusuario DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idusuario,
						'text' => $row->usu_nombre
					];
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $data;
	}
	#mostrar el precio para obtener la cantidad en unidades segun la unidad de medida
    public function mostrar_unidadmedida($v1,$v2)
	{
		try {
			$sql = "SELECT * FROM dgc_precios a INNER JOIN dgc_unidadmedida b on  a.idunidadmedida=b.idunidadmedida  WHERE  a.idproducto =?  and a.idunidadmedida=? ";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}



    //REPORTE POR FECHAS
    public function filtrar_x_fecha($draw, $start, $length,$v1,$v2, $search = "")
	{
		$search=strtoupper($search);
		$data = [];
        $total = $criterio = "";
        $cant=0;
  
        try {
            $db = $this->cone;
            if (!empty($search)) {
                $criterio = " and ( lf_codigo LIKE '%$search%'  OR lf_razonsocial LIKE '%$search%'  OR lf_nombrecomercial LIKE '%$search%'  OR lf_ruc LIKE '%$search%'  OR lf_dni LIKE '%$search%'  OR lf_ubicacion LIKE '%$search%'  OR lf_girode LIKE '%$search%'  OR lf_area LIKE '%$search%'  OR lf_horarioatencion LIKE '%$search%'    OR lf_tipolicencia LIKE '%$search%'  OR lf_numexpediente LIKE '%$search%' OR if_fecharegistro  LIKE '%$search%'  ) ";

            }
            $sql = " SELECT * FROM stm_licencias_funcionamiento a INNER JOIN adv_usuarios  b on a.idusuario=b.idusuario where date_format(if_fecharegistro, '%Y-%m-%d')>=? AND date_format(if_fecharegistro, '%Y-%m-%d')<=? $criterio";


 			
 			$flt = $db->prepare($sql);
            $flt->execute([$v1,$v2]);
            $total = $flt->rowCount();

            $stm = $db->prepare($sql . " ORDER BY idlicenciafuncionamiento  ASC LIMIT $start, $length");
            $stm->execute([$v1,$v2]);

            if ($stm->rowCount() > 0) {

                $rows = $stm->fetchAll(PDO::FETCH_OBJ);

               //echo "<pre>";
               foreach ($rows as $row) {
                    $data[] =[
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
						$row->if_fecharegistro

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

	public function reporte1($v1,$v2) 
	{
		try {
			$sql = " SELECT * FROM stm_licencias_funcionamiento a INNER JOIN adv_usuarios  b on a.idusuario=b.idusuario inner join stm_nivelriesgo c on a.idnivelriesgo=c.idnivelriesgo where date_format(if_fecharegistro, '%Y-%m-%d')>=? AND date_format(if_fecharegistro, '%Y-%m-%d')<=? ";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2]);
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
 

	public function info_empresa()
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM `adv_empresa` ORDER by idempresa  DESC LIMIT 1");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
}