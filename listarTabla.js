
ListarDatos();
ListarDisponibilidad();

//recuperando el cuerpo de la tabla
var cuerpo_tabla = document.getElementById('cuerpo_tabla_categorias');
var resultados = "";

//Listar con busqueda
function ListarDatos(consulta) {
    $.ajax({
        type: "POST",
        url: "php/categoria/listarTabla.php",
        data: { consulta: consulta },
        dataType: "html",
        success: function (response) {
            resultados = response;
            cuerpo_tabla.innerHTML = resultados;
        }
    });
}

//detectar si se presiona un boton cuando sea busqueda
$(document).on("keyup", "#busqueda", function (e) {
    e.preventDefault();
    var valor = $(this).val();
    if (valor != "") {
        ListarDatos(valor);
    } else {
        ListarDatos();
    }
});

//cuerpo de la disponibilidad
var cuerpo_disponibilidad = document.getElementById('disCategoria');
var resul_disponibilidad = "";

//listar opciones de disponibilidad
ListarDisponibilidad();
function ListarDisponibilidad() {
    $.post("php/categoria/listarDisponibilidad.php",
        function (data, textStatus) {
            resul_disponibilidad = data;
            cuerpo_disponibilidad.innerHTML = resul_disponibilidad;
        }
    );
}

//recuperando el modal
const miModal = new bootstrap.Modal(document.getElementById('modalCategoria'));
var form_categoria = document.querySelector('#form_categoria');
var id = document.getElementById('idCategoria');
var nombre = document.getElementById('nombreCategoria');
var disponible = document.getElementById('disCategoria');
var opcion = "";

//abrir el modal para una nueva categoria
$("#nuevaCategoria").click(function (e) {
    e.preventDefault();

    $("#header_modal").css("background", "#276CFF");
    $("#tituloModal").css("color", "white");
    $("#tituloModal").text("Crear nueva categoría");
    $("#btnCrearCategoria").text("Crear");
    opcion = "crear"
    miModal.show();
    form_categoria.reset();
});

//abrir el modal para editar una categoria
$(document).on("click", ".btnEditar", function (e) {
    e.preventDefault();
    var fila = e.target.parentNode.parentNode;
    var idEdit = fila.children[0].innerHTML;
    var nombreEdit = fila.children[1].innerHTML;
    var activoEdit = fila.children[3].innerHTML;

    $("#header_modal").css("background", "#276CFF");
    $("#tituloModal").css("color", "white");
    $("#tituloModal").text("Editar categoría");
    $("#btnCrearCategoria").text("Guardar");
    id.value = idEdit;
    nombre.value = nombreEdit;
    if (activoEdit == 'Disponible') {
        disponible.value = 1;
    } else {
        disponible.value = 2;
    }
    opcion = "editar";

    miModal.show();
});

//funcionalidad para crear o editar la categoria
$("#btnCrearCategoria").click(function (e) {
    e.preventDefault();

    if (opcion == "crear") {
        //aqui es para crear una nueva categoria
        fetch("php/categoria/control_registrar.php", {
            method: "POST",
            body: new FormData(form_categoria)
        })
        .then(res => res.text())
        .then(res => {

            if (res == "vacio") {
                Swal.fire({
                    icon: 'warning',
                    title: 'CAMPOS VACIOS',
                    text: 'Llenar todo el formulario!'
                })
            } else 
            if (res == 'no') {
                Swal.fire({
                    icon: 'error',
                    title: 'NO ES UNA IMAGEN',
                    text: 'SOLO ACEPTAMOS IMAGENES JPG, JPEG, PNG'
                })
                form_categoria.reset();
            } else
            if (res == 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'ERROR AL SUBIR'
                })
                form_categoria.reset();
            } else 
            if (res == 'exito') {
                Swal.fire({
                    icon: 'success',
                    title: 'REGISTRO EXITOSO',
                    text: 'CATEGORIA REGISTRADA'
                })
                ListarDatos();
                form_categoria.reset();
                miModal.hide();
            } 

        })

    } else if (opcion == "editar") {
        //aqui es para editar una nueva categoria
        fetch("php/categoria/control_editar.php", {
            method: "POST",
            body: new FormData(form_categoria)
        })
            .then(res => res.text())
            .then(res => {
                if (res == 'vacio') {
                    miModal.hide();
                    VanillaToasts.create({
                        type: 'warning',
                        icon: 'plugins/VanillaToasts/icons/icon_warning.png',
                        title: 'CAMPOS VACIOS',
                        text: 'Llene todo el formulario',
                        timeout: 3000
                    });
                } else if (res == 'exito') {

                    var valor2 = $("#busqueda").val();
                    if (valor2 != "") {
                        ListarDatos(valor2);
                    } else {
                        ListarDatos();
                    }

                    miModal.hide();
                    VanillaToasts.create({
                        type: 'success',
                        icon: 'plugins/VanillaToasts/icons/icon_success.png',
                        title: 'ACTUALIZADO',
                        text: 'Registro actualizado con exito',
                        timeout: 3000
                    });
                }
            })

    }
});