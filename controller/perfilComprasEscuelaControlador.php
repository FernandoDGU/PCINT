<?php
if (!isset($_SESSION["correoActual"]))
    session_start();
require_once "../../../model/CursoDAO.php";
$cursoDAO = new CursoDAO();
$cursosEscuelaPrecios = $cursoDAO->cursosEscuelaPrecios($_SESSION["correoActual"]);
