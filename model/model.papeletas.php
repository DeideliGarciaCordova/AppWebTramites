
<?php
class ModelPapeletas extends Conexion
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
                $criterio = " WHERE (idpapeleta LIKE '%$search%'  OR pap_nombres LIKE '%$search%'  OR pap_dependencias LIKE '%$search%'  OR pap_fechasalida LIKE '%$search%'  OR pap_fecharetorno LIKE '%$search%'  OR pap_destino LIKE '%$search%'  OR ms_motivo LIKE '%$search%'  OR pap_fundamentacion LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM stm_papeletas a inner join stm_motivosalida b on a.idmotivosalida=b.idmotivosalida   $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY pap_fechasalida DESC LIMIT $start, $length");
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
                    $id = $row->idpapeleta;
					    $btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

					$acc =$btnedit.$btndel ;
                           

                    
                    $cant++;
                    $data[] =[
						//htmlentities($row->idpapeleta),
						htmlentities($row->pap_nombres),
						htmlentities($row->pap_dependencias),
						htmlentities($row->pap_fechasalida),
						htmlentities($row->pap_fecharetorno),
						htmlentities($row->pap_destino),
						htmlentities($row->ms_motivo),
						htmlentities($row->pap_fundamentacion),
                        
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
			$stm = $this->cone->prepare("SELECT * FROM stm_papeletas  WHERE  idpapeleta =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7 )
	{
		try {
			$sql = "INSERT INTO stm_papeletas(pap_nombres,pap_dependencias,pap_fechasalida,pap_fecharetorno,pap_destino,idmotivosalida,pap_fundamentacion ) VALUES(?,?,?,?,?,?,? )";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$v7 ]);
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


     public function edi($v1,$v2,$v3,$v4,$v5,$v6,$v7 ,$id) {
		try {   
            $sql="UPDATE stm_papeletas SET pap_nombres=?,pap_dependencias=?,pap_fechasalida=?,pap_fecharetorno=?,pap_destino=?,idmotivosalida=?,pap_fundamentacion=?  WHERE idpapeleta  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$v7 ,$id]);
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
				$sql = "DELETE FROM stm_papeletas WHERE  idpapeleta = ?";
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
			$sql = "SELECT * FROM stm_papeletas ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	

	public function b_motivosalida($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND ms_motivo LIKE '%$b%' ";
			}
			$sql = "SELECT * FROM stm_motivosalida WHERE 1 $buscar ORDER BY idmotivosalida  DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idmotivosalida ,
						'text' => $row->ms_motivo
					];
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $data;
	}

	public function mostrar_motivosalida($v1)
	{
		$row = [];
		try {
			$stm = $this->cone->prepare("SELECT * FROM stm_motivosalida  WHERE idmotivosalida =? ");
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


	
    //REPORTE POR FECHAS
    public function filtrar_x_fecha($draw, $start, $length,$v1,$v2, $search = "")
	{
		$data = [];
        $total = $criterio = $btnedit=$btndel = "";
		$editar=$eliminar="d-none";
        $cant=0;
   //echo $v1." --".$v2;exit;
        try {
            $db = $this->cone;
			if (!empty($search)) {
                $criterio = " and (idpapeleta LIKE '%$search%'  OR pap_nombres LIKE '%$search%'  OR pap_dependencias LIKE '%$search%'  OR pap_fechasalida LIKE '%$search%'  OR pap_fecharetorno LIKE '%$search%'  OR pap_destino LIKE '%$search%'  OR ms_motivo LIKE '%$search%'  OR pap_fundamentacion LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM stm_papeletas a inner join stm_motivosalida b on a.idmotivosalida=b.idmotivosalida where date_format(pap_fechasalida, '%Y-%m-%d')>=? AND date_format(pap_fechasalida, '%Y-%m-%d')<=?  $criterio";


 			
 			$flt = $db->prepare($sql);
            $flt->execute([$v1,$v2]);
            $total = $flt->rowCount();

			$stm = $db->prepare($sql . " ORDER BY pap_fechasalida DESC LIMIT $start, $length");
            $stm->execute([$v1,$v2]);

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

				$id = $row->idpapeleta;
				$btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

				$btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

				$acc =$btnedit.$btndel ; 

					$data[] =[
						//htmlentities($row->idpapeleta),
						htmlentities($row->pap_nombres),
						htmlentities($row->pap_dependencias),
						htmlentities($row->pap_fechasalida),
						htmlentities($row->pap_fecharetorno),
						htmlentities($row->pap_destino),
						htmlentities($row->ms_motivo),
						htmlentities($row->pap_fundamentacion),
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
}
