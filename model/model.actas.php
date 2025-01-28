<?php
class ModelActas extends Conexion
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
            $sql = " SELECT * FROM stm_actas a INNER JOIN stm_tipo_acta b on a.idtipoacta=b.idtipoacta  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idacta DESC LIMIT $start, $length");
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
                    $id = $row->idacta;
                    $archivo="";
					    $btnedit='<button title="Editar" onclick="fn_edi(this, ' . $id . ')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Eliminar" onclick="fn_del(this,' . $id . ');" class="btn btn-danger btn-sm '.$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

                        $archivo='<button title="Ver Acta" onclick="fn_print(this, ' . $id . ')" class="btn btn-success btn-sm"><i class="fas fa-print"></i></button>';
                  

					$acc =$btnedit.$btndel ;
                           

                    
                    $cant++;
                    $data[] = [
						htmlentities($id),
                        htmlentities($row->ta_nombre),
                        htmlentities($row->act_persona),
                        htmlentities($row->act_dni),
                        htmlentities($row->act_fnacimiento),
                        $row->act_fecha,
                        htmlentities('S/'.$row->act_precio),
                        htmlentities($row->act_numrecibo),
                                               
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
			$sql = "SELECT * FROM stm_actas a inner join stm_tipo_acta b on a.idtipoacta=b.idtipoacta where  idacta = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9)
	{ 
       // var_dump($v6);exit;
		try {
			$sql = "INSERT INTO stm_actas(idtipoacta,idusuario,act_persona,act_dni,act_fnacimiento,act_fecha,act_numrecibo,act_archivo) VALUES(?,?,?,?,?,?,?,?)";
			$stm = $this->cone->prepare($sql); 
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$v8,$v9]);
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

    public function edi($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$id) {
		try {   
            if($v9!=""){
                $sql="UPDATE stm_actas SET idtipoacta=?,idusuario=?, act_persona=?,act_dni=?,act_fnacimiento=?,act_archivo=? WHERE idacta=?";
                $stm = $this->cone->prepare($sql);
			    $stm->execute([$v1,$v2,$v3,$v4,$v5,$v9,$id]);
            }else{
                $sql="UPDATE stm_actas SET idtipoacta=?,idusuario=?, act_persona=?,act_dni=?,act_fnacimiento=?  WHERE idacta=?";
                $stm = $this->cone->prepare($sql);
			    $stm->execute([$v1,$v2,$v3,$v4,$v5,$id]);
            }
            	
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
				$sql = "DELETE FROM stm_actas WHERE  idacta = ?";
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

    public function print($v1,$v2,$v3,$id) {
		try {   

                $sql="UPDATE stm_actas SET act_numrecibo=?,act_precio=?,act_fecha=? WHERE idacta=?";
                $stm = $this->cone->prepare($sql);
			    $stm->execute([$v1,$v2,$v3,$id]);
           
                if($stm->rowCount() > 0){
                    $msg['est'] = true;
                    $msg['msj'] = 'se registró correctamente';
                    $msg['icon'] = 'success';
                    $msg['id'] = $id;
                    return $msg;
                } else {
                    $msg['est'] = false;
                    $msg['msj'] = 'error al registrar';
                    $msg['icon'] = 'error';
                    $msg['id'] = $id;
                    return $msg;
                }
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

    public function vali_numrecibo($v1)
	{
		try {
			$sql = "SELECT * FROM stm_actas  where  act_numrecibo = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1]);
			//return $stm->fetch(PDO::FETCH_OBJ);

            if($stm->rowCount() > 0){             
                return "ok";
            } else {               
                return "no";
            }
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
