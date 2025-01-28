<?php
class Reportelicenciafunc
{
	
	
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{


		$this->archivo = strtolower("reportelicenciafunc");
        require_once "model/model." . $this->archivo . ".php";
        $modelo = "Model" . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}
	
	public function listar($v1 = "") {
            include_once "vista/rpt" . $this->archivo . ".php";

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




    //REPORTE DE licencias de funcionamiento
     public function reporte() { 
     		
	    if (isset($_REQUEST)) {
	    	var_dump($_REQUEST);
	        if (isset($_REQUEST["txt1"])) {$v1 = $_REQUEST["txt1"];} else {$v1 = "";}
			if (isset($_REQUEST["txt2"])) {$v2 = $_REQUEST["txt2"];} else {$v2 = "";}

	        //$valor=$_POST['valor'];
	         $data = $this->modelo->reporte1($v1,$v2);

			//echo "<pre>";
			//var_dump($data);
	       
		   $info_empresa = $this->modelo->info_empresa();//var_dump($info_empresa);exit;
	        include_once "vista/pdf" . $this->archivo . ".php";
	    } 
      
    }
}
