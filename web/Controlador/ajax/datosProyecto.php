<?php
require('../../Modelo/conexion.class.php');
$db=new conexion();
$db->conn();
require('../../Modelo/proyecto.class.php');
$proyecto = new proyecto();

$datos=$proyecto->obtenerProyecto($_GET['idProyecto']);
echo json_encode($datos);

