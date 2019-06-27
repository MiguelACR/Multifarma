<?php
 
require_once '../Modelo/modeloEmpleados.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $empleado = new Empleado();
        $resultado = $empleado->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
        
    case 'nuevo':
        $empleado = new Empleado();
        $resultado = $empleado->nuevo($datos);
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
		$empleado = new Empleado();
		$resultado = $empleado->borrar($datos['codigo']);
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
        $empleado = new Empleado();
        $empleado->consultar($datos['codigo']);

        if($empleado->getId_empleado() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $empleado->getId_empleado(),
                'nombre' => $empleado->getNombre_empleado(),
                'apellido' =>$empleado->getApellido_empleado(),
                'cargo' =>$empleado->getCargo_empleado(),
                'pais' =>$empleado->getId_pais(),
                'ciudad' =>$empleado->getId_ciudad(),
                'direccion' =>$empleado->getDireccion_empleado(),
                'telefono' =>$empleado->getTelefono_empleado(),
                'email' =>$empleado->getEmail_empleado(),
                'farmacia' =>$empleado->getId_farmacia(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $empleado = new Empleado();
        $listado = $empleado->listar();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;

    case 'listarE':
        $empleado = new Empleado();
        $listado = $empleado->listar();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
    break;
}
?>
