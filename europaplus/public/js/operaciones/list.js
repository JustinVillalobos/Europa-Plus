$( document ).ready(function() {
    $("#spinDiv").css('display','none');
  });

  function goToVuelo(id){
    alert(id);
    window.location="./vuelo";
  }
  
  function goToTransfer(id){
    alert(id);
    window.location="./transfer";
  }