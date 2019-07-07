<?php

include_once '../../../pdf/vendor/autoload.php';

use Dompdf\Dompdf;

class Reporte{
    
public function generarPDF($obj, String $name_file){

    $dompdf = new Dompdf();

    $dompdf->loadHtml($obj);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream(''.$name_file.'.pdf',array('Attachment'=>0));
   
}

}
?>