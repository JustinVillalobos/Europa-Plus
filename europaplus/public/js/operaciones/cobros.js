$( document ).ready(function() {
    $("#spinDiv").css('display','none');
  });
function isNumber(n){
  try {
    let number=parseFloat(n);
    return true;
  } catch (error) {
    return false;
  }
}
  function facturar() {
    let resto=$("#restocurso").val();
    if(isNumber(resto) && resto.length!=0){
      console.log("Is valid");
      let n=parseFloat(resto).toFixed(2);
      let form={};
      form.tipo=0;
      form.resto=n;
      saveResto(form);
    }else{
      alertError("Debe llenar el campo con un valor númerico");
    }
    
    console.log(resto);
  }
  function sinfacturar(){
    let resto=$("#restocurso").val();
    if(isNumber(resto) && resto.length!=0){
      console.log("Is valid");
      let n=parseFloat(resto).toFixed(2);
      let form={};
      form.tipo=1;
      form.resto=n;
      saveResto(form);
    }else{
      alertError("Debe llenar el campo con un valor númerico");
    }
  }
  function facturarReserva(){
    let resto=$("#reserva").val();
    if(isNumber(resto) && resto.length!=0){
      console.log("Is valid");
      let n=parseFloat(resto).toFixed(2);
      let form={};
      form.tipo=0;
      form.resto=n;
      saveReserva(form);
    }else{
      alertError("Debe llenar el campo con un valor númerico");
    }
  }
  function sinfacturarReserva(){
    let resto=$("#reserva").val();
    if(isNumber(resto) && resto.length!=0){
      console.log("Is valid");
      let n=parseFloat(resto).toFixed(2);
      let form={};
      form.tipo=1;
      form.resto=n;
      saveReserva(form);
    }else{
      alertError("Debe llenar el campo con un valor númerico");
    }
  }
  
  function proforma(){
    let resto=$("#restocurso").val();
    if(isNumber(resto) && resto.length!=0){
      console.log("Is valid");
      let n=parseFloat(resto).toFixed(2);
      let form={};
      form.tipo=2;
      form.resto=n;
      saveResto(form);
    }else{
      alertError("Debe llenar el campo con un valor númerico");
    }
  }
  function abonarConFactura(){
    let resto=$("#dev").val();
    if(isNumber(resto) && resto.length!=0){
      console.log("Is valid");
      let n=parseFloat(resto).toFixed(2);
      let form={};
      form.tipo=0;
      form.resto=n;
      saveDevolucion(form);
    }else{
      alertError("Debe llenar el campo con un valor númerico");
    }
  }
  function abonarSinFactura(){
    let resto=$("#dev").val();
    if(isNumber(resto) && resto.length!=0){
      console.log("Is valid");
      let n=parseFloat(resto).toFixed(2);
      let form={};
      form.tipo=1;
      form.resto=n;
      saveDevolucion(form);
    }else{
      alertError("Debe llenar el campo con un valor númerico");
    }
  }
  function saveResto(form){
    $("#spinDiv").css("display", "flex");
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
      form.operacion_tipo=2;
      $.ajax({
          type: "POST",
          url: $("#route").val() + "/resto_curso",
          data: form,
          success: function (data) {
              console.log(data);
              $("#spinDiv").css("display", "none");
              let json = JSON.parse(data);
              console.log(json);
              if (data != "false" && json!=false) {
                  let rsp = alertTimeCorrect(
                      "Resto de curso actualizado",
                      function (response) {
                        window.location =$("#route").val() + "/../operacion/cobros/" + $("#fac_id1").val();
                      }
                  );
              } else {
                  console.log(json);
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

  function saveReserva(form){
    $("#spinDiv").css("display", "flex");
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
      form.operacion_tipo=1;
      $.ajax({
          type: "POST",
          url: $("#route").val() + "/resto_curso",
          data: form,
          success: function (data) {
              console.log(data);
              $("#spinDiv").css("display", "none");
              let json = JSON.parse(data);
              console.log(json);
              if (json.res != false ) {
                  let rsp = alertTimeCorrect(
                      "Reserva de curso actualizado",
                      function (response) {
                        window.location =$("#route").val() + "/../operacion/cobros/" +$("#fac_id1").val();
                      }
                  );
              } else {
                  console.log(json);
                  console.log(JSON.parse(json.opr));
                  alertError(json.error);
              }
          },
          error: function (data) {
              $("#spinDiv").css("display", "none");
              console.log(data);
              alertError("Error inesperado en el servidor");
          },
      });
  }
  function saveDevolucion(form){
    $("#spinDiv").css("display", "flex");
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
      form.concepto=$("#concepto").val();
      $.ajax({
          type: "POST",
          url: $("#route").val() + "/devolucion",
          data: form,
          success: function (data) {
              console.log(data);
              $("#spinDiv").css("display", "none");
              let json = JSON.parse(data);
              console.log(json);
              if (data != "false" && json!=false) {
                  let rsp = alertTimeCorrect(
                      "Resto de curso actualizado",
                      function (response) {
                          window.location =
                              $("#route").val() + "/../operacion/cobros/" + $("#fac_id").val();
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
  