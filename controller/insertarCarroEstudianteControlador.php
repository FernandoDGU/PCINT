<?php
include_once '../model/UsuarioDAO.php';
if (!isset($_SESSION["correoActual"]))
    session_start();

$correo = $_SESSION["correoActual"];

$usuarioDAO = new UsuarioDAO();

$idCarroEstudiante = $usuarioDAO->getActualCarroId($correo);
$usuarioDAO->reInsertCon();

$idCurso = $_POST["idCurso"];

$res = false;

if ($_GET["Peticion"] == "Insertar")
    $res = $usuarioDAO->agregarCursoCarro($idCarroEstudiante["id_carro"], $idCurso);
else if ($_GET["Peticion"] == "Borrar")
    $res = $usuarioDAO->borrarDelCarro($idCarroEstudiante["id_carro"], $idCurso);

echo $res;
