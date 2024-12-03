<?php

session_start();

include("../conexion/db.php");

$sentencia="SELECT idMarca, nombreMarca, imgMarca, desActivo FROM marca
            INNER JOIN activo
            ON marca.activoMarca = activo.idActivo";

if (!empty($_POST["consulta"])) {
    $consulta = $_POST["consulta"];
    $sentencia="CALL listarMarca('$consulta')";
}


$sql = $conexion -> query($sentencia);

if (!empty($_SESSION["tipoUsuario"])) {
    if ( $_SESSION["tipoUsuario"] == 1 ) {
        while ( $dato = $sql -> fetch_object() ) {
            echo '
                <tr class="text-center">
                    <td class="fw-bold">'.$dato->idMarca.'</td>
                    <td>'.$dato->nombreMarca.'</td>
                    <td>
                        <img width="55" src="Archivos/img-marca/'.$dato->imgMarca.'" >
                    </td>
                    <td>'.$dato->desActivo.'</td>
                    <td>
                        <button class="btn btn-sm btn-primary rounded-5 text-uppercase fw-bold btnEditar">Editar</button>
                    </td>
                </tr>
            ';
        }
    } else {
        while ( $dato = $sql -> fetch_object() ) {
            echo '
                <tr class="text-center">
                    <td class="fw-bold">'.$dato->idMarca.'</td>
                    <td>'.$dato->nombreMarca.'</td>
                    <td>
                        <img width="55" src="Archivos/img-marca/'.$dato->imgMarca.'" >
                    </td>
                    <td>'.$dato->desActivo.'</td>
                    <td>
                        <button class="btn btn-sm btn-primary rounded-5 text-uppercase fw-bold btnEditar">Editar</button>
                    </td>
                </tr>
            ';
        }
    }
}

$conexion -> close();