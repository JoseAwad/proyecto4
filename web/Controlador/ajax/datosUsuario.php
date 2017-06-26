<?php
require('../../Modelo/conexion.class.php');
$db=new conexion();
$db->conn();
require('../../Modelo/usuario.class.php');
$usuario = new usuario();

$datos=$usuario->obtenerUsuario($_GET['idUsuario']);
echo json_encode($datos);

