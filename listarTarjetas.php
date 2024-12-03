<?php

include("../conexion/db.php");

$sentencia = "SELECT * FROM marca WHERE activoMarca = 1";
$sql = $conexion->query($sentencia);

while ( $dato = $sql -> fetch_object() ) {
    echo '
        <a href="productos.php?marc='.$dato->idMarca.'" class="col" style="text-decoration: none;">
            <div class="card">
                <img src="Archivos/img-marca/'.$dato->imgMarca.'" class="card-img-top img-card-marca">
                <div class="card-body">
                    <h5 class="card-title">'.$dato->nombreMarca.'</h5>
                </div>
            </div>
        </a>
    ';
}