<?php


class usuario {
    //put your code here
//    function validarAdm($nick,$pwd){
//        global $gbd;
//        //crear sentencia sql válida para obtener la pwd
//        $sql="SELECT pwd,perfil FROM usuario WHERE nick='".$nick."' ";
//        //ejecutar y obtener un objeto de resultado
//        $res=$gbd->query($sql);
//        if($res){
//            $row=$res->fetch(PDO::FETCH_ASSOC);
//            //comparar ambas contraseñas
//            if (password_verify($pwd, $row['pwd']) && $row['perfil']=="admin") {
//                //echo '¡La contraseña es válida!';
//                return true;
//            } else {
//                //echo 'La contraseña no es válida.';
//                return false;
//            }
//        }else{
//            return false;
//        }
//        
//    }
    
        function obtenerId(){
                
                    $nombre = $_SESSION['nombre'];
                    global $gbd;
                    $sql="SELECT idUsuario FROM usuario WHERE nick='".$nombre."' ";
                    $res=$gbd->query($sql);
                    if($res){
                        $row=$res->fetch(PDO::FETCH_ASSOC);
                        return $row;
                    }else{
                        return false;
                    }
                }
                
                        function obtenerPerfil(){
                
                    $nombre = $_SESSION['nombre'];
                    global $gbd;
                    $sql="SELECT perfil FROM usuario WHERE nick='".$nombre."' ";
                    $res=$gbd->query($sql);
                    if($res){
                        $row=$res->fetch(PDO::FETCH_ASSOC);
                        return $row;
                    }else{
                        return false;
                    }
                }
    
    
    function validar($nick,$pwd){
        global $gbd;
        //crear sentencia sql válida para obtener la pwd
        $sql="SELECT pwd FROM usuario WHERE nick='".$nick."' ";
        //ejecutar y obtener un objeto de resultado
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetch(PDO::FETCH_ASSOC);
            //comparar ambas contraseñas
            if (password_verify($pwd, $row['pwd'])) {
                //echo '¡La contraseña es válida!';
                return true;
            } else {
                //echo 'La contraseña no es válida.';
                return false;
            }
        }else{
            return false;
        }
        
    }
    
    function agregar($nick,$pwd,$nombre,$perfil){
        global $gbd;

            $pwd_encriptada=password_hash($pwd, PASSWORD_DEFAULT);
            $sql="INSERT INTO usuario (nick,pwd,nombre,perfil) "
                    . "VALUES (:nick,:pwd,:nombre,:perfil)";
            $res=$gbd->prepare($sql);
            if($res->execute(array(':nick' => $nick,
                                ':pwd' => $pwd_encriptada,
                                ':nombre' => $nombre,
                                ':perfil' =>$perfil) 
                          )
            ){
                return true;
            }else{
                return false;
            }
    }
    
    function obtenerTodos(){
        global $gbd;
        $sql = "SELECT * FROM usuario";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
    
    function eliminar($idUsuario){
        global $gbd;
        $sql="DELETE FROM usuario WHERE idUsuario=:idUsuario";
        $res=$gbd->prepare($sql);
        if($res->execute(array(':idUsuario' => $idUsuario ))){
            return true;
        }else{
            return false;
        }
    }
    
    function obtenerUsuario($idUsuario){
        global $gbd;
        $sql = "SELECT * FROM usuario where idUsuario=".$idUsuario;
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetch(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
    
    function modificar($idUsuario,$nick,$pwd,$nombre,$perfil){
        global $gbd;
        $datos=array();
        $sql = "UPDATE usuario SET nick=:nick,";
        $datos[':nick']=$nick;
        if(!empty($pwd)){
            $sql .= "pwd=:pwd,";
            $datos[':nombre']=$pwd;
        }
        $sql .= "nombre=:nombre,perfil=:perfil WHERE idUsuario=:idUsuario";
        $datos[':nombre']=$nombre;
        $datos[':perfil']=$perfil;
        $datos[':idUsuario']=$idUsuario;
        $res=$gbd->prepare($sql);
        if($res->execute($datos)){
            return true;
        }else{
            return false;
        }
    }
    
    
}
