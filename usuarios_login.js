
//formulario del login
var form_login = document.getElementById('form_login');
var correoLogin = document.getElementById('correoLogin');
var contraLogin = document.getElementById('contraLogin');

//funcion para iniciar sesion
$('#btnIniciarSesion').click(function (e) { 
    e.preventDefault();
    $.post("php/usuarios/control_login.php", {
        correo: correoLogin.value,
        contra: contraLogin.value
    },
        function (data, textStatus) {

            console.log(data);
            
            
            if (data == 'vacio') {
                alert("Campos vacios");
                form_login.reset();
            } else if (data == 'no') {
                alert("Correo Electronico/contraseña incorrectos");
                form_login.reset();
            } else if (data == 'yes') {
                form_login.reset();
                window.location.href = 'index.php';
            }
        }
    );
});