<?php include("header.php");
include("php/conexion/db.php");
?>

<div class="container p-4">

    <div class="row mb-3">
        <div class="col-sm-4 mb-3">

            <div class="text-bg-primary rounded-3 p-3">
                <div class="text-center text-white">
                    <h5 class="text-uppercase fw-bolder">Empleados</h5>
                </div>
                <hr class="text-white">
                <div class="text-center text-white">
                    <h1>
                        <i class="bi bi-person-square"></i>
                    </h1>
                    <?php
                    $sql = "SELECT COUNT(idUsuario) AS 'total_empleado' FROM usuario WHERE tipoUsuario <> 4";
                    $contar_empleado = $conexion->query($sql);
                    ?>
                    <h3>
                        <?= $dato = ($contar_empleado->num_rows > 0) ? $contar_empleado->fetch_object()->total_empleado : 0; ?>
                    </h3>
                </div>
            </div>

        </div>

        <div class="col-sm-4 mb-3">

            <div class="text-bg-danger rounded-3 p-3">
                <div class="text-center text-white">
                    <h5 class="text-uppercase fw-bolder">Cliente</h5>
                </div>
                <hr>
                <div class="text-center text-white">
                    <h1>
                        <i class="bi bi-person-circle"></i>
                    </h1>
                    <?php
                    $sql = "SELECT COUNT(idUsuario) AS 'total_cliente' FROM usuario WHERE tipoUsuario = 4";
                    $contar_cliente = $conexion->query($sql);
                    ?>
                    <h3>
                        <?= $dato = ($contar_cliente->num_rows > 0) ? $contar_cliente->fetch_object()->total_cliente : 0; ?>
                    </h3>
                </div>
            </div>

        </div>

        <div class="col-sm-4">

            <div class="text-bg-success rounded-3 p-3">
                <div class="text-center text-white">
                    <h5 class="text-uppercase fw-bolder">Ventas</h5>
                </div>
                <hr>
                <div class="text-center text-white">
                    <h1>
                        <i class="bi bi-bag-check-fill"></i>
                    </h1>
                    <?php
                    $sql = "SELECT COUNT(idDetalle) AS 'total_venta' FROM detalleventa";
                    $total_venta = $conexion->query($sql);
                    ?>
                    <h3>
                        <?= $dato = ($total_venta->num_rows > 0) ? $total_venta->fetch_object()->total_venta : 0; ?>
                    </h3>
                </div>
            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-sm-6 mb-3">
            <div class="bg-white rounded-3 p-3">
                <div class="text-center">
                    <h5 class="text-uppercase fw-bolder">Producto más vendido</h5>
                </div>
                <hr>
                <div class="table-responsive">
                    <div id="piechart" style="width: 500px; height: 600px;"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="bg-white rounded-3 p-3">
                <div class="text-center">
                    <h5 class="text-uppercase fw-bolder">Producto con más ganancias</h5>
                </div>
                <hr>
                <div class="table-responsive">
                    <div id="donutchart" style="width: 500px; height: 500px;"></div>
                </div>
            </div>
        </div>

    </div>

</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['´Productos', 'Cantidad'],
            <?php
            $sql = "SELECT producto.nombreProducto, SUM(venta.cantidad) as totalCantidad
                    FROM producto
                    INNER JOIN venta ON producto.idProducto = venta.idProducto
                    GROUP BY producto.nombreProducto
                    order by totalCantidad desc
                    limit 5";
            $cant = $conexion->query($sql);
            while ($a = $cant->fetch_object()) {
                echo "['" . $a->nombreProducto . "', " . $a->totalCantidad . "],";
            }
            ?>
        ]);

        var options = {
            pieSliceText: 'label',
            title: 'Los 5 Productos más vendidos'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            <?php

            $sentencia = "SELECT producto.nombreProducto, sum(venta.cantidad * producto.precio) as totalGanancias
                from producto inner join venta on producto.idProducto = venta.idProducto
                group by producto.nombreProducto order by totalGanancias desc limit 5";

            $sql = $conexion->query($sentencia);
            while ($dato = $sql->fetch_object()) {
                echo "['" . $dato->nombreProducto . "', " . $dato->totalGanancias . "],";
            }
            ?>
        ]);

        var options = {
            title: 'Los 5 Productos con mas Ganancias',
            pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
    }
</script>

</body>

</html>