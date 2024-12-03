<?php
session_start();

include("../conexion/db.php");

if (!empty($_SESSION["carrito"])) {
    
    
    foreach ($_SESSION["carrito"] as $indice => $producto) {

        $sql = "CALL venta(
            ".$producto['idProducto'].",
            ".$producto['cantidad'].",
            ".$producto['idCajero'].",
            ".$producto['idCliente']."
        )";

        $venta = $conexion -> query($sql);
    }

    unset($_SESSION["carrito"]);
    echo "exito";
    
} else {
    echo "vacio";
}