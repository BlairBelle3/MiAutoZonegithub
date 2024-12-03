<?php

session_start();

if ( !empty($_POST["idCajero"]) and !empty($_POST["idCliente"]) and !empty($_POST["idProducto"]) and !empty($_POST["desProducto"]) and !empty($_POST["precio"]) and !empty($_POST["cantidad"]) ) {
    $idCajero = $_POST["idCajero"];
    $idCliente = $_POST["idCliente"];
    $idProducto = $_POST["idProducto"];
    $desProducto = $_POST["desProducto"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    
    if (empty($_SESSION["carrito"])) {
        $producto = array(
            "idCajero" => $idCajero,
            "idCliente" => $idCliente,
            "idProducto" => $idProducto,
            "desProducto" => $desProducto,
            "precio" => $precio,
            "cantidad" => $cantidad,
        );
        $_SESSION["carrito"][0] = $producto;
    } else {
        $numProductos = count($_SESSION["carrito"]);
        $producto = array(
            "idCajero" => $idCajero,
            "idCliente" => $idCliente,
            "idProducto" => $idProducto,
            "desProducto" => $desProducto,
            "precio" => $precio,
            "cantidad" => $cantidad,
        );
        $_SESSION["carrito"][$numProductos] = $producto;
    }
    echo "exito";
}


