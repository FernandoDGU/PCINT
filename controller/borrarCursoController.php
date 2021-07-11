<?php
require_once "../model/CursoDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();

$correo = $_SESSION["correoActual"];

$cursoDAO = new CursoDAO();

$idCurso = $cursoDAO->getUltimoCursoEscuela($_SESSION["correoActual"]);
$idDelCurso = $idCurso["id_curso"];
$cursoDAO->reInsertCon();

$res = $cursoDAO->eliminarCurso($idDelCurso);

echo $res;
