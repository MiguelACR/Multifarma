<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloProveedor.php';

	        $model = new Proveedor();
            $detalle_proveedores = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/proveedor.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_proveedor'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>