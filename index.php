<?php include("header.php"); ?>

<main>
    <div class="container py-4">

        <?php if(empty($_SESSION["idUsuario"])): ?>
            <div class="text-center rounded-4 p-3 mb-4" style="background: #0078D1;">
                <h1 class="text-white">Se Bienvenid@</h1>
            </div>
        <?php else: ?>
            <div class="text-center rounded-4 p-3 mb-4" style="background: #FF7400;">
                <h1 class="text-white fw-bolder">Se Bienvenid@, <?= $_SESSION["nombreUsuario"] ?></h1>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-4 p-3 mb-4">
            <div class="text-md-start text-center p-3">
                <h3 class="text-uppercase">Nuestras categorías</h3>
            </div>
            <div class="container-fluid">
                <div class="row row-cols-2 row-cols-md-4 g-4" id="contenedor_tarjeta_categoria">

                </div>
            </div>
        </div>

        <div class="bg-white rounded-4 p-3 mb-4">
            <div class="text-md-start text-center p-3">
                <h3 class="text-uppercase">Marcas</h3>
            </div>
            <div class="container-fluid">
                <div class="row row-cols-2 row-cols-md-4 g-4" id="contenedor_cartas_marcas">

                </div>
            </div>
        </div>
    </div>
</main>

<!-- FOOTER -->
<?php include("footer.php"); ?>

<script src="js/categoria/listarTarjeta.js"></script>
<script src="js/marca/listarTarjeta.js"></script>
</body>

</html>