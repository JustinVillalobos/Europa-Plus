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
      form.tipo=0;
      form.resto=n;
      saveResto(form);
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
  function saveResto(form){
    $("#spinDiv").css("display", "flex");
      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
      });
      $.ajax({
          type: "POST",
          url: $("#route").val() + "/resto_curso",
          data: form,
          success: function (data) {
              console.log(data);
              $("#spinDiv").css("display", "none");
              let json = JSON.parse(data);
              if (data != "false" && json.opr_id!=undefined) {
                  let rsp = alertTimeCorrect(
                      "Resto de curso actualizado",
                      function (response) {
                          window.location =
                              $("#route").val() + "/operacion/costos/" + json.opr_id;
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
