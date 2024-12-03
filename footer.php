<footer class="bg-light text-dark pt-5 pb-4">
    <div class="container text-center text-md-start">
        <div class="row row-text-center text-md-start">

            <!--NOSOTROS-->
            <div class="col-md-3 mx-auto mt-3">
                <a href="index.php" class="mb-4 fw-bold text-secondary h5 enlaces">
                    <span class="text-primary"><i class="bi bi-car-front-fill"></i> Bran</span><span style="color: #FF7400;">AutoZone</span>
                </a>
                <hr class="mb-4">
                <div class="container">
                    <p class="text__nos">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea ex doloribus et iste est earum
                        saepe cupiditate esse magnam explicabo tenetur sequi voluptate, asperiores blanditiis,
                        quibusdam commodi, possimus officia! Fugiat.
                    </p>
                </div>
            </div>

            <!--ENLACES-->
            <div class="col-md-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-secondary">Enlaces</h5>
                <hr class="mb-4">

                <?php if( empty($_SESSION["idUsuario"]) ): ?>
                    <p>
                        <a class="text-secondary text-secondary enlaces" href="">Iniciar Sesión</a>
                    </p>
                    <p>
                        <a class="text-secondary text-secondary enlaces" href="">Crear Cuenta</a>
                    </p>
                <?php else: ?>
                    <p>
                        <a class="text-secondary text-secondary enlaces" href="">Mi Perfil</a>
                    </p>
                    <p>
                        <a class="text-secondary text-secondary enlaces" href="">Salir</a>
                    </p>
                <?php endif; ?>
            </div>

            <!--CURSOS-->
            <div class="col-md-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-secondary">Cursos</h5>
                <hr class="mb-4">
                <p>
                    <a class="text-secondary text-secondary enlaces" href="#">Productos</a>
                </p>
                <p>
                    <a class="text-secondary text-secondary enlaces" href="#">Act. Complementarias</a>
                </p>
                <p>
                    <a class="text-secondary text-secondary enlaces" href="#">Eventos Anuales</a>
                </p>
            </div>

            <!--CONTACTO-->
            <div class="col-md-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-secondary">Contacto</h5>
                <hr class="mb-4">

                <p>
                    <i class="bi bi-house-fill me-2"></i> México, ciudad 255
                </p>
                <p>
                    <i class="bi bi-envelope-at-fill me-2"></i> test@example.com
                </p>
                <p>
                    <i class="bi bi-telephone-fill me-2"></i> +5555555555
                </p>
            </div>

            <hr class="mb-4">

            <!--DERECHOS-->
            <div class="text-center mb-2">
                <p class="fw-bold">
                    Todos los derechos reservados
                </p>
            </div>
            <!-- REDES SOCIALES -->
            <div class="text-center contenedor-redes">
                <ul class="list-unstyled list-inline">
                    <li class="list-inline-item">
                        <a href="#" class="text-dark"><i class="bi bi-whatsapp red"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-dark"><i class="bi bi-facebook red"></i></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-dark"><i class="bi bi-twitter red"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" class="text-dark"><i class="bi bi-youtube red"></i></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>