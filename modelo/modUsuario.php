<?php
require_once "config/conexionDB.php";

class ModUsuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(SERVER, USER, PASS, DB);
    }

    public function login() {
        $nombreUsuario = $_POST['nombreUsuario'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario' AND password = '$password'";
        $res = $this->conexion->query($sql);
        return $res->fetch_assoc();
    }

    public function existeUsuario() {
        $nombreUsuario = $_POST['nombreUsuario'];
        $sql = "SELECT idUsuario FROM usuarios WHERE nombreUsuario = '$nombreUsuario'";
        $res = $this->conexion->query($sql);
        return $res->num_rows > 0;
    }

    public function registrarUsuario() {
        $datos = $_POST;
        $deportes = $_POST['deportes'] ?? [];

        $tel = !empty($datos['telefono']) ? "'".$datos['telefono']."'" : "NULL";
        
        $nombreUsuario = $datos['nombreUsuario'];
        $apeNombre = $datos['apeNombre'];
        $password = $datos['password'];
        $correo = $datos['correo'];
        $telefono = $datos['telefono'];
        $perfil = $datos['perfil'] ?? 'u';

        $sql = "INSERT INTO usuarios (nombreUsuario, apeUsuario, password, correo, telefono, perfil) 
                VALUES ('$nombreUsuario', '$apeNombre', '$password', '$correo', '$telefono', '$perfil')";
        
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

    public function listarUsuarios(){
        $sql = "SELECT u.idUsuario, u.nombreUsuario, u.apeNombre, u.correo, u.telefono, u.perfil, d.nombreDep AS deporte
            FROM Usuarios u
            INNER JOIN Usuarios_deportes ud ON u.idUsuario = ud.idUsuario
            INNER JOIN Deportes d ON ud.idDeporte = d.idDeporte";
        $res = $this->conexion->query($sql);

        $datos = [];
        while ($fila = $res->fetch_assoc()) {
            $datos[] = $fila;
        }

        return $datos;
    }

    public function totalDeportes(){
        $sql = "SELECT COUNT(DISTINCT idDeporte) AS Total_Deportes
                FROM Usuarios_deportes";
        $res = $this->conexion->query($sql);

        $datos = [];
        while ($fila = $res->fetch_assoc()) {
            $datos[] = $fila;
        }

        return $datos;
    }

    public function listarDeportes(){
        $sql = "SELECT d.nombreDep AS deporte, COUNT(ud.idUsuario) AS total_usuarios
                FROM Deportes d
                JOIN Usuarios_deportes ud ON d.idDeporte = ud.idDeporte
                GROUP BY d.idDeporte, d.nombreDep";
        $res = $this->conexion->query($sql);
        
        $datos = [];
        while ($fila = $res->fetch_assoc()) {
            $datos[] = $fila;
        }

        return $datos;
    }

}