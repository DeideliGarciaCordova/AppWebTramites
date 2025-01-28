<?php
    require_once('libs/fpdf/fpdf.php');
    //echo URL.'/img/logo-picota2.png';
   // print("<pre>");
   // var_dump($data);exit;
    class PDF extends FPDF
    {
    
           //Cabecera de página
   function Header($anio="")
   {
    /*$this->Sety(25);
   
     $this->SetFont('Arial','I',12);
     $this->Cell(190,10,utf8_decode($anio),1,0,'C');       
     $this->ln(10);

       $this->Image(__DIR__.'/img/logo-picota.png',50,100,100);
        $this->SetFont('Arial','BI',18);
       // $this->Cell(190,18,'CONSTANCIA  DE NO INSCRIPCION DE MATRIMONIOCONSTANCIA  DE NO INSCRIPCION DE MATRIMONIO',0,0,'C');
       $this->MultiCell(180,20,'CONSTANCIA  DE NO INSCRIPCION DE MATRIMONIO',0,'J');
        $this->ln(10);*/

   }
    //Pie de página
    function Footer()
    {
    
    $this->SetY(-10);
    
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,utf8_decode('PÁGINA ').$this->PageNo().'',0,0,'C');
       }
    }
    
    //Creación del objeto de la clase heredada
   $pdf=new PDF('P', 'mm', 'A4');
      #Establecemos los márgenes izquierda, arriba y derecha:
   $pdf->SetMargins(30, 25 , 30);

   #Establecemos el margen inferior:
   $pdf->SetAutoPageBreak(true,25); 
   $pdf->AddPage();
   // $pdf->header($data->ani_nombre);
    $pdf->Sety(25);
   
    $pdf->SetFont('Arial','I',12);
    $pdf->Cell(150,10,utf8_decode($data->ani_nombre),0,0,'C');       
    $pdf->ln(20);

    $pdf->Image(__DIR__.'/img/logo-marcaagua.png',50,100,100);
   $pdf->SetFont('Arial','BI',18);
      // $this->Cell(190,18,'CONSTANCIA  DE NO INSCRIPCION DE MATRIMONIOCONSTANCIA  DE NO INSCRIPCION DE MATRIMONIO',0,0,'C');
   $pdf->MultiCell(150,9,'CONSTANCIA  DE NO INSCRIPCION DE MATRIMONIO',0,'C');
   $pdf->ln(10);

    $pdf->SetFont('Times','',12);
    
    //Aquí escribimos lo que deseamos mostrar
    $pdf->SetFont('Arial','IB',13);
    $pdf->MultiCell(150,7,'EL JEFE DE LA UNNIDAD DE REGISTRO CIVIL  DE LA MNICIPALIDAD PROVINCIAL DE PICOTA',0,'J');
    $pdf->ln(6); 
    $pdf->SetFont('Arial','IB',17);
    
    $pdf->MultiCell(150,10,'CERTIFICA:  ',0,'L');

    $pdf->ln(15); 
    $pdf->SetFont('Arial','I',12);
    $pdf->MultiCell(150,8,utf8_decode('                Que, habiendo efectuado la revisión en los libros correspondientes  a las actas de matrimonio s    en los archivos de oficina   de registro civil de la municipalidad de la provincia de picota, No se encuentra registrado en ningún nombre   de '.strtoupper(utf8_decode($data->cons_nombres)).', Identificado(a)   con DNI N°  '.utf8_decode($data->cons_dni).', haya contraído matrimonio   civil en esta municipalidad .
    
                Se expide l presente constancia a solicitud de la interesada    para los fines convenientes
    '),0,'J');           
   
    $pdf->Cell(150,10,'Picota, ' .fecha_es($data->cons_fecha),0,0,'R');
    $pdf->Output();
    /*Que, habiendo efectuado la revisión en los libros correspondientes   a las actas de matrimonio s    en los archivos de oficina   de registro civil de la municipalidad de la provincia de picota, No se encuentra registrado en ningún nombre   de ………………………………, Identificado(a)   con DNI N°  ……………………………, haya contraído matrimonio   civil en esta municipalidad .

Se expide l presente constancia a solicitud de la interesada                      para los fines convenientes
*/
    ?> 