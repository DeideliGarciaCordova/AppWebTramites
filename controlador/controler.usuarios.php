<?php
class Usuarios
{
	private $modelo;
    private $archivo;
	private $objstacciones;
	private $personal;
	public function __construct()
	{		
        require_once 'model/model.personal.php';
        $this->personal = new Modelpersonal();

		require_once 'model/model.stacciones.php';
		$this->objstacciones = new ModelStacciones();


		$this->archivo = strtolower('usuarios');
        require_once 'model/model.' . $this->archivo . '.php';
        $modelo = 'Model' . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}

	public function listar($v1 = '') {

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
                $v1 = $_POST['txt1'];
                $v2 = $_POST['txt2'];
                //$v3 = $_POST['txt3'];
				if (isset($_POST['txt4'])){$v4 = $_POST['txt4'];}else{$v4='';}
                
                $rpt= $this->modelo->add($v1, $v2, $v4);
                echo json_encode($rpt);			
            } else {
            	$cbomenu = $this->personal->combox();
                include_once 'vista/frm' . $this->archivo . '.php';
            }
	}
	public function edi()
	{
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST['txt0'];
			if (isset($_POST['txt1'])){$v1 = $_POST['txt1'];}else{$v1='';}
            if (isset($_POST['txt2'])){$v2 = $_POST['txt2'];}else{$v2='';}
            //if (isset($_POST['txt3'])){$v3 = $_POST['txt3'];}else{$v3=false;}
			if (isset($_POST['txt4'])){$v4 = $_POST['txt4'];}else{$v4='';}
			
			
			$rpt=$this->modelo->edi($v1, $v2, $v4, $id);
			                    echo json_encode($rpt);

		} else {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$obj = $this->modelo->mostrar($id);
				$cbomenu = $this->personal->combox();
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

	public function resetear_clave()
	{
            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
				$idp = $_REQUEST['idp'];
                $rpt=$this->modelo->resetear_clave($idp,$id);
				echo json_encode($rpt);

            }
	}
	
}