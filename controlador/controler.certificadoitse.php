<?php
class Certificadoitse
{
	private $modelo;
    private $archivo;
	private $objstacciones;
	public function __construct() 
	{
		require_once 'model/model.stacciones.php';
		$this->objstacciones = new ModelStacciones();

		$this->archivo = strtolower('certificadoitse');
        require_once 'model/model.' . $this->archivo . '.php';
        $modelo = 'Model' . ucfirst($this->archivo);
        $this->modelo = new $modelo;
	}
	public function listar($v1 = '') {
	    //echo "Hola";exit;
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
            include_once __DIR__ . '/../vista/lst' . $this->archivo . '.php';
        } 
    }
	public function add()
	{
		if (isset($_POST) && !empty($_POST)) {
			$idu = $_SESSION["st_idusuario"];
			$obja = $this->modelo->nombre_anio();
			$ida=$obja->idanio;
			
			$cant = $this->modelo->countxanio($ida);
			//echo $codigo ;exit;
			if($cant==0){$cant=1;}else{$cant++;}

			$codigo=addceros($cant,3,'0');
			
			$codigo=$codigo.'-'.$obja->ani_anio;
			$vf= $_POST['txtf'];                                    
			$v1 = $_POST['txt1'];
            $v2 = $_POST['txt2'];
			$v3 = $_POST['txt3'];
			$v4 = $_POST['txt4'];
			$v5 = $_POST['txt5'];
            $v6	= $_POST['txt6'];
            $v7 = $_POST['txt7'];
            $v8 = $_POST['txt8'];
			$v9 = $_POST['txt9'];
			$v10 = $_POST['txt10'];
			$v11 = $_POST['txt11'];
			$v12 = $_POST['txt12'];
			$v13 = $_POST['txt13'];
            $v14 = $_POST['txt14'];
            $v15 = $_POST['txt15'];
            $v16 = $_POST['txt16'];
			$v17 = $_POST['txt17'];
			$v18 = $_POST['txt18'];
            $v19 = $_POST['txt19'];
			$v20 = $_POST['txt20'];
			$v21= $_POST['txt21'];
			$v22= $_POST['txt22'];
			$v23= $_POST['txt23'];
			$rpt = $this->modelo->add($idu,$ida,$codigo,$vf,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23);
			echo json_encode($rpt);
		} else {			
			$comb_ciiu=$this->modelo->combo_ciiu();
			
			include_once 'vista/frm' . $this->archivo . '.php';
		}
	}

	public function edi()
	{
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST['txt0'];
			$idu=$_SESSION["st_idusuario"];
			if (isset($_POST['txtf'])) {$vf = $_POST['txtf'];} else {$vf = '';} 
			if (isset($_POST['txt1'])) {$v1 = $_POST['txt1'];} else {$v1 = '';}            
			if (isset($_POST['txt2'])) {$v2 = $_POST['txt2'];} else {$v2 = '';}
			if (isset($_POST['txt3'])) {$v3 = $_POST['txt3'];} else {$v3 = '';}
			if (isset($_POST['txt4'])) {$v4 = $_POST['txt4'];} else {$v4 = '';}
			if (isset($_POST['txt5'])) {$v5 = $_POST['txt5'];} else {$v5 = '';}            
			if (isset($_POST['txt6'])) {$v6 = $_POST['txt6'];} else {$v6 = '';}
			if (isset($_POST['txt7'])) {$v7 = $_POST['txt7'];} else {$v7 = '';}
			if (isset($_POST['txt8'])) {$v8 = $_POST['txt8'];} else {$v8 = '';}
			if (isset($_POST['txt9'])) {$v9 = $_POST['txt9'];} else {$v9 = '';}
			if (isset($_POST['txt10'])) {$v10 = $_POST['txt10'];} else {$v10 = '';}            
			if (isset($_POST['txt11'])) {$v11 = $_POST['txt11'];} else {$v11 = '';}
			if (isset($_POST['txt12'])) {$v12 = $_POST['txt12'];} else {$v12 = '';}
			if (isset($_POST['txt13'])) {$v13 = $_POST['txt13'];} else {$v13 = '';}
			if (isset($_POST['txt14'])) {$v14 = $_POST['txt14'];} else {$v14 = '';}
			if (isset($_POST['txt15'])) {$v15 = $_POST['txt15'];} else {$v15 = '';}
			if (isset($_POST['txt16'])) {$v16 = $_POST['txt16'];} else {$v16 = '';}            
			if (isset($_POST['txt17'])) {$v17 = $_POST['txt17'];} else {$v17 = '';}
			if (isset($_POST['txt18'])) {$v18 = $_POST['txt18'];} else {$v18 = '';}
			if (isset($_POST['txt19'])) {$v19 = $_POST['txt19'];} else {$v19 = '';}
			if (isset($_POST['txt20'])) {$v20 = $_POST['txt20'];} else {$v20 = '';}
			if (isset($_POST['txt21'])) {$v21 = $_POST['txt21'];} else {$v21 = '';}            
			if (isset($_POST['txt22'])) {$v22 = $_POST['txt22'];} else {$v22 = '';} 
			if (isset($_POST['txt23'])) {$v23 = $_POST['txt23'];} else {$v23 = '';} 
	
			$rpt = $this->modelo->edi($idu,$vf,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$v10,$v11,$v12,$v13,$v14,$v15,$v16,$v17,$v18,$v19,$v20,$v21,$v22,$v23,$id);
			echo json_encode($rpt);
		} else {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$obj = $this->modelo->mostrar($id);
				//$comb_ta=$this->modelo->combox_ta();
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


	public function certificadoitse()
	{  
		$data = $this->modelo->mostrar($_GET['id']);
		#echo "<pre>";
		//echo $data->ani_nombre;
		//var_dump($data);exit;
		
		include_once 'vista/pdfcertificadoitse.php';
	}

	public function certificadoitse2()
	{  
		$data = $this->modelo->mostrar($_GET['id']);
		#echo "<pre>";
		//echo $data->ani_nombre;
		//var_dump($data);exit;
		
		include_once 'vista/pdfcertificadoitse2.php';
	}
	

	public function b_ciiu()
	{
		
		if (isset($_POST['_type']) && $_POST['_type'] == 'query') {
			$q = isset($_POST['q']) ? $_POST['q'] : '';
			$data = $this->modelo->b_ciiu($q);

			$data['results'] = $data;
			header('Content-Type: application/json');
			echo json_encode($data);
		}
	}
}
