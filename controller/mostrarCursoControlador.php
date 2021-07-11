<?php
require_once "../model/UsuarioDAO.php";
require_once "../model/CursoDAO.php";
require_once "../model/CapitulosCursoDAO.php";
require_once "../model/ComentarioDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();

if (!isset($_GET["id"]))
    header('Location: Home.php');

$idCurso = $_GET["id"];

$usuarioDAO = new UsuarioDAO();
$correo = $_SESSION["correoActual"];

$arr = $usuarioDAO->getActualUser($correo);
$usuarioDAO->reInsertCon();
$userActual  = new Usuario($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], $arr[7]);
$arr[3] = "";

$cursoDAO = new CursoDAO();

$curso = $cursoDAO->cursoPorID($idCurso);
$cursoDAO->reInsertCon();

$categorias = $cursoDAO->getCursosCategoriaPorID($idCurso);

$capitulosCursoDAO = new CapitulosCursoDAO();

$capitulos = $capitulosCursoDAO->getCapitulosDeCurso($idCurso);

$porcentaje = 0.0;
if ($curso['Votos Totales'] != 0) {
    $porcentaje = ($curso['puntaje'] / $curso['Votos Totales']) * 100;
}
$color;
$texto;

$porcentaje = round($porcentaje);

if ($porcentaje >= 90) {
    $color = "blue";
    $texto = "Este curso tiene muchísimos votos positivos.";
} else if ($porcentaje >= 75) {
    $color = "blue";
    $texto = "Este curso tiene más votos positivos.";
} else if ($porcentaje >= 59) {
    $color = "orange";
    $texto = "Este curso tiene votos variados.";
} else if ($porcentaje >= 1) {
    $color = "red";
    $texto = "Este curso tiene más votos negativos.";
} else if ($porcentaje == 0) {
    $color = "gray";
    $texto = "Este curso aún no cuenta con calificación.";
}

$comentarioDAO = new ComentarioDAO();
$comentarios = $comentarioDAO->comentariosPorCurso($idCurso);

$idCarroEstudiante = $usuarioDAO->getActualCarroId($correo);
$usuarioDAO->reInsertCon();
$isEnCarro = false;
if ($userActual->getRol() == 1) {
    $isEnCarro = $usuarioDAO->isCursoEnElCarro($idCarroEstudiante["id_carro"], $idCurso);
    $usuarioDAO->reInsertCon();
}

$usuarioYaTieneCurso = true;
if ($userActual->getRol() == 1) {
    $usuarioYaTieneCurso = $usuarioDAO->yaTieneCurso($correo, $idCurso);
}
