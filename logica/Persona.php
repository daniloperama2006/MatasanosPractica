<?php

abstract class Persona {
    protected $nombre;
    protected $apellido;
    protected $correo;
    protected $clave;

    public function __construct($nombre="", $apellido="", $correo="", $clave="") {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->clave = $clave;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getClave() {
        return $this->clave;
    }

    abstract public function getTipoPersona($tipoPersona);
}
