<?php include("header.php"); ?>

<main>
    <div class="container py-4">

        <div class="text-center rounded-4 p-3 mb-4" style="background: <?= (empty($_SESSION["idUsuario"])) ? '#0078D1' : '#FF7400'; ?>;">
            <h1 class="text-white fw-bolder text-uppercase">Marcas</h1>
        </div>

        <div class="bg-white p-4 rounded-4">
            <div class="text-start mb-4">
                <button class="btn btn-sm btn-primary rounded-5 text-uppercase fw-bold"
                    type="button" id="nuevaMarca">Nueva Marca</button>
            </div>

            <!-- BARRA DE BUSQUEDA -->
            <div class="text-start mb-2">
                <div class="row px-3">
                    <div class="col-sm-4">
                        <input class="form-control rounded-5" type="search" placeholder="Busca la Marca"
                            aria-label="Search" id="busqueda">
                    </div>
                </div>
            </div>
            
            <div class="container-fluid table-responsive">

                <table class="table">
                    <thead class="bg-light">
                        <tr class="text-center text-uppercase">
                            <th>#</th>
                            <th>Marca</th>
                            <th>Imagen</th>
                            <th>Status</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="cuerpo_tabla_marca">
                        
                    </tbody>
                </table>

                <!-- MODAL -->
                <div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="tituloModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-primary" id="header_modal">
                                <h1 class="modal-title fs-5" id="tituloModal">Marca</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form method="post" enctype="multipart/form-data" id="form_Marca">
                                    <div class="mb-3">
                                        <input class="form-control" type="hidden" name="idMarca" id="idMarca">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="nombreCategoria">Marca:</label>
                                        <input class="form-control" type="text" name="nombreMarca" id="nombreMarca">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" for="imgCategoria">Imágen:</label>
                                        <input class="form-control" type="file" name="imgMarca" id="imgMarca">
                                        <span class="text-secondary">Formato: jpg, jpeg, png</span>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" id="labelDis">Disponibilidad:</label>
                                        <select class="form-select" aria-label="Default select example" name="disMarca" id="disMarca">
                                            
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary text-uppercase fw-bold rounded-5" id="btnCrearMarca">Crear</button>
                                        <button type="button" class="btn btn-secondary text-uppercase fw-bold rounded-5" data-bs-dismiss="modal">Cerrar</button>
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

<script src="js/marca/app.js"></script>

</body>

</html>