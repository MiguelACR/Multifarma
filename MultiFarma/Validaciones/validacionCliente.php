<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){
    if(empty($datos['id_cliente'])){
        $validaciones['id_cliente'] = 'El campo identificación es requerido';
    } else if(!is_numeric($datos['id_cliente'])) {
        $validaciones['id_cliente'] = 'El campo identificación es de tipo numerico';
    }

    if(empty($datos['nombre_cliente'])){
        $validaciones['nombre_cliente'] = 'El campo nombre es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['nombre_cliente'])) {
        $validaciones['nombre_cliente'] = 'El campo nombre no puede contener numeros';
    }

    if(empty($datos['apellido_cliente'])){
        $validaciones['apellido_cliente'] = 'El campo apellido es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['apellido_cliente'])) {
        $validaciones['apellido_cliente'] = 'El campo apellido no puede contener numeros';
    }

    if(empty($datos['direccion_cliente'])){
        $validaciones['direccion_cliente'] = 'El campo dirección es requerido';
    }

    if(empty($datos['telefono_cliente'])){
        $validaciones['telefono_cliente'] = 'El campo telefono es requerido';
    } else if(!is_numeric($datos['telefono_cliente'])) {
        $validaciones['telefono_cliente'] = 'El campo telefono es de tipo numerico';
    }

    if(empty($datos['id_pais'])){
        $validaciones['id_pais'] = 'Seleccione un pais';
    }

    if(empty($datos['id_ciudad'])){
        $validaciones['id_ciudad'] = 'Seleccione una ciudad';
    }

    if(empty($_POST['email_cliente'])){
        $validaciones['email_cliente'] = 'El campo correo es requerido';
    } else if(!filter_input(INPUT_POST, 'email_cliente' , FILTER_VALIDATE_EMAIL)) {
        $validaciones['email_cliente'] = 'El campo email requiere un correo válido';
    }

    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>