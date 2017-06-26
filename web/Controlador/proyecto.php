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
    require('../Modelo/proyecto.class.php');
    $proyecto = new proyecto();
    
    if(isset($_POST['accion']) && $_POST['accion']=='agregar'){
        if($proyecto->agregar($_POST['nombreProyecto'])){
            headerWrapper('/Vista/proyectoAdmin.php?agregar=true');
            exit;
        }else{
            headerWrapper('/Vista/proyectoAdmin.php?agregar=false');
            exit;
        }
    }elseif(isset($_GET['accion']) && $_GET['accion']=='eliminar'){
        if($proyecto->eliminar($_GET['idProyecto'])){
            headerWrapper('/Vista/proyectoAdmin.php?eliminar=true');
            exit;
        }else{
           headerWrapper('/Vista/proyectoAdmin.php?eliminar=false');
            exit;
    }
    }elseif(isset($_POST['accion']) && $_POST['accion']=='editar'){
        if($proyecto->modificar($_POST['idProyecto'],$_POST['nombreProyecto'])){
            headerWrapper('/Vista/proyectoAdmin.php?editar=true');
            exit;
        }else{
            headerWrapper('/Vista/proyectoAdmin.php?editar=false');
            exit;
        }
    }
}

?>