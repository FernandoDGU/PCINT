<?php
require_once "../model/CategoriaDAO.php";
$Categoria_dao = new CategoriaDAO();


if (isset($_GET["Origen"])) {
    if ($_GET["Origen"] == "TODOSAJAX") {
        $allCategories = $Categoria_dao->getAllCategories();
        $json = json_encode($allCategories);
        echo $json;
    }
    if ($_GET["Origen"] == "DESCRIPCION") {
        $desc = $Categoria_dao->getCategoryDescription($_POST["categoria"]);
        echo $desc["descripcion"];
    }
}
