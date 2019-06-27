<?php
 
require_once '../Modelo/modeloEstados.php';
$datos = $_GET;
switch ($_GET['accion']){

    case 'listar':
        $estado = new Estado();
        $listado = $estado->listar();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;

}
?>
