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
            url:'./alojamientos/destroy',
            data:{id:id},
            success:function(data){
                console.log(data,id);
              if(data=='true'){
                let rsp=alertTimeCorrect("Alojamiento eliminado exitosamente",function(response){
                    window.location="../alojamientos";
                  });
              }else{
                alertError("Error al eliminar Alojamiento: No se puede eliminar porque el Alojamiento ha sido utilizado en alguna operación");
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