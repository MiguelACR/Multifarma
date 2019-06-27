<?php
require_once '../Modelo/modeloLogin.php';
$datos = $_POST;
switch ($_POST['accion']){

    case 'login':
      $usuario = htmlspecialchars(trim("$_POST[usuario]"));
      $password = htmlspecialchars(trim("$_POST[password]"));
      $datos = array("usuario"=>$usuario, "password"=>$password);
        $login = new Login();
        $login->consultar($datos);

        if($login->getId_usuario() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            if(password_verify($datos['password'],$login->getClave_usuario())){
                session_start();
                $_SESSION['usuario'] = $login->getNickname_usuario();
                $respuesta = array(
                    'usuario' => $login->getId_usuario(),
                    'estado' => $login->getId_estado(),
                    'rol'    => $login->getId_rol(),
                    'respuesta' =>'existe'
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'no existe'
                );
            }
            
        }
        echo json_encode($respuesta);
        break;

    case 'consultarIE':
        $login = new Login();
        $login->consultarIE($datos['codigoU']);

        if($login->getId_usuarioxempleado() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'empleado' => $login->getId_empleado(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;

    case 'consultarNE':
        $login = new Login();
        $login->consultarNE($datos['codigoE']);

        if($login->getId_empleado() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            session_start();
            $_SESSION['id_farmacia'] = $login->getId_farmacia();
            $_SESSION['id_empleado'] = $login->getId_empleado();
            $_SESSION['nombre'] = $login->getNombre_completo();
            $respuesta = array(
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
        break;
        
        case 'editar':
        $login = new Login();
		$resultado = $login->editar($datos['codigoIU'],$datos['codigoE']);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;

        case 'bloqueo':
        $login = new Login();
        $login->consultarA($datos['codigoA']);

        if($login->getId_usuario() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }else {
                $respuesta = array(
                    'usuario' => $login->getId_usuario(),
                    'respuesta' =>'existe'
                );
        } 
        echo json_encode($respuesta);
        break;

        case 'listar':
        $login = new Login();
        $listado = $login->listar($datos['codigoL']);
        //echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE); 
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
