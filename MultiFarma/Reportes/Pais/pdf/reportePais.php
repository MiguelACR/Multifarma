<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloPais.php';

	        $model = new Pais();
            $detalle_paises = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/pais.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_pais'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>