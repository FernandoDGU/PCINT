<?php
require_once "../model/UsuarioDAO.php";

$dao = new UsuarioDAO();
$datosImagen = $dao->getCon()->real_escape_string(file_get_contents($_FILES["images"]["tmp_name"]));
$tipoDato = $dao->getCon()->real_escape_string($_FILES["images"]["type"]);

$u = new Usuario($_POST["emailUser"], $_POST["userName"], $_POST["userPass"], $datosImagen, $tipoDato, $_POST["tipoUsuario"], null, null);



$res = $dao->signUp($u);

if ($res) {
    echo true;
} else
    echo false;
