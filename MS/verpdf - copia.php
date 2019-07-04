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
	$pdf->SetTitle("CO - Mercosur");
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
$normasUno = '';
$normasDos = '';
$nfilas = 7;
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
                if ($k <= $nfilas ){
                    if ($k == $totFilas){
                        $alto = $altoFila;
                    }
                    $tablaUno .= '<tr>';
                    $tablaUno .= '<td colspan="2" class="bordeizq borderecho centrar" height="'. $alto. 'px">'. $desc['NoOrden'] . '</td>';
                    $tablaUno .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['Naladisa'] . '</p></td>';
                    $tablaUno .= '<td colspan="12" class="letra justificar borderecho"><p>'. $desc['DescMercancia']  . '</p></td>';
                    $tablaUno .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['PesoCantidad'] . '</p></td>';
                    $tablaUno .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ValorFob']  . '</p></td>';
                    $tablaUno .= '</tr>';
                               /********************* NORMAS UNO ************** */
                    $normasUno .= '<tr>';
                    $normasUno .= '<td colspan="2" class="centrar bordeizq">'. $desc["NoOrden"] . '</td>';
                    $normasUno .= '<td colspan="20" class="justificar bordeizq borderecho">'. $desc["Normas"] . '</td>';
                    $normasUno .= '</tr>';

                }else{
                    $paginas = 2;
                    $tablaDos .= '<tr>';
                    $tablaDos .= '<td colspan="2" class="bordeizq borderecho centrar" height="'. $alto. 'px">'. $desc['NoOrden'] . '</td>';
                    $tablaDos .= '<td colspan="2" class="centrar borderecho"><p>'. $desc['Naladisa'] . '</p></td>';
                    $tablaDos .= '<td colspan="12" class="letra justificar borderecho"><p>'. $desc['DescMercancia'] . '</p></td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['PesoCantidad'] . '</p></td>';
                    $tablaDos .= '<td colspan="3" class="centrar borderecho"><p>'. $desc['ValorFob'] . '</p></td>';
                    $tablaDos .= '</tr>';
                               /********************* NORMAS DOS ************** */
                    $normasDos .= '<tr>';
                    $normasDos .= '<td colspan="2" class="centrar bordeizq">'. $desc["NoOrden"] . '</td>';
                    $normasDos .= '<td colspan="20" class="justificar bordeizq borderecho">'. $desc["Normas"] . '</td>';
                    $normasDos .= '</tr>';
                }                
            }
        }else{
              $tablaUno.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="170px"></td></tr>';
              $tablaDos.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="170px"></td></tr>';
              $normasUno.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="170px"></td></tr>';
              $normasDos.='<tr><td colspan="22" class="centrar bordeizq borderecho " height="170px"></td></tr>';
        }
            //$tablaUno.='</thead>';
            //$tablaDos.='</table>';
            //$FechaAutoCompe = strftime("%d de %B de %Y", strtotime($datos["FechaAutoCompe"]));
            // $diaDesde = strftime("%d", strtotime($datos["FechaDesde"]));


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
                    <td colspan="2" class="borde centrar"><strong>N° de <br>Orden (1)</strong></td>
                    <td colspan="2" class="borde centrar"><strong>NALADISA</strong></td>
                    <td colspan="12" class="borde centrar"><strong>DENOMINACION DE LAS MERCANCÍAS</strong></td>
                    <td colspan="3" class="borde centrar"><strong>Peso o Cantidad</strong></td>
                    <td colspan="3" class="borde centrar"><strong>Valor FOB en (U$S)</strong></td>
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
                    <td colspan="2" class="borde centrar"><strong>N° de <br>Orden</strong></td>                    
                    <td colspan="20" class="borde centrar"><strong>NORMAS (2)</strong></td>
                </tr>
    <!-- TABLA NORMAS UNO -->

                    ' . $normasUno. '

    <!-- EXPORTADOR/PRODUCTOR  -->

                <tr>                    
                    <td colspan="16" height="80px" class="borde"><strong>EXPORTADOR O PRODUCTOR</strong>
                        <br><br>Razon social: '.$datos["RazonSocialExpoPro"].'
                        <br>Dirección: '.$datos["DireccionExpoPro"].'
                        <br>Fecha: '.$datos["FechaExpoPro"].'
                    </td>
                    <td colspan="6" class="borde centrar">
                        Sello y firma del Exportador o Productor
                    </td>
                </tr>
    <!-- IMPORTADOR  -->
                <tr>
                    <td colspan="22" class="borde"><strong>IMPORTADOR</strong>
                        <br><br>Razon social: '.$datos["RazonSocialImp"].'
                        <br>Dirección: '.$datos["DireccionImp"].'
                    </td>
                </tr>
                <tr>
    <!-- MEDIO DE TRANSPORTE/PUERTO  -->
                <td colspan="22" class="borde"><div style="font-size:2">&nbsp;</div>Medio de Transporte: '.$datos["MedioTransporte"].'
                    <br>Puerto o lugar de embarque: '.$datos["PuertoEmbarque"].'
                    <div style="font-size:2">&nbsp;</div>
                </td>
            </tr>
        
    <!-- OBSERVACIONES -->
            <tr>
                <td colspan="22" style="height:40px" class="borde">Observaciones:<br><span class="letra">'.$datos["Observaciones"].'</span></td>
            </tr>

    <!-- ENTIDAD CERTIFICADORA  -->

            <tr>                    
                <td colspan="16" height="80px" class="borde"><strong class="centrar">CERTIFICACIÓN DE ORIGEN</strong>
                    <br><br>Certifico la veracidad de la presente declaración, en la ciudad de:
                    <p class="centrar"></p>
                    <br>A los: 
                    <br><br>Nombre de la Entidad Certificadora: 
                </td>
                <td colspan="6" class="borde centrar">
                    Sello y firma del Exportador o Productor
                </td>
            </tr>

            </table>
    </div>
    </html>';
    
$pdf->writeHTML($content, true, 0, true, 0);
/****************************************** INSTRUCCIONES DE LLENADO ***************************/
$pdf->addPage();
$instrucciones = '';
$instrucciones .= '

<html>
<head>
<style>
    .justificar{
        text-align:justify;
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
</style>
</head>
<div></div>
    <table width="80%" cellspacing="5">
            <tr>
                <td colspan="4" height="80px">
                </td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="10%">Referencias:</td>
                <td width="5%" class="centrar">(1)</td>
                <td width="70%"><p class="justificar">Esta columna indica el orden en que se individualizan las mercancías comprendidas en el presente certificado. En caso de ser insuficiente el espacio, se continuará la numeración de las mercancías en otro ejemplar.
                </p></td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="10%"></td>
                <td width="5%" class="centrar">(2)</td>
                <td width="70%"><p class="justificar">En esta columna se identificará la norma de origen con que cumple cada mercancía individualizada por su número de orden.
                </p></td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="10%">Notas:</td>
                <td width="5%" class="centrar">(a)</td>
                <td width="70%"><p class="justificar">El formulario no podrá presentar raspaduras, tachaduras o enmiendas.
                </p></td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="10%"></td>
                <td width="5%" class="centrar">(b)</td>
                <td width="70%"><p class="justificar">El formulario sólo será válido si todos sus campos, excepto el de “Observaciones”, estuvieron debidamente llenos.
                </p></td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="10%"></td>
                <td width="5%" class="centrar">(c)</td>
                <td width="70%"><p class="justificar">Podrá aceptarse la intervención de terceros operadores, siempre que sean atendidas todas las disposiciones previstas en el Art. 13 del Anexo IV.
                </p></td>
            </tr>
    </table>
</html>';
$pdf->writeHTML($instrucciones, true, 0, true, 0);
/*********************************************PAGINA DOS *******************/
if ($k>$nfilas){
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
                   <td colspan="2" class="borde centrar">N° de <br>Orden (1)</td>
                   <td colspan="2" class="borde centrar">NALADISA</td>
                   <td colspan="12" class="borde centrar">DENOMINACION DE LAS MERCANCÍAS</td>
                   <td colspan="3" class="borde centrar">Peso o Cantidad</td>
                   <td colspan="3" class="borde centrar">Valor FOB en (U$S)</td>
               </tr>
           
   <!-- TABLA UNO INSERTADA //  . $TABLAUNO . -->
   
               ' . $tablaDos .'

   <!-- SECCION DECLARACION DE ORIGEN -->
               <tr>
                   <td colspan="22" style="height:40px" class="borde"><p class="centrar"><strong>DECLARACION DE ORIGEN</strong></p><p class="justificar">DECLARAMOS que las mercancías indicadas en el presente formulario, correspondientes a la Factura(s) Comercial(es) No. '.$datos["NoFacturaComercial"].' de
                       fecha(s) respectivamente '.$datos["FechaDeclaOrigen"].', cumplen con lo establecido en las normas de origen del presente Acuerdo A.C.E. No. 72 de conformidad con
                       el siguiente desglose.
                   </p></td>
               </tr>
   <!-- SECCION NORMAS -->
               <tr>
                   <td colspan="2" class="borde centrar"><strong>N° de <br>Orden</strong></td>                    
                   <td colspan="20" class="borde centrar"><strong>NORMAS (2)</strong></td>
               </tr>
   <!-- TABLA NORMAS UNO -->

                   ' . $normasDos. '

   <!-- EXPORTADOR/PRODUCTOR  -->

               <tr>                    
                   <td colspan="16" height="80px" class="borde"><strong>EXPORTADOR O PRODUCTOR</strong>
                       <br><br>Razon social: '.$datos["RazonSocialExpoPro"].'
                       <br>Dirección: '.$datos["DireccionExpoPro"].'
                       <br>Fecha: '.$datos["FechaExpoPro"].'
                   </td>
                   <td colspan="6" class="borde centrar">
                       Sello y firma del Exportador o Productor
                   </td>
               </tr>
   <!-- IMPORTADOR  -->
               <tr>
                   <td colspan="22" class="borde"><strong>IMPORTADOR</strong>
                       <br><br>Razon social: '.$datos["RazonSocialImp"].'
                       <br>Dirección: '.$datos["DireccionImp"].'
                   </td>
               </tr>
               <tr>
   <!-- MEDIO DE TRANSPORTE/PUERTO  -->
               <td colspan="22" class="borde"><div style="font-size:2">&nbsp;</div>Medio de Transporte: '.$datos["MedioTransporte"].'
                   <br>Puerto o lugar de embarque: '.$datos["PuertoEmbarque"].'
                   <div style="font-size:2">&nbsp;</div>
               </td>
           </tr>
       
   <!-- OBSERVACIONES -->
           <tr>
               <td colspan="22" style="height:40px" class="borde">Observaciones:<br><span class="letra">'.$datos["Observaciones"].'</span></td>
           </tr>

   <!-- ENTIDAD CERTIFICADORA  -->

           <tr>                    
               <td colspan="16" height="80px" class="borde"><strong class="centrar">CERTIFICACIÓN DE ORIGEN</strong>
                   <br><br>Certifico la veracidad de la presente declaración, en la ciudad de:
                   <p class="centrar"></p>
                   <br>A los: 
                   <br><br>Nombre de la Entidad Certificadora: 
               </td>
               <td colspan="6" class="borde centrar">
                   Sello y firma del Exportador o Productor
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