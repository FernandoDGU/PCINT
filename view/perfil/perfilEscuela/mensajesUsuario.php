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
    <script src="../../js/crearCurso.js"></script>
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

                        <li id="a-createCourse" class="nav-item">
                            <a id="openCreateCourse" class="nav-link" href="javascript:void(0)">
                                <i class="fas fa-plus-circle fa-lg"></i>
                                &nbsp; Crear curso
                            </a>
                        </li>

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

    <!--Confirmar eliminar cuenta-->
    <div class="modal fade" id="confirmationDeleteAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationDeleteAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered">
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

    <!--Crear Curso-->
    <div class="modal fade" id="createCourse" tabindex="-1" aria-labelledby="modifyCourseLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-blueShape2 text-white">
                    <h5 class="modal-title " id="modifyCourseLabel">Creando...</h5>
                </div>
                <div class="modal-body">
                    <form id="form-after-createCourse" action="cursosUsuario.php" action="POST"> </form>
                    <form id="form-createCourse" action="cursosUsuario.php" action="POST">
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-12">
                                    <div id="imagesCointainer mb-3">
                                        <div class='imageItem'>
                                            <div class='form-group'>
                                                <label>Imagen principal del curso</label>
                                                <input name='images' id="courseImageC" name="courseImageC" type='file' class='form-control' accept="image/*" onchange="checkIsEmpty(this, '#error-imageCourseC')">
                                            </div>
                                            <p id="error-imageCourseC" class="error-dm">
                                                Debes agregar una imagen.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group mt-3">
                                        <span class="input-group-text col-lg-2 col-12" id="basic-addon1"><i class="fas fa-graduation-cap"></i>&nbsp;Nombre
                                            del
                                            curso</span>
                                        <input type="text" id="nameCourseC" name="nameCourseC" class="form-control" placeholder="Máximo 30 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-nameCourseC', 31)">
                                    </div>
                                    <p id="error-nameCourseC" class="error-dm">
                                        El nombre del curso excede los 30 carácteres permitidos o se encuentra vacío.
                                    </p>


                                </div>
                                <div class="col-12 text-center mt-5">
                                    <h4>Eliga o introduzca nueva categoría:</h4>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="input-group mt-5 mb-5">
                                        <select id="categoryBoxC" name="categoryBoxC" class="form-select" id="inputGroupSelect02C" onchange="addCategory(this)">
                                            <option selected></option>

                                        </select>
                                        <label class="input-group-text" for="inputGroupSelect02C">Categorías</label>
                                    </div>
                                    <p id="error-categoryCourseC" class="error-dm">
                                        El curso debe contener al menos una categoría.
                                    </p>
                                    <div>

                                        <ol id="categories">

                                        </ol>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <div class="input-group mt-5 mb-5">
                                        <span class="input-group-text col-lg-3 col-12" id="basic-addon1"><i class="fas fa-bars"></i>&nbsp;Nueva categoría</span>
                                        <input id="newCategoryInput" name="newCategoryInput" type="text" class="form-control" placeholder="Máximo 30 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-newCategoryC', 31)">
                                    </div>
                                    <p id="error-newCategoryC" class="error-dm">
                                        La categoría excede los 30 carácteres permitidos o se encuentra vacío.
                                    </p>
                                    <div class="input-group mt-5 mb-5">
                                        <span class="input-group-text col-lg-3 col-12"><i class="fas fa-edit"></i>&nbsp;Descripción
                                        </span>
                                        <textarea form="form-createCourse" id="newCatDescription" name="newCatDescription" class="form-control" placeholder="Descripción de la categoría" aria-label="With textarea" onfocusout="checkIsEmpty(this, '#error-newCategoryDescriptionC')"></textarea>
                                    </div>
                                    <p id="error-newCategoryDescriptionC" class="error-dm">
                                        Escribe la descripción de la categoría.
                                    </p>
                                    <div class="text-end">
                                        <a id="btn-createCategory" class="btn btn-success">Agregar categoría</a>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-group mt-5">
                                        <span class="input-group-text col-lg-2 col-12" id="basic-addon1"><i class="fas fa-edit"></i>&nbsp;Descripción Corta</span>
                                        <input id="sDescriptionCourseC" name="sDescriptionCourseC" type="text" class="form-control" placeholder="Máximo 50 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-sDescriptionCourseC', 51)">
                                    </div>
                                    <p id="error-sDescriptionCourseC" class="error-dm">
                                        La descripción corta excede los 50 carácteres permitidos o se encuentra vacío.
                                    </p>
                                </div>

                                <div class="col-12">
                                    <div class="input-group mt-3">
                                        <span class="input-group-text col-lg-2 col-12"><i class="fas fa-edit"></i>&nbsp;Descripción
                                            Larga</span>
                                        <textarea form="form-createCourse" id="DescriptionCourseC" name="DescriptionCourseC" class="form-control" placeholder="Descripción principal" aria-label="With textarea" onfocusout="checkIsEmpty(this, '#error-DescriptionCourseC')"></textarea>
                                    </div>
                                    <p id="error-DescriptionCourseC" class="error-dm">
                                        Escribe la descripción del curso.
                                    </p>
                                </div>

                                <div class="accordion mt-5" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="true" aria-controls="collapse">
                                                Capítulo #1
                                            </button>
                                        </h2>
                                        <div id="collapse" class="accordion-collapse collapse show" aria-labelledby="heading" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">

                                                <div class="col-12">
                                                    <div class="input-group ">
                                                        <span class="input-group-text col-lg-2 col-12" id="basic-addon1"><i class="fas fa-graduation-cap"></i>&nbsp;Título del
                                                            capítulo</span>
                                                        <input type="text" id="name-chapter" name="name-chapter" class="form-control" placeholder="Máximo 30 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-name-chapter', 31)">
                                                    </div>
                                                    <p id="error-name-chapter" class="error-dm">
                                                        El título del capítulo excede los 30 carácteres permitidos o se
                                                        encuentra vacío.
                                                    </p>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group mt-3">
                                                        <span class="input-group-text col-lg-2 col-12"><i class="fas fa-edit"></i>&nbsp;Descripción</span>
                                                        <textarea form="form-createCourse" class="form-control" name="description-chapter" id="description-chapter" placeholder="Descripción principal" aria-label="With textarea" onfocusout="checkIsEmpty(this, '#error-description-chapter')"></textarea>
                                                    </div>
                                                    <p id="error-description-chapter" class="error-dm">
                                                        Debes agregar una descripción.
                                                    </p>
                                                </div>

                                                <div class="col-12">
                                                    <div id="" class="mt-5">
                                                        <div class=''>
                                                            <div class='form-group'>
                                                                <label>Video del capítulo <small style="color:red">*Obligatorio*</small></label>
                                                                <input name='video-chapter' id="video-chapter" type='file' class='form-control' accept="video/mp4" onchange="checkIsEmpty(this, '#error-video-chapter')">
                                                            </div>
                                                            <p id="error-video-chapter" class="error-dm">
                                                                Debes agregar un video.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div id="" class="mt-5">
                                                        <div class=''>
                                                            <div class='form-group'>
                                                                <label>Imagen del capítulo</label>
                                                                <input name="image-chapter" id="image-chapter" type='file' class='form-control' accept="image/*">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div id="" class="mt-5 mb-5">
                                                        <div class=''>
                                                            <div class='form-group'>
                                                                <label>Archivo del capítulo <small>*Solo
                                                                        pdf*</small></label>
                                                                <input name='pdf-chapter' id="pdf-chapter" type='file' class='form-control' accept="application/pdf">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-check mt-5">
                                                    <input class="form-check-input" name='free-chapter' type="checkbox" value="true" id="flexCheckDefault">
                                                    <label class="form-check-label" id="flexCheckDefault" for="flexCheckDefault">
                                                        Ofrecer como capítulo gratuito.
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 ">
                                    <button type="button" id="addChapter" class="btn btn-success mt-3">Agregar
                                        capítulo</button>
                                </div>
                                <div class="col-6 d-md-flex justify-content-md-end">
                                    <button type="button" id="removeChapter" class="btn btn-danger mt-3" disabled>Eliminar
                                        último
                                        capítulo</button>
                                </div>

                                <div class="col-3"></div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="input-group mt-5">
                                        <span class="input-group-text col-12" id="basic-addon1"><i class="fas fa-dollar-sign"></i>&nbsp;Precio del curso completo (MXN)</span>
                                        <input type="number" name="moneyCourseC" id="moneyCourseC" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkMoney(this, '#error-moneyCourseC')">
                                    </div>
                                    <p id="error-moneyCourseC" class="error-dm">
                                        Introduce un precio válido.
                                    </p>
                                </div>
                                <div class="col-3"></div>

                            </div>

                            <!--------------------------------------->
                            <input class="col-12" name="totalChapters" id="totalChapters" style="display:none;" value="1"></input>
                            <input class="col-12" name="cantCategorias" id="cantCategorias" style="display:none;" value="0"></input>
                            <!--------------------------------------->

                        </div>
                    </form>



                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary mx-auto d-flex" data-bs-dismiss="modal">Salir</button>
                    <button id="btn-createCourse" type="button" class="btn btn-primary mx-auto d-flex">Crear
                        curso</button>
                </div>
            </div>
        </div>
    </div>

    <!--Descripción Categoría-->
    <div class="modal " id="descriptionCategory" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-descripcion-categoria">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="dc-description">
                    <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-auto d-flex" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Loading-->
    <div class="modal fade" id="loadingMessage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loadingMessage-title">Modal title</h5>
                </div>
                <div class="modal-body" id="loadingMessage-body">

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</body>

</html>