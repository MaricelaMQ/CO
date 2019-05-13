$(document).ready(function () {    
     if (editar==0 && id==0){
         $("#estado").html('NUEVO FORMULARIO');
     }
        else if(editar==0 && id>0){
         $("#estado").html('DUPLICANDO FORMULARIO');
     }
        else if(editar==1 && id>0){
        $("#estado").html('EDITANDO FORMULARIO');
    }
        duplicarcert(id);         
/********* BOTON PUBLICAR  **/
    $('#btpublicar').click(function () {        
        validaform();
    });
/********* BOTON GUARDAR  **/
    $("#btguardar").click(function () {        
        guardar('BORRADOR', editar, id, idDelete);
});
/********* BOTON BORRAR ITEM DESCRIPCION MERCANCIAS **/
    $(document).on('click', '.borrar', function () {
        var re = confirm('                                              ADVERTENCIA! \n Este cambio no se puede deshacer ¿Desea continuar?')
        if (re){
            var ide = $(this).parents("tr").find('td').eq(1).html();    //$(this).parents("tr").find('td').eq(1).html("-1,"+ide);
             if (ide>0 && editar>0){
                idDelete.push(ide);                
                console.log(idDelete);
                     }else{
                 console.log("no se actualiza");
                 }
            $(this).closest('tr').remove();
            }else{
            console.log("No borrado");
        }
        reordenaritems();
    });
/********** BOTON EDITAR ITEMS TABLA DESCRIPCION MERCANCIAS************* */
    $(document).on('click', '.editar', function () {
        switchClase(1);
        //var fila = $(this).parents("tr").find('td').eq(0).html();
        $("#varmodificando").val($(this).parents("tr").find('td').eq(0).html());
            $("#descmercancia").val($(this).parents("tr").find('td').eq(2).html());
            $("#clasiarancelaria").val($(this).parents("tr").find('td').eq(3).html());
            $("#nofactura").val($(this).parents("tr").find('td').eq(4).html());
            $("#valorfactura").val($(this).parents("tr").find('td').eq(5).html());
            $("#criterorigen").val($(this).parents("tr").find('td').eq(6).html());
        $("#descmercancia").focus();
    });

/********** BOTON MODIFICAR ITEMS TABLA DESCRIPCION MERCANCIAS */  
  $("#modificar").click(function () {      //$('.borrar').each  
    modificando();
    limpiar();
  });
/********** BOTON CANCELAR ***/
  $("#cancelar").click(function () {
        $("#modificar").addClass("oculto");
        $("#cancelar").addClass("oculto");
        $("#agregar").removeClass("oculto");
        $("#varmodificando").val("");
        switchClase(0);
        limpiar();
  });
//********* BOTON AGREGAR ITEM DESCRIPCION MERCANCIAS**/
  $("#agregar").click(function () {
        agregardescripcion(0);
  });
//********* LIMPIAR TABLA  DESCRIPCIÓN MERCANCIAS**/
    function limpiar() {
        $("#descmercancia").val("");
        $("#clasiarancelaria").val("")
        $("#nofactura").val("");
        $("#valorfactura").val("");
    }
});
/* ######################################################### FUNCTIONS  #########################################################*/
//  MODIFICA ITEMS TABLA DECRIPCIONES
function modificando() {
    var fila = $("#varmodificando").val();
    tabla = document.getElementById("descripcionmercancia");    
    for (var i = 1; i < 6; i++) {      
          tabla.rows[fila].cells[2].innerHTML = $("#descmercancia").val().toUpperCase();
          tabla.rows[fila].cells[3].innerHTML = $("#clasiarancelaria").val();
          tabla.rows[fila].cells[4].innerHTML = $("#nofactura").val();
          tabla.rows[fila].cells[5].innerHTML = $("#valorfactura").val();
          tabla.rows[fila].cells[6].innerHTML = $("#criterorigen").val();
      }
      switchClase(0);
      //alert($("#varmodificando").val());
          /**NUEVO CODIGO */
          
      $("#descmercancia").focus();
    }
/** AGREGA/QUITA CLASE OCULTAR  */
function switchClase(op){
if (op==1){
    $('.borrar, .editar').each(function () { 
        $(this).addClass("oculto");
    });
    $("#modificar").removeClass("oculto");
        $("#cancelar").removeClass("oculto");
        $("#agregar").addClass("oculto");
}else{
    $('.borrar, .editar').each(function () {
        $(this).removeClass("oculto");
    });
    $("#modificar").addClass("oculto");
    $("#cancelar").addClass("oculto");
    $("#agregar").removeClass("oculto");
}

}
/*  REORDENA ITEMS TABLA DESCRIPCIONES */
function reordenaritems() {
    var num = 0;
        $("#descripcionmercancia tr").each(function(){
            $(this).find("td").eq(0).text(num);
        num++;
});
    
}
//  AGREGAR VALORES A TABLA DESCRIPCIONES
function agregardescripcion(a) {
        //var filas = $("#descripcionmercancia tbody tr").length;        
                if (a == 0){  /****si a es 0, se agregan valores de inputs a tabla DESCRIPCION MERCANCIAS **/
                    var descripcion = $("#descmercancia").val().toUpperCase();
                    var clasiarancelaria = $("#clasiarancelaria").val();
                    var nofactura = $("#nofactura").val();
                    var valorfactura = $("#valorfactura").val();
                    var criterorigen = $("#criterorigen").val();

                    if ( descripcion =='' || clasiarancelaria=='' || nofactura=='' || valorfactura==''){
                        alert("Hace falta ingresar información")}
                        else{
                            var nuevaFila = "<tr>"; //console.log('total filas ' + filas);        // nuevaFila += "<td>" + (filas + 1) + "</td>";//                            
                            nuevaFila += "<td class=''></td>";
                            nuevaFila += "<td class=''>" + a + "</td>";
                            nuevaFila += "<td class='descripcion'>" + descripcion + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + clasiarancelaria + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + nofactura + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + valorfactura + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + criterorigen + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";                            
                            nuevaFila += "</tr>";
                            $("#descripcionmercancia").append(nuevaFila);
                            $("#descmercancia").focus();        //limpiar();                            
                }                        
            }else{ /****si a es 1, se agregan valores de BD a tabla DESCRIPCION MERCANCIAS **/
                console.log(detMercancias);
                $.each(detMercancias, function(i, item) {                    //console.log(item["valorfactura"]);
                            var nuevaFila = "<tr>";
                            nuevaFila += "<td class=''></td>";
                            nuevaFila += "<td class=''>" + item["ID"] + "</td>"; //id tabla descripcion mercancias
                            nuevaFila += "<td class='descripcion'>" + item["DescMercancia"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["ClasiArancelaria"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["NoFactura"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["ValorFactura"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["CriterOrigen"] + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";
                            nuevaFila += "</tr>";
                            $("#descripcionmercancia").append(nuevaFila);
                });
            }
            reordenaritems();
}

function duplicarcert(id){
    if (id>0){
        $("#operacion").val(detCertificado.operacion);
        $("#nombreexp").val(detCertificado.NombreExp);
        $("#direccionexp").val(detCertificado.DireccionExp);
        $("#telefonoexp").val(detCertificado.TelefonoExp);
        $("#faxexp").val(detCertificado.FaxExp);
        $("#correoexp").val(detCertificado.CorreoExp);
        $("#numregfiscalexp").val(detCertificado.NumRegFiscalExp);
        $("#nombrepro").val(detCertificado.NombrePro);
        $("#direccionpro").val(detCertificado.DireccionPro);
        $("#telefonopro").val(detCertificado.TelefonoPro);
        $("#faxpro").val(detCertificado.FaxPro);
        $("#correopro").val(detCertificado.CorreoPro);
        $("#numregfiscalpro").val(detCertificado.NumRegFiscalPro);
        $("#nombreimp").val(detCertificado.NombreImp);
        $("#direccionimp").val(detCertificado.DireccionImp);
        $("#telefonoimp").val(detCertificado.TelefonoImp);
        $("#faximp").val(detCertificado.FaxImp);
        $("#correoimp").val(detCertificado.CorreoImp);
        $("#numregfiscalimp").val(detCertificado.NumRegFiscalImp);
        $("#observaciones").val(detCertificado.Observaciones);
        $("#lugarexp").val(detCertificado.LugarExp);
        $("#fechaexp").val(detCertificado.FechaExp);
        //$("#lugarautocompe").val(detCertificado.LugarAutoCompe);
        //$("#fechaautocompe").val(detCertificado.FechaAutoCompe);
        $("#direccionautocompe").val(detCertificado.DireccionAutoCompe);
        $("#telefonoautocompe").val(detCertificado.TelefonoAutoCompe);
        $("#faxautocompe").val(detCertificado.FaxAutoCompe);
        $("#correoautocompe").val(detCertificado.CorreoAutoCompe);
        agregardescripcion(1);        
    }    
}
//// VALORES DESCRIPCION MERCANCIAS EN ARREGLO _DETMERCANCIA_
function detallemerca(){
    //alert('mensaje de muestra ');
    detmercancia = [];
        $('#descripcionmercancia tr').each(function () {
            var idDescmercancia = $(this).find('td').eq(1).html();// id tabla Descripcion mercancias.
            var descripcion = $(this).find('td').eq(2).html();
            var clasiarancelaria = $(this).find('td').eq(3).html();
            var nofactura = $(this).find('td').eq(4).html();
            var valorfactura = $(this).find('td').eq(5).html();
            var criterorigen = $(this).find('td').eq(6).html();
            var valor = {
                idDescmercancia,
                descripcion, clasiarancelaria, nofactura, valorfactura, criterorigen};
            detmercancia.push(valor);
            //console.log(detmercancia);
        });
        var valores = {"tabladesc": detmercancia};
        //console.log(valores);
        return valores;
}
/// VALORES DE INPUTS FORMULARIO EN ARREGLO _DATOS_
function datos(){ // dATOS FORMULARIO 
    var datos = [];
    var operacion = $("#operacion").val();
    var nombreexp = $("#nombreexp").val().toUpperCase();
    var direccionexp = $("#direccionexp").val().toUpperCase();
    var telefonoexp = $("#telefonoexp").val();
    var faxexp = $("#faxexp").val();
    var correoexp = $("#correoexp").val().toUpperCase();
    var numregfiscalexp = $("#numregfiscalexp").val();

    var nombrepro = $("#nombrepro").val().toUpperCase();
    var direccionpro = $("#direccionpro").val().toUpperCase();
    var telefonopro = $("#telefonopro").val();
    var faxpro = $("#faxpro").val();
    var correopro = $("#correopro").val();
    var numregfiscalpro = $("#numregfiscalpro").val();

    var nombreimp = $("#nombreimp").val().toUpperCase();
    var direccionimp = $("#direccionimp").val().toUpperCase();
    var telefonoimp = $("#telefonoimp").val();
    var faximp = $("#faximp").val();
    var correoimp = $("#correoimp").val().toUpperCase();
    var numregfiscalimp = $("#numregfiscalimp").val();
    
    // DATOS TABLA DESCRIPCION MERCANCIAS
    var observaciones = $("#observaciones").val().toUpperCase();
    var lugarexp = $("#lugarexp").val();
    var fechaexp = $("#fechaexp").val();
    //var lugarautocompe = $("#lugarautocompe").val().toUpperCase();
    //var fechaautocompe = $("#fechaautocompe").val();
    var direccionautocompe = $("#direccionautocompe").val().toUpperCase();
    var telefonoautocompe = $("#telefonoautocompe").val().toUpperCase();
    var faxautocompe = $("#faxautocompe").val();
    var correoautocompe = $("#correoautocompe").val().toUpperCase();

    var dato = {
        operacion, nombreexp, direccionexp, telefonoexp, faxexp, correoexp, numregfiscalexp,
        nombrepro, direccionpro, telefonopro, faxpro, correopro, numregfiscalpro,
        nombreimp, direccionimp, telefonoimp, faximp, correoimp, numregfiscalimp,
        observaciones,
        lugarexp, fechaexp,
        //lugarautocompe, fechaautocompe, 
        direccionautocompe, telefonoautocompe, faxautocompe, correoautocompe
    };
    
    datos.push(dato);    
    // console.log(JSON.stringify(datos));
      //console.log(datos);
    var valores = {"data": datos};
     //console.log("valores >" + valores);
    return valores;
    // $.ajax({
    //     method: "POST", 
    //     url: "libs/guardar.php",
    //     data: { datos: JSON.stringify(dato) },
    //     async: true,
    //     success: function (data) {
    //         console.log(data);
    //         // $("#form_procesando").hide();
    //     }
    // });

}
//  GUARDA EN BASE DE DATOS INFORMACIÓN DE FORMULARIO Y TABLA DESCRIPCION MERCANCIAS 
// FUNCION GUARDAR
function guardar(estado, editar, id, idDelete) {
//console.log(idDelete.length);
if (idDelete.length==0){
    idDelete.push(-1);
    //console.log("valor "+idDelete.length);
}
    var url = "libs/guardar.php";    
    var descmerca = JSON.stringify(detallemerca())
    var json = JSON.stringify(datos()); // convierte objeto a cadena JSON lo que devuelve funcion datos()
    //console.log('funcion guardar'+ descmerca);
    __ajax(url, {"guardar": json, "items":descmerca,"estado":estado,"editar":editar,"id":id,"idborrar":idDelete}) //  , "desc": descmerca
        .done(function ( info ){
             console.log( info );// Info: respuesta del servidor
            if ( info == 1 ){
                alert('Se ha guardado certificado con exito');
                location.href ="principal.php";
            }else{
                alert('Error al guardar registro');
            }
        })

        .fail(function(){
            alert('error al guardar');
        });
}

function __ajax(url, data) {
    var ajax = $.ajax({
        "method": "POST",
        "url": url,
        "data": data
    })
    return ajax;
}