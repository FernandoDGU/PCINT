<?php
require_once "../model/CursoDAO.php";

$dao = new CursoDAO();
$arr = $dao->getImagenCurso($_GET["id"]);
$data = $arr["imgCurso"];
$type = $arr["tipoImagen"];
header("Content-Type: $type");

echo $data;
