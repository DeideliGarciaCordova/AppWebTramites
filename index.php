<?php
require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/config/componentes.php';
require_once __DIR__ . '/config/funciones.php';

 //define('URL', '//'. $_SERVER['SERVER_NAME'].'/');
define('URL', '//'. $_SERVER['SERVER_NAME'].':8080' .'/tramites/');

 define('COD', 'AES-128-ECB'); 
 define('KEY', 'DGC');


 session_start();
 //date_default_timezone_set("America/Lima");
 
	//dar color principal de fondo al sistema
	define('COLOR_PRINCIPAL',"success");
	
 

$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$url = explode('/', $url);
if (isset($_SESSION['st_idusuario'])) {

	require_once 'model/model.permisos.php';
	$perm = new ModelPermisos();
	$controlador=!empty($url[0])?$url[0]:'accedi'; 
	if($controlador == 'salir'){
		//$_SESSION = [];
		session_destroy();
		header ('Location: '.URL);
		exit;
	}


	if($controlador != 'accedi'  && $controlador != 'cambiarclave' && $controlador != 'miperfil' &&  $_SESSION['st_isadmin']!=1 ){
		$dato = $perm->permisos($_SESSION['st_idusuario'], $controlador);

			if(!empty($dato)){
				$controlador = $dato->sm_control;
			}else{
				include_once 'vista/errorpermiso.php';
				exit;
			}
	}


} else {
	$controlador="stseguridad";
}


$metodo = isset($url[1])?$url[1]:'listar';

$archivo="controlador/controler.".$controlador.".php";

if (file_exists($archivo)) {

	include_once $archivo;
	$clase =  ucfirst( $controlador);
	if (class_exists($clase)) {
		$obj = new $clase;
		if (method_exists($obj, $metodo)) {
			$obj->$metodo();
		} 
	} 
	
} 

?>
