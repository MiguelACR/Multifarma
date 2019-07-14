<?php
$validaciones = [];
$datos = $_POST;

if(!empty($_POST)){
    if(empty($datos['id_empleado'])){
        $validaciones['id_empleado'] = 'Seleccione un empleado';  
    }

    if(empty($datos['salario_basico'])){
        $validaciones['salario_basico'] = 'El campo salario basico es requerido';
    } else if(!is_numeric($datos['salario_basico'])) {
        $validaciones['salario_basico'] = 'El campo salario basico es de tipo numerico';
    } else if($datos['salario_basico'] < 0){
        $validaciones['salario_basico'] = 'El campo salario basico no puede ser negativo';
    }

    if(empty($datos['hextrasd'])){
        $validaciones['hextrasd'] = 'El campo horas extras día es requerido';
    } else if(!is_numeric($datos['hextrasd'])) {
        $validaciones['hextrasd'] = 'El campo horas extras día es de tipo numerico';
    } else if($datos['hextrasd'] < 0){
        $validaciones['hextrasd'] = 'El campo horas extras día no puede ser negativo';
    }

    if(empty($datos['hextrasn'])){
        $validaciones['hextrasn'] = 'El campo horas extras noche es requerido';
    } else if(!is_numeric($datos['hextrasn'])) {
        $validaciones['hextrasn'] = 'El campo horas extras noche es de tipo numerico';
    } else if($datos['hextrasn'] < 0){
        $validaciones['hextrasn'] = 'El campo horas extras noche no puede ser negativo';
    }

    if(!is_numeric($datos['auxilio_transporte'])) {
        $validaciones['auxilio_transporte'] = 'El campo auxilio de transporte es de tipo numerico';
    } else if($datos['auxilio_transporte'] < 0){
        $validaciones['auxilio_transporte'] = 'El campo auxilio de transporte no puede ser negativo';
    }

    if(empty($datos['valor_hextrad'])){
        $validaciones['valor_hextrad'] = 'El campo valor horas extras día es requerido';
    } else if(!is_numeric($datos['valor_hextrad'])) {
        $validaciones['valor_hextrad'] = 'El campo valor horas extras día es de tipo numerico';
    } else if($datos['valor_hextrad'] < 0){
        $validaciones['valor_hextrasd'] = 'El campo valor horas extras día no puede ser negativo';
    }

    if(empty($datos['valor_hextran'])){
        $validaciones['valor_hextran'] = 'El campo valor horas extras noche es requerido';
    } else if(!is_numeric($datos['valor_hextran'])) {
        $validaciones['valor_hextran'] = 'El campo valor horas extras noche es de tipo numerico';
    } else if($datos['valor_hextran'] < 0){
        $validaciones['valor_hextran'] = 'El campo valor horas extras noche no puede ser negativo';
    }

    if(empty($datos['dias_laborados'])){
        $validaciones['dias_laborados'] = 'El campo días laborados es requerido';
    } else if(!is_numeric($datos['dias_laborados'])) {
        $validaciones['dias_laborados'] = 'El campo días laborados es de tipo numerico';
    } else if($datos['dias_laborados'] < 0){
        $validaciones['dias_laborados'] = 'El campo días laborados no puede ser negativo';
    }

    echo json_encode([
        'response' => count($validaciones) === 0,
        'errors'   => $validaciones
    ]);
}
?>