function validaform() {
    var valido = 0;
    var tbldesc = $("#descripcionmercancia tbody tr").length;
    $("input").each(function () {
        var contenido = $(this).val();
        var ide = $(this).attr('id');
        console.log(ide);
        if (ide =='clasiarancelaria' || ide =='nofactura' || ide=='valorfactura'){}else{
                if (contenido == '') {
                    valido = 0;
                    alert("Hace falta ingresar información ");
                    $("#" + ide).focus();
                    return false;
                }
                else {
                    valido = 1;
                }
            }
    });

    if (valido == 1 && tbldesc>0){
        //alert("Información correcta ");
        guardar();
    }else{
        alert("No hay información en descripción de las mercancias");
        //$("#descmercancia").focus();
        }
}
// function format2(n, currency) {
//     return currency + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
//   }
  
//     $("input").blur(function(){
//       alert("This input field has lost its focus.");
//     });