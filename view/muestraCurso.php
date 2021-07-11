<?php
session_start();
include_once '../controller/mostrarCursoControlador.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/miscelaneo.css">
    <link rel="stylesheet" href="css/muestraCurso.css">

    <!--js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cf205b582d.js" crossorigin="anonymous"></script>
    <script src="js/muestraCurso.js"></script>
    <script src="js/appNavbar.js"></script>
    <!--<script src="js/prueba.js"></script>-->
    <link rel="icon" href="assets/img/icon.jpeg">

    <title>MediaCourse - Ver Curso</title>

</head>

<body>

    <?php

    if (!isset($_SESSION["correoActual"])) {
    ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="Home.php"><strong>MediaCourse</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
                        <form class="d-flex" action="" onsubmit="return searchCondition()">
                            <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
                                <input class="form-control" id="searchText" type="search" placeholder="Buscar" aria-label="Search">
                                <!-- Example split danger button -->

                                <div class="btn-group" id="search-btn-group">
                                    <button type="button" id="btn-searchOption" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        Selecciona &nbsp;
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                        <li><a class="dropdown-item" onclick="navbarChoosing(this)" href="javascript:void(0)">Curso</a></li>
                                        <li><a class="dropdown-item" onclick="navbarChoosing(this)" href="javascript:void(0)">Escuela</a>
                                        </li>
                                        <li><a class="dropdown-item" onclick="navbarChoosing(this)" href="javascript:void(0)">Categoría
                                            </a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                    </ul>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>



                                </div>
                            </ul>
                        </form>
                    </ul>
                    <ul class="navbar-nav me-auto mx-auto d-flex mb-2 mb-lg-0 text-center" id="navMainMenu">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Home.php"><i class="fas fa-home"></i> <br>
                                Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0)" onclick="signUp('Escuela')"> <i class="fas fa-chalkboard-teacher"></i>
                                <br> Quiero
                                enseñar</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" onclick="$('#logIn').modal('show');" href="javascript:void(0)" tabindex="-1"><i class="fas fa-sign-in-alt"></i> <br>
                                Iniciar sesión</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0)" onclick="signUp('Alumno')" tabindex="-1">
                                <i class="fas fa-user-plus"></i> <br>
                                Regístrate</a>
                        </li>
                    </ul>


                </div>
            </div>
        </nav>
    <?php
    } else {
        $rolUser = $userActual->getRol();
        $direccion = "";
        if ($rolUser)   $direccion = "perfilAlumno";
        else $direccion = "perfilEscuela";
    ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="Home.php"><strong>MediaCourse</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
                        <form class="d-flex" action="" onsubmit="return searchCondition()">
                            <ul class="navbar-nav me-auto mx-auto mb-2 mb-lg-0">
                                <input class="form-control" id="searchText" type="search" placeholder="Buscar" aria-label="Search">
                                <!-- Example split danger button -->

                                <div class="btn-group" id="search-btn-group">
                                    <button type="button" id="btn-searchOption" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        Selecciona &nbsp;
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
                                        <li><a class="dropdown-item" onclick="navbarChoosing(this)" href="javascript:void(0)">Curso</a></li>
                                        <li><a class="dropdown-item" onclick="navbarChoosing(this)" href="javascript:void(0)">Escuela</a>
                                        </li>
                                        <li><a class="dropdown-item" onclick="navbarChoosing(this)" href="javascript:void(0)">Categoría
                                            </a></li>

                                    </ul>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>



                                </div>
                            </ul>
                        </form>
                    </ul>
                    <ul class="navbar-nav me-auto mx-auto d-flex mb-2 mb-lg-0 text-center" id="navMainMenu">

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Home.php"><i class="fas fa-home"></i> <br>
                                Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="Home.php"><i class="fab fa-hotjar"></i> <br> Cursos populares</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="Home.php" tabindex="-1"><i class="fas fa-certificate"></i> <br>
                                Últimos cursos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo "perfil/$direccion/cursosUsuario.php" ?>" tabindex="-1"> <i class="fas fa-graduation-cap"></i> <br>
                                Mis cursos</a>
                        </li>

                        <li class="nav-item dropdown mx-auto d-flex flex-column justify-content-center align-items-center">
                            <a class="nav-link dropdown-toggle d-flex align-items-center active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../controller/showUserImage.php?correo=<?php echo $userActual->getCorreo() ?>" class="rounded-circle" height="25" width="25" alt="" loading="lazy" />
                                &nbsp; Mi perfil
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <?php

                                    echo "<h6 class='dropdown-header'>" . $userActual->getNombre() . "</h6>";

                                    ?>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>

                                <li><a class="dropdown-item" href="<?php echo "perfil/$direccion/datosUsuario.php" ?>">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="<?php echo "perfil/$direccion/cursosUsuario.php" ?>">Mis cursos</a></li>
                                <li><a class="dropdown-item" href="<?php echo "perfil/$direccion/mensajesUsuario.php" ?>">Mensajes</a></li>
                                <?php if ($userActual->getRol() == 1) { ?>
                                    <li><a class="dropdown-item" href="carrito.php">Carro</li>
                                <?php } ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../controller/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </li>

                    </ul>


                </div>
            </div>
        </nav>
    <?php
    }
    ?>

    <div class="container-fluid bg-blueShape1">
        <div class="row">
            <div id="idCurso" style="display:none;"><?php echo $curso["id_curso"]; ?></div>
            <div class="col-lg-4 col-sm-12 imageHeader mt-5 mb-5 mx-auto d-flex" style="background-image:url(../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>);">

            </div>
            <div class="col-lg-6 col-sm-12 mt-5 mb-5">
                <h4><strong> <?php echo $curso["titulo"]; ?></strong></h4>
                <small><strong>Categoría: <?php
                                            $numItems = count($categorias);
                                            $i = 0;
                                            foreach ($categorias as $c) {
                                                if (++$i === $numItems) {
                                                    echo $c["nombre"] . ".";
                                                } else {
                                                    echo $c["nombre"] . ", ";
                                                }
                                            } ?></strong></small>
                <br>
                <br>
                <p class=""><?php echo $curso["descripcion"]; ?>
                </p>
                <p><strong style="color:<?php echo $color; ?>;" class="cursor-pointer" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Un <?php echo $porcentaje; ?>% de las calificaciones fueron positivas" tabindex="0"><?php echo $texto; ?></strong>
                </p>
                <h5 class="text-center">Autor: <h5 class=" text-center text-blueShape2"><?php echo $curso["nombre"]; ?></h5>
                </h5>
            </div>
            <div class="col-12 text-center">
                <small><strong>Precio:</strong></small>
                <h3><strong>$<?php echo $curso["precio"]; ?> MXN</strong></h3>
            </div>
            <?php if ($userActual->getRol() == 1 && !$usuarioYaTieneCurso) { ?>
                <div class="d-grid gap-2 col-lg-2 col-sm-4 mx-auto mb-3">

                    <button class="btn btn-warning btn-scale" id="btn-addShop" type="button" <?php if ($isEnCarro) { ?> style="display:none;" <?php
                                                                                                                                            } ?>><i class="fas fa-shopping-cart"></i>
                        <br>
                        <strong>Agregar al carro</strong></button>

                    <button class="btn btn-danger btn-scale" id="btn-removeShop" type="button" <?php if (!$isEnCarro) { ?> style="display:none;" <?php } ?>><i class="fas fa-trash-alt"></i>
                        <br>
                        <strong>Eliminar del carro</strong></button>

                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h3><strong>Lista de capítulos:</strong></h3>
            </div>
            <div class="accordion accordion-flush mb-5" id="accordionFlushExample">
                <?php foreach ($capitulos as $c) { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading<?php echo $c["orden"]; ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $c["orden"]; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $c["orden"]; ?>">
                                Capítulo #<?php echo $c["orden"]; ?> - <?php echo $c["titulo"]; ?>
                            </button>
                        </h2>
                        <div id="flush-collapse<?php echo $c["orden"]; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $c["orden"]; ?> " data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body border-end border-bottom border-start"><?php echo $c["descripcion"]; ?>
                                <?php if ($c["esGratis"]) { ?>
                                    <div class="row bg-light ">
                                        <div class="col-xl-8 col-lg-12 mx-auto d-flex my-5">
                                            <video draggable="true" width="400" controls>
                                                <source src="../controller<?php echo $c["video"]; ?>" type="video/mp4" />
                                                <source src="mov_bbb.ogg" type="video/ogg" />
                                                Your browser does not support HTML5 video.
                                            </video>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


            <div class="col-12 text-center mb-5 mt-5 ">
                <h3><strong>Comentarios acerca del curso:</strong></h3>
            </div>
            <?php foreach ($comentarios as $com) { ?>
                <div class="col-lg-2 col-md-4 col-sm-5 mb-3 mx-auto d-flex flex-column justify-content-center align-items-center ">
                    <div class="betterImages">
                        <img src="../controller/showUserImage.php?correo=<?php echo $com["correo_estudiante"]; ?>">
                    </div>
                </div>
                <div class="col-lg-10 col-md-8 col-sm-12 mb-3 ">
                    <h5><Strong class="cursor-pointer"><?php echo $com["nombre"]; ?></Strong>
                        <?php if ($com["voto"] == 1) { ?>
                            <button class="btn btn-success" disabled><i class="fas fa-thumbs-up"></i></button>
                        <?php } else { ?>
                            <button class="btn btn-danger" disabled><i class="fas fa-thumbs-down"></i></button>
                        <?php } ?>
                    </h5>
                    <?php echo $com["comentario"]; ?>
                    <br>
                    <p class="text-end">
                        <small class=""><?php echo $com["fecha"]; ?></small>
                    </p>
                </div>
                <hr>
            <?php } ?>

        </div>
    </div>

    <!--Modal Registrarse-->
    <div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="" onsubmit="return validateFormSignUp()">
                    <div class="modal-header bg-blueShape2 text-white">
                        <h5 class="modal-title " id="signUpLabel">Registrando...</h5>
                    </div>
                    <div class="modal-body">
                        <h6 id="userText" class="text-center">
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div id="imagesCointainer mb-3">
                                    <div class='imageItem'>
                                        <div class='form-group'>
                                            <label>Imagen de perfil</label>
                                            <input name='images' id="profilePic" type='file' class='form-control' accept="image/*" onchange="validateProfilePic(this)">
                                        </div>
                                        <p id="constrProfilePic" class="text-danger" style="display:none;">¡Agrega una
                                            imagen
                                            de perfil!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <span class="input-group-text col-lg-3 col-12" id="basic-addon1"><i class="fas fa-user-edit"></i>&nbsp;Nombre de Usuario</span>
                                    <input type="text" class="form-control" id="userName" placeholder="Máximo 20 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateUserName(this)">

                                </div>
                                <p id="constrUserName" class="text-danger" style="display:none;">¡Ocupas tener máximo
                                    20 caracteres!</p>
                            </div>
                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <span class="input-group-text col-lg-3 col-12" id="basic-addon1"><i class="fas fa-envelope"></i>&nbsp;Correo Electrónico</span>
                                    <input type="text" class="form-control" id="userEmail" placeholder="Máximo 50 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateEmailUser(this)">
                                </div>
                                <p id="constrEmail1" class="text-danger" style="display:none;">¡Introduce un Correo
                                    Electrónico válido!</p>
                                <p id="constrEmail2" class="text-danger" style="display:none;">¡Ocupas tener un máximo
                                    de
                                    50 caracteres!</p>
                            </div>
                            <div class="col-12">

                                <div class="input-group mt-3">
                                    <span class="input-group-text col-lg-3 col-12" id="basic-addon1"><i class="fas fa-key"></i>&nbsp;
                                        Contraseña</span>
                                    <input type="password" class="form-control" id="userPass" placeholder="Mínimo 8 carácteres, 1 mayúscula, 1 número y carácter especial" aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateUserPass(this)">
                                </div>
                                <a id="specialChars" class="text-decoration" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="@#$%^&+*!=">
                                    <small class="cursor-pointer">*Carácteres Especiales</small>
                                </a>
                                <p id="constrPassword" class="text-danger" style="display:none;">¡Ocupas tener mínimo 8
                                    caracteres, una
                                    mayúscula, un número y un
                                    caracter especial
                                    @#$%^&+*!=</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Iniciar Sesión-->
    <div class="modal fade" id="logIn" tabindex="-1" aria-labelledby="logInLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="" onsubmit="return validateFormLogIn()">
                    <div class="modal-header bg-blueShape2 text-white">
                        <h5 class="modal-title " id="logInLabel">Iniciando sesión...</h5>
                    </div>
                    <div class="modal-body">
                        <h6 id="userText" class="text-center">
                            <strong>MediaCourse</strong>
                        </h6>
                        <hr>
                        <div class="row">

                            <div class="col-12">
                                <p>Ingresa tu correo electrónico</p>
                                <div class="input-group mt-3">

                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    <input type="text" class="form-control" id="userEmailLI" placeholder="..." aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateEmailUserLI(this)">
                                </div>
                                <p id="constrEmailLI" class="text-danger" style="display:none;">¡Introduce un Correo
                                    Electrónico válido!</p>
                            </div>
                            <div class="col-12">
                                <p>Ingresa tu contraseña</p>
                                <div class="input-group mt-3">

                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" id="userPassLI" placeholder="..." aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateUserPassLI(this)">
                                </div>

                                <p id="constrPasswordLI" class="text-danger" style="display:none;">Introduce la
                                    contraseña.</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Iniciar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="page-footer font-small text-white pt-5 mt-5 bg-primary">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 mb-md-0 mb-3 mt-auto ">
                    <small><strong>MediaCourse</strong></small>
                </div>

                <div class="col-md-4 mb-md-0 mb-3 mt-auto ">

                </div>
                <div class="col-md-4 mb-md-0 mb-3 text-end">
                    <small class="">© 2021 Copyright: <a class="text-reset" href="Home.html">
                            MediaCourse</a></small>
                </div>
            </div>
        </div>
    </footer>



</body>

</html>