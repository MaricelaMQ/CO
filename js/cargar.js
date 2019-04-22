    // $(window).on("load", function () {
        
    // });

$(document).ready(function () {
listar();
});

function listar() {
    var url = "libs/listar.php";
    __ajax(url, "")
        .done(function (info) {
             console.log('INFO '+ info); //info información obtenida en formato JSON
            if(info=='N'){
                html='<strong>No hay información</strong>'
            }else{
            var valores = JSON.parse(info); //codifica cadena a objeto
            html='<table id="tblresultado" class="table table-striped table-hover">';
            html+= '<thead class="thead-dark"><tr>';            
            html+= '<td style="text-align: center">Numero Certificado</td>';
            html+= '<td style="text-align: center">Operación</td>';
            html+= '<td style="text-align: center"> Formato</td>';
            html+= '<td style="text-align: center">Fecha</td>';
            html+= '<td></td>';
            html+= '<td></td>';
            html+= '</tr></thead>';
             console.log(valores);
             html+= '<tbody><tr>';
            for (var i in valores.data) {
                //console.log(valores.data[i].NumeroCertificado);
                html+= '<td>'+ valores.data[i].id + '</td>';
                html+= '<td>' + valores.data[i].Operacion + '</td>';
                html+= '<td>' + valores.data[i].Regional + '</td>';
                html+= '<td>' + valores.data[i].Fecha + '</td>';
                html+= '<td><a href="verpdf.php?p='+ valores.data[i].id +'" target="_blank">Ver Pdf</a></td>';
                html+= '<td><a href="costarica.php?p='+ valores.data[i].id +'" target="_blank">Duplicar</a></td>';
                html+= '</tr>';
            }
            html+= '</tbody>';
            html+= '</table>';
            }
            $("#resultado").html(html);
        });
}