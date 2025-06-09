<?php
require ("logica/Persona.php");
require ("logica/Paciente.php");

$filtro = $_GET["filtro"];
$paciente = new Paciente();
$pacientes = $paciente -> buscar($filtro); 

if(count($pacientes) > 0){
    echo "<table class='table table-striped table-hover mt-3'>";
    echo "<tr><th>Id</th><th>Nombre</th><th>Apellido</th><th>Correo</th></tr>";
    
    $filtroNormalizadoParaResaltado = trim(mb_strtolower($filtro, 'UTF-8')); 
    $tokensParaResaltado = explode(' ', $filtroNormalizadoParaResaltado);

    foreach($pacientes as $pac){
        $nombreOriginal = $pac->getNombre();
        $apellidoOriginal = $pac->getApellido();

        $nombreResaltado = $nombreOriginal;
        $apellidoResaltado = $apellidoOriginal;

        foreach ($tokensParaResaltado as $token) {
            if (!empty($token)) {
                $escapedToken = preg_quote($token, '/'); 
                $nombreResaltado = preg_replace("/($escapedToken)/i", "<strong>$1</strong>", $nombreResaltado);
                $apellidoResaltado = preg_replace("/($escapedToken)/i", "<strong>$1</strong>", $apellidoResaltado);
            }
        }

        echo "<tr>";
        echo "<td>" . $pac -> getId() . "</td>";
        echo "<td>" . $nombreResaltado . "</td>"; 
        echo "<td>" . $apellidoResaltado . "</td>"; 
        echo "<td>" . $pac -> getCorreo() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
}else{
    echo "<div class='alert alert-danger mt-3' role='alert'>No hay resultados</div>";
}
?>