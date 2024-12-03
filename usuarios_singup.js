
//formulario para registrar un usuario
var form_registro = document.getElementById('form_registro');
var nombreRegistro = document.getElementById('nombreRegistro');
var apellidoRegistro = document.getElementById('apellidoRegistro');
var correoRegistro = document.getElementById('correoRegistro');
var contraRegistro = document.getElementById('contraRegistro');

//registrar un nuevo usuario
$('#btnRegistrar').click(function (e) { 
    e.preventDefault();
    
    $.post("php/usuarios/control_registro.php", {
        nombre: nombreRegistro.value,
        apellido: apellidoRegistro.value,
        correo: correoRegistro.value,
        contra: contraRegistro.value
    },
        function (data, textStatus) {
            if (data == 'vacio') {
                console.log(data);
                alert("Debes llenar todo el formulario");
            } else if (data == 'existe') {
                console.log(data);
                form_registro.reset();
                alert('El correo se encuentra ocupado');
            } else if (data == 'exito') {
                console.log(data);
                form_registro.reset();
                alert('Registro exitoso');
            }
        }
    );

});