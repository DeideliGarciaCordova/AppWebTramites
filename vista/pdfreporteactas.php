<?php
    require_once('libs/fpdf/fpdf.php');

    class PDF extends FPDF
    {
    
           //Cabecera de página
   function Header()
   {
        $this->Sety(25);
        $this->Image(__DIR__.'/img/logo-picota.png',10,3,18);
       //$this->Image(__DIR__.'/img/logo-picota.png',12,5,15);
        $this->Line(10, 22 , 200, 22);
        $this->SetFont('Arial','B',12);
        $this->Cell(190,10,'REPORTE',0,0,'C');       
        $this->ln(10);

   }
    //Pie de página
    function Footer()
    {
    
    $this->SetY(-10);
    
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,utf8_decode('PÁGINA ').$this->PageNo().'',0,0,'C');
    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
       }
    }
    
    //Creación del objeto de la clase heredada
    $pdf=new PDF();
    $pdf->AddPage();
   // $pdf->SetFont('Times','',12);
    //Aquí escribimos lo que deseamos mostrar
    $pdf->SetFont('Arial','B',10);

   /* $pdf->SetXY(15,40);          // Primero establece Donde estará la esquina superior izquierda donde estará tu celda
    $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(56, 154, 219); // establece el color del fondo de la celda (en este caso es AZUL
   // $pdf->Cell(145, 20, 'LETRERO', 1, 0, 'C', True); // en orden lo que informan estos parametros es:
*/
    $header[0]='Tipo Acta';
    $header[1]='Persona';
    $header[2]='DNI';
    $header[3]='Fecha';
    $header[4]='Precio';
    $header[5]='Nº Recibo ';
    // las columnas
    $w = array(45, 60, 20,25,20,20);

   // $pdf->SetXY(15,40);          // Primero establece Donde estará la esquina superior izquierda donde estará tu celda
    $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(56, 154, 219); // establece el color del fondo de la celda (en este caso es AZUL
 
    // Cabeceras
    for($i=0;$i<count($header);$i++){
    
      $pdf->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'L',true);

    }
    $pdf->Ln();
    $pdf->SetFont('Arial','',8);
    //$pdf->SetXY(15,40);          // Primero establece Donde estará la esquina superior izquierda donde estará tu celda
    $pdf->SetTextColor(0,0,0);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(255,255,255); // establece el color del fondo de la celda (en este caso es AZUL
 
    $cant=0;
    $total=0;
    foreach ($data as $row) {
        $pdf->Cell($w[0],6,utf8_decode($row->ta_nombre),1,0,'L',true);
        $pdf->Cell($w[1],6,utf8_decode($row->act_persona),1,0,'L',true);
        $pdf->Cell($w[2],6,utf8_decode($row->act_dni),1,0,'L',true);
        $pdf->Cell($w[3],6,utf8_decode($row->act_fecha),1,0,'L',true);
        $pdf->Cell($w[4],6, number_format($row->act_precio, 2, ',', '.'),1,0,'R',true);
        $pdf->Cell($w[5],6,utf8_decode($row->act_numrecibo),1,0,'L',true);
        $pdf->Ln();
        $total=$total+$row->act_precio;
        $cant++;
    }

    //$pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $pdf->SetFillColor(117,22,63); // establece el color del fondo de la celda (en este caso es AZUL
    $pdf->Cell(145,6,'TOTAL ',0,0,'R',true);
    $pdf->Cell(25,6,'S/ '.  number_format($total, 2, ',', '.'),0,0,'R',true);
    $pdf->Cell(20,6,'',0,0,'R',true);


    $pdf->Output();
    
    ?> 