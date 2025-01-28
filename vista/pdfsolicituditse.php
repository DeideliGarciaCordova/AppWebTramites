<?php
require_once 'libs/mpdf/vendor/autoload.php';

$Arrayfecha=explode(' ', fecha_es(date('y-m-d')));


date_default_timezone_set("America/Lima");

$hoy = date("d-m-Y g:i a"); 
$tbody = '';
$html ='
<table  id="tabla" cellspacing="0">
  <tbody>
    <tr>
        <td rowspan="10"><img src="img/logo-picota.png" id="logo"  /></td>
        <td colspan="8" class="c n">SOLICITUD DE INSPECCION TÉCNICA DE SEGURIDAD EN EDIFICACIONES - ITSE Y DE EVALUACION DE CONDICIONES DE SEGURIDAD EN ESPECTACULOS PUBLICOS DEPORTIVOS Y NO DEPORTIVOS -ECSE</td>
       
    </tr>
    <tr>
        <td colspan="8" class="c n">I. INFORMACION GENERAL</td>
    </tr>
    <tr>
        <td colspan="7">I.1 TIPO DE ITSE</td>
        <td>1.2.ECSE</td>
    </tr>
    <tr>
        <td colspan="4">ITSE POSTERIOR AL INCICIO DE ACTIVIDADES (&nbsp; &nbsp; )</td>
        <td colspan="3">ITSE PREVIA AL INCICIO DE ACTIVIDADES (&nbsp; &nbsp; )</td>
        <td>(&nbsp; &nbsp; )</td>
        
    </tr>
    <tr>
        <td>ALMACEN(&nbsp;&nbsp;)</td>
        <td>COMERCIO(&nbsp;&nbsp;)</td>
        <td>EDUCACION(&nbsp;&nbsp;)</td>
        <td>ENCUENTRO(&nbsp;&nbsp;)</td>
        <td>HOSPEDAJE(&nbsp;&nbsp;)</td>
        <td>INDUSTRIAL(&nbsp;&nbsp;)</td>
        <td>OFICINAS ADMINISTRAT(&nbsp;&nbsp;)</td>
        <td>SALUD(&nbsp;&nbsp;)</td>
    </tr>
    <tr>
        <td colspan="8">I.4 CLASIFICACION DE NIVEL DE RIESGO</td>
       
    </tr>
    <tr>
        <td colspan="2"  style="background:#21A040">ITSE riesgo bajo(&nbsp; &nbsp; )</td>
        <td colspan="2" style="background:#F8D709">ITSE riesgo medio(&nbsp; &nbsp; )</td>
        <td colspan="2" style="background:#FFC300">ITSE riesgo alto(&nbsp; &nbsp;)</td>
        <td colspan="2" style="background:#ea3421">ITSE riesgo muy alto(&nbsp; &nbsp; )</td>
        
    </tr>
    <tr>
        <td colspan="8">ORGANO EJECUTANTE: </td>
    </tr>
    <tr>
        <td colspan="8">N° EXPEDIENTE: '.$data->si_numexpediente.' </td>
    </tr>
    <tr>
        <td colspan="4">FECHA PROGRAMADA PARA LA DELIGENCIA DE ITSE:</td>
        <td colspan="4">FECHA PROGRAMADA PARA LA DELIGENCIA DE ACSE:</td>
    </tr>

    <tr>
        <td colspan="9" class="c n">II. DATOS DEL SOLICITANTE</td>
    </tr>
    <tr>
        <td colspan="2">PROPIETARIO( &nbsp; &nbsp;)</td>
        <td colspan="2">REPRESENTANTE LEGAL( &nbsp; &nbsp; )</td>
        <td colspan="2">CONDUCTOR/ADMINISTRADOR( &nbsp; &nbsp; )</td>
        <td colspan="3">ORGANIZADOR/ PROMOTOR( &nbsp; &nbsp; )</td>
        
    </tr>
    <tr>
        <td colspan="9">NOMBRES Y APELLIDOS: <span> '.mb_strtoupper($data->si_nombresapellidos).'</span> </td>
    </tr>
    <tr>
        <td colspan="9">DNI-CARNET DE EXTRANJERIA C.E. N°: <span> '.mb_strtoupper($data->si_dni).'</span> </td>
    </tr>
    <tr>
        <td colspan="9">DOMICILIO:  <span> '.mb_strtoupper($data->si_domicilio).'</span> </td>
    </tr>
    <tr>
        <td colspan="5">CORREO ELECTRONICO: <span> '.mb_strtoupper($data->si_correosolicitante).'</span> </td>
        <td colspan="4">TELEFONO: <span> '.mb_strtoupper($data->si_razonsocial).'</span> </td>
    </tr>
    <tr>
        <td colspan="9" class="c n">III. DATOS ADMINNISTRATIVOS DEL ESTABLECIMIENTO OBJETO DE INSPECCION</td>
    </tr>
    <tr>
        <td colspan="5" >RAZON SOCIAL: <span> '.mb_strtoupper($data->si_razonsocial).'</span> </td>
        <td colspan="4">RUC N°: <span> '.mb_strtoupper($data->si_ruc).'</span> </td>
    </tr>
    <tr>
        <td colspan="5" >NOMBRE COMERCIAL: <span> '.mb_strtoupper($data->si_nombrecomercial).'</span> </td>
        <td colspan="4">TELEFONO: <span> '.mb_strtoupper($data->si_telefonoestablecimiento).'</span> </td>
    </tr>
    <tr>
        <td colspan="5">DIRECCION/UBICACION: <span> '.mb_strtoupper($data->si_ubicacion).'</span> </td>
        <td colspan="4">REFERENCIA DE DIRECCION: <span> '.mb_strtoupper($data->si_referenciadirección).'</span> </td>
    </tr>
    <tr>
        <td colspan="2">LOCALIDAD/BARRIO: <span> '.mb_strtoupper($data->si_localidad).'</span> </td>
        <td colspan="2">DISTRITO: <span> '.mb_strtoupper($data->si_distrito).'</span> </td>
        <td colspan="2">PROVINCIA: <span> '.mb_strtoupper($data->si_provincia).'</span> </td>
        <td colspan="3">DEPARTAMENTO: <span> '.mb_strtoupper($data->si_departamento).'</span> </td>
        
    </tr>
    <tr>
        <td colspan="5">GIRO O ACTIVIDAD QUE REALIZA: <span> '.mb_strtoupper($data->si_giro).'</span> </td>
        <td colspan="4">HORARIO DE ATENCION: <span> '.mb_strtoupper($data->si_horarioatencion).'</span>  </td>
    </tr>
    <tr>
        <td colspan="2">AREA OCUPADA TOTAL(M2): <span> '.mb_strtoupper($data->si_area).'</span>  </td>
        <td colspan="2">NUMERO DE PISOS DE LA EDIFICACION:  <span> '.mb_strtoupper($data->si_numeropisos).'</span>  </td>
        <td colspan="5">PISO DONDE SE ENCUENTRA UBICADO EL ESTABLECIMIENTO OBJETO DE: <span> '.mb_strtoupper($data->si_pisoestablecimiento).'</span> </td>
    </tr>
    <tr>
        <td colspan="9" class="c n">IV. DOCUMENTOS PRESENTADOS</td>
    </tr>
  </tbody>
</table>

<table  id="tabla" cellspacing="0">
  <tbody>
    <tr>
        <td colspan="3">ITSE PORTERIOR AL INICIO DE ACTIVIDADES( &nbsp; &nbsp;) </td>
        <td>ECSE HASTA 3000 PERSONAS ( &nbsp; &nbsp;)</td>
        <td colspan="2">ECSE MAYOR A 3000 PERSONAS ( &nbsp; &nbsp;)</td>
    </tr>
    <tr>
        <td colspan="2">ITSE PORTERIOR AL INICIO DE ACTIVIDADES</td>
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>
        <td colspan="2">ECSE MAYOR A 3000 PERSONAS </td>
        <td class="parentisis"> ( &nbsp; &nbsp;)</td>
    </tr>
    <tr>
        <td colspan="2">a) Recibo de pago</td>
        <td class="parentisis"> (&nbsp; &nbsp; )</td>
        <td colspan="2" rowspan="2">a) Declaracion jurada suscrita por el solicitante: en el caso de persona juridica o de persona natural que actue mediante  representación, el representante legal o apoderado debe consignar los datos registrados de su poder y señalar que e encuentre vigente.</td>
        <td rowspan="2" class="parentisis"> (&nbsp; &nbsp; )</td>
    </tr>
    <tr>
        <td colspan="2">b) Declaracion jurada de cumplimiento de condiciones de seguridad en la edificacion</td>
        <td class="parentisis"> ( &nbsp; &nbsp;)</td>

    </tr>
    <tr>
        <td colspan="3" class="c n">ITSE PREVIA AL INICIO DE ACTIVIDADES ( &nbsp; &nbsp;)</td>
        <td colspan="2">b) Croquis de ubicacion del lugar o recinto donde se tiene previsto realizar el espectaculo</td>     
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>  
    </tr>
    <tr>
        <td colspan="2">a) Croquis de ubicación</td>
        <td class="parentisis"> ( &nbsp; &nbsp; )</td> 
        <td colspan="2">c) Plano de arquitectura indicando la distribucion del escenario, mobilario y otros, asi com el calculo de aforo.</td>     
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>  
    </tr>
    <tr>
        <td colspan="2">b) Plano de arquitectura de distribución existente y detalle de calculo de aforo</td>
        <td class="parentisis"> ( &nbsp; &nbsp; )</td> 
        <td colspan="2">d) Memoria Descriptiva, incluyendo un resumen de la programacion de actividades, del proceso de montaje o acxondicionamiento de estructuras; intalaciones electricas, instlaciones de seguridad y proteccion contra incendios y mobilario.</td>     
        <td class="parentisis">  (&nbsp; &nbsp;  )</td>  
    </tr>
    <tr>
        <td colspan="2">c) Plano de distribución de Tableros Electricos, Programas Unifilares y Cuadro de Cargas</td>
        <td class="parentisis"> ( &nbsp; &nbsp; )</td> 
        <td colspan="2">e) Protocolo de medición del sistema de puesta a tierra con vigencia no menor a un (1) año, en caso haga uso de instalaciones eléctricas</td>     
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>  
    </tr>
    <tr>
        <td colspan="2">d) Certificado vigente de medicion de resistencia del sistema de puesta a tierra</td>
        <td class="parentisis"> (&nbsp; &nbsp;  )</td> 
        <td colspan="2">f) Constancia de operatividad y mantenimiento de extintores, firmado por la empresa responsable.</td>     
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>  
    </tr>
    <tr>
        <td colspan="2">e)Plan de Seguridad y Objeto de Inspeción</td>
        <td class="parentisis"> ( &nbsp; &nbsp; )</td> 
        <td colspan="2">g)Plan de Seguridad para el Evento, que incluya el plano de señalización, rutas de evaluación  y ubicacion de zonas seguras para el asistentes al evento.</td>     
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>  
    </tr>
    <tr>
        <td colspan="2">f) Memoria o Protocolos de pruebas de  operatividad y/o mantenimiento de los equipos de seguridad y proteccion contra</td>
        <td class="parentisis"> ( &nbsp; &nbsp; )</td> 
        <td colspan="2">h) Declaracion jurada de instalación segura del sistema de gas licuado de petrolio(GLP), en caso corresponda.</td>     
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>  
    </tr>
    <tr>        
        <td colspan="2">g) No son exigibles el croquis ni planos a que se refieren los literales a), b) y c) precedente en el caso de edificaciones que cuentan conformidad de obra y no han sufrido modificaciones, siempre que se trate de documentos que fueron presentados a la Municipalidad durante los cinco (5) años anteriores inmediatos, de conformidad con lo establecido en el artículo 46 del Texto Único Ordenado de la Ley N° 27444, Ley del Procedimiento Administrativo General.
       <strong> Indicar Resolución de la Conformidad de Obra:</strong></td>     
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>
        <td colspan="2">i) Memoria o protocolos de pruebas de operatividad y/o mantenimiento de los equipos de seguridad y proteccion contra incendio.</td>
        <td class="parentisis"> ( &nbsp; &nbsp; )</td>   
    </tr>
    <tr>
        <td colspan="3" >RENOVACION DEL CERTIFICADO ITSE (X)</td>
        <td colspan="2" rowspan="2">i) Certificado de ITSE, si se trata de un establecimiento o recinto, en caso  no  lo haya  expedido el mismo Órgano Ejecutante. En caso contrario, se debe consignar la numeracion del mismo en el formato de solicitud.  Indicar numeracion del certificado del ITSE</td>
        <td rowspan="2" class="parentisis"> ( &nbsp; &nbsp; )</td>
    </tr>
    <tr>
        <td >ITSE POSTERIOR ( )</td>
        <td colspan="2">ITSE PREVIA (&nbsp; &nbsp; )</td>         
    </tr>
    <tr>
        <td colspan="3">a) Recibo de Pago( &nbsp; &nbsp;)</td>        
        
    </tr>
    <tr>
        <td colspan="3"> b) Declaración Jurada en el que el  administrado manifiesta que mantiene las Condiciones de seguridad que sustentaron el Otorgamiento del Certificado de ITSE( )</td>       
        <td >Fecha y hora de inicio del espectaculo:         </td>
        <td colspan="2">fecha y hora de Termino del espectaculo:</td>
    </tr>
    <tr>
        <td colspan="3">Detalle o descripcion de documentos presentados:</td>
        <td colspan="3">Detalle o descripcion de documentos presentados:</td>         
    </tr>
    <tr>
        <td colspan="3" class="c n">CARGO DE RECEPCIÓN</td>
        <td colspan="3" class="c n">SOLICITANTE</td>         
    </tr>
    <tr>
        <td colspan="3" style="text-align: center; padding-top: 35px;" >Sello y Firma <br>  Persona Autorizada por el Gobierno Local</td>
        <td colspan="3" style="text-align: center; padding-top: 35px;">Firma</td>         
    </tr>
    <tr>
        <td colspan="3">Nombres y APellidos: Angelito Paredes Rodriguez</td>
        <td colspan="3">Nombres y APellidos: '.mb_strtoupper($data->si_nombresapellidos).'</td>         
    </tr>
    <tr>
        <td colspan="3">Cargo: Jefe de la Oficina de Gestion y Riesgo de Desastres</td>
        <td colspan="3">DNI/ C.E: '.mb_strtoupper($data->si_dni).'</td>         
    </tr>
    <tr>
        <td colspan="3">Fecha y Hora: '.$hoy.'</td>
        <td colspan="3" >Fecha y Hora: '.$hoy.'</td>         
    </tr>
  </tbody>
</table>
';

$stylesheet = '
            td {
                border: 1px solid black;
                font-size:8px;
                
            }
           #logo {
            width:100px;
           }

           span{
            color: #3058CA;
           }
           .i{
            text-align: left;
           }
           .c{
            text-align: center;
           }
           .d{
            text-align: right;
           }

           .n{
            font-weight: bold;
           }

           .doblelinia{
            padding-bottom: 15px;
           }

           .parentisis{
            padding:0px 10px;
           }


           
           
'; 

$pdf = new \Mpdf\Mpdf(['orientation' => 'P','format' => 'A4-P']);

//$pdf->showImageErrors = true;
$pdf->Image(__DIR__.'/img/licencia funcionamiento.jpg', 0, 0, 210, 297, 'jpg', '', true, false);
//$pdf->Image(__DIR__.'/img/licencia funcionamiento.jpg',0,0,210,297);
//$pdf->Image(__DIR__.'/img/logo-picota.png',100,24,40);
#Establecemos los márgenes izquierda, arriba y derecha:
$pdf->SetMargins(5, 5 , 5,5);
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>
