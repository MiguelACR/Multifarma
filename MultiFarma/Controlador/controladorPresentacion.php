<?php
require_once '../Modelo/modeloPresentacion.php';
if($datos = $_POST){
switch ($_POST['accion']) {

    case 'editar':
        $presentacion = new Presentacion();
        $resultado = $presentacion->nuevo_editar($datos);
        $respuesta = array(
                'respuesta' => $resultado,
            );
        echo json_encode($respuesta);
        break;
        
    case 'nuevo':
        $presentacion = new Presentacion();
        $resultado = $presentacion->nuevo_editar($datos);
        if ($resultado == true) {
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
        $presentacion = new Presentacion();
        $resultado = $presentacion->borrar($datos['codigo']);
        if ($resultado == true) {
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
    $presentacion = new Presentacion();
    $presentacion->consultar($datos['codigo']);

    if ($presentacion->getId_presentacion() == null) {
        $respuesta = array(
            'respuesta' => 'no existe',
        );
    } else {
        $respuesta = array(
            'codigo' => $presentacion->getId_presentacion(),
            'presentacion' => $presentacion->getNombre_presentacion(),
            'respuesta' => 'existe',
        );
    }
    echo json_encode($respuesta);
    break;

    case 'listar':
    $presentacion = new Presentacion();
    $listado = $presentacion->listar();
    echo json_encode(array('data' => $listado), JSON_UNESCAPED_UNICODE);
    break;

}
}
?>
