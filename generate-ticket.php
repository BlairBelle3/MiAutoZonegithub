<?php
session_start();

if (empty($_SESSION["carrito"])) {
    header("Location:../../index.php");
    exit;
}

ob_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genenrar ticket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

    <div class="text-center mb-3">
        <h4>BranAutoZone</h4>
        <h2>Mi ticket de Pago</h2>
    </div>
    <div class="container text-end mb-3">
        <span><strong>Fecha: </strong><?= $hola = date('d-m-Y, g:i a') ?></span>
    </div>

    <div class="container">
        <span><strong>Numero del cliente: </strong><?= $_SESSION["idUsuario"] ?></span><br>
        <span><strong>Nombre del Cliente: </strong><?= $_SESSION["nombreUsuario"] ?> <?= $_SESSION["apellidoUsuario"] ?></span><br>
        <span><strong>Cajero: </strong>Compra en linea</span><br>
    </div>

    <div class="container text-center mb-3 mt-3">
        <span>*******************************************************************************************</span>
    </div>

    <table class="table">
        <thead class="">
            <tr class="text-center">
                <th>Productos</th>
                <th>Precio ($)</th>
                <th>Cantidad</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
            if (!empty($_SESSION["carrito"])) {

                $totalPagar = 0;
                $tabla = "";
                foreach ($_SESSION["carrito"] as $indice => $producto) {
                    $tabla .= '
                        <tr>
                            <td>' . $producto["desProducto"] . '</td>
                            <td class="text-center">$ ' . number_format($producto["precio"], 2) . '</td>
                            <td class="text-center">' . $producto["cantidad"] . '</td>
                            <td class="text-end">$ ' . number_format($producto["precio"] * $producto["cantidad"], 2) . '</td>
                        </tr>';
                    $totalPagar = $totalPagar + ($producto["precio"] * $producto["cantidad"]);
                }

                $tabla .= '
                    <tr>
                        <td colspan="3" align="right"><h3>TOTAL A PAGAR:</h3></td>
                        <td align="right"><h3>$ ' . number_format($totalPagar, 2) . '</h3></td>
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
            ?>
        </tbody>
    </table>

    <div class="container text-center mb-3 mt-3">
        <span>*******************************************************************************************</span>
    </div>

    <div class="container text-center">
        <h4>¡GRACIAS POR TU COMPRA!</h4>
    </div>

</body>

</html>
<?php

$html = ob_get_clean();

require_once("../../plugins/dompdf/autoload.inc.php");

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$opciones = $dompdf->getOptions();
$opciones->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($opciones);

$dompdf->loadHtml($html);
$dompdf->setPaper("letter");
$dompdf->render();

$dompdf->stream("miTicket.pdf", array("Attachment" => true));

unset($_SESSION["carrito"]);

?>