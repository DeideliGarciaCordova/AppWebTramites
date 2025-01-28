<?php

function genero($v1 = '')
{
	if ($v1 == 'M') {
		$sel1 = 'selected';
	} else {
		$sel1 = '';
	}

	if ($v1 == 'F') {
		$sel2 = 'selected';
	} else {
		$sel2 = '';
	}
	echo '<option value="M" ' . $sel1 . '>Masculino</option>' .
		'<option value="F" ' . $sel2 . '>Femenino</option>';
}


function str_fecha($fechaFormato)
{
	if (substr($fechaFormato, 2, 1) == '/') {
        $dia = substr($fechaFormato, 0, 2);
        $mes = substr($fechaFormato, 3, 2);
        $anio = substr($fechaFormato, 6, 4);

        $fecha = $anio . '-' . $mes . '-' . $dia;
    } else {
        $anio = substr($fechaFormato, 0, 4);
        $mes = substr($fechaFormato, 5, 2);
        $dia = substr($fechaFormato, 8, 2);
        $fecha = $dia . "/" . $mes . "/" . $anio;
    }
    $fecha.=' '.substr($fechaFormato,11);
    return $fecha; 
}

function caracteres($a, $b, $c, $d) {
    $cadena = '';
    if ($a != '') {
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    }
    if ($b != '') {
        $cadena .= "abcdefghijklmnopqrstuvwxyz";
    }
    if ($c != '') {
        $cadena .= "0123456789";
    }
    if ($d != '') {
        $cadena .= "#%-*_?!()&=,.";
    }
    return substr($cadena, (rand() % strlen($cadena)), 1);
}
function generar_password($max) {
    $cadena = "";
    for ($i = 0; $i < $max; $i++) {
        $cadena .= caracteres('1', '1', '1', '1');
    }
    return $cadena;
}

function generar_cadena($max) {
    $cadena = "";
    for ($i = 0; $i < $max; $i++) {
        $cadena .= caracteres('1', '1', '1', '');
    }
    return $cadena;
}
function addceros($txt, $cuantos = 4, $caracter = '0') {
    $tcd = str_pad($txt, $cuantos, $caracter, STR_PAD_LEFT);
    return $tcd;
}

function generar_numeros($max) {
    $cadena = "";
    for ($i = 0; $i < $max; $i++) {
        $cadena .= caracteres('', '', '1', '');
    }
    return $cadena;
}

function ofusca($tzd) {
    $tzd = strrev($tzd);
    $fe = date('d/m/Y');
    $tzd = '||' . $fe . '||' . $tzd;
    $tzd = base64_encode($tzd);
    return $tzd;
}
function encripta($tcd){
    return openssl_encrypt($tcd,COD, KEY);    
}
function desencripta($tcd){
    return openssl_decrypt($tcd,COD, KEY);    
}
function desofusca($tzd) {
    $tzd = base64_decode($tzd);
    $tzd = strrev($tzd);
    $tzd = substr($tzd, 0, -14);
    return $tzd;
}
function fecha_es($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $numeroDia." de ".$nombreMes." del ".$anio;
  }
function ver_edad($date) {
    if ($date !='' and $date !='0000-00-00' ){
    list($Y, $m, $d) = explode("-", $date);
    return( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
    }else {return '';}
}

function ver_ip_tcd() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}
function vida($user_name, $pass, $ip, $tcd) {
    $data= json_encode($_REQUEST);
    $cadena = '->' . date('Y-m-d H:i:s') . ' => ' . $user_name . ' => ' . $pass . ' => ' . $ip . ' => ' . $tcd. ' => ' . $data;
    $nuevoarchivo = fopen('.vgalog.tcd', "a+");
    fwrite($nuevoarchivo, $cadena . "\n");
    fclose($nuevoarchivo);
}
function sga_apireniec($dni,$fec){    
    define ('API_URL','http://190.216.182.52:6464/');
    //define ('API_URL','http://scr-servicios.sunarp.gob.pe:6464/');
    define ('API_SGA','Common.svc/ValidaDNIFecEmision');//controlador
    if (($dni)==''){exit();}
    
    $ip =ver_ip_tcd();
    $url= API_URL.API_SGA;
    $data = array(
        "personDni"=>"$dni","dateEmi"=>"$fec",
        "authorizedUser" => "",
        "systemName" => "SGA","systemUser" => "Web",
        "ipAddress"  => "$ip","appVersion" => "2.0"
        );

    $content = json_encode($data);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/plain"));

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    $response = json_decode($json_response, true);
    return (json_encode($response));
}

function texto_negrita($text){
    $txt='<b>'.$text.'</b>';
    return $txt;
}
