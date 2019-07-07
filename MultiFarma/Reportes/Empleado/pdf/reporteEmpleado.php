<?php
require_once '../../generarReporte.php';
require_once '../../../Modelo/modeloEmpleados.php';

	        $model = new Empleado();
            $detalle_empleados = $model->listar();
			
			 ob_start();
		     include(dirname('__FILE__').'/empleado.php');
		     $html = ob_get_clean();

             $nombre_archivo = 'Reporte_empleados'; 

			 $reporte = new Reporte();
			 $reporte->generarPDF($html,$nombre_archivo);
			
			 exit;

?>