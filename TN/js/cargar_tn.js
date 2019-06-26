    // $(window).on("load", function () {
        
    // });

$(function () {

    $('#tblresultado').DataTable({
        columnDefs: [
            {
                targets: 0,
                className: "dt-body-center",
            },
            {
                targets: 1,
                className: "dt-body-center",
            },
            {
                targets: 2,
                className: "dt-body-center",
            }
          ],
        "order": [[ 2, "asc" ]],
        "lengthMenu": [ 25, 50, 75, 100 ],
        "language": {
                      "sProcessing":     "Procesando...",
                      "sLengthMenu":     "Mostrar _MENU_ registros",
                      "sZeroRecords":    "No se encontraron resultados",
                      "sEmptyTable":     "Ningún dato disponible en esta tabla",
                      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                      "sInfoPostFix":    "",
                      "sSearch":         "Buscar:",
                      "sUrl":            "",
                      "sInfoThousands":  ",",
                      "sLoadingRecords": "Cargando...",
                      "oPaginate": {
                          "sFirst":    "Primero",
                          "sLast":     "Último",
                          "sNext":     "Siguiente",
                          "sPrevious": "Anterior"
                      },
                      "oAria": {
                          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                      }
                  },
            "ajax" :{
                    "method": "POST",
                    "url": "libs/listar.php",
                    "data": {"est":estado},
                     error: function (xhr, error, thrown) {
                        sLoadingRecords = "aa";
                                $("#tblresultado").addClass("oculto");
                                $("#resultado").html('<div class="center"><strong>No existe información</strong></div>');                                
                                }
                    },
            "columns":[
                    {"data":"Operacion"},
                    {"data":"Formato"},
                    {"data":"Fecha"},
                    {"data":"NombreExp"},
                    {"data":"NombreImp"},
                    {"render":           function ( data, type, row ) {
                                            if (estado=='TERMINADO'){
                                                    return ('<a href="triangulonorte.php?d='+ row.ID+ '" >Duplicar</a>');
                                            }else{
                                                    return ('<a href="triangulonorte.php?ed=1&d=' + row.ID+ '" >Editar</a>');//<button class="editar btn blue"><i class="material-icons">visibility</i></button>
                                            }
                                }},
                    {"render":           function ( data, type, row ) {
                                            return ('<a href="verpdf.php?p='+ row.ID+ '" target="_blank">Ver Pdf</a>');
                                }}
                    ]
            });
    //listar(estado);    
});

function listar(estado) {
    var url = "libs/listar.php";    
    __ajax(url, {"est":estado})    
        .done(function ( info ){
             //console.log('INFO '+ info); //info información obtenida en formato JSON
            if(info=='N'){
                html='<strong>No hay información</strong>'
            }else{
            var valores = JSON.parse( info ); //codifica cadena a objeto
            html='<table id="tblresultado" class="highlight responsive-table striped bordered">';
            html+= '<thead class="thead-dark"><tr>';            
            // html+= '<td style="text-align: center">Numero Certificado</td>';
            html+= '<th style="text-align: center">OPERACION</th>';
            html+= '<th style="text-align: center">FORMATO</th>';
            html+= '<th style="text-align: center">FECHA CREACION</th>';
            html+= '<th style="text-align: center">EXPORTADOR</th>';
            if (estado=='TERMINADO'){
                html+= '<td colspan=2></td>';
            }else{
                html+= '<td></td>';
            }
            html+= '</tr></thead>';
             //console.log(valores);
             html+= '<tbody><tr>';
            for (var i in valores.data) {
                //console.log(valores.data[i].NumeroCertificado);
                //html+= '<td>'+ valores.data[i].id + '</td>';
                html+= '<td>' + valores.data[i].Operacion + '</td>';
                html+= '<td>' + valores.data[i].Formato + '</td>';
                html+= '<td>' + valores.data[i].Fecha + '</td>';
                html+= '<td style="text-align: left!important;">' + valores.data[i].NombreExp + '</td>';
                if (estado=='TERMINADO'){
                    html+= '<td><a href="verpdf.php?p='+ valores.data[i].ID +'" target="_blank">Ver Pdf</a></td>';
                    html+= '<td><a href="triangulonorte.php?d='+ valores.data[i].ID +'" >Duplicar</a></td>';
                }else{
                    html+= '<td><a href="triangulonorte.php?ed=1&d='+ valores.data[i].ID +'" >Editar</a></td>';
                }
                // html+= '<td></td>';
                html+= '</tr>';
            }
            html+= '</tbody>';
            html+= '</table>';
            }
            $("#resultado").html(html);
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