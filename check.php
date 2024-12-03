<?php
session_start();

if (empty($_SESSION["carrito"])) {
    header("Location: index.php");
}

include("global/global.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BranAutoZone</title>

    <!-- ESTILOS E ICONOS BOOTSTRAP -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap-icons/bootstrap-icons.min.css">

    <!-- ESTILOS DE DATATABLES -->
    <link rel="stylesheet" href="plugins/dataTables/cdn.datatables.net_1.13.6_css_jquery.dataTables.min.css">

    <!-- ESTILOS DE SWEET ALERT 2 -->
    <link rel="stylesheet" href="plugins/SweetAlert2/cdn.jsdelivr.net_npm_sweetalert2@11.7.27_dist_sweetalert2.min.css">

    <!-- ESTILOS DE TOAST -->
    <link rel="stylesheet" href="plugins/VanillaToasts/vanillatoasts.css">

    <!-- SCRIPTS DE BOOTSTRAP, JQUERY, DATATABLES, SWEET ALERT 2 -->
    <script src="plugins/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="plugins/JQuery/code.jquery.com_jquery-3.7.1.min.js"></script>
    <script src="plugins/dataTables/cdn.datatables.net_1.13.6_js_jquery.dataTables.min.js"></script>
    <script src="plugins/SweetAlert2/cdn.jsdelivr.net_npm_sweetalert2@11.7.27_dist_sweetalert2.all.min.js"></script>
    <script src="plugins/VanillaToasts/vanillatoasts.js"></script>

    <!-- MIS ESTILOS PARA ESTA PAGINA -->
    <link rel="stylesheet" href="css/estilos_main.css">
</head>

<body class="bg-body-tertiary">

    <header>
        <nav class="navbar navbar-expand-lg py-3" style="background: #ffffff;">
            <div class="container-fluid px-5">
                <div class="navbar-brand fw-bold fs-4">
                    <span class="text-primary"><i class="bi bi-car-front-fill"></i> Bran</span><span style="color: #FF7400;">AutoZone</span>
                </div>
            </div>
        </nav>
    </header>

    <main>

        <div class="container text-center">
            <div class="jumbotron rounded-5 p-4">
                <h1 class="display-4 text-uppercase">¡Gracias vuelva pronto!</h1>
                <hr class="my-4">
                <p class="lead">Descarga tu ticket para finalizar.</p>
                <a href="Archivos/generate-pdf/generate-ticket.php" class="btn btn-info text-white rounded-5 text-uppercase fw-bold mb-2" id="btnDescargar">Descargar</a><br>
                <button class="btn btn-sm btn-secondary text-white rounded-5 text-uppercase fw-bold" id="btnInicio">Inicio</button>
            </div>
        </div>

        <script src="js/venta/ticket.js"></script>

    </main>


</body>

</html>