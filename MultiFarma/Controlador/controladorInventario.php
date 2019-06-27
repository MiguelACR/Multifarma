<?php
require_once '../Modelo/modeloInventario.php';
if($datos = $_POST){
switch ($_POST['accion']){
    
    case 'editar':
        $inventario = new Inventario();
		$resultado = $inventario->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
    break;

    case 'editar_inven_venta':
    $inventario = new Inventario();
    $resultado = $inventario->editar_inven_venta($datos);
    $respuesta = array(
            'respuesta' => $resultado
        );
    echo json_encode($respuesta);
    break;

    case 'editar_inven_anular':
    $inventario = new Inventario();
    $resultado = $inventario->editar_inven_anular($datos['codigoP'],$datos['codigoC']);
    $respuesta = array(
            'respuesta' => $resultado
        );
    echo json_encode($respuesta);
    break;

    case 'nuevo':
        $inventario = new Inventario();
		$resultado = $inventario->nuevo($datos);
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

    case 'borrar':
		$inventario = new Inventario();
		$resultado = $inventario->borrar($datos['codigo'],$datos['codigoP']);
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
}
}
else{
$datos = $_GET;
switch ($_GET['accion']){

    case 'consultar':
    $inventario = new Inventario();
    $inventario->consultar($datos['codigo'],$datos['codigoP']);

    if($inventario->getId_farmacia() == null && $inventario->getId_producto() == null) {
        $respuesta = array(
            'respuesta' => 'no existe'
        );
    }  else {
        $respuesta = array(
            'id_farmacia' => $inventario->getId_farmacia(),
            'id_producto' => $inventario->getId_producto(),
            'entradas' => $inventario->getEntradas(),
            'salidas' => $inventario->getSalidas(),
            'stock' => $inventario->getStock(),
            'valor_unitario' => $inventario->getValor_unitario(),
            'valor_venta' => $inventario->getValor_venta(),
            'fecha_registro' => $inventario->getFecha_registro(),
            'respuesta' =>'existe'
        );
    }
    echo json_encode($respuesta);
    break;

    case 'listar':
    $inventario = new Inventario();
    $listado = $inventario->listar();        
    echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
    break;
  
}
}
?>