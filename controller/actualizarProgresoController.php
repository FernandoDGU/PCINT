<?php
require_once "../model/UsuarioDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();

$correo = $_SESSION["correoActual"];

$usuarioDAO = new UsuarioDAO();

$res = $usuarioDAO->actualizarProgreso($correo, $_POST["id_curso"]);
$usuarioDAO->reInsertCon();

$cantCap = $_POST["cantidadCapitulos"];

$cantVistos = $_POST["cantidadVistos"];
$cantVistos++;

if ($cantVistos == $cantCap)
    $res = $usuarioDAO->terminarCurso($correo, $_POST["id_curso"]);
echo $res;
