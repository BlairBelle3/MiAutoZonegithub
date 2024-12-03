<?php

include("../conexion/db.php");

if ( !empty($_POST["nombreCategoria"]) and !empty($_POST["disCategoria"]) and !empty($_FILES["imgCategoria"]["tmp_name"]) ) {
    
    $nombreCategoria = $_POST["nombreCategoria"];
    $disponibilidad = $_POST["disCategoria"];

    $imagen = $_FILES["imgCategoria"]["tmp_name"];
    $nombreImg = $_FILES["imgCategoria"]["name"];
    $formato = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));

    if ($formato == 'jpg' || $formato == 'jpeg' || $formato == 'png') {
        
        $sentencia="INSERT INTO categoria (nombreCategoria, imgCategoria, activoCategoria)
                    VALUES ('$nombreCategoria', '', $disponibilidad)";
        $registro = $conexion->query($sentencia);
        $idRegistro = $conexion->insert_id;

        $nombre_en_directorio = $idRegistro.".".$formato;//esto va para la base de datos
        $directorio = "../../Archivos/img-categorias/";
        $ruta = $directorio.$nombre_en_directorio;

        $sentencia="UPDATE categoria SET imgCategoria = '$nombre_en_directorio'
                    WHERE idCategoria = $idRegistro";
        $update = $conexion->query($sentencia);

        if (move_uploaded_file($imagen, $ruta)) {
            echo 'exito';
        } else {
            echo 'error';
        }
        
    } else {
        echo 'no';
    }
} else {
    echo 'vacio';
}
