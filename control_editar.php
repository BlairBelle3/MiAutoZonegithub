<?php

include("../conexion/db.php");

if (!empty($_POST["idCategoria"]) and !empty($_POST["nombreCategoria"]) and !empty($_POST["disCategoria"])) {
    $idCategoria = $_POST["idCategoria"];
    $nombreCategoria = $_POST["nombreCategoria"];
    $activoCategoria = $_POST["disCategoria"];

    if (!empty($_FILES["imgCategoria"]["tmp_name"])) {
        echo 'img';
    } else {
        
        $sentencia = "UPDATE categoria SET nombreCategoria = '$nombreCategoria', activoCategoria = $activoCategoria WHERE idCategoria = $idCategoria";
        $update = $conexion -> query($sentencia);
        echo 'exito';
    }

} else {
    echo 'vacio';
}
