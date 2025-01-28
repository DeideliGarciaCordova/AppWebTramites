
<?php
class ModelEntrada extends Conexion
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
                $criterio = " WHERE (identrada LIKE '%$search%'  OR idusuario LIKE '%$search%'  OR idtipocomprobante LIKE '%$search%'  OR ent_numcomprobante LIKE '%$search%'  OR ent_total LIKE '%$search%'  OR ent_fecha LIKE '%$search%'   ) ";

            }
            $sql = " SELECT * FROM alm_entradas a  INNER JOIN adv_usuarios b on a.idusuario=b.idusuario INNER JOIN alm_tipocomprobante c on a.idtipocomprobante=c.idtipocomprobante  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY identrada DESC LIMIT $start, $length");
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
                    $id = $row->identrada;
					   // $btnedit='<button title="Editar" onclick="fn_edi(this, '. $id .')" class="btn btn-primary btn-sm '.$editar.'"><i class="fas fa-edit"></i></button>';

					    //$btndel='<button title="Eliminar" onclick="fn_del(this,'. $id .');" class="btn btn-danger btn-sm ' .$eliminar.'"><i class="fas fa-minus-circle"></i></button>';

						$btnverdetalle='<button title="Ver detalles" onclick="mostrar_detalle(this, '. $id .')" class="btn btn-secondary btn-sm "><i class="fas fa-eye"></i></button>';

					$acc =$btnverdetalle ;
                           

                    
                    $cant++;
                    $data[] =[
						//htmlentities($row->identrada),
						htmlentities($row->usu_nombre),
						htmlentities($row->tc_nombre),
						htmlentities($row->ent_numcomprobante),
						htmlentities($row->ent_total),
						htmlentities($row->ent_fecha),
                        
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
			$stm = $this->cone->prepare("SELECT * FROM alm_entradas  WHERE  identrada =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}


	public function add($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8)
	{	//$concepto_kardex='compra';
		//$estado_kardex=1;
		try {
			$stm = $this->cone->prepare("INSERT INTO alm_entradas(idusuario,idtipocomprobante,ent_numcomprobante,ent_total,ent_fecha ) VALUES(?,?,?,?,? )");
			$stm->execute([$v1,$v2,$v3,$v4,$v5]);
				$ide=$this->cone->lastInsertId();
			 	$contador=0;
				$precio=0;
				//$estado=1;

				 for ($i=0; $i <count($v6) ; $i++) { 
					$subtotal=$v7[$i]*$v8[$i];
				 	$this->add_detalleentrada($ide,$v6[$i],$v7[$i],$v8[$i],$subtotal);
 

				 	$stock_actual=$this->obtener_stock_actual($v6[$i],$v8[$i]);


					$this->edi_stock_bien($stock_actual,$v6[$i]);
				 	/*$objprec=$this->ver_precio($v11[$i],$v12[$i]);


				 	$total_estock=($objprec->pre_cantidadenunidades*$v13[$i])+$stock_actual;
				 	
				 	//$cantidad=$objprec->pre_cantidadenunidades*$v13[$i];
				 	$precio=$objprec->pre_precio;
				 	$this->add_kardex($v11[$i],$v12[$i],$v4,$idc,$concepto_kardex,$v5,$v13[$i],$precio,$subt,$estado_kardex);*/

				 	 $contador++;	
				 }


			if($stm->rowCount() > 0 || $contador>0 ){
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

	public function add_detalleentrada($v1,$v2,$v3,$v4,$v5)
	{
		try {
			$sql = "INSERT INTO 	alm_detalleentrada(identrada ,idbien ,de_precio,de_cantidad,de_subtotal) VALUES(?,?,?,?,?)";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5]);
			if($stm->rowCount() > 0){
				return true;           
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
    }
   
	public function edi_stock_bien($v1,$id)
	{
		try {
			$sql = "UPDATE  alm_bien SET  bie_stock=? WHERE idbien=?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$id]);
			if($stm->rowCount() > 0){
				return true;           
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}	
    }

	 #mostrar producto para obtener el stock actual
	 public function obtener_stock_actual($v1,$v2)
	 { 
		$stock_actual=0;
		 try {
			 $stm = $this->cone->prepare("SELECT * FROM alm_bien  WHERE  idbien =?");
			 $stm->execute([$v1]);
			 $registro= $stm->fetch(PDO::FETCH_OBJ);
			 $stock_actual=$registro->bie_stock + $v2;
			 return $stock_actual;
		 } catch (Exception $e) {
			 echo $e->getMessage();
		 }
	 }
	/*public function add($v1,$v2,$v3,$v4,$v5 )
	{
		try {
			$sql = "INSERT INTO alm_entradas(idusuario,idtipocomprobante,ent_numcomprobante,ent_total,ent_fecha ) VALUES(?,?,?,?,? )";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5 ]);
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
    }*/


     public function edi($v1,$v2,$v3,$v4,$v5 ,$id) {
		try {   
            $sql="UPDATE alm_entradas SET idusuario=?,idtipocomprobante=?,ent_numcomprobante=?,ent_total=?,ent_fecha=?  WHERE identrada  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute([$v1,$v2,$v3,$v4,$v5 ,$id]);
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
				$sql = "DELETE FROM alm_entradas WHERE  identrada = ?";
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
			$sql = "SELECT * FROM alm_entradas ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
	//buscar  bien
	public function b_tipocomprobante($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND tc_nombre LIKE '%$b%'";
				
			}
			$sql = "SELECT * FROM alm_tipocomprobante WHERE 1 $buscar ORDER BY idtipocomprobante DESC  LIMIT 10";
			$stm = $this->cone->prepare($sql);
			$stm->execute();

			if ($stm->rowCount() > 0) {
				$rows = $stm->fetchAll(PDO::FETCH_OBJ);
				foreach ($rows as $row) {
					$data[] = [
						'id' => $row->idtipocomprobante,
						'text' => $row->tc_nombre
					];
				}
			}
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $data;
	}



	//buscar  bien
	public function b_bien($b)
	{
		$data = [];

		try {
			$buscar = '';
			if (!empty($b)) {
				$buscar = " AND bie_nombre LIKE '%$b%'";
				
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


	public function mostrar_entrada($v1)
	{
		try {
			$stm = $this->cone->prepare("SELECT * FROM alm_entradas a  INNER JOIN adv_usuarios b on a.idusuario=b.idusuario INNER JOIN alm_tipocomprobante c on a.idtipocomprobante=c.idtipocomprobante WHERE identrada=?;");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function mostrar_detalle_entrada($id)
	{


		$data = [];
        $total = $criterio = "";
        $cant=0;
        $idu=$_SESSION['st_idusuario'];
       // echo $idu.' '.$anio.' '.$mes;exit;
        try {
            $db = $this->cone;

            $sql = " SELECT * FROM alm_detalleentrada a INNER JOIN alm_entradas b on a.identrada=b.identrada INNER JOIN alm_bien c on a.idbien=c.idbien where a.identrada=? ";

            $stm = $db->prepare($sql . " ORDER BY iddetalleentrada  ");
            $stm->execute([$id]);

            if ($stm->rowCount() > 0) {
                $rows = $stm->fetchAll(PDO::FETCH_OBJ);

                foreach ($rows as $row) {

                    $data[] =[
					htmlentities($row->bie_nombre),
					htmlentities($row->de_precio),
					htmlentities($row->de_cantidad),
					htmlentities($row->de_subtotal)	
                    ];
					
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

        return [
            "data" => $data
        ];
    }


}
