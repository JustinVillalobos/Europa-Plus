@extends('../layouts.alumno')
@section('content')  
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12 d-flex justify-content-center">
        <div class="" style="padding-left:5px;">
            <h1><span>Formulario</span> de Inscripción</h1>
        </div>
    </div>
</div>
<div class="row" style="margin-top:25px;">
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DATOS DEL ALUMNO</div>
    </div>
    <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="row">
            <div class="col-sm-6 form-inline text-end">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="user" name="user">
                    <label class="mdl-textfield__label" for="sample3">Nombre Completo</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
             </div>
        </div>
        <div class="row" >
            <div class="col-sm-12 form-inline text-end" >
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label div-50">
                    <input class="mdl-textfield__input" type="text" id="dir" name="dir">
                    <label class="mdl-textfield__label" for="sample3">Dirección</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  div-25">
                    <input class="mdl-textfield__input" type="text" id="cp" name="cp">
                    <label class="mdl-textfield__label" for="sample3">CP</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label  div-25">
                    <input class="mdl-textfield__input" type="text" id="city" name="city">
                    <label class="mdl-textfield__label" for="sample3">Ciudad</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
             </div>
           
        </div>
        <div class="row" >
            <div class="col-sm-12 form-inline text-end" >
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="pvr" name="pvr">
                    <label class="mdl-textfield__label" for="sample3">Provincia</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="nation" name="nation">
                    <label class="mdl-textfield__label" for="sample3">Nacionalidad</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="tel" name="tel">
                    <label class="mdl-textfield__label" for="sample3">Teléfono</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
             </div>

        </div>
        <div class="row" >

            <div class="col-sm-12 form-inline text-end" ¿>
              
             
                 <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="email" id="email" name="email">
                    <label class="mdl-textfield__label" for="sample3">Email</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="date" id="nacimiento" name="nacimiento">
                    <label class="mdl-textfield__label" for="sample3">Fecha Nacimiento</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <input class="mdl-textfield__input" type="hidden" id="edad" name="edad" disabled>
             </div>
             
        </div>
         <div class="row" >
            <div class="col-sm-12 form-inline text-end" >
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="pasaporte" name="pasaporte">
                    <label class="mdl-textfield__label" for="sample3">N° Pasaporte</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="date" id="expedicion" name="expedicion">
                    <label class="mdl-textfield__label" for="sample3">Fecha De Expedición</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="date" id="caducidad" name="caducidad">
                    <label class="mdl-textfield__label" for="sample3">Fecha De Caducidad</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
             </div>
           
        </div>
         <div class="row" >
             <div class="col-sm-12 form-inline text-end" >
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="movil" name="movil">
                    <label class="mdl-textfield__label" for="sample3">Móvil del Alumno</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="colegio" name="colegio">
                    <label class="mdl-textfield__label" for="sample3">Colegio</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               
             </div>

        </div>
    </div>
     <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        <div class="section">DATOS DEL CURSO</div>
    </div>
    <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="idi" name="idi">
                    <label class="mdl-textfield__label" for="sample3">Idioma</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="ciudadc" name="ciudadc">
                    <label class="mdl-textfield__label" for="sample3">Ciudad</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="curso" name="curso">
                    <label class="mdl-textfield__label" for="sample3">Curso</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>


        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="date" id="del" name="del">
                    <label class="mdl-textfield__label" for="sample3">Fecha Del Curso>  Del</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="date" id="al" name="al">
                    <label class="mdl-textfield__label" for="sample3">Al</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="duracion" name="duracion">
                    <label class="mdl-textfield__label" for="sample3">Duración</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>


        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select div-select">
                <input type="text" value="" class="mdl-textfield__input input-select" id="nivel" readonly>
                <input type="hidden" value="" name="nivel">
                <label class="mdl-textfield__label label-select" for="nivel">Nivel Idioma</label>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="nivel" id="mySELECT">
                    <li class="mdl-menu__item" data-val="0">Principiante</li>
                    <li class="mdl-menu__item" data-val="1">Elemental</li>
                    <li class="mdl-menu__item" data-val="2">Intermedio</li>
                    <li class="mdl-menu__item" data-val="3">Avanzado</li>
                </ul>
            </div>
            
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select div-50 div-select">
                <input type="text" value="" class="mdl-textfield__input input-select" id="ext" readonly>
                <input type="hidden" value="" name="ext">
                <label class="mdl-textfield__label label-select" for="ext">¿Ha estado en algún curso en el extranjero?</label>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="ext" id="mySELECT">
                    <li class="mdl-menu__item" data-val="1">Si</li>
                    <li class="mdl-menu__item" data-val="0">No</li>
                 
                </ul>
            </div>
            
        </div>
        <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="section">Curso o actividades suplementarias</div>
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="sup1" name="sup1">
                    <label class="mdl-textfield__label " for="sample3">Curso o actividades suplementarias 1</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               
               
        </div> 
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="sup2" name="sup2">
                    <label class="mdl-textfield__label" for="sample3">Curso o actividades suplementarias 2</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               
               
        </div>        
         <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select w-100 div-select">
                    <input type="text" value="" class="mdl-textfield__input input-select" id="contratar" readonly>
                    <input type="hidden" value="" name="contratar">
                    <label class="mdl-textfield__label label-select" for="contratar">¿Desea contrartar el servicio de apoyo en el transbordo en aeropuerto de barajas (Coste 40 e por transbordo)?</label>
                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="contratar" id="mySELECT">
                        <li class="mdl-menu__item" data-val="1">Si</li>
                        <li class="mdl-menu__item" data-val="0">No</li>
                    
                    </ul>
                </div>
        </div>
        <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="section">DATOS DE ALOJAMIENTO</div>
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select w-100 div-select">
                    <input type="text" value="" class="mdl-textfield__input input-select" id="tipoA" readonly>
                    <input type="hidden" value="" name="tipoA">
                    <label class="mdl-textfield__label label-select" for="tipoA">Tipo de Alojamiento que desea (según las carácteristicas de alojamiento de cada curso expresadas en el programa)</label>
                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="tipoA" id="mySELECT">
                        <li class="mdl-menu__item" data-val="0">Familia</li>
                        <li class="mdl-menu__item" data-val="1">Residencia</li>
                        <li class="mdl-menu__item" data-val="2">Habitación Doble</li>
                        <li class="mdl-menu__item" data-val="3">Habitación Individual</li>
                        <li class="mdl-menu__item" data-val="4">Media pensión</li>
                        <li class="mdl-menu__item" data-val="5">Pensión completa</li>
                    </ul>
                </div>
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="date" id="del2" name="del2">
                    <label class="mdl-textfield__label" for="sample3">Fecha Del Alojamiento>  Del</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="date" id="al2" name="al2">
                    <label class="mdl-textfield__label" for="sample3">Al</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               

        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select div-50">
                <input type="text" value="" class="mdl-textfield__input" id="fuma" readonly>
                <input type="hidden" value="" name="fuma">
                <label class="mdl-textfield__label" for="fuma">¿Es usted fumador/a?</label>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="fuma" id="mySELECT">
                    <li class="mdl-menu__item" data-val="1">Si</li>
                    <li class="mdl-menu__item" data-val="0">No</li>
                 
                </ul>
            </div>
            
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select div-50 div-select">
                <input type="text" value="" class="mdl-textfield__input input-select" id="mascotas" onchange="changeMascotas()" readonly>
                <input type="hidden" value="" name="ext">
                <label class="mdl-textfield__label label-select" for="ext">¿Le importa que haya animales domésticos en la casa anfitriona?</label>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="ext" id="mySELECT">
                    <li class="mdl-menu__item" data-val="1">Si</li>
                    <li class="mdl-menu__item" data-val="0">No</li>
                 
                </ul>
            </div>
            
        </div>
        <div class="col-sm-12 form-inline text-end div-mascotas"  style="padding:10px 20px 0px 20px;display:none">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="especificar" name="especificar">
                    <label class="mdl-textfield__label" for="sample3">En su caso especificar</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               
               

        </div>
        <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="section">Método de contacto</div>
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select div-50">
                <input type="text" value="" class="mdl-textfield__input" id="contact" onchange="changeContact()"readonly>
                <input type="hidden" value="" name="contact">
                <label class="mdl-textfield__label" for="contact">¿Cómo contactó con nosotros?</label>
                <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="contact" id="mySELECT">
                    <li class="mdl-menu__item" data-val="0">Amigos</li>
                    <li class="mdl-menu__item" data-val="1">Publicidad</li>
                    <li class="mdl-menu__item" data-val="2">Tandem</li>
                    <li class="mdl-menu__item" data-val="3">Internet</li>
                    <li class="mdl-menu__item" data-val="4">Otros</li>
                </ul>
            </div>
            
        </div>
        <div class="col-sm-12 form-inline text-end div-otros"  style="padding:10px 20px 0px 20px;display:none">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="especificar2" name="especificar2">
                    <label class="mdl-textfield__label" for="sample3">Especificar</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               
               

        </div>
        <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="section">DATOS DE FAMILIA</div>
        </div>
        <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
        
        <div class="col-sm-12 form-inline text-end">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="nombrePadre" name="nombrePadre">
                    <label class="mdl-textfield__label" for="sample3">Nombre del padre</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="emailPadre" name="emailPadre">
                    <label class="mdl-textfield__label" for="sample3">Email</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="telPadre" name="telPadre">
                    <label class="mdl-textfield__label" for="sample3">Tel. Móvil</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               

        </div>
        <div class="col-sm-12 form-inline text-end">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="nombreMadre" name="nombreMadre">
                    <label class="mdl-textfield__label" for="sample3">Nombre de madre</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
        </div>
        <div class="col-sm-12 form-inline text-end"  style="padding:10px 20px 0px 20px;">
             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="emailMadre" name="emailMadre">
                    <label class="mdl-textfield__label" for="sample3">Email</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label ">
                    <input class="mdl-textfield__input" type="text" id="telMadre" name="telMadre">
                    <label class="mdl-textfield__label" for="sample3">Tel. Móvil</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
               

        </div>
        <div class="col-sm-12" style="padding:10px 20px 0px 20px;">
            <div class="section">Autorización e información médica</div>
        </div>
        <div class="col-sm-12 form-inline text-end">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="enfermedad" name="enfermedad">
                    <label class="mdl-textfield__label" for="sample3">¿Tiene usted alguna enfermedad que requira médico especial?(especificar)</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
        </div>
        <div class="col-sm-12 form-inline text-end">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="dieta" name="dieta">
                    <label class="mdl-textfield__label" for="sample3">¿Necesita seguir algún tipo de dieta?(especificar)</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
        </div>
        <div class="col-sm-12 form-inline text-end">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label w-100">
                    <input class="mdl-textfield__input" type="text" id="alergia" name="alergia">
                    <label class="mdl-textfield__label" for="sample3">¿Tiene alguna alergía?</label>
                    <span class="mdl-textfield__error">Ingresa un nombre válido</span>
                </div>
        </div>
        <div class="col-sm-12 form-inline " style="margin-top:15px">
               <p>
               AUTORIZO A EUROPA PLUS, AL MONITOR DESIGNADO COMO RESPONSABLE DE GRUPO O A LA ESCUELA A INTERVENIR SIGUIENDO EL CONSEJO DEL MÉDICO. <br>
            HE LEIDO Y ACEPTO LAS CONDICIONES DEL CONTRATO CON EUROPA PLUS IDIOMAS, ASÍ COMO LAS CONDICIONES GENERALES DE LA ESCUELA DE MI ELECCIÓN. <br>
            LOS DATOS FACILITADOS SERÁN INCORPORADOS A UNA BASE DE DATOS CREADA Y MANTENIDA DE ACUERDO CON LAS EXIGENCIAS DE LA L.O. 1.571999, DE 13 DE DICIEMBRE, DE PROTECCIÓN DE DATOS DE CARÁCTER PERSONAL. 

               </p>
        </div>
        <div class="col-sm-12 form-inline " style="margin-top:15px">
            <p>Firmar de los padres o tutores continuación:</p><br>
           
           
        </div>
        <div class="col-sm-12 form-inline d-flex justify-content-center" style="margin-top:15px">
        <canvas id="draw-canvas" width="300" height="200">
		 			No tienes un buen navegador.
		 		</canvas>
        </div>
        <div class="col-sm-12 form-inline d-flex justify-content-center" style="margin-top:15px">
            <img id="draw-image" src="" alt="Tu Imagen aparecera Aqui!"/>
        </div>
        <div class="col-sm-12 form-inline  d-flex justify-content-center" style="margin-top:15px;padding-bottom:15px;">
            <input type="button" class="button" id="draw-clearBtn" value="Borrar Canvas">
            <label>Color</label>
						<input type="color" id="color">
						<label>Tamaño Puntero</label>
						<input type="range" id="puntero" min="1" default="1" max="5" width="10%">
            
        </div>
        <div class="col-sm-12 form-inline  d-flex justify-content-center" style="margin-top:15px;padding-bottom:15px;">
            <button class="btn btn-primary" onclick="save()">Envíar</button>
        </div>
        
</div>
<?php $route2 = route("formularios.index");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script src="https://unpkg.com/jspdf-autotable@3.5.22/dist/jspdf.plugin.autotable.js"></script>
<input type="hidden" value="{{$route2}}" id="route" />
<script src="{{ URL::asset('js/operaciones/modales/header.js'); }}"></script>   
<script src="{{ URL::asset('js/formularios/formulario1.js'); }}"></script>    

@stop