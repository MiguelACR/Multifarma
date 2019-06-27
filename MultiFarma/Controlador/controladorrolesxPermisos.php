<?php
require_once '../Modelo/modelorolesxPermisos.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $rolxpermiso = new Rolxpermiso();
        $resultado = $rolxpermiso->editar($datos['codigo'],$datos['codigoP'],$datos['codigoM'],$datos['codigoE']);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $rolxpermiso = new Rolxpermiso();
        $resultado = $rolxpermiso->nuevo($datos['codigo']);
        if($resultado > 0) {
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
       
    case 'borrar':
		$rolxpermiso = new Rolxpermiso();
		$resultado = $rolxpermiso->borrar($datos['codigo']);
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

    case 'consultar':
        $rolxpermiso = new Rolxpermiso();
        $rolxpermiso->consultar($datos['codigo']);

        if($rolxpermiso->getId_rolxpermiso() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $rolxpermiso->getId_rolxpermiso(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $rolxpermiso = new Rolxpermiso();
        $listado = $rolxpermiso->listar($datos['codigo']);
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
