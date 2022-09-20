

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
        localStorage.setItem('info_adicional',"");
        localStorage.setItem('comentarios_internos',"");
        localStorage.setItem('comentarios_escuelas',"");
        localStorage.setItem('info_curso',"");
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
        if(localStorage.getItem('comentarios_internos')!="" && localStorage.getItem('comentarios_internos')!=undefined){
            console.log("INGRESO TCI");
            sceditor.instance(tci).val(localStorage.getItem('comentarios_internos'));

        }
        if(localStorage.getItem('comentarios_escuelas')!="" && localStorage.getItem('comentarios_escuelas')!=undefined){
            console.log("INGRESO TEC");
            sceditor.instance(tce).val(localStorage.getItem('comentarios_escuelas'));

        }
        if(localStorage.getItem('info_curso')!="" && localStorage.getItem('info_curso')!=undefined){
            console.log("INGRESO TIC");
            sceditor.instance(tic).val(localStorage.getItem('info_curso'));

        }
        if(localStorage.getItem('info_adicional')!="" && localStorage.getItem('info_adicional')!=undefined){
            console.log("INGRESO TIA");
            sceditor.instance(tia).val(localStorage.getItem('info_adicional'));

        }
        if($("#isAlojado").val()!=1){
            $("#alojamientos").val('').change();
        }
        if($("#isAlojado2").val()!=1){
            $("#salojamientos").val('').change();
        }
        if($("#isAlojado3").val()!=1){
            $("#salojamientos2").val('').change();
        }
        if($("#isAlojado4").val()!=1){
            $("#salojamientos3").val('').change();
        }
        if($("#isAlojado5").val()!=1){
            $("#scursos").val('').change();
        }
        if($("#isAlojado6").val()!=1){
            $("#scursos2").val('').change();
        }
        if($("#isAlojado7").val()!=1){
            $("#scursos3").val('').change();
        }
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
  function setSemanas() {
    console.log("Ingreso semanas");
    var iniObj = document.getElementById("fechaInit"); 
    var finObj = document.getElementById("fechaEnd");
    var nocObj = document.getElementById("numSemanas");
    if($("#fechaInit").val()=="" || $("#fechaEnd").val()==""){
        $("#numSemanas").val("0");
       $("#num").val("0");
        return;
    }
    if ( (iniObj!=null) && (finObj!=null) && (nocObj!=null) ) { 
        console.log("Ingreso semanass");
      var iniValue = new String(iniObj.value);
      var finValue = new String(finObj.value);
      
      if ( (iniValue!=null) && (finValue!=null) ) {	 
        MD_Y=iniValue.substring(6,10); MD_D=iniValue.substring(0,2); MD_M=iniValue.substring(3,5);
        var date2 = new Date(iniObj.value);      
        MD_Y=finValue.substring(6,10); MD_D=finValue.substring(0,2); MD_M=finValue.substring(3,5);
        var date1 = new Date(finObj.value);      
       var oneDay=1000 * 60 * 60 * 24 * 7;
        var difference_ms = Math.abs(date2.getTime() - date1.getTime())
        var daysDifference = Math.round(difference_ms / oneDay);
     console.log("Dias diferencia",daysDifference,difference_ms,iniValue,finValue,date2,date1);
      if (daysDifference!=null){
        console.log("Ingreso vakudacuib");
       $("#numSemanas").val(daysDifference);
       $("#num").val(daysDifference);
       console.log($("#numSemanas"));
      }else{
          nocObj.value = '';	         
      }
    }
}
  }
  function next(page){
    $("#form").submit();
  }
  function validateStep1(){
    console.log("SUBMIT");
    let fecha = $("#fecha").val();
    let alumno=$("#alumnos").val();
    let escuela=$("#escuelas").val();
    let vuelo = $("#vuelo").val();
    let cantidadErrores=0;
    console.log(fecha,alumno,escuela,vuelo);
    if(fecha.length==0){
        $('#fecha + span').text("**Campo Requerido");
        cantidadErrores++;
    }else{
        $('#fecha + span').text("");
    }
    if(alumno==null){
        $('#spanalu').text("**Campo Requerido");
        cantidadErrores++;
    }else{
        $('#spanalu').text("");
    }
    if(escuela==null){
        $('#spanescu').text("**Campo Requerido");
        cantidadErrores++;
    }else{
        $('#spanescu').text("");
    }
    if(vuelo==null){
        $('#spanvu').text("**Campo Requerido");
        cantidadErrores++;
    }else{
        $('#spanvu').text("");
    }
    if(cantidadErrores==0){
        return true;
    }
    return false;
  }
  function validateStep2(){

    let cursos = $("#cursos").val();
    let fechaInit = $("#fechaInit").val();
    let fechaEnd = $("#fechaEnd").val();
    let price = $("#price").val();
    let scursos = $("#scursos").val();
    let precios1 = $("#precios1").val();
    let scursos2 = $("#scursos2").val();
    let precios2 = $("#precios2").val();
    let scursos3 = $("#scursos3").val();
    let precios3 = $("#precios3").val();

    let desc = $("#desc").val();
    let apagar = $("#apagar").val();
    let pagado = $("#pagado").val();
    let fechaPagado = $("#fechaPagado").val();

    let alojamientos = $("#alojamientos").val();
    let fechaInit2 = $("#fechaInit2").val();
    let fechaEnd2 = $("#fechaEnd2").val();
    let price2 = $("#price2").val();
    let salojamientos = $("#salojamientos").val();
    let precios4 = $("#precios4").val();
    let salojamientos2 = $("#salojamientos3").val();
    let precios5 = $("#precios5").val();
    let salojamientos3 = $("#salojamientos3").val();
    let precios6 = $("#precios6").val();
    let comentarios_i = sceditor.instance(tci).val();
    let comentarios_e = sceditor.instance(tce).val();
    let info_a = sceditor.instance(tia).val();
    let info_cu = sceditor.instance(tic).val();
    let cantidadErrores=0;
    if(cursos==null){
        cantidadErrores++;
        $('#spancursos').text("**Campo Requerido");
    }else{
        $('#spancursos').text("");
    }
    if(fechaInit==""){
        cantidadErrores++;
        $('#fechaInit + span').text("**Campo Requerido");
    }else{
        $('#fechaInit + span').text("");
    }
    let validDate=true;
    if(fechaEnd==""){
        validDate=false;
        cantidadErrores++;
        console.log("Mal",$('#spanfechaEnd'));
        $('#spanfechaEnd').text("**Campo Requerido");
    }else{
        $('#spanfechaEnd').text("");
    }
    if(new Date(fechaInit)>new Date(fechaEnd)){
        cantidadErrores++;
        $('#spanfechaEnd').text("**Campo debe ser mayor a la fecha de inicio");
    }else{
        if(validDate){
            $('#spanfechaEnd').text("");
        }
        
    }
    if(price.length==0){
        cantidadErrores++;
        $('#price + span').text("**Campo requerido");
    }else{
        $('#price + span').text("");
    }

    if(fechaInit2!="" && fechaEnd2!=""){
        if(new Date(fechaInit2)>new Date(fechaEnd2)){
            console.log("Invalid",$('#fechaEnd2 + span'));
            cantidadErrores++;
            $('#fechaEnd2 + span').text("**Campo debe ser mayor a la fecha de inicio");
        }else{
            $('#fechaEnd2 + span').text("");
            
        }
    }else{
        $('#fechaEnd2 + span').text("");
    }
    
    if(cantidadErrores==0){
        return true;
    }else{
        return false;
    }
  }
  function validateIsNotNull(value,maxsize,type){
    if(value.length!=0){
        if(value.length>maxsize){
            return {res:false,message:"**Campo "+type+" demasiado extenso"}
        }else{
            return true;
        }
    }else{
        return true;
    }
  }
  function clearStep1(){
    confirmacionEliminar("¿Desea limpiar los campos del formulario?", function(response) {
        if(response) {
            $("select").val('').change();
            $("#fecha").val("");
        }
    });
    
  }
  function clearStep2(){
    confirmacionEliminar("¿Desea limpiar los campos del formulario?", function(response) {
        if(response) {
            $("select").val('').change();
            $("input").val("");
            $("textarea").val("");
            sceditor.instance(tci).val("");
            sceditor.instance(tce).val("");
            sceditor.instance(tia).val("");
            sceditor.instance(tic).val("");
        }
    });
    
  }
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
    alert("Final");
  }