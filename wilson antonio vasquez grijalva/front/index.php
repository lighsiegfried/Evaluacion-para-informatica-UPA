<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--LIBRERIAS-->
    <link rel="stylesheet" href="librerias_local/bootstrap5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="librerias_local/materialize/iconos/iconos.css">
    <script src="librerias_local/js/jquery-3.4.1.min.js"></script>
    <script src="librerias_local/bootstrap5.3/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" media="all" href="style.css" />
    <script src="prueba_it.js"></script>
    
    <title>PRUEBA PRACTICA</title>
</head>

<body>
    <div class="mt-4"></div>

        <div id="inicio" ></div>
        <div class="mt-4"></div>
        <div id="formulario" ></div>
        <div class="mt-4"></div>
        <div id="reporte" ></div>

    <div class="modal fade" id="modal_dinamico" tabindex="-1" role="dialog" aria-labelledby="modal_titulo" >
        <div id="modal_dimension" class="modal-dialog" role="document" style="max-width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_titulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="box-shadow: none;"></button>
                </div>
                <div class="modal-body">
                    <div id="modal_contenido"></div>
                    <div id="modal_contenido2"></div>
                    <iframe src="" id="pdf_frame2" frameborder="0" style="border:0;" width="100%"  hidden></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Salir</button>
                </div>
            </div>
        </div>
    </div>

</body>