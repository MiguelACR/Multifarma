<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloCliente.php';

	        $model = new Cliente();
            $detalle_clientes = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/cliente.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_clientes'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>