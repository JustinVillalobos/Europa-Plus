var textarea = document.getElementById('comentarios');


sceditor.create(textarea, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|font,removeformat|copy,cut,paste',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});
$( document ).ready(function() {
    $("#spinDiv").css('display','none');
  });
$( document ).ready(function() {
    $('#cursos').select2(
        {
            placeholder: 'Selecciona los cursos',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#sup-cur').select2(
        {
            placeholder: 'Selecciona los suplementos de los cursos',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#sup-alj').select2(
        {
            placeholder: 'Selecciona los suplementos de los alojamientos',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#alj').select2(
        {
            placeholder: 'Selecciona los alojamientos',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#idiomas').select2(
        {
            placeholder: 'Selecciona el idioma',
            allowClear: true,
            width: 'resolve'
        }
    );
    $('#paises').select2();
    $('#provincias').select2();
    $('#localidades').select2();
    var $eventSelect = $('#paises');
    $eventSelect.on("select2:select", function (e) {  ajaxProvincias($('#paises').val());});
    $eventSelect = $('#provincias');
    $eventSelect.on("select2:select", function (e) {  ajaxLocalidades($('#provincias').val());});
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
    
    let valid=false;
    /**********************************  Datos Escuela ******************************************/
    let nombre = $('#nombre').val();
    if(!stringLength(nombre,100)){
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

    let nombre_completo = $('#nombre_completo').val();
    if(!stringLength(nombre_completo,100)){
        $('#nombre_completo + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(nombre_completo.length<=0){
        $('#nombre_completo + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#nombre_completo + span').text("");
    }
    valid=false;

    let idiomas = $('#idiomas').val();
    if(idiomas.length<=0){
        $('#spanidioma').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#spanidioma').text("");
    }
    valid=false;

    let correo = $('#correo').val();
    if(!stringLength(correo,50)){
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

    let tel = $('#tel').val();
    if(!stringLength(tel,20)){
        $('#tel + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(tel.length<=0){
        $('#tel + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#tel + span').text("");
    }
    valid=false;

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

    let cPostal = $('#cPostal').val();
    if(!stringLength(cPostal,10)){
        $('#cPostal + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(cPostal.length<=0){
        $('#cPostal + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#cPostal + span').text("");
    }
    valid=false;

    let paises = $('#paises').val();

    if(paises.length<=0){
        $('#spanpaises').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#spanpaises').text("");
    }
    valid=false;

    /******************************************  DATOS CONTACTO[PRINCIPAL]  ****************************************/
    let nombre_contacto = $('#nombre_contacto').val();
    if(!stringLength(nombre_contacto,50)){
        $('#nombre_contacto + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(nombre_contacto.length<=0){
        $('#nombre_contacto + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#nombre_contacto + span').text("");
    }
    valid=false;

    let email_contacto = $('#email_contacto').val();
    if(!stringLength(email_contacto,50)){
        $('#email_contacto + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(email_contacto.length<=0){
        $('#email_contacto + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#email_contacto + span').text("");
    }
    valid=false;
    let funcion = $('#funcion').val();
    if(!stringLength(funcion,50)){
        $('#funcion + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(funcion.length<=0){
        $('#funcion + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#funcion + span').text("");
    }
    valid=false;

    let tel_contacto = $('#tel_contacto').val();
    if(!stringLength(tel_contacto,50)){
        $('#tel_contacto + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(tel_contacto.length<=0){
        $('#tel_contacto + span').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#tel_contacto + span').text("");
    }
    valid=false;

      /******************************************  DATOS CONTACTO[TRASNFER]  ****************************************/
      let nombre_contactot = $('#nombre_contactot').val();
    if(!stringLength(nombre_contactot,50)){
        $('#nombre_contactot + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#nombre_contactot + span').text("");
    }
    valid=false;

    let email_contactot = $('#email_contactot').val();
    if(!stringLength(email_contactot,50)){
        $('#email_contactot + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#email_contactot + span').text("");
    }
    valid=false;
    let funciont = $('#funciont').val();
    if(!stringLength(funciont,50)){
        $('#funciont + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#funciont + span').text("");
    }
    valid=false;

    let tel_contactot = $('#tel_contactot').val();
    if(!stringLength(tel_contactot,50)){
        $('#tel_contactot + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#tel_contactot + span').text("");
    }
    valid=false;
     /******************************************  OTROS DATOS ****************************************/
     let pagina = $('#pagina').val();
    if(!stringLength(pagina,100)){
        $('#pagina + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#pagina + span').text("");
    }
    valid=false;

    let user = $('#user').val();
    if(!stringLength(user,50)){
        $('#user + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#user + span').text("");
    }
    valid=false;

    let psw = $('#psw').val();
    if(!stringLength(psw,20)){
        $('#psw + span').text("**Demasiados caracteres");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#psw + span').text("");
    }
    valid=false;

    /******************************************  CONDICIONES ****************************************/
    let comentarios = sceditor.instance(textarea).val();
    let errores="";
    if(comentarios.length>=10000){
        errores+="La pregunta no puede exceder los 5000 caracteres";
        valid=true;
    }
    if(wordsInvalid(comentarios)){
        errores+="**Campo con palabras no permitidas";
        valid=true;
    }
    if(valid){
        $("#spancomentarios").text(errores);
    }else{
        $("#spancomentarios").text("");
    }
    valid=false;
       /******************************************  Cursos ****************************************/

       let cursos = $('#cursos').val();

    if(cursos.length<=0){
        $('#spancursos').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#spancursos').text("");
    }
    valid=false;

     /******************************************  Suplementos Cursos ****************************************/

     let supcur = $('#sup-cur').val();

    if(supcur.length<=0){
        $('#spanscursos').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#spanscursos').text("");
    }
    valid=false;

    /******************************************  Alojamientos ****************************************/

    let alj = $('#alj').val();

    if(alj.length<=0){
        $('#spanalj').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#spanalj').text("");
    }
    valid=false;

    /******************************************  Suplementos Alojamientos ****************************************/

    let supalj = $('#sup-alj').val();

    if(supalj.length<=0){
        $('#spansalj').text("**Campo Requerido");
        cantidadErrores++;
        valid=true;
    }
    if(!valid){    
        $('#spansalj').text("");
    }
    valid=false;

     /******************************************  AJAX ****************************************/
     if(cantidadErrores==0){
        $("#spinDiv").css('display','flex');
        let form={};
        form.nombre = nombre;
        form.nombre_completo =nombre_completo;
        form.idiomas=idiomas;
        form.correo=correo;
        form.tel=tel;
        form.plaza=plaza;
        form.cPostal=cPostal;
        form.paises=$("#paises").val();
        form.provincias=$("#provincias").val();
        form.localidades=$("#localidades").val();
        form.nombre_contacto=nombre_contacto;
        form.email_contacto=email_contacto;
        form.funcion=funcion;
        form.tel_contacto=tel_contacto;
        form.nombre_contactot=nombre_contactot;
        form.email_contactot=email_contactot;
        form.funciont=funciont;
        form.tel_contactot=tel_contactot;
        form.pagina=pagina;
        form.user=user;
        form.psw=psw;
        form.comentarios=comentarios;
        form.cursos = $("#cursos").val();
        form.supcur = $("#sup-cur").val();
        form.alj = $("#alj").val();
        form.supalj = $("#sup-alj").val();
        form.esc_id = $("#esc_id").val();
        console.log(form);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:$("#route").val()+'/update',
            data:{escuela:form},
            success:function(data){
                $("#spinDiv").css('display','none');
              let json = JSON.parse(data);
              if(data=='true'){
                let rsp=alertTimeCorrect("Escuela Actualizada exitosamente",function(response){
                    window.location=$("#route").val()+"/"+$("#esc_id").val()+"/edit";
                  });
              }else{
                console.log(json);
                alertError(json);
              }
             
        
            },
            error:function(data){
                console.log(data);
                alertError("Error inesperado en el servidor");
            }
        
         });
     }else{
        desplaceTop();
     }
}
function desplaceTop(){
    $("html, body,.contenedor").animate({ scrollTop: 0 }, "fast");
  }
function wordsInvalid(text){
    let count=0;
    if(text==""){
        return false;
    }
    let result = text.toLowerCase().match(/select/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/insert/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/delete/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/update/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/create procedure/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/create table/g);
    if(result!=null && result!=undefined){
        count++;
    }
    result = text.toLowerCase().match(/create trigger/g);
    if(result!=null && result!=undefined){
        count++;
    }
    console.log("RESULTADO MATCH:"+count);
    if(count==0){
        return false;
    }else{
        return true;
    }

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
function limpiarFormulario(){
    window.location=$("#route").val()+"/"+$("#esc_id").val()+"/edit";

}
$('.btn-warning').click(function(){
    confirmacionEliminar("¿Desea Salir?", function(response) {
        if(response) {
          window.location =$("#route").val()+"";
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
        url:$("#route").val()+'/../getProvincias',
        data:{pais_id:pais},
        success:function(data){
          let json = JSON.parse(data);
          setProvincias(json.provincias);
          setLocalidades(json.localidades);
    
        },
        error:function(data){
            console.log(data);
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
        url:$("#route").val()+'/../getLocalidades',
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
$('.btn-success').click(save);