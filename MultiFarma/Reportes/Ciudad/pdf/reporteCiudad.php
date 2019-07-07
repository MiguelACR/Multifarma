<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloCiudad.php';

	        $model = new Ciudad();
            $detalle_ciudades = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/ciudad.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_ciudades'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>