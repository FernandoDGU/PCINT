<?php
include_once '../controller/diplomaControlador.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/cf205b582d.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <title>Certificado</title>
    <style>
        /* Container holding the image and the text */
        .contenedor {
            position: relative;
            text-align: center;
            color: black;
        }

        /* Centered text */
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
        }

        .fs-70 {
            font-size: 70px;
        }

        .fs-50 {
            font-size: 50px;
        }

        .fs-25 {
            font-size: 30px;
        }
    </style>
</head>



<body>

    <div class="container text-center">
        <a id="btn-descargar" class="btn btn-primary m-5">Descargar como PDF</a>

    </div>
    <div class="contenedor" id="descargar">
        <img src="Certificatedesign.png" style="width:100%;">

        <div class="centered">
            <h1 class="fs-50">Este certificado es otorgado a:</h1>
            <h1 class="fs-70 mb-5"><strong style="text-decoration: underline;"><?php echo $userActual->getNombre(); ?></strong></h1>
            <h2>Por participar y finalizar exitosamente el curso de:</h2>
            <h1 class="fs-50 mb-5"> <strong style="text-decoration: underline;"><?php echo $datosDiploma["titulo"]; ?></strong></h1>
            <h2>A fecha de: <strong class="fs-25" style="text-decoration: underline;"> <?php echo $datosDiploma["fechaTerminado"]; ?></strong> habiendo sido impartido por <strong class="fs-25" style="text-decoration: underline;"><?php echo $datosDiploma["nombre"]; ?></strong></h2>
        </div>
    </div>


    <script>
        $("#btn-descargar").click(function() {
            var HTML_Width = $("#descargar").width();
            var HTML_Height = $("#descargar").height();
            var top_left_margin = 15;
            var PDF_Width = HTML_Width + (top_left_margin * 2);
            var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
            var canvas_image_width = HTML_Width;
            var canvas_image_height = HTML_Height;

            var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;


            html2canvas($("#descargar")[0], {
                allowTaint: true
            }).then(function(canvas) {
                canvas.getContext('2d');

                console.log(canvas.height + "  " + canvas.width);


                var imgData = canvas.toDataURL("image/jpeg", 1.0);
                var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);


                for (var i = 1; i <= totalPDFPages; i++) {
                    pdf.addPage(PDF_Width, PDF_Height);
                    pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height * i) + (top_left_margin * 4), canvas_image_width, canvas_image_height);
                }

                pdf.save("Certificado.pdf");
            });
        })
    </script>
</body>

</html>