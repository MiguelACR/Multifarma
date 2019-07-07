<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloFactura.php';

	if(empty($_REQUEST['cl']) || empty($_REQUEST['f']))
	{
		echo "No es posible generar la factura.";
	}else{
		$codCliente = $_REQUEST['cl'];
		$noFactura = $_REQUEST['f'];
		$anulada = '';

		if($noFactura != '' && $codCliente != '') {

			$model = new Factura();

			$registroFactura = 	$model->consultar($noFactura,$codCliente);
	
			if($registroFactura['estado_factura'] == 0){
				$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
			}	
		
			
            $detalle_productos = $model->consultar_detalle($noFactura);
		   
			ob_start();
		    include(dirname('__FILE__').'/factura.php');
		    $html = ob_get_clean();

            $nombre_archivo = 'factura numero: '.$noFactura.''; 

			$reporte = new Reporte();
			$reporte->generarPDF($html,$nombre_archivo);
		
			exit;
		}
	}
?>