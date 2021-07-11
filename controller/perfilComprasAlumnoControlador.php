<?php
if (!isset($_SESSION["correoActual"]))
    session_start();
require_once "../../../model/UsuarioDAO.php";
$usuarioDAO = new UsuarioDAO();
$cursosAlumnoFecha = $usuarioDAO->getUsuarioCursosFecha($_SESSION["correoActual"]);
