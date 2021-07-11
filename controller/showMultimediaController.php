<?php
require_once "../model/MultimediaDAO.php";

$dao = new MultimediaDAO();
$arr = $dao->getMultimedia($_GET["id"]);
$data = $arr[0]["datosArchivo"];
$type = $arr[0]["tipoArchivo"];
header("Content-Type: $type");

echo $data;