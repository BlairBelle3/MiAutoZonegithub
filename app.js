
buscarMarca();
listarDisponibilidad();

//recuperando el modal de marca y formulario
const miModal = new bootstrap.Modal(document.getElementById('modalCategoria'));
var fom_marca = document.getElementById('form_Marca');
var opcion = "";

//recuperando el cuerpo de la tabla
var cuerpo_marca = document.querySelector('#cuerpo_tabla_marca');
var resul_marca = "";

//funcion para buscar una marca
function buscarMarca(consulta) {
    $.ajax({
        type: "POST",
        url: "php/marca/listar_marcas.php",
        data: {consulta:consulta},
        dataType: "html",
        success: function (response) {
            resul_marca = response;
            cuerpo_marca.innerHTML = resul_marca;
        }
    });
}
//detectar cuando presiono una boton
$(document).on('keyup', '#busqueda', function (e) {
    e.preventDefault();
    var valor = $(this).val();
    if (valor != "") {
        buscarMarca(valor);
    } else {
        buscarMarca();
    }
});

//cuerpo de la disponibilidad
var cuerpo_dispo = document.querySelector('#disMarca');
var res_dispo = "";

//listar disponibilidad
function listarDisponibilidad() {
    $.post("php/marca/listarDisponibilidad.php",
        function (data, textStatus) {
            res_dispo = data;
            cuerpo_dispo.innerHTML = res_dispo;
        }
    );
}

//abrir modal para crear una nueva marca
$('#nuevaMarca').click(function (e) { 
    e.preventDefault();

    $('#tituloModal').css('color', 'white');
    $('#tituloModal').text('Registrar nueva marca');
    $('#btnCrearMarca').text('Crear');
    fom_marca.reset();

    opcion = "crear"
    miModal.show();
});

//abrir el modal para editar una marca
$(document).on('click', '.btnEditar', function (e) {
    var fila = e.target.parentNode.parentNode;
    var idEdit = fila.children[0].innerHTML;
    var nomEdit = fila.children[1].innerHTML;
    var disEdit = fila.children[3].innerHTML;

    var disponible = 0;
    if (disEdit == 'Disponible') {
        disponible = 1;
    } else
    if (disEdit == 'No Disponible') {
        disponible = 2;
    }

    $('#tituloModal').css('color', 'white');
    $('#tituloModal').text('Editar ' + nomEdit);
    $('#btnCrearMarca').text('Guardar');

    //dar los datos
    $('#idMarca').val(idEdit);
    $('#nombreMarca').val(nomEdit);
    $('#disMarca').val(disponible);

    opcion = "editar"
    miModal.show();

});

//abrir modal para crear una nueva marca
$('#nuevaMarca').click(function (e) { 
    e.preventDefault();

    $('#tituloModal').css('color', 'white');
    $('#tituloModal').text('Registrar nueva marca');
    $('#btnCrearMarca').text('Guardar');
    fom_marca.reset();

    opcion = "crear"
    miModal.show();
});

//crear o editar marca
$('#btnCrearMarca').click(function (e) { 
    e.preventDefault();
    if (opcion == "crear") {
        fetch("php/marca/registrar_marca.php", {
            method: 'POST',
            body: new FormData(fom_marca)
        })
        .then(res => res.text())
        .then(res => {
            if (res == "vacio") {
                Swal.fire({
                    icon: 'warning',
                    title: 'CAMPOS VACIOS',
                    text: 'LLENA TODO EL FORMULARIO'
                })
            } else 
            if (res == "no") {
                Swal.fire({
                    icon: 'error',
                    title: 'ARCHIVO INCORRECTO',
                    text: 'SOLO SE ACEPTA IMAGENES JPG, JPEG, PNG'
                })
                fom_marca.reset();
            }else 
            if (res == "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error'
                })
                fom_marca.reset();
            }else 
            if (res == "exito") {
                fom_marca.reset();
                buscarMarca();
                miModal.hide();
                VanillaToasts.create({
                    type: 'success',
                    icon: 'plugins/VanillaToasts/icons/icon_success.png',
                    title: 'REGISTRO EXITOSO',
                    text: 'Registro guardado sin problemas',
                    timeout: 3500
                });
            }
        })
    } else if (opcion == "editar") {
        
        fetch("php/marca/editar_marca.php", {
            method: 'POST',
            body: new FormData(fom_marca)
        })
        .then(res => res.text())
        .then(res => {
            if (res == 'vacio') {
                miModal.hide();
                VanillaToasts.create({
                    type: 'warning',
                    icon: 'plugins/VanillaToasts/icons/icon_warning.png',
                    title: 'CAMPOS VACIOS',
                    text: 'Llena todo el formulario',
                    timeout: 4000
                });
            } else if (res=='noImg') {

                Swal.fire({
                    icon: 'error',
                    title: 'NO SUBISTE UNA IMAGEN',
                    text: 'Solo aceptamos: jpg, jpeg, png'
                })
                miModal.hide();
                fom_marca.reset();
                
            } else if (res=='exito') {
                miModal.hide();
                VanillaToasts.create({
                    type: 'success',
                    icon: 'plugins/VanillaToasts/icons/icon_success.png',
                    title: 'ACTUALIZADO',
                    text: 'Registro actualizado con exito',
                    timeout: 4000
                });
                buscarMarca();
            }
        })

    }
});