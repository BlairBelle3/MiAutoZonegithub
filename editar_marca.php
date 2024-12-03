<?php

include("../conexion/db.php");

if (!empty($_POST["idMarca"]) && !empty($_POST["nombreMarca"]) && !empty($_POST["disMarca"])) {

    $idMarca = $_POST["idMarca"];
    $nombreMarca = $_POST["nombreMarca"];
    $disMarca = $_POST["disMarca"];

    if (!empty($_FILES["imgMarca"]["tmp_name"])) {
        
        $imagen = $_FILES["imgMarca"]["tmp_name"];
        $nombreImg = $_FILES["imgMarca"]["name"];
        $formato = strtolower(pathinfo($nombreImg, PATHINFO_EXTENSION));

        if ($formato == 'jpg' || $formato == 'jpeg' || $formato == 'png') {
            # code...
        } else {
            echo 'noImg';
        }
        
    } else {
        
        $sentencia="UPDATE marca SET
                    nombreMarca = '$nombreMarca',
                    activoMarca = $disMarca
                    WHERE idMarca = $idMarca";
        $sql = $conexion -> query($sentencia);
        echo 'exito';
    }
} else {
    echo 'vacio';
}
