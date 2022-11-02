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
        url: $("#route_modal").val() + "/descripcion_modal",
        data: form,
        success: function (data) {
            console.log(JSON.parse(data));
            let d=JSON.parse(data);
            let datos = JSON.parse(data)['operacion'][0];
            operacion = datos;
            let transfer=(operacion.vje_transfer==1)?'Si':'No';
            let precioTotal=operacion.cur_precio+operacion.alj_precio;
            let total=(precioTotal+d.suplementos.precio+operacion.vje_vuelo_precio+operacion.vje_transfer_precio)-operacion.opr_descuento;
            let transfer_tipo="";
            if (operacion.vje_transfer==1){
                transfer_tipo=(operacion.vje_transfer_tipo==1)?'Ida':((operacion.vje_transfer_tipo==2)?'Vuelta':'Ida y vuelta');
            }else{
                transfer_tipo='No';
            }
                
              
                
            console.log(d.suplementos.nombres);
           
            empresa=JSON.parse(data)['empresa'];
            console.log(empresa,d.idioma);
            if(operacion.alj_nombre==null){
                operacion.alj_nombre="";
            }
            if(operacion.cur_nombre==null){
                operacion.cur_nombre="";
            }
           
            $("#alumno").html(operacion.alu_nombre+" "+operacion.alu_apellidos);
            $("#idioma").html(d.idioma.opc_descr);
            $("#ciudad").html(operacion.cur_localidad);
            $("#tipoCurso").html(operacion.cur_nombre);
            $("#fechas").html(operacion.cur_fecha_inicio+" al "+operacion.cur_fecha_fin);
            $("#tipoAlojamiento").html(operacion.alj_nombre);
            $("#fechas2").html(operacion.alj_fecha_inicio+" al "+operacion.alj_fecha_fin);
            $("#transfer").html(transfer_tipo);
            $("#sups").html(d.suplementos.nombres);
          
            $("#precioca").html(precioTotal+'&euro;');
            $("#des").html(operacion.opr_descuento+'&euro;');
            $("#sups2").html(d.suplementos.precio+'&euro;');
            $("#trans").html(operacion.vje_transfer_precio+'&euro;');
            $("#others").html(operacion.vje_vuelo_precio+'&euro;');
            console.log("TOTAL",d.suplementos.precio+'&euro;');
            $("#total").html(total+'&euro;');
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
        "Fecha Nacimiento",
        "Edad",
        "Género",
        "Profesión",
        "Fecha de cursos",
        "Tipo",
        "Nivel",
        "Tipo de alojamiento",
        "Fecha de alojamiento",
        "Fumador",
        "Alergías",
        "Mascotas",
        "Dieta",
        "Comentarios",
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
        text = "(Modificación) Solicitud de curso";
        textPostion = this.center(doc, text);
        text =
            '<h3><strong><span style="color:#FF0000">(Modificación)</span> Solicitud de curso</strong></h3>';
        doc.fromHTML(text, textPostion + 0, 55);
    }

    doc.setFont("times", "normal");
    doc.setFontSize(12);
    let campos = SOLICITUD();

    let indexY = 80;
    let indexX = 40;
    console.log(campos, pdf);
    campos.forEach((element, index) => {
        doc.setFont("times", "bold");
        doc.text(element + ":", indexX, indexY);
        doc.setFont("times", "normal");
        indexX = 80;
        if (pdf[index] == undefined) {
            pdf[index] = "";
        } else if (pdf[index] == null) {
            pdf[index] = "";
        }
        console.log(pdf[index]);
        pdf[index] = pdf[index] + "";
        let temp = pdf[index];
        if (temp.match(/<p>/g) != undefined || temp.match(/<p>/g) != null) {
            console.log("Ingreso", temp.match(/<p>/g));
            doc.fromHTML(pdf[index] + "", indexX, indexY);
        } else {
            console.log("Text ", pdf[index]);
            doc.text(pdf[index], indexX, indexY);
        }

        indexX = 40;
        indexY = indexY + 7;
    });
    // Convert HTML to PDF in JavaScript

    doc.save("Descripción " +operacion.alu_nombre+" "+operacion.alu_apellidos+ " " + getTimeV2() + " ");
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
        url: $("#route_modal").val() + "/solicitud_curso_email",
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
        url: $("#route_modal").val() + "/solicitud_curso_email",
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
