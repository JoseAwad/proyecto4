<?php
require('../Modelo/sesion.class.php');
$sesion = new sesion();
$sesion->cerrar();

header('Location: http://localhost/dashboard/proyecto4/Vista/login.php');
exit;
