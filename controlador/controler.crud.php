<?php
class Crud
{
    private $archivo;
	public function __construct()
	{


		$this->archivo = strtolower('crud');

	}


	public function listar()
	{
		

            include_once 'vista/frm' . $this->archivo . '.php';

	}
    public function generar()
	{

		$colum=[];
		$imputs=$variables_frm=$php_data=$thead="";
		$contador=0;
		#CONTROLADOR
		$variables_add=$parametros_add="";
		$variables_edi=$parametros_edi="";

		#MODEL
		$variables_lst="";
		$buscador_lst="";
		$campos_add=$signos_add=$campos_adi="";
		$or=" OR ";
        if (isset($_POST) && !empty($_POST)) {
	//echo "<pre>";
	//var_dump($_POST);exit;
	$name_class= $_POST['txt1'];
	$name_table= $_POST['txt2'];
	$campos_table= $_POST['txt3'];
	$explode=explode(',',str_replace('`', ' ', $campos_table) );

   $a=" ";
   $b=$c=",";

 #variable para no agregar al ultimo el separador
	for ($p=0; $p < count($explode) ; $p++) {	
		$array =  explode(' ', trim($explode[$p])) ;
		$colum[$p]=$array[0];


		$thead.='<th>'.$colum[$p].'</th>'.chr(13);
		#MODEL
			#para funcion listar
			if($p==(count($explode)-1)){$or=" " ;}
			$variables_lst.="htmlentities($"."row->".$colum[$p]."),".chr(13);
			$buscador_lst.=$colum[$p]." LIKE '%$"."search%' ".$or;
	}

	for ($i=1; $i < count($explode) ; $i++) {		
		//$array =  explode(' ', trim($explode[$contador])) ;
			//echo "<pre>";
			if($i==(count($explode)-1)){$a="' ';" ;}				
			
			$variables_frm.="$"."v".$i."=".$a;
			$php_data.='$v'.$i.'=htmlentities($obj->'.$colum[$i].');'.chr(13).'';

			$imputs.=' <div class="form-group row">
							<label for="txt'.$i.'" class="col-sm-3 col-form-label">'.$colum[$i].'</label>
							<div class=" col-lg-9">
								<input type="text" class="form-control w-100" name="txt'.$i.'" id="txt'.$i.'" value="<?php echo $v'.$i.'; ?>"  required />
							</div>
						</div>';

			
			//$colum[$contador]=$array[0];
			

			#CONTROLER
			#para funcion add
			$variables_add.='$v'.$i.' = $_POST["txt'.$i.'"];'.chr(13);
			if($i==(count($explode)-1)){$b=" " ;}
			$parametros_add.='$v'.$i.$b;

			#para funcion edi
			$variables_edi.='if (isset($_POST["txt'.$i.'"])) {$v'.$i.' = $_POST["txt'.$i.'"];} else {$v'.$i.' = "";}'.chr(13);
			$parametros_edi.='$v'.$i.',';

			#MODEL
			#para funcion add
			if($i==(count($explode)-1)){$c=" " ;}
			$campos_add.=$colum[$i].$c;
			$signos_add.="?".$c;
			#para funcion edi
			
			$campos_adi.=$colum[$i]."=?".$c;
			$contador++;
	} 

    // echo strtolower($name_class);
//var_dump($colum);
     $archivo_model = fopen("model/model.".strtolower($name_class).".php", "w+b"); 
     $archivo_controlador = fopen("controlador/controler.".strtolower($name_class).".php", "w+b"); 
     $archivo_vista_lista = fopen("vista/lst".strtolower($name_class).".php", "w+b"); 
     $archivo_vista_form = fopen("vista/frm".strtolower($name_class).".php", "w+b"); 
    if($archivo_model != false || $archivo_controlador != false ||$archivo_vista_lista != false ||$archivo_vista_form != false  ){

    	 $id=6;
    	 //$p= chr(39).'<input type="hidden" name="txt0" value="'.chr(39).' . $id .'.chr(39).' ">'.chr(39);
    	$frm='<?php 
    		 $v'. 0 .'='.$variables_frm.'				
				
				if (isset($id, $obj)) {
					
				 $title = "EDITAR  " . strtoupper($this->archivo); 
				 $v0 = '.chr(39).'<input type="hidden" name="txt0" value="'.chr(39).' . $id .'.chr(39).' ">'.chr(39) .';
				'.$php_data.'
				
						
			}else{
				$title = "CREAR  " . strtoupper($this->archivo); 
						
			}
			
		?>
			<form id="idForm" onsubmit="return fn_submit(this)" class="needs-validation" novalidate enctype="multipart/form-data" autocomplete="off">
					<div class="modal fade" id="modalForm" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="modalForm" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg " role="document">
							<div class="modal-content border-0 rounded-0 shadow-lg">
								<div class="modal-header border-0 rounded-0 text-white <?php echo '.chr(39).'bg-'.chr(39).' . COLOR_PRINCIPAL; ?> " style="cursor: move">
									<h5 class="modal-title" id="modalForm"><?php echo $title ?> </h5>
									<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<?php echo $v0 ?>								
                    
									'.$imputs.'
                   
								</div>							
								
								<div class="modal-footer border-0 bg-light">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary">Guardar</button>
								</div>
							</div>
						</div>
					</div>

					
				</form>		
			';



			$lst='<?php 
include "vga/nav.php"; 
include "vga/asider.php";
include "vga/header.php";
?>


<style>.swal-overlay {background-color: transparent !important;}.swal-modal {box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;}.modal-backdrop {background-color: #fff;}</style>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"> 
                   <nav class="navbar navbar-light bg-light">
                       
                        <h4 class="col-12 col-lg-8 text-<?php echo COLOR_PRINCIPAL; ?> ">Listado de <?php echo $this->archivo; ?></h4>
                        <div class=" text-right">
                            <button onclick="fn_add(this)" class="btn   btn btn-sm btn-outline-success <?php echo $crear;?>"><i class="fa fa-plus"></i> <span class="d-none d-sm-inline-block"> Nuevo</span></button>
                            <a href="<?php echo URL . "/" . $this->archivo ?>" class="btn btn-sm btn-outline-primary btn "><i class="fa fa-sync"></i> <span class="d-none d-sm-inline-block"> Recargar</span></a>
                        </div>
                        <div class="card-tools">
                            
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool d-none" data-card-widget="remove"><i
                                    class="fas fa-remove"></i></button>
                        </div>
                    </nav>
                    
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                   '.$thead.'
                                   <th ></th>
                                </tr>
                            </thead>
                            
                               
                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div id="resp"></div>

<?php 
    include "vga/footer.php";
    include "vga/jscrud.php";
?>
<script src="<?php echo URL ?>/dist/js/sweetalert.min.js"></script>


</body>

</html>';

$controler='<?php
class '.ucfirst($name_class).'
{
	
	
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{

		require_once "model/model.stacciones.php";
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower("'.$name_class.'");
        require_once "model/model." . $this->archivo . ".php";
        $modelo = "Model" . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}
	
	public function listar($v1 = "") {
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['.chr(39).'start'.chr(39).'], $_POST['.chr(39).'draw'.chr(39).'], $_POST['.chr(39).'length'.chr(39).'], $_POST['.chr(39).'search'.chr(39).']['.chr(39).'value'.chr(39).'])) {
                $start = $_POST['.chr(39).'start'.chr(39).'];
                $draw = $_POST['.chr(39).'draw'.chr(39).'];
                $length = $_POST['.chr(39).'length'.chr(39).'];
                $search = $_POST['.chr(39).'search'.chr(39).']['.chr(39).'value'.chr(39).'];

                $data = $this->modelo->listar($draw, $start, $length, $search);
                echo json_encode($data);
            } 
        } else {
			if($_SESSION["st_idcargo"]!=1){
				$crear="d-none";
				$obj=$this->objstacciones->mostrar_permisosid($this->archivo,$_SESSION["st_idusuario"]);
				$obj1=$this->objstacciones->mostrar_acciones($obj->idpermiso);

					//var_dump($obj1);exit;
				foreach($obj1 as $row){
					if($row->idaccion==1 && $row->pa_estado==1){$crear="";}
				}
			}
            include_once "vista/lst" . $this->archivo . ".php";
        } 
    }

	public function add()
	{
		if (isset($_POST) && !empty($_POST)) {
			'.$variables_add.'			
			$rpt = $this->modelo->add('.$parametros_add.');
			echo json_encode($rpt);
		} else {	
			include_once "vista/frm" . $this->archivo . ".php";
		}
	}

	

	public function edi()
	{
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST["txt0"];
			'.$variables_edi.'
					
			$rpt = $this->modelo->edi('.$parametros_edi.' $id);
			echo json_encode($rpt);
		} else {
			if (isset($_GET["id"])) {
				$id = $_GET["id"];			
				$obj = $this->modelo->mostrar($id);
				include_once "vista/frm" . $this->archivo . ".php";
			}
		}
	}
	public function del()
	{
		if (isset($_REQUEST["id"])) {
			$id = $_REQUEST["id"];
			$this->modelo->del($id);
		}
	}

	
}
';

$modelo='
<?php
class Model'.ucfirst($name_class).' extends Conexion
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
                $criterio = " WHERE ('.$buscador_lst.' ) ";

            }
            $sql = " SELECT * FROM '.$name_table.'  $criterio";

            $flt = $db->prepare($sql);
            $flt->execute();
            $total = $flt->rowCount();
 
            $stm = $db->prepare($sql . " ORDER BY '.$colum[0].' DESC LIMIT $start, $length");
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
                    $id = $row->'.$colum[0].';
					    $btnedit='.chr(39).'<button title="Editar" onclick="fn_edi(this, '.chr(39).'. $id .'.chr(39).')" class="btn btn-primary btn-sm '.chr(39).'.$editar.'.chr(39).'"><i class="fas fa-edit"></i></button>'.chr(39).';

					    $btndel='.chr(39).'<button title="Eliminar" onclick="fn_del(this,'.chr(39).'. $id .'.chr(39).');" class="btn btn-danger btn-sm '.chr(39).' .$eliminar.'.chr(39).'"><i class="fas fa-minus-circle"></i></button>'.chr(39).';

					$acc =$btnedit.$btndel ;
                           

                    
                    $cant++;
                    $data[] =[
						'.$variables_lst.'                        
                        '.chr(39).'<div class="btn-group">'.chr(39).' . $acc . '.chr(39).'</div>'.chr(39).'
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
			$stm = $this->cone->prepare("SELECT * FROM '.$name_table.'  WHERE  '.$colum[0].' =?");
			$stm->execute([$v1]);
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function add('.$parametros_add.')
	{
		try {
			$sql = "INSERT INTO '.$name_table.'('.$campos_add.') VALUES('.$signos_add.')";
			$stm = $this->cone->prepare($sql);
			$stm->execute(['.$parametros_add.']);
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


     public function edi('.$parametros_add.',$id) {
		try {   
            $sql="UPDATE '.$name_table.' SET '.$campos_adi.' WHERE '.$colum[0].'  = ?";
			$stm = $this->cone->prepare($sql);
			$stm->execute(['.$parametros_add.',$id]);
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
				$sql = "DELETE FROM '.$name_table.' WHERE  '.$colum[0].' = ?";
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
			$sql = "SELECT * FROM '.$name_table.' ";
			$stm = $this->cone->prepare($sql);
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	
}
';

      	
	  	fwrite($archivo_model, $modelo);
	  	fwrite($archivo_controlador, $controler);
	  	fwrite($archivo_vista_lista, $lst);
	  	fwrite($archivo_vista_form,$frm);

	    fclose($archivo_model);
	    fclose($archivo_controlador);
	    fclose($archivo_vista_lista);
	    fclose($archivo_vista_form);

	    echo "ok";
   } else{
    	echo "no";
   }
   }
}
    




}
