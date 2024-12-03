
$("#btnInicio").click(function (e) { 
    e.preventDefault();
    $.post("php/venta/vaciar.php",
        function (data, textStatus, jqXHR) {
            if (data == "yes") {
                window.location.href = "index.php";
            }
        },
        "html"
    );
});