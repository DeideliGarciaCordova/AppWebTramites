<?php

class Modelreporteactas extends Conexion
{
	public $cone;
	public function __construct()
	{
		$this->cone = parent::conectar();
	}
	
    public function listar($draw, $start, $length, $search = '') {
        //echo $search;exit;
        $data = [];
        $total = $criterio = '';
        $cant=0;

        try {
            $db = $this->cone;
            if (!empty($search)) {
                $criterio = " and (act_persona LIKE '%$search%' OR act_dni LIKE '%$search%' OR act_fnacimiento LIKE '%$search%'  OR act_numrecibo LIKE '%$search%'  ) ";
            }
           // echo $criterio;exit;
            $sql = "SELECT * FROM stm_actas a inner join stm_tipo_acta b on a.idtipoacta=b.idtipoacta  WHERE a.act_fecha IS NOT NULL and act_numrecibo !=''   $criterio";
            //$sql = " SELECT * FROM stm_actas a INNER JOIN stm_tipo_acta b on a.idtipoacta=b.idtipoacta  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();

            $stm = $db->prepare($sql . " ORDER BY idacta DESC LIMIT $start, $length");
            $stm->execute();

            if ($stm->rowCount() > 0) {

                $rows = $stm->fetchAll(PDO::FETCH_OBJ);

                foreach ($rows as $row) {
                    $id = $row->idacta;
                    $cant++;
                    $data[] = [
						//htmlentities($row->idarchivo),
                        htmlentities($cant),
                        htmlentities($row->ta_nombre),
                        htmlentities($row->act_persona),
                        htmlentities($row->act_dni),
                        $row->act_fnacimiento,
                        $row->act_fecha,
                        htmlentities('S/ '.$row->act_precio),
                        htmlentities($row->act_numrecibo),
                        
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

    public function rptactas($f1,$f2,$v1)
	{
        $criterio = '';
		try {
            if (!empty($v1)) {
                $criterio=" AND a.idtipoacta=$v1";
            }
			$stm = $this->cone->prepare("SELECT * FROM stm_actas a inner join stm_tipo_acta b on a.idtipoacta=b.idtipoacta  WHERE a.act_fecha IS NOT NULL and act_numrecibo !=''  and  act_fecha >=? and act_fecha<=? $criterio");
			$stm->execute([$f1,$f2]);

		
            return $stm->fetchAll(PDO::FETCH_OBJ);
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

    public function combox_ta()
	{
		try {
			$sql = "SELECT * FROM stm_tipo_acta";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
?>