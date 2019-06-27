<?php
 
require_once '../Modelo/modelousuariosxEmpleados.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $usuarioxempleado = new Usuarioxempleado();
        $resultado = $usuarioxempleado->editar($datos['codigoA'],$datos['codigoB'],$datos['codigoC']);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
        
    case 'nuevo':
        $usuarioxempleado = new Usuarioxempleado();
        $resultado = $usuarioxempleado->nuevo($datos['codigo'],$datos['codigoU']);
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
		$usuarioxempleado = new Usuarioxempleado();
		$resultado = $usuarioxempleado->borrar($datos['codigo']);
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
        $usuarioxempleado = new Usuarioxempleado();
        $usuarioxempleado->consultar($datos['codigo']);

        if($usuarioxempleado->getId_usuarioxempleado() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'usuarioxempleado' => $usuarioxempleado->getId_usuarioxempleado(),
                'empleado' => $usuarioxempleado->getId_empleado(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
            
        break;
}
?>
