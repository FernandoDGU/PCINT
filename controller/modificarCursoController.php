<?php
require_once "../model/UsuarioDAO.php";
require_once "../model/CursoDAO.php";

if (!isset($_SESSION["correoActual"]))
    session_start();
$dao = new UsuarioDAO();
$cursoDAO = new CursoDAO();
$cursoImagen = "";
$cursoTipoImagen = $dao->getCon()->real_escape_string($_FILES["images"]["type"]);
if ($cursoTipoImagen != null) {
    $cursoImagen = $dao->getCon()->real_escape_string(file_get_contents($_FILES["images"]["tmp_name"]));
} else {
    $cursoImagenModif = $cursoDAO->getImagenCurso($_POST["idModifCurso"]);
    $cursoDAO->reInsertCon();
    $cursoImagen = $dao->getCon()->real_escape_string($cursoImagenModif["imgCurso"]);
    $cursoTipoImagen = $dao->getCon()->real_escape_string($cursoImagenModif["tipoImagen"]);
}

$cursoNombre = $_POST["nameCourseM"];
$curso_sDesc = $_POST["sDescriptionCourseM"];
$curso_Desc = $_POST["DescriptionCourseM"];

$res = $cursoDAO->actualizarCurso($_POST["idModifCurso"], $cursoNombre, $cursoImagen, $cursoTipoImagen, $curso_Desc, $curso_sDesc);

echo $res;
