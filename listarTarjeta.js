
//recuperando el cuerpo donde iran almacenadas las marcas
var cuerpo_marca = document.getElementById('contenedor_cartas_marcas');
var resul_marca = "";

ListarMarca();
function ListarMarca(){
    $.post("php/marca/listarTarjetas.php",
        function (data, textStatux) {
            resul_marca = data;
            cuerpo_marca.innerHTML = resul_marca;
        }
    );
}