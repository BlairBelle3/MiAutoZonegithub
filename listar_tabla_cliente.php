<?php

session_start();

if (!empty($_SESSION["carrito"])) {

    $totalPagar = 0;
    $tabla = "";
    foreach ($_SESSION["carrito"] as $indice => $producto) {
        $tabla .= '
        <tr>
            <td>' . $producto["desProducto"] . '</td>
            <td class="text-center">' . number_format($producto["precio"], 2) . '</td>
            <td class="text-center">' . $producto["cantidad"] . '</td>
            <td class="text-center">' . number_format($producto["precio"] * $producto["cantidad"], 2) . '</td>
            <td class="text-center">
                <button class="btn btn-sm btn-danger text-uppercase btnQuitar" type="button">Quitar</button>
            </td>
        </tr>';
        $totalPagar = $totalPagar + ($producto["precio"] * $producto["cantidad"]);
    }

    $tabla .= '
    <tr>
        <td colspan="3" align="right"><h3>TOTAL A PAGAR: $</h3></td>
        <td align="right"><h3>' . number_format($totalPagar, 2) . '</h3></td>
        <td></td>
    </tr>
    ';

} else {
    $tabla = '
    <tr class="text-center">
        <td colspan="5">Productos (0) El carrito esta vacio...</td>
    </tr>
    ';
}

echo $tabla;
