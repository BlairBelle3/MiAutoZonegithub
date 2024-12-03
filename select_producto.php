<?php

include("../conexion/db.php");

$sql = "SELECT idProducto, nombreProducto FROM producto";

if ( !empty($_POST["categoria"]) ) {
    $idCategoria = $_POST["categoria"];
    $sql .= " WHERE idCategoria = $idCategoria";
}

$opcion = '<option value="" selected>Selecciona el Producto</option>';

$cat = $conexion -> query($sql);

if ($cat->num_rows > 0) {
    while ( $dato = $cat -> fetch_object() ) {
        $opcion .= '<option class="opProducto" value="'.$dato->idProducto.'">'.$dato->nombreProducto.'</option>';
    }
} else {
    $opcion = '<option value="" selected>No hay productos</option>';
}

echo $opcion;