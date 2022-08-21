
$( document ).ready(function() {
  $("#spinDiv").css('display','none');
});
function validate(e,form,id){
    console.log(id);
    confirmacionEliminar("¿Desea eliminar el registro?", function(response) {
        if(response) {
           // form.submit();
           // return true;
           $("#spinDiv").css('display','flex');
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:$("#route").val()+'/destroy',
            data:{id:id},
            success:function(data){
              $("#spinDiv").css('display','none');
                console.log(data,id);
              if(data=='true'){
                let rsp=alertTimeCorrect("Localidad eliminado exitosamente",function(response){
                    window.location=$("#route").val();
                  });
              }else{
                alertError("Error al eliminar localidad: No se puede eliminar porque la localidad ha sido utilizado en algun alumno");
              }
        
            },
            error:function(data){
                console.log("ERROR",data);
                alertError("Error inesperado en el servidor");
            }
        
         });
        }
      });
      e.preventDefault();
}