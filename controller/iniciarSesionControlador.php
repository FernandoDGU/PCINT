<?php

session_start();

$_SESSION["correoActual"] = $_POST["emailUser"];



header("Location: ../view/Home.php");
