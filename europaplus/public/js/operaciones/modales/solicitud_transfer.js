let pdf = [];
let operacion = {};
let empresa={};
function loadModal(id) {
    $("#spinDiv").css("display", "flex");
    let form = {};
    form.id = id;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/solicitud_transfer_modal",
        data: form,
        success: function (data) {
            console.log(JSON.parse(data));
            let datos = JSON.parse(data)['operacion'][0];
            console.log(datos);
            operacion = datos;
            empresa=JSON.parse(data)['empresa'];
            console.log(empresa);
            let sexo = "";
            let nivel = "";
     
            if (datos.alu_animales == null) {
                datos.alu_animales = "";
            }
            if (datos.alu_nivel_idioma == 5) nivel = "Principiante";
            else if (datos.alu_nivel_idioma == 4) nivel = "Elemental";
            else if (datos.alu_nivel_idioma == 3) nivel = "Intermedio Bajo";
            else if (datos.alu_nivel_idioma == 2) nivel = "Intermedio";
            else if (datos.alu_nivel_idioma == 1) nivel = "Intermedio Alto";
            else if (datos.alu_nivel_idioma == 0) nivel = "Avanzado";
            else nivel = "No especificado";
            
            if (datos.alu_sexo == 1) sexo = "Masculino";
            else sexo = "Femenino";
            if (datos.opr_modificada != 0) {
                $("#title").html(
                    '<span style="color:#FF0000">(Modificación)</span> Solicitud de transferencia'
                );
            }
            $("#from").html(
                datos.esc_contacto_1 + " (" + datos.esc_cnt_mail_1 + ")"
            );
            if(datos.vje_ida_num_vuelo==null){
                datos.vje_ida_num_vuelo="";
            }
            if(datos.vje_ida_linea==null){
                datos.vje_ida_linea="";
            }
            if(datos.vje_vta_num_vuelo==null){
                datos.vje_vta_num_vuelo="";
            }
            if(datos.vje_vta_linea==null){
                datos.vje_vta_linea="";
            }
            $("#dir").html(datos.cur_localidad);
            $("#apellidos").html(datos.alu_apellidos);
            $("#nombre").html(datos.alu_nombre);
            $("#fechaNacimiento").html(datos.alu_fecha_nacim);
            $("#edad").html(datos.alu_edad);
            $("#genero").html(sexo);
          $("#aeropuerto").html(datos.vje_ida_aeropuerto);
          $("#fecha").html(datos.vje_ida_llegada);
          $("#vuelo").html(datos.vje_ida_num_vuelo+" "+datos.vje_ida_linea);
          $("#hora").html(datos.vje_ida_hllegada);

          $("#aeropuerto2").html(datos.vje_vta_aeropuerto);
          $("#fecha2").html(datos.vje_vta_salida);
          $("#vuelo2").html(datos.vje_vta_num_vuelo+" "+datos.vje_vta_linea);
          $("#hora2").html(datos.vje_vta_hsalida);
          pdf=[];
            pdf.push(datos.esc_contacto_1 + " (" + datos.esc_cnt_mail_1 + ")");
            pdf.push("Administración Europa Plus");
            pdf.push(datos.cur_localidad);
            pdf.push(datos.alu_apellidos);
            pdf.push(datos.alu_nombre);
            
            pdf.push(datos.alu_edad);
            pdf.push(sexo);
            pdf.push("");
            pdf.push(datos.vje_ida_aeropuerto);
            pdf.push(datos.vje_ida_llegada);
            pdf.push(datos.vje_ida_num_vuelo+" "+datos.vje_ida_linea);
            pdf.push(datos.vje_ida_hllegada);
            pdf.push("");
            pdf.push(datos.vje_vta_aeropuerto);
            pdf.push(datos.vje_vta_salida);
            pdf.push(datos.vje_vta_num_vuelo+" "+datos.vje_vta_linea);
            pdf.push(datos.vje_vta_hsalida);
            console.log(pdf);
            $("#spinDiv").css("display", "none");

            $("#modal").modal("show");
            $("#modal").css("display", "block");
        },
        error: function (data) {
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}
function closeModal() {
    $("#modal").modal("hide");
    $("#modal").css("display", "none");
}
function loadModalSolicitud(id) {
    loadModal(id);
    console.log(id);
}
$(".btn-danger").click(function () {
    console.log("Ingreso");
    closeModal();
});
function setMes() {
    let date = new Date();
    console.log(date);
    let month = date.getMonth();
    let formatMonth = "";
    console.log(month);
    switch (month) {
        case 0:
            formatMonth = "Enero";
            break;
        case 1:
            formatMonth = "Febrero";
            break;
        case 2:
            formatMonth = "Marzo";
            break;
        case 3:
            formatMonth = "Abril";
            break;
        case 4:
            formatMonth = "Mayo";
            break;
        case 5:
            formatMonth = "Junio";
            break;
        case 6:
            formatMonth = "Julio";
            break;
        case 7:
            formatMonth = "Agosto";
            break;
        case 8:
            formatMonth = "Septiembre";
            break;
        case 9:
            formatMonth = "Octubre";
            break;
        case 10:
            formatMonth = "Noviembre";
            break;
        case 11:
            formatMonth = "Diciembre";
            break;
    }
    $("#mes").text(formatMonth);
}

function SOLICITUD() {
    let campos = [
        "Para",
        "De",
        "Dirección",
        "Apellidos",
        "Nombre",

        "Edad",
        "Género",
        "Llegada",
        "Aeropuerto / Estación de tren",
        "Fecha ",
        "Vuelo/Número de tren",
        "Hora",
        "Salida",
        "Aeropuerto / Estación de tren",
        "Fecha ",
        "Vuelo/Número de tren",
        "Hora",
    ];

    return campos;
}


function print() {
    let date = new Date();

    var doc = new jsPDF({ orientation: "p", unit: "mm", format: "a4" });
    doc=header(doc,empresa);
    var pageHeight =
        doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
    var pageWidth =
        doc.internal.pageSize.width || doc.internal.pageSize.getWidth();

    doc.setFontSize(16);
    doc.setFont("helvetica", "bold");
    let text = " Solicitud de curso";
    let textPostion = this.center(doc, text);
    if (operacion.opr_modificada == 0) {
        text = "(Modificación) Solicitud de transferencia";
        textPostion = this.center(doc, text);
        doc.text(text, textPostion, 55);
    } else {
        text = "(Modificación) Solicitud de transferencia";
        textPostion = this.center(doc, text);
        text =
            '<h3><strong><span style="color:#FF0000">(Modificación)</span> Solicitud de transferencia</strong></h3>';
        doc.fromHTML(text, textPostion + 10, 55);
    }

    doc.setFont("times", "normal");
    doc.setFontSize(12);
    let campos = SOLICITUD();

    let indexY = 80;
    let indexX = 40;
    console.log(campos, pdf);
    campos.forEach((element, index) => {
        doc.setFont("times", "bold");
        if (element=="Llegada" || element=="Salida") {
            indexY = indexY +4;
            doc.text(element + "", indexX, indexY);
            doc.line(indexX, indexY+2, indexX+16, indexY+2);
           
        } else {
            
            doc.text(element+ ":", indexX, indexY);
        }
       
        doc.setFont("times", "normal");
        indexX = 80;
        if (pdf[index] == undefined) {
            pdf[index] = "";
        } else if (pdf[index] == null) {
            pdf[index] = "";
        }
       
        pdf[index] = pdf[index] + "";
        let temp = pdf[index];
        if (temp.match(/<p>/g) != undefined || temp.match(/<p>/g) != null) {
           
            doc.fromHTML(pdf[index] + "", indexX, indexY);
        } else {
           
            doc.text(pdf[index], indexX, indexY);
        }

        indexX = 40;
        indexY = indexY + 7;
    });
    // Convert HTML to PDF in JavaScript

    doc.save("Solicitud de transferencia " +operacion.alu_nombre+" "+operacion.alu_apellidos+ " " + getTimeV2() + " ");
}
function confirmSinCorreo(){
    let form = {"tipo":0};
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/solicitud_transfer_email",
        data: form,
        success: function (data) {
          console.log(data);
          if(data=='true'){
            let rsp = alertTimeCorrect(
                "Envío de solicitud éxitoso",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../curso_operacion/" + $("#id").val();
                }
            );
          }
        },
        error: function (data) {
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}
function send() {
    let form = {"tipo":1};
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/solicitud_transfer_email",
        data: form,
        success: function (data) {
          console.log(data);
          if(data=='true'){
            let rsp = alertTimeCorrect(
                "Envío de solicitud éxitoso",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../curso_operacion/" + $("#id").val();
                }
            );
          }
        },
        error: function (data) {
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}
function confirmar(){
  let form = {};
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/confirmacion_transfer_email",
        data: form,
        success: function (data) {
          console.log(data);
          if(data=='true'){
            let rsp = alertTimeCorrect(
                "Confirmación de solicitud éxitoso",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../transfer/" + $("#id").val();
                }
            );
          }
        },
        error: function (data) {
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}


