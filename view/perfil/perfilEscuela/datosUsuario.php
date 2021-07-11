<?php
session_start();
require_once "../../../controller/perfilDatosEscuelaControlador.php"
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
                <button id="btn-modifUser" class="btn btn-primary btn-scale" data-bs-toggle="modal" data-bs-target="#modifyUser">Modificar
                    Datos</button>
                <br><br>
                <hr><br>
                <h4 class="text-start">Se unió a <i><strong>MediaCourse</strong></i> el: <?php echo "<strong>" . $userActual->getFecha() . "</strong>" ?>
                </h4>
                <br><br>
                <h4 class="text-start">Cursos hechos: <strong><?php echo $cantCursos["cantidadCursos"]; ?></strong></h4>
                <br><br>
                <h4 class="text-start">Total de alumnos: <strong><?php echo $cantAlumnos["cantAlumnos"]; ?></strong></h4>
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

    <!--Modificar Curso-->
    <div class="modal fade" id="modifyCourse" tabindex="-1" aria-labelledby="modifyCourseLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-blueShape2 text-white">
                    <h5 class="modal-title " id="modifyCourseLabel">Creando...</h5>
                </div>
                <div class="modal-body">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-12">
                                <div id="imagesCointainerM mb-3">
                                    <div class='imageItem'>
                                        <div class='form-group'>
                                            <label>Imagen principal del curso</label>
                                            <input name='images' id="courseImageM" type='file' class='form-control' accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <span class="input-group-text col-lg-2 col-12" id="basic-addon1"><i class="fas fa-graduation-cap"></i>&nbsp;Nombre
                                        del
                                        curso</span>
                                    <input type="text" id="nameCourseM" class="form-control" placeholder="Máximo 30 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-nameCourseM', 31)" value="Lorem ipsum dolor sit amet.">
                                </div>
                                <p id="error-nameCourseM" class="error-dm">
                                    El nombre del curso excede los 30 carácteres permitidos o se encuentra vacío.
                                </p>


                            </div>
                            <div class="col-12 text-center mt-5">
                                <h4>Eliga o introduzca nueva categoría:</h4>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-5 mb-5">
                                    <select id="categoryBoxM" class="form-select" id="inputGroupSelect02M" onchange="addCategoryM(this)">
                                        <option selected></option>
                                        <option value="HTML" id="catM-HTML">HTML</option>
                                        <option value="CSS" id="catM-CSS" style="display:none;">CSS</option>
                                        <option value="JS" id="catM-JS">JS</option>
                                    </select>
                                    <label class="input-group-text" for="inputGroupSelect02M">Categorías</label>
                                </div>
                                <p id="error-categoryCourseM" class="error-dm">
                                    El curso debe contener al menos una categoría.
                                </p>
                                <div>

                                    <ol id="categoriesM">
                                        <li id="courseCategoryMCSS"> <strong class="cursor-pointer" onclick="showDescriptionCategory(this);">CSS</strong>
                                            <a class="text-end" href="javascript:void(0)" onclick="showCategoryCBM('CSS');">Eliminar</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="input-group mt-5 mb-5">
                                    <span class="input-group-text col-lg-3 col-12" id="basic-addon1"><i class="fas fa-bars"></i>&nbsp;Nueva categoría</span>
                                    <input id="newCategoryInputM" type="text" class="form-control" placeholder="Máximo 30 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-newCategoryM', 31)">
                                </div>
                                <p id="error-newCategoryM" class="error-dm">
                                    La categoría excede los 30 carácteres permitidos o se encuentra vacío.
                                </p>
                                <div class="input-group mt-5 mb-5">
                                    <span class="input-group-text col-lg-3 col-12"><i class="fas fa-edit"></i>&nbsp;Descripción
                                    </span>
                                    <textarea id="newCatDescriptionM" class="form-control" placeholder="Descripción de la categoría" aria-label="With textarea" onfocusout="checkIsEmpty(this, '#error-newCategoryDescriptionM')"></textarea>
                                </div>
                                <p id="error-newCategoryDescriptionM" class="error-dm">
                                    Escribe la descripción de la categoría.
                                </p>
                                <div class="text-end">
                                    <button id="btn-createCategoryM" class="btn btn-success">Agregar categoría</button>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="input-group mt-5">
                                    <span class="input-group-text col-lg-2 col-12" id="basic-addon1"><i class="fas fa-edit"></i>&nbsp;Descripción Corta</span>
                                    <input id="sDescriptionCourseM" type="text" class="form-control" placeholder="Máximo 65 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-sDescriptionCourseM', 66)" value="Lorem ipsum, dolor sit amet consectetur adipisicing elit.">

                                </div>
                                <p id="error-sDescriptionCourseM" class="error-dm">
                                    La descripción corta excede los 65 carácteres permitidos o se encuentra vacío.
                                </p>
                            </div>

                            <div class="col-12">
                                <div class="input-group mt-3">
                                    <span class="input-group-text col-lg-2 col-12"><i class="fas fa-edit"></i>&nbsp;Descripción
                                        Larga</span>
                                    <textarea id="DescriptionCourseM" class="form-control" placeholder="Descripción principal" aria-label="With textarea" onfocusout="checkIsEmpty(this, '#error-DescriptionCourseM')">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id dolorem eligendi voluptate earum facilis, omnis accusamus optio illo expedita vel libero fugiat, iure, sint excepturi at unde pariatur voluptas eaque.
                                    </textarea>

                                </div>
                                <p id="error-DescriptionCourseM" class="error-dm">
                                    Escribe la descripción del curso.
                                </p>
                            </div>

                            <div class="accordion mt-5" id="accordionExampleM">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingM">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseM" aria-expanded="true" aria-controls="collapseM">
                                            Capítulo #1
                                        </button>
                                    </h2>
                                    <div id="collapseM" class="accordion-collapse collapse show" aria-labelledby="headingM" data-bs-parent="#accordionExampleM">
                                        <div class="accordion-body">

                                            <div class="col-12">
                                                <div class="input-group ">
                                                    <span class="input-group-text col-lg-2 col-12" id="basic-addon1"><i class="fas fa-graduation-cap"></i>&nbsp;Título del
                                                        capítulo</span>
                                                    <input type="text" id="name-chapterM" class="form-control" placeholder="Máximo 30 carácteres" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkLength(this, '#error-name-chapterM', 31)" value="Lorem ipsum dolor sit amet.">
                                                </div>
                                                <p id="error-name-chapterM" class="error-dm">
                                                    El título del capítulo excede los 30 carácteres permitidos o se
                                                    encuentra vacío.
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <div class="input-group mt-3">
                                                    <span class="input-group-text col-lg-2 col-12"><i class="fas fa-edit"></i>&nbsp;Descripción</span>
                                                    <textarea class="form-control" id="description-chapterM" placeholder="Descripción principal" aria-label="With textarea" onfocusout="checkIsEmpty(this, '#error-description-chapterM')">Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta cupiditate labore perspiciatis placeat assumenda sed perferendis aliquid mollitia harum, asperiores, inventore optio est, doloribus sequi omnis iusto. Vitae architecto repellendus minus voluptas, consequuntur molestias, illo autem odio porro corporis rerum at hic expedita. Voluptates, tempora quis? Tempore, vel! Accusamus, atque.</textarea>

                                                </div>
                                                <p id="error-description-chapterM" class="error-dm">
                                                    Debes agregar una descripción.
                                                </p>
                                            </div>

                                            <div class="col-12">
                                                <div id="" class="mt-5">
                                                    <div class=''>
                                                        <div class='form-group'>
                                                            <label>Video del capítulo</label>
                                                            <input name='videos' id="video-chapterM" type='file' class='form-control' accept="video/*">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div id="" class="mt-5">
                                                    <div class=''>
                                                        <div class='form-group'>
                                                            <label>Imagen del capítulo</label>
                                                            <input name='videos' id="image-chapterM" type='file' class='form-control' accept="image/*">
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
                                                            <input name='videos' id="pdf-chapterM" type='file' class='form-control' accept="application/pdf">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-check mt-5">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultM">
                                                <label class="form-check-label" id="isFree-chapterM" for="flexCheckDefaultM">
                                                    Ofrecer como capítulo gratuito.
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 ">
                                <button type="button" id="addChapterM" class="btn btn-success mt-3">Agregar
                                    capítulo</button>
                            </div>
                            <div class="col-6 d-md-flex justify-content-md-end">
                                <button type="button" id="removeChapterM" class="btn btn-danger mt-3" disabled>Eliminar
                                    último
                                    capítulo</button>
                            </div>

                            <div class="col-3"></div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="input-group mt-5">
                                    <span class="input-group-text col-12" id="basic-addon1"><i class="fas fa-dollar-sign"></i>&nbsp;Precio del curso completo (MXN)</span>
                                    <input type="number" id="moneyCourseM" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" onfocusout="checkMoney(this, '#error-moneyCourseM')" value="30.00">
                                </div>
                                <p id="error-moneyCourseM" class="error-dm">
                                    Introduce un precio válido.
                                </p>
                            </div>
                            <div class="col-3"></div>

                        </div>


                        <div class="col-12" id="totalChaptersM" style="display:none;">1</div>


                    </div>



                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary mx-auto d-flex" data-bs-dismiss="modal">Salir</button>
                    <button id="btn-modifyCourse2" type="button" class="btn btn-primary mx-auto d-flex">Crear
                        curso</button>
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
    <!--Confirmar modificar curso-->
    <div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-blueShape2 text-center">
                    <h5 class="modal-title text-white" id="staticBackdropLabel">Enhorabuena</h5>

                </div>
                <div class="modal-body text-center">
                    ¡El curso se ha procesado con éxito!
                </div>
                <div class="modal-footer text-center">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn btn-primary" id="closeModal" type="button">Entendido</button>
                    </div>
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