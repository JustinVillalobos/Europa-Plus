@extends('../layouts.loginAlumno')
@section('content')  

<div class="signin">
    <div class="back-img" >
      <div class="sign-in-text">
        <img src="{{URL::asset('assets/logo.png');}}" style="width: 250px;"/>
      </div><!--/.sign-in-text-->
      <div class="layer">
      </div><!--/.layer-->
      <p class="point">&#9650;</p>
    </div><!--/.back-img-->
    <div class="form-section">
     
      <form method="POST" action="{{route('loginAlumno.loginValidator')}}" onsubmit ="return validateLogin()">
      @method("POST")
                            @csrf
        <!--Email-->
        <div class="text-danger font-weight-bold">
            <?php if(!empty( $_SESSION["errorBD"])){echo  $_SESSION["errorBD"];}?>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="email" id="user" name="user">
          <label class="mdl-textfield__label" for="sample3">Email</label>
          <span class="mdl-textfield__error">Ingresa un Email válido</span>
        </div>
        <br/>
        <br/>
        <!--Password-->
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input pattern=".{8,}" class="mdl-textfield__input" type="password" name="pass" id="pass">
          <label class="mdl-textfield__label" for="sample3">Contraseña</label>
          <span class="mdl-textfield__error">Mínimo 8 carácteres</span>
        </div>
        
      </label>
      <button type="submit"class="sign-in-btn mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--raised btn-primary2">
      Ingresar
    </button><!--/button-->
      </form>
    </div><!--/.form-section-->
    
    
 </div><!--/.signin-->
@stop