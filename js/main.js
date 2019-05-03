$(document).ready(function () {
        duplicarcert(id);         //  datos();//  listar();//  guardar(); //console.log(datos());

    $("#btenviarform").click(function () {
        detallemerca();        //datos();     // console.log(detmercancia);
    });
//********* GUARDAR **/
    $('#btguardar').click(function () {        
        validaform();       
    });
//********* BORRAR ITEM DESCRIPCION MERCANCIAS **/
    $(document).on('click', '.borrar', function () {
        //var re = confirm('Borrar esta linea?')
        //if (re){
            // if (id>0){
                var ide = $(this).parents("tr").find('td').eq(0).html();
                idUpdate.push(ide);
                console.log(idUpdate);
            //         }
            //     else{
            //     }
            $(this).closest('tr').remove();
          //  }else{
            console.log("No borrar");
        //}
    });
/*********** EDITAR ITEMS TABLA DESCRIPCION MERCANCIAS************* */
    $(document).on('click', '.editar', function () {
        var r = $(this).parents("tr").find('td').eq(0).html();
        console.log(r);
        claseborrar(1);
        $("#descmercancia").val($(this).parents("tr").find('td').eq(1).html());
        $("#clasiarancelaria").val($(this).parents("tr").find('td').eq(2).html());
        $("#nofactura").val($(this).parents("tr").find('td').eq(3).html());
        $("#valorfactura").val($(this).parents("tr").find('td').eq(4).html());        
        $("#criterorigen").val($(this).parents("tr").find('td').eq(5).html());
        claseborrar(1);            
        $("#descmercancia").focus();
    });
  /** MODIFICAR ITEMS TABLA DESCRIPCION MERCANCIAS */  
  $("#modificar").click(function () {      //$('.borrar').each
  
            alert("mensaje");
            
    
        claseborrar(0);
    $("#descmercancia").focus();

  });
  $("#cancelar").click(function () {
        $("#modificar").addClass("oculto");
        $("#cancelar").addClass("oculto");
        $("#agregar").removeClass("oculto");
        claseborrar(0);
        limpiar();
  });
//********* AGREGAR ITEM DESCRIPCION MERCANCIAS**/
    $("#agregar").click(function () {
        agregardescripcion(0);
    });
//********* LIMPIAR TABLA  DESCRIPCIÓN MERCANCIAS**/
    function limpiar() {
        $("#descmercancia").val("");
        $("#clasiarancelaria").val("")
        $("#nofactura").val("");
        $("#valorfactura").val("");
        $("#criterorigen").val("");
    }
});
/* ######################################################### FUNCTIONS  #########################################################*/
function modifica() {
    tab=document.getElementById('tabla');
    for (i=0; ele=tab.getElementsByTagName('input')[i]; i++) {
      if (ele.checked) edita(ele);
      ele.checked = false;
    }
  }

  function edita(obj) {
    padre = obj.parentNode.parentNode;
    celda = padre.getElementsByTagName('td');
    inicio = 2;//celda para comenzar
    fin = 6;//celda para terminar
    
    for(i=inicio;i<fin;i++){
    var celdaTmp = celda[i];
      
    txt = celdaTmp.innerHTML;
    celdaTmp.innerHTML = '';
    inp = celdaTmp.appendChild(document.createElement('input'));
    inp.value=txt;
    inp.onblur = function() { this.parentNode.innerHTML = this.value  }      
        
    }
  }


function  claseborrar(op){
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

function agregardescripcion(a) {    
        //var filas = $("#descripcionmercancia tbody tr").length;
                if (a == 0){
                    var descripcion = $("#descmercancia").val().toUpperCase();
                    var clasiarancelaria = $("#clasiarancelaria").val();
                    var nofactura = $("#nofactura").val();
                    var valorfactura = $("#valorfactura").val();
                    var criterorigen = $("#criterorigen").val();
                    if ( descripcion =='' || clasiarancelaria=='' || nofactura=='' || valorfactura==''){
                        alert("Hace falta ingresar información")}
                        else{
                            var nuevaFila = "<tr>"; //console.log('total filas ' + filas);        // nuevaFila += "<td>" + (filas + 1) + "</td>";//        
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
            }else{
                //console.log(detMercancias);
                $.each(detMercancias, function(i, item) {                    //console.log(item["valorfactura"]);
                    var nuevaFila = "<tr>";
                    nuevaFila += "<td class=''>" + item["id"] + "</td>";
                            nuevaFila += "<td class='descripcion'>" + item["descmercancia"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["clasiarancelaria"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["nofactura"] +  "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["valorfactura"] + "</td>";
                            nuevaFila += "<td class='center valorfactura'>" + item["criterorigen"] + "</td>";
                            nuevaFila += "<td><button class='borrar btn red'><i class='material-icons'>delete</i></button> <button class='editar btn blue'><i class='material-icons'>edit</i></button></td>";                            
                            nuevaFila += "</tr>";
                            $("#descripcionmercancia").append(nuevaFila);
                });
            }
        
    
}

function duplicarcert(id){
    if (id>0){
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
        $("#lugarautocompe").val(detCertificado.LugarAutoCompe);
        $("#fechaautocompe").val(detCertificado.FechaAutoCompe);
        $("#direccionautocompe").val(detCertificado.DireccionAutoCompe);
        $("#telefonoautocompe").val(detCertificado.TelefonoAutoCompe);
        $("#faxautocompe").val(detCertificado.FaxAutoCompe);
        $("#correoautocompe").val(detCertificado.CorreoAutoCompe);
        agregardescripcion(1);        
    }    
}

function detallemerca(){
    //alert('mensaje de muestra ');
    detmercancia = [];
        $('#descripcionmercancia tr').each(function () {
            var descripcion = $(this).find('td').eq(1).html();
            var clasiarancelaria = $(this).find('td').eq(2).html();
            var nofactura = $(this).find('td').eq(3).html();
            var valorfactura = $(this).find('td').eq(4).html();
            var criterorigen = $(this).find('td').eq(5).html();
            var valor = {
                descripcion, clasiarancelaria, nofactura, valorfactura, criterorigen};
            detmercancia.push(valor);            
            //console.log(detmercancia);
        });
        var valores = {"tabladesc": detmercancia};
        //console.log(valores);
        return valores;
}
function datos(){
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
    var lugarautocompe = $("#lugarautocompe").val().toUpperCase();
    var fechaautocompe = $("#fechaautocompe").val();
    var direccionautocompe = $("#direccionautocompe").val().toUpperCase();
    var telefonoautocompe = $("#telefonoautocompe").val().toUpperCase();
    var faxautocompe = $("#faxautocompe").val();
    var correoautocompe = $("#correoautocompe").val();

    var dato = {
        operacion, nombreexp, direccionexp, telefonoexp, faxexp, correoexp, numregfiscalexp,
        nombrepro, direccionpro, telefonopro, faxpro, correopro, numregfiscalpro,
        nombreimp, direccionimp, telefonoimp, faximp, correoimp, numregfiscalimp,
        observaciones,
        lugarexp, fechaexp,
        lugarautocompe, fechaautocompe, direccionautocompe, telefonoautocompe, faxautocompe, correoautocompe
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

function guardar() {
    var url = "libs/guardar.php";
    var descmerca = JSON.stringify(detallemerca())
    var json = JSON.stringify(datos()); // convierte objeto a cadena JSON lo que devuelve funcion datos()
    console.log('funcion guardar'+ descmerca);
    __ajax(url, {"guardar": json, "items":descmerca}) //  , "desc": descmerca
        .done(function ( info ){
             console.log( info );// Info: respuesta del servidor

            if ( info ==1 ){
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