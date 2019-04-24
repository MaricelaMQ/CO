function validaform() {
    var valido = 0;    
    $("input").each(function () {
        var contenido = $(this).val();
        var ide = $(this).attr('id');
        if (ide!="clasiarancelaria" || ide!="valorfactura" || ide!="valorfactura"){
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
    if (valido==1){
        alert("Información correcta ");
        //guardar();
    }    
}
