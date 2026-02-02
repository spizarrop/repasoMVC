<?php
require_once "config/conexionDB.php";

class ModUsuario {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(SERVER, USER, PASS, DB);
    }

    public function login() {
        $sql = "SELECT * FROM Usuarios WHERE nombreUsuario = ? AND password = ?";
        $stmt = $this->conexion->prepare($sql);

        $usuario = $_POST['nombreUsuario'];
        $pass = $_POST['password'];
        
        $stmt->bind_param("ss", $usuario, $pass);
        $stmt->execute();
        $res = $stmt->get_result();

        $datos = [];
        if ($fila = $res->fetch_assoc()) {
            $datos = $fila;
        }

        return $datos;
    }

    public function existeUsuario() {
        $nombreUsuario = $_POST['nombreUsuario'];
        $sql = "SELECT idUsuario FROM Usuarios WHERE nombreUsuario = ?";
        $stmt = $this->conexion->prepare($sql);

        $usuario = $_POST['nombreUsuario'];

        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->num_rows > 0;
    }

        public function registrarUsuario() {
            $deportes = $_POST['deportes'] ?? [];
            
            
            try {
                $this->conexion->begin_transaction();
                // Insertamos los datos del usuario
                $sql = "INSERT INTO Usuarios 
                (nombreUsuario, apeNombre, password, correo, telefono, perfil)
                VALUES (?, ?, ?, ?, ?, ?)";

                $stmt = $this->conexion->prepare($sql);

                $usuario = $_POST['nombreUsuario'];
                $ape = $_POST['apeNombre'];
                $pass = $_POST['password'];
                $correo = $_POST['correo'];
                $telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : null;
                $perfil = 'u';

                $stmt->bind_param("ssssis",$usuario,$ape,$pass,$correo,$telefono,$perfil);
                $stmt->execute();

                // Obtenemos el id de usuario e insertamos si tiene deportes
                $idUsuario = $this->conexion->insert_id;
                if (!empty($deportes)) {
                    $sqlDeporte = "INSERT INTO usuarios_deportes (idUsuario, idDeporte) VALUES (?, ?)";
                    $stmtDeporte = $this->conexion->prepare($sqlDeporte);

                    foreach ($deportes as $idDeporte) {
                        $stmtDeporte->bind_param("ii", $idUsuario, $idDeporte);
                        $stmtDeporte->execute();
                    }
                }

                // Si todo ha salido bien hacemos un commit
                $this->conexion->commit();
            } catch (Exception $e) {
                // Si se produce algun error al hacer las 2 consultas hacemos un rollback
                $this->conexion->rollback();
                return false;
            }
            
            return true;
        }

    public function listarUsuarios(){
        $sql = "SELECT u.idUsuario,
                    u.nombreUsuario,
                    u.apeNombre,
                    u.correo,
                    u.telefono,
                    u.perfil,
                    d.nombreDep AS deporte
                FROM Usuarios u
                JOIN Usuarios_deportes ud ON u.idUsuario = ud.idUsuario
                JOIN Deportes d ON ud.idDeporte = d.idDeporte
                ORDER BY u.idUsuario;";
        $res = $this->conexion->query($sql);

        $datos = [];
        while ($fila = $res->fetch_assoc()) {
            $datos[] = $fila;
        }

        return $datos;
    }

    public function totalDeportes(){
        $sql = "SELECT COUNT(DISTINCT idDeporte) AS Total_Deportes
                FROM Usuarios_deportes;";
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
                LEFT JOIN Usuarios_deportes ud ON d.idDeporte = ud.idDeporte
                GROUP BY d.idDeporte, d.nombreDep
                ORDER BY d.idDeporte;";
        $res = $this->conexion->query($sql);
        
        $datos = [];
        while ($fila = $res->fetch_assoc()) {
            $datos[] = $fila;
        }

        return $datos;
    }

}