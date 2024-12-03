<?php

include("../conexion/db.php");

if ( !empty($_POST["nombreMarca"]) and !empty($_POST["disMarca"]) and !empty($_FILES["imgMarca"]["tmp_name"]) ) {

    $nombreMarca = $_POST["nombreMarca"];
    $dis = $_POST["disMarca"];

    $imagen = $_FILES["imgMarca"]["tmp_name"];
    $nombre = $_FILES["imgMarca"]["name"];
    $formato = strtolower(pathinfo($nombre, PATHINFO_EXTENSION));

    if ($formato == 'jpg' || $formato == 'jpeg' || $formato == 'png') {
        
        $sentencia="INSERT INTO marca (nombreMarca, imgMarca, activoMarca)
                    VALUES ('$nombreMarca', '', $dis)";
        $registro = $conexion -> query($sentencia);
        $idRegistro = $conexion->insert_id;

        $nombreDirectorio = $idRegistro.".".$formato; //esto va para la base
        $directorio = "../../Archivos/img-marca/";
        $ruta = $directorio.$nombreDirectorio;

        $sentencia = "UPDATE marca SET imgMarca = '$nombreDirectorio' WHERE idMarca = $idRegistro";
        $actu = $conexion -> query($sentencia);

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

$conexion -> close();