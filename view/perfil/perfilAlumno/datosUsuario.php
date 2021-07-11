<?php
session_start();
require_once "../../../controller/perfilDatosAlumnoControlador.php"
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
    <link rel="stylesheet" href="../../css/miscelaneo.css">
    <link rel="stylesheet" href="../../css/perfil.css">
    <link rel="stylesheet" href="../../css/pResultados.css">

    <!--js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cf205b582d.js" crossorigin="anonymous"></script>

    <script src="../../js/perfilUser.js"></script>
    <script src="../../js/mensajes.js"></script>
    <!--<script src="js/prueba.js"></script>-->
    <link rel="icon" href="../../assets/img/icon.jpeg">
    <title>MediaCourse</title>

</head>

<body>
    <div class="container-fluid">

        <div class="row">

            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active " aria-current="page" href="datosUsuario.php">
                                &nbsp; <i class="fas fa-user fa-lg"></i>
                                &nbsp;Mis datos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cursosUsuario.php">
                                &nbsp; <i class="fas fa-file-alt fa-lg"></i>
                                &nbsp; Mis cursos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="comprasUsuario.php">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                                &nbsp; Historial de compras
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="mensajesUsuario.php">
                                <i class="fas fa-comments fa-lg"></i>
                                &nbsp; Mensajes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../Home.php">
                                <i class="fas fa-arrow-alt-circle-left fa-lg"></i>
                                &nbsp; Regresar a la página principal
                            </a>
                        </li>
                        <hr>

                    </ul>
                </div>
            </nav>

            <div id="userData" class="col-md-9 col-lg-10  full-pageScroll-bar text-center jsc-account">
                <button id="btn-collapse" class="navbar-toggler mx-auto d-flex flex-column justify-content-center align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-caret-square-up fa-3x"></i>
                </button>
                <br>
                <div class="col-lg-2 col-sm-6 mx-auto d-flex flex-column justify-content-center align-items-center">

                    <div class="circular--portrait" style="width:20vh; height:20vh;">
                        <img src="../../../controller/showUserImage.php?correo=<?php echo $userActual->getCorreo() ?>">
                    </div>
                </div>
                <br>
                <h4 class="d-inline">Nombre de Usuario: </h4>
                <?php
                echo "<h4><strong>" . $userActual->getNombre() . "</strong></h4>";
                ?>
                <br><br>
                <h4 class="d-inline">Correo electrónico: </h4>
                <?php
                echo "<h4><strong id='perfilCorreo'>" . $userActual->getCorreo() . "</strong></h4>";
                ?>
                <br><br>
                <button id="btn-modifUser" class="btn btn-primary btn-scale">Modificar
                    Datos</button>
                <br><br>
                <hr><br>
                <h4 class="text-start">Se unió a <i><strong>MediaCourse</strong></i> el: <?php echo "<strong>" . $userActual->getFecha() . "</strong>" ?>
                </h4>
                <br><br>
                <h4 class="text-start">Cursos adquiridos: <strong><?php echo $cantComprados["cursosComprados"]; ?></strong></h4>
                <br><br>
                <h4 class="text-start">Cursos completados: <strong><?php echo $cantTerminados["cursosTerminados"]; ?></strong></h4>
                <br>
                <hr><br>
                <div class="col-12 text-center mb-5 mt-5">
                    <h3><strong>Comentarios de los cursos:</strong></h3>
                </div>
                <div class="row text-start mx-auto d-flex flex-column justify-content-center align-items-center">
                    <?php foreach ($comentarios as $com) { ?>
                        <div class="col-11 mb-3">
                            <h5><Strong><?php echo $com["titulo"] ?></Strong>
                                <?php if ($com["voto"] == 1) { ?>
                                    <button class="btn btn-success" disabled><i class="fas fa-thumbs-up"></i></button>
                                <?php } else { ?>
                                    <button class="btn btn-danger" disabled><i class="fas fa-thumbs-down"></i></button>
                                <?php } ?>
                                <h5>de: <small class="text-muted"><?php echo $com["nombre"] ?></small></h5>
                                <?php echo $com["comentario"] ?>
                                <br>
                                <p class="text-end">
                                    <small class=""><?php echo $com["fecha"] ?></small>
                                </p>
                                <hr>
                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

    <!--Modales-->

    <!--Modificar Datos-->
    <div class="modal fade" id="modifyUser" tabindex="-1" aria-labelledby="modifyUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="form-modifUser" action="datosUsuario.php" action="POST">
                    <div class="modal-header bg-blueShape2 text-white">
                        <h5 class="modal-title " id="modifyUserLabel">Modificando...</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div id="imagesCointainer mb-3">
                                    <div class='imageItem'>
                                        <div class='form-group'>
                                            <label>Imagen de perfil</label>
                                            <input name='images' id="profilePic" type='file' class='form-control' accept="image/*">
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
                                    <input type="text" class="form-control" id="userName" name="userName" placeholder="Máximo 20 carácteres" aria-label="Username" aria-describedby="basic-addon1" value="" onfocusout="validateUserName(this)">

                                </div>
                                <p id="constrUserName" class="text-danger" style="display:none;">¡Ocupas tener máximo
                                    20 caracteres!</p>
                            </div>
                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <span class="input-group-text col-lg-3 col-12" id="basic-addon1"><i class="fas fa-envelope"></i>&nbsp;Correo Electrónico</span>
                                    <input type="text" class="form-control" id="userEmail" name="userEmail" placeholder="Máximo 50 carácteres" aria-label="Username" aria-describedby="basic-addon1" value="" onfocusout="validateEmailUser(this)" disabled>
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
                                    <input type="password" class="form-control" id="userPass" name="userPass" placeholder="Mínimo 8 carácteres, 1 mayúscula, 1 número y carácter especial" aria-label="Username" aria-describedby="basic-addon1" onfocusout="validateUserPass(this)" value="">
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
                    <div class="modal-footer">

                        <small class="text-muted">Se modificó por última vez el: <?php echo $userActual->getFechaModif() ?></small>
                        <button id="btn-modificar" type="submit" class="btn btn-warning">Modificar</button>
                        <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>


                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Confirmar modificación-->
    <div class="modal fade" id="confirmationModifyUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModifyUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-blueShape2 text-white">
                    <h5 class="modal-title" id="confirmationModifyUserLabel">Enhorabuena</h5>
                </div>
                <div class="modal-body text-center">
                    ¡Tus datos se han actualizado con éxito!
                </div>
                <div class="modal-footer ">
                    <button id="btn-cmu" type="button" class="btn btn-primary mx-auto d-flex" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!--Confirmar eliminar cuenta-->
    <div class="modal fade" id="confirmationDeleteAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationDeleteAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmationDeleteAccount">Eliminando...</h5>
                </div>
                <div class="modal-body text-center">
                    ¿En verdad quieres eliminar tu cuenta? <br> ¡Ya no podrás recuperarla!
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary mx-auto d-flex" data-bs-dismiss="modal">Regresar</button>
                    <button id="btn-cmu" type="button" class="btn btn-danger mx-auto d-flex" data-bs-dismiss="modal">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>