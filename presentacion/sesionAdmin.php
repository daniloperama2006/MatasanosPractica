<?php
require_once(__DIR__ . "/../logica/Admin.php");
require_once(__DIR__ . "/sesion.php");


validarSesion("admin");

$admin = new Admin($_SESSION["id"]);
$admin->consultar();

echo "Hola " . $admin->getNombre() . " " . $admin->getApellido();
?>