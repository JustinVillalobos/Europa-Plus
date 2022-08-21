$( document ).ready(function() {
    $("#spinDiv").css('display','none');
  });
function update(){
    let state = $('#state').val();
    let id=$('#id').val();
    confirmacionEliminar("¿Desea Actualizar el estado del alumno?", function(response) {
        if(response) {
            $("#spinDiv").css('display','flex');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
              $.ajax({
                type:'POST',
                url:$("#route").val()+'/updateEstado',
                data:{estado:state,id:id},
                success:function(data){
                    $("#spinDiv").css('display','none');
                    let json = JSON.parse(data);
                    if(json){
                        let rsp=alertTimeCorrect("Alumno Actualizado exitosamente",function(response){
                            
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
      });
}
$('.btn-success').click(update);
