<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloNomina.php';

	        $model = new Nomina();
            $detalle_nominas = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/nomina.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_nomina'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>