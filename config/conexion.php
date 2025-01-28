<?php
class Conexion  
{
	
	public function conectar(){
		try{
			 $url="mysql:host=localhost;dbname=bdtramites;charset=utf8";
		    $con=new PDO($url,"root","");
		    // $url="mysql:host=144.217.123.236;dbname=munipic1_tramites;charset=utf8";
		    //$con=new PDO($url,"munipic1_dey","r}^)YMD!P+A*");
		    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		   
		}catch( PDOException $e){
			echo $e->getMessage();
			exit;
		}catch( Exception $ex){
			echo $ex->getMessage();
			exit;
		}

		
		return $con;
	}

}
?>