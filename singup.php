<?php include("header.php"); ?>

<main>

    <div class="contendor_total">
        <div class="bg-white p-4 rounded-4" style="min-width: 350px;">
            <div class="text-center">
                <a class="navbar-brand fw-bold fs-4" href="index.php">
                    <span class="text-primary"><i class="bi bi-car-front-fill"></i> Mi</span><span style="color: #FF7400;">AutoZone</span>
                </a>
            </div>
            <hr>
            <div class="text-center mb-3">
                <h5>Crear Cuenta</h5>
            </div>
            <form method="post" id="form_registro">
                <div class="input-group mb-3">
                    <span class="input-group-text rounded-start-4"><i class="bi bi-person-fill"></i></span>
                    <input class="form-control rounded-end-4" type="text" placeholder="Nombre" 
                        name="nombreRegistro" id="nombreRegistro">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text rounded-start-4"><i class="bi bi-person-fill"></i></span>
                    <input class="form-control rounded-end-4" type="text" placeholder="Apellido paterno" 
                        name="apellidoRegistro" id="apellidoRegistro">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text rounded-start-4"><i class="bi bi-envelope-fill"></i></span>
                    <input class="form-control rounded-end-4" type="email" placeholder="Correo electrónico" 
                        name="correoRegistro" id="correoRegistro">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text rounded-start-4"><i class="bi bi-lock-fill"></i></span>
                    <input class="form-control rounded-end-4" type="password" placeholder="Contraseña" 
                        name="contraRegistro" id="contraRegistro">
                </div>
                <div class="input-group mb-3">
                    <input class="btn btn-primary form-control rounded-4 text-uppercase fw-bold" 
                        type="submit" value="Crear Cuenta" id="btnRegistrar">
                </div>
            </form>
            <div class="text-center">
                ¿Tienes cuenta? <a href="login.php">Inicia Sesión</a>
            </div>
        </div>
    </div>

</main>

<?php include("footer.php"); ?>

    <script src="js/usuarios/usuarios_singup.js"></script>
</body>

</html>