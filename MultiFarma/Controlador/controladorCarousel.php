<?php

require_once '../Modelo/modeloCarousel.php';

$datos = $_GET;
$datosPost = $_POST;
switch ($_GET['accion']) {
    case 'editar':
        $carousel = new Carousel();
        $resultado = $Carousel->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado,
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $carousel = new Carousel();
        $resultado = $carousel->nuevo($datosPost);
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
        $carousel = new Carousel();
        $resultado = $carousel->borrar($datos['codigo']);
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

    case 'consultar':
        $carousel = new Carousel();
        $carousel->consultar($datos['codigo']);

        if ($carousel->getId_carousel() == null) {
            $respuesta = array(
                'respuesta' => 'no existe',
            );
        } else {
            $respuesta = array(
                'codigo' => $carousel->getId_carousel(),
                'imagen' => $imagen->getimagen(),
                'respuesta' => 'existe',
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $carousel = new Carousel();
        $listado = $carousel->listar();
        echo json_encode(array('data' => $listado), JSON_UNESCAPED_UNICODE);
        break;
}
