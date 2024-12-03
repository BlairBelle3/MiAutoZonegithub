<?php

$conexion = new mysqli("localhost", "root", "", "miautozone");
if ($conexion -> connect_errno) {
    die("Error al conectar: ".$conexion->connect_error);
}
