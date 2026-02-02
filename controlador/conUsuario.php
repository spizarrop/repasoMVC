<?php
require_once MODELO."modUsuario.php";

class ConUsuario {
    private $modelo;
    public $vista;
    public $mensaje;

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
            $this->mensaje = "Debe aceptar las condiciones";
            $this->vista = "inscripcion.php";
            return;
        }

        if ($this->modelo->existeUsuario()) {
            $this->mensaje = "El usuario ya existe";
            $this->vista = "inscripcion.php";
            return;
        }

        if(!empty($_POST['nombreUsuario'])  || !empty($_POST['nombreUsuario']) || !empty($_POST['password']) || !empty($_POST['correo'])){
             $res = $this->modelo->registrarUsuario();
        
            if($res){
                $this->mensaje = "Usuario registrado correctamente";
                $this->vista = "login.php";
                return;
            }else{
                $this->mensaje = "Error al registrar el usuario";
                $this->vista = "inscripcion.php";
                return;
            }
            $this->vista = "inscripcion.php";
        }else{
            $this->mensaje = "Flatan datos por rellenar";
            $this->vista = "inscripcion.php";
            return;
        }
       
    }

    public function login() {
        $this->vista = "login.php";
    }

    public function procesarLogin() {
        $datos = $this->modelo->login();

        if (empty($datos)) {
            $this->vista = "login.php";
            $this->mensaje = "Credenciales incorrectas";
            return;
        }

        $_SESSION['nombreUsuario'] = $datos['nombreUsuario'];
        $_SESSION['perfil'] = $datos['perfil'];

        if ($datos) {
            if($_SESSION['perfil'] == 'c'){
                header("Location: index.php?c=Usuario&m=menuCoordinador");
                exit;
            }else if($_SESSION['perfil'] == 'u'){
                header("Location: index.php?c=Usuario&m=menuUsuario");
                exit;
            }
        } else {
            return "Credenciales incorrectas";
        }
    }

    public function menuCoordinador() {
        $datos['usuarios_deportes'] = $this->modelo->listarUsuarios();
        $datos['total_deportes'] = $this->modelo->totalDeportes();
        $datos['deportes'] = $this->modelo->listarDeportes();
        $this->vista = "menuCoordinador.php";
        return $datos;
    }

    public function menuUsuario() {
        $this->vista = "menuUsuario.php";
    }
}