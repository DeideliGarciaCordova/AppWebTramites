<?php
class ReporteITSE
{
	private $modelo;
    private $archivo;
	public function __construct() 
	{


		$this->archivo = strtolower('reporteITSE');
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
            include_once __DIR__ . '/../vista/lst' . $this->archivo . '.php';
        } 
    }


    public function rptITSE() { 

        if (isset($_REQUEST) && !empty($_REQUEST)) {       
            $f1=$_REQUEST['f1'];
            $f2=$_REQUEST['f2'];
            $data=$this->modelo->rptITSE($f1,$f2);
            //echo '<pre>';
           // var_dump($data);
       
            include_once 'vista/pdf' . $this->archivo . '.php';

        }

    }
}
