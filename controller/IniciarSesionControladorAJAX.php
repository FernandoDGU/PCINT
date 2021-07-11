<?php
require_once "../model/UsuarioDAO.php";

$u = new Usuario($_POST["emailAJAX"], null, $_POST["passAJAX"], null, null, null, null, null);

$dao = new UsuarioDAO();


$res = $dao->logIn($u);

if ($res) {
    echo true;
} else
    echo false;
