<?php
    require_once('libs/fpdf/fpdf.php');
    class PDF extends FPDF
    {
    
              //Cabecera de página
      function Header($anio="")
      {
        $this->Sety(25);
        $this->Image(__DIR__.'/img/logo-picota.png',20,8,20);
        $this->SetFont('Arial','I',8);
        $this->MultiCell(170,5,utf8_decode(mb_strtoupper('" '.$anio.' "')),0,'C');
        $this->ln(6);
      }
        //Pie de página
      function Footer()
      { 
        
        $this->Line(20, 280, 190, 280);   
        $this->SetY(-15);
        
        $this->SetFont('Arial','',6);
        $this->Cell(100,4,utf8_decode('Domicilio: Jr:Miguel Grau N° 396-Picota '),0,0,'L');
        $this->Cell(60,4,utf8_decode('Celular: 923 213 839  (Secretaria General) '),0,1,'L');
        $this->Cell(100,4,utf8_decode('e-mail: municipalidadapicota2019.2022@gmail.com '),0,0,'L');
        $this->Cell(60,4,utf8_decode('Página web: http://www.munipicota.gob.pe '),0,0,'L');
        //$this->Cell(0,10,utf8_decode('PÁGINA ').$this->PageNo().'',0,0,'C');
      }
    }
    //Creación del objeto de la clase heredada
    $pdf=new PDF('P', 'mm', 'A4');
      #Establecemos los márgenes izquierda, arriba y derecha:
    $pdf->SetMargins(20, 25 , 20);


   #Establecemos el margen inferior:
    $pdf->SetAutoPageBreak(true,20); 
    $pdf->AddPage();
    
    //$pdf->Sety(25);

    //$pdf->Image(__DIR__.'/img/logo-picota.png',20,8,20);
    //$pdf->SetFont('Arial','I',8);
    //$pdf->MultiCell(170,5,utf8_decode(mb_strtoupper('" '.$data->ani_nombre.' "')),0,'C');
    $pdf->Header($data->ani_nombre);
    $pdf->Line(62, 40, 148, 40);
    $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(170,5,utf8_decode('RESOLUCIÓN Nº '.$data->ci_codigo.' - OGRD-GIDT-GM/MPP.'),0,'C');
    $pdf->ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(170,10,'Picota, ' .fecha_es($data->ci_fresolucion),0,0,'R');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(170,10,'VISTO: ',0,1,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(170,5,utf8_decode('El expediente N° '.$data->ci_expediente .' de la fecha ' .fecha_es($data->ci_fexpediente).' , suscrito por el Sr. '.$data->ci_solicitante .', quien solicita licencia  de funcionamiento, asi mismo a través de ello se deriva para el CERTIFICADO de inspección técnica de seguridad en edificaciones   de las instalaciones    del "'.$data->ci_establecimiento .'"  ubicado en '.$data->ci_direccion .', distrito de '.$data->ci_distrito .', provincia de '.$data->ci_provincia .',  Departamento de '.$data->ci_departamento .', para realizar actividades de enseñanza Superior.'),0,'J');
    $pdf->ln(5);
    $pdf->MultiCell(170,5,utf8_decode('El informe N° '.$data->ci_informe .' De fecha '.fecha_es($data->ci_finforme) .', emitido por el  inspector técnico  '.$data->ci_nombreinspector .'.'),0,'J');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(170,10,'CONSIDERANDO: ',0,1,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(170,5,utf8_decode('El expediente N° '.$data->ci_expediente .' de la fecha ' .fecha_es($data->ci_fexpediente).' , suscrito por el Sr. '.$data->ci_solicitante .', quien solicita licencia  de funcionamiento, asi mismo a través de ello se deriva para el CERTIFICADO de inspección técnica de seguridad en edificaciones   de las instalaciones    del " '.$data->ci_establecimiento .' "  ubicado en '.$data->ci_direccion .', distrito de '.$data->ci_distrito .', provincia de '.$data->ci_provincia .',  Departamento de '.$data->ci_departamento .', para realizar actividades de enseñanza Superior, ,  adjunto voucher de pago N° '.$data->ci_voucher .'  por un monto de '.$data->ci_monto .'  soles.'),0,'J');
    $pdf->ln(5);
    $cumple="NO CUMPLE";
    if($data->ci_cumplecondiciones){$cumple="SI CUMPLE";}

    $pdf->MultiCell(170,5,utf8_decode('Que, mediante el informe N°'.$data->ci_informe .' De fecha '.fecha_es($data->ci_finforme) .', el inspector técnico '.$data->ci_nombreinspector .' indica que el  " '.$data->ci_establecimiento .' " , '.$cumple.' con las condiciones de seguridad de edificación     exigida por el D.S. 02-2018-PCM , anexo 6a, NORMA A130 del RNE,CNE y NTP.'),0,'J');
    $pdf->ln(5);
    $pdf->MultiCell(170,5,utf8_decode('Que, mediante el Decreto Supremo N° 022-2018-PCM, publicado con fecha 05 de enero del 2018, se aprueba el reglamento de Inspección Técnicas de Seguridad en Edificaciones que tiene por objeto establecer y regular los procedimientos técnicos y administrativos referidos a las Inspecciones Técnicas de Seguridad en Edificaciones -ITSE.'),0,'J');
    $pdf->ln(5);
    $pdf->MultiCell(170,5,utf8_decode('Que, conforme el articulo 64°   de la ley N° 30230 ley que establece medidas tributarias, simplificación de procedimientos y permisos para la promoción y dinamización de la inversión en el país, que modifica la ley N° 29664 que crea el Sistema Nacional de Gestión de Riesgos y Desastres, señala que las Inspección Técnicas de Seguridad en Edificaciones son ejecutadas por los gobiernos locales en sus ámbitos de jurisdicción respectiva.'),0,'J');
    $pdf->ln(5);
    $pdf->MultiCell(170,5,utf8_decode('Que, el Numeral 1 del articulo 34° del citado Reglamento de Inspecciones, establece que el procedimiento de ITSE finaliza con la Resolución emitida por el Órgano ejecutante, señalando que el objeto de inspección     CUMPLE con la normativa en materia de seguridad de edificaciones vigente, por consiguiente, corresponde emitir el Certificado ITSE;'),0,'J');
    $pdf->ln(12);

    
    $pdf->MultiCell(170,5,utf8_decode('Que, el artículo 11 de la ley N° 30619, que modifica la ley 28976, ley marco de licencia de funcionamiento, acerca de la vigencia del certificado de inspección técnica de seguridad en edificaciones señala el certificado de inspección técnica de seguridad en edificación tiene vigencia de (02) años, a partir de su expedición. '),0,'J');
    $pdf->ln(1);
    $pdf->MultiCell(170,5,utf8_decode('Que, mediante el informe de verificación de cumplimiento de condiciones     de seguridad, Declaración para ITSE, previo al otorgamiento de la Licencia   de funcionamiento o la ITSE posterior al inicio de las actividades (Anexo 6 6a), rubricado por el inspector técnico .'.$data->ci_nombreinspector .' '),0,'J');
    $pdf->ln(5);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(170,10,'SE RESUELVE: ',0,1,'L');
    $pdf->ln(5);
    $pdf->SetFont('Arial','',10);
    $pdf->MultiCell(170,5,utf8_decode('ARTICULO PRIMERO. -Emitir el certificado de Inspección Técnica de Seguridad en Edificaciones para el '.$data->ci_establecimiento .' respaldado por el informe N° '.$data->ci_informe .',de la fecha '.$data->ci_finforme .' emitido por l inspector técnico '.$data->ci_nombreinspector .',  con el asunto remite informe técnico del '.$data->ci_establecimiento .' indicando que '.$cumple.' con las condiciones de seguridad en Edificación , exigidas por el D.S  02-2018-PCM'),0,'J');
    $pdf->ln(5);
    $pdf->MultiCell(170,5,utf8_decode('ARTICULO SEGUNDO. - Notifíquese la presente Resolucion al Sr.'.$data->ci_solicitante .', conforme a ley.'),0,'J');
    $pdf->ln(5);
    $pdf->MultiCell(170,5,utf8_decode('Regístrese, Comuníquese y Archívese.'),0,'J');
  
    $pdf->Header($data->ani_nombre);
    #linias
   
    //$pdf->Line(62, 40, 148, 40);
   /* $pdf->Line(55, 91, 275, 91);
    $pdf->Line(55, 108, 275, 108);
    $pdf->Line(70, 130, 180, 130);
    $pdf->Line(55, 174, 140, 174);*/
    #footer

   
    $pdf->Output();

    ?> 