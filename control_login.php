<?php

session_start();

include("../conexion/db.php");

if ( !empty($_POST["correo"]) and !empty($_POST["contra"]) ) {

    $correo = $_POST["correo"];
    $contra = $_POST["contra"];
    
    $contar = "SELECT COUNT(idUsuario) AS 'total' FROM usuario WHERE correo = '$correo'";
    $selectContar = $conexion -> query($contar);

    if ( $selectContar -> fetch_object() -> total == 0 ) {
        echo 'no';
    } else {
        
        $consulContra = "SELECT * FROM usuario WHERE correo = '$correo'";
        $selecContra = $conexion -> query($consulContra);

        while ( $dato = $selecContra -> fetch_object() ) {
            $contraDB = $dato -> contra;
            if (password_verify($contra, $contraDB)) {
                
                $_SESSION["idUsuario"] = $dato -> idUsuario;
                $_SESSION["nombreUsuario"] = $dato -> nombreUsuario;
                $_SESSION["apellidoUsuario"] = $dato -> apellidoUsuario;
                $_SESSION["correo"] = $dato -> correo;
                $_SESSION["contra"] = $dato -> contra;
                $_SESSION["tipoUsuario"] = $dato -> tipoUsuario;
                echo 'yes';

            } else {
                echo 'no';
            }
        }
    }
} else {
    echo 'vacio';
}
