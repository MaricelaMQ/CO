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
	$pdf->SetTitle("CO - Canada");
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
$nfilas = 7;
$conteo = 0;
//$tamanofila=1500; // TAMAÑO FILA****
$alto = 28; //Fijo 280
  //var_dump(count($descripcion));
  //var_dump($descripcion);
  if ($descripcion>0){
        $totFilas=count($descripcion);
            $altoFila = altofila($totFilas);
            foreach($descripcion as $desc) {
                $k++;
                //$conteo += strlen($desc["DescMercancia"]);
                if ($k == $totFilas){
                    $alto = $altoFila;
                }

                if ($k <= $nfilas ){
                    
                    $tablaUno .= '<tr>';
                    // $tablaUno .= '<td style="width:25px" class="centrar">'. $desc["Item"] . '</td>';
                    $tablaUno .= '<td colspan="11" class="letra bordeizq borderecho" height="'. $alto. 'px">'. $desc['DescMercancia'] . '</td>';
                    $tablaUno .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['CritPreferencial']  . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['Productor'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['PruebadeValor'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar bordeizq borderecho"><p>'. $desc['PaisdeOrigen']  . '</p></td>';
                    $tablaUno .= '</tr>';
                }else{
                    $paginas = 2;
                    $tablaDos .= '<tr>';
                    // $tablaDos .= '<td style="width:25px" class="centrar">'. $desc['Item'] . '</td>';
                    $tablaDos .= '<td colspan="11" class="letra bordeizq borderecho" height="'. $alto. 'px">'. $desc['DescMercancia'] . '</td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['CritPreferencial']  . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['Productor'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['PruebadeValor'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar bordeizq borderecho"><p>'. $desc['PaisdeOrigen']  . '</p></td>';
                    $tablaDos .= '</tr>';
                }                
            }
        }else{
             $tablaUno.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="190px"></td></tr>';
             $tablaDos.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="190px"></td></tr>';
        }
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

    // $NomPro = $datos["NombrePro"];
    // if ($NomPro == 'IGUAL' || $NomPro == 'VARIOS' || $NomPro == 'DISPONIBLE A SOLICITUD DE LA AUTORIDAD COMPETENTE' || $NomPro == 'DESCONOCIDO')
	// {
    //     $Resul = '';
    // }else{        
    //     $Resul = 0;
    //     // $Resul .= '<br>RUT O NIT: ' . $datos['NumRegFiscalPro']. '';
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
    
    <div id="contenedorpdf">            
    <!-- SECCION 1 EXPORTADOR  style="width:250px" -->
            <table height="800px" style="width:100%;" class="">
            <tr>
                <td colspan="22" class="centrar " height="50px" style="font-size:9;">
                    <strong>
                    <br>Certificate of Origin
                    <br>Canada – Colombia Free Trade Agreement
                    </strong>
                    <br>(Instructions on reverse)                    
                </td>
            </tr>
                <tr>
                    <td colspan="11" class="borde" height="75px">1. Exporter’s Name and Address: '. $datos["NombreExp"]. '
                        <br>Address: '. $datos["DireccionExp"]. '
                        <br><br>Telephone:'. $datos["TelefonoExp"]. ' Fax: '. $datos["FaxExp"]. '
                        <br><br>E-mail: '. $datos["CorreoExp"]. '
                    </td>
    <!-- SECCION 2 PERIODO QUE CUBRE -->
                    <td colspan="11" class="borde">2. Blanket Period:
                        <br><br>
                                <table class="" width="100%">
                                    <tr>
                                        <td class="" width="60px"></td>
                                        <td class=""> YYYY   MM   DD<br></td>
                                        <td class=""> YYYY   MM   DD</td>
                                    </tr>
                                    <tr>
                                        <td class="" width="60px"></td>
                                        <td class="">From: '. $AnioDesde . '/'.$mesDesde.'/'. $diaDesde .'</td>
                                        <td class="">To: '. $AnioHasta . '/'.$mesHasta.'/'. $diaHasta .'</td>
                                    </tr>
                                </table>
                    </td>
                </tr>
    <!-- SECCION 3 PRODUCTOR -->
                <tr>
                    <td colspan="11" class="borde" height="75px">3. Producer’s Name and Address: '. $datos["NombrePro"]. '
                        <br><br>Address: '. $datos["DireccionPro"]. '
                        <br><br>Telephone: '. $datos['TelefonoPro']. ' Fax: '. $datos['FaxPro']. '
                        <br><br>E-mail: '. $datos["CorreoPro"]. '<br>
                    </td>
    <!-- SECCION 4 IMPORTADOR -->
                    <td colspan="11" class="borde">4. Importer’s Name and Address: '. $datos["NombreImp"]. '
                        <br><br>Address: '. $datos["DireccionImp"]. '
                        <br><br>Telephone: '. $datos["TelefonoImp"]. ' Fax: '. $datos["FaxImp"]. '
                        <br><br>E-Mail: '. $datos["CorreoImp"]. '
                    </td>
                </tr>

    <!-- DESCRIPCION MERCANCIAS -->
                
                    <tr>
                        <td colspan="11" valign="middle" class="borde centrar"><p>5. Description of Good(s)</p></td>
                        <td colspan="3" class="borde centrar">6. HS Tariff Classification</td>
                        <td colspan="2" class="borde centrar">7. Preference Criterion</td>
                        <td colspan="2" class="borde centrar">8. Producer</td>
                        <td colspan="2" class="borde centrar">9. Value Test</td>
                        <td colspan="2" class="centrar borde">10. Country of Origin</td>
                    </tr>
            
    <!-- TABLA UNO INSERTADA //  . $TABLAUNO . -->
    
                        ' . $tablaUno .'                     

    <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class="borde">11. Observations: <br><span class="letra"> '.$datos["Observaciones"].'</span></td>
            </tr>
    <!-- SECCION ONCE -->
            <tr>
                <td colspan="22" class="bordeizq borderecho bordesuperior"> I certify that:<br></td>
            </tr>
            <tr>
                <td colspan="22" class="bordeizq borderecho"><span class="justificar"> - The information in this document is true and accurate and I assume the responsibility for proving such representations. I understand that I am liable for any false statements or material omissions made on or in connection with this document.</span><br></td>
            </tr>
            <tr>                
                <td colspan="22" class="bordeizq borderecho"><span class="justificar"> - I agree to maintain, and present upon request, documentation necessary to support this Certificate, and to inform, in writing, all persons to whom the Certificate was given of any changes that would affect the accuracy or validity of this Certificate.</span><br></td>
            </tr>
            <tr>
                <td colspan="22" class="bordeizq borderecho"><p class="justificar"> - The goods originate in the territory of one or both Parties and comply with the origin requirements specified for those goods in the Canada – Colombia Free Trade Agreement.</p></td>
            </tr>
            
            <tr>
                <td colspan="22" class="bordeizq borderecho"><br><br> This certificate consist of <u>   ' . $paginas. '   </u> pages, including attachments.<br></td>
            </tr>
            <tr>
                <td colspan="11" class="borde"> 12.Authorized signature:<br></td>
                <td colspan="11" class="borde">Company: '. $datos["EmpresaAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="borde"> Name: '. $datos["NombreAutoriza"].'</td>
                <td colspan="11" class="borde">Title: '. $datos["CargoPersonAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="borde"><div style="font-size:2"> </div>            YYYY   MM   DD
                    <div style="font-size:2"> </div> Date: '. $AnioElabora. '/'. $mesElabora.'/'. $diaElabora . '
                    
                </td>
                <td colspan="11" class="bordeizq bordeinferior borderecho"><div style="font-size:2"> </div>Telephone: '. $datos["TelPersonAutoriza"].' FAX: '. $datos["FaxPersonAutoriza"].'
                    <br>E-mail: '. $datos["CorreoPersonAutoriza"]. '
                </td>                
            </tr>
            </table>
    </div>
    </html>';

$pdf->writeHTML($content, true, 0, true, 0);
/*********************************************PAGINA DOS *******************/
/*********************************************PAGINA DOS *******************/
if ($k > $nfilas){
    $pdf->addPage();
    $paginaDos = '';
    $paginaDos .= '
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
    
    <div id="contenedorpdf">            
    <!-- SECCION 1 EXPORTADOR  style="width:250px" -->
            <table height="800px" style="width:100%;" class="">
            <tr>
                <td colspan="22" class="centrar " height="50px" style="font-size:9;">
                    <strong>
                    <br>Certificate of Origin
                    <br>Canada – Colombia Free Trade Agreement
                    </strong>
                    <br>(Instructions on reverse)                    
                </td>
            </tr>
                <tr>
                    <td colspan="11" class="borde" height="75px">1. Exporter’s Name and Address: '. $datos["NombreExp"]. '
                        <br>Address: '. $datos["DireccionExp"]. '
                        <br><br>Telephone:'. $datos["TelefonoExp"]. ' Fax: '. $datos["FaxExp"]. '
                        <br><br>E-mail: '. $datos["CorreoExp"]. '
                    </td>
    <!-- SECCION 2 PERIODO QUE CUBRE -->
                    <td colspan="11" class="borde">2. Blanket Period:
                        <br><br>
                                <table class="" width="100%">
                                    <tr>
                                        <td class="" width="60px"></td>
                                        <td class=""> YYYY   MM   DD<br></td>
                                        <td class=""> YYYY   MM   DD</td>
                                    </tr>
                                    <tr>
                                        <td class="" width="60px"></td>
                                        <td class="">From: '. $AnioDesde . '/'.$mesDesde.'/'. $diaDesde .'</td>
                                        <td class="">To: '. $AnioHasta . '/'.$mesHasta.'/'. $diaHasta .'</td>
                                    </tr>
                                </table>
                    </td>
                </tr>
    <!-- SECCION 3 PRODUCTOR -->
                <tr>
                    <td colspan="11" class="borde" height="75px">3. Producer’s Name and Address: '. $datos["NombrePro"]. '
                        <br><br>Address: '. $datos["DireccionPro"]. '
                        <br><br>Telephone: '. $datos['TelefonoPro']. ' Fax: '. $datos['FaxPro']. '
                        <br><br>E-mail: '. $datos["CorreoPro"]. '<br>
                    </td>
    <!-- SECCION 4 IMPORTADOR -->
                    <td colspan="11" class="borde">4. Importer’s Name and Address: '. $datos["NombreImp"]. '
                        <br><br>Address: '. $datos["DireccionImp"]. '
                        <br><br>Telephone: '. $datos["TelefonoImp"]. ' Fax: '. $datos["FaxImp"]. '
                        <br><br>E-Mail: '. $datos["CorreoImp"]. '
                    </td>
                </tr>

    <!-- DESCRIPCION MERCANCIAS -->
                
                    <tr>
                        <td colspan="11" valign="middle" class="borde centrar"><p>5. Description of Good(s)</p></td>
                        <td colspan="3" class="borde centrar">6. HS Tariff Classification</td>
                        <td colspan="2" class="borde centrar">7. Preference Criterion</td>
                        <td colspan="2" class="borde centrar">8. Producer</td>
                        <td colspan="2" class="borde centrar">9. Value Test</td>
                        <td colspan="2" class="centrar borde">10. Country of Origin</td>
                    </tr>
            
    <!-- TABLA UNO INSERTADA //  . $TABLAUNO . -->
    
                        ' . $tablaDos .'                     

    <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class="borde">11. Observations: <br><span class="letra"> '.$datos["Observaciones"].'</span></td>
            </tr>
    <!-- SECCION ONCE -->
            <tr>
                <td colspan="22" class="bordeizq borderecho bordesuperior"> I certify that:<br></td>
            </tr>
            <tr>
                <td colspan="22" class="bordeizq borderecho"><span class="justificar"> - The information in this document is true and accurate and I assume the responsibility for proving such representations. I understand that I am liable for any false statements or material omissions made on or in connection with this document.</span><br></td>
            </tr>
            <tr>                
                <td colspan="22" class="bordeizq borderecho"><span class="justificar"> - I agree to maintain, and present upon request, documentation necessary to support this Certificate, and to inform, in writing, all persons to whom the Certificate was given of any changes that would affect the accuracy or validity of this Certificate.</span><br></td>
            </tr>
            <tr>
                <td colspan="22" class="bordeizq borderecho"><p class="justificar"> - The goods originate in the territory of one or both Parties and comply with the origin requirements specified for those goods in the Canada – Colombia Free Trade Agreement.</p></td>
            </tr>
            
            <tr>
                <td colspan="22" class="bordeizq borderecho"><br><br> This certificate consist of <u>   ' . $paginas. '   </u> pages, including attachments.<br></td>
            </tr>
            <tr>
                <td colspan="11" class="borde"> 12.Authorized signature:<br></td>
                <td colspan="11" class="borde">Company: '. $datos["EmpresaAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="borde"> Name: '. $datos["NombreAutoriza"].'</td>
                <td colspan="11" class="borde">Title: '. $datos["CargoPersonAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="borde"><div style="font-size:2"> </div>            YYYY   MM   DD
                    <div style="font-size:2"> </div> Date: '. $AnioElabora. '/'. $mesElabora.'/'. $diaElabora . '
                    
                </td>
                <td colspan="11" class="bordeizq bordeinferior borderecho"><div style="font-size:2"> </div>Telephone: '. $datos["TelPersonAutoriza"].' FAX: '. $datos["FaxPersonAutoriza"].'
                    <br>E-mail: '. $datos["CorreoPersonAutoriza"]. '
                </td>                
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
            $altoFila = 180;
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
            $altoFila = $alto * 1;
        }elseif ($totFilas == 7){
            $altoFila = $alto;
        }elseif ($totFilas > 7){
            $altoFila = 0;
        }
        return $altoFila;
}
ob_flush();
?>