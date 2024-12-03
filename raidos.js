ListarTipoUsuario();
ListarUsuario();

var cuerpo_radios = document.querySelector("#radios");
var cuerpo_tabla = document.querySelector("#cuerpo_tabla");

//listar los check radios
function ListarTipoUsuario () {
    $.ajax({
        type: "POST",
        url: "php/usuarios/tipoUsuario.php",
        dataType: "html",
        success: function (response) {
            cuerpo_radios.innerHTML = response;
        }
    });
}

function ListarUsuario (tipo) {
    $.ajax({
        type: "POST",
        url: "php/usuarios/listar_user.php",
        data: {tipo:tipo},
        dataType: "html",
        success: function (response) {
            cuerpo_tabla.innerHTML = response;
        }
    });
}

$(document).on('change', '.btnRadio', function (e) {
    e.preventDefault();
    var dato = $(this).val();
    if (dato != "") {
        ListarUsuario(dato);
    } else {
        ListarUsuario();
    }
});