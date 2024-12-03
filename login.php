<?php include("header.php"); ?>

<?php
if (!empty($_SESSION["idUsuario"])) {
    echo '
        <script>
            window.location.href = "index.php";
        </script>
    ';
    exit;
}
?>

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
                <h5>Iniciar Sesión</h5>
            </div>
            <form method="post" id="form_login">
                <div class="input-group mb-3">
                    <span class="input-group-text rounded-start-4"><i class="bi bi-envelope-fill"></i></span>
                    <input class="form-control rounded-end-4" type="email"
                        placeholder="Correo electrónico" name="correoLogin" id="correoLogin">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text rounded-start-4"><i class="bi bi-lock-fill"></i></span>
                    <input class="form-control rounded-end-4" type="password"
                        placeholder="Contraseña" name="contraLogin" id="contraLogin">
                </div>
                <div class="input-group mb-3">
                    <input class="btn btn-primary form-control rounded-4 text-uppercase fw-bold"
                        type="submit" value="Entrar" name="correoLogin" id="btnIniciarSesion">
                </div>
            </form>
            <div class="text-center">
                ¿No tienes cuenta? <a href="singup.php">Crear Cuenta</a>
            </div>
        </div>
    </div>

</main>

<!-- FOOTER -->
<?php include("footer.php"); ?>

    <script src="js/usuarios/usuarios_login.js"></script>
</body>

</html>