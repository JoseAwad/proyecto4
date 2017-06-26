<?php

class proyecto{
    
function agregar($nombreProyecto){
        global $gbd;
            $sql="INSERT INTO proyecto (nombreProyecto) "
                    . "VALUES (:nombreProyecto)";
            $res=$gbd->prepare($sql);
            if($res->execute(array(':nombreProyecto' => $nombreProyecto) 
                          )
            ){
                return true;
            }else{
                return false;
            }
    }
    
    function obtenerTodos(){
        global $gbd;
        $sql = "SELECT * FROM proyecto";
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }
    
    function eliminar($idProyecto){
        global $gbd;
        $sql="DELETE FROM proyecto WHERE idProyecto=:idProyecto";
        $res=$gbd->prepare($sql);
        if($res->execute(array(':idProyecto' => $idProyecto ))){
            return true;
        }else{
            return false;
        }
    }
    
    function obtenerProyecto($idProyecto){
        global $gbd;
        $sql = "SELECT * FROM proyecto where idProyecto=".$idProyecto;
        $res=$gbd->query($sql);
        if($res){
            $row=$res->fetch(PDO::FETCH_ASSOC);
            return $row;
        }else{
            return false;
        }
    }

    function modificar($idProyecto,$nombreProyecto){
        global $gbd;
        $datos=array();
        $sql = "UPDATE proyecto SET nombreProyecto=:nombreProyecto WHERE idProyecto=:idProyecto";
        $datos[':nombreProyecto']=$nombreProyecto;
        $datos[':idProyecto']=$idProyecto;
        $res=$gbd->prepare($sql);
        if($res->execute($datos)){
            return true;
        }else{
            return false;
        }
    }
    

}
