<?php

require_once "../../../model/UsuarioDAO.php";

if (!isset($_SESSION["correoActual"]))
    session_start();

$dao = new UsuarioDAO();
$correo = $_SESSION["correoActual"];

$usuarios = $dao->llenarChat($correo);
