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
        // limpiar();
        criterPreferencial();
    });

/********** BOTON MODIFICAR ITEMS TABLA DESCRIPCION MERCANCIAS */  
  $("#modificar").click(function () {      //$('.borrar').each 
    modificando();        
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
        criterPreferencial();
  });
//********* BOTON AGREGAR ITEM DESCRIPCION MERCANCIAS**/
  $("#agregar").click(function () {
        agregardescripcion(0);
     //   limpiar();
  });

  $("#selecProductor").change(function () { 
        opcionProductor();      
  });

  $("#CritePreferencial").change(function () {     
        criterPreferencial();      
  });
//********* LIMPIAR TABLA  DESCRIPCIÓN MERCANCIAS**/
    
});
/* ######################################################### FUNCTIONS  #########################################################*/
function limpiar() {
    $("#DescMercancia").val("");
    $("#ClasiArancelaria").val("")
    $("#CritePreferencial").val("");
    $("#OtrosCriterios").val("");
    $("#Productor").val("");
}
//  MODIFICA ITEMS TABLA DECRIPCIONES
function modificando() {
    var fila = $("#varmodificando").val();
    tabla = document.getElementById("tbldescripcionmercancia");
    if(criterPreferencial()==0){
        alert("Hace falta ingresar información")
    }else{
    for (var i = 1; i < 6; i++) {
          tabla.rows[fila].cells[2].innerHTML = $("#DescMercancia").val().toUpperCase();
          tabla.rows[fila].cells[3].innerHTML = $("#ClasiArancelaria").val();
          tabla.rows[fila].cells[4].innerHTML = $("#CritePreferencial").val();
          tabla.rows[fila].cells[5].innerHTML = $("#OtrosCriterios").val();
          tabla.rows[fila].cells[6].innerHTML = $("#Productor").val();
      }
          switchClase(0);
        $("#descmercancia").focus();
        editando();
        limpiar();
    }
      //alert($("#varmodificando").val());
          /**NUEVO CODIGO */
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

                    if ( DescMercancia_ =='' || ClasiArancelaria_=='' || Productor_=='' || CritePreferencial_==''){
                        alert("Hace falta ingresar información")}
                        else{
                            // if(CritePreferencial_=='C' && OtrosCriterios_==''){
                            if(criterPreferencial()==0){
                                alert("Hace falta ingresar información")
                            }else{
                            var nuevaFila = "<tr>"; //console.log('total filas ' + filas);        // nuevaFila += "<td>" + (filas + 1) + "</td>";//                            
                            nuevaFila += "<td class='oculto'></td>";
                            nuevaFila += "<td class='oculto'>" + a + "</td>";
                            nuevaFila += "<td class='descripcion'>" + DescMercancia_ + "</td>";
                            nuevaFila += "<td class='center'>" + ClasiArancelaria_ + "</td>";
                            nuevaFila += "<td class='center'>" + CritePreferencial_ + "</td>";
                            nuevaFila += "<td class='center'>" + OtrosCriterios_ + "</td>";
                            nuevaFila += "<td class='center'>" + Productor_ + "</td>";
                            nuevaFila += "<td class='center'>" + PaisdeOrigen_ + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";                            
                            nuevaFila += "</tr>";
                            $("#tbldescripcionmercancia").append(nuevaFila);
                            $("#DescMercancia").focus();        
                            limpiar();
                            criterPreferencial();
                            }
                        }
            }else{ /****si a es 1, se agregan valores de BD a tabla DESCRIPCION MERCANCIAS **/
                // console.log(detMercancias);
                $.each(detMercancias, function(i, item) {                    //console.log(item["valorfactura"]);
                            var nuevaFila = "<tr>";
                            nuevaFila += "<td class='oculto'></td>";
                            nuevaFila += "<td class='oculto'>" + item["ID"] + "</td>"; //id tabla descripcion mercancias
                            nuevaFila += "<td class='descripcion'>" + item["DescMercancia"] + "</td>";
                            nuevaFila += "<td class='center'>" + item["ClasiArancelaria"] +  "</td>";
                            nuevaFila += "<td class='center'>" + item["CritePreferencial"] +  "</td>";
                            nuevaFila += "<td class='center'>" + item["OtrosCriterios"] + "</td>";
                            nuevaFila += "<td class='center'>" + item["Productor"] + "</td>";
                            nuevaFila += "<td class='center'>" + item["PaisdeOrigen"] + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";
                            nuevaFila += "</tr>";
                            $("#tbldescripcionmercancia").append(nuevaFila);
                });
            }
            reordenaritems();
}

function duplicarcert(id){
    if (id>0){
        $("#Operacion").val(detCertificado.operacion);
            $("#NombreExp").val(detCertificado.NombreExp);
            $("#TelefonoExp").val(detCertificado.TelefonoExp);
            $("#FaxExp").val(detCertificado.FaxExp);
            $("#DireccionExp").val(detCertificado.DireccionExp);
            $("#CiudadExp").val(detCertificado.CiudadExp);
            $("#PaisExp").val(detCertificado.PaisExp);
            $("#NumRegFiscalExp").val(detCertificado.NumRegFiscalExp);

            $("#FechaDesde").val(detCertificado.FechaDesde);
            $("#FechaHasta").val(detCertificado.FechaHasta);
            $("#NumFacturaComercial").val(detCertificado.NumFacturaComercial);
            $("#NombrePro").val(detCertificado.NombrePro);
            $("#TelefonoPro").val(detCertificado.TelefonoPro);
            $("#FaxPro").val(detCertificado.FaxPro);
            $("#DireccionPro").val(detCertificado.DireccionPro);
            $("#CiudadPro").val(detCertificado.CiudadPro);
            $("#PaisPro").val(detCertificado.PaisPro);
            $("#NumRegFiscalPro").val(detCertificado.NumRegFiscalPro);

            $("#NombreImp").val(detCertificado.NombreImp);
            $("#TelefonoImp").val(detCertificado.TelefonoImp);
            $("#DireccionImp").val(detCertificado.DireccionImp);
            $("#CiudadImp").val(detCertificado.CiudadImp);
            $("#PaisImp").val(detCertificado.PaisImp);
            $("#NumRegFiscalImp").val(detCertificado.NumRegFiscalImp);

            $("#Observaciones").val(detCertificado.Observaciones);
            $("#FechaElabora").val(detCertificado.FechaElabora);
            $("#NombreAutoriza").val(detCertificado.NombreAutoriza);
            $("#CargoPersonAutoriza").val(detCertificado.CargoPersonAutoriza);
            $("#EmpresaAutoriza").val(detCertificado.EmpresaAutoriza);
            $("#TelPersonAutoriza").val(detCertificado.TelPersonAutoriza);
            $("#FaxPersonAutoriza").val(detCertificado.FaxPersonAutoriza);
                var ne = $("#NombrePro").val();
                console.log(ne);
                    if (ne == 'IGUAL' || ne == 'VARIOS' || ne == 'DISPONIBLE A SOLICITUD DE LA AUTORIDAD COMPETENTE' || ne == 'DESCONOCIDO'){
                        $('.ocultarProd').addClass("oculto");
                };
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
        var CiudadExp_ = $("#CiudadExp").val().toUpperCase();
        var PaisExp_ = $("#PaisExp").val().toUpperCase();
        var NumRegFiscalExp_ = $("#NumRegFiscalExp").val();

        var FechaDesde_ = $("#FechaDesde").val();
        var FechaHasta_ = $("#FechaHasta").val();
        var NumFacturaComercial_ = $("#NumFacturaComercial").val();
        
        var NombrePro_ = $("#NombrePro").val().toUpperCase();
        var TelefonoPro_ = $("#TelefonoPro").val();
        var FaxPro_ = $("#FaxPro").val();
        var DireccionPro_ = $("#DireccionPro").val().toUpperCase();
        var CiudadPro_ = $("#CiudadPro").val().toUpperCase();
        var PaisPro_ = $("#PaisPro").val().toUpperCase();
        var NumRegFiscalPro_ = $("#NumRegFiscalPro").val();

        var NombreImp_ = $("#NombreImp").val().toUpperCase();
        var TelefonoImp_ = $("#TelefonoImp").val();
        var DireccionImp_ = $("#DireccionImp").val().toUpperCase();
        var CiudadImp_ = $("#CiudadImp").val().toUpperCase();
        var PaisImp_ = $("#PaisImp").val().toUpperCase();
        var NumRegFiscalImp_ = $("#NumRegFiscalImp").val();

        var Observaciones_ = $("#Observaciones").val().toUpperCase();
        
        var FechaElabora_ = $("#FechaElabora").val();
        var NombreAutoriza_ = $("#NombreAutoriza").val().toUpperCase();
        var CargoPersonAutoriza_ = $("#CargoPersonAutoriza").val().toUpperCase();
        var EmpresaAutoriza_ = $("#EmpresaAutoriza").val().toUpperCase();
        var TelPersonAutoriza_ = $("#TelPersonAutoriza").val().toUpperCase();
        var FaxPersonAutoriza_ = $("#FaxPersonAutoriza").val();    

    var dato = {
        Operacion_, NombreExp_, TelefonoExp_, FaxExp_, DireccionExp_, CiudadExp_, PaisExp_, NumRegFiscalExp_, 
        FechaDesde_, FechaHasta_, NumFacturaComercial_, 
        NombrePro_, TelefonoPro_, FaxPro_, DireccionPro_, CiudadPro_, PaisPro_, NumRegFiscalPro_, 
        NombreImp_, TelefonoImp_, DireccionImp_, CiudadImp_, PaisImp_, NumRegFiscalImp_, Observaciones_,
        FechaElabora_, NombreAutoriza_, CargoPersonAutoriza_, EmpresaAutoriza_, TelPersonAutoriza_, FaxPersonAutoriza_
    };
    
    datos.push(dato);    
      //console.log(datos);
    var valores = {"datosform": datos};
     //console.log( valores);
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

function opcionProductor() {
        var op = $("#selecProductor").val();
    switch(op) {
        case '1':     // '-'
            $('.ocultarProd').removeClass("oculto");
            $("#NombrePro").val('');
            break;
        case '2':     // 'IGUAL'
            $('.ocultarProd').addClass("oculto");
            $('#NombrePro').val('IGUAL');            
            break;
        case '3':     // 'VARIOS'
            $('.ocultarProd').addClass("oculto");
            $("#NombrePro").val("VARIOS");
            break;
        case '4':     // 'DISPONIBLE A SOLICITUD DE LA AUTORIDAD COMPETENTE'
            $('.ocultarProd').addClass("oculto");
            $("#NombrePro").val("DISPONIBLE A SOLICITUD DE LA AUTORIDAD COMPETENTE");
            break;
        case '5':     // 'DESCONOCIDO'
            $('.ocultarProd').addClass("oculto");
            $("#NombrePro").val("DESCONOCIDO");
            break;
        default:
          // code block
      }
    //   limpiaProd();
      $('.ocultarProd input').each(function () {
        $(this).val("");
      });
}

function criterPreferencial(){
    var cp = $("#CritePreferencial").val();    
    var oc = $("#OtrosCriterios").val();
    
    if (cp=='C'&& oc==''){        
        $("#OtrosCriterios").prop('disabled', false);
        return 0;    
    }else if(cp=='C' && oc!=''){
        $("#OtrosCriterios").prop('disabled', false);
        return 1;
    }else if(cp!='C'){
        $("#OtrosCriterios").prop('disabled', true);
        $("#OtrosCriterios").val("");
        return 1;
    }
}


function __ajax(url, data) {
    var ajax = $.ajax({
        "method": "POST",
        "url": url,
        "data": data
    })
    return ajax;
}