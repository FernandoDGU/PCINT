<?php
require_once "../model/UsuarioDAO.php";
require_once "../model/CursoDAO.php";
require_once "../model/MultimediaDAO.php";
require_once "../model/CategoriaDAO.php";
require_once "../model/CapitulosCursoDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();
$dao = new UsuarioDAO();
$cursoDAO = new CursoDAO();

$uploadDir = "assets/vid";


$chapters = $_POST["totalChapters"];
$cantCategorias = $_POST["cantCategorias"];
$cursoImagen = $dao->getCon()->real_escape_string(file_get_contents($_FILES["images"]["tmp_name"]));
$cursoTipoImagen = $dao->getCon()->real_escape_string($_FILES["images"]["type"]);
$cursoNombre = $_POST["nameCourseC"];
$cursoDinero = $_POST["moneyCourseC"];
$curso_sDesc = $_POST["sDescriptionCourseC"];
$curso_Desc = $_POST["DescriptionCourseC"];
$curso = new Curso(null, $_SESSION["correoActual"], $cursoNombre, $chapters, $cursoDinero, $cursoImagen, $cursoTipoImagen, $curso_Desc, $curso_sDesc, null, null);


$cursoDAO->insertarCurso($curso);
$cursoDAO->reInsertCon();
$idCurso = $cursoDAO->getUltimoCursoEscuela($_SESSION["correoActual"]);
$idDelCurso = $idCurso["id_curso"];


/////////////////////////////////////////////////////////////////////////////////////DATOS CURSO            $text = "Curso Imagen: $cursoImagen, Curso Nombre: $cursoNombre, Precio Curso: $cursoDinero, Descripción corta: $curso_sDesc, Descripción larga: $curso_Desc \n\n Cantidad de capítulos: $chapters \n\n\n";

$capituloCursoDAO = new CapitulosCursoDAO();
$multimediaDAO = new MultimediaDAO();

$freeChapter = "";
$capNombre = $_POST["name-chapter"];
$capDesc = $_POST["description-chapter"];
if (isset($_POST["free-chapter"]))
    $freeChapter = $_POST["free-chapter"];

if ($freeChapter != "true") {
    $freeChapter = "false";
}

$capTipoVideo = $dao->getCon()->real_escape_string($_FILES["video-chapter"]["type"]);
//$capVideo = $dao->getCon()->real_escape_string(file_get_contents($_FILES["video-chapter"]["tmp_name"]));
$capVideo = $_FILES["video-chapter"]["tmp_name"];
$randomName = uniqid();
move_uploaded_file($capVideo, "$uploadDir/$randomName.mp4");
$rutaVideo = "/assets/vid/$randomName.mp4";

$capituloCurso = new CapitulosCurso(null, $idDelCurso, '1', $freeChapter, $capNombre, $capDesc, $rutaVideo, $capTipoVideo);
$capituloCursoDAO->insertarCaptitulo($capituloCurso);
$capituloCursoDAO->reInsertConn();
$idCapituloCurso = $capituloCursoDAO->getUltimoCapituloCurso($idDelCurso);

$capImagenTipo = $dao->getCon()->real_escape_string($_FILES["image-chapter"]["type"]);
if ($capImagenTipo != null) {
    $capImagen = $dao->getCon()->real_escape_string(file_get_contents($_FILES["image-chapter"]["tmp_name"]));
    $capImagenNombre = $dao->getCon()->real_escape_string($_FILES["image-chapter"]["name"]);
    $multimediaImagen = new Multimedia(null, $idCapituloCurso["id_capitulo"], $idDelCurso, $capImagen, $capImagenNombre, $capImagenTipo);
    $multimediaDAO->insertMultimedia($multimediaImagen);
    $multimediaDAO->reInsertConn();
}
$capPDFTipo = $dao->getCon()->real_escape_string($_FILES["pdf-chapter"]["type"]);
if ($capPDFTipo != null) {
    $capPDF = $dao->getCon()->real_escape_string(file_get_contents($_FILES["pdf-chapter"]["tmp_name"]));
    $capPDFNombre = $dao->getCon()->real_escape_string($_FILES["pdf-chapter"]["name"]);
    $multimediaPDF = new Multimedia(null, $idCapituloCurso["id_capitulo"], $idDelCurso, $capPDF, $capPDFNombre, $capPDFTipo);
    $multimediaDAO->insertMultimedia($multimediaPDF);
    $multimediaDAO->reInsertConn();
}
/////////////////////////////////////////////////////////////////////////////////////PRIMER CAPÍTULO
//$text = "$text Capítulo: 1\nNombre: $capNombre, Gratis?: $freeChapter, Descripción: $capDesc, Video: $capVideo, Imagen: $capImagen, Pdf = $capPDF \n\n";
if ($chapters > 1) {
    for ($i = 2; $i <= $chapters; $i++) {
        $freeChapter = false;
        $capNombre = $_POST["name-chapter$i"];
        $capDesc = $_POST["description-chapter$i"];
        if (isset($_POST["free-chapter$i"]))
            $freeChapter = $_POST["free-chapter$i"];

        if ($freeChapter != "true") {
            $freeChapter = "false";
        }

        //$capVideo = $dao->getCon()->real_escape_string(file_get_contents($_FILES["video-chapter$i"]["tmp_name"]));
        $capVideo = $_FILES["video-chapter$i"]["tmp_name"];
        $randomName = uniqid();
        move_uploaded_file($capVideo, "$uploadDir/$randomName.mp4");
        $rutaVideo = "/assets/vid/$randomName.mp4";

        $capTipoVideo = $dao->getCon()->real_escape_string($_FILES["video-chapter$i"]["type"]);

        $capituloCurso = new CapitulosCurso(null, $idDelCurso, $i, $freeChapter, $capNombre, $capDesc, $rutaVideo, $capTipoVideo);
        $capituloCursoDAO->reInsertConn();
        $capituloCursoDAO->insertarCaptitulo($capituloCurso);
        $capituloCursoDAO->reInsertConn();
        $idCapituloCurso = $capituloCursoDAO->getUltimoCapituloCurso($idDelCurso);

        $capImagenTipo = $dao->getCon()->real_escape_string($_FILES["image-chapter$i"]["type"]);
        if ($capImagenTipo != null) {
            $capImagen = $dao->getCon()->real_escape_string(file_get_contents($_FILES["image-chapter$i"]["tmp_name"]));
            $capImagenNombre = $dao->getCon()->real_escape_string($_FILES["image-chapter$i"]["name"]);
            $multimediaImagen = new Multimedia(null, $idCapituloCurso["id_capitulo"], $idDelCurso, $capImagen, $capImagenNombre, $capImagenTipo);
            $multimediaDAO->insertMultimedia($multimediaImagen);
            $multimediaDAO->reInsertConn();
        }

        $capPDFTipo = $dao->getCon()->real_escape_string($_FILES["pdf-chapter$i"]["type"]);
        if ($capPDFTipo != null) {
            $capPDF = $dao->getCon()->real_escape_string(file_get_contents($_FILES["pdf-chapter$i"]["tmp_name"]));
            $capPDFNombre = $dao->getCon()->real_escape_string($_FILES["pdf-chapter$i"]["name"]);
            $multimediaPDF = new Multimedia(null, $idCapituloCurso["id_capitulo"], $idDelCurso, $capPDF, $capPDFNombre, $capPDFTipo);
            $multimediaDAO->insertMultimedia($multimediaPDF);
            $multimediaDAO->reInsertConn();
        }
        /////////////////////////////////////////////////////////////////////////////////////DEMÁS CAPÍTULOS $text = "$text Capítulo: $i\nNombre: $capNombre, Gratis?: $freeChapter, Descripción: $capDesc, Video: $capVideo, Imagen: $capImagen, Pdf = $capPDF \n\n";
    }
}
//$text = "$text Cantidad de Categorías: $cantCategorias\n\n";
$categoriaDAO = new CategoriaDAO();
for ($i = 1; $i <= $cantCategorias; $i++) {
    if (isset($_POST["categoriaCursoAgregar$i"])) {

        $categoria = $_POST["categoriaCursoAgregar$i"];
        $categoriaDAO->insertarCursoCategoria($idDelCurso, $categoria);
        $categoriaDAO->reInsertConn();
    } else {
        $i++;
    }
    /////////////////////////////////////////////////////////////////////////////////////LAS CATEGORÍAS
    //$text = "$text Categoría: $i\nNombre: $categoria\n";
}

echo true;
