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
	$pdf->SetTitle("CO - EEUU");
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
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['ValConRegional'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['FacturaNoDesc'] . '<br>' . $desc['FechaDesc'] . '</p></td>';
                    $tablaUno .= '<td colspan="2" class="centrar bordeizq borderecho"><p>'. $desc['PaisdeOrigen']  . '</p></td>';
                    $tablaUno .= '</tr>';
                }else{
                    $paginas = 2;
                    $tablaDos .= '<tr>';
                    // $tablaDos .= '<td style="width:25px" class="centrar">'. $desc['Item'] . '</td>';
                    $tablaDos .= '<td colspan="11" class="letra bordeizq borderecho" height="'. $alto. 'px">'. $desc['DescMercancia'] . '</td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['CritPreferencial']  . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['ValConRegional'] . '</p></td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['FacturaNoDesc'] . '<br>' . $desc['FechaDesc'] . '</p></td>';
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
                <td colspan="22" class="centrar " style="line-height:5px;">
                    <strong>
                    <br>ACUERDO DE PROMOCIÓN COMERCIAL COLOMBIA – ESTADOS UNIDOS
                    <br>UNITED STATES – COLOMBIA TRADE PROMOTION AGREEMENT
                    <br>ACUERDO FIRMADO /AGREEMENT SIGNED: 15/05/2012
                    <br><span style="font-size:25px;">CERTIFICADO DE ORIGEN / CERTIFICATE OF ORIGIN</span>
                    </strong>
                </td>
            </tr>
                <tr>
                    <td colspan="11" class="borde" height="75px">1. Razón social, dirección, teléfono y correo electrónico del exportador:
                    <br>   Exporter´s legal name, address, telephone and e-mail
                        <br><br>'. $datos["NombreExp"]. '
                        <br>'. $datos["DireccionExp"]. '                        
                        <br>TEL:'. $datos["TelefonoExp"]. '
                        <br>E-MAIL: '. $datos["CorreoExp"]. '                        
                    </td>
    <!-- SECCION 2 PERIODO QUE CUBRE -->
                    <td colspan="11" class="borde">2. Periodo cubierto / Blanket period:
                        <br><br>
                                <table class="">
                                    <tr>
                                        <td class="">Desde (DD/MM/AA) / From (MM/DD/AA)</td>
                                    </tr>
                                    <tr>
                                        <td class="" height="15px">'. $diaDesde . '/'.$mesDesde.'/'. $AnioDesde .' / '. $mesDesde . '/'.$diaDesde.'/'. $AnioDesde .'</td><br><br>
                                    </tr>
                                    <tr>
                                        <td class="">Hasta (DD/MM/AA) / To (MM/DD/AA)</td>
                                    </tr>
                                    <tr>
                                        <td class="">'. $diaHasta . '/'.$mesHasta.'/'. $AnioHasta .' / '. $mesHasta . '/'.$diaHasta.'/'. $AnioHasta .'</td>
                                    </tr>
                                </table>                        
                    </td>
                </tr>
    <!-- SECCION 3 PRODUCTOR -->
                <tr>
                    <td colspan="11" class="borde" height="75px">3. Razón social, dirección, teléfono y correo electrónico del productor:
                        <br>   Producer´s legal name, address, telephone and e-mail
                        <br><br>'. $datos["NombrePro"]. '
                        <br>'. $datos["DireccionPro"]. '
                        <br>TEL: '. $datos['TelefonoPro']. '
                        <br>E-MAIL '. $datos["CorreoPro"]. '<br>
                    </td>
    <!-- SECCION 4 IMPORTADOR -->
                    <td colspan="11" class="borde">4. Razón social, dirección, teléfono y correo electrónico importador:
                        <br>   Importer´s legal name address, telephone and e-mail
                        <br><br>'. $datos["NombreImp"]. '
                        <br>'. $datos["DireccionImp"]. '
                        <br>TEL: '. $datos["TelefonoImp"]. '
                        <br>E-MAIL: '. $datos["CorreoImp"]. '
                        <br>IDENTIFICACION TRIBUTARIA:<br>
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
                            <td colspan="11" valign="middle" class="borde centrar"><p>5. Descripción del (las) mercancías(s) / Description of goods</p></td>
                            <td colspan="3" class="borde centrar">6. Clasificación Arancelaria / HS Tariff Classification</td>
                            <td colspan="2" class="borde centrar">7. Criterio Preferencial / Preference Criterion</td>
                            <td colspan="2" class="borde centrar">8. Valor Contenido Regional / Regional Value Content</td>
                            <td colspan="2" class="borde centrar">9. Factura No. Fecha / Invoice. No. Date</td>
                            <td colspan="2" class="centrar borde">10. País de Origen / Country of Origin</td>
                    </tr>
            
    <!-- TABLA UNO INSERTADA //  . $TABLAUNO . -->
    
                        ' . $tablaUno .'
                <!-- 
                  <tr>
                        <td colspan="11" class="bordeizq" ></td>
                        <td colspan="3" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="bordeizq centrar"></td>
                        <td colspan="2" class="centrar bordeizq borderecho"></td>
                   </tr> 
                -->     

    <!-- SECCION ONCE -->
            <tr>
                <td colspan="22" class="bordeizq borderecho bordesuperior">11. Certificación de Origen / Certification of Origin
                <br><br>Declaro bajo la gravedad de juramento que / I certify that:<br></td>
            </tr>
            <tr>
                <td colspan="1" width="2%" class="bordeizq ">-</td>
                <td colspan="21" width="98%" class="borderecho"><p class="justificar">La información contenida en este certificado es verdadera y exacta, y me hago responsable de comprobar lo aquí declarado. Estoy consciente que soy responsable por cualquier declaración falsa u omisión hecha en o relacionada con el presente certificado. / The information on this certificate is true and accurate and I assume the responsibility for providing such representations. I understand that I am liable for any false statements or material omissions made on or in connection with this certificate.</p></td>
            </tr>
            <tr>
                <td colspan="1" width="2%" class="bordeizq ">-</td>
                <td colspan="21" width="98%" class="borderecho"><p class="justificar">Me comprometo a conservar y presentar, en caso de ser requerido, los documentos necesarios que respalden el contenido del presente certificado, así como a notificar por escrito a todas las personas a quienes se lo entregue, de cualquier cambio que pudiera afectar la exactitud o validez del mismo. / I agree to maintain and present upon request, documentation necessary to support this certificate, and to inform, in writing, all persons to whom the certificate was given of any changes that could affect the accuracy or validity of this certificate.</p></td>
            </tr>
            <tr>
                <td colspan="1" width="2%" class="bordeizq ">-</td>
                <td colspan="21" width="98%" class="borderecho"><p class="justificar">Las mercancías son originarias del territorio de las partes y cumplen con los requisitos de origen que les son aplicables conforme al Acuerdo de Promoción Comercial Colombia - Estados Unidos. / The goods originated in the territory of the parties, and comply with the origin requirements specified for those goods in the Colombia - United States Trade Promotion Agreement.</p></td>
            </tr>
            <tr>
                <td colspan="1" width="2%" class="bordeizq ">-</td>
                <td colspan="21" width="98%" class="borderecho"><p class="justificar">Las mercancías no han sido objeto de procesamiento ulterior o de cualquier otra operación fuera de los territorios de las Partes, salvo en los casos establecidos en el Artículo 4.13. / The goods undergoes no further production or other operation outside the territories of the Parties unless specifically exempted in Article 4.13.</p></td>
            </tr>            
            <tr>
                <td colspan="22" class="bordeizq borderecho"><br><br>  Esta certificación se compone de <u>   ' . $paginas. '   </u> hojas, incluyendo todos sus anexos. / This certificate consist <u>   ' . $paginas. '   </u> pages, including attachments.<br></td>
            </tr>
            <tr>
                <td colspan="11" class="borde">  Firma autorizada / Authorized signature:<br><br></td>
                <td colspan="11" class="borde">Nombre de la empresa / Company´s name:<br><br>'. $datos["EmpresaAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="borde">  Nombre / Name:<br><br>  '. $datos["NombreAutoriza"].'</td>
                <td colspan="11" class="borde">Cargo /Title:<br><br>'. $datos["CargoPersonAutoriza"].'</td>
            </tr>
            <tr>
                <td colspan="11" class="bordeizq bordesuperior">  Fecha (DD/MM/AA) / Date (MM/DD/AA):
                <br>  '. $diaElabora. '/'. $mesElabora.'/'. $AnioElabora . ' / '. $mesElabora .'/' . $diaElabora. '/'. $AnioElabora.'
                </td>
                <td colspan="11" class="bordeizq bordeinferior borderecho">Teléfono y fax / Telephone and Fax: 
                <br>TEL: '. $datos["TelPersonAutoriza"].'  '. $datos["FaxPersonAutoriza"].'</td>
            </tr>
    <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class="borde">  12. Observaciones / Remarks:<br><span class="letra">  '.$datos["Observaciones"].'</span></td>
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
               <td colspan="22" class="centrar " style="line-height:5px;">
                   <strong>
                   <br>ACUERDO DE PROMOCIÓN COMERCIAL COLOMBIA – ESTADOS UNIDOS
                   <br>UNITED STATES – COLOMBIA TRADE PROMOTION AGREEMENT
                   <br>ACUERDO FIRMADO /AGREEMENT SIGNED: 15/05/2012
                   <br><span style="font-size:25px;">CERTIFICADO DE ORIGEN / CERTIFICATE OF ORIGIN</span>
                   </strong>
               </td>
           </tr>
               <tr>
                   <td colspan="11" class="borde" height="75px">1. Razón social, dirección, teléfono y correo electrónico del exportador:
                   <br>   Exporter´s legal name, address, telephone and e-mail
                       <br><br>'. $datos["NombreExp"]. '
                       <br>'. $datos["DireccionExp"]. '                        
                       <br>TEL:'. $datos["TelefonoExp"]. '
                       <br>E-MAIL: '. $datos["CorreoExp"]. '                        
                   </td>
   <!-- SECCION 2 PERIODO QUE CUBRE -->
                   <td colspan="11" class="borde">2. Periodo cubierto / Blanket period:
                       <br><br>
                               <table class="">
                                   <tr>
                                       <td class="">Desde (DD/MM/AA) / From (MM/DD/AA)</td>
                                   </tr>
                                   <tr>
                                       <td class="" height="15px">'. $diaDesde . '/'.$mesDesde.'/'. $AnioDesde .' / '. $mesDesde . '/'.$diaDesde.'/'. $AnioDesde .'</td><br><br>
                                   </tr>
                                   <tr>
                                       <td class="">Hasta (DD/MM/AA) / To (MM/DD/AA)</td>
                                   </tr>
                                   <tr>
                                       <td class="">'. $diaHasta . '/'.$mesHasta.'/'. $AnioHasta .' / '. $mesHasta . '/'.$diaHasta.'/'. $AnioHasta .'</td>
                                   </tr>
                               </table>                        
                   </td>
               </tr>
   <!-- SECCION 3 PRODUCTOR -->
               <tr>
                   <td colspan="11" class="borde" height="75px">3. Razón social, dirección, teléfono y correo electrónico del productor:
                       <br>   Producer´s legal name, address, telephone and e-mail
                       <br><br>'. $datos["NombrePro"]. '
                       <br>'. $datos["DireccionPro"]. '
                       <br>TEL: '. $datos['TelefonoPro']. '
                       <br>E-MAIL '. $datos["CorreoPro"]. '<br>
                   </td>
   <!-- SECCION 4 IMPORTADOR -->
                   <td colspan="11" class="borde">4. Razón social, dirección, teléfono y correo electrónico importador:
                       <br>   Importer´s legal name address, telephone and e-mail
                       <br><br>'. $datos["NombreImp"]. '
                       <br>'. $datos["DireccionImp"]. '
                       <br>TEL: '. $datos["TelefonoImp"]. '
                       <br>E-MAIL: '. $datos["CorreoImp"]. '
                       <br>IDENTIFICACION TRIBUTARIA:<br>
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
                           <td colspan="11" valign="middle" class="borde centrar"><p>5. Descripción del (las) mercancías(s) / Description of goods</p></td>
                           <td colspan="3" class="borde centrar">6. Clasificación Arancelaria / HS Tariff Classification</td>
                           <td colspan="2" class="borde centrar">7. Criterio Preferencial / Preference Criterion</td>
                           <td colspan="2" class="borde centrar">8. Valor Contenido Regional / Regional Value Content</td>
                           <td colspan="2" class="borde centrar">9. Factura No. Fecha / Invoice. No. Date</td>
                           <td colspan="2" class="centrar borde">10. País de Origen / Country of Origin</td>
                   </tr>
           
   <!-- TABLA DOS INSERTADA //  . $TABLADOS . -->
   
                       ' . $tablaDos .'
               <!-- 
                 <tr>
                       <td colspan="11" class="bordeizq" ></td>
                       <td colspan="3" class="bordeizq centrar"></td>
                       <td colspan="2" class="bordeizq centrar"></td>
                       <td colspan="2" class="bordeizq centrar"></td>
                       <td colspan="2" class="bordeizq centrar"></td>
                       <td colspan="2" class="centrar bordeizq borderecho"></td>
                  </tr> 
               -->     

   <!-- SECCION ONCE -->
           <tr>
               <td colspan="22" class="bordeizq borderecho bordesuperior">11. Certificación de Origen / Certification of Origin
               <br><br>Declaro bajo la gravedad de juramento que / I certify that:<br></td>
           </tr>
           <tr>
               <td colspan="1" width="2%" class="bordeizq ">-</td>
               <td colspan="21" width="98%" class="borderecho"><p class="justificar">La información contenida en este certificado es verdadera y exacta, y me hago responsable de comprobar lo aquí declarado. Estoy consciente que soy responsable por cualquier declaración falsa u omisión hecha en o relacionada con el presente certificado. / The information on this certificate is true and accurate and I assume the responsibility for providing such representations. I understand that I am liable for any false statements or material omissions made on or in connection with this certificate.</p></td>
           </tr>
           <tr>
               <td colspan="1" width="2%" class="bordeizq ">-</td>
               <td colspan="21" width="98%" class="borderecho"><p class="justificar">Me comprometo a conservar y presentar, en caso de ser requerido, los documentos necesarios que respalden el contenido del presente certificado, así como a notificar por escrito a todas las personas a quienes se lo entregue, de cualquier cambio que pudiera afectar la exactitud o validez del mismo. / I agree to maintain and present upon request, documentation necessary to support this certificate, and to inform, in writing, all persons to whom the certificate was given of any changes that could affect the accuracy or validity of this certificate.</p></td>
           </tr>
           <tr>
               <td colspan="1" width="2%" class="bordeizq ">-</td>
               <td colspan="21" width="98%" class="borderecho"><p class="justificar">Las mercancías son originarias del territorio de las partes y cumplen con los requisitos de origen que les son aplicables conforme al Acuerdo de Promoción Comercial Colombia - Estados Unidos. / The goods originated in the territory of the parties, and comply with the origin requirements specified for those goods in the Colombia - United States Trade Promotion Agreement.</p></td>
           </tr>
           <tr>
               <td colspan="1" width="2%" class="bordeizq ">-</td>
               <td colspan="21" width="98%" class="borderecho"><p class="justificar">Las mercancías no han sido objeto de procesamiento ulterior o de cualquier otra operación fuera de los territorios de las Partes, salvo en los casos establecidos en el Artículo 4.13. / The goods undergoes no further production or other operation outside the territories of the Parties unless specifically exempted in Article 4.13.</p></td>
           </tr>            
           <tr>
               <td colspan="22" class="bordeizq borderecho"><br><br>  Esta certificación se compone de <u>   ' . $paginas. '   </u> hojas, incluyendo todos sus anexos. / This certificate consist <u>   ' . $paginas. '   </u> pages, including attachments.<br></td>
           </tr>
           <tr>
               <td colspan="11" class="borde">  Firma autorizada / Authorized signature:<br><br></td>
               <td colspan="11" class="borde">Nombre de la empresa / Company´s name:<br><br>'. $datos["EmpresaAutoriza"].'</td>
           </tr>
           <tr>
               <td colspan="11" class="borde">  Nombre / Name:<br><br>  '. $datos["NombreAutoriza"].'</td>
               <td colspan="11" class="borde">Cargo /Title:<br><br>'. $datos["CargoPersonAutoriza"].'</td>
           </tr>
           <tr>
               <td colspan="11" class="bordeizq bordesuperior">  Fecha (DD/MM/AA) / Date (MM/DD/AA):
               <br>  '. $diaElabora. '/'. $mesElabora.'/'. $AnioElabora . ' / '. $mesElabora .'/' . $diaElabora. '/'. $AnioElabora.'
               </td>
               <td colspan="11" class="bordeizq bordeinferior borderecho">Teléfono y fax / Telephone and Fax: 
               <br>TEL: '. $datos["TelPersonAutoriza"].'  '. $datos["FaxPersonAutoriza"].'</td>
           </tr>
   <!-- OBSERVACIONES -->
           <tr>
               <td colspan="22" style="height:40px" class="borde">  12. Observaciones / Remarks:<br><span class="letra">  '.$datos["Observaciones"].'</span></td>
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