$( document ).ready(function() {
    $('#paises').select2();
   // var $eventSelect = $('#paises');
   // $eventSelect.on("select2:select", function (e) {  ajaxProvincias($('#paises').val());});
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
    if(cantidadErrores==0){
        let form = {};
        form.descr=nombre;
        form.pais = $('#paises').val();
        form.id = $('#id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:$("#route").val()+'/update',
            data:{provincia:form},
            success:function(data){
                let json = JSON.parse(data);
                if(json){
                    let rsp=alertTimeCorrect("Provincia actualizada exitosamente",function(response){
                        limpiarFormulario();
                      });
                }else{
                    alertError("Error inesperado al guardar la Provincia, por favor compruebe los datos");
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
    window.location =$("#route").val()+"/"+$('#id').val()+'/edit';
   
}

$('.btn-primary').click(function(){
    confirmacionEliminar("¿Desea reiniciar el formulario?", function(response) {
        if(response) {
            window.location =$("#route").val()+"/"+$('#id').val()+'/edit';
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