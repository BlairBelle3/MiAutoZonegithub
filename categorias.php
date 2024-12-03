<?php include("header.php"); ?>

<?php 
if (empty($_SESSION["tipoUsuario"]) or $_SESSION["tipoUsuario"] == 4) {
    echo '
        <script>
            window.location.href = "index.php";
        </script>
    '; 
}
?>

<main>
    <div class="container py-4">

        <div class="text-center rounded-4 p-3 mb-4" style="background: <?= (empty($_SESSION["idUsuario"])) ? '#0078D1' : '#FF7400'; ?>;">
            <h1 class="text-white fw-bolder text-uppercase">Categorías</h1>
        </div>

        <div class="bg-white p-4 rounded-4">
            <div class="text-start mb-4">
                <button class="btn btn-sm btn-primary rounded-5 text-uppercase fw-bold"
                    type="button" id="nuevaCategoria">Nueva Categoría</button>
            </div>

            <!-- BARRA DE BUSQUEDA -->
            <div class="text-start mb-2">
                <div class="row px-3">
                    <div class="col-sm-4">
                        <input class="form-control rounded-5" type="search" placeholder="Busca la Categoria"
                            aria-label="Search" id="busqueda">
                    </div>
                </div>
            </div>

            <div class="container-fluid table-responsive">
                <table class="table">
                    <thead class="bg-light">
                        <tr class="text-center text-uppercase">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Imagen</th>
                            <th>Disponible</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="cuerpo_tabla_categorias">

                    </tbody>
                </table>

                <!-- MODAL -->
                <div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header" id="header_modal">
                                <h1 class="modal-title fs-5" id="tituloModal">Categoría</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="post" enctype="multipart/form-data" id="form_categoria">
                                    <div class="mb-3">
                                        <input class="form-control" type="hidden" name="idCategoria" id="idCategoria">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="nombreCategoria">Nombre de la categoría:</label>
                                        <input class="form-control" type="text" name="nombreCategoria" id="nombreCategoria">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="imgCategoria">Imágen:</label>
                                        <input class="form-control" type="file" name="imgCategoria" id="imgCategoria">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" id="labelDis">Disponibilidad:</label>
                                        <select class="form-select" aria-label="Default select example" name="disCategoria" id="disCategoria">
                                            
                                            
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary text-uppercase fw-bold rounded-5" id="btnCrearCategoria">Crear</button>
                                        <button type="button" class="btn btn-secondary text-uppercase fw-bold rounded-5" data-bs-dismiss="modal" id="btnCrearCategoria">Cerrar</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>

<?php include("footer.php"); ?>

<script src="js/categoria/listarTabla.js"></script>

</body>

</html>