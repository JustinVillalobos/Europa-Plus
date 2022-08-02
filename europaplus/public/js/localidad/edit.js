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
        form.provincia = $('#provincias').val();
        form.id = $('#id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:'../../localidad/update',
            data:{localidad:form},
            success:function(data){
                let json = JSON.parse(data);
                if(json){
                    let rsp=alertTimeCorrect("Localidad Registrada exitosamente",function(response){
                        limpiarFormulario();
                      });
                }else{
                    alertError("Error inesperado al guardar la localidad, por favor compruebe los datos");
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
    window.location ="../../localidad/"+$("#id").val()+"/edit";
   
}
function setProvincias(provincias){
    console.log(provincias);
    $("#provincias").html("");
    provincias.forEach(element => {
        $("#provincias").append("<option value='"+element.prv_id+"'>"+element.prv_descr+"</option>");
    });
}
function ajaxProvincias(pais){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
        type:'GET',
        url:'../../getProvincias',
        data:{pais_id:pais},
        success:function(data){
          let json = JSON.parse(data);
          setProvincias(json.provincias);   
        },
        error:function(data){
            console.log(data);
            alertError("Error inesperado en el servidor");
        }
    
     });
}
$('#paises').change(function(){
    let pais = $('#paises').val();
    ajaxProvincias(pais);
});

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
          window.location ="../../localidad";
        }
      });
});

$('.btn-success').click(save);