<?php   
ob_start();
include "libs/conecta.php";
$id= $_GET["p"];
include "libs/consulta.php";
//var_dump($datos);
//var_dump($descripcion);
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
	$pdf->SetMargins(12, false, 12, false);
    $pdf->SetAutoPageBreak(true, 10);
/** PREFERENCIAS*/

/** PREFERENCIAS*/
    $pdf->SetFont('Times', '', 7);
    $pdf->SetFillColor(255, 235, 235);
    //$pdf->MultiCell(false, false, false, 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'M', false);    
    $pdf->addPage();
        
/******** GENERAR RESULTADO EN tablaUno *****/
setlocale(LC_TIME, 'es_CO', 'esp_esp'); 
$k=0;
$paginas = 1;
$tablaUno = '';
$tablaDos = '';
// $tablaDos = '<table cellspacing="1">';
$conteo = 0;
$tamanofila=1500; // TAMAÑO FILA****
$alto = 26; //Fijo 280
  //var_dump(count($descripcion));
  //var_dump($descripcion);
  if ($descripcion>0){
        $totFilas=count($descripcion);
            $altoFila = altofila($totFilas);
            foreach($descripcion as $desc) {
                $k++;
                //$conteo += strlen($desc["DescMercancia"]);
                if ($k <= 11 ){
                    if ($k == $totFilas){
                        $alto = $altoFila;
                    }
                    $tablaUno .= '<tr>';
                    // $tablaUno .= '<td style="width:25px" class="centrar">'. $desc["Item"] . '</td>';
                    $tablaUno .= '<td colspan="2" class="bordeizq borderecho centrar" height="'. $alto. 'px">'. $desc['NoOrden'] . '</td>';
                    $tablaUno .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['Naladisa'] . '</p></td>';
                    $tablaUno .= '<td colspan="13" class="letra justificar borderecho"><p>'. $desc['DescMercancia']  . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['PesoCantidad'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['ValorFob']  . '</p></td>';
                    //$tablaUno .= '<td colspan="2" class="centrar bordeizq borderecho"><p>'. $desc['Normas']  . '</p></td>';
                    $tablaUno .= '</tr>';
                }else{
                    $paginas = 2;
                    $tablaDos .= '<tr>';
                    // $tablaDos .= '<td style="width:25px" class="centrar">'. $desc['Item'] . '</td>';
                    $tablaDos .= '<td colspan="2" class="bordeizq borderecho centrar" height="'. $alto. 'px">'. $desc['NoOrden'] . '</td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['Naladisa'] . '</p></td>';
                    $tablaDos .= '<td colspan="13" class="letra centrar borderecho"><p>'. $desc['DescMercancia'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['PesoCantidad'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['ValorFob'] . '</p></td>';
                    //$tablaDos .= '<td colspan="2" class="centrar bordeizq borderecho"><p>'. $desc['PaisdeOrigen']  . '</p></td>';
                    $tablaDos .= '</tr>';
                }                
            }
        }else{
             $tablaUno.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="280px"></td></tr>';
             $tablaDos.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="280px"></td></tr>';
        }
            //$tablaUno.='</thead>';
            //$tablaDos.='</table>';
            //$FechaAutoCompe = strftime("%d de %B de %Y", strtotime($datos["FechaAutoCompe"]));            
            // $diaDesde = strftime("%d", strtotime($datos["FechaDesde"]));
            // $mesDesde = strftime("%m", strtotime($datos["FechaDesde"]));
            // $AnioDesde = strftime("%Y", strtotime($datos["FechaDesde"]));

            // $diaHasta = strftime("%d", strtotime($datos["FechaHasta"]));
            // $mesHasta = strftime("%m", strtotime($datos["FechaHasta"]));
            // $AnioHasta = strftime("%Y", strtotime($datos["FechaHasta"]));

            // $diaElabora = strftime("%d", strtotime($datos["FechaElabora"]));
            // $mesElabora = strftime("%m", strtotime($datos["FechaElabora"]));
            // $AnioElabora = strftime("%Y", strtotime($datos["FechaElabora"]));

    // $NomPro = $datos["NombrePro"];
    // if ($NomPro == 'IGUAL' || $NomPro == 'VARIOS' || $NomPro == 'DISPONIBLE A SOLICITUD DE LA AUTORIDAD COMPETENTE' || $NomPro == 'DESCONOCIDO')
	// {
    //     $Resul = '';
    // }else{
    //     $Resul = '<br>TEL: '. $datos['TelefonoPro']. '';
    //     $Resul .= '<br>RUT O NIT: ' . $datos['NumRegFiscalPro']. '';        
    // }

    $content = '';
    $content .= '
     <html>
     <head>
     <link rel="shortcut icon" href="../assets/logo.ico" type="image/x-icon">
    <style>
        .justificar{
            text-align:justify;
        }
        .letra{
            font-size:6.5;
        } 
        .clasedelafila { 
            empty-cells: show; 
            min-height: 300px; //cambiar al alto necesario
        }
        .numfactura{
            width:160px;
        }
        
        .anchocol{
            width:20px;
        }
        
        .anchocoly{
            width:25px;
        }
        .centrar {
            text-align: center;
            vertical-align:middle!important;
        }

        .derecha {
            text-align: right;
            vertical-align:middle!important;
        }
        .underline{
            width:20px!important;
            text-decoration: none;
            border-bottom: 0.4px dotted black;            
        }

        .borde {
            border:1px dotted black!important;
        }

        .bordesuperior {
            border-top:1px dotted black!important;
        } 

        .bordeinferior {
            border-bottom:1px dotted black!important;
        }
        
        .borderecho{
            border-right:1px dotted black!important;
        }

        .bordeizq{
            margin-right: 25px;
            border-left:1px dotted black!important;
        }

        .altotabla{
            max-height:300px;            
        }
                    
    </style>    
    </head>
    <body>
    <div class="centrar anchocol" >
        
    </div>     
    
    <div id="contenedorpdf">            
    <!-- SECCION 1 EXPORTADOR  style="width:250px" -->
            <table height="800px" style="width:100%;" class="">
                <tr>
                    <td colspan="19" class="centrar borderecho bordeizq bordesuperior"><strong>
                        <br>CERTIFICADO DE ORIGEN
                        <br>Acuerdo Colombia - Mercosur
                        </strong>
                    </td>
                    <td colspan="3" class="centrar borde" ><strong>
                        N° del Certificado
                        </strong>
                    </td>
                </tr>
                <tr>
                    <td colspan="19" class="bordeizq" >
                    </td>
                    <td colspan="3" class="centrar borde" >
                    </td>
                </tr>
                <tr>
                    <td colspan="11" class=" bordeinferior bordeizq" height="15px">PAÍS EXPORTADOR:    COLOMBIA                        
                    </td>
                    <td colspan="11" class="bordeinferior borderecho">PAÍS IMPORTADOR:    '. $datos["PaisImp"] .'                        
                    </td>
                </tr>
    <!-- SECCION DESCRIPCION DE LAS MERCANCIAS -->                
                <tr>
                    <td colspan="2" class="borde centrar">N° de Orden (1)</td>
                    <td colspan="3" class="borde centrar">NALADISA</td>
                    <td colspan="13" class="borde centrar">DENOMINACION DE LAS MERCANCÍAS</td>
                    <td colspan="2" class="borde centrar">Peso o Cantidad</td>
                    <td colspan="2" class="borde centrar">Valor FOB en (U$S)</td>
                </tr>
            
    <!-- TABLA UNO INSERTADA //  . $TABLAUNO . -->
    
                        ' . $tablaUno .'
    <!-- SECCION DECLARACION DE ORIGEN -->
                <tr>
                    <td colspan="22" style="height:40px" class="borde"><p class="centrar"><strong>DECLARACION DE ORIGEN</strong></p><p class="justificar">DECLARAMOS que las mercancías indicadas en el presente formulario, correspondientes a la Factura(s) Comercial(es) No. '.$datos["NoFacturaComercial"].' de
                        fecha(s) respectivamente '.$datos["FechaDeclaOrigen"].', cumplen con lo establecido en las normas de origen del presente Acuerdo A.C.E. No. 72 de conformidad con
                        el siguiente desglose.
                    </p></td>
                </tr>                        
                <!-- <tr>
                        <td colspan="11" class="bordeizq" ></td>
                        <td colspan="3" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="centrar bordeizq borderecho"></td>
                </tr>   --> 

    <!-- SECCION NORMAS -->
                <tr>
                    <td colspan="2" class="borde centrar"><strong>N° de Orden (1)</strong></td>                    
                    <td colspan="20" class="borde centrar"><strong>NORMAS (2)</strong></td>
                </tr>

                <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class="borde">11. Observaciones:<br><span class="letra">'.$datos["Observaciones"].'</span></td>
            </tr>


            </table>
    </div>
    </html>';

$pdf->writeHTML($content, true, 0, true, 0);
/*********************************************PAGINA DOS *******************/
/*********************************************PAGINA DOS *******************/
if ($k>11){
    $pdf->addPage();
    $paginaDos = '';
    $paginaDos .= '
<html>
<head>
     <link rel="shortcut icon" href="../assets/logo.ico" type="image/x-icon">
    <style>
    .letra{
        font-size:6.5;
    } 
        .clasedelatabla { empty-cells: show; 
        min-height: 130px; //cambiar al alto necesario
        }
        .numfactura{
            width:160px;
        }
        .anchocol{
            width:20px;
        }

        .anchocoly{
            width:25px;
        }
        .centrar {
            text-align: center;
            vertical-align:middle!important;
        }
        .derecha {
            text-align: right;
            vertical-align:middle!important;
        }
        .underline{
            width:20px!important;
            text-decoration: none;
            border-bottom: 0.4px dotted black;            
        }

        .borde {
            border:1px dotted black!important;
        }

        .bordesuperior {
            border-top:1px dotted black!important;
        } 

        .bordeinferior {
            border-bottom:1px dotted black!important;
        }
        
        .borderecho{
            border-right:1px dotted black!important;
        }

        .bordeizq{
            margin-right: 25px;
            border-left:1px dotted black!important;
        }       
                    
    </style>    
    </head>
        <div class="centrar anchocol" >
        <strong>
        <br><br><br>Tratado de Libre Comercio entre las Repúblicas de Colombia, El Salvador, Guatemala y Honduras
        <br>CERTIFICADO DE ORIGEN
        <br>HOJA ANEXA
        </strong>
        </div>     

        <div id="contenedorpdf">            
        <!-- SECCION 1 EXPORTADOR  style="width:250px" -->
            <table height="800px" style="width:100%;" class="">
                <tr>
                    <td colspan="16"></td>
                    <td colspan="6"class="borde izquierda">Número de Certificado:</td>
                </tr>
        <!-- DESCRIPCION MERCANCIAS -->
                <tr>
                        <td colspan="11" valign="middle" class="borde"><p>5. Descripción de la(s) mercancía(s)</p></td>
                        <td colspan="3" class="borde centrar">6. Clasificación <br>Arancelaria</td>
                        <td colspan="2" class="borde centrar">7. Criterio para trato preferencial</td>
                        <td colspan="2" class="borde centrar">8. Otros criterios</td>
                        <td colspan="2" class="borde centrar">9. Productor</td>
                        <td colspan="2" class="centrar borde">10. País de Origen</td>                        
                </tr>
            </table>
    <!-- TABLA DOS INSERTADA //  . $TABLADOS . -->
            <table cellspacing="0" cellpadding="2">
                ' . $tablaDos .'
                <tr>
                        <td colspan="11" class="bordeizq" height="250px"></td>
                        <td colspan="3" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="centrar bordeizq borderecho"></td>                        
                </tr> 
                <!-- OBSERVACIONES PAGINA DOS -->
            <tr>
                <td colspan="22" style="height:40px" class="borde">11. Observaciones:<br><span class="letra"></span></td>
            </tr>

        <!-- SECCION ONCE -->
            <tr>
                <td colspan="22" class="bordeizq borderecho">12. Declaro bajo juramento que :</td>
            </tr>
            <tr>
                <td colspan="1" width="2%" class="bordeizq "></td>
                <td colspan="21" width="98%" class="borderecho">
                    <br>- Las mercancías son originarias del territorio de una Parte y cumplen con todos los requisitos de origen que les son aplicables conforme al Tratado de Libre Comercio entre las
                    Repúblicas de Colombia, El Salvador, Guatemala y Honduras y que no han sido objeto de procesamiento ulterior o de cualquier otra operación fuera de los territorios de las Partes;
                    salvo en los casos permitidos en el Artículo 4.14 o en el Anexo 4.3
                    <p>- La información contenida en este documento es verdadera y exacta y me hago responsable de comprobar lo aquí certificado. Estoy consciente que soy responsable por cualquier
                    declaración falsa u omisión material hecha en o relacionada con el presente documento.</p>
                    <p>- Me comprometo a conservar y presentar, en caso de ser requerido, los documentos necesarios que respalden el contenido del presente certificado, así como a notificar por escrito a
                    todas las personas a quienes se ha entregado el presente certificado, de cualquier cambio que pudiera afectar la exactitud o validez del mismo.</p>
                    
                    
                </td>
            </tr>
            <tr>
                <td colspan="11" class="borde">     Firma Autorizada<br><br></td>
                <td colspan="11" class="borde">Empresa<br><br></td>
            </tr>
            <tr>
                <td colspan="11" class="borde">     Nombre<br><br>     </td>
                <td colspan="11" class="borde">Cargo<br><br></td>
            </tr>
            <tr>
                <td colspan="2" class="bordeizq bordesuperior">     Fecha</td>
                <td colspan="1" class="centrar">D</td>
                <td colspan="1" class="centrar">M</td>
                <td colspan="1" class="centrar">A</td>
                <td colspan="8" class="bordeizq">Teléfono</td>
                <td colspan="9" class="bordeizq borderecho">Fax</td>
            </tr>
            <tr>
                <td colspan="2" class="bordeizq bordeinferior"></td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br></td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br></td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br></td>
                <td colspan="8" class="bordeizq bordeinferior"><br><br>Teléfono: </td>
                <td colspan="9" class="bordeizq bordeinferior borderecho"><br><br>Fax: </td>
            </tr>
            </table>
        </div>
</html>';
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
            $altoFila = $alto * 10;
        }elseif ($totFilas == 2){
            $altoFila = $alto * 9;
        }elseif ($totFilas == 3){
            $altoFila = $alto * 8;
        }elseif ($totFilas == 4){
            $altoFila = $alto * 7;
        }elseif ($totFilas == 5){
            $altoFila = $alto * 6;
        }elseif ($totFilas == 6){
            $altoFila = $alto * 5;
        }elseif ($totFilas == 7){
            $altoFila = $alto * 4;
        }elseif ($totFilas == 8){
            $altoFila = $alto * 3;
        }elseif ($totFilas == 9){
            $altoFila = $alto * 2;
        }elseif ($totFilas == 10){
            $altoFila = $alto;
        }elseif ($totFilas > 10){
            $altoFila = 0;
        }
        return $altoFila;
}
ob_flush();
?>