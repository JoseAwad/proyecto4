<?php
if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
    $uri = 'https://';
} else {
    $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];
require('../Modelo/sesion.class.php');
$sesion = new sesion();
$sesion->cerrar();

header('Location: '.$uri.'/Vista/login.php');
exit;
