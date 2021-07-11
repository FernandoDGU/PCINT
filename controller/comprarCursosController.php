<?php
require_once "../model/UsuarioDAO.php";
if (!isset($_SESSION["correoActual"]))
    session_start();
if ($_SESSION["correoActual"] == null)
    echo "Se cerró sesión.";

$usuarioDAO = new UsuarioDAO();
$correo = $_SESSION["correoActual"];

$idCursos = $usuarioDAO->getCarroCursosId($correo);
$usuarioDAO->reInsertCon();


foreach ($idCursos as $id) {
    $usuarioDAO->comprarCursos($correo, $id["id_curso"]);
    $usuarioDAO->reInsertCon();
}
$usuarioDAO->actualizarCarro($correo);

echo true;
