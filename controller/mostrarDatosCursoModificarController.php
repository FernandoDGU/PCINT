<?php
include_once '../model/CursoDAO.php';

$cursoDAO = new CursoDAO();

$curso = $cursoDAO->cursoPorID($_POST["id_curso"]);

$json = json_encode($curso);

echo $json;
