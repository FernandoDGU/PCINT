<?php
require_once "../model/CapitulosCursoDAO.php";

$dao = new CapitulosCursoDAO();
$arr = $dao->getVideoCapitulo($_GET["id"], $_GET["cap"]);
$data = $arr["video"];
$type = $arr["tipoVideo"];
header("Content-Type: $type");

echo $data;
