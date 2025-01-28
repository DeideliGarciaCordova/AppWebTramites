<?php
require_once 'libs/mpdf/vendor/autoload.php';

$Arrayfecha=explode(' ', fecha_es(date('y-m-d')));

$tbody = '';
$html ='
<div class="contenedor"> 
    <h2 class="codigo">N° '.$data->lf_codigo.'</h2>
    <div class="logo">
        <img src="'.URL.'/vista/img/logo-picota.png" >

    </div>
    
    <h1 class="muni">MUNICIPALIDAD PROVINCIAL DE PICOTA</h1>
    <h1 class="licen">LICENCIA DE FUNCIONAMIENTO</h1>
    <h4 class="ley">Ley N° 28976</h4>
    <h4 class="ordenanza">Ordenanza Municipal N° 007-2023-A/MPP </h4>

    <p class="parafo">En uso de las atribuciones conferidas por la ley orgánica de municipalidades de ley N° 27972, y habiendo cumplido con los requisitos establecidos en la ordenanza O.M. N° 007-2023-A/MPP  modificado Texto Único de Procedimientos Administrativos aprobado por acuerdo de  concejo  Nº 051-2023-A/MPP.</p>

    <p class="parafo">Se otorga la presente licencia   de fundación a favor de:</p>
    <div class="fila">
        <div style="width: 180px;float:left;">Nombre o Razón Social:</div>
        <div style="width: 373px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_razonsocial.'</div>
        
    </div>
    <div class="fila">
        <div style="width: 145px;float:left;">Nombre Comercial:</div>
        <div style="width: 408px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_nombrecomercial.'</div>
        
    </div>
    <div class="fila">
        <div style="width: 125px;float:left;">Número de RUC:</div>
        <div style="width: 140px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_ruc.'</div>
        <div style="width: 180px;float:left;"> Documento de Identidad:</div>
        <div style="width: 108px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_dni.'</div>
        
    </div>
    <div class="fila">
        <div style="width: 215px;float:left;">Ubicación del Establecimiento:</div>
        <div style="width: 338px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_ubicacion.'</div>        
    </div>
    <div class="fila">
        <div style="width: 140px;float:left;">Solo para el giro de:</div>
        <div style="width: 413px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_girode.'</div>        
    </div>
    <div class="fila">
        <div style="width: 50px;float:left;">Área:</div>
        <div style="width: 153px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_area.'</div>
        <div style="width: 150px;float:left;"> Horario de Atención :</div>
        <div style="width: 200px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_horarioatencion.'</div>
        
    </div>
    <div class="fila">
        <div style="width: 170px;float:left;">Fecha de Vencimiento:</div>
        <div style="width: 140px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_tipolicencia.'</div>
        <div style="width: 130px;float:left;">N° de Expediente:</div>
        <div style="width: 113px;float:left;border-bottom:1p solid #000;text-align: center;">'.$data->lf_numexpediente.'</div>
        
    </div>

    <p class="parafo">La Presente Licencia de Funcionamiento No Autoriza  el Uso   de la Vía  Pública.</p>

    <div id="fecha_now"> 
        <div  class="f" style="  width:300px;"> <strong> Picota,</strong> '.fecha_es($data->lf_fechaemision).'</div>
        
        
    </div>

    <p class="parafo" style="margin-top:90px;"><strong>NOTA:</strong>Esta Licencia de Funcionamiento debe ser Exhibida  en Lugar Visible de Conformidad con el Inciso m) Del Articulo 11° de la Ordenanza  N°009-2011-MPP/A, Reglamento General de Licencias de Funcionamiento.</p>
';


$stylesheet = 'body {
    
    background-image: url("'.__DIR__.'/img/licencia funcionamiento.jpg");
    
}
            .contenedor{
                padding-left:  45px;
                margin-left: 50px;

            }
            .codigo{
                text-align: left;
                margin:0px;
                font-size:30px;
            }
            .logo{
                text-align: center;

            }
            .logo, img{
                height: 120px;

            }
            .muni{
                text-shadow: 2px 2px #248A2F;
                font-size:35px;
            }
            .licen{
                color: #ED5615;
                text-shadow: 2px 2px #000000;
                font-size:31px;
                 margin:0px;
            }
            .ley{
                margin:0px;
                
            }
            .ordenanza{
                margin:0px;
                
            }
            .parafo{
                text-align: justify;
                padding:0px 15px ;
                
                
            }
            .fila{
              padding:0px 15px ;
              margin:5px 0px ;
              
            }
            
            #fecha_now{              ; 
                width:98%;

            }
            .f{
            
                float:right;
                margin:0px;
                text-align: center;


            }

            h1,h2,h3,h4,h5{
                text-align: center;
                font-weight: bold;

            }
'; 

$pdf = new \Mpdf\Mpdf(['orientation' => 'P','format' => 'A4-P']);

//$pdf->showImageErrors = true;
$pdf->Image(__DIR__.'/img/licencia funcionamiento.jpg', 0, 0, 210, 297, 'jpg', '', true, false);
//$pdf->Image(__DIR__.'/img/licencia funcionamiento.jpg',0,0,210,297);
//$pdf->Image(__DIR__.'/img/logo-picota.png',100,24,40);
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>