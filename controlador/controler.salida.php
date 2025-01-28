<?php
class Salida
{
	
	
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{

		require_once "model/model.stacciones.php";
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower("salida");
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
			$v1 = $_SESSION['st_idusuario'];
			$v2 = $_POST["txt1"];
			$v3 = $_POST["txt2"]; 
			$v4 = $_POST["txt3"];
			$v5 = $_POST["txt4"];
			$v6 = date("Y-m-d H:i:s"); 
			$v7 = $_POST["txt5"];
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

					
			$rpt = $this->modelo->edi($v1,$v2,$v3,$v4,$v5,$id);
			echo json_encode($rpt);
		} else {
			if (isset($_GET["id"])) {
				$id = $_GET["id"];			
				$obj = $this->modelo->mostrar($id);
				include_once "vista/frm" . $this->archivo . ".php";
			}
		}
	}
	public function anular()
	{
		if (isset($_POST)) {
			$id = $_REQUEST["v1"];
			$v1 = $_REQUEST["v2"];

			$this->modelo->anular($v1,$id);
		}
	}

	
	public function b_chofer()
	{
		
		if (isset($_POST['_type']) && $_POST['_type'] == 'query') {
			$q = isset($_POST['q']) ? $_POST['q'] : '';
			$data = $this->modelo->b_chofer($q);
			$data['results'] = $data;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	public function b_vehiculo()
	{
		
		if (isset($_POST['_type']) && $_POST['_type'] == 'query') {
			$q = isset($_POST['q']) ? $_POST['q'] : '';
			$data = $this->modelo->b_vehiculo($q);
			$data['results'] = $data;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}


	public function b_bien()
	{
		
		if (isset($_POST['_type']) && $_POST['_type'] == 'query') {
			$q = isset($_POST['q']) ? $_POST['q'] : '';
			$data = $this->modelo->b_bien($q);
			$data['results'] = $data;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	//verificar si el vehiculo  fue dado combustible en el mismo dia
	public function verificar()
	{
		
		if (isset($_POST)) {
		

			$v1 = $_POST["idvehiculo"];
			$v2 = $_POST["idbien"];

			$rpt = $this->modelo->verificar($v1,$v2);
			echo $rpt;
		}
	}



	public function mostrar_bien()
	{
		if (isset($_POST)) {
			$v1 = $_POST["id"];
			$rpt = $this->modelo->mostrar_bien($v1);
			echo json_encode($rpt);
		}
	}
}
