<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloProducto.php';

	        $model = new Producto();
            $detalle_productos = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/producto.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_producto'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>