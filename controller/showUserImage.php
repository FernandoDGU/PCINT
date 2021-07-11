<?php
require_once "../model/UsuarioDAO.php";

$dao = new UsuarioDAO();
$arr = $dao->getUserImage($_GET["correo"]);
$data = $arr[0]["imgPerfil"];
$type = $arr[0]["tipoImagen"];

header("Content-Type: $type");

echo $data;
