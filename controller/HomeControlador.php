<?php
require_once "../model/UsuarioDAO.php";
require_once "../model/CursoDAO.php";
require_once "../model/CategoriaDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();
if (isset($_SESSION["correoActual"])) {
    $dao = new UsuarioDAO();
    $correo = $_SESSION["correoActual"];

    $arr = $dao->getActualUser($correo);
    $userActual  = new Usuario($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], $arr[7]);
    $arr[3] = "";
}
$cursoDAO = new CursoDAO();
$cursosPopulares = $cursoDAO->getCursosPopulares();
$cursoDAO->reInsertCon();

$ultimosCursos = $cursoDAO->getUltimosCursos();
$cursoDAO->reInsertCon();

$cursosMasVendidos = $cursoDAO->getCursosMasVendidos();

$categoriaDAO = new CategoriaDAO();
$categorias = $categoriaDAO->getAllCategories();
