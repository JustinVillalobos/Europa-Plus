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
       
            if(datos.cur_tipo_curso==1){
                $("#txtt1").html('Confirmamos la recepción de la señal de reserva con la cantidad de <span id="price2"></span> euros en nuestra cuenta bancaria en concepto de Confirmación definitiva del curso descrito. 21 dias antes del comienzo de las clases debera hacer efectiva la totalidad del importe de su curso y nosotros le  entregaremos la documentacion relativa a su reserva, asi como el correspondiente material geografico y turistico de la ciudad de su eleccion y su entorno.');
                $("#txtt3").html('Estas condiciones tendran efecto contractual y permaneceran inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripcion.<br> ');
                $("#txtt2").html('Gracias por elegirnos para la realizacion de su curso y esperamos que quede satisfecho con nuestros servicios.');
                
            }else if(datos.cur_tipo_curso==2){
                 $("#txtt1").html('Confirmamos la recepción de la señal de reserva con la cantidad de <span id="price2"></span> euros en nuestra cuenta bancaria en concepto de Confirmación definitiva del curso descrito. 21 dias antes del comienzo de las clases debera hacer efectiva la totalidad del importe de su curso y nosotros le  entregaremos la documentacion relativa a su reserva, asi como el correspondiente material geografico y turistico de la ciudad de su eleccion y su entorno.');
                $("#txtt3").html('Estas condiciones tendran efecto contractual y permaneceran inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripcion.');
                $("#txtt2").html('Gracias por elegirnos para la realizacion de su curso y esperamos que quede satisfecho con nuestros servicios.');
            }else if(datos.cur_tipo_curso==6){
                $("#txtt1").html('Para que la reserva de plaza sea efectiva habra de ingresarse la cantidad de <span id="price2"></span> euros en la cuenta bancaria de Europa Plus s.l. antes del tercer da despues de recibir esta confirmacion. Esta cantidad sera descontada del precio final. Este documento solo sera valido adjuntando la factura del pago mencionado. La transferencia se hara a la siguiente cuenta bancaria:');
                $("#txtt3").html('El resto del importe total del programa se hara en dos partes iguales: junio y en agosto.<br> Estas condiciones tendran efecto contractual y permaneceran inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripcion.');
                $("#txtt2").html('Gracias por elegirnos para la realizacion de su curso y esperamos que quede satisfecho con nuestros servicios.'); 
            }else if(datos.cur_tipo_curso==7){
                $("#txtt1").html('Para que la reserva de plaza sea efectiva habra de ingresarse la cantidad de <span id="price2"></span> euros en la cuenta bancaria de Europa Plus s.l. antes del tercer da despues de recibir esta confirmacion. Esta cantidad sera descontada del precio final. Este documento solo sera valido adjuntando la factura del pago mencionado. La transferencia se hara a la siguiente cuenta bancaria:');
                $("#txtt3").html('El resto del importe total del programa se hara en dos partes iguales: junio y en agosto.<br> Estas condiciones tendran efecto contractual y permaneceran inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripcion.');
                $("#txtt2").html('Gracias por elegirnos para la realizacion de su curso y esperamos que quede satisfecho con nuestros servicios.'); 
            }else if(datos.cur_tipo_curso==8){
                $("#txtt1").html('Para que la reserva de plaza sea efectiva habra de ingresarse la cantidad de <span id="price2"></span> euros en la cuenta bancaria de Europa Plus s.l. antes del tercer da despues de recibir esta confirmacion. Esta cantidad sera descontada del precio final. Este documento solo sera valido adjuntando la factura del pago mencionado. La transferencia se hara a la siguiente cuenta bancaria:');
                $("#txtt3").html('El resto del importe total del programa se hara en dos partes iguales: junio y en agosto.<br> Estas condiciones tendran efecto contractual y permaneceran inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripcion.');
                $("#txtt2").html('Gracias por elegirnos para la realizacion de su curso y esperamos que quede satisfecho con nuestros servicios.'); 
            }else if(datos.cur_tipo_curso==9){
                $("#txtt1").html('Para que la reserva de plaza sea efectiva habra de ingresarse la cantidad de <span id="price2"></span> euros en la cuenta bancaria de Europa Plus s.l. antes del tercer da despues de recibir esta confirmacion. Esta cantidad sera descontada del precio final. Este documento solo sera valido adjuntando la factura del pago mencionado. La transferencia se hara a la siguiente cuenta bancaria:');
                $("#txtt3").html('El resto del importe total del programa se hara en dos partes iguales: junio y en agosto.<br> Estas condiciones tendran efecto contractual y permaneceran inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripcion.');
                $("#txtt2").html('Gracias por elegirnos para la realizacion de su curso y esperamos que quede satisfecho con nuestros servicios.'); 
            }else{
                $("#txtt1").html('Confirmamos la recepción de la señal de reserva con la cantidad de <span id="price2"></span> euros en nuestra cuenta bancaria en concepto de Confirmación definitiva del curso descrito. 21 dias antes del comienzo de las clases debera hacer efectiva la totalidad del importe de su curso y nosotros le  entregaremos la documentacion relativa a su reserva, asi como el correspondiente material geografico y turistico de la ciudad de su eleccion y su entorno.');
                $("#txtt3").html('Estas condiciones tendran efecto contractual y permaneceran inamovibles una vez efectuado el pago total del curso que arriba se detalla, mientras figuran a solo modo indicativo de la solicitud de la inscripcion.<br> ');
                $("#txtt2").html('Gracias por elegirnos para la realizacion de su curso y esperamos que quede satisfecho con nuestros servicios.');
                
            }
              let porcenta2=d.prc;
              $("#price2").html(porcenta2.toFixed(2));
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
            

            if(precioTotal!=null && precioTotal!=0){
                $("#preciocaCcc").html(precioTotal.toFixed(2)+'€');
                $(".pcacc").css('display','block');
            }else{
                $(".").css('display','none');
                precioTotal=0;
            }

            if(operacionConfirmar.opr_descuento!=null && operacionConfirmar.opr_descuento!=0){
                $("#desCf").html(operacionConfirmar.opr_descuento.toFixed(2)+'€');
                $(".pdcc").css('display','block');
            }else{
                $(".pdcc").css('display','none');
                operacionConfirmar.opr_descuento=0;
            }
            console.log("SUPLEMENTOS ",d.suplementos.precio,operacionConfirmar.vje_transfer_precio);
            if(d.suplementos.precio!=null && d.suplementos.precio!=0){
                $("#sups2Cf").html(d.suplementos.precio.toFixed(2)+'€');
                $(".pscc").css('display','block');
            }else{
                $(".pscc").css('display','none');
                d.suplementos.precio=0;
            }
            
            if(operacionConfirmar.vje_transfer_precio!=null && operacionConfirmar.vje_transfer_precio!=0){
                $("#transCf").html(operacionConfirmar.vje_transfer_precio.toFixed(2)+'€');
                $(".ptcc").css('display','block');
            }else{
                $(".ptcc").css('display','none');
                operacionConfirmar.vje_transfer_precio=0;
            }
            
            if(operacionConfirmar.vje_vuelo_precio!=null && operacionConfirmar.vje_vuelo_precio!=0){
                $("#othersCf").html(operacionConfirmar.vje_vuelo_precio.toFixed(2)+'€');
                $(".pocc").css('display','block');
            }else{
                $(".pocc").css('display','none');
                operacionConfirmar.vje_vuelo_precio=0;
            }
           
           
            let total=(precioTotal+d.suplementos.precio+operacionConfirmar.vje_vuelo_precio+operacionConfirmar.vje_transfer_precio)-operacionConfirmar.opr_descuento;
            console.log("Total "+total);
            $("#totalCCc").html(total.toFixed(2)+'€');
            
            let porcenta= (d.prc);
          
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


function printconfirmar(isPrint) {
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
    html=$("#data_info_cc .pp4");
    pivotMax=indexY+5;
    doc.setDrawColor(255, 157, 13);
    doc.line(indexX, pivot, indexX, pivotMax);
    doc.setDrawColor(0, 0, 0);
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
                       // indexY=indexY-3;
                    }
                   
        
      
        
        
        console.log(item);
    });

    // Convert HTML to PDF in JavaScript

    if(isPrint){
    doc.save("Confirmación " +operacionConfirmar.alu_nombre+" "+operacionConfirmar.alu_apellidos+ " " + getTimeV2() + " ");
}else{
    docConfirmacion=doc;
}

}
let docConfirmacion;
function confirmSinCorreoconfirmar(){
    $("#spinDiv").css("display", "flex");
    let form = new FormData();
    form.append("tipo",0);
    printconfirmar(false);
    let data =btoa(docConfirmacion.output());
    form.append('file',data);
    form.append('operacion',JSON.stringify(operacionConfirmar));
    

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
        url: $("#route_modal").val() + "/confirmar_email",
        data: form,
        success: function (data) {
            $("#spinDiv").css("display", "none");
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
            $("#spinDiv").css("display", "none");
            alertError("Error inesperado en el servidor");
        },
    });
}
function sendconfirmar() {
    $("#spinDiv").css("display", "flex");
    let form = new FormData();
    form.append("tipo",1);
    printconfirmar(false);
    let data =btoa(docConfirmacion.output());
    form.append('file',data);
    form.append('operacion',JSON.stringify(operacionConfirmar));
    
    

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
        url: $("#route_modal").val() + "/confirmar_email",
        data: form,
        success: function (data) {
            $("#spinDiv").css("display", "none");
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
            $("#spinDiv").css("display", "none");
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}


