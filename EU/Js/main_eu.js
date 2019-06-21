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
        var respuesta = confirm('Al publicar el formulario no se podrán realizar más cambios. \n¿Desea continuar? ')
        if (respuesta){
            validaform();
        }
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
        $("#varmodificando").val($(this).parents("tr").find('td').eq(0).html()-1);
            $("#DescMercancia").val($(this).parents("tr").find('td').eq(2).html());
            $("#ClasiArancelaria").val($(this).parents("tr").find('td').eq(3).html());
            $("#CritPreferencial").val($(this).parents("tr").find('td').eq(4).html());
            $("#ValConRegional").val($(this).parents("tr").find('td').eq(5).html());
            $("#FacturaNoDesc").val($(this).parents("tr").find('td').eq(6).html());
            $("#FechaDesc").val($(this).parents("tr").find('td').eq(7).html());
        $("#DescMercancia").focus();
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
        //limpiar();
  });

//********* LIMPIAR TABLA  DESCRIPCIÓN MERCANCIAS**/
    function limpiar() {
        $("#DescMercancia").val("");
        $("#ClasiArancelaria").val("");
        $("#ValConRegional").val("");
        $("#FacturaNoDesc").val("");
        $("#FechaDesc").val("");
    }
});
/* ######################################################### FUNCTIONS  #########################################################*/
//  MODIFICA ITEMS TABLA DECRIPCIONES
function modificando() {
    var fila = $("#varmodificando").val();
    tabla = document.getElementById("tbldescripcionmercancia");    
    for (var i = 1; i < 7; i++) {      
          tabla.rows[fila].cells[2].innerHTML = $("#DescMercancia").val().toUpperCase();
          tabla.rows[fila].cells[3].innerHTML = $("#ClasiArancelaria").val().toUpperCase();
          tabla.rows[fila].cells[4].innerHTML = $("#CritPreferencial").val();
          tabla.rows[fila].cells[5].innerHTML = $("#ValConRegional").val().toUpperCase();
          tabla.rows[fila].cells[6].innerHTML = $("#FacturaNoDesc").val().toUpperCase();
          tabla.rows[fila].cells[7].innerHTML = $("#FechaDesc").val();
      }
      switchClase(0);
      $("#DescMercancia").focus();
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
    var num = 1;
        $("#tbldescripcionmercancia tr").each(function(){
            $(this).find("td").eq(0).text(num);            
        num++;
});
    
}
//  AGREGAR VALORES A TABLA DESCRIPCIONES
function agregardescripcion(a) {
        //var filas = $("#descripcionmercancia tbody tr").length;        
                if (a == 0){  /****si a es 0, se agregan valores de inputs a tabla DESCRIPCION MERCANCIAS **/
                   
                    var DescMercancia = $("#DescMercancia").val().toUpperCase();
                    var ClasiArancelaria = $("#ClasiArancelaria").val().toUpperCase();
                    var CritPreferencial = $("#CritPreferencial").val();
                    var ValConRegional = $("#ValConRegional").val().toUpperCase();
                    var FacturaNoDesc = $("#FacturaNoDesc").val().toUpperCase();
                    var FechaDesc = $("#FechaDesc").val();
                    var PaisdeOrigen = $("#PaisdeOrigen").val();                    

                    if ( DescMercancia =='' || ClasiArancelaria =='' || CritPreferencial=='' || ValConRegional==''|| FacturaNoDesc==''|| FechaDesc==''){
                        alert("Hace falta ingresar información")}
                        else{
                            var nuevaFila = "<tr>"; //console.log('total filas ' + filas);        // nuevaFila += "<td>" + (filas + 1) + "</td>";//                            
                            nuevaFila += "<td class=''></td>"; //index tabla
                            nuevaFila += "<td class=''>" + a + "</td>";
                            nuevaFila += "<td class='descripcion'>" + DescMercancia + "</td>";
                            nuevaFila += "<td class='center '>" + ClasiArancelaria + "</td>";
                            nuevaFila += "<td class='center '>" + CritPreferencial + "</td>";
                            nuevaFila += "<td class='center '>" + ValConRegional + "</td>";
                            nuevaFila += "<td class='center facfecha'>" + FacturaNoDesc + "</td>";
                            nuevaFila += "<td class='center facfecha'>" + FechaDesc + "</td>";
                            nuevaFila += "<td class='center '>" + PaisdeOrigen + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";
                            nuevaFila += "</tr>";
                            $("#tbldescripcionmercancia").append(nuevaFila);
                            $("#DescMercancia").focus();        //limpiar();                            
                }                        
            }else{ /****si a es 1, se agregan valores de BD a tabla DESCRIPCION MERCANCIAS **/
                // console.log(detMercancias);
                $.each(detMercancias, function(i, item) {                    //console.log(item["valorfactura"]);
                            var nuevaFila = "<tr>";
                            nuevaFila += "<td class=''></td>";
                            nuevaFila += "<td class=''>" + item["ID"] + "</td>"; //id tabla descripcion mercancias
                            nuevaFila += "<td class='descripcion'>" + item["DescMercancia"] + "</td>";
                            nuevaFila += "<td class='center'>" + item["ClasiArancelaria"] +  "</td>";
                            nuevaFila += "<td class='center'>" + item["CritPreferencial"] +  "</td>";
                            nuevaFila += "<td class='center'>" + item["ValConRegional"] + "</td>";
                            nuevaFila += "<td class='center facfecha'>" + item["FacturaNoDesc"] + "</td>";
                            nuevaFila += "<td class='center facfecha'>" + item["FechaDesc"] + "</td>";
                            nuevaFila += "<td class='center'>" + item["PaisdeOrigen"] + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";
                            nuevaFila += "</tr>";
                            $("#tbldescripcionmercancia").append(nuevaFila);
                });
            }
            reordenaritems();
}
/* AGREGAR DATOS A FORMULARIO DESDE CONSULTA.PHP*/
function duplicarcert(id){
    if (id>0){
        $("#Operacion").val(detCertificado.Operacion);
        $("#NombreExp").val(detCertificado.NombreExp);
        $("#DireccionExp").val(detCertificado.DireccionExp);
        $("#TelefonoExp").val(detCertificado.TelefonoExp);
        $("#CorreoExp").val(detCertificado.CorreoExp);
        $("#FechaDesde").val(detCertificado.FechaDesde);
        $("#FechaHasta").val(detCertificado.FechaHasta);
        $("#NombrePro").val(detCertificado.NombrePro);
        $("#DireccionPro").val(detCertificado.DireccionPro);
        $("#TelefonoPro").val(detCertificado.TelefonoPro);
        $("#CorreoPro").val(detCertificado.CorreoPro);
        $("#NombreImp").val(detCertificado.NombreImp);
        $("#DireccionImp").val(detCertificado.DireccionImp);
        $("#TelefonoImp").val(detCertificado.TelefonoImp);
        $("#CorreoImp").val(detCertificado.CorreoImp);
        $("#FechaElabora").val(detCertificado.FechaElabora);
        $("#NombreAutoriza").val(detCertificado.NombreAutoriza);
        $("#CargoPersonAutoriza").val(detCertificado.CargoPersonAutoriza);
        $("#TelPersonAutoriza").val(detCertificado.TelPersonAutoriza);
        $("#FaxPersonAutoriza").val(detCertificado.FaxPersonAutoriza);
        $("#Observaciones").val(detCertificado.Observaciones);
        agregardescripcion(1);
    }    
}
// _DATOS TABLA DESCRIPCION MERCANCIAS EN ARREGLO _DETMERCANCIA_
function descripcionmerca(){
    //alert('mensaje de muestra ');
    detmercancia = [];
        $('#tbldescripcionmercancia tr').each(function () {
            var idDescmercancia = $(this).find('td').eq(1).html();// id tabla Descripcion mercancias.
            var DescMercancia = $(this).find('td').eq(2).html();
            var ClasiArancelaria = $(this).find('td').eq(3).html();
            var CritPreferencial = $(this).find('td').eq(4).html();
            var ValConRegional = $(this).find('td').eq(5).html();
            var FacturaNoDesc = $(this).find('td').eq(6).html();
            var FechaDesc = $(this).find('td').eq(7).html();
            var PaisdeOrigen = $(this).find('td').eq(8).html();
            var valor = {
                idDescmercancia,
                DescMercancia, ClasiArancelaria, CritPreferencial, ValConRegional, FacturaNoDesc, FechaDesc, PaisdeOrigen};
            detmercancia.push(valor);
            //console.log(detmercancia);
        });
        var valores = {"tabladesc": detmercancia};
        //console.log(valores);
        return valores;
}
// _DATOS FORMULARIO EN ARREGLO DATOS FORM_
function datos(){ // dATOS FORMULARIO 
    var datosform = [];
        var Operacion = $("#Operacion").val();
            var NombreExp = $("#NombreExp").val().toUpperCase();
            var DireccionExp = $("#DireccionExp").val().toUpperCase();
            var TelefonoExp = $("#TelefonoExp").val();
            var CorreoExp = $("#CorreoExp").val().toLowerCase();
            var FechaDesde = $("#FechaDesde").val();
            var FechaHasta = $("#FechaHasta").val();//toLowerCase();
            var NombrePro = $("#NombrePro").val();
            var DireccionPro = $("#DireccionPro").val().toUpperCase();
            var TelefonoPro = $("#TelefonoPro").val();
            var CorreoPro = $("#CorreoPro").val().toLowerCase();
            var NombreImp = $("#NombreImp").val().toUpperCase();
            var DireccionImp = $("#DireccionImp").val().toUpperCase();
            var TelefonoImp = $("#TelefonoImp").val();
            var CorreoImp = $("#CorreoImp").val().toLowerCase();
            var FechaElabora = $("#FechaElabora").val();
            var NombreAutoriza = $("#NombreAutoriza").val();
            var CargoPersonAutoriza = $("#CargoPersonAutoriza").val();
            var TelPersonAutoriza = $("#TelPersonAutoriza").val();
            var FaxPersonAutoriza = $("#FaxPersonAutoriza").val();
            var Observaciones = $("#Observaciones").val().toUpperCase();
            
    var dato = {
        Operacion, NombreExp, DireccionExp, TelefonoExp, CorreoExp, FechaDesde, FechaHasta, 
        NombrePro, DireccionPro, TelefonoPro, CorreoPro, NombreImp, DireccionImp, TelefonoImp, CorreoImp, FechaElabora,
        NombreAutoriza, CargoPersonAutoriza, TelPersonAutoriza, FaxPersonAutoriza, Observaciones
        };
    
    datosform.push(dato);    
    // console.log(JSON.stringify(datos));
      //console.log(datos);
    var valores = {"datosform": datosform};
     //console.log(valores);
    return valores;
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
    var descmerca = JSON.stringify(descripcionmerca())
    var json = JSON.stringify(datos()); // convierte objeto a cadena JSON lo que devuelve funcion datos()
    //console.log('funcion guardar'+ descmerca);
    __ajax(url, {"guardar": json, "items":descmerca,"estado":estado,"editar":editar,"id":id,"idborrar":idDelete}) //  , "desc": descmerca
        .done(function ( info ){
             console.log( info );// Info: respuesta del servidor
            if ( info == 1 ){
                if (estado=='BORRADOR'){
                    alert('Se ha guardado certificado');
                }else{
                    alert('Se ha publicado certificado');
                }                
                //location.href ="principal.php";
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