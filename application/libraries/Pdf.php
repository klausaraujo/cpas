<?php

class Pdf{

 public function html2Pdf($direccion,$hoja,$html,$nombre){
 
	require_once("html2pdf/html2pdf.class.php");
	
	$html2pdf = new HTML2PDF($direccion,$hoja,'es');
    $html2pdf->WriteHTML($html);
    $html2pdf->Output($nombre.'.pdf');
 
 } 

}

?>