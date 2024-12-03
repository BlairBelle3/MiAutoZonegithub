<?php include("header.php"); ?>

<main>

    <div class="container">

        <div class="bg-white p-5 rounded-4 mt-3">
            <div class="text-center">
                <h1 style="font-size: 150px;">
                    <i class="bi bi-person-circle"></i>
                </h1>
                <div class="container">
                    <div class="row">
                        <div class="col text-end fw-bold">
                            <p>Nombre:</p>
                        </div>
                        <div class="col text-start">
                            <p><?= $_SESSION["nombreUsuario"] ?> <?= $_SESSION["apellidoUsuario"] ?></p>
                        </div>
                        <div class="col text-end fw-bold">
                            <p>Correo Electrónico:</p>
                        </div>
                        <div class="col text-start">
                            <p><?= $_SESSION["correo"] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>

<?php include("footer.php"); ?>

</body>

</html>