<?php
class Miperfil
{
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct()
	{
		require_once 'model/model.stacciones.php';
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower('miperfil');
        require_once 'model/model.' . $this->archivo . '.php';
        $modelo = 'Model' . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}

	public function listar() {
   		$objperfil= $this->modelo->ver_informacion_personal();
   		//var_dump($obj);
        include_once 'vista/' . $this->archivo . '.php';

    }

   public function edi()
	{
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST['txt0'];
			if (isset($_POST['txt1'])) {$v1 = $_POST['txt1'];} else {$v1 = '';}
			if (isset($_POST['txt2'])) {$v2 = $_POST['txt2'];} else {$v2 = '';}
			if (isset($_POST['txt3'])) {$v3 = $_POST['txt3'];} else {$v3 = '';}
			if (isset($_POST['txt4'])) {$v4 = $_POST['txt4'];} else {$v4 = '';}
			if (isset($_POST['txt5'])) {$v5 = $_POST['txt5'];} else {$v5 = '';}
			if (isset($_POST['txt6'])) {$v6 = $_POST['txt6'];} else {$v6 = '';}
			if (isset($_POST['txt7'])) {$v7 = $_POST['txt7'];} else {$v7 = '';}

			$rpt = $this->modelo->edi($v1, $v2, $v3, $v4, $v5, $v6, $v7, $id);
			echo json_encode($rpt);
		} else {
			$objperfil= $this->modelo->ver_informacion_personal();
   		//var_dump($obj);
          include_once 'vista/' . $this->archivo . '.php';
		}
	}



}
