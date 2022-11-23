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
            if(operacion.vje_transfer_precio==null){
                operacion.vje_transfer_precio=0;
            }
            if(operacion.vje_vuelo_precio==null){
                operacion.vje_vuelo_precio=0;
            }
            let transfer=(operacion.vje_transfer==1)?'Si':'No';
            let precioTotal=operacion.cur_precio+operacion.alj_precio;
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
          
          

            if(precioTotal!=null && precioTotal!=0){
                $("#precioca").html(precioTotal.toFixed(2)+'€');
                $(".pca").css('display','block');
            }else{
                $(".pca").css('display','none');
                precioTotal=0;
            }
            console.log("SUPLEMENTOS ",d.suplementos.precio,operacion.vje_transfer_precio);
            if(operacion.opr_descuento!=null && operacion.opr_descuento!=0){
                $("#des").html(operacion.opr_descuento.toFixed(2)+'€');
                $(".pd").css('display','block');
            }else{
                $(".pd").css('display','none');
                operacion.opr_descuento=0;
            }
            if(d.suplementos.precio!=null && d.suplementos.precio!=0){
                $("#sups2").html(d.suplementos.precio.toFixed(2)+'€');
                $(".ps").css('display','block');
            }else{
                $(".ps").css('display','none');
                d.suplementos.precio=0;
            }
            
            if(operacion.vje_transfer_precio!=null && operacion.vje_transfer_precio!=0){
                $("#trans").html(operacion.vje_transfer_precio.toFixed(2)+'€');
                $(".pt").css('display','block');
            }else{
                $(".pt").css('display','none');
                operacion.vje_transfer_precio=0;
            }
            
            if(operacion.vje_vuelo_precio!=null && operacion.vje_vuelo_precio!=0){
                $("#others").html(operacion.vje_vuelo_precio.toFixed(2)+'€');
                $(".po").css('display','block');
            }else{
                $(".po").css('display','none');
                operacion.vje_vuelo_precio=0;
            }
           
           
            let total=(precioTotal+d.suplementos.precio+operacion.vje_vuelo_precio+operacion.vje_transfer_precio)-operacion.opr_descuento;
            console.log("Total "+total);
            $("#total").html(total.toFixed(2)+'€');
            pdf=[];
            pdf.push(d.suplementos.nombres);
            pdf.push(precioTotal+'&euro;');
            pdf.push(operacion.opr_descuento+'&euro;');
            pdf.push(d.suplementos.precio+'&euro;');
            pdf.push(operacion.vje_transfer_precio+'&euro;');
            pdf.push(operacion.vje_vuelo_precio+'&euro;');
            pdf.push(total+'&euro;');
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
let docDescription;

function print(isPrint) {
    let date = new Date();

    var doc = new jsPDF({ orientation: "p", unit: "mm", format: "a4" });
    doc=header(doc,empresa);
    var pageHeight =
        doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
    var pageWidth =
        doc.internal.pageSize.width || doc.internal.pageSize.getWidth();
        let maxLineWidth = pageWidth - 20 ;
    doc.setFontSize(16);
    doc.setFont("helvetica", "bold");
    let text = "Descripción de la solicitud de inscripción";
    let textPostion = this.center(doc, text);
    textPostion = this.center(doc, text);
    doc.text(text, textPostion, 60);
    doc.setFont("times", "normal");
    doc.setFontSize(12);
    let campos = SOLICITUD();

    let indexY = 80;
    let indexX = 40;
    let html=$("#info .pp1");
    let count=0;
    //html=""+html+"";
    html.each(function(index){
        var item=$(this).html();
        
        if(html.length-1==index){
            indexY=indexY+7;
            let s=$("#sups").html();
            s="Suplementos:"+s+"";
            console.log($(this),s);
            var textLines = doc.splitTextToSize(s, maxLineWidth-55);
            console.log("Text lines",textLines);
            textLines.forEach(element => {
                doc.text(""+element, indexX, indexY);
                indexY=indexY+7;
            });
             
        }else{
            doc.fromHTML(item + "", indexX, indexY);
            indexY=indexY+7;
        }
        
       
        count++;
        if(count==2){
            indexX = 55;
            indexY=indexY+5;
        }
        console.log(item);
    });
    html=$("#info .pp2");
    let html2=$("#info .pp3");
    indexX = 60;
    indexY=indexY+7;
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

    pivotMax=indexY+5;
    doc.setDrawColor(255, 157, 13);
    doc.line(indexX, pivot, indexX, pivotMax);
    doc.setDrawColor(0, 0, 0);
    indexY=indexY+20;
    indexX = -10;
    html=$("#info .pp4");
    html.each(function(index){
        let item=$(this).html();
        console.log(item);
        doc.text(item + "", indexX, indexY);
        indexY=indexY+20;
    });
    
    // Convert HTML to PDF in JavaScript
if(isPrint){
    doc.save("Descripción " +operacion.alu_nombre+" "+operacion.alu_apellidos+ " " + getTimeV2() + " ");
}else{
    docDescription=doc;
}
    
}
function confirmSinCorreo(){
    $("#spinDiv").css("display", "flex");
    let form = new FormData();
    form.append("tipo",0);
    print(false);
    let data =btoa(docDescription.output());
    form.append('file',data);
    form.append('operacion',JSON.stringify(operacion));
    

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
        url: $("#route_modal").val() + "/descripcion_email",
        data: form,
        success: function (data) {
          console.log(data);
          let d =JSON.parse(data);
          $("#spinDiv").css("display", "none");
          if(d.res==true){

            let rsp = alertTimeCorrect(
                "Confirmación de Descripción éxitoso",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../operacion" ;
                }
            );
          }else{
            alertError2("No se confirmó la Descripción");
          }
        },
        error: function (data) {
            console.log(data);
            $("#spinDiv").css("display", "none");
            alertError("Error inesperado en el servidor");
        },
    });
}
function send() {
    $("#spinDiv").css("display", "flex");
    let form = new FormData();
    form.append("tipo",1);
    print(false);
    let data =btoa(docDescription.output());
    form.append('file',data);
    form.append('operacion',JSON.stringify(operacion));
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
        url: $("#route_modal").val() + "/descripcion_email",
        data: form,
        success: function (data) {
            $("#spinDiv").css("display", "none");
          console.log(data);
          let d =JSON.parse(data);
          if(d.res==true){
            let rsp = alertTimeCorrect(
                "Confirmación de Descripción éxitoso",
                function (response) {
                    window.location =
                        $("#route_modal").val() + "/../../operacion" ;
                }
            );
          }else{
            alertError2("No se confirmó la Descripción");
          }
        },
        error: function (data) {
            $("#spinDiv").css("display", "none");
            console.log(data);
            alertError("Error inesperado en el servidor");
        },
    });
}
