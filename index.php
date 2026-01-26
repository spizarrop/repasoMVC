<?php
require_once "config/routes.php";

$controlador = $_GET["c"] ?? DEFAULT_CONTROLADOR;
$metodo = $_GET["m"] ?? DEFAULT_METODO;

$rutaControlador = CONTROLADOR."con".$controlador.".php";
require_once $rutaControlador;

$nombreControlador = "Con".$controlador;
$objControlador = new $nombreControlador();

$datos = $objControlador->$metodo();

include VISTA.$objControlador->vista;
?>