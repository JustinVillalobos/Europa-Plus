var tiv = document.getElementById("editable_textarea");
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
      let datos =JSON.parse(data)[0];
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
    closeEdition();
    
    
  }