let pdf2 = [];
let operacionTransfer = {};
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
            operacionTransfer = datos;
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
          pdf2=[];
            pdf2.push(datos.esc_contacto_1 + " (" + datos.esc_cnt_mail_1 + ")");
            pdf2.push("Administración Europa Plus");
            pdf2.push(datos.cur_localidad);
            pdf2.push(datos.alu_apellidos);
            pdf2.push(datos.alu_nombre);
            
            pdf2.push(datos.alu_edad);
            pdf2.push(sexo);
            pdf2.push("");
            pdf2.push(datos.vje_ida_aeropuerto);
            pdf2.push(datos.vje_ida_llegada);
            pdf2.push(datos.vje_ida_num_vuelo+" "+datos.vje_ida_linea);
            pdf2.push(datos.vje_ida_hllegada);
            pdf2.push("");
            pdf2.push(datos.vje_vta_aeropuerto);
            pdf2.push(datos.vje_vta_salida);
            pdf2.push(datos.vje_vta_num_vuelo+" "+datos.vje_vta_linea);
            pdf2.push(datos.vje_vta_hsalida);
            console.log(pdf2);
            $("#spinDiv").css("display", "none");

            $("#modal").modal("show");
            $("#modal").css("display", "block");
        },
        error: function (data) {
            $("#spinDiv").css("display", "none");
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


function printT(isPrint) {
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
    if (operacionTransfer.opr_modificada == 0) {
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
    console.log(campos, pdf2);
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
        if (pdf2[index] == undefined) {
            pdf2[index] = "";
        } else if (pdf2[index] == null) {
            pdf2[index] = "";
        }
       
        pdf2[index] = pdf2[index] + "";
        let temp = pdf2[index];
        if (temp.match(/<p>/g) != undefined || temp.match(/<p>/g) != null) {
           
            doc.fromHTML(pdf2[index] + "", indexX, indexY);
        } else {
           
            doc.text(pdf2[index], indexX, indexY);
        }

        indexX = 40;
        indexY = indexY + 7;
    });
    // Convert HTML to pdf2 in JavaScript

    if(isPrint){
        doc.save("Solicitud de transferencia " +operacionTransfer.alu_nombre+" "+operacionTransfer.alu_apellidos+ " " + getTimeV2() + " ");
    }else{
        docTransfer=doc;
    }
}
let docTransfer;
function confirmarVuelo(){
    let form = {};
    $("#spinDiv").css("display", "flex");
  
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/confirmacion_vuelo_email",
        data: form,
        success: function (data) {
            $("#spinDiv").css("display", "none");
          console.log(data);
          if(data=='true'){
            let rsp = alertTimeCorrect(
                "Confirmación de vuelo éxitosa",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../vuelo/" + $("#id").val();
                }
            );
          }
        },
        error: function (data) {
            $("#spinDiv").css("display", "none");
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
  }
  
function confirmSinCorreoT(){
    $("#spinDiv").css("display", "flex");
    let form = new FormData();
    form.append("tipo",0);
    printT(false);
    let data =btoa(docTransfer.output());
    form.append('file',data);
    form.append('operacion',JSON.stringify(operacionTransfer));
    
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        contentType:false,
        processData:false,
        cache:false,
        url: $("#route_modal").val() + "/solicitud_transfer_email",
        data: form,
        success: function (data) {
          console.log(data);
          $("#spinDiv").css("display", "none");
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
            $("#spinDiv").css("display", "none");
            alertError("Error inesperado en el servidor");
        },
    });
}
function sendT() {
    $("#spinDiv").css("display", "flex");
    let form = new FormData();
    form.append("tipo",1);
    printT(false);
    let data =btoa(docTransfer.output());
    form.append('file',data);
    form.append('operacion',JSON.stringify(operacionTransfer));
    
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        contentType:false,
        processData:false,
        cache:false,
        url: $("#route_modal").val() + "/solicitud_transfer_email",
        data: form,
        success: function (data) {
          console.log(data);
          $("#spinDiv").css("display", "none");
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
            $("#spinDiv").css("display", "none");
            alertError("Error inesperado en el servidor");
        },
    });
}
function confirmar(){
  let form = {};
  $("#spinDiv").css("display", "flex");

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
            $("#spinDiv").css("display", "none");
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
            $("#spinDiv").css("display", "none");
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}


