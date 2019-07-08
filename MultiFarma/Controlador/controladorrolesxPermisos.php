<?php
require_once '../Modelo/modelorolesxPermisos.php';

$datos = $_POST;
    
switch ($_POST['accion']){

    case 'editar':
        $rolxpermiso = new Rolxpermiso();
        $resultado = $rolxpermiso->editar($datos['codigo'],$datos['codigoP'],$datos['codigoM'],$datos['codigoE']);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    case 'nuevo':
        $rolxpermiso = new Rolxpermiso();
        $resultado = $rolxpermiso->nuevo($datos['codigo']);
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
       
    case 'borrar':
		$rolxpermiso = new Rolxpermiso();
		$resultado = $rolxpermiso->borrar($datos['codigo']);
        if($resultado > 0) {
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

    case 'consultar':
        $rolxpermiso = new Rolxpermiso();
        $rolxpermiso->consultar($datos['codigo']);

        if($rolxpermiso->getId_rolxpermiso() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $rolxpermiso->getId_rolxpermiso(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $rolxpermiso = new Rolxpermiso();
        $listado = $rolxpermiso->listar($datos['codigo']);
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
    # Archivos js que utilizan este case: funcionesLogin
    case 'listar_permisos':
        $rolxpermiso = new Rolxpermiso();
        $listado = $rolxpermiso->listar($datos['codigo']);
        $i = 1;
        session_start();
        foreach ($listado as $index => $value){
           $index = $value;
           foreach ($index as $key => $val) {
            if($val == 1){
                $_SESSION["".$i."NA"] = "block";
                $i++;
                }
                else{
                $_SESSION["".$i.'NA'] = "none";
                $i++;
                }  
           }
        }
        $respuesta = array(
            'respuesta' => 'Perfecto'
        );  
        echo json_encode($respuesta);
    break;    
    
}
?>
