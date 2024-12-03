<?php include("header.php"); ?>

<?php
if (empty($_SESSION["idUsuario"])) {
    echo '
        <script>
            window.location.href="login.php"
        </script>
    ';
    exit;
}
include("php/conexion/db.php");
?>

<main>

    <div class="container py-4">

        <div class="bg-white rounded-4 p-4 mb-4">

            <?php
            if ($_SESSION["tipoUsuario"] < 4) {
                include("cajero_empleado.php");
            } else {
                include("cajero_cliente.php");
            }
            ?>

        </div>

    </div>

</main>

<?php include("footer.php"); ?>

<script src="js/venta/app.js"></script>

<script type="text/javascript">
    var cuerpo_carrito_tabla = document.querySelector("#cuerpo_carrito_tabla");
    var cuerpo_carrito_tabla_cliente = document.querySelector("#cuerpo_carrito_tabla_cliente");

    // ********* AQUI VA LO QUE ES PARA EL EMPLEADO *********
    LlenarTablaCarrito();

    function LlenarTablaCarrito() {
        $.post("php/venta/listar_tabla.php",
            function(data, textStatus, jqXHR) {
                cuerpo_carrito_tabla.innerHTML = data;
            },
            "html"
        );
    }

    // ********* AQUI VA LO QUE ES PARA EL CLIENTE *********
    ListarCarritoCliente();

    function ListarCarritoCliente() {
        $.post("php/venta/listar_tabla_cliente.php",
            function(data, textStatus, jqXHR) {
                cuerpo_carrito_tabla_cliente.innerHTML = data
            },
            "html"
        );
    }

    var form_cajero = document.querySelector("#form_cajero");
    var select_cajero = document.getElementById("select_cajero");
    var select_cliente = document.getElementById("select_cliente");
    var select_categoria = document.getElementById("select_categoria");
    var select_producto = document.querySelector("#select_producto");
    var desc_producto = document.getElementById("descrip_producto");
    var precio = document.getElementById("precio");
    var cantidad = document.getElementById("cantidad");

    // seleccionar una categoria para filtrar
    ListarProducto();

    function ListarProducto(categoria) {
        $.ajax({
            type: "POST",
            url: "php/venta/select_producto.php",
            data: {
                categoria: categoria
            },
            dataType: "html",
            success: function(response) {
                select_producto.innerHTML = response
            }
        });
    }

    $(document).on("change", "#select_categoria", function(e) {
        e.preventDefault();
        var cat = $(this).val();
        if (cat != "") {
            ListarProducto(cat);
        } else {
            ListarProducto();
        }
    });

    // Información del producto
    $(select_producto).change(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "php/venta/precio_producto.php",
            data: {
                idProducto: select_producto.value
            },
            dataType: "html",
            success: function(response) {
                precio.value = response;
            }
        });
    });
    $(select_producto).change(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "php/venta/desc_producto.php",
            data: {
                idProducto: select_producto.value
            },
            dataType: "html",
            success: function(response) {
                desc_producto.value = response;
            }
        });
    });

    // AGREGAR PRODUCTO AL CARRITO ES EL FORMULARIO
    $("#form_cajero").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "php/venta/agregar_carrito.php",
            data: {
                idCajero: select_cajero.value,
                idCliente: select_cliente.value,
                idProducto: select_producto.value,
                desProducto: desc_producto.value,
                precio: precio.value,
                cantidad: cantidad.value
            },
            dataType: "html",
            success: function(response) {
                if (response == "exito") {
                    VanillaToasts.create({
                        type: 'success',
                        icon: 'plugins/VanillaToasts/icons/icon_success.png',
                        title: 'AGREGADO AL CARRITO',
                        text: 'Producto agregado al carrito',
                        timeout: 3000,
                        positionClass: 'bottomRight'
                    });
                }
                LlenarTablaCarrito();
                select_categoria.value = "";
                select_producto.value = "";
                precio.value = "";
                cantidad.value = "";
            }
        });
    });

    //realizar el pago
    $("#pagarTodo").click(function(e) {
        e.preventDefault();
        $.post("php/venta/realizar_pago.php",
            function(data, textStatus, jqXHR) {
                if (data == "vacio") {
                    VanillaToasts.create({
                        type: 'error',
                        icon: 'plugins/VanillaToasts/icons/icon_error.png',
                        title: 'CARRITO VACIO',
                        text: 'El carrito esta vacio...',
                        timeout: 3000,
                        positionClass: 'bottomRight'
                    });
                }
                if (data == "exito") {
                    VanillaToasts.create({
                        type: 'success',
                        icon: 'plugins/VanillaToasts/icons/icon_success.png',
                        title: 'COMPRA EXITOSA',
                        text: 'Compra realizada...',
                        timeout: 3000,
                        positionClass: 'bottomRight'
                    });
                    LlenarTablaCarrito();
                    form_cajero.reset();
                }
            },
            "text"
        );
    });

    // cancelar toda la compra
    $("#cancelarTodo").click(function(e) {

        e.preventDefault();
        Swal.fire({
            title: "¿CANCELAR?",
            text: "¿Quieres cancelar la compra?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "SÍ",
            cancelButtonText: "NO",
        }).then((result) => {
            if (result.isConfirmed) {

                $.post("php/venta/cancelar_pago.php",
                    function(data, textStatus, jqXHR) {
                        if (data == "exito") {
                            VanillaToasts.create({
                                type: 'success',
                                icon: 'plugins/VanillaToasts/icons/icon_success.png',
                                title: 'COMPRA CANCELADA',
                                text: 'Pago cancelado con exito...',
                                timeout: 2500,
                                positionClass: 'bottomRight'
                            });
                            ListarCarritoCliente();
                            LlenarTablaCarrito();
                            form_cajero.reset();

                        } else if (data == "vacio") {
                            VanillaToasts.create({
                                type: 'error',
                                icon: 'plugins/VanillaToasts/icons/icon_error.png',
                                title: 'CARRITO VACIO',
                                text: 'El carrito esta vacio...',
                                timeout: 2500,
                                positionClass: 'bottomRight'
                            });
                        }
                    },
                    "html"
                );

            }
        });

    });

    //********* para un ciente */
    $("#pagarTodo_cliente").click(function(e) {
        e.preventDefault();
        $.post("php/venta/realizar_pago_cliente.php",
            function(data, textStatus, jqXHR) {
                if (data == "vacio") {
                    VanillaToasts.create({
                        type: 'error',
                        icon: 'plugins/VanillaToasts/icons/icon_error.png',
                        title: 'CARRITO VACIO',
                        text: 'El carrito esta vacio...',
                        timeout: 3000,
                        positionClass: 'bottomRight'
                    });
                }
                if (data == "exito") {
                    VanillaToasts.create({
                        type: 'success',
                        icon: 'plugins/VanillaToasts/icons/icon_success.png',
                        title: 'COMPRA EXITOSA',
                        text: 'Compra realizada...',
                        timeout: 3000,
                        positionClass: 'bottomRight'
                    });
                    
                    window.location.href = "check.php";
                }
            },
            "text"
        );
    });

    

</script>


</body>

</html>