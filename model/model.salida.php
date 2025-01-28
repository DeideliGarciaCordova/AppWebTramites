
<?php
class ModelSalida extends Conexion
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
        $total = $criterio = $btnedit=$btndel =  $btnshow= "";
		$editar=$eliminar="d-none";
        $cant=0;
        try {
            $db = $this->cone;
            if (!empty($search)) {
                $criterio = " WHERE (   usu_nombre LIKE '%$search%'  OR cho_nombres LIKE '%$search%'  OR veh_nombre LIKE '%$search%'  OR bie_nombre LIKE '%$search%'  OR sal_fecha LIKE '%$search%'  OR sal_cantidad LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM alm_salida  a inner join adv_usuarios b on a.idusuario=b.idusuario inner join alm_chofer c on a.idchofer=c.idchofer
			inner join alm_vehiculo  d on a.idvehiculo=d.idvehiculo inner  join alm_bien  e on a.idbien=e.idbien  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY idsalida DESC LIMIT $start, $length");
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
                    $id = $row->idsalida;

					if ($row->sal_estado) {
                    	$anulado ='<div style="color: #f50505;"><strong>Anulado</strong></div>';
                    	$habilitado='d-none';
						$habilitado2='';
                    }else{
                    	$anulado ='<div style="color: #56b10b;"><strong>Aceptado</strong></div>'  ;
                    	$habilitado='';
						$habilitado2='d-none';
                    }

					$dato="'".$row->sal_motivoanulacion."'" ;
					    $btnedit='<button title="Editar" onclick="fn_editar(this,'. $id .')" class="btn btn-primary btn-sm '.$habilitado.'"><i class="fas fa-edit"></i></button>';

					    $btndel='<button title="Anular registro" onclick="fn_anular(this,'. $id .');" class="btn btn-danger btn-sm '.$habilitado.'" ><i class="fas fa-minus-circle"></i></button>';
						
						$btnshow='<button title="Eliminar" onclick="fn_show(this,'.$dato.');" class="btn btn-secondary btn-sm '.$habilitado2.'" ><i class="fas fa-eye"></i></button>';

					
					$acc =$btnedit.$btndel.$btnshow;
                           

                    
                    $cant++;
                    $data[] =[
						//htmlentities($row->idsalida),
						htmlentities($row->usu_nombre),
						htmlentities($row->cho_nombres),
						htmlentities($row->veh_nombre.' / '.$row->veh_placa),
						htmlentities($row->bie_nombre),
						htmlentities($row->sal_numvale),
						htmlentities($row->sal_fecha),
						htmlentities($row->sal_cantidad),
						$anulado,
                        
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
			$stm = $this->cone->prepare("SELECT * FROM alm_salida  WHERE  idsalida =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7 )
	{	

		$v8=0;
		try {
			$sql = "INSERT INTO alm_salida(idusuario,idchofer,idvehiculo,idbien,sal_numvale,sal_fecha,sal_cantidad,sal_estado) VALUES(?,?,?,?,?,?,?,? )";
			$stm = $this->cone->prepare($sql);

			$rpt=$this->editar_stock_actual($v4,$v7,$op=0);

			$stm->execute([$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8 ]);

			
			if($stm->rowCount() > 0 &&  $rpt==true){
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


	#mostrar producto para obtener el stock actual
	public function editar_stock_actual($v1,$v2,$op)
	{ 
	   $stock_actual=0;
		try {
			$stm = $this->cone->prepare("SELECT * FROM alm_bien  WHERE  idbien =?");
			$stm->execute([$v1]);
			$registro= $stm->fetch(PDO::FETCH_OBJ);

			if($op==0){$stock_actual=$registro->bie_stock - $v2;}else{$stock_actual=$registro->bie_stock + $v2;	}
			

			//editar el stock actual
			$sql="UPDATE alm_bien SET bie_stock=?  WHERE idbien  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$stock_actual,$v1]);
			if($stm->rowCount() > 0){
				return true;  
			} else {
				return false;
			}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

     public function edi($v1,$v2,$v3,$v4,$v5,$id) {
		try { 
			$registro=$this->mostrar($id);
			$cantidad=$registro->sal_cantidad;
			//var_dump($registro); exit;
			//sumamos el stock del bien por que se editara por la cantidad iingresada el registro
			$this->editar_stock_actual($registro->idbien,$cantidad,$op=1);

			//restamos el stock editado anteriormente  del bien por que se editara cantidad ingresada 
			$this->editar_stock_actual($v3,$v5,$op=0);
            $sql="UPDATE alm_salida SET idchofer=?,idvehiculo=?,idbien=?,sal_numvale=?,sal_cantidad=?  WHERE idsalida  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5,$id]);
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


	public function anular($v1,$id) {
			$registro=$this->mostrar($id);

			//var_dump($registro);exit;
			$cantidad=$registro->sal_cantidad;
			$this->editar_stock_actual($registro->idbien,$cantidad,$op=1);
            try{	
				$sql="UPDATE alm_salida SET sal_estado=1,sal_motivoanulacion=?  WHERE idsalida  = ?";
                $stm =  $this->cone->prepare($sql);
                $stm->execute([$v1,$id]);
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
			$sql = "SELECT * FROM alm_salida ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	


	//buscar  chofer
	public function b_chofer($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND cho_nombres LIKE '%$b%'";
				
			}
			$sql = "SELECT * FROM alm_chofer WHERE 1 $buscar ORDER BY idchofer DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idchofer,
						'text' => $row->cho_nombres
					];
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $data;
	}


	//buscar  vehiculo
	public function b_vehiculo($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND veh_nombre LIKE '%$b%' or  veh_placa LIKE '%$b%'";
				
			}
			$sql = "SELECT * FROM alm_vehiculo WHERE 1 $buscar ORDER BY idvehiculo DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idvehiculo,
						'text' =>$row->veh_nombre.' '.$row->veh_placa
					];
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $data;
	}



	//buscar  vehiculo
	public function b_bien($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND bie_nombre LIKE '%$b%' ";
				
			}
			$sql = "SELECT * FROM alm_bien WHERE 1 $buscar ORDER BY idbien DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idbien,
						'text' => $row->bie_nombre
					];
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $data;
	}

	public function verificar($v1,$v2)
	{
		$v3=date("Y-m-d");
		try {
			$stm = $this->cone->prepare("SELECT * FROM alm_salida  WHERE  idvehiculo =? and idbien= ? and  date_format(sal_fecha,'%Y-%m-%d')=? and sal_estado=0");
			$stm->execute([$v1,$v2,$v3]);
			$stm->fetch(PDO::FETCH_OBJ);
			//print  $stm->rowCount();
			//var_dump();exit;

			//echo $stm->rowCount();exit;
			if($stm->rowCount()> 0){
				return 1;            
			} else {
				return 0;
			}
			 
		} catch (Exception $e) {
			echo $e->getMessage(); 
		}
	}


	public function mostrar_chofer($v1)
	{
		$row = [];
		try {
			$stm = $this->cone->prepare("SELECT * FROM alm_chofer  WHERE idchofer=? ");
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


	public function mostrar_vehiculo($v1)
	{
		$row = [];
		try {
			$stm = $this->cone->prepare("SELECT * FROM alm_vehiculo  WHERE idvehiculo=? ");
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


	public function mostrar_bien($v1)
	{
		$row = [];
		try {
			$stm = $this->cone->prepare("SELECT * FROM alm_bien  WHERE idbien=? ");
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
}
