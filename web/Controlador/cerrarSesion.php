<?php
require('../utils/utils.php');
require('../Modelo/sesion.class.php');
$sesion = new sesion();
$sesion->cerrar();

headerWrapper('/Vista/login.php');
exit;
