<?php

session_start();

if (!empty($_SESSION["carrito"])) {
    unset($_SESSION["carrito"]);
    echo "exito";
    exit;
} else {
    echo "vacio";
}
