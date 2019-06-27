<?php
require_once '../Modelo/modeloProveedor.php';
if($datos = $_POST){
switch ($_POST['accion']) {
    
    case 'editar':
        $proveedor = new Proveedor();
        $resultado = $proveedor->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado,
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $proveedor = new Proveedor();
        $resultado = $proveedor->nuevo($datos);
        if ($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
            );
        }
        echo json_encode($respuesta);
        break;
        
    case 'borrar':
        $proveedor = new Proveedor();
        $resultado = $proveedor->borrar($datos['codigo']);
        if ($resultado > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
            );
        }
        echo json_encode($respuesta);
        break;

}
}
else{
$datos = $_GET;
switch ($_GET['accion']) {

    case 'consultar':
    $proveedor = new Proveedor();
    $proveedor->consultar($datos['codigo']);

    if ($proveedor->getId_proveedor() == null) {
        $respuesta = array(
            'respuesta' => 'no existe',
        );
    } else {
        $respuesta = array(
            'codigo' => $proveedor->getId_proveedor(),
            'proveedor' => $proveedor->getNombre_proveedor(),
            'direccion' => $proveedor->getDireccion_proveedor(),
            'telefono' => $proveedor->getTelefono_proveedor(),
            'ciudad' => $proveedor->getId_ciudad(),
            'pais' => $proveedor->getId_pais(),
            'respuesta' => 'existe',
        );
    }
    echo json_encode($respuesta);
    break;

    case 'listar':
    $proveedor = new Proveedor();
    $listado = $proveedor->listar();
    echo json_encode(array('data' => $listado), JSON_UNESCAPED_UNICODE);
    break;

}
}
?>