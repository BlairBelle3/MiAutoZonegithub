<?php

include("../conexion/db.php");

$setencia = "SELECT * FROM tipousuario";

$sql = $conexion -> query($setencia);

$cuerpo = '
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                Todos
                <input class="form-check-input btnRadio" type="radio"
                    name="inlineRadioOptions" value="" checked>
            </label>
        </div>
    ';

while( $dato =  $sql -> fetch_object() ){
    $cuerpo .= '
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <em>'.$dato->tipo.'</em>
                <input class="form-check-input btnRadio" type="radio"
                    name="inlineRadioOptions" value="'.$dato->tipoUsuario.'">
            </label>
        </div>
    ';
}

echo $cuerpo;