var textarea = document.getElementById('comentarios');


sceditor.create(textarea, {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|source|font,removeformat|copy,cut,paste',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
});
$( document ).ready(function() {
    $('.select').select2();
    var $eventSelect = $('#paises');
    $eventSelect.on("select2:select", function (e) {  ajaxProvincias($('#paises').val());});
    $eventSelect = $('#provincias');
    $eventSelect.on("select2:select", function (e) {  ajaxLocalidades($('#provincias').val());});
});

function save(){

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
    $('#paises').children().not(':first').remove();
    $('#provincias').children().not(':first').remove();

    ajaxProvincias($('#paises').val());

}
$('.btn-warning').click(function(){
    confirmacionEliminar("¿Desea Salir?", function(response) {
        if(response) {
          window.location ="../alumno";
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
        url:'../getProvincias',
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
        url:'../getLocalidades',
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