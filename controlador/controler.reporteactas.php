<?php
class Reporteactas
{
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{   require_once 'model/model.stacciones.php';
		$this->objstacciones = new ModelStacciones();

         
            $this->archivo = strtolower('reporteactas');
        require_once 'model/model.' . $this->archivo . '.php';
        $modelo = 'Model' . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}
	
    public function listar($v1 = '') {
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
            $comb_ta=$this->modelo->combox_ta();
            include_once __DIR__ . '/../vista/lst' . $this->archivo . '.php';
        }
    }

    public function rptactas() { 

        if (isset($_REQUEST) && !empty($_REQUEST)) {       
            $f1=$_REQUEST['f1'];
            $f2=$_REQUEST['f2'];
            $v1=$_REQUEST['txt1'];
            $data=$this->modelo->rptactas($f1,$f2,$v1);
          /*  echo '<pre>';
            var_dump($data);*/
       
            include_once 'vista/pdf' . $this->archivo . '.php';

        }

    }
}
?>