<?php

include("../conexion/db.php");

$sentencia="SELECT idUsuario, nombreUsuario, apellidoUsuario, correo, tipo FROM usuario
            INNER JOIN tipousuario
            ON usuario.tipoUsuario = tipousuario.tipoUsuario
            ORDER BY idUsuario";

if (!empty($_POST["tipo"])) {
    $tipo = $_POST["tipo"];
    $sentencia="SELECT idUsuario, nombreUsuario, apellidoUsuario, correo, tipo FROM usuario
                INNER JOIN tipousuario
                ON usuario.tipoUsuario = tipousuario.tipoUsuario
                WHERE usuario.tipoUsuario = $tipo";
}

$sql = $conexion -> query($sentencia);

while ($dato = $sql -> fetch_object()) {
    echo '
        <tr class="text-center">
            <td>'.$dato->idUsuario.'</td>
            <td>'.$dato->nombreUsuario.'</td>
            <td>'.$dato->apellidoUsuario.'</td>
            <td>'.$dato->correo.'</td>
            <td>'.$dato->tipo.'</td>
            <td>
                <button class="btn btn-sm btn-primary rounded-5 text-uppercase fw-bold btnEditar">Editar</button>
            </td>
        </tr>
    ';
}