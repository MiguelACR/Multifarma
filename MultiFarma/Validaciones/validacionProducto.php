<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){

    if(!empty($datos['accion']) && $datos['accion'] == 'nuevo'){

        if(empty($_FILES['foto_producto']['name'])){
            $validaciones['foto_producto'] = 'Seleccione una imagen';
        }
        
    }
   
    if(!empty($datos['accion']) && $datos['accion'] == 'nuevo' || !empty($datos['accion']) && $datos['accion'] == 'editar'){
    if(empty($datos['nombre_producto'])){
        $validaciones['nombre_producto'] = 'El campo descripción es requerido';
    }

    if(empty($datos['id_presentacion'])){
        $validaciones['id_presentacion'] = 'Seleccione una presentación';
    }
  
    if(empty($datos['id_proveedor'])){
        $validaciones['id_proveedor'] = 'Seleccione un proveedor';
    }
    }
    else if(empty($datos['accion'])){
        $validaciones['accion'] = 'Error gravisimo: por favor no borrar codigo html';
    }
    else{
        $validaciones['accion'] = 'Error gravisimo: por favor no modificar el html'; 
    }
    
    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>