<?php
if (!isset($_SESSION["correoActual"]))
    session_start();
require_once "../../../model/UsuarioDAO.php";
$usuarioDAO = new UsuarioDAO();
$cursosProgreso = $usuarioDAO->getUsuarioCursos($_SESSION["correoActual"]);
