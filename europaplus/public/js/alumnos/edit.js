function  stringLength(value,max){
    if(value.length<=max){
        return true;
    }else{
        return false;
    }
}
function calcularEdad(data) {
            
    fecha = data;
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    return edad
}
function preconfirm(){
    confirmacionEliminar("¿Desea Actualizar Los Datos?", function(response) {
        if(response) {
          save();
        }
      });
}
function save(){
    let cantidadErrores=0;
    let nombre = $('#nombre').val();
    let valid=false;
    /**********************************  Datos Personales ******************************************/
    if(!stringLength(nombre,50)){
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

    let fecha_nacim =$("#fecha_nacim").val();
    let edad =calcularEdad(fecha_nacim);
    if(edad<5 || fecha_nacim.length==0){
        $('#edad + span').text("**Fecha de nacimiento no válida");
        cantidadErrores++;
        valid=true;
    }else{
        $('#edad').val(edad);
    }

    if(!valid){    
        $('#edad + span').text("");
    }
    valid=false;

    let profesion = $('#profesion').val();
    if(!stringLength(profesion,50)){
        $('#profesion + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
   

    if(!valid){    
        $('#profesion + span').text("");
    }
    valid=false;


    let correo =$('#correo').val();
    
    if(!stringLength(correo,50)){
        $('#correo + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }else{
        if(correo.length>1){
            if(!validarEmail(correo)){
                $('#correo + span').text("**Correo no válido");
                cantidadErrores++;
                valid=true;
            }
        }
    }
   

    if(!valid){    
        $('#correo + span').text("");
    }
    valid=false;

    let apellidos = $('#apellidos').val();
    if(!stringLength(apellidos,50)){
        $('#apellidos + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(apellidos.length<=0){
        $('#apellidos + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#apellidos + span').text("");
    }
    valid=false;

    let pasaporte = $('#pasaporte').val();
    if(!stringLength(pasaporte,20)){
        $('#caduca + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
   

    if(!valid){    
        $('#caduca + span').text("");
    }
    valid=false;

    let caduca = $('#caduca').val();
    if(!stringLength(caduca,20)){
        $('#caduca + span').text("**Fecha no válida");
        cantidadErrores++;
        valid=true;
    }
   

    if(!valid){    
        $('#caduca + span').text("");
    }
    valid=false;
    /**********************************  Direccion ******************************************/

    let plaza = $('#plaza').val();
    if(!stringLength(plaza,100)){
        $('#plaza + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(plaza.length<=0){
        $('#plaza + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#plaza + span').text("");
    }
    valid=false;

    let codigoPostal = $('#cPostal').val();
    if(!stringLength(codigoPostal,10)){
        $('#cPostal + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(codigoPostal.length<=0){
        $('#cPostal + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }

    if(!valid){    
        $('#cPostal + span').text("");
    }
    valid=false;

     /**********************************  Otros ******************************************/
     let alergias = $('#alergias').val();
     if(!stringLength(alergias,100)){
         $('#alergias + span').text("**Demasiados caracteres");
         cantidadErrores++;
         valid=true;
     }
 
     if(!valid){    
         $('#alergias + span').text("");
     }
     valid=false;

     let nombrePadre = $('#nombrePadre').val();
     if(!stringLength(nombrePadre,100)){
         $('#nombrePadre + span').text("**Demasiados caracteres");
         cantidadErrores++;
         valid=true;
     }
 
     if(!valid){    
         $('#nombrePadre + span').text("");
     }
     valid=false;
     
     let telPadre = $('#telPadre').val();
     if(!stringLength(telPadre,100)){
         $('#telPadre + span').text("**Demasiados caracteres");
         cantidadErrores++;
         valid=true;
     }
 
     if(!valid){    
         $('#telPadre + span').text("");
     }
     valid=false;
    console.log("Cantidad de errores:"+cantidadErrores);
    
    if(cantidadErrores==0){
        let temporal = fecha_nacim.split('-');
        let form = {};
        form.nombre=nombre;
        form.apellidos=apellidos;
        form.fecha_nacim=temporal[2]+"/"+temporal[1]+"/"+temporal[0];
        form.edad=$('#edad').val();
        form.profesion=profesion;
        form.correo=correo;
        form.sexo=$("#sexo").val();
        form.pasaporte=pasaporte;
        if(caduca.length>0){
            temporal = caduca.split('-');
            form.caduca=temporal[2]+"/"+temporal[1]+"/"+temporal[0];
        }else{
            form.caduca=caduca;
        }
       
        form.plaza=plaza;
        form.paises=$("#paises").val();
        form.provincias=$("#provincias").val();
        form.localidades=$("#localidades").val();
        form.codigoPostal=codigoPostal;
        form.idiomas=$("#idiomas").val();
        form.nivel_idioma=$("#nivel_idioma").val();
        form.medioContacto=$("#medioContacto").val();
        form.alergias=alergias;
        form.nombrePadre=nombrePadre;
        form.telPadre=telPadre;
        form.id=$('#id').val();
        console.log("FORM:",form);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        console.log(form);
          $.ajax({
            type:'POST',
            url:'../../alumno/update',
            data:{alumno:form},
            success:function(data){
                let json = JSON.parse(data);
                if(json){
                    let rsp=alertTimeCorrect("Alumno Actualizado exitosamente",function(response){
                        limpiarFormulario();
                      });
                }else{
                    alertError("Error inesperado al actualizar el alumno, por favor compruebe los datos");
                }
        
            },
            error:function(data){
                alertError("Error inesperado en el servidor");
            }
        
         });
    }
}
function limpiarFormulario(){
    window.location = "../../alumno/"+$('#id').val()+'/edit';
}
function setProvincias(provincias){
    console.log(provincias);
    $("#provincias").html("");
    provincias.forEach(element => {
        $("#provincias").append("<option value='"+element.prv_id+"'>"+element.prv_descr+"</option>");
    });
}
function setLocalidades(localidades){
    $("#localidades").html("");
    localidades.forEach(element => {
        $("#localidades").append("<option value='"+element.loc_id+"'>"+element.loc_descr+"</option>");
    });
}
$('#fecha_nacim').change(function(){
    let edad =calcularEdad($('#fecha_nacim').val());
    $('#edad').val(edad);
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
          window.location ="../../alumno";
        }
      });
});
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
          setLocalidades(json.localidades);
    
        },
        error:function(data){
            console.log("ERROR",data);
            alertError("Error inesperado en el servidor");
        }
    
     });
}
function ajaxLocalidades(provincia){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
        type:'GET',
        url:'../../getLocalidades',
        data:{prv_id:provincia},
        success:function(data){
          let json = JSON.parse(data);
          setLocalidades(json.localidades);
    
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
$('#provincias').change(function(){
    let provincia = $('#provincias').val();
    ajaxLocalidades(provincia);
});
$('.btn-success').click(preconfirm);