<?php
require_once '../Modelo/modeloCliente.php';

if ($datos = $_POST){
    
switch ($_POST['accion']){

    case 'editar':
        $cliente = new Cliente();
		$resultado = $cliente->nuevo_editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
    break;

    case 'nuevo':
        $cliente = new Cliente();
		$resultado = $cliente->nuevo_editar($datos);
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
		$cliente = new Cliente();
		$resultado = $cliente->borrar($datos['codigo']);
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
        $cliente = new Cliente();
        $cliente->consultar($datos['codigo']);

        if($cliente->getId_cliente() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'id_cliente' => $cliente->getId_cliente(),
                'nombre_cliente' => $cliente->getNombre_cliente(),
                'apellido_cliente' => $cliente->getApellido_cliente(),
                'direccion_cliente' => $cliente->getDireccion_cliente(),
                'telefono_cliente' => $cliente->getTelefono_cliente(),
                'id_pais' => $cliente->getId_pais(),
                'id_ciudad' => $cliente->getId_ciudad(),
                'email_cliente' => $cliente->getEmail_cliente(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
    break;

    case 'listar':
        $cliente = new Cliente();
        $listado = $cliente->listar();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
    break;

    case 'listarC':
        $cliente = new Cliente();
        $listado = $cliente->listar();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
    break;

}

}
?>