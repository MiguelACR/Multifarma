<?php
 
require_once '../Modelo/modeloPropietario.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $propietario = new Propietario();
		$resultado = $propietario->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $propietario = new Propietario();
		$resultado = $propietario->nuevo($datos);
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
		$propietario = new Propietario();
		$resultado = $propietario->borrar($datos['codigo']);
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
        $propietario = new Propietario();
        $propietario->consultar($datos['codigo']);

        if($propietario->getId_propietario() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $propietario->getId_propietario(),
                'nombre' => $propietario->getNombre_propietario(),
                'apellido' => $propietario->getApellido_propietario(),
                'direccion' => $propietario->getDireccion_propietario(),
                'telefono' => $propietario->getTelefono_propietario(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $propietario = new Propietario();
        $listado = $propietario->listar();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
        break;
}
?>
