<?php

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $uri .= '/proyecto4/web';
}

require('../Modelo/conexion.class.php');
$db=new conexion();
$db->conn();
require('../Modelo/usuario.class.php');
$usuario = new usuario();
session_start();
    $_SESSION['nombre']=$_POST['nombre'];
//    $data4=$usuario->obtenerId();
//            foreach($data4 AS $value){
//               $_SESSION['id']=$value['idUsuario'];
//            }
    $id=$usuario->obtenerId();
    $perfil=$usuario->obtenerPerfil();
    foreach($id AS $value){
               $_SESSION['id']=$value['idUsuario'];
            }
    foreach($perfil AS $value){
                $_SESSION['perfil']=$value['perfil'];
            }
if($usuario->validar($_POST['nombre'], $_POST['pwd'])&&$_SESSION['perfil']==a){
    require('../Modelo/sesion.class.php');
    $sesion = new sesion();
    $sesion->iniciar();
    header('Location: '.$uri.'/Vista/menuAdmin.php?'.SID);
    exit;
}elseif($usuario->validar($_POST['nombre'], $_POST['pwd'])&&$_SESSION['perfil']==u){
    require('../Modelo/sesion.class.php');
    $sesion = new sesion();
    $sesion->iniciar();
    header('Location: '.$uri.'/Vista/menuUsuario.php?'.SID);
    exit;
}
else{
    header('Location: '.$uri.'/Vista/login.php?error=1');
    exit;
}
