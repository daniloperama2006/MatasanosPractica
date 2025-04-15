<?php
require_once("Persona.php"); 
require_once("persistencia/Conexion.php");
require_once("persistencia/EspecialidadDAO.php");

class Medico extends Persona {
    private $especialidad;

    public function __construct($especialidad="") {
        parent::__construct();
        $this->especialidad = $especialidad;
    }

    public function getTipoPersona($tipoPersona="") {
        return get_class($this);
    }

    public function getEspecialidad() {
        return $this->especialidad;
    }
    
    public function obtenerEspecialidad() {
        $conexion = new Conexion();
        $especialidadDAO = new EspecialidadDAO();
        $conexion->abrir();
        $conexion->ejecutar($especialidadDAO->consultarMedico());
        $especialidadesMedicos = array();
        while (($datos = $conexion->registro()) != null) {
            $medico = array(
                'nombre' => $datos[0],
                'apellido' => $datos[1],
                'especialidad' => $datos[2]
            );
            array_push($especialidadesMedicos, $medico);
        }
        $conexion->cerrar();
        return $especialidadesMedicos;
    }
    
}
