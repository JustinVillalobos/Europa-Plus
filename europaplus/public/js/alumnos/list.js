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
            url:'./alumno/destroy',
            data:{id:id},
            success:function(data){
              if(data==true){
                let rsp=alertTimeCorrect("Alumno eliminado exitosamente",function(response){
                    window.location="../alumno";
                  });
              }else{
                alertError("Error al eliminar alumno: No se puede eliminar porque el alumno ha sido o es parte de una operación");
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