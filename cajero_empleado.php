<div class="row">
    <div class="col-sm-4 mb-5">
        <div class="text-center mb-4 text-uppercase">
            <h5>Cajero</h5>
        </div>
        <form method="post" id="form_cajero">

            <div class="row g-2 d-flex align-items-center mb-3">
                <div class="col-4 text-start">
                    <label for="empleado" class="col-form-label ms-3">Empleado:</label>
                </div>
                <div class="col-8">
                    <select disabled class="form-select" name="select_cajero" id="select_cajero">
                        <option value="<?= $_SESSION["idUsuario"] ?>"><?= $_SESSION["nombreUsuario"] ?> <?= $_SESSION["apellidoUsuario"] ?></option>
                    </select>
                </div>
            </div>

            <div class="row g-2 d-flex align-items-center">
                <div class="col-4 text-start">
                    <label for="cliente" class="col-form-label ms-3">Cliente:</label>
                </div>
                <div class="col-8">
                    <select class="form-select" id="select_cliente">
                        <option value="" selected>Selecciona el cliente</option>
                        <?php
                        $sql = "SELECT idUsuario, nombreUsuario, apellidoUsuario FROM usuario WHERE tipoUsuario = 4 ORDER BY nombreUsuario ASC";
                        $usuario = $conexion->query($sql);
                        while ($dato = $usuario->fetch_object()) : ?>
                            <option value="<?= $dato->idUsuario ?>"><?= $dato->nombreUsuario ?> <?= $dato->apellidoUsuario ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <hr>

            <div class="row g-2 d-flex align-items-center mb-3">
                <div class="col-4 text-start">
                    <label for="producto" class="col-form-label ms-3">Categoria:</label>
                </div>
                <div class="col-8">
                    <select class="form-select" id="select_categoria">
                        <option value="" selected><em>Categoria del Producto</em></option>
                        <?php
                        $sql = "SELECT idCategoria, nombreCategoria FROM categoria ORDER BY nombreCategoria";
                        $categoria = $conexion->query($sql);
                        while ($cat = $categoria->fetch_object()) : ?>

                            <option class="opCat" value="<?= $cat->idCategoria ?>"><?= $cat->nombreCategoria ?></option>

                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="row g-2 d-flex align-items-center mb-3">
                <div class="col-4 text-start">
                    <label for="producto" class="col-form-label ms-3">Producto:</label>
                </div>
                <div class="col-8">
                    <select class="form-select" id="select_producto">

                    </select>
                </div>
            </div>

            <div class="row g-2 d-flex align-items-center mb-3">
                <div class="col-8">
                    <input class="form-control" type="hidden" name="descrip_producto" id="descrip_producto">
                </div>
            </div>

            <div class="row g-2 d-flex align-items-center mb-3">
                <div class="col-4 text-start">
                    <label for="precio" class="col-form-label ms-3">Precio:</label>
                </div>
                <div class="col-8">
                    <input class="form-control precio" type="number" placeholder="0.0" name="precio" id="precio" disabled>
                </div>
            </div>

            <div class="row g-2 d-flex align-items-center mb-3">
                <div class="col-4 text-start">
                    <label for="cantidad" class="col-form-label ms-3">Cantidad:</label>
                </div>
                <div class="col-8">
                    <input min="1" class="form-control" type="number" name="cantidad" id="cantidad">
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-sm btn-primary text-uppercase fw-bold" type="submit" name="btnAgregar" id="btnAgregar">Agregar al carrito <i class="bi bi-cart3"></i></button>
            </div>

        </form>
    </div>
    <div class="col-sm-8">
        <div class="text-center mb-4 text-uppercase">
            <h5><i class="bi bi-cart4"></i> Carrito de compras</h5>
        </div>
        <div class="container table-responsive mb-3">
            <table class="table table-sm table-bordered table-hover" id="tablaCarrito">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Precio ($)</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Total ($)</th>
                        <th class="text-center">--</th>
                    </tr>
                </thead>
                <tbody id="cuerpo_carrito_tabla">

                </tbody>
            </table>
        </div>
        <div class="text-center">
            <button class="btn btn-sm btn-success text-uppercase fw-bold" type="button" id="pagarTodo">Realizar pago</button>
            <button class="btn btn-sm btn-danger text-uppercase fw-bold" type="button" id="cancelarTodo">Cancelar pago</button>
        </div>
    </div>
</div>