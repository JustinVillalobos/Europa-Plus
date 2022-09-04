$(document).ready(function () {
    $("#spinDiv").css("display", "none");
});
function stringLength(value, max) {
    if (value.length <= max) {
        return true;
    } else {
        return false;
    }
}
function save() {
    let cantidadErrores = 0;
    let nombre = $("#nombre").val();
    let valid = false;
    /**********************************  Datos Personales ******************************************/
    if (!stringLength(nombre, 50)) {
        $("#nombre + span").text("**Demasiados caracteres");
        cantidadErrores++;
        valid = true;
    }
    if (nombre.length <= 0) {
        $("#nombre + span").text("**Campo Requerido");
        cantidadErrores++;
        valid = true;
    }

    if (!valid) {
        $("#nombre + span").text("");
    }
    valid = false;

    let descr = $("#descr").val();

    if (!stringLength(descr, 50)) {
        $("#descr + span").text("**Demasiados caracteres");
        cantidadErrores++;
        valid = true;
    }
    if (descr.length <= 0) {
        $("#descr + span").text("**Campo Requerido");
        cantidadErrores++;
        valid = true;
    }

    if (!valid) {
        $("#descr + span").text("");
    }
    valid = false;
    let descr_es = $("#descr_es").val();

    if (!stringLength(descr_es, 50)) {
        $("#descr_es + span").text("**Demasiados caracteres");
        cantidadErrores++;
        valid = true;
    }
    if (descr_es.length <= 0) {
        $("#descr_es + span").text("**Campo Requerido");
        cantidadErrores++;
        valid = true;
    }

    if (!valid) {
        $("#descr_es + span").text("");
    }
    valid = false;
    let tipos = $("#tipos").val();

    valid = false;
    if (cantidadErrores == 0) {
        let form = {};
        form.nombre = nombre;
        form.descr = descr;
        form.tipos = tipos;
        form.descr_es = descr_es;
        form.id = $("#id").val();
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            type: "POST",
            url: $("#route").val() + "/update",
            data: { alojamiento: form },
            success: function (data) {
                console.log(data);
                $("#spinDiv").css("display", "none");
                let json = JSON.parse(data);
                if (json) {
                    let rsp = alertTimeCorrect(
                        "Alojamiento actualizado exitosamente",
                        function (response) {
                            limpiarFormulario();
                        }
                    );
                } else {
                    alertError(
                        "Error inesperado al guardar el Alojamiento, por favor compruebe los datos"
                    );
                }
            },
            error: function (data) {
                console.log(data);
                alertError("Error inesperado en el servidor");
            },
        });
    }
}
function limpiarFormulario() {
    window.location = $("#route").val() + "/" + $("#id").val() + "/edit";
}

$(".btn-primary").click(function () {
    confirmacionEliminar(
        "¿Desea reiniciar el formulario?",
        function (response) {
            if (response) {
                limpiarFormulario();
            }
        }
    );
});
$(".btn-warning").click(function () {
    confirmacionEliminar("¿Desea Salir?", function (response) {
        if (response) {
            window.location = $("#route").val();
        }
    });
});

$(".btn-success").click(save);
