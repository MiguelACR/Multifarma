<?php
require_once '../Modelo/modeloUsuarios.php';

$datos = $_POST;
    
switch ($_POST['accion']){
    
    case 'editar':
        $usuario = new Usuario();
        $resultado = $usuario->editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
        break;
    # Archivos js que utilizan este case: funcionesUsuario
    case 'editarconC':
        $usuario = new Usuario();
        $resultado = $usuario->editarconC($datos['codigoF'],$datos['codigoG'],$datos['codigoH'],$datos['codigoI'],
        $datos['codigoJ'],$datos['codigoK']);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
    break;   

    case 'nuevo':
        $usuario = new Usuario();
        $resultado = $usuario->nuevo($datos['codigoA'],$datos['codigoB'],$datos['codigoC'],$datos['codigoD']);
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
		$usuario = new Usuario();
		$resultado = $usuario->borrar($datos['codigo']);
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
        $usuario = new Usuario();
        $usuario->consultar($datos['codigo']);

        if($usuario->getId_usuario() == null) {
            $respuesta = array(
                'respuesta' => 'no existe'
            );
        }  else {
            $respuesta = array(
                'codigo' => $usuario->getId_usuario(),
                'nickname' => $usuario->getNickname_usuario(),
                'clave' =>$usuario->getClave_usuario(),
                'estado' =>$usuario->getId_estado(),
                'rol' =>$usuario->getId_rol(),
                'fecha' =>$usuario->getFechacreacion_usuario(),
                'respuesta' =>'existe'
            );
        }
        echo json_encode($respuesta);
    break;

    case 'listar':
        $usuario = new Usuario();
        $listado = $usuario->listar();
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
    break;
    # Archivos js que utilizan este case: funcionesFarmacia
    case 'listar_usuarios_roles':
        $usuario = new Usuario();
        $listado = $usuario->listarUsuariosroles($datos['codigo']);
        echo json_encode(array('data'=>$listado), JSON_UNESCAPED_UNICODE);    
    break;
    # Archivos js que utilizan este case: funcionesUsuario
    case 'identificarM':
        $usuario = new Usuario();
        $usuario->identificarM();
        if($usuario -> getId_usuario()==null){
            $respuesta = array(
                'respuesta' => 'no existe'
                );
            }
        else{
            $respuesta = array(
                'id_usuario' => $usuario->getId_usuario(),
                'respuesta' =>'existe'   
                );   
            }
        echo json_encode($respuesta);
    break; 
    # Archivos js que utilizan este case: funcionesUsuario
    case 'generarContraseña':
        $usuario = new Usuario();
        $resultado = $usuario->generarContraseña($datos['pass']);  
        $respuesta = array(
            'respuesta' => $resultado
        );
        echo json_encode($respuesta);
    break;
    # Archivos js que utilizan este case: funcionesLogin
    case 'login':
        $usuario = htmlspecialchars(trim("$_POST[usuario]"));
        $password = htmlspecialchars(trim("$_POST[password]"));
        $datos = array("usuario"=>$usuario, "password"=>$password);
          $usuario = new Usuario();
          $usuario->consultarDatoslogin($datos);
  
          if($usuario->getId_usuario() == null) {
              $respuesta = array(
                  'respuesta' => 'no existe'
              );
          }  else {
              if(password_verify($datos['password'],$usuario->getClave_usuario())){
                  session_start();
                  $_SESSION['usuario'] = $usuario->getNickname_usuario();
                  $respuesta = array(
                      'usuario' => $usuario->getId_usuario(),
                      'estado' => $usuario->getId_estado(),
                      'rol'    => $usuario->getId_rol(),
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
    # Archivos js que utilizan este case: funcionesLogin
    case 'consultar_datos_login':
          $usuario = new Usuario();
 
          $datos = array('usuario' => $datos['codigo']);

          $usuario->consultarDatoslogin($datos);
  
          if($usuario->getId_usuario() == null) {
              $respuesta = array(
                  'respuesta' => 'no existe'
              );
          }else {
                  $respuesta = array(
                      'usuario' => $usuario->getId_usuario(),
                      'respuesta' =>'existe'
                  );
          } 
          echo json_encode($respuesta);
    break;
        # Archivos js que utilizan este case: funcionesLogin
    case 'editar_estado':
        $usuario = new Usuario();
		$resultado = $usuario->nuevo_editar($datos);
        $respuesta = array(
                'respuesta' => $resultado
            );
        echo json_encode($respuesta);
    break;
        
}
?>
