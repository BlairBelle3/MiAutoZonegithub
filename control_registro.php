<?php

include("../conexion/db.php");

if ( !empty($_POST["nombre"]) and !empty($_POST["apellido"]) and !empty($_POST["correo"]) and !empty($_POST["contra"]) ) {
    
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $contra = password_hash($_POST["contra"], PASSWORD_DEFAULT);
    $tipo = 4;

    $contar = "SELECT COUNT(*) AS 'total' FROM usuario WHERE correo = '$correo'";
    $select = $conexion -> query($contar);

    if ($select -> fetch_object() -> total == 0) {
        
        $sentencia="INSERT INTO usuario(nombreUsuario, apellidoUsuario, correo, contra, tipoUsuario)
                    VALUES ('$nombre', '$apellido', '$correo', '$contra', $tipo)";
        $insert = $conexion -> query($sentencia);
        echo 'exito';
    } else {
        echo 'existe';
    }
} else {
    echo 'vacio';
}
