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
	$pdf->SetMargins(5, false, 5, false);
    $pdf->SetAutoPageBreak(true, 10);
/** PREFERENCIAS*/

/** PREFERENCIAS*/
    $pdf->SetFont('Times', '', 7);
    $pdf->SetFillColor(255, 235, 235);
    //$pdf->MultiCell(false, false, false, 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'M', false);    
    $pdf->addPage();
        
/******** GENERAR RESULTADO EN tablaUno *****/
setlocale(LC_TIME, 'es_CO', 'esp_esp'); 
//$k=1;
$tablaUno = '';
$tablaDos = '';
// $tablaDos = '<table cellspacing="1">';
$conteo = 0;
$tamanofila=1500; // TAMAÑO FILA****
$alto = 280; //Fijo 280
  //var_dump(count($descripcion));
  //var_dump($descripcion);
  if ($descripcion>0){
        $totFilas=count($descripcion);
            foreach($descripcion as $desc) {
                $conteo += strlen($desc["DescMercancia"]);
                if ($conteo<=$tamanofila ){
                    $tablaUno .= '<tr>';
                    // $tablaUno .= '<td style="width:25px" class="centrar">'. $desc["Item"] . '</td>';
                    $tablaUno .= '<td colspan="11" class="bordeizq borderecho">'. $desc['DescMercancia'] . '</td>';
                    $tablaUno .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['CritePreferencial']  . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['OtrosCriterios'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['Productor']  . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar bordeizq borderecho"><p>'. $desc['PaisdeOrigen']  . '</p></td>';                    
                    $tablaUno .= '</tr>';
                }else{
                    $tablaDos .= '<tr>';
                    // $tablaDos .= '<td style="width:25px" class="centrar">'. $desc['Item'] . '</td>';
                    $tablaDos .= '<td colspan="11" class="bordeizq borderecho">'. $desc['DescMercancia'] . '</td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['CritePreferencial']  . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['OtrosCriterios'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['Productor']  . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar bordeizq borderecho"><p>'. $desc['PaisdeOrigen']  . '</p></td>';                    
                    $tablaDos .= '</tr>';
                }
            }
            $alto = altofila($conteo, $totFilas);
        }else{
            // $tablaUno.='<tr><td colspan="22" class="centrar bordeizq borderecho"></td></tr>';
            // $tablaDos.='<tr><td colspan="22" class="centrar bordeizq borderecho"></td></tr>';
        }
            //$tablaUno.='</thead>';
            //$tablaDos.='</table>';
            //$FechaAutoCompe = strftime("%d de %B de %Y", strtotime($datos["FechaAutoCompe"]));            
            $diaDesde = strftime("%d", strtotime($datos["FechaDesde"]));
            $mesDesde = strftime("%m", strtotime($datos["FechaDesde"]));
            $AnioDesde = strftime("%Y", strtotime($datos["FechaDesde"]));

            $diaHasta = strftime("%d", strtotime($datos["FechaHasta"]));
            $mesHasta = strftime("%m", strtotime($datos["FechaHasta"]));
            $AnioHasta = strftime("%Y", strtotime($datos["FechaHasta"]));

            $diaElabora = strftime("%d", strtotime($datos["FechaElabora"]));
            $mesElabora = strftime("%m", strtotime($datos["FechaElabora"]));
            $AnioElabora = strftime("%Y", strtotime($datos["FechaElabora"]));

    $content = '';
    $content .= '
     <html>
     <head>
     <link rel="shortcut icon" href="../assets/logo.ico" type="image/x-icon">
    <style>
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
        <strong>
        <br>Tratado de Libre Comercio entre las Repúblicas de Colombia, El Salvador, Guatemala y Honduras
        <br>CERTIFICADO DE ORIGEN
        <br>INSTRUCCIONES DE LLENADO AL REVERSO
        </strong>
    </div>     
    
    <div id="contenedorpdf">            
    <!-- SECCION 1 EXPORTADOR  style="width:250px" -->
            <table height="800px" style="width:100%;" class="">
                <tr>
                    <td colspan="16"></td>
                    <td colspan="6"class="borde izquierda">Número de Certificado:</td>
                </tr>
                <tr>
                    <td colspan="11" class="borde" height="75px">1. Nombre, dirección y número de registro fiscal del exportador:
                        <br>'. $datos["NombreExp"]. '
                        <br>'. $datos["DireccionExp"]. '
                        <br>
                        <br>TEL:'. $datos["TelefonoExp"]. '
                        <br>RUT O NIT: '. $datos["NumRegFiscalExp"]. '
                    </td>
    <!-- SECCION 2 PERIODO QUE CUBRE -->
                    <td colspan="11" class="borde">2. Periodo que cubre
                        <br><br>
                                <table class="centrar">
                                    <tr>
                                        <td></td>
                                        <td class="anchocol">D</td>
                                        <td class="anchocol">M</td>
                                        <td class="anchocoly">A</td>
                                        <td></td>
                                        <td class="anchocol">D</td>
                                        <td class="anchocol">M</td>
                                        <td class="anchocoly">A</td>
                                    </tr>
                                    <tr>
                                        <td>De:</td>
                                        <td class="borde">'. $diaDesde . '</td>
                                        <td class="borde">'. $mesDesde . '</td>
                                        <td class="borde">'. $AnioDesde .'</td>
                                        <td class="derecha">A:</td>
                                        <td class="borde">'. $diaHasta .'</td>
                                        <td class="borde">'. $mesHasta .'</td>
                                        <td class="borde">'. $AnioHasta .'</td>
                                    </tr>
                                </table>
                        <br>
                        <table>
                            <tr>
                                <td width="110px">Número de Factura Comercial:</td>
                                <td class="numfactura borde centrar">'.$datos["NumFacturaComercial"].'</td>
                            </tr>
                        </table>
                        <br>
                    </td>
                </tr>
    <!-- SECCION 3 PRODUCTOR -->
                <tr>
                    <td colspan="11" class="borde" height="75px">3. Nombre, dirección y número de registro fiscal del productor:
                        <br>'. $datos["NombrePro"]. '
                        <br>'. $datos["DireccionPro"]. '
                        <br>
                        <br>TEL: '. $datos["TelefonoPro"]. '
                        <br>RUT O NIT: '. $datos["NumRegFiscalPro"]. '<br>
                    </td>
    <!-- SECCION 4 IMPORTADOR -->
                    <td colspan="11" class="borde">4. Nombre, dirección y número de registro fiscal del importador: 
                        <br>'. $datos["NombreImp"]. '
                        <br>'. $datos["DireccionImp"]. '
                        <br>
                        <br>TEL: '. $datos["TelefonoImp"]. '
                        <br>RUT O NIT: '. $datos["NumRegFiscalImp"]. '
                        <br>
                    </td>
                </tr>

    <!-- DESCRIPCION MERCANCIAS -->                              
                <!-- <tr >
                        <td class="borde" height="px">1</td>
                        <td class="borde">2</td>
                        <td class="borde">3</td>
                        <td class="borde">4</td>
                        <td class="borde">5</td>
                        <td class="borde">6</td>
                        <td class="borde">7</td>
                        <td class="borde">8</td>
                        <td class="borde">9</td>
                        <td class="borde">10</td>
                        <td class="borde">11</td>
                        <td class="borde">12</td>
                        <td class="borde">13</td>
                        <td class="borde">14</td>
                        <td class="borde">15</td>
                        <td class="borde">16</td>
                        <td class="borde">17</td>
                        <td class="borde">18</td>
                        <td class="borde">19</td>
                        <td class="borde">20</td>
                        <td class="borde">21</td>
                        <td class="borde">22</td>
                </tr>-->                
                    <tr>
                            <td colspan="11" valign="middle" class="borde"><p>5. Descripción de la(s) mercancía(s)</p></td>
                            <td colspan="3" class="borde centrar">6. Clasificación <br>Arancelaria</td>
                            <td colspan="2" class="borde centrar">7. Criterio para trato preferencial</td>
                            <td colspan="2" class="borde centrar">8. Otros criterios</td>
                            <td colspan="2" class="borde centrar">9. Productor</td>
                            <td colspan="2" class="centrar borde">10. País de Origen</td>
                    </tr>
                
<!--            </table> QUITAR -->  
            
    <!-- TABLA UNO INSERTADA //  . $TABLAUNO . -->
    
                        ' . $tablaUno .'

                <tr>
                        <td colspan="11" class="bordeizq" height="'. $alto .'px"></td>
                        <td colspan="3" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="centrar bordeizq borderecho"></td>
                </tr> 

                <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class="borde"><p>11. Observaciones:<br>'. $datos["Observaciones"]. ' </p></td>
            </tr>

    <!-- SECCION ONCE -->
            <tr>
                <td colspan="22" class="bordeizq borderecho">12. Declaro bajo juramento que :</td>
            </tr>
            <tr>
                <td colspan="1" width="3%" class="bordeizq "></td>
                <td colspan="21" width="97%" class="borderecho">
                    <br>- Las mercancías son originarias del territorio de una Parte y cumplen con todos los requisitos de origen que les son aplicables conforme al Tratado de Libre Comercio entre las
                    Repúblicas de Colombia, El Salvador, Guatemala y Honduras y que no han sido objeto de procesamiento ulterior o de cualquier otra operación fuera de los territorios de las Partes;
                    salvo en los casos permitidos en el Artículo 4.14 o en el Anexo 4.3
                    <p>- La información contenida en este documento es verdadera y exacta y me hago responsable de comprobar lo aquí certificado. Estoy consciente que soy responsable por cualquier
                    declaración falsa u omisión material hecha en o relacionada con el presente documento.</p>
                    <p>- Me comprometo a conservar y presentar, en caso de ser requerido, los documentos necesarios que respalden el contenido del presente certificado, así como a notificar por escrito a
                    todas las personas a quienes se ha entregado el presente certificado, de cualquier cambio que pudiera afectar la exactitud o validez del mismo.</p>
                    
                    <p>Este certificado se compone, de <u>        </u>  hojas incluyendo todos sus anexos.<br></p>
                </td>
            </tr>
            <tr>
                <td colspan="11" class="borde">Firma Autorizada<br><br></td>
                <td colspan="11" class="borde">Empresa<br><br>'. $datos["EmpresaAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="borde">Nombre<br><br>'. $datos["NombreAutoriza"].'</td>
                <td colspan="11" class="borde">Cargo<br><br>'. $datos["CargoPersonAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="2" class="bordeizq bordesuperior">Fecha</td>
                <td colspan="1" class="centrar">D</td>
                <td colspan="1" class="centrar">M</td>
                <td colspan="1" class="centrar">A</td>
                <td colspan="8" class="bordeizq">Teléfono</td>
                <td colspan="9" class="bordeizq borderecho">Fax</td>
            </tr>
            <tr>
                <td colspan="2" class="bordeizq bordeinferior"></td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br>'. $diaElabora. '</td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br>'. $mesElabora. '</td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br>'. $AnioElabora. '</td>
                <td colspan="8" class="bordeizq bordeinferior"><br><br>Teléfono: '. $datos["TelPersonAutoriza"].'</td>
                <td colspan="9" class="bordeizq bordeinferior borderecho"><br><br>Fax: '. $datos["TelPersonAutoriza"].'</td>
            </tr>
            </table>
    </div>
    </html>';

$pdf->writeHTML($content, true, 0, true, 0);
/*********************************************PAGINA DOS *******************/
/*********************************************PAGINA DOS *******************/
if ($conteo>$tamanofila){
    $pdf->addPage();
    $paginaDos = '';
$paginaDos .= '
<html>
<head>
     <link rel="shortcut icon" href="../assets/logo.ico" type="image/x-icon">
    <style>
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
            <table cellspacing="0" cellpadding="1">    
                ' . $tablaDos .'
                <!-- <tr>
                        <td colspan="11" class="bordeizq"></td>
                        <td colspan="3" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="centrar bordeizq borderecho"></td>                        
                </tr> -->
                <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:30px" class="borde"><p>11. Observaciones:<br>'. $datos["Observaciones"]. ' </p></td>
            </tr>

        <!-- SECCION ONCE -->
            <tr>
                <td colspan="22" class="bordeizq borderecho">12. Declaro bajo juramento que :</td>
            </tr>
            <tr>
                <td colspan="1" width="3%" class="bordeizq "></td>
                <td colspan="21" width="97%" class="borderecho">
                    <br>- Las mercancías son originarias del territorio de una Parte y cumplen con todos los requisitos de origen que les son aplicables conforme al Tratado de Libre Comercio entre las
                    Repúblicas de Colombia, El Salvador, Guatemala y Honduras y que no han sido objeto de procesamiento ulterior o de cualquier otra operación fuera de los territorios de las Partes;
                    salvo en los casos permitidos en el Artículo 4.14 o en el Anexo 4.3
                    <p>- La información contenida en este documento es verdadera y exacta y me hago responsable de comprobar lo aquí certificado. Estoy consciente que soy responsable por cualquier
                    declaración falsa u omisión material hecha en o relacionada con el presente documento.</p>
                    <p>- Me comprometo a conservar y presentar, en caso de ser requerido, los documentos necesarios que respalden el contenido del presente certificado, así como a notificar por escrito a
                    todas las personas a quienes se ha entregado el presente certificado, de cualquier cambio que pudiera afectar la exactitud o validez del mismo.</p>
                    
                    <p>Este certificado se compone, de <u>        </u>  hojas incluyendo todos sus anexos.<br></p>
                </td>
            </tr>
            <tr>
                <td colspan="11" class="borde">Firma Autorizada<br><br></td>
                <td colspan="11" class="borde">Empresa<br><br>'. $datos["EmpresaAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="borde">Nombre<br><br>'. $datos["NombreAutoriza"].'</td>
                <td colspan="11" class="borde">Cargo<br><br>'. $datos["CargoPersonAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="2" class="bordeizq bordesuperior">Fecha</td>
                <td colspan="1" class="centrar">D</td>
                <td colspan="1" class="centrar">M</td>
                <td colspan="1" class="centrar">A</td>
                <td colspan="8" class="bordeizq">Teléfono</td>
                <td colspan="9" class="bordeizq borderecho">Fax</td>
            </tr>
            <tr>
                <td colspan="2" class="bordeizq bordeinferior"></td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br>'. $diaElabora. '</td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br>'. $mesElabora. '</td>
                <td colspan="1" class="bordeizq centrar bordeinferior"><br><br>'. $AnioElabora. '</td>
                <td colspan="8" class="bordeizq bordeinferior"><br><br>Teléfono: '. $datos["TelPersonAutoriza"].'</td>
                <td colspan="9" class="bordeizq bordeinferior borderecho"><br><br>Fax: '. $datos["TelPersonAutoriza"].'</td>
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

function altofila($conteo, $totFilas){
        if ($conteo > 0 &&$conteo <=72 || $totFilas ==1){
            $alto = 245; //267
        }elseif ($conteo > 72 &&$conteo <=144 || $totFilas ==2){
            $alto = 248;
        }elseif ($conteo > 144 && $conteo <= 216 || $totFilas ==3){
            $alto = 241;
        }elseif ($conteo > 216 && $conteo <= 288 || $totFilas ==4){
            $alto = 228;
        }elseif ($conteo > 288 && $conteo <= 360 || $totFilas ==5){
            $alto = 215;
        }elseif ($conteo > 360 && $conteo <= 432 || $totFilas ==6){
            $alto = 202;
        }elseif ($conteo > 432 && $conteo <= 504 || $totFilas ==7){
            $alto = 189;
        }elseif ($conteo > 504 && $conteo <= 576 || $totFilas ==8){
            $alto = 176;
        }elseif ($conteo > 576 && $conteo <= 648 || $totFilas ==9){
            $alto = 163;
        }elseif ($conteo > 648 && $conteo <= 720 || $totFilas ==10){
            $alto = 150;
        }elseif ($conteo > 720 && $conteo <= 792 || $totFilas ==11){
            $alto = 137;
        }elseif ($conteo > 792 && $conteo <= 864 || $totFilas ==12){
            $alto = 124;
        }elseif ($conteo > 864 && $conteo <= 936 || $totFilas ==13){
            $alto = 111;
        }elseif ($conteo > 936 && $conteo <= 1008 || $totFilas ==14){
            $alto = 98;
        }elseif ($conteo > 1008 && $conteo <= 1080 || $totFilas ==15){
            $alto = 85;
        }elseif ($conteo > 1080 && $conteo <= 1152 || $totFilas ==16){
            $alto = 72;
        }elseif ($conteo > 1152 && $conteo <= 1224 || $totFilas ==17){
            $alto = 59;
        }elseif ($conteo > 1224 && $conteo <= 1296 || $totFilas ==18){
            $alto = 46;
        }elseif ($conteo > 1296 && $conteo <= 1368 || $totFilas ==19){
            $alto = 33;
        }elseif ($conteo > 1368 && $conteo <= 1440 || $totFilas ==20){
            $alto = 20;
        }elseif ($conteo > 1440 ){
            $alto = 0;
        }
        return $alto;
}
ob_flush();
?>