var tii = document.getElementById('tii');
var tiv = document.getElementById('tiv');
let options = {
	format: 'bbcode',
    plugins: 'undo',
    icons: 'monocons',
   
	toolbar: 'bold,italic,underline|font,removeformat|copy,cut,paste',
	style: 'https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/content/default.min.css',
    locale: 'no-NB',
    emoticonsEnabled:false
}
$( document ).ready(function() {
    $("#spinDiv").css('display','none');
    sceditor.create(tii, options);
    sceditor.create(tiv, options);
    
    sceditor.instance(tii).bind('keyup', function(e) {
    
        let text = sceditor.instance(tii).val();
        console.log(text);
        $("#tii").html(text);
        localStorage.setItem('info_ida',text);
    });
    sceditor.instance(tiv).bind('keyup', function(e) {
    
        let text = sceditor.instance(tiv).val();
        console.log(text);
        $("#tiv").html(text);
        localStorage.setItem('info_vuelta',text);
    });
  });
  function clearStep3(){
    confirmacionEliminar("¿Desea limpiar los campos del formulario?", function(response) {
        if(response) {
            $("select").val( $("select option:first").val());
            $("input").val("");
            $("textarea").val("");
            sceditor.instance(tii).val("");
            sceditor.instance(tiv).val("");
        }
    });
    
  }
  function Finally(value){
    
    let form = {
        Transfer:$("#Transfer").val(),
        tipot:$("#tipot").val(),
        pricet:$("#pricet").val(),
        costot:$("#costot").val(),
        fsalidav2:$("#fsalidav2").val(),
        hsalidav2:$("#hsalidav2").val(),
        fllegadav2:$("#fllegadav2").val(),
        hllegadav2:$("#hllegadav2").val(),
        estacionv2:$("#estacionv2").val(),
        numerov2:$("#numerov2").val(),
        numerov:$("#numerov").val(),
        locv2:$("#locv2").val(),
        fsalidav:$("#fsalidav").val(),
        hsalidav:$("#hsalidav").val(),
        hllegadav:$("#hllegadav").val(),
        fllegadav:$("#fllegadav").val(),
        estacionv:$("#estacionv").val(),
        numerov3:$("#numerov3").val(),
        linea2:$("#linea2").val(),
        linea:$("#linea").val(),
        locv:$("#locv").val(),
        informacionId: sceditor.instance(tii).val(),
        informacionVuelta:sceditor.instance(tiv).val(),
    };

    console.log(form);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      $.ajax({
        type:'POST',
        url:$("#route").val()+'/transferSave',
        data:form,
        success:function(data){
            console.log(data);
            $("#spinDiv").css('display','none');
          let json = JSON.parse(data);
          if(data!='false'){
            let rsp=alertTimeCorrect("Información de transferencia Actualizada exitosamente",function(response){
                window.location=$("#route").val()+"/../transfer/"+json.opr_id;
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
    
  }