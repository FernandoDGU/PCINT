<?php
session_start();
include_once '../controller/CarritoControlador.php';

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
    <link rel="stylesheet" href="css/carrito.css">

    <!--js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cf205b582d.js" crossorigin="anonymous"></script>
    <script src="js/carro.js"></script>
    <script src="js/appNavbar.js"></script>
    <!--<script src="js/prueba.js"></script>-->
    <link rel="icon" href="assets/img/icon.jpeg">
    <title>MediaCourse - Carro</title>

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
    <div class="container mt-5">
        <small class="h5 text-muted">Los cursos de tu carro:</small>
        <?php $precioTotal = 0.0;
        foreach ($cursos as $c) {
            $precioTotal += $c["precio"]; ?>
            <div id="curso<?php echo $c["id_curso"]; ?>">
                <hr>
                <div class="row">
                    <div id="idCurso" style="display:none;"><?php echo $c["id_curso"]; ?></div>
                    <div class="col-lg-2 col-sm-6 mx-auto d-flex flex-column justify-content-center align-items-center">
                        <img src="../controller/showCourseImage.php?id=<?php echo $c["id_curso"]; ?>" class="img-fluid img-thumbnail" style="border: 4px outset #770CF5;" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <p><strong class="align-middle"><?php echo $c["titulo"]; ?></strong></p>
                        <p><?php echo $c["descripcion"]; ?></p>
                        <small class="text-muted">Autor: <?php echo $c["nombre"]; ?></small>
                    </div>
                    <div class="col-lg-4 col-sm-12 text-center d-flex flex-column justify-content-center align-items-center">
                        <small class="text-muted">Precio:</small>
                        <h3><strong>$</strong><strong id="precio<?php echo $c["id_curso"]; ?>"><?php echo $c["precio"]; ?></strong></h3>
                        <button type="button" class="btn btn-link" onclick="borrarCursoCarro(<?php echo $c["id_curso"]; ?>)">Eliminar</button>
                    </div>
                </div>
                <hr>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h3>Total:</h3>
                    <h1 class="mb-5"><strong>$</strong><strong id="precioTotal"><?php echo $precioTotal; ?></strong></h1>


                    <div class="row mt-5" id="datosTarjeta">


                        <div class="col-lg-6 col-md-6">
                            <div class="md-form mb-5">
                                <i id="numberCard" class="far fa-credit-card fa-2x"></i> <label data-error="wrong" data-success="right">&nbsp;Número de
                                    tarjeta</label>
                                <input type="number" class="form-control validate" id="NumTarjeta" onfocusout="checkNumberLength(this, '#error-numberCard', 16)">
                                <p id="error-numberCard" class="error-dm" style="display:none;">
                                    La tarjeta debe ser de 16 digitos.
                                </p>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="md-form mb-5">
                                <i class="fas fa-user-shield fa-2x"></i> <label data-error="wrong" data-success="right">&nbsp;Nombre del propietario</label>
                                <input type="text" class="form-control validate" id="Propietario" onfocusout="checkIsEmpty(this, '#error-nameCard')">
                                <p id="error-nameCard" class="error-dm" style="display:none;">
                                    No puede dejar vacío este campo.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="md-form mb-5 text-center">
                                <i class="fas fa-user-slash fa-2x"></i> <label data-error="wrong" data-success="right">&nbsp;Fecha de vencimiento</label>
                                <div class="row">
                                    <div class="col-5">
                                        <input type="number" class="form-control validate" placeholder="MM" id="MM">
                                    </div>
                                    <div class="col-2">
                                        <h4>/</h4>
                                    </div>
                                    <div class="col-5">
                                        <input type="number" class="form-control validate" placeholder="AA" id="AA">
                                    </div>
                                    <p id="error-expireCard" class="error-dm" style="display:none;">
                                        Escriba el mes y año con dos digitos.
                                    </p>
                                </div>



                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6"></div>
                        <div class="col-lg-6 col-md-6">
                            <div class="md-form mb-5">
                                <i class="fas fa-shield-alt fa-2x"></i> <label data-error="wrong" data-success="right">&nbsp;Código de Seguridad
                                </label> <small>&nbsp;Los 3 digitos que están detrás de la tarjeta.</small>
                                <br>
                                <input type="number" class="form-control validate" style="width: 50%; display:inline;" id="Cod-Seguridad" onfocusout="checkNumberLength(this, '#error-securityCard', 3)">
                                <p id="error-securityCard" class="error-dm" style="display:none;">
                                    Debes escribir 3 digitos
                                </p>

                            </div>
                        </div>


                    </div>



                    <div class="d-grid gap-2 col-lg-2 col-sm-4 mx-auto mb-3">
                        <button id="btn-buy" class="btn btn-primary " id="closeModal" type="button">
                            <strong>Comprar</strong></button>
                    </div>
                    <hr>
                    <div class="d-grid gap-2 col-lg-2 col-sm-4 mx-auto mb-3">
                        <strong>Pagar con Paypal:</strong>
                        <div id="paypal-payment-button"></div>
                    </div>
                </div>
            </div>
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
<script src="https://www.paypal.com/sdk/js?client-id=AZKIlrn7DuTZg8MQwqe7dQWgMhYfIMJUuPJ5rAOqrPESADS1k6W5hJq-NX_cGievuRN2Snt6spH04b3p&disable-funding=credit,card"></script>
<script src="js/paypal.js">
</script>

</html>