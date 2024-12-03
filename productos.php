<?php include("header.php");

include("php/conexion/db.php");

$idUsuario = (!empty($_SESSION["idUsuario"])) ? $_SESSION["idUsuario"] : "";
$cat = (!empty($_GET["cat"])) ? $_GET["cat"] : "";
$marc = (!empty($_GET["marc"])) ? $_GET["marc"] : "";
?>

<style>
    .card {
        overflow: hidden;
        background: white;
        box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.2);
        cursor: default;
        transition: all 400ms ease;
    }

    .card:hover {
        box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.4);
        transform: translateY(-3%);
    }
</style>

<main>
    <div class="container py-4">

        <div class="text-center rounded-4 p-3 mb-4" style="background: #FF7400;">
            <h1 class="text-white fw-bolder">Nuestros Productos</h1>
        </div>

        <div class="bg-white rounded-4 p-3 mb-4">

            <div class="container-fluid mb-5">

                <div class="row row-cols-1 row-cols-md-4 g-4" id="contenedor_tarjeta_categoria">

                    <?php
                    $sql = "SELECT idProducto, nombreProducto, precio FROM producto";
                    if ($cat != "") {
                        $sql = "SELECT idProducto, nombreProducto, precio FROM producto WHERE idCategoria = $cat";
                    }
                    if ($marc != "") {
                        $sql = "SELECT idProducto, nombreProducto, precio FROM producto WHERE idMarcaProducto = $marc";
                    }
                    $productos = $conexion->query($sql);
                    while ($dato = $productos->fetch_object()) :
                    ?>
                        <div class="col">
                            <div class="card">
                                <img src="Archivos/img-productos/<?= $dato->idProducto . '.jpg' ?>" class="card-img-top">
                                <div class="card-body p-4">
                                    <h4 class="card-title"><?= $dato->nombreProducto ?></h4>
                                    <p>$<?= number_format($dato->precio, 2) ?></p>
                                    <form method="post" class="form_agregar_carrito">

                                        <input value="<?= openssl_encrypt($dato->idProducto, COD, KEY) ?>" type="hidden" name="idProducto" id="idProducto">
                                        <input value="<?= openssl_encrypt($dato->nombreProducto, COD, KEY) ?>" type="hidden" name="desProducto" id="desProducto">
                                        <input value="<?= openssl_encrypt($dato->precio, COD, KEY) ?>" type="hidden" name="precio" id="precio">
                                        <input value="<?= openssl_encrypt(1, COD, KEY) ?>" type="hidden" name="cantidad" id="cantidad">
                                        <input value="<?= openssl_encrypt(13, COD, KEY) ?>" type="hidden" name="idCajero" id="idCajero">
                                        <input value="<?= openssl_encrypt($idUsuario, COD, KEY) ?>" type="hidden" name="idCliente" id="idCliente">

                                        <button type="submit" name="btnAgregar" value="AGREGAR" class="form-control btn btn-outline-primary fw-bold">Agregar al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    $productos->free_result();
                    $conexion->close(); ?>

                </div>
            </div>

        </div>

    </div>
</main>

<!-- FOOTER -->
<?php include("footer.php"); ?>

<script src="js/productos/app.js"></script>

</body>

</html>