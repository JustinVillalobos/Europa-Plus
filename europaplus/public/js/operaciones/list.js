$( document ).ready(function() {
    $("#spinDiv").css('display','none');
  });

  function goToVuelo(id){
    window.location="./vuelo/"+id;
  }
  function goToCurso(id){
    window.location="./curso_operacion/"+id;
  }
  function goToCobros(id){
    window.location="./operacion/cobros/"+id;
  }
  function goToTransfer(id){
    console.log(id);
    window.location="./transfer/"+id;
  }
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
              console.log(data);
              $("#spinDiv").css('display','none');
              if(data=='true'){
                let rsp=alertTimeCorrect("Operación eliminada exitosamente",function(response){
                    window.location=$("#route").val();
                  });
              }else{
                alertError("Error al eliminar Operación: No se puede eliminar porque la Operación ha iniciado.");
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
function entrega_state(id){
  $("#spinDiv").css('display','flex');
           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({
            type:'POST',
            url:$("#route").val()+'/../confirmaciones/entrega_email',
            data:{id:id},
            success:function(data){
              $("#spinDiv").css('display','none');
              if(data=='true'){
                let rsp=alertTimeCorrect("Operación entregada exitosamente",function(response){
                    window.location=$("#route").val();
                  });
              }else{
                alertError("Error al entregar la operación");
              }
        
            },
            error:function(data){
                console.log("ERROR",data);
                alertError("Error inesperado en el servidor");
            }
        
         });
  
}