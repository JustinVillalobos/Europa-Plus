var tci = document.getElementById('tci');
var tce = document.getElementById('tce');
var tic = document.getElementById('tic');
var tia = document.getElementById('tia');
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
    if($("#step").val()=="1"){
        $('#alumnos').select2(
            {
                placeholder: 'Seleccione el alumno',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#escuelas').select2(
            {
                placeholder: 'Selecciona la escuela',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#vuelo').select2(
            {
                placeholder: '',
                allowClear: true,
                width: 'resolve'
            }
        );
    }else if($("#step").val()=="2"){
        console.log("Ingreso");
        $('#cursos').select2(
            {
                placeholder: 'Selecciona un curso',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#scursos').select2(
            {
                placeholder: 'Selecciona un suplemento',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#scursos2').select2(
            {
                placeholder: 'Selecciona un suplemento',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#scursos3').select2(
            {
                placeholder: 'Selecciona un suplemento',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#alojamientos').select2(
            {
                placeholder: 'Selecciona un suplemento',
                allowClear: true,
                width: 'resolve'
            }
        );
        
          $('#salojamientos').select2(
            {
                placeholder: 'Selecciona un suplemento',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#salojamientos2').select2(
            {
                placeholder: 'Selecciona un suplemento',
                allowClear: true,
                width: 'resolve'
            }
        );
        $('#salojamientos3').select2(
            {
                placeholder: 'Selecciona un suplemento',
                allowClear: true,
                width: 'resolve'
            }
        );
        sceditor.create(tci, options);
        sceditor.create(tce, options);
        sceditor.create(tic, options);
        sceditor.create(tia, options);
        
        sceditor.instance(tci).bind('keyup', function(e) {
        
            let text = sceditor.instance(tci).val();
            console.log(text);
            $("#tci").html(text);
            localStorage.setItem('comentarios_internos',text);
        });
        sceditor.instance(tce).bind('keyup', function(e) {
        
            let text = sceditor.instance(tce).val();
            console.log(text);
            $("#tce").html(text);
            localStorage.setItem('comentarios_escuelas',text);
        });
        sceditor.instance(tic).bind('keyup', function(e) {
        
            let text = sceditor.instance(tic).val();
            console.log(text);
            localStorage.setItem('info_curso',text);
            $("#tic").html(text);
        });
        sceditor.instance(tia).bind('keyup', function(e) {
        
            let text = sceditor.instance(tia).val();
            console.log(text);
            localStorage.setItem('info_adicional',text);
            $("#tia").html(text);
        });

    }else{
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
    }
    if($("#isClear").val()==true){
        $("select").val('').change();
    }
    
  });

  function next(page){
    $("#form").submit();
  }