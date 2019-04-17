
$(document).ready(function () {        
    $("#btenviarform").click(function () {
        detallemerca();
        //datos();
        // console.log(detmercancia);
    });
//********* GUARDAR **/
    $('#btguardar').click(function () {
        guardar();
    });
//********* BORRAR **/    
    $(document).on('click', '.borrar', function () {
        $(this).closest('tr').remove();
    });
//********* AGREGAR **/
    $("#agregar").click(function () {

        var descripcion = $("#descmercancia").val();
        var clasiarancelaria = $("#clasiarancelaria").val();
        var nofactura = $("#nofactura").val();
        var valorfactura = $("#valorfactura").val();
        var criterorigen = $("#criterorigen").val();

        //var filas = $("#descripcionmercancia tbody tr").length;
        //console.log('total filas ' + filas);
        var nuevaFila = "<tr>";
        //agregar fila nueva
        // nuevaFila += "<td>" + (filas + 1) + "</td>";//
        nuevaFila += "<td class='descripcion'>" + descripcion + "</td>";
        nuevaFila += "<td class='center valorfactura'>" + clasiarancelaria + "</td>";
        nuevaFila += "<td class='center valorfactura'>" + nofactura + "</td>";
        nuevaFila += "<td class='center valorfactura'>" + valorfactura + "</td>";
        nuevaFila += "<td class='center valorfactura'>" + criterorigen + "</td>";
        nuevaFila += "<td><button class='borrar btn red'>Borrar<i class='material-icons left'>delete</i></button></td>";
        nuevaFila += "</tr>";
        $("#descripcionmercancia").append(nuevaFila);
        //limpiar();
        $("#descmercancia").focus();
    });
//********* LIMPIAR TABLA  DESCRICIÓN MERCANCIAS**/
    function limpiar() {
        $("#descmercancia").val("");
        $("#clasiarancelaria").val("")
        $("#nofactura").val("");
        $("#valorfactura").val("");
        $("#criterorigen").val("");
    }
//  listar();
//  guardar();
//  console.log(datos());
});

function detallemerca(){
    detmercancia = [];
        $('#descripcionmercancia tr').each(function () {
            var descripcion = $(this).find('td').eq(0).html();
            var clasiarancelaria = $(this).find('td').eq(1).html();
            var nofactura = $(this).find('td').eq(2).html();
            var valorfactura = $(this).find('td').eq(3).html();
            var criterorigen = $(this).find('td').eq(4).html();
            var valor = {
                descripcion, clasiarancelaria, nofactura, valorfactura, criterorigen};
            detmercancia.push(valor);
            //alert('mensaje de muestra ' + nombrexp)
            //console.log(detmercancia);
        });
        var valores = {"tabladesc": detmercancia};
        //console.log(valores);
        return valores;
}
function datos(){
    var datos = [];
    var operacion = $("#operacion").val();
    var nombreexp = $("#nombreexp").val();    
    var direccionexp = $("#direccionexp").val();
    var telefonoexp = $("#telefonoexp").val();
    var faxexp = $("#faxexp").val();
    var correoexp = $("#correoexp").val();
    var numregfiscalexp = $("#numregfiscalexp").val();

    var nombrepro = $("#nombrepro").val();
    var direccionpro = $("#direccionpro").val();
    var telefonopro = $("#telefonopro").val();
    var faxpro = $("#faxpro").val();
    var correopro = $("#correopro").val();
    var numregfiscalpro = $("#numregfiscalpro").val();

    var nombreimp = $("#nombreimp").val();
    var direccionimp = $("#direccionimp").val();
    var telefonoimp = $("#telefonoimp").val();
    var faximp = $("#faximp").val();
    var correoimp = $("#correoimp").val();
    var numregfiscalimp = $("#numregfiscalimp").val();
    
    // DATOS TABLA DESCRIPCION MERCANCIAS
    var observaciones = $("#observaciones").val();    
    var lugarexp = $("#lugarexp").val();
    var fechaexp = $("#fechaexp").val();
    var lugarautocompe = $("#lugarautocompe").val();
    var fechaautocompe = $("#fechaautocompe").val();
    var direccionautocompe = $("#direccionautocompe").val();
    var telefonoautocompe = $("#telefonoautocompe").val();
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
                location.href ="principal.html";
            }else{
                alert('error al guardar');    
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