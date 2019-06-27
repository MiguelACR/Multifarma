<?php
 
require_once '../Modelo/modeloNomina.php';
$datos = $_GET;
switch ($_GET['accion']){
    case 'editar':
        $nomina = new Nomina();
        $resultado = $nomina->editar($datos);
        $respuesta = array(
            'respuesta' => $resultado
        );
        echo json_encode($respuesta);
        break;
   
    case 'nuevo':
        $nomina = new Nomina();
        $resultado = $nomina->nuevo($datos);
        if($resultado > 0) 
        {
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
		$nomina = new Nomina();
		$resultado = $nomina->borrar($datos['codigo']);
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
        $nomina = new Nomina();
        $nomina->consultar($datos['codigo']);

        if($nomina->getId_nomina() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $nomina->getId_nomina(),
                'empleado' => $nomina->getId_empleado(),
                'fecha' =>$nomina->getFecha(),
                'salarioB' =>$nomina->getSalario_basico(),
                'hextrasd' =>$nomina->getHextrasd(),
                'hextrasn' =>$nomina->getHextrasn(),
                'auxilio'  =>$nomina->getAuxilio_transporte(),
                'val_hextrad' =>$nomina->getValor_hextrad(),
                'val_hextran' =>$nomina->getValor_hextran(),
                'laborados'   =>$nomina->getDias_laborados(),
                'salarioD'    =>$nomina->getSalario_devengado(),
                'pension'     =>$nomina->getPension(),
                'salud'       =>$nomina->getSalud(),
                'salarioN'    =>$nomina->getSalario_neto(),  
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'listar':
        $nomina = new Nomina();
        $listado = $nomina->listar();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
        break;
}
?>
