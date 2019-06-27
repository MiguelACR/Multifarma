<?php
    function usuarioAutenticado($i){
        if(!verificarUsuario()){
            header("location:index.php");
            exit();
        }
        else{
        if($i != 0){ 
        if($_SESSION["".$i."NA"] == 'none'){
            header("location:adminper.php");
        }
        }
        }
    }
    function verificarUsuario(){
        return isset($_SESSION["usuario"]);
    }
    session_start();
?>