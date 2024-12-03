<?php

include("../conexion/db.php");

$sql = "SELECT * FROM activo";
$select = $conexion -> query($sql);

while ( $dato = $select -> fetch_object() ) {
    echo '
        <option value="'.$dato->idActivo.'">'.$dato->desActivo.'</option>
    ';
}
