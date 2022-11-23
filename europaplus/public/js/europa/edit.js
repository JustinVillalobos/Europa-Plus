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
    let nombre = $('#nombre').val();
    let valid=false;
    /**********************************  Datos Personales ******************************************/
    if(!stringLength(nombre,150)){
        $('#nombre + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(nombre.length<=0){
        $('#nombre + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#nombre + span').text("");
    }
    valid=false;

    let correo = $('#correo').val();
    if(!stringLength(correo,150)){
        $('#correo + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(correo.length<=0){
        $('#correo + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#correo + span').text("");
    }
    valid=false;

    let sitio_web = $('#sitio_web').val();
    if(!stringLength(sitio_web,150)){
        $('#sitio_web + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(sitio_web.length<=0){
        $('#sitio_web + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#sitio_web + span').text("");
    }
    valid=false;

    let telefono = $('#telefono').val();
    if(!stringLength(telefono,20)){
        $('#telefono + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(telefono.length<=0){
        $('#telefono + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#telefono + span').text("");
    }
    valid=false;

    let whatsapp = $('#whatsapp').val();
    if(!stringLength(whatsapp,20)){
        $('#whatsapp + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(whatsapp.length<=0){
        $('#whatsapp + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#whatsapp + span').text("");
    }
    valid=false;


    let codigo_postal = $('#codigo_postal').val();
    if(!stringLength(codigo_postal,50)){
        $('#codigo_postal + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(codigo_postal.length<=0){
        $('#codigo_postal + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#codigo_postal + span').text("");
    }
    valid=false;


    let direccion = $('#direccion').val();
    if(!stringLength(direccion,250)){
        $('#direccion + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(direccion.length<=0){
        $('#direccion + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#direccion + span').text("");
    }
    valid=false;

    let banco = $('#banco').val();
    if(!stringLength(banco,50)){
        $('#banco + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(banco.length<=0){
        $('#banco + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#banco + span').text("");
    }
    valid=false;

    let iban = $('#iban').val();
    if(!stringLength(iban,50)){
        $('#iban + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(iban.length<=0){
        $('#iban + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#iban + span').text("");
    }
    valid=false;
    let swift = $('#swift').val();
    if(!stringLength(swift,50)){
        $('#swift + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(swift.length<=0){
        $('#swift + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#swift + span').text("");
    }
    valid=false;

    let direccion_banco = $('#direccion_banco').val();
    if(!stringLength(direccion_banco,50)){
        $('#direccion_banco + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(direccion_banco.length<=0){
        $('#direccion_banco + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#direccion_banco + span').text("");
    }
    valid=false;


    if(cantidadErrores==0){
        let form = {};
        form.nombre=nombre;
        form.correo=correo;
        form.telefono=telefono;
        form.whatsapp=whatsapp;
        form.sitio_web=sitio_web;
        form.direccion=direccion;
        form.codigo_postal=codigo_postal;
        form.banco=banco;
        form.iban=iban;
        form.swift=swift;
        form.direccion_banco=direccion_banco;
        $("#spinDiv").css('display','flex');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:$("#route").val()+'/update',
            data:form,
            success:function(data){
                $("#spinDiv").css('display','none');
                let json = JSON.parse(data);
                console.log(data);
                if(json){
                    let rsp=alertTimeCorrect("Europa Plus actualizado exitosamente",function(response){
                        window.location =$("#route").val();
                      });
                }else{
                    alertError("Error inesperado al guardar la información, por favor compruebe los datos");
                }
        
            },
            error:function(data){
                console.log(data);
                $("#spinDiv").css('display','none');
                alertError("Error inesperado en el servidor");
            }
        
         });
    }
}


$('.btn-warning').click(function(){
    confirmacionEliminar("¿Desea Salir?", function(response) {
        if(response) {
          window.location =$("#route").val();
        }
      });
});

$('.btn-success').click(save);