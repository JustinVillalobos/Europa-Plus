function update(){
    let state = $('#state').val();
    let id=$('#id').val();
    confirmacionEliminar("¿Desea Actualizar el estado del alumno?", function(response) {
        if(response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
              $.ajax({
                type:'POST',
                url:'../../alumno/updateEstado',
                data:{estado:state,id:id},
                success:function(data){
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
