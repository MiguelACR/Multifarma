<?php

	include_once ("../Funciones/sessiones.php");
	
	include("../Modelo/modelo.php");

	include_once ('../pdf/vendor/autoload.php');

	use Dompdf\Dompdf;

	if(empty($_REQUEST['cl']) || empty($_REQUEST['f']))
	{
		echo "No es posible generar la factura.";
	}else{
		$codCliente = $_REQUEST['cl'];
		$noFactura = $_REQUEST['f'];
		$anulada = '';

		if($noFactura != '' && $codCliente != '') {

        $registroFactura = consultarFactura($noFactura,$codCliente);  		

	
			if($registroFactura['estado_factura'] == 0){
				$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
			}	
		
			
           $detalle_productos = detalle_prod($noFactura);
		   

			ob_start();
		    include(dirname('__FILE__').'/factura.php');
		    $html = ob_get_clean();

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('factura_'.$noFactura.'.pdf',array('Attachment'=>0));
			exit;
		}
	}
 
?>