<?php
require_once '../Modelo/modeloFactura.php';

$datos = $_POST;

switch ($_POST['accion']){

    case 'anular':
		$factura = new Factura();
		$resultado = $factura->anular($datos['codigo']);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
    break;

    case 'listar':
    $factura = new Factura();
    $listado = $factura->listar();        
    echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
    break;

     case 'consultar_detalle':
     $factura = new Factura();
     $listado = $factura->consultar_detalle($datos['codigo']);        
     echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
     break;

}
?>