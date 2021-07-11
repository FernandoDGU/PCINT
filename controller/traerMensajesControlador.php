<?php
include_once '../model/MensajeDAO.php';
if (!isset($_SESSION["correoActual"]))
    session_start();

$correo1 = $_SESSION["correoActual"];
$correo2 = $_POST["correo"];

$mensajeDAO = new MensajeDAO();

$mensajes = $mensajeDAO->getMensajes($correo1, $correo2);

$json = json_encode($mensajes);
echo $json;
