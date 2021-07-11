<?php
require_once "../model/ComentarioDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();

$correo = $_SESSION["correoActual"];
$comentario = $_POST["comentario"];
$idCurso = $_POST["id_curso"];
$voto = $_POST["voto"];

$comentarioDAO = new ComentarioDAO();

$res = $comentarioDAO->insertarComentario($correo, $idCurso, $comentario, $voto);

echo $res;
