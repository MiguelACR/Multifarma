<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloInventario.php';

	        $model = new Inventario();
            $detalle_inventarios = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/inventario.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_inventario'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>