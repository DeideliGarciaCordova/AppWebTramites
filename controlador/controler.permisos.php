<?php
class Permisos
{
	
	
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{

		require_once 'model/model.stacciones.php';
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower('permisos');
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
			if($_SESSION["st_isadmin"]!=1){
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
			//echo "<pre>";
			//var_dump($_POST);exit;
			$v1 = $_POST['txt2'];
			$v2 = $_POST['txt3'];

			if (isset($_POST['chkCr'])){$chkCr = $_POST['chkCr'];}else{$chkCr='';}
			if (isset($_POST['chkEd'])){$chkEd = $_POST['chkEd'];}else{$chkEd='';}
			if (isset($_POST['chkEl'])){$chkEl = $_POST['chkEl'];}else{$chkEl='';}
			 
			$rpt = $this->modelo->add($v1,$v2,$chkCr,$chkEd,$chkEl);
			echo json_encode($rpt);
		} else {
			$cbomenu = $this->modelo->comboxmenu();
			$cbousuarios = $this->modelo->comboxusuarios();
			//var_dump($cbomenu);exit;
			include_once 'vista/frm' . $this->archivo . '.php';
		}
	}

	
	
	public function edi()
	{
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST['txt0'];
			//echo "<pre>";
			//var_dump($_POST);exit;
			if (isset($_POST['txt2'])) {$v1 = $_POST['txt2'];} else {$v1 = '';}
			if (isset($_POST['txt3'])) {$v2 = $_POST['txt3'];} else {$v2 = '';}

			if (isset($_POST['chkCr'])){$chkCr = $_POST['chkCr'];}else{$chkCr='';}
			if (isset($_POST['chkEd'])){$chkEd = $_POST['chkEd'];}else{$chkEd='';}
			if (isset($_POST['chkEl'])){$chkEl = $_POST['chkEl'];}else{$chkEl='';}

			$rpt=$this->modelo->edi($v1,$v2,$chkCr,$chkEd,$chkEl,$id);
			echo json_encode($rpt);
			
		} else {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$objacciones = $this->objstacciones->mostrar_acciones($id);
				//var_dump($objacciones);exit;
				$obj = $this->modelo->mostrar($id);
				
				
				$cbomenu = $this->modelo->comboxmenu();
				$cbosubmenu = $this->modelo->comboxsubmenu($id);
				$cbousuarios = $this->modelo->comboxusuarios();
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

	
	public function combox1()
	{
		if (isset($_POST) && !empty($_POST)) {
			$idp = $_POST['idp'];
			$idm = $_POST['idm'];
			
			$cbosubmenu = $this->modelo->comboxsubmenu($idm);
			$objpermiso = $this->modelo->mostrar($idp);
			$select = '';
			echo "<pre>";
			//var_dump($objpermiso);var_dump($cbosubmenu);exit;
			foreach ($cbosubmenu as $row) {
				$seld ='';
				if ($row->idsubmenu == $objpermiso->idsubmenu) {
					$seld = 'selected';
				}
				$select .= '<option value="' . $row->idsubmenu . '" ' . $seld . '>' . $row->sm_nombre . '</option>';
			}
			echo '<option value="">Seleccionar</option>';
			echo $select;
		}
	}
}
