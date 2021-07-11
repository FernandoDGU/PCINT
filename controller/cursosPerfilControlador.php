<?php
if (!isset($_SESSION["correoActual"]))
    session_start();
require_once "../../../model/CursoDAO.php";

$cursoDAO = new CursoDAO();
$cursosEscuela = $cursoDAO->cursosEscuela($_SESSION["correoActual"]);
