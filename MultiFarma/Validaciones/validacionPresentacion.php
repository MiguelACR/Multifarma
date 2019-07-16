<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){

    if(!empty($datos['accion'])){

    if($datos['accion'] == 'nuevo' || $datos['accion'] == 'editar'){

   
        if(empty($datos['nombre_presentacion'])){
            $validaciones['nombre_presentacion'] = 'El campo descripción es requerido';
        } else if(!preg_match("/[a-zA-Z]+$/",$datos['nombre_presentacion'])) {
            $validaciones['nombre_presentacion'] = 'El campo descripción no puede contener numeros';
        }

    }
    else{
        $validaciones['accion'] = 'Error gravisimo: por favor no modificar el html'; 
    }  

    }
    else{
        $validaciones['accion'] = 'Error gravisimo: por favor no borrar codigo html'; 
    }
    
    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>