<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){

   if($datos['accion'] == 'nuevo'){

    if(empty($datos['id_farmacia'])){
        $validaciones['id_farmacia'] = 'Seleccione una farmacia';
    }

    if(empty($datos['id_producto'])){
        $validaciones['id_producto'] = 'Seleccione un producto';
    }

   }
   if($datos['accion'] == 'nuevo' || $datos['accion'] == 'editar'){
    if(empty($datos['entradas'])){
        $validaciones['entradas'] = 'El campo entradas es requerido';
    } else if(!is_numeric($datos['entradas'])) {
        $validaciones['entradas'] = 'El campo entradas es de tipo numerico';
    }

    if(empty($datos['valor_unitario'])){
        $validaciones['valor_unitario'] = 'El campo valor unitario es requerido';
    } else if(!is_numeric($datos['valor_unitario'])) {
        $validaciones['valor_unitario'] = 'El campo valor unitario es de tipo numerico';
    } 

    if(empty($datos['valor_venta'])){
        $validaciones['valor_venta'] = 'El campo valor venta es requerido';
    } else if(!is_numeric($datos['valor_venta'])) {
        $validaciones['valor_venta'] = 'El campo valor venta es de tipo numerico';
    } 
   
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