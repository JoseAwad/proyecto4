<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sesion
 *
 * @author cetecom
 */
class sesion {
    function iniciar(){
        session_start();
        $_SESSION['vigente']=true;
    }
    function validar(){
        session_start();
        if(isset($_SESSION['vigente']) && $_SESSION['vigente']){
            return true;
        }else{
            return false;
        }
    }
    function cerrar(){
        session_start();
        $_SESSION=array();
        session_destroy();
    }
}
