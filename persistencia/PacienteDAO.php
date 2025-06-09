<?php

class PacienteDAO{
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $fechaNacimiento;

    public function __construct($id = 0, $nombre = "", $apellido = "", $correo = "", $clave = "", $fechaNacimiento = ""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> fechaNacimiento = $fechaNacimiento;
    }

       
    public function autenticar(){
        return "select idPaciente
                from Paciente
                where correo = '" . $this -> correo . "' and clave = '" . md5($this -> clave) . "'";
    }
    
    public function consultar(){
        return "select p.nombre, p.apellido, p.correo, p.fechaNacimiento  
                from Paciente p
                where idPaciente = '" . $this -> id . "'";
    }

    public function buscar($filtro){
        $sql = "SELECT p.idPaciente, p.nombre, p.apellido, p.correo FROM Paciente p WHERE ";
        
        $filtroNormalizado = trim(mb_strtolower($filtro, 'UTF-8')); 
        $tokens = explode(' ', $filtroNormalizado);
        
        $condiciones = [];
        foreach ($tokens as $token) {
            if (!empty($token)) { 
                $condiciones[] = "(LOWER(p.nombre) LIKE '%" . $token . "%' OR LOWER(p.apellido) LIKE '%" . $token . "%' OR LOWER(CONCAT(p.nombre, ' ', p.apellido)) LIKE '%" . $token . "%')";
                }
        }
        
        
        if (count($condiciones) > 0) {
            $sql .= implode(" AND ", $condiciones); 
        } else {
            return "SELECT p.idPaciente, p.nombre, p.apellido, p.correo FROM Paciente p WHERE 0"; 
        }
        
        return $sql;
    }
}
