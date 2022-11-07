let pdfConfirmar = [];
let operacionConfirmar = {};
let empresaConfirmar={};
function loadModalConfirmacion(id) {
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
        url: $("#route_modal").val() + "/confirmacion_condicionada",
        data: form,
        success: function (data) {
            console.log(JSON.parse(data));
            let datos = JSON.parse(data)['operacion'][0];
            let d=JSON.parse(data);
            console.log(datos);
            operacionConfirmar = datos;
            empresaConfirmar=JSON.parse(data)['empresa'];
            console.log(empresa);
          
            let nivel = "";
            if(datos.vje_ida_salida==null){
                datos.vje_ida_salida="";
            }
            if(datos.vje_ida_hsalida==null){
                datos.vje_ida_hsalida="";
            }
            if(datos.vje_ida_aeropuerto==null){
                datos.vje_ida_aeropuerto="";
            }
            if(datos.vje_vta_salida==null){
                datos.vje_vta_salida="";
            }
            if(datos.vje_vta_hsalida==null){
                datos.vje_vta_hsalida="";
            }
            if(datos.vje_vta_aeropuerto==null){
                datos.vje_vta_aeropuerto="";
            }
            if(operacionConfirmar.vje_transfer_precio==null){
                operacionConfirmar.vje_transfer_precio=0;
            }
            if(operacionConfirmar.vje_vuelo_precio==null){
                operacionConfirmar.vje_vuelo_precio=0;
            }
              let transfer=(operacionConfirmar.vje_transfer==1)?'Si':'No';
              let vuelo =(operacionConfirmar.vje_vuelo==1)?'Si':'No';
            let precioTotal=operacionConfirmar.cur_precio+operacionConfirmar.alj_precio;
            let total=(precioTotal+d.suplementos.precio+operacionConfirmar.vje_vuelo_precio+operacionConfirmar.vje_transfer_precio)-operacionConfirmar.opr_descuento;
            let transfer_tipo="";
            let vueloTipo="";
            if (operacionConfirmar.vje_transfer==1){
                transfer_tipo=(operacionConfirmar.vje_transfer_tipo==1)?'Ida':((operacionConfirmar.vje_transfer_tipo==2)?'Vuelta':'Ida y vuelta');
            }else{
                transfer_tipo='No';
            }
            if (operacionConfirmar.vje_vuelo==1){
                vueloTipo=(operacionConfirmar.vje_vuelo_tipo==1)?'Ida':((operacionConfirmar.vje_vuelo_tipo==2)?'Vuelta':'Ida y vuelta');
            }else{
                vueloTipo='No';
            }
            
            if (datos.alu_nivel_idioma == 5) nivel = "Principiante";
            else if (datos.alu_nivel_idioma == 4) nivel = "Elemental";
            else if (datos.alu_nivel_idioma == 3) nivel = "Intermedio Bajo";
            else if (datos.alu_nivel_idioma == 2) nivel = "Intermedio";
            else if (datos.alu_nivel_idioma == 1) nivel = "Intermedio Alto";
            else if (datos.alu_nivel_idioma == 0) nivel = "Avanzado";
            else nivel = "No especificado";
            if(operacionConfirmar.alj_nombre==null){
                operacionConfirmar.alj_nombre="";
            }
            if(operacionConfirmar.cur_nombre==null){
                operacionConfirmar.cur_nombre="";
            }
            pdfConfirmar=[];
            $("#dirCc").html(datos.cur_localidad);
            
            $("#nombreCc").html(datos.alu_nombre+" "+datos.alu_apellidos);
            $("#idiomaCc").html(d.idioma.opc_descr);
            $("#tipoCc").html(datos.cur_nombre);
            $("#fechasCursosCc").html(datos.cur_fecha_inicio+" al "+datos.cur_fecha_fin);
            $("#tipoAlojamientoCc").html(datos.alj_nombre);
            $("#fechaAlojamientoCc").html(datos.alj_fecha_inicio+" al "+datos.alj_fecha_fin);
            $("#transferCc").html(transfer_tipo);
            $("#vueloCc").html(vueloTipo);
            $("#vueloDataCc").html("<p style='margin:0;'>Ida:"+datos.vje_ida_salida+" - "+datos.vje_ida_hsalida+" - "+datos.vje_ida_aeropuerto+"</p><p style='margin:0;'>Vuelta:"+datos.vje_vta_salida+" - "+datos.vje_vta_hsalida+" - "+datos.vje_vta_aeropuerto+"</p>");
            $("#supsCc").html(d.suplementos.nombres);
            $("#preciocaCc").html(precioTotal.toFixed(2)+'€');
            $("#desCc").html(operacionConfirmar.opr_descuento.toFixed(2)+'€');
            $("#sups2Cc").html(d.suplementos.precio.toFixed(2)+'€');
            $("#transCc").html(operacionConfirmar.vje_transfer_precio.toFixed(2)+'€');
            $("#othersCc").html(operacionConfirmar.vje_vuelo_precio.toFixed(2)+'€');
            console.log("TOTAL",d.suplementos.precio.toFixed(2)+'€');
            $("#totalCc").html(total.toFixed(2)+'€');

            
            let porcenta= (total*d.prc)/100;
          
            console.log("Transfer tipo ",porcenta);
            
           empresaConfirmar.vuelo="<p>Ida:"+datos.vje_ida_salida+" - "+datos.vje_ida_hsalida+" - "+datos.vje_ida_aeropuerto+"</p><p>Vuelta:"+datos.vje_vta_salida+" - "+datos.vje_vta_hsalida+" - "+datos.vje_vta_aeropuerto+"</p>";
            pdfConfirmar.push(datos.alu_nombre+" "+datos.alu_apellidos);
            pdfConfirmar.push($("#to").text());
            pdfConfirmar.push(datos.cur_localidad);
            pdfConfirmar.push(d.idioma.opc_descr);
            pdfConfirmar.push(datos.cur_nombre);
            pdfConfirmar.push(datos.cur_fecha_inicio+" al "+datos.cur_fecha_fin);
            pdfConfirmar.push(datos.alj_nombre);
            pdfConfirmar.push(datos.alj_fecha_inicio+" al "+datos.alj_fecha_fin);
            pdfConfirmar.push(transfer_tipo);
            pdfConfirmar.push(vueloTipo);
           
            pdfConfirmar.push(d.suplementos.nombres);
           
           
     
            console.log(pdfConfirmar);
            $("#spinDiv").css("display", "none");

            $("#modalCC").modal("show");
            $("#modalCC").css("display", "block");
        },
        error: function (data) {
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}
function closeModalconfirmar() {
    $("#modalCC").modal("hide");
    $("#modalCC").css("display", "none");
}
function loadModalSolicitud(id) {
    loadModal(id);
    console.log(id);
}
$(".btn-danger").click(function () {
    console.log("Ingreso");
    closeModalconfirmar();
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

function SOLICITUDC() {
    let campos = [
        "Alumno/a",
        "",
        "Ciudad",
        "Idioma",
        "Tipo de Curso",
        "Fechas",
        "Tipo de alojamiento",
        "Fechas",
        "Transfer",
        "Vuelo",
        "Suplementos"
    ];

    return campos;
}


function printconfirmar() {
    let date = new Date();

    var doc = new jsPDF({ orientation: "p", unit: "mm", format: "a4" });
    doc=header(doc,empresaConfirmar);
    var pageHeight =
        doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
    var pageWidth =
        doc.internal.pageSize.width || doc.internal.pageSize.getWidth();

    doc.setFontSize(16);
    doc.setFont("helvetica", "bold");
    let text = " Confirmación de inscripción";
    let textPostion = this.center(doc, text);
    doc.text(text, textPostion, 60);

    doc.setFont("times", "normal");
    doc.setFontSize(12);
    let campos = SOLICITUDC();

    let indexY = 70;
    let indexX = 40;
    let maxLineWidth = pageWidth - 20 ;
    console.log(campos, pdfConfirmar);
    campos.forEach((element, index) => {
        doc.setFont("times", "bold");
        
            if(element==""){
                doc.text(element+ "", indexX, indexY);
                doc.setFont("times", "normal");
                maxLineWidth=100;
                var textLines = doc.splitTextToSize(pdfConfirmar[index], maxLineWidth);
                console.log("TEXT LINES ",textLines);
                indexX = 80;
                textLines.forEach(e => {
                    doc.text(e+ "", indexX, indexY);
                    indexY = indexY + 7;
                });
                
                indexX = 40;
                indexY = indexY - 7;
               
            }else{
                doc.text(element+ ":", indexX, indexY);
                doc.setFont("times", "normal");
                console.log(element+":"+pdfConfirmar[index]);
                indexX = 80;
                if (pdfConfirmar[index] == undefined) {
                    pdfConfirmar[index] = "";
                } else if (pdfConfirmar[index] == null) {
                    pdfConfirmar[index] = "";
                }
            
                pdfConfirmar[index] = pdfConfirmar[index] + "";
                if(element=="Suplementos"){
                    var textLines = doc.splitTextToSize(pdfConfirmar[index], maxLineWidth);
                    console.log("Text lines",textLines);
                    textLines.forEach(element => {
                        doc.text(""+element, indexX, indexY);
                        indexY=indexY+7;
                    });
                }else{
                    let temp = pdfConfirmar[index];
                    if (temp.match(/<p>/g) != undefined || temp.match(/<p>/g) != null) {
                    
                        doc.fromHTML(pdfConfirmar[index] + "", indexX, indexY);
                    } else {
                    
                        doc.text(pdfConfirmar[index], indexX, indexY);
                    }
                    if(element=="Vuelo"){
                        let i=empresaConfirmar.vuelo;
                        indexY = indexY - 3;
                        doc.fromHTML(i + "", indexX, indexY);
                        indexY = indexY+15;
                    }
                }
                
                
                indexX = 40;
                indexY = indexY + 7;
            }
    });
    html=$("#table-calcs2c .pp2");
    let html2=$("#table-calcs2c .pp3");
    indexX = 45;
    indexY=indexY-10;
    doc.setDrawColor(255, 157, 13);
    doc.line(indexX, indexY, indexX, indexY+45);
    doc.setDrawColor(0, 0, 0);
    html.each(function(index){
        var item=$(this).html();
        doc.fromHTML(item + "", indexX, indexY);
        item=$(html2[index]).text();
        doc.text(item + "", indexX+55, indexY+7);
        indexY=indexY+7;
        
        console.log(item);
    });
    html=$("#data_info_cc .pp4");
    
    indexX = 40;

    doc.setDrawColor(0, 0, 0);
    doc.setFontSize(11);
    maxLineWidth=pageWidth-70;
    indexY=indexY+10;
    html.each(function(index){
        var item=$(this).text();
        var textLines = doc.splitTextToSize(item, maxLineWidth);
                    console.log("Text lines",textLines);
                    if(textLines.length==1){
                        doc.text(item + "", indexX, indexY);
                        indexY=indexY+7;
                    }else{
                        textLines.forEach(element => {
                            doc.text(element + "", indexX, indexY);
                            indexY=indexY+5;
                        });
                        indexY=indexY-3;
                    }
                   
        
      
        
        
        console.log(item);
    });

    // Convert HTML to PDF in JavaScript

    doc.save("Confirmación " +operacionConfirmar.alu_nombre+" "+operacionConfirmar.alu_apellidos+ " " + getTimeV2() + " ");
}
function confirmSinCorreoconfirmar(){
    let form = {"tipo":0};
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/confirmar_email",
        data: form,
        success: function (data) {
          console.log(data);
          let d =JSON.parse(data);
          if(data=='true'){
            let rsp = alertTimeCorrect(
                "Confirmación éxitosa",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../operacion" ;
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
function sendconfirmar() {
    let form = {"tipo":1};
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/confirmar_email",
        data: form,
        success: function (data) {
          console.log(data);
          if(data=='true'){
            let rsp = alertTimeCorrect(
                "Envío de confirmación éxitoso",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../operacion";
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


