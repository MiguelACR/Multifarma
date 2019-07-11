<?php
require_once '../Modelo/modeloEmpleados.php';

$datos = $_POST;

switch ($_POST['accion']){
    
    case 'editar':
        $empleado = new Empleado();
        $resultado = $empleado->nuevo_editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
    break;
        
    case 'nuevo':
        $empleado = new Empleado();
        $resultado = $empleado->nuevo_editar($datos);
        if($resultado == true) {
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
        if($resultado == true) {
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

    # Archivos js que utilizan este case: funcionesLogin
    case 'consultar_datos_empleado_login':
        $empleado = new Empleado();
        $empleado->consultar($datos['codigo']);

        if($empleado->getId_empleado() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            session_start();
            $_SESSION['id_farmacia'] = $empleado->getId_farmacia();
            $_SESSION['id_empleado'] = $empleado->getId_empleado();
            $_SESSION['nombre'] = $empleado->getNombre_empleado().' '.$empleado->getApellido_empleado();
            $respuesta = array(
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
    break;
        
}
?>
