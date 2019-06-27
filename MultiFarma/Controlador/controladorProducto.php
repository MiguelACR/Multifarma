<?php
require_once '../Modelo/modeloProducto.php';
if($datos = $_POST){
switch ($_POST['accion']){

    case 'editar':
        $producto = new Producto();
		$resultado = $producto->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
    break;

    case 'nuevo':
        $producto = new Producto();
		$resultado = $producto->nuevo($datos);
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
		$producto = new Producto();
		$resultado = $producto->borrar($datos['codigo']);
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
    $producto = new Producto();
    $producto->consultar($datos['codigo']);

    if($producto->getId_producto() == null) {
        $respuesta = array(
            'respuesta' => 'no existe'
        );
    }  else {
        
        $_SESSION['producto'] = $producto->getFoto_producto();

        $respuesta = array(
            'id_producto' => $producto->getId_producto(),
            'nombre_producto' => $producto->getNombre_producto(),
            'id_presentacion' => $producto->getId_presentacion(),
            'id_proveedor' => $producto->getId_proveedor(),
            'respuesta' =>'existe'
        );
    }
    echo json_encode($respuesta);
    break;

    case 'consultar_prod_venta':
    $producto = new Producto();
    $producto->consultar_prod_venta($datos['codigo']);

    if($producto->getId_producto() == null && $producto->getId_farmacia() == null) {
        $respuesta = array(
            'respuesta' => 'no existe'
        );
    }  else {
        
        $respuesta = array(
            'detalle_producto' => $producto->getDetalle_producto(),
            'stock' => $producto->getStock(),
            'valor_venta' => $producto->getValor_venta(),
            'respuesta' =>'existe'
        );
    }
    echo json_encode($respuesta);
    break;

    case 'listar':
    $producto = new Producto();
    $listado = $producto->listar();        
    echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
    break;
    
}
}
?>