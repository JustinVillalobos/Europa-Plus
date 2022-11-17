let pdfCondicionada = [];
let operacionCondicionada = {};
let empresaCondicionada={};
function loadModalCondicionada(id) {
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
            operacionCondicionada = datos;
            empresaCondicionada=JSON.parse(data)['empresa'];
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
            if(operacionCondicionada.vje_transfer_precio==null){
                operacionCondicionada.vje_transfer_precio=0;
            }
            if(operacionCondicionada.vje_vuelo_precio==null){
                operacionCondicionada.vje_vuelo_precio=0;
            }
              let transfer=(operacionCondicionada.vje_transfer==1)?'Si':'No';
              let vuelo =(operacionCondicionada.vje_vuelo==1)?'Si':'No';
            let precioTotal=operacionCondicionada.cur_precio+operacionCondicionada.alj_precio;
            
            let transfer_tipo="";
            let vueloTipo="";
            if (operacionCondicionada.vje_transfer==1){
                transfer_tipo=(operacionCondicionada.vje_transfer_tipo==1)?'Ida':((operacionCondicionada.vje_transfer_tipo==2)?'Vuelta':'Ida y vuelta');
            }else{
                transfer_tipo='No';
            }
            if (operacionCondicionada.vje_vuelo==1){
                vueloTipo=(operacionCondicionada.vje_vuelo_tipo==1)?'Ida':((operacionCondicionada.vje_vuelo_tipo==2)?'Vuelta':'Ida y vuelta');
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
            if(operacionCondicionada.alj_nombre==null){
                operacionCondicionada.alj_nombre="";
            }
            if(operacionCondicionada.cur_nombre==null){
                operacionCondicionada.cur_nombre="";
            }
            pdfCondicionada=[];
            $("#dirC").html(datos.cur_localidad);
            
            $("#nombreC").html(datos.alu_nombre+" "+datos.alu_apellidos);
            $("#idiomaC").html(d.idioma.opc_descr);
            $("#tipoC").html(datos.cur_nombre);
            $("#fechasCursosC").html(datos.cur_fecha_inicio+" al "+datos.cur_fecha_fin);
            $("#tipoAlojamientoC").html(datos.alj_nombre);
            $("#fechaAlojamientoC").html(datos.alj_fecha_inicio+" al "+datos.alj_fecha_fin);
            $("#transferC").html(transfer_tipo);
            $("#vueloC").html(vueloTipo);
            $("#vueloDataC").html("<p style='margin:0;'>Ida:"+datos.vje_ida_salida+" - "+datos.vje_ida_hsalida+" - "+datos.vje_ida_aeropuerto+"</p><p style='margin:0;'>Vuelta:"+datos.vje_vta_salida+" - "+datos.vje_vta_hsalida+" - "+datos.vje_vta_aeropuerto+"</p>");
            $("#supsC").html(d.suplementos.nombres);
           
            if(precioTotal!=null && precioTotal!=0){
                $("#preciocaCc").html(precioTotal.toFixed(2)+'€');
                $(".pcac").css('display','block');
            }else{
                $(".pcac").css('display','none');
                precioTotal=0;
            }

            if(operacionCondicionada.opr_descuento!=null && operacionCondicionada.opr_descuento!=0){
                console.log("ingreso descuento");
                $("#desCc").html(operacionCondicionada.opr_descuento.toFixed(2)+'€');
                $(".pdc").css('display','block');
            }else{
                $(".pdc").css('display','none');
                operacionCondicionada.opr_descuento=0;
            }
            if(d.suplementos.precio!=null && d.suplementos.precio!=0){
                $("#sups2Cc").html(d.suplementos.precio.toFixed(2)+'€');
                $(".psc").css('display','block');
            }else{
                $(".psc").css('display','none');
                d.suplementos.precio=0;
            }
            
            if(operacionCondicionada.vje_transfer_precio!=null && operacionCondicionada.vje_transfer_precio!=0){
                $("#transCc").html(operacionCondicionada.vje_transfer_precio.toFixed(2)+'€');
                $(".ptc").css('display','block');
            }else{
                $(".ptc").css('display','none');
                operacionCondicionada.vje_transfer_precio=0;
            }
            
            if(operacionCondicionada.vje_vuelo_precio!=null && operacionCondicionada.vje_vuelo_precio!=0){
                $("#othersCc").html(operacionCondicionada.vje_vuelo_precio.toFixed(2)+'€');
                $(".poc").css('display','block');
            }else{
                $(".poc").css('display','none');
                operacionCondicionada.vje_vuelo_precio=0;
            }
           
           
            let total=(precioTotal+d.suplementos.precio+operacionCondicionada.vje_vuelo_precio+operacionCondicionada.vje_transfer_precio)-operacionCondicionada.opr_descuento;
            console.log("Total "+total);
            $("#totalCC").html(total.toFixed(2)+'€');

            $("#banco").html(empresaCondicionada.banco);
            $("#direccion_banco").html(empresaCondicionada.direccion);
            $("#IBAN").html("IBAN:"+empresaCondicionada.IBAN);
            $("#codigo_postal").html("SWIFT/BIC:"+empresaCondicionada.codigo_postal);


            let porcenta=d.prc;
            $("#price").html(porcenta.toFixed(2));
            empresaCondicionada.porcenta=porcenta;
            empresaCondicionada.suplementos=d.suplementos;
            empresaCondicionada.total=total;
            console.log("Transfer tipo ",porcenta);
            
           empresaCondicionada.vuelo="<p>Ida:"+datos.vje_ida_salida+" - "+datos.vje_ida_hsalida+" - "+datos.vje_ida_aeropuerto+"</p><p>Vuelta:"+datos.vje_vta_salida+" - "+datos.vje_vta_hsalida+" - "+datos.vje_vta_aeropuerto+"</p>";
            pdfCondicionada.push(datos.alu_nombre+" "+datos.alu_apellidos);
            pdfCondicionada.push($("#to").text());
            pdfCondicionada.push(datos.cur_localidad);
            pdfCondicionada.push(d.idioma.opc_descr);
            pdfCondicionada.push(datos.cur_nombre);
            pdfCondicionada.push(datos.cur_fecha_inicio+" al "+datos.cur_fecha_fin);
            pdfCondicionada.push(datos.alj_nombre);
            pdfCondicionada.push(datos.alj_fecha_inicio+" al "+datos.alj_fecha_fin);
            pdfCondicionada.push(transfer_tipo);
            pdfCondicionada.push(vueloTipo);
           
            pdfCondicionada.push(d.suplementos.nombres);
           
           
     
            console.log(pdfCondicionada);
            $("#spinDiv").css("display", "none");

            $("#modalC").modal("show");
            $("#modalC").css("display", "block");
        },
        error: function (data) {
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}
function closeModalCondicionada() {
    $("#modalC").modal("hide");
    $("#modalC").css("display", "none");
}
function loadModalSolicitud(id) {
    loadModal(id);
    console.log(id);
}
$(".btn-danger").click(function () {
    console.log("Ingreso");
    closeModalCondicionada();
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


function printCondicionada() {
    let date = new Date();

    var doc = new jsPDF({ orientation: "p", unit: "mm", format: "a4" });
    doc=header(doc,empresaCondicionada);
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
    console.log(campos, pdfCondicionada);
    campos.forEach((element, index) => {
        doc.setFont("times", "bold");
        
            if(element==""){
                doc.text(element+ "", indexX, indexY);
                doc.setFont("times", "normal");
                maxLineWidth=100;
                var textLines = doc.splitTextToSize(pdfCondicionada[index], maxLineWidth);
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
                console.log(element+":"+pdfCondicionada[index]);
                indexX = 80;
                if (pdfCondicionada[index] == undefined) {
                    pdfCondicionada[index] = "";
                } else if (pdfCondicionada[index] == null) {
                    pdfCondicionada[index] = "";
                }
            
                pdfCondicionada[index] = pdfCondicionada[index] + "";
                if(element=="Suplementos"){
                    var textLines = doc.splitTextToSize(pdfCondicionada[index], maxLineWidth);
                    console.log("Text lines",textLines);
                    textLines.forEach(element => {
                        doc.text(""+element, indexX, indexY);
                        indexY=indexY+7;
                    });
                }else{
                    let temp = pdfCondicionada[index];
                    if (temp.match(/<p>/g) != undefined || temp.match(/<p>/g) != null) {
                    
                        doc.fromHTML(pdfCondicionada[index] + "", indexX, indexY);
                    } else {
                    
                        doc.text(pdfCondicionada[index], indexX, indexY);
                    }
                    if(element=="Vuelo"){
                        let i=empresaCondicionada.vuelo;
                        indexY = indexY - 3;
                        doc.fromHTML(i + "", indexX, indexY);
                        indexY = indexY+15;
                    }
                }
                
                
                indexX = 40;
                indexY = indexY + 7;
            }
    });
    html=$("#table-calcs2 .pp2");
    let html2=$("#table-calcs2 .pp3");
    indexX = 45;
    indexY=indexY-10;
    let pivot=indexY;
    let pivotMax=0;
    html.each(function(index){
        var item=$(this).html();
        let itemTemp=$(html2[index]);
        if(itemTemp.css('display')=='block'){
            doc.fromHTML(item + "", indexX, indexY);
            item=$(html2[index]).text();
            console.log("ITEM COBROS ",itemTemp.css('display'));
            doc.text(item + "", indexX+55, indexY+7);
            indexY=indexY+7;
        }
        
        
        console.log(item);
    });
    html=$("#data_info_c .pp4");
    pivotMax=indexY+5;
    doc.setDrawColor(255, 157, 13);
    doc.line(indexX, pivot, indexX, pivotMax);
    doc.setDrawColor(0, 0, 0);
    indexX = 40;

    doc.setDrawColor(0, 0, 0);
    doc.setFontSize(11);
    maxLineWidth=pageWidth-70;
    indexY=indexY+7;
    html.each(function(index){
        var item=$(this).text();
        var textLines = doc.splitTextToSize(item, maxLineWidth);
                    console.log("Text lines",textLines);
                    if(textLines.length==1){
                        doc.text(item + "", indexX, indexY);
                        indexY=indexY+5;
                    }else{
                        textLines.forEach(element => {
                            doc.text(element + "", indexX, indexY);
                            indexY=indexY+5;
                        });
                        indexY=indexY-7;
                    }
                   
        
      
        
        
        console.log(item);
    });

    // Convert HTML to PDF in JavaScript

    doc.save("Confirmación condicionada " +operacionCondicionada.alu_nombre+" "+operacionCondicionada.alu_apellidos+ " " + getTimeV2() + " ");
}
function confirmSinCorreoCondicionada(){
    let form = {"tipo":0};
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/confirmar_condicionada_email",
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
function sendCondicionada() {
    let form = {"tipo":1};
    

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    console.log($("#route_modal").val());
    $.ajax({
        type: "POST",
        url: $("#route_modal").val() + "/confirmar_condicionada_email",
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


