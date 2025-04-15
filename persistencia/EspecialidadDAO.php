<?php

class EspecialidadDAO{
    private $id;
    private $nombre;
    
    public function __construct($id=0, $nombre=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
    }
    
    public function consultar(){
        return "select idEspecialidad, nombre
                from Especialidad
                order by nombre asc";
    }
    
    public function consultarMedico(){
        return "Select
                    m.nombre, 
                    m.apellido, 
                    GROUP_CONCAT(e.nombre SEPARATOR ', ') AS especialidades
                FROM 
                    medico m
                JOIN 
                    especialidad e ON m.Especialidad_id = e.idEspecialidad
                GROUP BY 
                    m.nombre, m.apellido
                ORDER BY 
                    m.nombre ASC, m.apellido ASC;";
    }
    
}


?>