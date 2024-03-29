<?php
require_once '../Modelo/modeloCiudad.php';

if ($datos = $_POST){
    
switch ($_POST['accion']){
    
    case 'editar':
        $ciudad = new Ciudad();
		$resultado = $ciudad->nuevo_editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $ciudad = new Ciudad();
		$resultado = $ciudad->nuevo_editar($datos);
        if($resultado == true) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
    break;

    case 'borrar':
		$ciudad = new Ciudad();
		$resultado = $ciudad->borrar($datos['codigo']);
        if($resultado == true) {
            $respuesta = array(
                'respuesta' => 'correcto'
            );
        }  else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        echo json_encode($respuesta);
    break;
     
}

}
else{

    $datos = $_GET; 
       
    switch ($_GET['accion']){

    case 'listar':
        $ciudad = new Ciudad();
        $listado = $ciudad->listar();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
    break;

    case 'consultar':
        $ciudad = new Ciudad();
        $ciudad->consultar($datos['codigo']);

        if($ciudad->getId_ciudad() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $ciudad->getId_ciudad(),
                'ciudad' => $ciudad->getNombre_ciudad(),
                'pais' => $ciudad->getId_pais(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
    break;
    # Archivos js que utilizan este case: funcionesCliente, funcionesEmpleado y funcionesVenta
    case 'listar_ciudades_paises':
        $ciudad = new Ciudad();
        $listado = $ciudad->listarCiudadespaises($datos['codigo']);        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
    break; 
    
}

}
?>