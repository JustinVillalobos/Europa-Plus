$( document ).ready(function() {
    $("#spinDiv").css('display','none');
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
    $("select").val('').change();
  });