<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function validarSesion($rolEsperado) {
    if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== $rolEsperado) {
        session_destroy();
        $mensaje = urlencode("Acceso denegado. Por favor, inicia sesión.");
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $redirectUrl = "http://$host$uri/index.php?pid=" . base64_encode("presentacion/autenticar.php") . "&mensaje=" . urlencode("Acceso denegado. Inicie sesión.");
        header("Location: $redirectUrl");
        exit();
    }
}
