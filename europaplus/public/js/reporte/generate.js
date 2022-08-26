$( document ).ready(function() {
    $("#spinDiv").css('display','none');
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
    url:$("#route").val()+'/generateFactura',
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

      
      setMes();
      $("#modal").modal('show');
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
function closeModal(){
  $("#modal").modal('hide');
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
  $(".btn-primary").click(function(){
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