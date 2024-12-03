
//recuperando el cuerpo de la tabla
var cuerpo_tarjeta_categoria = document.querySelector('#contenedor_tarjeta_categoria');
var resultado_tarjetas_categorias = "";

//listar tarjetas de las categorias en el inicio
ListarTarjetasCategoria();
function ListarTarjetasCategoria () {
    $.post("php/categoria/listarTarjetas.php",
        function (data, textStatus) {
            resultado_tarjetas_categorias = data;
            cuerpo_tarjeta_categoria.innerHTML = resultado_tarjetas_categorias;
        }
    );
}