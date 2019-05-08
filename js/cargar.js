    // $(window).on("load", function () {
        
    // });

$(function () {
    listar(estado);
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
            html='<table id="tblresultado" class="class="highlight responsive-table striped bordered"">';
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
                html+= '<td>' + valores.data[i].Regional + '</td>';
                html+= '<td>' + valores.data[i].Fecha + '</td>';
                html+= '<td style="text-align: left!important;">' + valores.data[i].NombreExp + '</td>';
                if (estado=='TERMINADO'){
                    html+= '<td><a href="verpdf.php?p='+ valores.data[i].id +'" target="_blank">Ver Pdf</a></td>';
                    html+= '<td><a href="costarica.php?d='+ valores.data[i].id +'" >Duplicar</a></td>';
                }else{
                    html+= '<td><a href="costarica.php?ed=1&d='+ valores.data[i].id +'" >Editar</a></td>';
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