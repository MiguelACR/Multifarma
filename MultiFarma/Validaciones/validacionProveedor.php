<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){

    if(!empty($datos['accion'])){

    if($datos['accion'] == 'nuevo' || $datos['accion'] == 'editar'){

        if(empty($datos['id_proveedor'])){
            $validaciones['id_proveedor'] = 'El campo nit es requerido';
        } else if(!is_numeric($datos['id_proveedor'])) {
            $validaciones['id_proveedor'] = 'El campo nit es de tipo numerico';
        }
    
        if(empty($datos['nombre_proveedor'])){
            $validaciones['nombre_proveedor'] = 'El campo descripción es requerido';
        } else if(!preg_match("/[a-zA-Z]+$/",$datos['nombre_proveedor'])) {
            $validaciones['nombre_proveedor'] = 'El campo descripción no puede contener numeros';
        }
    
        if(empty($datos['id_pais'])){
            $validaciones['id_pais'] = 'Seleccione un pais';
    
            if(empty($datos['id_ciudad'])){
                $validaciones['id_ciudad'] = 'Seleccione una ciudad';
            }
    
        }else{
            if(empty($datos['id_ciudad'])){
                $validaciones['id_ciudad'] = 'Seleccione una ciudad';
            }
        }
    
        if(empty($datos['direccion_proveedor'])){
            $validaciones['direccion_proveedor'] = 'El campo dirección es requerido';
        }
    
        if(empty($datos['telefono_proveedor'])){
            $validaciones['telefono_proveedor'] = 'El campo telefono es requerido';
        } else if(!is_numeric($datos['telefono_proveedor'])) {
            $validaciones['telefono_proveedor'] = 'El campo telefono es de tipo numerico';
        }

        if(empty($_POST['email_proveedor'])){
            $validaciones['email_proveedor'] = 'El campo correo es requerido';
        } else if(!filter_input(INPUT_POST, 'email_proveedor' , FILTER_VALIDATE_EMAIL)) {
            $validaciones['email_proveedor'] = 'El campo email requiere un correo válido';
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