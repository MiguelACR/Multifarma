<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloFarmacia.php';

	        $model = new Farmacia();
            $detalle_empleados = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/farmacia.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_farmacia'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>