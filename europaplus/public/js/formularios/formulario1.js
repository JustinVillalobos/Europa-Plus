$( document ).ready(function() {
    $("#spinDiv").css('display','none');
    $input=$( "input[type='date']" );
    $input.attr('placeholder','');
    $("select").val("");
 
  });
  $('[type=date]').change( function() {
    $(this).css('white-space','normal');
    
  });

  $("#mySELECT li").click(function(){
    console.log($(this).html());
    $("#nivel").val($(this).html());
  });

  var canvas = document.getElementById("draw-canvas");
  var submitBtn = document.getElementById("draw-submitBtn");
  var drawImage = document.getElementById("draw-image");
  var drawText = document.getElementById("draw-dataUrl");
(function () {
  // Comenzamos una funcion auto-ejecutable

  // Obtenenemos un intervalo regular(Tiempo) en la pamtalla
  window.requestAnimFrame = (function (callback) {
    return (
      window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function (callback) {
        window.setTimeout(callback, 1000 / 60);
        // Retrasa la ejecucion de la funcion para mejorar la experiencia
      }
    );
  })();

  // Traemos el canvas mediante el id del elemento html
 
  var ctx = canvas.getContext("2d");

  // Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
  
  
  var clearBtn = document.getElementById("draw-clearBtn");
 
  clearBtn.addEventListener(
    "click",
    function (e) {
      // Definimos que pasa cuando el boton draw-clearBtn es pulsado
      clearCanvas();
      drawImage.setAttribute("src", "");
      $("#draw-canvas").css("display","block");
    },
    false
  );
  // Definimos que pasa cuando el boton draw-submitBtn es pulsado
  /*submitBtn.addEventListener(
    "click",
    function (e) {
      var dataUrl = canvas.toDataURL();
      drawText.innerHTML = dataUrl;
      drawImage.setAttribute("src", dataUrl);
    },
    false
  );*/

  // Activamos MouseEvent para nuestra pagina
  var drawing = false;
  var mousePos = { x: 0, y: 0 };
  var lastPos = mousePos;
  canvas.addEventListener(
    "mousedown",
    function (e) {
      /*
      Mas alla de solo llamar a una funcion, usamos function (e){...}
      para mas versatilidad cuando ocurre un evento
    */
      var tint = document.getElementById("color");
      var punta = document.getElementById("puntero");
      console.log(e);
      drawing = true;
      lastPos = getMousePos(canvas, e);
    },
    false
  );
  canvas.addEventListener(
    "mouseup",
    function (e) {
      drawing = false;
    },
    false
  );
  canvas.addEventListener(
    "mousemove",
    function (e) {
      mousePos = getMousePos(canvas, e);
    },
    false
  );

  // Activamos touchEvent para nuestra pagina
  canvas.addEventListener(
    "touchstart",
    function (e) {
      mousePos = getTouchPos(canvas, e);
      console.log(mousePos);
      e.preventDefault(); // Prevent scrolling when touching the canvas
      var touch = e.touches[0];
      var mouseEvent = new MouseEvent("mousedown", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(mouseEvent);
    },
    false
  );
  canvas.addEventListener(
    "touchend",
    function (e) {
      e.preventDefault(); // Prevent scrolling when touching the canvas
      var mouseEvent = new MouseEvent("mouseup", {});
      canvas.dispatchEvent(mouseEvent);
    },
    false
  );
  canvas.addEventListener(
    "touchleave",
    function (e) {
      // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
      e.preventDefault(); // Prevent scrolling when touching the canvas
      var mouseEvent = new MouseEvent("mouseup", {});
      canvas.dispatchEvent(mouseEvent);
    },
    false
  );
  canvas.addEventListener(
    "touchmove",
    function (e) {
      e.preventDefault(); // Prevent scrolling when touching the canvas
      var touch = e.touches[0];
      var mouseEvent = new MouseEvent("mousemove", {
        clientX: touch.clientX,
        clientY: touch.clientY
      });
      canvas.dispatchEvent(mouseEvent);
    },
    false
  );

  // Get the position of the mouse relative to the canvas
  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    };
  }

  // Get the position of a touch relative to the canvas
  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    console.log(touchEvent);
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
      x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
      y: touchEvent.touches[0].clientY - rect.top
    };
  }

  // Draw to the canvas
  function renderCanvas() {
    if (drawing) {
      var tint = document.getElementById("color");
      var punta = document.getElementById("puntero");
      ctx.strokeStyle = tint.value;
      ctx.beginPath();
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      console.log(punta.value);
      ctx.lineWidth = punta.value;
      ctx.stroke();
      ctx.closePath();
      lastPos = mousePos;
    }
  }

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Allow for animation
  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();
})();
function getTimeV2() {
  var date = new Date();

  return GetFormattedDate(date);
}

function GetFormattedDate(date) {
  var month = ("0" + (date.getMonth() + 1)).slice(-2);
  var day = ("0" + date.getDate()).slice(-2);
  var year = date.getFullYear();
  var hour = ("0" + date.getHours()).slice(-2);
  var min = ("0" + date.getMinutes()).slice(-2);
  var seg = ("0" + date.getSeconds()).slice(-2);
  return hour + ":" + min + " " + day + "-" + month + "-" + year;
}
function center(doc, text) {
  var textWidth =
      (doc.getStringUnitWidth(text) * doc.internal.getFontSize()) /
      doc.internal.scaleFactor;
  var textOffset = (doc.internal.pageSize.width - textWidth) / 2;
  return textOffset;
}
/*Método que agrega paginación al pdf */
function addFooters(doc) {
  const pageCount = doc.internal.getNumberOfPages();
  doc.setFont("helvetica", "italic");
  doc.setFontSize(8);
  for (var i = 1; i <= pageCount; i++) {
      doc.setPage(i);
      var pageHeight =
          doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
      var pageWidth =
          doc.internal.pageSize.width || doc.internal.pageSize.getWidth();
      doc.text(
          "Página " + String(i) + " de " + String(pageCount),
          pageWidth / 2 - 8,
          pageHeight - 5,
          {
              align: "center",
          }
      );
  }
  return doc;
}


function changeMascotas(){
  let option=$("#mascotas").val();
  console.log("Cambio mascotas",$("#mascotas").val());
  if(option=="Si"){
    $(".div-mascotas").css("display","flex");
  }else{
    $(".div-mascotas").css("display","none");
  }
}
function changeContact(){
  let option=$("#contact").val();
  console.log("Cambio contact",$("#contact").val());
  if(option=="Otros"){
    $(".div-otros").css("display","flex");
  }else{
    $(".div-otros").css("display","none");
  }
}
function dottedLine(doc, xFrom, yFrom, xTo, yTo, segmentLength)
{
    // Calculate line length (c)
    var a = Math.abs(xTo - xFrom);
    var b = Math.abs(yTo - yFrom);
    var c = Math.sqrt(Math.pow(a,2) + Math.pow(b,2));

    // Make sure we have an odd number of line segments (drawn or blank)
    // to fit it nicely
    var fractions = c / segmentLength;
    var adjustedSegmentLength = (Math.floor(fractions) % 2 === 0) ? (c / Math.ceil(fractions)) : (c / Math.floor(fractions));

    // Calculate x, y deltas per segment
    var deltaX = adjustedSegmentLength * (a / c);
    var deltaY = adjustedSegmentLength * (b / c);

    var curX = xFrom, curY = yFrom;
    while (curX <= xTo && curY <= yTo)
    {
        doc.line(curX, curY, curX + deltaX, curY + deltaY);
        curX += 2*deltaX;
        curY += 2*deltaY;
    }
}
function save(){
  let valid=true;
  let contador=0;
  let nombre=$("#user").val();
  let direccion=$("#dir").val();
  let cp=$("#cp").val();
  let ciudad=$("#city").val();
  let pvr=$("#pvr").val();
  let nation=$("#nation").val();
  let tel=$("#tel").val();

  let email=$("#email").val();
  let nacimiento=$("#nacimiento").val();
  let edad=$("#edad").val();

  let pasaporte=$("#pasaporte").val();
  let expedicion=$("#expedicion").val();
  let caducidad=$("#caducidad").val();

  let movil=$("#movil").val();
  let colegio=$("#colegio").val();

  /*DATOS CURSO */
  let idi=$("#idi").val();
  let ciudadc=$("#ciudadc").val();
  let curso=$("#curso").val();

  let del=$("#del").val();
  let al=$("#al").val();
  let duracion=$("#duracion").val();

  let nivel=$("#nivel").val();
  let ext=$("#ext").val();

   /*DATOS SUPLEMENTOS */
   let sup1=$("#sup1").val();
   let sup2=$("#sup2").val();

   let contratar=$("#contratar").val();
   let tipoA=$("#tipoA").val();
   let del2=$("#del2").val();
   let al2=$("#al2").val();
   
   let fuma=$("#fuma").val();
   let mascotas=$("#mascotas").val();
   let especificar=$("#especificar").val();

   let contact=$("#contact").val();
   let especificar2=$("#especificar2").val();
   /*DATOS FAMILIA */

   let nombrePadre=$("#nombrePadre").val();
   let emailPadre=$("#emailPadre").val();
   let telPadre=$("#telPadre").val();

   let nombreMadre=$("#nombreMadre").val();
   let emailMadre=$("#emailMadre").val();
   let telMadre=$("#telMadre").val();

   /*Autorización e información médica */
   let enfermedad=$("#enfermedad").val();
   let dieta=$("#dieta").val();
   let alergia=$("#alergia").val();

  if(valid){
    contador++;
  }
  var dataUrl = canvas.toDataURL();
     // drawText.innerHTML = dataUrl;
      drawImage.setAttribute("src", dataUrl);
      $("#draw-canvas").css("display","none");
 
    let date = new Date();

    var doc = new jsPDF({ orientation: "p", unit: "mm", format: "a4" });
   
    var pageHeight =
        doc.internal.pageSize.height || doc.internal.pageSize.getHeight();
    var pageWidth =
        doc.internal.pageSize.width || doc.internal.pageSize.getWidth();
        let maxLineWidth = pageWidth - 20 ;
    doc.setFontSize(16);
    doc.setFont("helvetica", "bold");
    let text = "FORMULARIO DE INSCRIPCIÓN";
    let textPostion = this.center(doc, text);
    text = "<h1 style='font-size:40px;padding:0px;margin:0'><span style='color: rgb(247,147,29)!important;'>FORMULARIO</span> DE INSCRIPCIÓN</h1>";
    doc.fromHTML(text, textPostion-40, 0);
    doc.setFont("times", "normal");
    doc.setFontSize(8);
    let indexY=15;
    //doc.setFillColor(247,147,29);
    doc.setDrawColor(247,147,29);
    doc.rect(25, indexY, pageWidth-50, 33, 'S');
    doc.setDrawColor(255,255,255);
    doc.setFontSize(8);
    let sy=20;
    text="NOMBRE COMPLETO";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,55,sy,pageWidth-35,sy,1);
    sy=sy+5;

    text="DIRECCIÓN";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,45,sy,100,sy,1);

    text="CP";
    doc.text(text, 100, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,105,sy,130,sy,1);
    text="CIUDAD";
    doc.text(text, 130, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,145,sy,180,sy,1);
    sy=sy+5;

    text="PROVINCIA";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,45,sy,85,sy,1);

    text="NACIONALIDAD";
    doc.text(text, 85, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,105,sy,135,sy,1);
    text="TELÉFONO";
    doc.text(text, 135, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,155,sy,180,sy,1);

    sy=sy+5;

    text="EMAIL";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,35,sy,75,sy,1);

    text="FECHA NACIMIENTO";
    doc.text(text, 75, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,110,sy,145,sy,1);
    text="EDAD";
    doc.text(text, 145, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,155,sy,180,sy,1);

    sy=sy+5;

    text="N° PASAPORTE";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,45,sy,75,sy,1);

    text="FECHA EXPEDICIÓN";
    doc.text(text, 75, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,105,sy,130,sy,1);
    text="FECHA CADUCIDAD";
    doc.text(text, 130, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,160,sy,180,sy,1);
    
    sy=sy+5;

    text="MÓVIL DEL ALUMNO";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,65,sy,105,sy,1);

    text="COLEGIO";
    doc.text(text, 105, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,120,sy,180,sy,1);
  

     indexY=indexY+35;
    doc.setDrawColor(247,147,29);
    doc.rect(25, indexY, pageWidth-50, 28, 'S');
    doc.setDrawColor(255,255,255);
    sy=indexY+5;

    text="IDIOMA";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,45,sy,85,sy,1);

    text="CIUDAD";
    doc.text(text, 85, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,100,sy,135,sy,1);
    text="CURSO";
    doc.text(text, 135, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,145,sy,180,sy,1);

  


    sy=sy+5;

    text="FECHA DEL CURSO > DEL";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,70,sy,105,sy,1);
    text="Al";
    doc.text(text, 105, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,110,sy,140,sy,1);
    text="DURACIÓN";
    doc.text(text, 140, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,160,sy,180,sy,1);

    sy=sy+5;
    doc.setFontSize(8);
    text="NIVEL DE IDIOMA >";
    doc.text(text, 27, sy);
    text="PRINCIPIANTE";
    doc.text(text, 60, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(83, sy-3, 5, 5);
    
    text="ELEMENTAL";
    doc.text(text, 90, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(110, sy-3, 5, 5);

    text="INTERMEDIO";
    doc.text(text, 120, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(140, sy-3, 5, 5);

    text="AVANZADO";
    doc.text(text, 150, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(170, sy-3, 5, 5);


     sy=sy+7;
    doc.setFontSize(8);
    text="¿HA ESTADO EN ALGÚN CURSO EN EL EXTRANJERO?";
    doc.text(text, 27, sy);
    text="SI";
    doc.text(text, 110, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(114, sy-3, 5, 5);

    text="NO";
    doc.text(text, 123, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(128, sy-3, 5, 5);

    sy=sy+5;
    text="¿CUÁL?";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,35,sy,180,sy,1);
    doc.setDrawColor(0,0,0);


    indexY=indexY+30;
    doc.setDrawColor(247,147,29);
    doc.rect(25, indexY, pageWidth-50, 18, 'S');
    doc.setDrawColor(255,255,255);

    sy=indexY+5;

    doc.setFontSize(8);
    text="CURSO O ACTIVIDADES SUPLEMENTARIAS:";
    doc.text(text, 27, sy);

    doc.setFontSize(8);
    text="DESEA CONTRATAR EL SERVICIO DE APOYO EN EL";
    doc.text(text, 115, sy);

    doc.setFontSize(8);
    sy=sy+5;
    text="1.";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,30,sy,110,sy,1);
    doc.setDrawColor(0,0,0);
    text="2.";
    doc.text(text, 27, sy+5);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,30,sy+5,110,sy+5,1);
    doc.setDrawColor(0,0,0);

    doc.setFontSize(8);
    text="TRANSBORDO EN AEROPUERTO DE BARAJAS";
    doc.text(text, 115, sy);
    text="(COSTE 40 e POR TRANSBORDO)";
    doc.text(text, 115, sy+5);
    text="SI";
    doc.text(text, 160, sy+5);
    doc.setDrawColor(0,0,0);
    doc.rect(163, sy+5-3, 5, 5);

    text="NO";
    doc.text(text, 170, sy+5);
    doc.setDrawColor(0,0,0);
    doc.rect(175, sy+5-3, 5, 5);

    doc.setFontSize(9);


    indexY=indexY+20;
    doc.setDrawColor(247,147,29);
    doc.rect(25, indexY, pageWidth-50, 48, 'S');
    doc.setDrawColor(255,255,255);
    sy=indexY+5;

    doc.setFontSize(8);
    text="TIPO DE ALOJAMIENTO QUE DESESA (SEGÚN LAS CARÁCTERISTICAS DE ALOJAMIENTO DE CADA CURSO EXPRESADAS EN EL PROGRAMA)";
    var textLines = doc.splitTextToSize(text, 155);
    textLines.forEach(element => {
      doc.text(""+element, 27, sy);
      sy=sy+5;
  });
  text="FAMILIA";
  doc.text(text, 37, sy);
  doc.setDrawColor(0,0,0);
  doc.rect(50, sy-3, 5, 5);

  text="HABITACIÓN DOBLE";
  doc.text(text, 85, sy);
  doc.setDrawColor(0,0,0);
  doc.rect(115, sy-3, 5, 5);

  text="MEDIA PENSIÓN";
  doc.text(text, 145, sy);
  doc.setDrawColor(0,0,0);
  doc.rect(168, sy-3, 5, 5);

  sy=sy+7;

  text="RESIDENCIA";
  doc.text(text, 37, sy);
  doc.setDrawColor(0,0,0);
  doc.rect(55, sy-3, 5, 5);

  text="HABITACIÓN INDIVIDUAL";
  doc.text(text, 80, sy);
  doc.setDrawColor(0,0,0);
  doc.rect(115, sy-3, 5, 5);

  text="PENSIÓN COMPLETA";
  doc.text(text, 140, sy);
  doc.setDrawColor(0,0,0);
  doc.rect(168, sy-3, 5, 5);
   // doc.text(text, 27, sy);
   sy=sy+7;

   text="FECHA DEL ALOJAMIENTO > DEL";
   doc.text(text, 27, sy);
   doc.setDrawColor(247,147,29);
   dottedLine(doc,80,sy,130,sy,1);
   text="Al";
   doc.text(text, 133, sy);
   doc.setDrawColor(247,147,29);
   dottedLine(doc,135,sy,180,sy,1);

   sy=sy+5;
   text="¿ES USTED FUMADOR/A?";
    doc.text(text, 27, sy);
    text="SI";
    doc.text(text, 63, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(68, sy-3, 5, 5);

    text="NO";
    doc.text(text, 80, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(85, sy-3, 5, 5);



    sy=sy+5;
   text="¿ES IMPORTANTE PARA USTED QUE HAYA ANIMALES DOMÉSTICOS EN LA CASA ANFITRIONA?";
    doc.text(text, 27, sy);
    text="SI";
    doc.text(text, 155, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(160, sy-3, 5, 5);

    text="NO";
    doc.text(text, 170, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(175, sy-3, 5, 5);

    sy=sy+7;
    text="EN SU CASO ESPECIFICAR";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,65,sy,180,sy,1);
    doc.setDrawColor(0,0,0);



    indexY=indexY+50;
    doc.setDrawColor(247,147,29);
    doc.rect(25, indexY, pageWidth-50, 14, 'S');
    doc.setDrawColor(255,255,255);

    sy=indexY+5;

    text="¿CÓMO CONTACTÓ CON NOSOTROS?";
    doc.text(text, 27, sy);
    sy=sy+5;

    text="AMIGOS";
    doc.text(text, 27, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(39, sy-3, 5, 5);

    text="PUBLICIDAD";
    doc.text(text, 50, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(68, sy-3, 5, 5);

    text="TANDEM";
    doc.text(text, 80, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(92, sy-3, 5, 5);

    text="INTERNET";
    doc.text(text, 100, sy);
    doc.setDrawColor(0,0,0);
    doc.rect(115, sy-3, 5, 5);

    text="OTROS";
    doc.text(text, 123, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,132,sy,180,sy,1);
    doc.setDrawColor(0,0,0);

    doc.setFontSize(8);
  indexY=indexY+15;

  sy=indexY+5;
  text="NOMBRE DEL PADRE";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,65,sy,180,sy,1);
    doc.setDrawColor(0,0,0);

    sy=sy+5;
    text="EMAIL";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,37,sy,100,sy,1);
    doc.setDrawColor(0,0,0);

    text="TÉL. MÓVIL";
    doc.text(text, 101, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,120,sy,180,sy,1);
    doc.setDrawColor(0,0,0);

    sy=sy+5;
    text="NOMBRE DE LA MADRE";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,65,sy,180,sy,1);
    doc.setDrawColor(0,0,0);

    sy=sy+5;
    text="EMAIL";
    doc.text(text, 27, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,37,sy,100,sy,1);
    doc.setDrawColor(0,0,0);

    text="TÉL. MÓVIL";
    doc.text(text, 101, sy);
    doc.setDrawColor(247,147,29);
    dottedLine(doc,120,sy,180,sy,1);
    doc.setDrawColor(0,0,0);


    let subY=indexY+22;
    

  doc.setFontSize(8);
    doc.setDrawColor(247,147,29);
    doc.rect(25, subY, pageWidth-50, 75, 'S');
    doc.setDrawColor(255,255,255);
    text="AUTORIZACIÓN E INFORMACIÓN MÉDICA";
    subY=subY+5;
    doc.text(text, 27, subY);

    text="¿TIENE USTED ALGUNA ENFERMEDAD QUE REQUIRA MÉDICO ESPECIAL? (ESPECIFICAR)";
    subY=subY+5;
    doc.text(text, 27, subY);
    subY=subY+5;
    doc.setDrawColor(247,147,29);
    dottedLine(doc,27,subY,180,subY,1);
    doc.setDrawColor(0,0,0);

    text="¿NECESITA SEGUIR ALGÚN TIPO DE DIETA? (ESPECIFICAR)";
    subY=subY+5;
    doc.text(text, 27, subY);
    subY=subY+5;
    doc.setDrawColor(247,147,29);
    dottedLine(doc,27,subY,180,subY,1);
    doc.setDrawColor(0,0,0);

    text="¿TIENE ALGUNA ALERGIA? (ESPECIFICAR)";
    subY=subY+5;
    doc.text(text, 27, subY);
    
    doc.setDrawColor(247,147,29);
    dottedLine(doc,80,subY,180,subY,1);
    doc.setDrawColor(0,0,0);
     doc.setFontSize(7);
     subY=subY+5;
    text=" AUTORIZO A EUROPA PLUS, AL MONITOR DESIGNADO COMO RESPONSABLE DE GRUPO O A LA ESCUELA A INTERVENIR SIGUIENDO EL CONSEJO DEL MÉDICO.";
    var textLines = doc.splitTextToSize(text, 155);
    console.log("Text lines",textLines);
    textLines.forEach(element => {
        doc.text(""+element, 27, subY);
        subY=subY+7;
    });
    text=" HE LEIDO Y ACEPTO LAS CONDICIONES DEL CONTRATO CON EUROPA PLUS IDIOMAS, ASÍ COMO LAS CONDICIONES GENERALES DE LA ESCUELA DE MI ELECCIÓN.";
    var textLines = doc.splitTextToSize(text, 155);
    console.log("Text lines",textLines);
    textLines.forEach(element => {
        doc.text(""+element, 27, subY);
        subY=subY+7;
    });
    text=" LOS DATOS FACILITADOS SERÁN INCORPORADOS A UNA BASE DE DATOS CREADA Y MANTENIDA DE ACUERDO CON LAS EXIGENCIAS DE LA L.O. 1.571999, DE 13 DE DICIEMBRE, DE PROTECCIÓN DE DATOS DE CARÁCTER PERSONAL. ";
    var textLines = doc.splitTextToSize(text, 155);
    console.log("Text lines",textLines);
    textLines.forEach(element => {
        doc.text(""+element, 27, subY);
        subY=subY+7;
    });
    subY=subY+3;
    doc.setFontSize(8);
    text="FIRMA DE LOS PADRES O TUTORES";

    doc.text(text, 27, subY);
    let d=getTimeV3(date);
    text="FECHA:   "+d;

    doc.text(text, 150, subY);
    dottedLine(doc,160,subY,180,subY,1);
    doc.addImage(dataUrl, 'png', 27, pageHeight-30, 40, 25);
    doc.save("Formulario1.pdf");
}