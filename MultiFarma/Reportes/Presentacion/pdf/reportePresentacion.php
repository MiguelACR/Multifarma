<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloPresentacion.php';

	        $model = new Presentacion();
            $detalle_presentaciones = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/presentacion.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_presentacion'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>