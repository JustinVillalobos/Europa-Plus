$( document ).ready(function() {
  $("#spinDiv").css('display','none');
});
function validate(e,form,id){
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
              if(data=='true'){
                let rsp=alertTimeCorrect("Escuela eliminada exitosamente",function(response){
                   // window.location=$("#route").val();
                  });
              }else{
                alertError("Error al eliminar la escuela: No se puede eliminar porque la escuela ha sido utilizado en alguna operación");
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