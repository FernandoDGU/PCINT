<?php
require_once "../model/CategoriaDAO.php";

$Categoria_dao = new CategoriaDAO();

$nombre = $_POST["nameC"];
$descripcion = $_POST["descriptionC"];

$c = new Categoria($nombre, $descripcion);

$res = $Categoria_dao->insertarCategoria($c);

echo $res;
