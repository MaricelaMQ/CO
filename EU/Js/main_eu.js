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
        $("#naladisa").val("");
        $("#descmercancia").val("")
        $("#pesocantidad").val("");
        $("#valorfob").val("");
        $("#varmodificando").val("");
        $("#normas").val("Normas");
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
                            nuevaFila += "<td class='oculto'>" + item["ID"] + "</td>"; //id tabla descripcion mercancias
                            nuevaFila += "<td class='valorfactura'>" + item["Naladisa"] + "</td>";
                            nuevaFila += "<td class='texto-izq anchoDeno'>" + item["DescMercancia"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["PesoCantidad"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["ValorFob"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["Normas"] + "</td>";
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
        $("#operacion").val(detCertificado.operacion);
        $("#paisimp").val(detCertificado.PaisImp);
        $("#nofacturacomercial").val(detCertificado.NoFacturaComercial);
        $("#fechadeclaorigen").val(detCertificado.FechaDeclaOrigen);
        $("#razonsocialexpopro").val(detCertificado.RazonSocialExpoPro);
        $("#nit").val(detCertificado.NIT);
        $("#direccionexpopro").val(detCertificado.DireccionExpoPro);
        $("#fechaexpopro").val(detCertificado.FechaExpoPro);
        $("#razonsocialimp").val(detCertificado.RazonSocialImp);
        $("#direccionimp").val(detCertificado.DireccionImp);
        $("#mediotransporte").val(detCertificado.MedioTransporte);
        $("#puertoembarque").val(detCertificado.PuertoEmbarque);
        $("#observaciones").val(detCertificado.Observaciones);
        agregardescripcion(1);        
    }    
}
// _DATOS TABLA DESCRIPCION MERCANCIAS EN ARREGLO _DETMERCANCIA_
function descripcionmerca(){
    //alert('mensaje de muestra ');
    detmercancia = [];
        $('#tbldescripcionmercancia tr').each(function () {
            var idDescmercancia = $(this).find('td').eq(1).html();// id tabla Descripcion mercancias.
            var naladisa = $(this).find('td').eq(2).html();
            var descripcion = $(this).find('td').eq(3).html();
            var pesocantidad = $(this).find('td').eq(4).html();
            var valorfob = $(this).find('td').eq(5).html();
            var normas = $(this).find('td').eq(6).html();
            var valor = {
                idDescmercancia,
                naladisa, descripcion, pesocantidad, valorfob, normas};
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
        var operacion = $("#operacion").val();
            var paisimp = $("#paisimp").val().toUpperCase();
            var nofacturacomercial = $("#nofacturacomercial").val().toUpperCase();
            var fechadeclaorigen = $("#fechadeclaorigen").val();
            var razonsocialexpopro = $("#razonsocialexpopro").val().toUpperCase();
            var nit = $("#nit").val()
            var direccionexpopro = $("#direccionexpopro").val().toUpperCase();//toLowerCase();
            var fechaexpopro = $("#fechaexpopro").val();
            var razonsocialimp = $("#razonsocialimp").val().toUpperCase();
            var direccionimp = $("#direccionimp").val().toUpperCase();
            var mediotransporte = $("#mediotransporte").val().toUpperCase();
            var puertoembarque = $("#puertoembarque").val().toUpperCase();
            var observaciones = $("#observaciones").val().toUpperCase();
            
    var dato = {
        operacion, paisimp, nofacturacomercial, fechadeclaorigen, razonsocialexpopro, nit,
        direccionexpopro, fechaexpopro, razonsocialimp, direccionimp, 
        mediotransporte, puertoembarque, observaciones
        };
    
    datosform.push(dato);    
    // console.log(JSON.stringify(datos));
      //console.log(datos);
    var valores = {"datosform": datosform};
     //console.log("valores >" + valores);
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