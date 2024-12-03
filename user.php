<?php include("header.php"); ?>

<main>
    <div class="container py-4">

        <div class="text-center rounded-4 p-3 bg-primary mb-4">
            <h1 class="text-white text-uppercase fw-bolder">
                Usuarios
            </h1>
        </div>

        <div class="bg-white rounded-4 p-4">

            <div class="mb-3">
                <button class="btn btn-primary btn-sm rounded-5 text-uppercase fw-bolder" type="button" id="btnCrearUsuario">
                    <i class="bi bi-plus-circle"></i> Usuario
                </button>
            </div>

            <div id="radios" class="mb-4">

            </div>

            <div class="container table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-uppercase text-center">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo</th>
                            <th>Tipo</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="cuerpo_tabla">

                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserTitulo" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalUserTitulo">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">

                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                    <input class="form-control" type="text" placeholder="Nombre" id="nombre">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                    <input class="form-control" type="text" placeholder="Apellido" id="apellido">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                    <input class="form-control" type="email" placeholder="Correo electrónico" id="correo">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input class="form-control" type="password" placeholder="Contraseña" id="contra">
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" id="tipoUsuario">
                                        
                                    </select>
                                </div>

                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary text-uppercase fw-bold" id="btnEnviar">btnEnviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

<?php include("footer.php"); ?>

<script src="js/usuarios/raidos.js"></script>
<script src="js/usuarios/app.js"></script>
</body>

</html>