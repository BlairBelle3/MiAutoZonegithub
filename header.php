<?php
session_start();

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

<body class="bg-body-secondary">

    <header>
        <div class="bg-body-secondary">
            <div class="container text-end">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown d-flex justify-content-end">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu">

                            <?php if( empty($_SESSION["idUsuario"]) ): ?>
                                <li><a class="dropdown-item" href="login.php"><i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión</a></li>
                                <li><a class="dropdown-item" href="singup.php"><i class="bi bi-person-add me-2"></i>Crear Mi Cuenta</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="perfil.php"><i class="bi bi-person-square me-2"></i>Mi Perfil</a></li>
                                <li><a class="dropdown-item" href="php/usuarios/control_salir.php"><i class="bi bi-box-arrow-left me-2"></i>Salir</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg py-3" style="background: #ffffff;">
            <div class="container-fluid px-5">
                <a class="navbar-brand fw-bold fs-4" href="index.php">
                    <span class="text-primary"><i class="bi bi-car-front-fill"></i> Mi</span><span style="color: #FF7400;">AutoZone</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-uppercase text-center fw-bold">

                        
                        <li class="nav-item">
                            <a class="nav-link links_menu" href="venta.php"><i class="bi bi-cart-fill me-1"></i>Venta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link links_menu" href="productos.php"><i class="bi bi-boxes me-1"></i>Productos</a>
                        </li>
                        <?php if(!empty( $_SESSION["idUsuario"]) ): ?>
                            <?php if($_SESSION["tipoUsuario"] != 4): ?>
                                <li class="nav-item">
                                    <a class="nav-link links_menu" href="categorias.php"><i class="bi bi-box-seam-fill me-1"></i>Categorías</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link links_menu" href="marca.php"><i class="bi bi-box-seam-fill me-1"></i>Marcas</a>
                                </li>
                                <?php if($_SESSION["tipoUsuario"] == 1): ?>
                                    <li class="nav-item">
                                        <a class="nav-link links_menu" href="user.php"><i class="bi bi-people-fill me-1"></i>Usuarios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link links_menu" href="statistics.php"><i class="bi bi-graph-up me-1"></i>Estadisticas</a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>