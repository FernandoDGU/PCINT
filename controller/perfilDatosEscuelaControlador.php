<?php

if (isset($_GET["Origen"])) {
    if ($_GET["Origen"] == "AJAX") {
        require_once "../model/UsuarioDAO.php";
        require_once "../model/CursoDAO.php";
        require_once "../model/ComentarioDAO.php";
    }
} else {
    require_once "../../../model/UsuarioDAO.php";
    require_once "../../../model/CursoDAO.php";
    require_once "../../../model/ComentarioDAO.php";
}
if (!isset($_SESSION["correoActual"]))
    session_start();

$dao = new UsuarioDAO();
$correo = $_SESSION["correoActual"];

$arr = $dao->getActualUser($correo);
$userActual  = new Usuario($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], $arr[7]);
$arr[3] = "";


if (isset($_GET["Origen"])) {
    if ($_GET["Origen"] == "AJAX") {
        $json = json_encode($arr);
        echo $json;
    }
}

$comentariosDAO = new ComentarioDAO();
$comentarios = $comentariosDAO->comentariosDeCursosEscuela($_SESSION["correoActual"]);

$cursoDAO = new CursoDAO();

$cantCursos = $cursoDAO->getCantCursos($correo);

$dao->reInsertCon();
$cantAlumnos = $dao->cantAlumnos($correo);
