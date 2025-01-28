<?php
class Cambiarclave
{
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{
		require_once 'model/model.stacciones.php';
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower('cambiarclave');
        require_once 'model/model.' . $this->archivo . '.php';
        $modelo = 'Model' . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}
	public function listar() {
        if (isset($_POST) && !empty($_POST)) {
            
			if (isset($_POST['txt1'])) {$v1 = $_POST['txt1'];} else {$v1 = '';}
            //if (isset($_POST['txt2'])) {$v2 = $_POST['txt2'];} else {$v2 = '';}
            if (isset($_POST['txt3'])) {$v3 = $_POST['txt3'];} else {$v3 = '';}
			$id=$_SESSION["st_idusuario"];
        //var_dump($id);
			$rpt = $this->modelo->edi($v1,$v3,$id);
			echo json_encode($rpt);
		} else {			
                include_once 'vista/frm' . $this->archivo . '.php';

		}
       
    }

    public function verificarclave_1y2() {
        if (isset($_POST) && !empty($_POST)) {
			$clave = $_POST['clave'];
            $pass=strrev(encripta($clave));
            if($pass==$_SESSION["st_clave"]){  echo "ok"; }else{echo "no";}           
			
		}
       
    }




}
