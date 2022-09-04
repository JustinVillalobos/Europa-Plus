$( document ).ready(function() {
    $('#paises').select2();
   // var $eventSelect = $('#paises');
   // $eventSelect.on("select2:select", function (e) {  ajaxProvincias($('#paises').val());});
});
$( document ).ready(function() {
    $("#spinDiv").css('display','none');
  });
function  stringLength(value,max){
    if(value.length<=max){
        return true;
    }else{
        return false;
    }
}
function save(){
    let cantidadErrores=0;
    let nombre = $('#descr').val();
    let valid=false;
    /**********************************  Datos Personales ******************************************/
    if(!stringLength(nombre,50)){
        $('#descr + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(nombre.length<=0){
        $('#descr + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#descr + span').text("");
    }
    valid=false;
    let prc=$("#prc").val();
    if(!stringLength(prc,50)){
        $('#prc + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(prc.length<=0){
        $('#prc + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){  
        if(parseInt(prc)<100){
            $('#prc + span').text("");
        }else{
            cantidadErrores++;
            $('#prc + span').text("Porcentaje debe ser menor a 100");
        }
        
    }
    valid=false;
    if(cantidadErrores==0){
        $("#spinDiv").css('display','flex');
        let form = {};
        form.descr=nombre;
        form.subtipo = $('#subtipo').val();
        form.prc=prc;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:$("#route").val()+'/store',
            data:{tipo:form},
            success:function(data){
                $("#spinDiv").css('display','none');
                let json = JSON.parse(data);
                if(json){
                    let rsp=alertTimeCorrect("Tipo Registrado exitosamente",function(response){
                        limpiarFormulario();
                      });
                }else{
                    alertError("Error inesperado al guardar el Tipo, por favor compruebe los datos");
                }
        
            },
            error:function(data){
                console.log(data);
                alertError("Error inesperado en el servidor");
            }
        
         });
    }
}
function limpiarFormulario(){
    $('#descr').val("");
    $('#prc').val("");
    $("#subtipo").val($("#subtipo option:first").val());
   
}

$('.btn-primary').click(function(){
    confirmacionEliminar("¿Desea reiniciar el formulario?", function(response) {
        if(response) {
            limpiarFormulario();
        }
      });
    
});
$('.btn-warning').click(function(){
    confirmacionEliminar("¿Desea Salir?", function(response) {
        if(response) {
          window.location =$("#route").val();
        }
      });
});

$('.btn-success').click(save);