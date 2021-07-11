<?php
include_once '../model/MensajeDAO.php';
if (!isset($_SESSION["correoActual"]))
    session_start();

$correoRemitente = $_SESSION["correoActual"];
$correoDestinatario = $_POST["correo"];
$mensaje = $_POST["mensaje"];

$mensajeDAO = new MensajeDAO();
$mensaje = new Mensaje(null, $correoRemitente, $correoDestinatario, $mensaje, null, null);
$res = $mensajeDAO->insertMensaje($mensaje);

echo $res;
