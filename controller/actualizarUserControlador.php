<?php
require_once "../model/UsuarioDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();
$dao = new UsuarioDAO();

$correo = $_SESSION["correoActual"];
$arr = $dao->getActualUser($correo);
$dao->reInsertCon();
$userActual  = new Usuario($arr[0], $arr[1], $arr[2], $arr[3], $arr[4], $arr[5], $arr[6], $arr[7]);

$type = "";
$data = "";
if ($_FILES["images"]["name"] != null) {
    $type = $dao->getCon()->real_escape_string($_FILES["images"]["type"]);
    $data = $dao->getCon()->real_escape_string(file_get_contents($_FILES["images"]["tmp_name"]));
} else {
    $type = $dao->getCon()->real_escape_string($userActual->getTipoImagen());
    $data = $dao->getCon()->real_escape_string($userActual->getImgPerfil());
}

$u = new Usuario($correo, $_POST["userName"], $_POST["userPass"], $data, $type, null, null, null); ///////////////////////AÑADIR FOTO Y TIPO DE DATO DE FOTO

$res = $dao->updateUser($u);

echo $res;
