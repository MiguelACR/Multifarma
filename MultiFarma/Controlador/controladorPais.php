<?php
 
require_once '../Modelo/modeloPais.php';
if($datos = $_POST){
switch ($_POST['accion']){

    case 'editar':
        $pais = new Pais();
		$resultado = $pais->nuevo_editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
    break;

    case 'nuevo':
        $pais = new Pais();
		$resultado = $pais->nuevo_editar($datos);
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
		$pais = new Pais();
		$resultado = $pais->borrar($datos['codigo']);
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
        $pais = new Pais();
        $listado = $pais->listar();        
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);
    break;

    case 'consultar':
        $pais = new Pais();
        $pais->consultar($datos['codigo']);

        if($pais->getId_pais() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $pais->getId_pais(),
                'pais' => $pais->getNombre_pais(),
                'abreviatura' => $pais->getAbreviatura_pais(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
    break;
    
}
}
?>