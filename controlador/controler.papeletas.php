<?php
class Papeletas
{
	
	
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{

		require_once "model/model.stacciones.php";
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower("Papeletas");
        require_once "model/model." . $this->archivo . ".php";
        $modelo = "Model" . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}
	
	public function listar($v1 = "") {
        if (isset($_POST) && !empty($_POST)) {
            if (isset($_POST['start'], $_POST['draw'], $_POST['length'], $_POST['search']['value'])) {
                $start = $_POST['start'];
                $draw = $_POST['draw'];
                $length = $_POST['length'];
                $search = $_POST['search']['value'];

                $data = $this->modelo->listar($draw, $start, $length, $search);
                echo json_encode($data);
            } 
        } else {
			if($_SESSION["st_isadmin"]!=1){
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
			$v1 = $_POST["txt1"];
$v2 = $_POST["txt2"];
$v3 = $_POST["txt3"];
$v4 = $_POST["txt4"];
$v5 = $_POST["txt5"];
$v6 = $_POST["txt6"];
$v7 = $_POST["txt7"];
			
			$rpt = $this->modelo->add($v1,$v2,$v3,$v4,$v5,$v6,$v7 );
			echo json_encode($rpt);
		} else {	
			include_once "vista/frm" . $this->archivo . ".php";
		}
	}

	

	public function edi()
	{
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST["txt0"];
			if (isset($_POST["txt1"])) {$v1 = $_POST["txt1"];} else {$v1 = "";}
if (isset($_POST["txt2"])) {$v2 = $_POST["txt2"];} else {$v2 = "";}
if (isset($_POST["txt3"])) {$v3 = $_POST["txt3"];} else {$v3 = "";}
if (isset($_POST["txt4"])) {$v4 = $_POST["txt4"];} else {$v4 = "";}
if (isset($_POST["txt5"])) {$v5 = $_POST["txt5"];} else {$v5 = "";}
if (isset($_POST["txt6"])) {$v6 = $_POST["txt6"];} else {$v6 = "";}
if (isset($_POST["txt7"])) {$v7 = $_POST["txt7"];} else {$v7 = "";}

					
			$rpt = $this->modelo->edi($v1,$v2,$v3,$v4,$v5,$v6,$v7, $id);
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

	

	public function b_motivosalida()
	{
		
		if (isset($_POST['_type']) && $_POST['_type'] == 'query') {
			$q = isset($_POST['q']) ? $_POST['q'] : '';
			$data = $this->modelo->b_motivosalida($q);

			$data['results'] = $data;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}


	public function filtrar_x_fecha() { 
     
            
	    if (isset($_POST['start'], $_POST['draw'], $_POST['length'], $_POST['search']['value'])) {
	        $start = $_POST['start'];
	        $draw = $_POST['draw'];
	        $length = $_POST['length'];
	        $search = $_POST['search']['value'];
	        $f1=$_REQUEST['f1'];
	        $f2=$_REQUEST['f2'];
	               

	        $data = $this->modelo->filtrar_x_fecha($draw, $start, $length,$f1,$f2, $search);
	        echo json_encode($data);
	    } 
      
    }
}
