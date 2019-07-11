<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){
    if(empty($datos['nombre_farmacia'])){
        $validaciones['nombre_farmacia'] = 'El campo nombre es requerido';
    } 

    if(empty($datos['direccion_farmacia'])){
        $validaciones['direccion_farmacia'] = 'El campo dirección es requerido';
    }

    if(empty($datos['telefono_farmacia'])){
        $validaciones['telefono_farmacia'] = 'El campo telefono es requerido';
    } else if(!is_numeric($datos['telefono_farmacia'])) {
        $validaciones['telefono_farmacia'] = 'El campo telefono es de tipo numerico';
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

    if(empty($datos['id_propietario'])){
        $validaciones['id_propietario'] = 'Seleccione un propietario';
    }

    if(empty($datos['id_rol'])){
        $validaciones['id_rol'] = 'Seleccione un rol';
        
        if(empty($datos['id_usuario'])){
            $validaciones['id_usuario'] = 'Seleccione un usuario';
        }
        
    }else{
        if(empty($datos['id_usuario'])){
            $validaciones['id_usuario'] = 'Seleccione un usuario';
        }
    }

    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>