<?php
require_once '../Modelo/modeloVenta.php';
if($datos = $_POST){
switch ($_POST['accion']){

    case 'nuevo':
        $venta = new Venta();
		$resultado = $venta->nuevo($datos['codigo'],$datos['codigoS'],$datos['codigoI'],$datos['codigoT']);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }  else {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }
        echo json_encode($respuesta);
        break;

    case 'nuevoD':
        $venta = new Venta();
		$resultado = $venta->nuevoD($datos, $datos['codigoF']);
        if($resultado > 0) {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }  else {
            $respuesta = array(
                'respuesta' => $resultado
            );
        }
        echo json_encode($respuesta);
        break;
}    
}
else{
$datos = $_GET;
switch ($_GET['accion']){

   
    case 'identificarM':
        $venta = new Venta();
        $venta->identificarM();
        if($venta -> getId_factura() == null){
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }
        else{
            $respuesta = array(
                'id_factura' => $venta->getId_factura(),
                'respuesta' =>'existe'   
            );   
        }
        echo json_encode($respuesta);
    break;
}
}
?>