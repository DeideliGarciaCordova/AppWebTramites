<?php
class Licenciasfuncionamiento
{
	
	
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{

		require_once "model/model.stacciones.php";
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower("licenciasfuncionamiento");
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
			if($_SESSION['st_isadmin']!=1){
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
			$v1 = $_SESSION["st_idusuario"];

			$obja = $this->modelo->nombre_anio();
			$ida=$obja->idanio;
			
			$cant = $this->modelo->countxanio($ida);
			$cant = ($cant>0) ? $cant + 1 : 1 ;

			$v2=addceros($cant,3,'0').'-'.$obja->ani_anio;

			$v3 = $_POST["txt1"];
			$v4 = $_POST["txt2"];
			$v5 = $_POST["txt3"];
			$v6 = $_POST["txt4"];
			$v7 = $_POST["txt5"];
			$v8 = $_POST["txt6"]; 
			$v9 = $_POST["txt7"];
			$v10 = $_POST["txt8"];
			$v11 = $_POST["txt9"];
			$v12 = $_POST["txt10"];
			$v13  = date('Y-m-d H:i:s');
			$v14 = $_POST["txt11"];
			$v15 = $_POST["txt12"];
			
			$rpt = $this->modelo->add($v1,$ida,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15 );
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
			if (isset($_POST["txt8"])) {$v8 = $_POST["txt8"];} else {$v8 = "";}
			if (isset($_POST["txt9"])) {$v9 = $_POST["txt9"];} else {$v9 = "";}
			if (isset($_POST["txt10"])) {$v10 = $_POST["txt10"];} else {$v10 = "";}
			if (isset($_POST["txt11"])) {$v11 = $_POST["txt11"];} else {$v11 = "";}
			if (isset($_POST["txt12"])) {$v12 = $_POST["txt12"];} else {$v12 = "";}		
			$rpt = $this->modelo->edi($v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12, $id);
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

	public function licencia()
	{  
		$data = $this->modelo->mostrar($_GET['id']);

		include_once 'vista/pdflicencia.php';
	}


	public function b_nivelriesgo()
	{
		
		if (isset($_POST['_type']) && $_POST['_type'] == 'query') {
			$q = isset($_POST['q']) ? $_POST['q'] : '';
			$data = $this->modelo->b_nivelriesgo($q);

			$data['results'] = $data;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}

	
}
