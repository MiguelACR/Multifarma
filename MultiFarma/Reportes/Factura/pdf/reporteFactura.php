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
			foreach ($registroFactura as $value) {
				$fecha = $value->fecha;
				$hora = $value->hora;
				$vendedor = $value->vendedor;
				$id_cliente = $value->id_cliente;
				$telefono_cliente = $value->telefono_cliente;
				$nombre = $value->nombre;
				$direccion_cliente = $value->direccion_cliente;
				$valor_factura = $value->valor_factura;
				$iva_factura = $value->iva_factura;
				$neto_factura = $value->neto_factura;
				$estado_factura = $value->estado_factura;
			}
	     
			  if($estado_factura == 0){
			  	$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
			  }	
		
			
            $detalle_productos = $model->consultar_detalle($noFactura);
		   
			ob_start();
		    include(dirname('__FILE__').'/factura.php');
		    $html = ob_get_clean();

            $nombre_archivo = 'factura_numero_'.$noFactura.''; 

			$reporte = new Reporte();
			$reporte->generarPDF($html,$nombre_archivo);
		
			exit;
		}
	}
?>