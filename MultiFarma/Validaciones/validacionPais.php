<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){
    
    if(empty($datos['id_pais'])){
        $validaciones['id_pais'] = 'El campo codigo es requerido';
    } else if(!is_numeric($datos['id_pais'])) {
        $validaciones['id_pais'] = 'El campo codigo es de tipo numerico';
    } else if($datos['id_pais'] < 0){
        $validaciones['id_pais'] = 'El campo codigo no puede ser negativo';
    }

  
    
    if(empty($datos['abreviatura_pais'])){
        $validaciones['abreviatura_pais'] = 'El campo abreviatura es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['abreviatura_pais'])) {
        $validaciones['abreviatura_pais'] = 'El campo abreviatura no puede contener numeros';
    }

    if(empty($datos['nombre_pais'])){
        $validaciones['nombre_pais'] = 'El campo nombre es requerido';
    } else if(!preg_match("/[a-zA-Z]+$/",$datos['nombre_pais'])) {
        $validaciones['nombre_pais'] = 'El campo nombre no puede contener numeros';
    }

    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>