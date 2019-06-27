<?php
require_once '../Modelo/modeloFarmacia.php';
if($datos = $_POST){
switch ($_POST['accion']) {

    case 'editar':
        $farmacia = new Farmacia();
        $resultado = $farmacia->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado,
            );
        echo json_encode($respuesta);
        break;

    case 'nuevo':
        $farmacia = new Farmacia();
        $resultado = $farmacia->nuevo($datos);
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
        $farmacia = new Farmacia();
        $resultado = $farmacia->borrar($datos['codigo']);
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
        $farmacia = new Farmacia();
        $farmacia->consultar($datos['codigo']);

        if ($farmacia->getId_farmacia() == null) {
            $respuesta = array(
                'respuesta' => 'no existe',
            );
        } else {
            $respuesta = array(
                'codigo' => $farmacia->getId_farmacia(),
                'farmacia' => $farmacia->getNombre_farmacia(),
                'direccion' => $farmacia->getDireccion_farmacia(),
                'telefono' => $farmacia->getTelefono_farmacia(),
                'ciudad' => $farmacia->getId_ciudad(),
                'pais' => $farmacia->getId_pais(),
                'propietario' => $farmacia->getId_propietario(),
                'administrador' => $farmacia->getId_usuario(),
                'respuesta' => 'existe',
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $farmacia = new Farmacia();
        $listado = $farmacia->listar();
        echo json_encode(array('data' => $listado), JSON_UNESCAPED_UNICODE);
        break;

}    
}
?>
