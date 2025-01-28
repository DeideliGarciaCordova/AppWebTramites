<?php
class Constancianomatrimonio
{
	
	
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{

	
		require_once 'model/model.stacciones.php';
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower('constancianomatrimonio');
        require_once 'model/model.' . $this->archivo . '.php';
        $modelo = 'Model' . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}
	
	public function listar($v1 = '') {
		// var_dump($_POST);exit;
        if (isset($_POST) && !empty($_POST)) {
			//var_dump($_POST);exit;
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
            include_once __DIR__ . '/../vista/lst' . $this->archivo . '.php';
        }
    }

	public function add()
	{
		if (isset($_POST) && !empty($_POST)) {
			//var_dump($_POST);
			//var_dump($_FILES['txt6']);exit;
            $v1=$_SESSION["st_idusuario"];
            $id_anio=$this->modelo->nombre_anio();
            $v2=$id_anio->idanio; 
			$v3 = $_POST['txt2'];
			$v4 = $_POST['txt3'];  
			if($_POST['txt4']=="rbtsi") {$v5 = 1;} else {$v5 = 0;}

			//var_dump($v5);exit;
			$v6 = date("Y-m-d");

			$rpt = $this->modelo->add($v1,$v2,$v3,$v4,$v5,$v6);
			echo json_encode($rpt);
		} else {
			
            $name_anio=$this->modelo->nombre_anio();

			include_once 'vista/frm' . $this->archivo . '.php';
		}
	}
	public function edi()
	{
		if (isset($_POST) && !empty($_POST)) {

			$id = $_POST['txt0'];
			//if (isset($_POST['txt1'])) {$v1 = $_POST['txt1'];} else {$v1 = '';}
			if (isset($_POST['txt2'])) {$v3 = $_POST['txt2'];} else {$v3 = '';}
			if (isset($_POST['txt3'])) {$v4 = $_POST['txt3'];} else {$v4 = '';}
			//$v4=date('Y-m-d H:i:s');
			if($_POST['txt4']=="rbtsi") {$v5 = 1;} else {$v5 = 0;}
		
			$rpt = $this->modelo->edi($v3,$v4,$v5,$id);
			echo json_encode($rpt);
		} else {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$name_anio=$this->modelo->nombre_anio();
				$obj = $this->modelo->mostrar($id);
				//$comb=$this->categoria->combox();
				include_once 'vista/frm' . $this->archivo . '.php';
			}
		}
	}
	public function del()
	{
		if (isset($_REQUEST['id'])) {
			$id = $_REQUEST['id'];
			$this->modelo->del($id);
		}
	}

	

	public function mostrarpdf()
	{  
		$data = $this->modelo->mostrar($_GET['id']);
		include_once 'vista/pdfconstancianomatrimonio.php';
	}
}
