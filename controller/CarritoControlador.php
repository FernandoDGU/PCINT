<?php
require_once "../model/UsuarioDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();

$dao = new UsuarioDAO();
$correo = $_SESSION["correoActual"];

$arr = $dao->getActualUser($correo);
$dao->reInsertCon();
$userActual  = new Usuario($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], $arr[7]);
$arr[3] = "";

$cursos = $dao->getCarroCursos($correo);
