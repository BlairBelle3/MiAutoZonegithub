<?php

include("../conexion/db.php");

if ( !empty($_POST["idProducto"]) ) {
    
    $id = $_POST["idProducto"];
    $sql = "SELECT precio FROM producto WHERE idProducto = $id";
    $precio = $conexion->query($sql);
    if ($dato = $precio -> fetch_object()) {
        echo $dato->precio;
    } else {
        echo 0.0;
    }

} else {
    echo 0.0;
}
