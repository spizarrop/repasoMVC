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

        if ($this->modelo->existeUsuario($_POST['user'])) {
            return "El nombre de usuario ya existe";
        }

        $res = $this->modelo->insertarUsuario($_POST, $_POST['deportes'] ?? []);
        return $res ? "Usuario añadido" : "Error al insertar";
    }

    public function login() {
        $this->vista = "login.php";
    }

    public function procesarLogin() {
        $usuario = $this->modelo->login($_POST['user'], $_POST['pass']);
        if ($usuario) {
            session_start();
            $_SESSION['perfil'] = $usuario['perfil'];
            header("Location: index.php?c=Usuario&m=adminMenu");
        } else {
            return "Credenciales incorrectas";
        }
    }
}