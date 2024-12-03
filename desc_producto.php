<?php

include("../conexion/db.php");

if ( !empty($_POST["idProducto"]) ) {
    
    $id = $_POST["idProducto"];
    $sql = "SELECT nombreProducto FROM producto WHERE idProducto = $id";
    $nombre = $conexion->query($sql);
    if ($dato = $nombre -> fetch_object()) {
        echo $dato -> nombreProducto;
    } else {
        echo "nada";
    }

} else {
    echo "nada";
}