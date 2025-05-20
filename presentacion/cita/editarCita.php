<?php
require_once(__DIR__ . "/../../persistencia/CitaDAO.php");
require_once(__DIR__ . "/../../logica/Cita.php");
require_once(__DIR__ . "/../../persistencia/Conexion.php");

$estados_posibles = [
    1 => "Programada",
    2 => "Cancelada",
    3 => "Realizada",
    4 => "Incumplida"
];

$id = $_SESSION["id"];
$rol = $_SESSION["rol"];

$mensaje = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['idCita'], $_POST['nuevoEstado'])) {
    $idCita = intval($_POST['idCita']);
    $idEstado = intval($_POST['nuevoEstado']);

    $conexion = new Conexion();
    $conexion->abrir();

    $sentencia = "UPDATE Cita SET EstadoCita_idEstadoCita = $idEstado WHERE idCita = $idCita";
    $conexion->ejecutar($sentencia);

    $conexion->cerrar();
}
?>

<div class="container mt-4">
  <h2 class="mb-3">Lista de Citas</h2>

  <?php 
    $citaObj = new Cita();
    $citas = $citaObj->consultarCitasEstados($rol, $id);

    echo "<table class='table table-striped table-hover'>";
    echo "<thead><tr><th>Id</th><th>Fecha</th><th>Hora</th>";
    if ($rol == "admin") {
        echo "<th>Paciente</th><th>Médico</th>";
    }
    echo "<th>Consultorio</th><th>Estado</th></tr></thead><tbody>";

    foreach($citas as $cit) {
        echo "<tr>";
        echo "<td>" . $cit->getId() . "</td>";
        echo "<td>" . $cit->getFecha() . "</td>";
        echo "<td>" . $cit->getHora() . "</td>";
        if ($rol == "admin") {
            echo "<td>" . $cit->getPaciente()->getNombre() . " " . $cit->getPaciente()->getApellido() . "</td>";
            echo "<td>" . $cit->getMedico()->getNombre() . " " . $cit->getMedico()->getApellido() . "</td>";
        }
        echo "<td>" . $cit->getConsultorio()->getNombre() . "</td>";
        echo "<td>" . $cit->getEstadoValor() . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
  ?>

  <h4 class="mt-5">Editar Estado de una Cita</h4>
  <form method="post" action="" class="row g-3 mt-2">
    <div class="col-md-4">
      <label for="idCita" class="form-label">ID de la cita</label>
      <select name="idCita" id="idCita" class="form-select" required>
        <option value="" selected disabled>Seleccione una cita</option>
        <?php foreach ($citas as $cit): ?>
          <option value="<?= $cit->getId() ?>">
            <?= $cit->getId() ?> - <?= $cit->getFecha() ?> <?= $cit->getHora() ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-4">
      <label for="nuevoEstado" class="form-label">Nuevo estado</label>
      <select name="nuevoEstado" id="nuevoEstado" class="form-select" required>
        <option value="" selected disabled>Seleccione un estado</option>
        <?php foreach ($estados_posibles as $idEstado => $nombreEstado): ?>
          <option value="<?= $idEstado ?>"><?= $nombreEstado ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-success">Guardar cambio</button>
    </div>
  </form>
</div>
