<?php
require_once "config/conexionDB.php";

class ModUsuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(SERVER, USER, PASS, DB);
    }

    public function login($user, $pass) {
        $sql = "SELECT * FROM usuarios WHERE user = '$user' AND pass = '$pass'";
        $res = $this->conexion->query($sql);
        return $res->fetch_assoc();
    }

    public function existeUsuario($user) {
        $sql = "SELECT id FROM usuarios WHERE user = '$user'";
        $res = $this->conexion->query($sql);
        return $res->num_rows > 0;
    }

    public function insertarUsuario($datos, $deportes) {
        $tel = !empty($datos['telefono']) ? "'".$datos['telefono']."'" : "NULL";
        
        $sql = "INSERT INTO usuarios (user, nombre, pass, email, telefono, perfil) 
                VALUES ('{$datos['user']}', '{$datos['nombre']}', '{$datos['pass']}', 
                        '{$datos['email']}', $tel, 'u')";
        
        if ($this->conexion->query($sql)) {
            $idUsuario = $this->conexion->insert_id;
            foreach ($deportes as $idDeporte) {
                $sqlDep = "INSERT INTO usuarios_deportes (id_usuario, id_deporte) 
                           VALUES ($idUsuario, $idDeporte)";
                $this->conexion->query($sqlDep);
            }
            return true;
        }
        return false;
    }

}