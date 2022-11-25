var tiv = document.getElementById("editable_textarea");
let factura={};
let empresaFactura={};
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
    sceditor.create(tiv, options);
   // $("#modal").modal('show');
  });
function loadModal(fac_id,fac_proforma){
  $("#spinDiv").css('display','flex');
  let form = {};
  form.fac_id=fac_id;
  form.proforma=fac_proforma;
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
console.log(fac_id);
  $.ajax({
    type:'POST',
    url:$("#id").val()+'/reportes/generateFactura',
    data:{factura:form},
    success:function(data){
      console.log(data);
      console.log(JSON.parse(data));
      let d =JSON.parse(data);
      console.log(d);
      let datos=d.factura[0];
     factura=datos;
     empresaFactura=d.empresa;
      $("#nombre").text(datos.alu_nombre);
      $("#apellidos").text(datos.alu_apellidos);
      $("#dir").text(datos.fac_direccion);
      $("#cp").text(datos.fac_cp);
      $("#loc").text(datos.fac_localidad);
      $("#prv").text(datos.fac_provincia);
      $("#pais").text(datos.fac_pais);
      $("#nif").text(datos.fac_cif);
      $("#numero").text(datos.fac_numero);
      $("#text-body").html(datos.fac_concepto);
      $("#total").html(datos.fac_cantidad.toFixed(2));
      $("#fac_id").val(datos.fac_id);
      sceditor.instance(tiv).val(datos.fac_concepto);
      
      setMes();
      $("#modal_factura").modal('show');
        $("#spinDiv").css('display','none');
       /* let json = JSON.parse(data);
        if(json){
            let rsp=alertTimeCorrect("Alumno Registrado exitosamente",function(response){
                limpiarFormulario();
              });
        }else{
            alertError("Error inesperado al guardar el alumno, por favor compruebe los datos");
        }*/

    },
    error:function(data){
        console.log(data);
        alertError("Error inesperado en el servidor");
    }

 });
}
$('#modal_factura').on('hidden.bs.modal', function (e) {
  closeEdition();
})


 var myModalEl = document.getElementById('modal_factura')
myModalEl.addEventListener('hidden.bs.modal', function (event) {
  closeEdition();
})
function closeModalFactura(){
    console.log("Ingresi");
  $("#modal_factura").modal('hide');
}
function setMes(){
  let date=new Date();
  console.log(date);
  let month=date.getMonth();
  let formatMonth="";
  console.log(month);
  switch(month){
    case 0:
      formatMonth="Enero";
    break;
    case 1:
      formatMonth="Febrero";
    break;
    case 2:
      formatMonth="Marzo";
    break;
    case 3:
      formatMonth="Abril";
    break;
    case 4:
      formatMonth="Mayo";
    break;
    case 5:
      formatMonth="Junio";
    break;
    case 6:
      formatMonth="Julio";
    break;
    case 7:
      formatMonth="Agosto";
    break;
    case 8:
      formatMonth="Septiembre";
    break;
    case 9:
      formatMonth="Octubre";
    break;
    case 10:
      formatMonth="Noviembre";
    break;
    case 11:
      formatMonth="Diciembre";
    break;
  }
  $("#mes").text(formatMonth);
}
  $(".modal-body .btn-primary").click(function(){
    $("#spinDiv").css('display','flex');
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
    $.ajax({
      type:'POST',
      url:$("#route").val()+'/factura',
      data:{alumno:form},
      success:function(data){
        console.log(data);
          $("#spinDiv").css('display','none');
         /* let json = JSON.parse(data);
          if(json){
              let rsp=alertTimeCorrect("Alumno Registrado exitosamente",function(response){
                  limpiarFormulario();
                });
          }else{
              alertError("Error inesperado al guardar el alumno, por favor compruebe los datos");
          }*/
  
      },
      error:function(data){
          console.log(data);
          alertError("Error inesperado en el servidor");
      }
  
   });
  });
  let initialHtml=$(".modal-footer").html();
  function editar(){
    let html =$("#text-body").html();
    console.log(html);
  
   // $("#editable_textarea").html(html);
    sceditor.instance(tiv).val(html);
    $("#text-body2").css("display",'block');
    $("#text-body").css("display",'none');
    let htmlFooter=$(".modal-footer").html();
    htmlFooter="<button class='btn btn-success' onclick='saveConcepto()'>Guardar</button>"+htmlFooter;
    $(".modal-footer").html(htmlFooter);
  }
  function closeEdition(){
    $("#text-body").css("display",'block');
    $("#text-body2").css("display",'none');
    $(".modal-footer").html(initialHtml);
  }
  function saveConcepto(){
    let val= sceditor.instance(tiv).val();
    $("#text-body").html(val);
    $("#spinDiv").css("display", "flex");
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
      let form={};
      form.concepto=val;
      factura.fac_concepto=val;
      form.factura=$("#fac_id").val();
      $.ajax({
          type: "POST",
          url: $("#route").val() + "/save_concepto",
          data: form,
          success: function (data) {
              console.log(data);
              $("#spinDiv").css("display", "none");
              let json = JSON.parse(data);
              console.log(json);
              if (data != "false" && json!=false) {
                  let rsp = alertTimeCorrect(
                      "Concepto de factura actualizado",
                      function (response) {
                          //window.location =
                            //  $("#route").val() + "/../operacion/cobros/" + $("#fac_id").val();
                      }
                  );
              } else {
                  console.log(json);
                  console.log(JSON.parse(json.opr));
                  alertError(json);
              }
          },
          error: function (data) {
              $("#spinDiv").css("display", "none");
              console.log(data);
              alertError("Error inesperado en el servidor");
          },
      });
    closeEdition();
    
    
  }
  function dottedLine(doc, xFrom, yFrom, xTo, yTo, segmentLength)
{
    // Calculate line length (c)
    var a = Math.abs(xTo - xFrom);
    var b = Math.abs(yTo - yFrom);
    var c = Math.sqrt(Math.pow(a,2) + Math.pow(b,2));

    // Make sure we have an odd number of line segments (drawn or blank)
    // to fit it nicely
    var fractions = c / segmentLength;
    var adjustedSegmentLength = (Math.floor(fractions) % 2 === 0) ? (c / Math.ceil(fractions)) : (c / Math.floor(fractions));

    // Calculate x, y deltas per segment
    var deltaX = adjustedSegmentLength * (a / c);
    var deltaY = adjustedSegmentLength * (b / c);

    var curX = xFrom, curY = yFrom;
    while (curX <= xTo && curY <= yTo)
    {
        doc.line(curX, curY, curX + deltaX, curY + deltaY);
        curX += 2*deltaX;
        curY += 2*deltaY;
    }
}
  function printFactura(isPrint){
    let date = new Date();

    var doc = new jsPDF({ orientation: "p", unit: "mm", format: "a4" });
    doc=header(doc,empresaFactura);
    var pageHeight =
        doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
    var pageWidth =
        doc.internal.pageSize.width || doc.internal.pageSize.getWidth();
        let text = "";
        doc.setFont("times", "normal");
        doc.setFontSize(12);
        let indexY=60;
        dottedLine(doc,5,indexY,pageWidth-5,indexY,1);
        indexY=indexY+5;
        doc.rect(5, indexY, 105, 60);
        subY=indexY+5;
        let col7=$(".bordered-data .col-sm-3");
        let col9=$(".bordered-data .col-sm-9");
        col7.each((i,element) => {
          let t=$(element).text();
          t=t.trim();
          console.log(t);
          doc.setFont("times", "bold");
          doc.text(t + "", 10, subY);
          doc.setFont("times", "normal");
          t=$(col9[i]).text();
          console.log(t);
          doc.text(t + "", 30, subY);
          subY=subY+7;
        });

        indexY=indexY+65;
        doc.rect(5, indexY, pageWidth-10, 15);
        subY=indexY+5;
        doc.text($(".date_").text() + "", pageWidth-70, subY);
        subY=indexY+5;
        doc.fromHTML($(".fac_info").html() + "", 10, subY);
        
        indexY=indexY+20;
        doc.setFillColor(169, 171, 172);
        doc.rect(5, indexY, pageWidth-10, 10, 'FD');
        doc.setFillColor(255, 255, 255);
        subY=indexY+5;
        doc.setFont("times", "bold");
        doc.text( "Concepto", 70, subY);
        doc.text( "Importe", pageWidth-35, subY);
        doc.setFont("times", "normal");

        indexY=indexY+10;
        
        doc.rect(5, indexY, 150, 80);
        doc.rect(155, indexY, 50, 80);
        subY=indexY-4;
        let result = factura.fac_concepto.replace(/br>/g, "br/>");
        result = result.replace(/></g, "> <");
       
        console.log(result);
          doc.fromHTML("<p>"+result+"</p>", 10, subY,{
            'width': 130,
          });
       
        


        indexY=indexY+85;
        text="Alumno";
        doc.setFont("times", "bold");
        doc.text(text + ":", 5, indexY);
        doc.setFont("times", "normal");
       
        doc.text(factura.alu_nombre+" "+factura.alu_apellidos + "", 25, indexY);
        indexY=indexY+2;
        doc.setFillColor(169, 171, 172);
        doc.rect(5, indexY, pageWidth-10, 15, 'FD');
        doc.setFillColor(255, 255, 255);
        subY=indexY-2;
        doc.fromHTML("<strong>Total</strong>" + "", 10, subY);
        doc.fromHTML("<strong>"+factura.fac_cantidad.toFixed(2) + " EUR</strong>", pageWidth-40, subY);
        subY=subY+15;
        text="IVA incluido, Régimen especial Agencias de viaje CICMA 4280";
        let textPostion = this.center(doc, text);
        doc.text(text, textPostion, subY);

        indexY=indexY+17;
        doc.rect(5, indexY, pageWidth-10, 28);
        let info=$(".bordered-data5 .col-sm-12");
        subY=indexY-2;
        info.each((i,element) => {
          let t=$(element).html();
        
          console.log(t);
          
          doc.fromHTML(t + "", 10, subY);
          console.log(subY);
          subY=subY+5;
        });
        var pageCount = doc.internal.getNumberOfPages();
        if(pageCount==3){
          doc.deletePage(pageCount);
          doc.deletePage(pageCount-1);
        }
        if(pageCount==2){
          doc.deletePage(pageCount);
        }
        
        console.log(pageCount);
        if(isPrint){
          doc.save("Factura "+factura.fac_numero+".pdf")
        }else{
          facturaDoc=doc;
        }
    
  }
  let facturaDoc;

function sendFacturaData(fac_id,fac_proforma){
  $("#spinDiv").css('display','flex');
  let form = {};
  form.fac_id=fac_id;
  form.proforma=fac_proforma;
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
console.log(fac_id);
  $.ajax({
    type:'POST',
    url:$("#id").val()+'/reportes/generateFactura',
    data:{factura:form},
    success:function(data){
      console.log(data);
      console.log(JSON.parse(data));
      let d =JSON.parse(data);
      console.log(d);
      let datos=d.factura[0];
     factura=datos;
     empresaFactura=d.empresa;
     sendFactura();
    },
    error:function(data){
        console.log(data);
        $("#spinDiv").css("display", "none");
        alertError("Error inesperado en el servidor");
    }

 });

}
  function sendFactura(){
   
    $("#spinDiv").css("display", "flex");
    let form = new FormData();
    form.append("tipo",0);
    printFactura(false);
    let data =btoa(facturaDoc.output());
    form.append('file',data);
    form.append('factura',JSON.stringify(factura));
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
      
      $.ajax({
          type: "POST",
          url: $("#route").val() + "/sendFactura",
          data: form,
          contentType:false,
          processData:false,
          cache:false,
          success: function (data) {
              console.log(data);
              $("#spinDiv").css("display", "none");
              let json = JSON.parse(data);
              console.log(json);
              if (data != "false" && json!=false) {
                  let rsp = alertTimeCorrect(
                      "Factura Enviada",
                      function (response) {
                          //window.location =
                            //  $("#route").val() + "/../operacion/cobros/" + $("#fac_id").val();
                      }
                  );
              } else {
                  console.log(json);
                  console.log(JSON.parse(json.opr));
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
    
    