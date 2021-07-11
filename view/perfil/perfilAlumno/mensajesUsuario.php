<?php
session_start();
require_once "../../../controller/chatPerfilControlador.php"
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
    <div id="correoActual" style="display:none;"><?php echo $correo; ?></div>
    <div id="correoSeleccionado" style="display:none;"></div>
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

            <div id="userMessages" class="col-md-9 col-lg-10 full-pageScroll-bar text-center jsc-account">
                <button id="btn-collapse" class="navbar-toggler mx-auto d-flex flex-column justify-content-center align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-caret-square-up fa-3x"></i>
                </button>
                <div class="row">
                    <div class="container" style="margin-right: 216px;">
                        <br>
                        <div class="row">
                            <div class="col-lg-4" style="border:solid 3px rgba(0, 0, 0, 0);">
                                <!-- height: 100px; -->
                                <h3>Contactos</h3>
                                <br />


                                <div class="scrollbar-70 bg-light border">
                                    <?php foreach ($usuarios as $usu) { ?>
                                        <a href="javascript:void(0)" class="list-group-item list-group-item-action" aria-current="" onclick="mostrarChat('<?php echo $usu["Correo"]; ?>', '<?php echo $usu["Nombre"]; ?>')">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-5 col-5 mb-3 mx-auto d-flex flex-column justify-content-center align-items-center ">
                                                    <div class="circular--portrait">
                                                        <img src="../../../controller/showUserImage.php?correo=<?php echo $usu["Correo"]; ?>" class="" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-6 col-sm-12 ">

                                                    <h5 class="text-center"><strong><?php echo $usu["Nombre"]; ?></strong></h5>
                                                    <?php if ($usu["Rol"] == 1) { ?>
                                                        <small class="text-center">Tipo usuario: <strong>Alumno</strong></small>
                                                    <?php } else { ?>
                                                        <small class="text-center">Tipo usuario: <strong>Escuela</strong></small>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-8" style="border:solid 3px rgba(0, 0, 0, 0);">
                                <div class="border-bottom">
                                    <div id="showImage" class="circular--portrait mx-auto d-flex">
                                        <img id="imageChat" src="https://www.w3schools.com/howto/img_avatar.png">
                                    </div>

                                    <strong id="nameChat" class="h5">...</strong>

                                </div>
                                <br />
                                <div class="row scrollbar-50 scrollbar-bottom">
                                    <div id="messageHistory" class="bg-light text-start">

                                    </div>
                                </div>
                                <br />
                                <hr>
                                <br>
                                <div>

                                    <label for="exampleFormControlTextarea1" class="form-label">Escribe tu
                                        mensaje</label>
                                    <textarea id="txta-message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>



                                </div>
                                <button id="sendMessage" class="btn btn-primary btn-scale mt-3">Enviar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Modales-->


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