<?php
require_once(__DIR__ . "/../logica/Medico.php");
require_once(__DIR__ . "/sesion.php");

validarSesion("medico");

$medico = new Medico($_SESSION["id"]);
$medico->consultar();

echo "Hola " . $medico->getNombre() . " " . $medico->getApellido();
echo "Usted tiene la especialidad: " . $medico-> getEspecialidad()->getNombre();
?>