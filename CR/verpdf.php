<?php   
ob_start();
include "libs/conecta.php";
$id= $_GET["p"];
include "libs/consulta.php";

$nu="dato1";
if ($nu=="dato2") {
    echo "Error No existen datos ";
} else {
    require_once('../tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Adia SAS');
	$pdf->SetTitle("Certificado de Origen");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(15, false, 15, false);
    $pdf->SetAutoPageBreak(true, 10);
/** PREFERENCIAS*/

/** PREFERENCIAS*/
    $pdf->SetFont('Times', '', 8);
    $pdf->SetFillColor(255, 235, 235);
    //$pdf->MultiCell(false, false, false, 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'M', false);    
    $pdf->addPage();
        
/******** GENERAR RESULTADO EN tablaUno *****/
setlocale(LC_TIME, 'es_CO', 'esp_esp'); 
$k=0;
$tablaUno = '';
$tablaDos = '';
$nfilas=7;
$tamanofila=683; // TAMAÑO FILA****
$alto= 26;
  //var_dump($descripcion);
  if ($descripcion>0){
            $totFilas=count($descripcion);
            $altoFila = altofila($totFilas);
            foreach($descripcion as $desc) {
                //$conteo += strlen($desc["DescMercancia"]);
                $k++;                
                if ($k<=$nfilas){
                    if ($k== $totFilas){
                        $alto = $altoFila;
                    }
                    $tablaUno .= '<tr>';
                    $tablaUno .= '<td colspan="1" class="bordeizq borderecho centrar" height="'. $alto. 'px">'. $desc["Item"] . '</td>';
                    $tablaUno .= '<td colspan="10" class="letra borderecho"><p>'. $desc['DescMercancia'] . '</p></td>';
                    $tablaUno .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaUno .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['NoFactura']  . '</p></td>';
                    $tablaUno .= '<td colspan="3" class=" centrar borderecho"><p>'. number_format($desc['ValorFactura'], 2, '.', ',')  . '</p></td>';
                    $tablaUno .= '<td colspan="2" class=" centrar borderecho"><p>'. $desc['CriterOrigen']  . '</p></td>';
                    $tablaUno .= '</tr>';
                }else{
                    $tablaDos .= '<tr>';
                    $tablaDos .= '<td colspan="1" class="bordeizq borderecho centrar" height="'. $alto. 'px">'. $desc["Item"] . '</td>';
                    $tablaDos .= '<td colspan="10" class="letra borderecho"><p>'. $desc['DescMercancia'] . '</p></td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['NoFactura']  . '</p></td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. number_format($desc['ValorFactura'], 2, '.', ',')  . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['CriterOrigen']  . '</p></td>';
                    $tablaDos .= '</tr>';
                }
            }
            $fechaexp = strftime("%d de %B de %Y", strtotime($datos["FechaExp"]));
        }else{
            $fechaexp = '';
            $tablaUno.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="190px"></td></tr>';
            $tablaDos.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="190px"></td></tr>';
        }
            
//$FechaAutoCompe = strftime("%d de %B de %Y", strtotime($datos["FechaAutoCompe"]));
    $content = '';
     $content .= '
     <html>
     <head>
     
     <link rel="shortcut icon" href="../assets/logo.ico" type="image/x-icon">
    <style>
    viewer-pdf-toolbar{
        display:none;
        visibility:hidden!important;
    }

    .letra{
        font-size:6.5;
    }
        .centrar {
            text-align: center;
            vertical-align:middle!important;
        }
        .derecha {
            text-align: right;
            vertical-align:middle!important;
        }

        .borde {
            border:1px dotted black!important;
        } 
        
        .borderecho{
            border-right:1px dotted black!important;
        }

        .bordeizq{            
            border-left:1px dotted black!important;
        }       
            
    </style>
    </head>
    <body>
    <div class="centrar"><strong>Anexo A<br>Certificado de Origen</strong></div>
      
        <div id="contenedorpdf">
            <table id="paginauno" style="width:100%" cellpadding="2">
    <!-- EXPORTADOR  style="width:250px" -->
                <tr>
                    <td colspan="11" class="borde" height="75px">1. Nombre y Dirección del Exportador: '. $datos["NombreExp"]. ' '. $datos["DireccionExp"]. '
                        <br><br>
                        <br> Teléfono: '. $datos["TelefonoExp"]. ' Fax:  '. $datos["FaxExp"]. '
                        <br> Correo electrónico:    '. $datos["CorreoExp"]. '
                        <br> Número de Registro Fiscal: '. $datos["NumRegFiscalExp"]. '
                    </td>
                    <td colspan="11" class="borde">
                        Certificado N°:
                        <p class="centrar"><strong>CERTIFICADO DE ORIGEN</strong></p>
                        <p class="centrar">Tratado de Libre Comercio entre Colombia y Costa Rica
                        <br>(Ver Instrucciones al reverso)</p>        
                    </td>
                </tr>
    <!-- PRODUCTOR -->
                <tr>
                    <td colspan="11" class="borde" height="75px">2. Nombre y Dirección del Productor: '. $datos["NombrePro"]. ' /  '. $datos["DireccionPro"]. ' 
                        <br><br>
                        <br> Teléfono:  '. $datos["TelefonoPro"]. ' Fax:  '. $datos["FaxPro"]. '
                        <br> Correo electrónico: '. $datos["CorreoPro"]. '
                        <br> Número de Registro Fiscal:   '. $datos["NumRegFiscalPro"]. '
                    </td>
    <!-- IMPORTADOR -->                    
                    <td colspan="11" class="borde" >                        
                        <table width="100%">
                            <tr><td height="40px">3. Nombre y Dirección del Importador: '. $datos["NombreImp"]. ' /  '. $datos["DireccionImp"]. ' </td></tr>
                            <tr><td>Teléfono: '. $datos["TelefonoImp"]. '  Fax:  '. $datos["FaxImp"]. '</td></tr>
                            <tr><td>Correo electrónico:  '. $datos["CorreoImp"]. '</td></tr>
                            <tr><td>Número de Registro Fiscal:    '. $datos["NumRegFiscalImp"]. '</td></tr>
                        </table>
                    </td>
                </tr>
    <!-- DESCRIPCION MERCANCIAS -->                
                <tr class="centrar">
                    <td colspan="1" class="bordeizq borderecho">4. Item:</td>
                    <td colspan="10" class="borderecho">5. Descripción de las Mercancías:</td>
                    <td colspan="3" class="borderecho">6. Clasificación Arancelaria SA <br>(6 Digitos):</td>
                    <td colspan="3" class="borderecho">7. Número <br> de la <br>Factura:</td>
                    <td colspan="3" class="borderecho">8. Valor en<br>Factura:</td>
                    <td colspan="2" class="borderecho">9. Criterio <br>de Origen:</td>
             </tr>
    <!-- DESCRIPCION MERCANCIAS -->
    <!-- tablaUno TABLA UNO INSERTADA --> 

                '. $tablaUno.'
                
    <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class=" letra borde">10. Observaciones:<br>'.$datos["Observaciones"].'</td>
            </tr>
    <!-- SECCION ONCE -->
            <tr>             
                <td colspan="11" class="borde">
                    11. Declaración del exportador
                    <p>El abajo firmante declara bajo juramento que la información consignada en este certificado de origen es correcta y verdadera y que las mercancías fueron producidas en:</p>
                    <table>
                        <tr>
                            <td style="border-bottom:0.1px dotted black;" width="180px" >  COLOMBIA                                    
                            </td>
                        </tr>
                        <tr>
                            <td class="centrar">
                                (país)
                            </td>
                        </tr>    
                    </table>
                    <p>y cumplen con las disposiciones del Capitulo 3 (Reglas de Origen y Procedimientos de Origen) establecidas en el Tratado de Libre Comercio entre la República de Colombia y la
                    República de Costa Rica y exportadas a:</p>
                    <table>
                        <tr>
                            <td style="border-bottom:0.1px dotted black;" width="180px" >  COSTA RICA
                            </td>
                        </tr>
                        <tr>
                            <td class="centrar">
                                (país de importación)
                            </td>
                        </tr>    
                    </table>
                    <p> <br><br><br> <br> <br> <br><br> <br> <br> <br> <br> </p> 
                    <br>Lugar y fecha, firma del exportador
                    <br>'. $datos["LugarExp"]. ', '. $fechaexp . '
            </td>
    <!-- SECCION DOCE -->
            <td colspan="11" class="borde">
                12. Certificación de la autoridad competente:
                <p>Sobre la base del control efectuado, se certifica por este medio que la información aquí señalada es correcta y que las mercancías descritas cumplen con las disposiciones del Tratado de Libre Comercio entre la República de Colombia y la República de Costa Rica.</p>                
                <p>Lugar y fecha, nombre y firma del funcionario y sello de la autoridad competente:</p>                
                    <p> <br> <br> <br> <br> <br> <br> <br>  <br> <br> <br> <br> <br><br></p>                 
                <p></p>
                <br>Dirección:  '. $datos["DireccionAutoCompe"]. '
                <br>Teléfono:   '. $datos["TelefonoAutoCompe"]. ' Fax:  '. $datos["FaxAutoCompe"]. '
                <br>Correo electrónico:    '. $datos["CorreoAutoCompe"]. '
            </td>
        </tr>
            </table>';

$pdf->writeHTML($content, true, 0, true, 0);

/****************************************** INSTRUCCIONES DE LLENADO ***************************/
$pdf->addPage();
$instrucciones = '';
$instrucciones .= '

<html>
<head>
<style>
    .centrar {
        text-align: center;
        vertical-align:middle!important;
}
    .derecha {
        text-align: right;
        vertical-align:middle!important;
}
</style>
</head>    
            <table>
                <tr>
                    <td colspan="3" class="centrar">                        
                        <strong><br><br><br><br><br>INSTRUCCIONES PARA COMPLETAR EL CERTIFICADO DE ORIGEN<br></strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Para efectos de solicitar el trato arancelario preferencial, este documento deberá ser completado en forma legible y completa por el exportador de las mercancías, y certificado por la autoridad competente, sin tachaduras, enmiendas o entrelíneas y el importador deberá tenerlo en su poder al momento de presentar la declaración de importación. Llenar a máquina o con letra de imprenta (molde).<br>
                    </td>
                </tr>            
                <tr>
                    <td colspan="3"><strong>Certificado No:</strong> Número correlativo del certificado de origen asignado por la autoridad competente.<br>
                    </td>
                </tr>
            <tr>
                <td width="10%"><strong>Campo 1:</strong></td>
                <td width="2%"></td>
                <td width="88%">Indique el nombre completo o razón social, la dirección (incluyendo la ciudad y el país), el número de teléfono, y el número del registro fiscal del exportador.
                    <p>Indicar el número de fax y el correo electrónico, si son conocidos.</p>                
                        <p>El número del registro fiscal será en:</p>                
                        <p>                  (a)                  Colombia, el número de Registro Único Tributario (R.U.T.) o de cualquier otro documento autorizado de acuerdo con su <br>                   legislación; y</p>
                        <p>                  (b)                  Costa Rica: el número de cédula jurídica para personas jurídicas ó la cédula de identidad para personas físicas.<br></p>
                </td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 2:</strong></td>
                <td width="2%"></td>
                <td width="88%">Indique el nombre completo o razón social, la dirección (incluyendo la ciudad y el país), el número de teléfono y el número del registro fiscal del productor.
                    <p>Indicar el número de fax y el correo electrónico, si son conocidos.</p>                
                    <p>En caso que el certificado ampare mercancías de más de un productor, señale: “VARIOS” y anexe una lista de los productores, incluyendo el nombre completo o razón social, la dirección (incluyendo la ciudad y el país), el número de teléfono y el número del registro fiscal, haciendo referencia directa a la mercancía descrita en el Campo 5.</p>
                    <p>Indicar el número de fax y el correo electrónico, si son conocidos.<br></p>
                        </td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 3:</strong></td>
                <td width="2%"></td>
                <td width="88%">Indique el nombre completo o razón social, la dirección (incluyendo la ciudad y el país), el número de teléfono y el número del registro fiscal del importador.
                    <p>Indicar el número de fax y el correo electrónico, si son conocidos.<br></p>
                </td>
            </tr>
            <tr>                
                <td width="10%"><strong>Campo 4:</strong></td>
                <td width="2%"></td>
                <td width="88%">Indique el ítem de la mercancía de manera correlativa. En caso que se requiera de mayor espacio se podrá adjuntar la Hoja Anexa. <br></td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 5:</strong></td>
                <td width="2%"></td>
                <td width="88%">Proporcione una descripción completa de cada mercancía. La descripción deberá ser lo suficientemente detallada para relacionarla con la descripción de la mercancía contenida en la factura, así como con la descripción que le corresponda a la mercancía en el Sistema Armonizado (SA). 
                <br></td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 6:</strong></td>
                <td width="2%"></td>
                <td width="88%">Para cada mercancía descrita en el Campo 5, identifique los seis dígitos correspondientes a la clasificación arancelaria del Sistema Armonizado (SA).
                <br></td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 7:</strong></td>
                <td width="2%"></td>
                <td width="88%">Para cada mercancía descrita en el Campo 5, indique el número de la factura. En el caso de que la mercancía sea facturada por un operador de un país no Parte y no cuente con la factura comercial, se deberá señalar en este campo el número de la factura comercial emitida en la Parte exportadora.
                <br></td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 8:</strong></td>
                <td width="2%"></td>
                <td width="88%">En este campo se deberá indicar el valor facturado. Se podrá consignar el valor facturado por cada ítem o por el total de ítems. En el caso que una mercancía sea facturada por un operador de un país no Parte, será opcional para el exportador consignar el valor de factura.
                <br></td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 9:</strong></td>
                <td width="2%"></td>
                <td width="88%">Para cada mercancía descrita en el Campo 5, se deberá indicar el criterio de origen correspondiente por el cual la mercancía califica como originaria, de acuerdo a lo siguiente:<br>
                    <br>A:           La mercancía es totalmente obtenida o enteramente producida en el territorio de una o ambas Partes, según se define en el Artículo 3.2<br>                (Mercancías Totalmente Obtenidas o Enteramente Producidas).
                    <br>B:           La mercancía es producida en el territorio de una o ambas Partes, a partir de materiales no originarios, que cumplan con el cambio de<br>                clasificación arancelaria, el valor de contenido regional, u otras reglas de origen específicas contenidas en el Anexo 3-A. 
                    <br>C:           La mercancía es producida en el territorio de una o ambas Partes, a partir exclusivamente de materiales originarios.<br>
                </td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 10:</strong></td>
                <td width="2%"></td>
                <td width="88%">Este campo deberá ser utilizado cuando exista alguna observación adicional respecto a este certificado, entre otros, cuando la mercancía objeto de intercambio sea facturada por un operador de un país no Parte. En dicho caso, se deberá indicar el nombre completo o la razón social y dirección (incluyendo la ciudad y el país) del operador del país no Parte. En el caso que se emita un duplicado, se deberá incluir la frase “DUPLICADO del Certificado de Origen número […] de fecha […]”. En el caso en que se utilice acumulación con terceros países deberá indicarse en este campo el país con el que se está acumulando.<br>
                </td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 11:</strong></td>
                <td width="2%"></td>
                <td width="88%">El campo debe ser completado, firmado y fechado por el exportador.<br>
                </td>
            </tr>
            <tr>
                <td width="10%"><strong>Campo 12:</strong></td>
                <td width="2%"></td>
                <td width="88%">El campo debe ser completado, firmado, fechado y sellado por el funcionario de la autoridad competente acreditado para emitir certificados de origen.
                </td>
            </tr>
    </table>
</html>

';
$pdf->writeHTML($instrucciones, true, 0, true, 0);
/*********************************************PAGINA TRES *******************/ 
if ($k>$nfilas){ 
    $pdf->addPage();
    $paginaDos = '';
    $paginaDos .= '
<html>
<head>
<link rel="stylesheet" href="css/Estilos.css" />

<style>
   .centrar {
       text-align: center;
       vertical-align:middle!important;
   }
   
   .letra{
    font-size:6.5;
}
   .derecha {
    text-align: right;
    vertical-align:middle!important;
}


   .borde {
       border:1px dotted black!important;            
   } 
   
   .borderecho{
   border-right:1px dotted black!important;
   }

   .bordeizq{            
       border-left:1px dotted black!important;
   }       
       
</style>

</head>
<body>
<div class="centrar"><strong>HOJA ANEXA</strong></div>
 
   <div id="contenedorpdfpagina2">
   <table  id="pdfpaginados" style="width:100%">
   
           <tr>
                <td colspan="22" class="borde">
                    Certificado N°:
                    <p class="centrar"><strong>CERTIFICADO DE ORIGEN</strong></p>
                    <p class="">Tratado de Libre Comercio entre Colombia y Costa Rica</p>                    
                </td>
            </tr>  
            
<!-- DESCRIPCION MERCANCIAS -->
   
            <tr class="centrar">
            <td colspan="1" class="bordeizq borderecho">4. Item:</td>
            <td colspan="10" class="borderecho">5. Descripción de las Mercancías:</td>
            <td colspan="3" class="borderecho">6. Clasificación Arancelaria SA <br>(6 Digitos):</td>
            <td colspan="3" class="borderecho">7. Número <br> de la <br>Factura:</td>
            <td colspan="3" class="borderecho">8. Valor en<br>Factura:</td>
            <td colspan="2" class="borderecho">9. Criterio <br>de Origen:</td>
            </tr>
    <!-- DESCRIPCION MERCANCIAS -->
    <!-- tablaUno TABLA UNO INSERTADA --> 

            '. $tablaDos.'
   
    <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class="borde">10. Observaciones:<br>'. $datos["Observaciones"]. '</td>
            </tr>
    <!-- SECCION ONCE -->
            <tr>             
                <td colspan="11" class="borde">
                    11. Declaración del exportador
                    <p>El abajo firmante declara bajo juramento que la información consignada en este certificado de origen es correcta y verdadera y que las mercancías fueron producidas en:</p>
                    <table>
                        <tr>
                            <td style="border-bottom:0.1px dotted black;" width="180px" >  COLOMBIA
                            </td>
                        </tr>
                        <tr>
                            <td class="centrar">(país)
                            </td>
                        </tr>    
                    </table>
                    <p>y cumplen con las disposiciones del Capitulo 3 (Reglas de Origen y Procedimientos de Origen) establecidas en el Tratado de Libre Comercio entre la República de Colombia y la
                    República de Costa Rica y exportadas a:</p>
                    <table>
                    <tr>
                        <td style="border-bottom:0.1px dotted black;" width="180px" >  COSTA RICA
                        </td>
                    </tr>
                    <tr>
                        <td class="centrar">
                            (país de importación)
                        </td>
                    </tr>    
                </table>
                    <p> <br><br>  <br> <br><br> <br> <br> <br> </p> 
                    <br>Lugar y fecha, firma del exportador
                    <br> '. $datos["LugarExp"]. ', '. $fechaexp . '
                </td>
    <!-- SECCION DOCE -->
                <td colspan="11" class="borde">
                    12. Certificación de la autoridad competente:
                    <p>Sobre la base del control efectuado, se certifica por este medio que la información aquí señalada es correcta y que las mercancías descritas cumplen con las disposiciones del Tratado de Libre Comercio entre la República de Colombia y la República de Costa Rica.</p>                
                    <p>Lugar y fecha, nombre y firma del funcionario y sello de la autoridad competente:</p>                
                    <p> <br> <br><br> <br> <br> <br> <br> <br> <br><br></p>                 
                    <p></p>
                    <br>Dirección:  '. $datos["DireccionAutoCompe"]. '
                    <br>Teléfono:   '. $datos["TelefonoAutoCompe"]. ' Fax:  '. $datos["FaxAutoCompe"]. '
                    <br>Correo electrónico:    '. $datos["CorreoAutoCompe"]. '
                </td>
            </tr>
    </table>';
    $pdf->writeHTML($paginaDos, true, 0, true, 0);
   }
/**fin nueva pagina */
$pdf->lastPage();

// $pdf->addPage();
// $pdf->writeHTML("<h1>nuevo contenido siguiente pagina</h1>", true, 0, true, 0);

$pdf->output('Reportecertificado.pdf', 'I');
}
function altofila($totFilas){
    $alto = 28;
        if ($totFilas == 0){
            $altoFila = 280;
        }elseif ($totFilas == 1){
            $altoFila = $alto * 7;
        }elseif ($totFilas == 2){
            $altoFila = $alto * 6;
        }elseif ($totFilas == 3){
            $altoFila = $alto * 5;
        }elseif ($totFilas == 4){
            $altoFila = $alto * 4;
        }elseif ($totFilas == 5){
            $altoFila = $alto * 3;
        }elseif ($totFilas == 6){
            $altoFila = $alto * 2;
        }elseif ($totFilas == 7){
            $altoFila = $alto;
        }elseif ($totFilas > 7){
            $altoFila = 0;
        }
        return $altoFila;
}
ob_flush();
?>