<?php
require('../Modelo/sesion.class.php');
$sesion = new sesion();
if(!$sesion->validar()){
    header('Location: http://localhost/proyecto4/Vista/login.php?error=NoHaySesion');
    exit;
}else{
    require('../Modelo/conexion.class.php');
    $db=new conexion();
    $db->conn();
    require('../Modelo/tarea.class.php');
    $tarea = new tarea();
     $id = $_SESSION['id'];
 
    if(isset($_POST['accion']) && $_POST['accion']=='agregarAdmin'){
        if($tarea->agregar($_POST['nombreTarea'], $_POST['descTarea'], $_POST['fechaVenc'],$_POST['fechaRealizada'],$_POST['idProyecto'],$_POST['idUsuario'])){
            header('Location: http://localhost/proyecto4/Vista/tareaAdmin.php?agregar=true');
            exit;
        }else{
            header('Location: http://localhost/proyecto4/Vista/tareaAdmin.php?agregar=false');
            exit;
        }
    }elseif(isset($_POST['accion']) && $_POST['accion']=='agregarUsuario'){
        if($tarea->agregar($_POST['nombreTarea'], $_POST['descTarea'], $_POST['fechaVenc'],$_POST['fechaRealizada'],$_POST['idProyecto'],$id)
              ){
            header('Location: http://localhost/proyecto4/Vista/tareaUsuario.php?agregar=true');
            exit;
        }else{
            header('Location: http://localhost/proyecto4/Vista/tareaUsuario.php?agregar=false');
            exit;
        }
    }elseif(isset($_GET['accion']) && $_GET['accion']=='modificar'){
        if($tarea->actualizarFecha($_GET['idTarea'])
              ){
            header('Location: http://localhost/proyecto4/Vista/tareaUsuario.php?modificar=true');
            exit;
        }else{
            header('Location: http://localhost/proyecto4/Vista/tareaUsuario.php?modificar=false');
            exit;
    }
     }elseif(isset($_GET['accion']) && $_GET['accion']=='modificarAdmin'){
        if($tarea->actualizarFecha($_GET['idTarea'])
              ){
            header('Location: http://localhost/proyecto4/Vista/tareaAdmin.php?modificarAdmin=true');
            exit;
        }else{
            header('Location: http://localhost/proyecto4/Vista/tareaAdmin.php?modificarAdmin=false');
            exit;
        }    
}
}
?>