var tci = document.getElementById('tci');
var tce = document.getElementById('tce');
var tic = document.getElementById('tic');
var tia = document.getElementById('tia');
let options = {
    format: "bbcode",
    plugins: "undo",
    icons: "monocons",

    toolbar: "bold,italic,underline|font,removeformat|copy,cut,paste",
    style: "https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css",
    locale: "no-NB",
    emoticonsEnabled: false,
};
$( document ).ready(function() {
    $("#spinDiv").css('display','none');
    $('#cursos').select2(
        {
            placeholder: 'Selecciona un curso',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#scursos').select2(
        {
            placeholder: 'Selecciona un suplemento',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#scursos2').select2(
        {
            placeholder: 'Selecciona un suplemento',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#scursos3').select2(
        {
            placeholder: 'Selecciona un suplemento',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#alojamientos').select2(
        {
            placeholder: 'Selecciona un suplemento',
            allowClear: true,
            width: 'resolve'
        }
    );
    
      $('#salojamientos').select2(
        {
            placeholder: 'Selecciona un suplemento',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#salojamientos2').select2(
        {
            placeholder: 'Selecciona un suplemento',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#salojamientos3').select2(
        {
            placeholder: 'Selecciona un suplemento',
            allowClear: true,
            width: 'resolve'
        }
    );
    sceditor.create(tci, options);
    sceditor.create(tce, options);
    sceditor.create(tic, options);
    sceditor.create(tia, options);
    
    sceditor.instance(tci).bind('keyup', function(e) {
    
        let text = sceditor.instance(tci).val();
        console.log(text);
        $("#tci").html(text);
        localStorage.setItem('comentarios_internos',text);
    });
    sceditor.instance(tce).bind('keyup', function(e) {
    
        let text = sceditor.instance(tce).val();
        console.log(text);
        $("#tce").html(text);
        localStorage.setItem('comentarios_escuelas',text);
    });
    sceditor.instance(tic).bind('keyup', function(e) {
    
        let text = sceditor.instance(tic).val();
        console.log(text);
        localStorage.setItem('info_curso',text);
        $("#tic").html(text);
    });
    sceditor.instance(tia).bind('keyup', function(e) {
    
        let text = sceditor.instance(tia).val();
        console.log(text);
        localStorage.setItem('info_adicional',text);
        $("#tia").html(text);
    });
    if($("#isAlojado").val()!=1){
        $("#alojamientos").val('').change();
    }
    if($("#isAlojado2").val()!=1){
        $("#salojamientos").val('').change();
    }
    if($("#isAlojado3").val()!=1){
        $("#salojamientos2").val('').change();
    }
    if($("#isAlojado4").val()!=1){
        $("#salojamientos3").val('').change();
    }
    if($("#isAlojado5").val()!=1){
        $("#scursos").val('').change();
    }
    if($("#isAlojado6").val()!=1){
        $("#scursos2").val('').change();
    }
    if($("#isAlojado7").val()!=1){
        $("#scursos3").val('').change();
    }
  });
  function clearStep3(){
    confirmacionEliminar("¿Desea limpiar los campos del formulario?", function(response) {
        if(response) {
            $("select").val( $("select option:first").val());
            $("input").val("");
            $("textarea").val("");
            sceditor.instance(tii).val("");
            sceditor.instance(tiv).val("");
        }
    });
    
  }
  function validateStep2() {
    let cursos = $("#cursos").val();
    let fechaInit = $("#fechaInit").val();
    let fechaEnd = $("#fechaEnd").val();
    let price = $("#price").val();
    let scursos = $("#scursos").val();
    let precios1 = $("#precios1").val();
    let scursos2 = $("#scursos2").val();
    let precios2 = $("#precios2").val();
    let scursos3 = $("#scursos3").val();
    let precios3 = $("#precios3").val();

    let desc = $("#desc").val();
    let apagar = $("#apagar").val();
    let pagado = $("#pagado").val();
    let fechaPagado = $("#fechaPagado").val();

    let alojamientos = $("#alojamientos").val();
    let fechaInit2 = $("#fechaInit2").val();
    let fechaEnd2 = $("#fechaEnd2").val();
    let price2 = $("#price2").val();
    let salojamientos = $("#salojamientos").val();
    let precios4 = $("#precios4").val();
    let salojamientos2 = $("#salojamientos3").val();
    let precios5 = $("#precios5").val();
    let salojamientos3 = $("#salojamientos3").val();
    let precios6 = $("#precios6").val();
    let comentarios_i = sceditor.instance(tci).val();
    let comentarios_e = sceditor.instance(tce).val();
    let info_a = sceditor.instance(tia).val();
    let info_cu = sceditor.instance(tic).val();
    let cantidadErrores = 0;
    if (cursos == null) {
        cantidadErrores++;
        $("#spancursos").text("**Campo Requerido");
    } else {
        $("#spancursos").text("");
    }
    if (fechaInit == "") {
        cantidadErrores++;
        $("#fechaInit + span").text("**Campo Requerido");
    } else {
        $("#fechaInit + span").text("");
    }
    let validDate = true;
    if (fechaEnd == "") {
        validDate = false;
        cantidadErrores++;
        console.log("Mal", $("#spanfechaEnd"));
        $("#spanfechaEnd").text("**Campo Requerido");
    } else {
        $("#spanfechaEnd").text("");
    }
    if (new Date(fechaInit) > new Date(fechaEnd)) {
        cantidadErrores++;
        $("#spanfechaEnd").text("**Campo debe ser mayor a la fecha de inicio");
    } else {
        if (validDate) {
            $("#spanfechaEnd").text("");
        }
    }
    if (price.length == 0) {
        cantidadErrores++;
        $("#price + span").text("**Campo requerido");
    } else {
        $("#price + span").text("");
    }

    if (fechaInit2 != "" && fechaEnd2 != "") {
        if (new Date(fechaInit2) > new Date(fechaEnd2)) {
            console.log("Invalid", $("#fechaEnd2 + span"));
            cantidadErrores++;
            $("#fechaEnd2 + span").text(
                "**Campo debe ser mayor a la fecha de inicio"
            );
        } else {
            $("#fechaEnd2 + span").text("");
        }
    } else {
        $("#fechaEnd2 + span").text("");
    }

    if (cantidadErrores == 0) {
        return true;
    } else {
        return false;
    }
}
  function FinallyStep2(value) {
   
   if(!validateStep2()){
    return;
   }
    let form = {
        cursos: $("#cursos").val(),
        fechaInit: $("#fechaInit").val(),
        fechaEnd: $("#fechaEnd").val(),
        price: $("#price").val(),
        price2: $("#price2").val(),
        fechaInit: $("#fechaInit").val(),
        fechaEnd: $("#fechaEnd").val(),
        fechaInit2: $("#fechaInit2").val(),
        fechaEnd2: $("#fechaEnd2").val(),
        precios1: $("#precios1").val(),
        precios2: $("#precios2").val(),
        precios3: $("#precios3").val(),
        precios4: $("#precios4").val(),
        precios5: $("#precios5").val(),
        precios6: $("#precios6").val(),
        desc: $("#desc").val(),
        apagar: $("#apagar").val(),
        numSemanas: $("#numSemanas").val(),
        pagado: $("#pagado").val(),
        fechaPagado: $("#fechaPagado").val(),
        comentarios_internos: localStorage.getItem("comentarios_internos"),
        comentarios_esc: localStorage.getItem("comentarios_escuelas"),
        informacion_curso: localStorage.getItem("info_adicional"),
        informacion_alojamiento: localStorage.getItem("info_curso"),
    };
    if ($("#scursos").val() != null) {
        form.scursos = $("#scursos").val();
    } else {
        form.scursos = "";
    }
    if ($("#scursos2").val() != null) {
        form.scursos2 = $("#scursos2").val();
    } else {
        form.scursos2 = "-1";
    }
    if ($("#scursos3").val() != null) {
        form.scursos3 = $("#scursos3").val();
    } else {
        form.scursos3 = "-1";
    }
    if ($("#salojamientos").val() != null) {
        form.salojamientos = $("#salojamientos").val();
    } else {
        form.salojamientos= "-1";
    }
    if ($("#salojamientos2").val() != null) {
        form.salojamientos2 = $("#salojamientos2").val();
    } else {
        form.salojamientos2= "-1";
    }
    if ($("#salojamientos3").val() != null) {
        form.salojamientos3 = $("#salojamientos3").val();
    } else {
        form.salojamientos3= "-1";
    }
    if ($("#alojamientos").val() != null) {
        form.alojamientos = $("#alojamientos").val();
    } else {
        form.alojamientos= "-1";
    }
    console.log(form);
    $("#spinDiv").css("display", "flex");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "POST",
        url: $("#route").val() + "/cursoUpdate",
        data: form,
        success: function (data) {
            console.log(data);
            $("#spinDiv").css("display", "none");
            let json = JSON.parse(data);
            if (data != "false") {
                let rsp = alertTimeCorrect(
                    "Operación actualizada exitosamente",
                    function (response) {
                        window.location =
                            $("#route").val() + "/../curso_operacion/" + json.opr_id;
                    }
                );
            } else {
                console.log(json);
                alertError(json);
            }
        },
        error: function (data) {
            $("#spinDiv").css("display", "none");
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}