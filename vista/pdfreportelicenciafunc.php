<?php
require_once 'libs/mpdf/vendor/autoload.php';


$filas="";
$cantidad=0;
foreach ($data as $row ) {
    $filas.='<tr>
          <td>'.$row->lf_codigo.'</td>
          <td>'.$row->lf_razonsocial.'</td>
          <td>'.$row->lf_nombrecomercial.'</td>
          <td>'.$row->lf_ruc.'</td>
          <td>'.$row->lf_dni.'</td>
          <td>'.$row->lf_ubicacion.'</td>
          <td>'.$row->lf_girode.'</td>
          <td>'.$row->lf_area.'</td>
          <td>'.$row->nr_nombre.'</td>
          <td>'.$row->lf_tipolicencia.'</td>
          <td>'.$row->lf_numexpediente.'</td>
          <td>'.$row->if_fecharegistro.'</td>
        </tr>';
        $cantidad++;  
        
}
$logo='';
if (!empty($info_empresa->emp_logo)) {
 $logo= '<img src="data:image/png;base64,'.base64_encode($info_empresa->emp_logo).'" width="70px" >' ;
}
$html ='<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        '.$logo.'
      </div>
      <div id="company">
        <h2 class="name">REPORTES DE LICENCIAS DE FUNCIONAMIENTO</h2>
       
      </div>
      </div>
    </header>
    <main>
      <table id="customers">
        <tr>
            <th width="5%">Codigo</th>
            <th width="15%">Razon Social</th>
            <th width="15%">Nombre Comercial</th>
            <th width="10%">Ruc</th>
            <th width="7%">Dni</th>
            <th width="13%">Ubicación</th>
            <th width="20%">Giro de</th>
            <th width="6%">Area</th>
            <th width="11%">Nivel Riego</th>
            <th width="10%">Tipo Licencia</th>
            <th width="6%">Expediente</th>
            <th width="8%">F Registro</th>
        </tr>'.
        $filas
        .'  
        <tr>
            <td colspan="11" class="total grand">Total</td>
            <td class="grand">'.$cantidad.'</td>
         </tr>

      </table>

      <div id="thanks"></div>
      <div id="notices">
        <div></div>
        <div class="notice"></div>
      </div>
    </main>
   
  </body>
</html>
';



$stylesheet = file_get_contents( __DIR__ . '/css_reporte/pdfreportelicenciafunc.css'); // external css


$pdf = new \Mpdf\Mpdf(['orientation' => 'P','format' => 'A4-L']);

//$pdf->showImageErrors = true;
//$pdf->Image(__DIR__.'/img/licencia funcionamiento.jpg', 0, 0, 210, 297, 'jpg', '', true, false);
//$pdf->Image(__DIR__.'/img/licencia funcionamiento.jpg',0,0,210,297);
//$pdf->Image(__DIR__.'/img/logo-picota.png',100,24,40);
$pdf->WriteHTML($stylesheet,1);
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>