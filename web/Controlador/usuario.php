<?php
require('../utils/utils.php');
require('../Modelo/sesion.class.php');
$sesion = new sesion();
if(!$sesion->validar()){
    headerWrapper('/Vista/login.php?error=NoHaySesion');
    exit;
}else{
    require('../Modelo/conexion.class.php');
    $db=new conexion();
    $db->conn();
    require('../Modelo/usuario.class.php');
    $usuario = new usuario();
 
    if(isset($_POST['accion']) && $_POST['accion']=='agregar'){
        if($usuario->agregar($_POST['nick'], $_POST['pwd'], $_POST['nombre'],$_POST['perfil'])){
            headerWrapper('/Vista/usuario.php?agregar=true');
            exit;
        }else{
            headerWrapper('/Vista/usuario.php?agregar=false');
            exit;
        }
    }elseif(isset($_GET['accion']) && $_GET['accion']=='eliminar'){
        if($usuario->eliminar($_GET['idUsuario'])){
            headerWrapper('/Vista/usuario.php?eliminar=true');
            exit;
        }else{
            headerWrapper('/Vista/usuario.php?eliminar=false');
            exit;
    }
    }elseif(isset($_POST['accion']) && $_POST['accion']=='editar'){
        if($usuario->modificar($_POST['idUsuario'],$_POST['nick'], $_POST['pwd'], $_POST['nombre'],$_POST['perfil'])){
            headerWrapper('/Vista/usuario.php?editar=true');
            exit;
        }else{
            headerWrapper('/Vista/usuario.php?editar=false');
            exit;
        }
    }
}

?>