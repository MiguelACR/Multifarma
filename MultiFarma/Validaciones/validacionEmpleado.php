<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){
    if(empty($datos['id_empleado'])){
        $validaciones['id_empleado'] = 'El campo identificación es requerido';
    } else if(!is_numeric($datos['id_empleado'])) {
        $validaciones['id_empleado'] = 'El campo identificación es de tipo numerico';
    }

    if(empty($datos['nombre_empleado'])){
        $validaciones['nombre_empleado'] = 'El campo nombre es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['nombre_empleado'])) {
        $validaciones['nombre_empleado'] = 'El campo nombre no puede contener numeros';
    }

    if(empty($datos['apellido_empleado'])){
        $validaciones['apellido_empleado'] = 'El campo apellido es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['apellido_empleado'])) {
        $validaciones['apellido_empleado'] = 'El campo apellido no puede contener numeros';
    }

    if(empty($datos['cargo_empleado'])){
        $validaciones['cargo_empleado'] = 'El campo cargo es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['cargo_empleado'])) {
        $validaciones['cargo_empleado'] = 'El campo cargo no puede contener numeros';
    }

    if(empty($datos['id_pais'])){
        $validaciones['id_pais'] = 'Seleccione un pais';
    }

    if(empty($datos['id_ciudad'])){
        $validaciones['id_ciudad'] = 'Seleccione una ciudad';
    }

    if(empty($datos['direccion_empleado'])){
        $validaciones['direccion_empleado'] = 'El campo dirección es requerido';
    }

    if(empty($datos['telefono_empleado'])){
        $validaciones['telefono_empleado'] = 'El campo telefono es requerido';
    } else if(!is_numeric($datos['telefono_empleado'])) {
        $validaciones['telefono_empleado'] = 'El campo telefono es de tipo numerico';
    }

    if(empty($datos['id_farmacia'])){
        $validaciones['id_farmacia'] = 'Seleccione una farmacia';
    }

    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>