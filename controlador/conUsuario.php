<?php
require_once MODELO."modUsuario.php";

class ConUsuario {
    private $modelo;
    public $vista;

    public function __construct() {
        $this->modelo = new ModUsuario();
    }

    public function inicio() {
        $this->vista = "inicio.php";
    }

    public function inscripcion() {
        $this->vista = "inscripcion.php";
    }

    public function procesarInscripcion() {
        if (!isset($_POST['condiciones'])) {
            return "Debe aceptar las condiciones";
        }

        if ($this->modelo->existeUsuario()) {
            return "El nombre de usuario ya existe";
        }

        $res = $this->modelo->registrarUsuario();
        return $res ? "Usuario registrado" : "Error al registrar";
    }

    public function login() {
        $this->vista = "login.php";
    }

    public function procesarLogin() {
        $usuario = $this->modelo->login();
        if ($usuario) {
            session_start();
            $_SESSION['perfil'] = $usuario['perfil'];
            header("Location: index.php?c=Usuario&m=adminMenu");
        } else {
            return "Credenciales incorrectas";
        }
    }

    public function adminMenu() {
        $datos['usuarios_deportes'] = $this->modelo->listarUsuarios();
        $datos['total_deportes'] = $this->modelo->totalDeportes();
        $datos['deportes'] = $this->modelo->listarDeportes();
        $this->vista = "menuAdmin.php";
        return $datos;
    }
}