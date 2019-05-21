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
        $(this).parents("tr").addClass("editando");
        switchClase(1);
        $("#varmodificando").val($(this).parents("tr").find('td').eq(0).html()-1);
            $("#DescMercancia").val($(this).parents("tr").find('td').eq(2).html());
            $("#ClasiArancelaria").val($(this).parents("tr").find('td').eq(3).html());
            $("#CritePreferencial").val($(this).parents("tr").find('td').eq(4).html());
            $("#OtrosCriterios").val($(this).parents("tr").find('td').eq(5).html());
            $("#Productor").val($(this).parents("tr").find('td').eq(6).html());
            // $("#Productor").val($(this).parents("tr").find('td').eq(7).html());
        $("#DescMercancia").focus();
    });

/********** BOTON MODIFICAR ITEMS TABLA DESCRIPCION MERCANCIAS */  
  $("#modificar").click(function () {      //$('.borrar').each 
    modificando();
    editando()
    limpiar();
  });
/********** BOTON CANCELAR ***/
  $("#cancelar").click(function () {        
        $("#modificar").addClass("oculto");
        $("#cancelar").addClass("oculto");
        $("#agregar").removeClass("oculto");
        $("#varmodificando").val("");
        editando();                
        switchClase(0);
        limpiar();
  });
//********* BOTON AGREGAR ITEM DESCRIPCION MERCANCIAS**/
  $("#agregar").click(function () {
        agregardescripcion(0);
        limpiar();
  });
//********* LIMPIAR TABLA  DESCRIPCIÓN MERCANCIAS**/
    function limpiar() {
        $("#DescMercancia").val("");
        $("#ClasiArancelaria").val("")
        $("#CritePreferencial").val("");
        $("#OtrosCriterios").val("");
        $("#Productor").val("");
    }
});
/* ######################################################### FUNCTIONS  #########################################################*/
//  MODIFICA ITEMS TABLA DECRIPCIONES
function modificando() {
    var fila = $("#varmodificando").val();
    tabla = document.getElementById("tbldescripcionmercancia");    
    for (var i = 1; i < 6; i++) {      
          tabla.rows[fila].cells[2].innerHTML = $("#DescMercancia").val().toUpperCase();
          tabla.rows[fila].cells[3].innerHTML = $("#ClasiArancelaria").val();
          tabla.rows[fila].cells[4].innerHTML = $("#CritePreferencial").val();
          tabla.rows[fila].cells[5].innerHTML = $("#OtrosCriterios").val();
          tabla.rows[fila].cells[6].innerHTML = $("#Productor").val();
      }
      switchClase(0);
      //alert($("#varmodificando").val());
          /**NUEVO CODIGO */
          
      $("#descmercancia").focus();
    }
/** AGREGA/QUITA CLASE OCULTAR  */
function switchClase(op){
if (op==1){
    // $(editan).addClass("editando"); 
    $('.borrar, .editar').each(function () {
        $(this).addClass("oculto");
    });

    $("#modificar").removeClass("oculto");
        $("#cancelar").removeClass("oculto");
        $("#agregar").addClass("oculto");
}else{
    // $(editan).removeClass("editando");
    $('.borrar, .editar').each(function () {
        $(this).removeClass("oculto");
    });    
    $("#modificar").addClass("oculto");
    $("#cancelar").addClass("oculto");
    $("#agregar").removeClass("oculto");
}

}

function editando(){
    $('.editando').each(function () {
        $(this).removeClass("editando");
    });
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
                    var DescMercancia_ = $("#DescMercancia").val().toUpperCase();
                    var ClasiArancelaria_ = $("#ClasiArancelaria").val();
                    var CritePreferencial_ = $("#CritePreferencial").val().toUpperCase();
                    var OtrosCriterios_ = $("#OtrosCriterios").val().toUpperCase();
                    var Productor_ = $("#Productor").val().toUpperCase();
                    var PaisdeOrigen_ = $("#PaisdeOrigen").val().toUpperCase();

                    if ( DescMercancia_ =='' || ClasiArancelaria_=='' || CritePreferencial_=='' || OtrosCriterios_==''){
                        alert("Hace falta ingresar información")}
                        else{
                            var nuevaFila = "<tr>"; //console.log('total filas ' + filas);        // nuevaFila += "<td>" + (filas + 1) + "</td>";//                            
                            nuevaFila += "<td class='oculto'></td>";
                            nuevaFila += "<td class='oculto'>" + a + "</td>";
                            nuevaFila += "<td class='descripcion'>" + DescMercancia_ + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + ClasiArancelaria_ + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + CritePreferencial_ + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + OtrosCriterios_ + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + Productor_ + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + PaisdeOrigen_ + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";                            
                            nuevaFila += "</tr>";
                            $("#tbldescripcionmercancia").append(nuevaFila);
                            $("#descmercancia").focus();        //limpiar();                            
                }                        
            }else{ /****si a es 1, se agregan valores de BD a tabla DESCRIPCION MERCANCIAS **/
                // console.log(detMercancias);
                $.each(detMercancias, function(i, item) {                    //console.log(item["valorfactura"]);
                            var nuevaFila = "<tr>";
                            nuevaFila += "<td class='oculto'></td>";
                            nuevaFila += "<td class='oculto'>" + item["ID"] + "</td>"; //id tabla descripcion mercancias
                            nuevaFila += "<td class='descripcion'>" + item["DescMercancia"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["ClasiArancelaria"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["CritePreferencial"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["OtrosCriterios"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["Productor"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["PaisdeOrigen"] + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";
                            nuevaFila += "</tr>";
                            $("#tbldescripcionmercancia").append(nuevaFila);
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
        $("#direccionautocompe").val(detCertificado.DireccionAutoCompe);
        $("#telefonoautocompe").val(detCertificado.TelefonoAutoCompe);
        $("#faxautocompe").val(detCertificado.FaxAutoCompe);
        $("#correoautocompe").val(detCertificado.CorreoAutoCompe);
        agregardescripcion(1);        
    }    
}
//// VALORES DESCRIPCION MERCANCIAS EN ARREGLO _DETMERCANCIA_
function descripcionmerca(){
    //alert('mensaje de muestra ');
    detmercancia = [];
        $('#tbldescripcionmercancia tr').each(function () {
            var idDescmercancia_ = $(this).find('td').eq(1).html();// id tabla Descripcion mercancias.
            var DescMercancia_ = $(this).find('td').eq(2).html();
            var ClasiArancelaria_ = $(this).find('td').eq(3).html();
            var CritePreferencial_ = $(this).find('td').eq(4).html();
            var OtrosCriterios_ = $(this).find('td').eq(5).html();
            var Productor_ = $(this).find('td').eq(6).html();
            var PaisdeOrigen_ = $(this).find('td').eq(7).html();
            var valor = {
                idDescmercancia_,
                DescMercancia_, ClasiArancelaria_, CritePreferencial_, OtrosCriterios_, Productor_, PaisdeOrigen_};
            detmercancia.push(valor);
            //console.log(detmercancia);
        });
        var valores = {"tabladesc": detmercancia};
        console.log(valores);
        return valores;
}
/// VALORES DE INPUTS FORMULARIO EN ARREGLO _DATOS_
function datos(){ // dATOS FORMULARIO 
    var datos = [];

        var Operacion_ = $("#Operacion").val();
        var NombreExp_ = $("#NombreExp").val().toUpperCase();
        var TelefonoExp_ = $("#TelefonoExp").val().toUpperCase();
        var FaxExp_ = $("#FaxExp").val();
        var DireccionExp_ = $("#DireccionExp").val().toUpperCase();
        var NumRegFiscalExp_ = $("#NumRegFiscalExp").val();

        var FechaDesde_ = $("#FechaDesde").val();
        var FechaHasta_ = $("#FechaHasta").val();
        var NumFacturaComercial_ = $("#NumFacturaComercial").val();
        
        var NombrePro_ = $("#NombrePro").val().toUpperCase();
        var TelefonoPro_ = $("#TelefonoPro").val();
        var FaxPro_ = $("#FaxPro").val();
        var DireccionPro_ = $("#DireccionPro").val();
        var NumRegFiscalPro_ = $("#NumRegFiscalPro").val();

        var NombreImp_ = $("#NombreImp").val().toUpperCase();
        var TelefonoImp_ = $("#TelefonoImp").val();
        var DireccionImp_ = $("#DireccionImp").val().toUpperCase();
        var NumRegFiscalImp_ = $("#NumRegFiscalImp").val();

        var Observaciones_ = $("#Observaciones").val().toUpperCase();
        
        var FechaElabora_ = $("#FechaElabora").val();
        var NombreAutoriza_ = $("#NombreAutoriza").val().toUpperCase();
        var CargoPersonAutoriza_ = $("#CargoPersonAutoriza").val().toUpperCase();
        var EmpresaAutoriza_ = $("#EmpresaAutoriza").val().toUpperCase();
        var TelPersonAutoriza = $("#TelPersonAutoriza").val().toUpperCase();
        var FaxPersonAutoriza_ = $("#FaxPersonAutoriza").val();    

    var dato = {
        Operacion_, NombreExp_, TelefonoExp_, FaxExp_, DireccionExp_, NumRegFiscalExp_, FechaDesde_,
        FechaHasta_, NumFacturaComercial_, NombrePro_, TelefonoPro_, FaxPro_, DireccionPro_,
        NumRegFiscalPro_, NombreImp_, TelefonoImp_, DireccionImp_, NumRegFiscalImp_, Observaciones_,
        FechaElabora_, NombreAutoriza_, CargoPersonAutoriza_, EmpresaAutoriza_, TelPersonAutoriza, FaxPersonAutoriza_
    };
    
    datos.push(dato);    
      //console.log(datos);
    var valores = {"datosform": datos};
     console.log( valores);
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