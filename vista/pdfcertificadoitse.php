<?php
//var_dump($data);exit;
require_once 'libs/mpdf/vendor/autoload.php';

//$Arrayfecha=explode(' ', fecha_es(date('y-m-d')));

$comple = ($data->ci_cumplecondiciones) ? 'CUMPLE' : 'NO COMPLE' ;
$tbody = '';
$html ='
 <div class="container">
        <div id="logo">
            <div class="col-img">
                 <img src="'.URL.'\vista\img/logo-picota.png" height="60" >
            </div>
          <div class="col-logo">
            <h5 style="margin-bottom: 0px;">MUNICIPALIDAD PROVINCIAL DE PICOTA</h5>
            <p id="eslogan">"'.$data->ani_eslogan.'"</p>
          </div>
          <div class="col-logo">
            <h5  style="margin-bottom: 7px;" >GERENCIA DE INFRAESTRUCTURA Y DESARROLLO TERRITORIAL</h5>
          </div>
          <div class="col-logo">
             <h5  style="margin-bottom:7px;">OFICINA DE GESTION DE RIESGOS Y DESASTRES</h5>
          </div>
        </div>
        <div class="anio">
            '.mb_strtoupper($data->ani_nombre).'
        </div>

           <h2 class="titulo">CERTIFICADO DE INSPECCIÓN TÉCNICA DE SEGURIDAD EN EDIFICACIONES PARA ESTABLECIMIENTOS OBJETO DE INSPECCIÓN CLASIFICADOS CON NIVEL DE RIESGO MEDIO SEGUN LA MATRIZ DE RIESGOS</h2>
             
           <h4 class="codigo">N° '.$data->ci_codigo.'</h4>
           <h4 class="resolucion">RESOLUCIÓN Nº 006-2023 - OGRD-GIDT-GM/MPP</h4>
           <p class="organoejecutable">Órgano ejecutante de la inspección técnica de seguridad en edificaciones, en cumplimiento de lo establecido el <strong>D.S N° 002 -2018-PCM</strong>, ha realizado la
            <strong>inspección técnica de seguridad en edificaciones</strong> al establecimiento</p>
            <h1 class="instituto">" '.mb_strtoupper($data->ci_establecimiento).'"</h1>
            <div class="fila">
                <p class="txtsmall">(Edificación/Establecimiento/Instalación)</p>                
            </div>
            <div class="fila">
                <div style="width: 10%;float:left;">Ubicacion</div>
                <div style="width: 90%;float:left;border-bottom:1px solid #000;text-align: left; font-size: 16px;padding-bottom:-2px ;"><strong>:'.mb_strtoupper($data->ci_direccion).'</strong> </div>
                <p class="txtsmall">(Edificación/Establecimiento/Instalación)</p>
                
            </div>

            <div class="fila">
                <div style="width: 100px;float:left;">Distrito</div>
                <div style="width: 245px;float:left;border-bottom:1px solid #000;text-align: left;"> <strong>: '.mb_strtoupper($data->ci_distrito).' </strong> </div>
                <div style="width: 70px;float:left;">Provincia</div>
                <div style="width: 242px;float:left;border-bottom:1px solid #000;text-align: left;"> <strong>: '.mb_strtoupper($data->ci_provincia).' </strong></div>
                <div style="width: 110px;float:left;">Departamento</div>
                <div style="width: 240px;float:left;border-bottom:1px solid #000;text-align: left;"> <strong>: '.mb_strtoupper($data->ci_departamento).' </strong> </div>
            </div><br>
            <div class="fila"> 
                <div style="width: 10%;float:left;">Solicitado por: </div>
                <div style="width: 90%;float:left;border-bottom:1px solid #000;text-align: left; font-size: 18px;">:<strong>'.$data->ci_solicitante.'</strong></div>
                <p class="txtsmall">(Nombre del propetario,Representante legal,conductor o administrador)</p>
            </div>
            <div class="fila">
                <p style="padding:2px 0px;margin:0px;font-size:14px;">El que suscribí <strong>CERTIFICA</strong> que el objeto de la inspección antes señalado <strong>'.$comple.'</strong>  con la normativa en materia de seguridad en edificaciones vigente.</p>
            </div>
            

            <div class="fila">
                <div style="width: 20%;float:left;">Capcidad maxima del local: </div>
                <div style="width: 80%;float:left;border-bottom:1px solid #000;text-align: left;padding-bottom:-2px ; "><strong>230</strong>&nbsp;&nbsp;&nbsp;&nbsp;  ( DOSCIENTOS Y TREITA ) personas</div>
               <p class="txtsmall" style="margin-left:200px;text-align:left;">(En Numeros)&nbsp;&nbsp;(En Letras)</p>
            </div> 
            <div class="fila">
                <p style="margin:3px;">Giro o actividad de la Edificacion:'. $data->cii_nombre.'.</p>
            </div>

            <div class="fila">
                <div style="width: 250px;float:left;font-size:12px;"><strong>ARIA OCUPADA DE LA EDIFICACION:</strong> </div>
                <div style="width: 200px;float:left;text-align: left; font-size:12px;border-bottom:1px solid #000;"> <strong> '.$data->ci_capacidadestablecimiento.' M²</strong> </div>
                <div style="width: 300px;float:left;font-size:12px;"><strong>LUGAR:</strong> </div>
                <div style="width: 255px;float:left;text-align: left;font-size:12px;border-bottom:1px solid #000;"> <strong> '.mb_strtoupper($data->ci_lugar).' </strong></div>

                 <div style="width: 250px;float:left;font-size:12px;"><strong>EXPEDIENTE Nº:</strong> </div>
                <div style="width: 200px;float:left;text-align: left; font-size:12px;border-bottom:1px solid #000;"><strong>'.mb_strtoupper($data->ci_expediente).'  </strong> </div>
                <div style="width: 300px;float:left;font-size:12px;"><strong>FECHA DE EXPEDICION:</strong> </div>
                <div style="width: 255px;float:left;text-align: left;font-size:12px;border-bottom:1px solid #000;"> <strong> '.mb_strtoupper(fecha_es($data->ci_fexpedicion)).' </strong></div>

                 <div style="width: 250px;float:left;font-size:12px;"><strong>VIGENCIA:</strong> </div>
                <div style="width: 200px;float:left;text-align: left; font-size:12px;border-bottom:1px solid #000;"> <strong>'.mb_strtoupper($data->ci_vigencia).'</strong> </div>
                <div style="width: 300px;float:left;font-size:12px;"><strong>FECHA DE SOLICITUD DE REVALIDACION:</strong> </div>
                <div style="width: 255px;float:left;text-align: left;font-size:12px;border-bottom:1px solid #000;"> <strong>'.mb_strtoupper(fecha_es($data->ci_fsolicitudrevalidacion)).'</strong></div>

                <div style="width: 300px;float:left;font-size:9px;margin-left:452px;">B(treita dias hábiles anteriores a la fecha  de caducidad) </div>
                <div style="width: 200px;float:left;text-align: center; font-size:10px;"> (D/M/A)</div>
            </div>

            <div class="fila" style="margin-top:40px;">
                <div style="width: 120px;float:left;font-size:12px;"><strong>(FIRMA Y SELLO)</strong> </div>
                
                <div style="width: 350px;float:left;text-align: left;font-size:12px;border-bottom:1px solid #000;"> <strong>&nbsp; </strong></div>
            </div>
            <div class="fila" >
            <p style="font-size:10px;padding:2px 0px;margin:1px 0px;">"El presente certificado de ITSE no constituye autorización alguna para l funcionamiento del objeto de la presente inspeccion"</p>
             </div>
             <div style="width: 100px;font-size:10px;margin:0px;padding:0px;"><strong>NOTA:</strong> </div>

             <p style="font-size:9px;margin:0px;padding:0px;">De acuerdo a lo establecido en el reglamento de inspecciones técnicas de seguridad en edificaciones aprobado por decreto supremo N° 002-2018 pcm, el presente certificado deberá ser firmado por el responsable del órgano ejecutante, este certificado deberá   colocarse en lugar visible dentro de establecimiento objeto de inspección, cualquier tacha o enmendadura invalida del presente certificado.</p>
    </div>
';




$stylesheet = file_get_contents( __DIR__ . '/css_reporte/pdfcertificadoitse.css'); // external css

#add type fonts 
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$pdf = new \Mpdf\Mpdf(['orientation' => 'L','format' => 'A4-L',

  'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/css_reporte/fonts',
    ]),
    'fontdata' => $fontData + [ // lowercase letters only in font key
        'brush' => [

            'R' => 'Debutan Brush Script.ttf',
        ]
    ]
  ]);


$pdf->AddFontDirectory('fonts');
#codificacion de utf8 
#$pdf->allow_charset_conversion = true;
#$pdf->charset_in = 'utf-8';



$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>