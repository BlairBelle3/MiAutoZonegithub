<?php

session_start();

include("../conexion/db.php");

$sentencia = "SELECT idCategoria, nombreCategoria, imgCategoria, desActivo FROM categoria
                INNER JOIN activo 
                ON categoria.activoCategoria = activo.idActivo";

if (!empty($_POST["consulta"])) {
    $consulta = $_POST["consulta"];

    $sentencia = "CALL buscarCategoria('$consulta')";
} 

$sql = $conexion->query($sentencia);

if (!empty($_SESSION["tipoUsuario"]) ) {
    if ($_SESSION["tipoUsuario"] == 1) {
        while ($dato = $sql->fetch_object()) {
            echo '
                    <tr class="text-center">
                        <td class="fw-bolder">' . $dato->idCategoria . '</td>
                        <td>' . $dato->nombreCategoria . '</td>
                        <td>
                            <img width="55" src="Archivos/img-categorias/' . $dato->imgCategoria . '">
                        </td>
                        <td>' . $dato->desActivo . '</td>
                        <td>
                            <button class="btn btn-sm btn-primary text-uppercase fw-bold rounded-5 btnEditar" type="button">Editar</button>
                        </td>
                    </tr>
                ';
        }
    } else {
        while ($dato = $sql->fetch_object()) {
            echo '
                    <tr class="text-center">
                        <td class="fw-bolder">' . $dato->idCategoria . '</td>
                        <td>' . $dato->nombreCategoria . '</td>
                        <td>
                            <img width="55" src="Archivos/img-categorias/' . $dato->imgCategoria . '">
                        </td>
                        <td>' . $dato->desActivo . '</td>
                        <td>
                            <button class="btn btn-sm btn-primary fw-bold rounded-5 btnEditar" type="button">Editar</button>
                        </td>
                    </tr>
                ';
        }
    }
}

$conexion->close();
