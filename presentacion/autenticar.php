<?php 
define("ROL_ADMIN", "admin");
define("ROL_MEDICO", "medico");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("logica/Admin.php");
require_once("logica/Medico.php");

if (isset($_POST["autenticar"])) {
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];

    $admin = new Admin("", "", "", $correo, $clave);
    if ($admin->autenticar()) {
        session_regenerate_id(true);
        $_SESSION["id"] = $admin->getId();
        $_SESSION["rol"] = ROL_ADMIN;
        header("Location: ?pid=" . base64_encode("presentacion/sesionAdmin.php"));
        exit();
    }

    $medico = new Medico("", "", "", $correo, $clave);
    if ($medico->autenticar()) {
        session_regenerate_id(true);
        $_SESSION["id"] = $medico->getId();
        $_SESSION["rol"] = ROL_MEDICO;
        header("Location: ?pid=" . base64_encode("presentacion/sesionMedico.php"));
        exit();
    }

    echo "Correo o clave incorrectos.";
}

?>
<body class="bg-light">
	<?php if (isset($_GET['mensaje'])): ?>
		<div class="alert alert-warning text-center" role="alert">
			<?php echo htmlspecialchars($_GET['mensaje']); ?>
		</div>
	<?php endif; ?>

	<div class="container py-4">
		<div class="row align-items-center">
			<div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
				<img src="img/logo.png" alt="Logo Matasanos" class="img-fluid"
					style="width: 150px; height: auto;">
			</div>
			<div class="col-md-8 text-center text-md-start">
				<h1 class="text-primary">Matasanos EPS</h1>
				<p class="text-muted">Cuidamos tu salud y cuidamos de ti</p>
			</div>
		</div>
	</div>

	<div class="container my-5">
		<div class="row">
			<div class="col-4"></div>
			<div class="col-4">
				<div class="card">
					<div class="card-header bg-primary">
						<h4>Autenticar</h4>
					</div>
					<div class="card-body">
						<form action="?pid=<?php echo base64_encode("presentacion/autenticar.php") ?>" method="post">
							<div class="mb-3">								
								<input type="email" class="form-control" name="correo" placeholder="Correo">
							</div>
							<div class="mb-3">
								<input type="password" class="form-control" name="clave" placeholder="Clave">
							</div>							
							<button type="submit" class="btn btn-primary" name="autenticar">Autenticar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

