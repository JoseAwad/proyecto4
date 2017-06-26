<?php


class tarea {

function agregar($nombreTarea,$descTarea,$fechaVenc,$fechaRealizada,$idProyecto,$idUsuario){
global $gbd;
    $sql="INSERT INTO tarea (nombreTarea,descTarea,fechaVenc,fechaRealizada,idProyecto) "
            . "VALUES (:nombreTarea,:descTarea,:fechaVenc,:fechaRealizada,:idProyecto)";
    $res=$gbd->prepare($sql);
    if($res->execute(array(':nombreTarea' => $nombreTarea,
                        ':descTarea' => $descTarea,
                        ':fechaVenc' => $fechaVenc,
                        ':fechaRealizada' =>$fechaRealizada,
                        ':idProyecto' =>$idProyecto) 
                  )
    )   
    {

        $res = $gbd->query("SELECT LAST_INSERT_ID()")->fetch(); 
        $idTarea=$res[0];
        $this->agregar2($idTarea, $idUsuario);
        return true;
    }else{
        return false;
    }
}

//function agregarUsuario($nombreTarea,$descTarea,$fechaVenc,$fechaRealizada,$idProyecto,$idUsuario){
//global $gbd;
//    $sql="INSERT INTO tarea (nombreTarea,descTarea,fechaVenc,fechaRealizada,idProyecto) "
//            . "VALUES (:nombreTarea,:descTarea,:fechaVenc,:fechaRealizada,:idProyecto)";
//    $res=$gbd->prepare($sql);
//    if($res->execute(array(':nombreTarea' => $nombreTarea,
//                        ':descTarea' => $descTarea,
//                        ':fechaVenc' => $fechaVenc,
//                        ':fechaRealizada' =>$fechaRealizada,
//                        ':idProyecto' =>$idProyecto) 
//                  )
//    )   
//    {
//        $res = $gbd->query("SELECT LAST_INSERT_ID()")->fetch(); 
//        $idTarea=$res[0];
//        $this->agregar2($idTarea, $idUsuario);
//        return true;
//    }else{
//        return false;
//    }
//}

function agregar2($idTarea,$idUsuario){
global $gbd;
    $sql="INSERT INTO usuario_tarea (idTarea,idUsuario) "
            . "VALUES (:idTarea,:idUsuario)";

    $res=$gbd->prepare($sql);
    if($res->execute(array(':idTarea' => $idTarea,
                        ':idUsuario' => $idUsuario) 
                  )
    ){
        return true;
    }else{
        return false;
    }
}
    
function obtenerAtrasada(){
        $id = $_SESSION['id'];
        global $gbd;
        $sql = "SELECT t.idTarea, t.nombreTarea, t.fechaVenc, t.fechaRealizada, t.descTarea, 
                u.idUsuario_tarea, u.idTarea, u.idUsuario FROM tarea t JOIN usuario_tarea u ON(t.idTarea = u.idTarea)
                WHERE t.fechaVenc<CURDATE() AND t.fechaRealizada='' AND idUsuario='".$id."' ";
        $res=$gbd->query($sql);
        //"SELECT * FROM tarea WHERE fechaVenc<CURDATE() and fechaRealizada='' AND idUsuario='".$id."' ";
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
   
    function obtenerHoy(){
       $id = $_SESSION['id'];
        global $gbd;
        $sql = "SELECT t.idTarea, t.nombreTarea, t.fechaVenc, t.fechaRealizada, t.descTarea, 
                u.idUsuario_tarea, u.idTarea, u.idUsuario FROM tarea t JOIN usuario_tarea u ON(t.idTarea = u.idTarea)
                WHERE t.fechaVenc=CURDATE() AND t.fechaRealizada='' AND idUsuario='".$id."' ";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
    
    function obtenerMañana(){
        $id = $_SESSION['id'];
        global $gbd;
        $sql = "SELECT t.idTarea, t.nombreTarea, t.fechaVenc, t.fechaRealizada, t.descTarea, 
                u.idUsuario_tarea, u.idTarea, u.idUsuario FROM tarea t JOIN usuario_tarea u ON(t.idTarea = u.idTarea)
                WHERE t.fechaVenc>CURDATE() AND t.fechaRealizada='' AND idUsuario='".$id."' ";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
    
        function TareasProyecto(){
        $id = $_SESSION['id'];
        global $gbd;
        $sql = "SELECT t.idTarea, t.nombreTarea, t.fechaVenc, t.fechaRealizada, t.descTarea, 
                u.idUsuario_tarea, u.idTarea, u.idUsuario FROM tarea t JOIN usuario_tarea u ON(t.idTarea = u.idTarea)
                WHERE t.fechaVenc>CURDATE() AND t.fechaRealizada='' AND idUsuario='".$id."' ";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
    
    function actualizarFecha($idTarea){
        global $gbd;
        $datos=array();
        $sql = "UPDATE tarea SET fechaRealizada=CURDATE() WHERE idTarea=:idTarea";
        $datos[':idTarea']=$idTarea;
        $res=$gbd->prepare($sql);
        if($res->execute($datos)){
            return true;
        }else{
            return false;
        }
    }
    
    
        function obtenerTodos(){
        global $gbd;
        $sql = "SELECT * FROM tarea t JOIN usuario_tarea u JOIN proyecto p JOIN usuario i ON(t.idTarea = u.idUsuario_Tarea) where p.idProyecto=t.idProyecto AND u.idUsuario=i.idUsuario;";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
    
            function obtenerPorUsuario(){
         $id = $_SESSION['id'];
        global $gbd;
        $sql = "SELECT * FROM tarea t JOIN usuario_tarea u JOIN proyecto p JOIN usuario i ON(t.idTarea = u.idUsuario_Tarea) where p.idProyecto=t.idProyecto AND u.idUsuario=i.idUsuario";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }

            function buscar(){
        global $gbd;
        $sql = "SELECT * FROM usuario_tarea";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }

    
    
}
