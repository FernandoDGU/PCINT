<?php
require_once "../model/UsuarioDAO.php";
require_once "../model/CursoDAO.php";
require_once "../model/CapitulosCursoDAO.php";
require_once "../model/ComentariodAO.php";
require_once "../model/MultimediaDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();

if (!isset($_GET["id"]))
    header('Location: Home.php');

$idCurso = $_GET["id"];

$idCap = $_GET["cap"];

$mostrarCap = $idCap - 1;

$usuarioDAO = new UsuarioDAO();
$correo = $_SESSION["correoActual"];

$arr = $usuarioDAO->getActualUser($correo);
$usuarioDAO->reInsertCon();
$userActual  = new Usuario($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], $arr[7]);
$arr[3] = "";

$cursoDAO = new CursoDAO();

$curso = $cursoDAO->cursoPorID($idCurso);
$cursoDAO->reInsertCon();

$capitulosCursoDAO = new CapitulosCursoDAO();

$capitulos = $capitulosCursoDAO->getCapitulosDeCurso($idCurso);

$comentarioDAO = new ComentarioDAO();
$comentarios = $comentarioDAO->comentariosPorCurso($idCurso);
$comentarioDAO->reInsertCon();

$cantVisto = $usuarioDAO->cantidadDeCapitulosVistos($correo, $idCurso);

$porcentajeBarra = round($cantVisto / $curso["cantidadCapitulos"] * 300);
$porcentaje = round($cantVisto / $curso["cantidadCapitulos"] * 100);

$multimediaDAO = new MultimediaDAO();

$multimedia = $multimediaDAO->getMultimediaCapítuloCurso($idCap, $idCurso);

$yaComento = $comentarioDAO->verSiComento($correo, $idCurso);
