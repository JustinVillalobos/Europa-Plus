function validate(e,form,id){
    confirmacionEliminar("¿Desea eliminar el registro?", function(response) {
        if(response) {
           // form.submit();
           // return true;
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
                console.log(data,id);
              if(data=='true'){
                let rsp=alertTimeCorrect("País eliminado exitosamente",function(response){
                    window.location=$("#route").val();
                  });
              }else{
                alertError("Error al eliminar País: No se puede eliminar porque el País ha sido utilizado en alguna provincia");
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