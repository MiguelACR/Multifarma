<?php
require_once '../Modelo/modeloVenta.php';

$datos = $_POST;

switch ($_POST['accion']){

    case 'nuevo':
        $venta = new Venta();
		$resultado = $venta->nuevo_editar($datos);
        if($resultado == true) {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }  else {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }
        echo json_encode($respuesta);
        break;

    case 'identificarM':
            $venta = new Venta();
            $venta->identificarM();
            if($venta -> getId_factura() == null){
                $respuesta = array(
                    'respuesta' => 'no existe'
                );
            }
            else{
                $respuesta = array(
                    'id_factura' => $venta->getId_factura(),
                    'respuesta' =>'existe'   
                );   
            }
            echo json_encode($respuesta);
    break;

}    
?>