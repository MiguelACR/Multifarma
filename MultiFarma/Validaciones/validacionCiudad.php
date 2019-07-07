<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){
    if(empty($datos['id_ciudad'])){
        $validaciones['id_ciudad'] = 'El campo codigo es requerido';
    } else if(!is_numeric($datos['id_ciudad'])) {
        $validaciones['id_ciudad'] = 'El campo codigo es de tipo numerico';
    }

    if(empty($datos['nombre_ciudad'])){
        $validaciones['nombre_ciudad'] = 'El campo nombre es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['nombre_ciudad'])) {
        $validaciones['nombre_ciudad'] = 'El campo nombre no puede contener numeros';
    }

    if(empty($datos['id_pais'])){
        $validaciones['id_pais'] = 'Seleccione un pais';
    }

    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>