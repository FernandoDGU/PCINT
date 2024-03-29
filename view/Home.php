<?php

require_once "../controller/HomeControlador.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/miscelaneo.css">
    <link rel="stylesheet" href="css/home.css">

    <!--js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cf205b582d.js" crossorigin="anonymous"></script>
    <script src="js/appNavbar.js"></script>
    <script src="js/home.js"></script>

    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <link rel="icon" href="assets/img/icon.jpeg">
    <title>MediaCourse</title>
</head>

<body>
    <script>
        $(document).ready(function() {
            $('.multiple-items').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
        });
    </script>

    <style>
        .checked {
            color: orange;
        }
    </style>


    <!-- Navar -->

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

    <!-- Container other -->
    <div class="container mt-5" id="">
        <div class="row">
            <div class="col-12">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">


                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                    <label id="btn-category" class="btn btn-outline-primary btn-scale" for="btnradio3">Ver todas las categorías</label>
                </div>
                <div class="col-12 mt-3">
                    <div class="scrollmenu" style="display:none;">
                        <?php foreach ($categorias as $cat) { ?>
                            <a style="cursor:default;" class="" href="javascript:void(0)" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="top" data-bs-content="<?php echo $cat["descripcion"]; ?>" tabindex="0"><?php echo $cat["nombre"]; ?></a>
                        <?php } ?>
                    </div>
                </div>
                <h2 class="my-2">Explora los diferentes cursos que hay</h2>
                <span>Elije entre más de 1000 cursos que hay en video y obten un diploma que engrandezca tu conocimiento
                </span>
            </div>
            <br /><br />
            <div class="col-12 mt-5">
                <h3>Más populares</h3>
                <div class="multiple-items text-center" id="Slides">

                    <?php foreach ($cursosPopulares as $curso) { ?>
                        <div class="card" style="width: 18rem;">
                            <?php if (!isset($_SESSION["correoActual"])) { ?>
                                <div class="betterImages" style="width:50vh; height:30vh;">
                                    <img src="../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>" class="cursor-denied" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-content="Debes iniciar sesión para ver los detalles.">
                                </div>

                            <?php } else { ?>
                                <div class="betterImages" style="width:50vh; height:30vh;">
                                    <img src="../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>" class="cursor-pointer" onclick="window.location.href='muestraCurso.php?id=<?php echo $curso["id_curso"]; ?>';">
                                </div>

                            <?php } ?>
                            <div class="card-body">
                                <strong><?php echo $curso["titulo"]; ?></strong>
                                <p class="card-text"><?php echo $curso["desc_corta"]; ?></p>
                            </div>

                        </div>
                    <?php } ?>


                </div>


            </div>
            <div class="col-12 mt-5">
                <h3>Más vendidas</h3>
                <div class="multiple-items text-center " id="Slides">

                    <?php foreach ($cursosMasVendidos as $curso) { ?>
                        <div class="card" style="width: 18rem;">
                            <?php if (!isset($_SESSION["correoActual"])) { ?>
                                <div class="betterImages" style="width:50vh; height:30vh;">
                                    <img src="../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>" class="cursor-denied" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-content="Debes iniciar sesión para ver los detalles.">
                                </div>

                            <?php } else { ?>
                                <div class="betterImages" style="width:50vh; height:30vh;">
                                    <img src="../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>" class="cursor-pointer" onclick="window.location.href='muestraCurso.php?id=<?php echo $curso["id_curso"]; ?>';">
                                </div>

                            <?php } ?>
                            <div class="card-body">
                                <strong><?php echo $curso["titulo"]; ?></strong>
                                <p class="card-text"><?php echo $curso["desc_corta"]; ?></p>
                            </div>
                        </div>
                    <?php } ?>


                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5 text-center mx-auto d-flex flex-column justify-content-center align-items-center" id="Infocursos">
        <div class="row py-3">
            <div class="col-lg-3 ">
                <img src="https://www.mercadosiete.com/img/team-members/1584724669-8489.jpg" class="img-fluid img-thumbnail rounded-pill ">
            </div>
            <div class="col-lg-9 mx-auto d-flex flex-column justify-content-center align-items-center">
                <h2 class="text-center "><b>El 87 % de las personas que aprenden</b> para el desarrollo
                    profesional
                    reportan
                    beneficios
                    profesionales, como obtener un ascenso, un aumento o comenzar una nueva carrera
                </h2>

            </div>
        </div>
    </div>

    <div class="container start-50 mt-5">
        <h2 class=" text-end">Hecha un vistazo a los últimos cursos que se han creado</h2>
        <br />
        <div class="multiple-items text-center" id="Slides">

            <?php foreach ($ultimosCursos as $curso) { ?>
                <div class="card" style="width: 18rem;">
                    <?php if (!isset($_SESSION["correoActual"])) { ?>
                        <div class="betterImages" style="width:50vh; height:30vh;">
                            <img src="../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>" class="cursor-denied" tabindex="0" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" data-bs-content="Debes iniciar sesión para ver los detalles.">
                        </div>

                    <?php } else { ?>
                        <div class="betterImages" style="width:50vh; height:30vh;">
                            <img src="../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>" class="cursor-pointer" onclick="window.location.href='muestraCurso.php?id=<?php echo $curso["id_curso"]; ?>';">
                        </div>

                    <?php } ?>
                    <div class="card-body">
                        <strong><?php echo $curso["titulo"]; ?></strong>
                        <p class="card-text"><?php echo $curso["desc_corta"]; ?></p>
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
    <br>
    <br>


    <!--Modal Registrarse-->
    <div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="form-SignUp" action="../controller/iniciarSesionControlador.php" method="POST" enctype="multipart/form-data">
                    <input id="tipoUsuario" name="tipoUsuario" style="display:none;"></input>
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
                                    <input type="text" class="form-control" name="userName" id="userName" placeholder="Máximo 20 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateUserName(this)">

                                </div>
                                <p id="constrUserName" class="text-danger" style="display:none;">¡Ocupas tener máximo
                                    20 caracteres!</p>
                            </div>
                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <span class="input-group-text col-lg-3 col-12" id="basic-addon1"><i class="fas fa-envelope"></i>&nbsp;Correo Electrónico</span>
                                    <input name="emailUser" type="text" class="form-control" id="userEmail" placeholder="Máximo 50 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateEmailUser(this)">
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
                                    <input type="password" class="form-control" name="userPass" id="userPass" placeholder="Mínimo 8 carácteres, 1 mayúscula, 1 número y carácter especial" aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateUserPass(this)">
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
                        <small id="signUp-error" class="text-danger" style="display:none;">Ya hay un usuario con ese Correo.</small>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                        <button id="btn-SignUp" type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Iniciar Sesión-->
    <div class="modal fade" id="logIn" tabindex="-1" aria-labelledby="logInLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-LogIn" action="../controller/iniciarSesionControlador.php" method="POST">
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
                                    <input name="emailUser" type="text" class="form-control" id="userEmailLI" placeholder="..." aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateEmailUserLI(this)">
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
                        <small id="logIn-error" class="text-danger" style="display:none;">El Correo y/o Contraseña están mal</small>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                        <button id="btn-LogIn" type="submit" class="btn btn-primary" onclick="validateFormLogIn()">Iniciar</button>
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