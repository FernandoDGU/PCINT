<?php
session_start();
require_once "../../../controller/perfilComprasAlumnoControlador.php"
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

            <div id="userPurchases" class="col-md-9 col-lg-10 full-pageScroll-bar text-center jsc-account">
                <button id="btn-collapse" class="navbar-toggler mx-auto d-flex flex-column justify-content-center align-items-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-caret-square-up fa-3x"></i>
                </button>

                <?php foreach ($cursosAlumnoFecha as $curso) { ?>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-sm-6 mx-auto d-flex flex-column justify-content-center align-items-center">
                            <div class="betterImages">
                                <img src="../../../controller/showCourseImage.php?id=<?php echo $curso["id_curso"]; ?>">
                            </div>
                            <br>
                            <small class="text-muted">Fecha de adquisición:</small>
                            <h3><strong><?php echo $curso["fechaComprado"]; ?></strong></h3>
                        </div>
                        <div class="col-lg-6 col-sm-12 mx-auto d-flex flex-column justify-content-center align-items-center">
                            <p><strong class="align-middle"><?php echo $curso["titulo"]; ?></strong></p>
                            <p><?php echo $curso["descripcion"]; ?></p>
                            <small class="text-muted">Autor: <?php echo $curso["nombre"]; ?></small>
                        </div>
                        <div class="col-lg-4 col-sm-12 text-center d-flex flex-column justify-content-center align-items-center">
                            <small class="text-muted">Precio:</small>
                            <h3><strong>$<?php echo $curso["precio"]; ?></strong></h3>

                        </div>
                    </div>
                    <hr>
                <?php } ?>
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