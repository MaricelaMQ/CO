<?php   
ob_start();
include "libs/conecta.php";
$id= $_GET["p"];
include "libs/consulta.php";
//var_dump($datos);
//$id= "2";
/*****CONSULTA DETALLE CERTIFICADO */
// $stmt = $conn->prepare("SELECT * FROM detallecertificado WHERE id=?");
// $stmt->execute([$id]);
// $datos = $stmt->fetch();
/*****CONSULTA DESCRIPCION MERCANCIAS */
// $querydescmerca = $conn->prepare("SELECT * FROM descripcionmercancias WHERE id_certificados=?");
// $querydescmerca->execute([$id]);
// $descripciones = $querydescmerca->fetch();
//valores.data[i].Operacion
//var_dump($descripcion);
            // foreach($descripcion as $desc) {
            //     echo $desc['item'] . ' - ' . $desc['descmercancia'].'<br/>';
            //     }
// foreach ($descripcion as $desc ) {
//     echo $desc
// }
//echo $valores;

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
    $pdf->SetFont('Times', '', 8);
    $pdf->SetFillColor(255, 235, 235);
    //$pdf->MultiCell(false, false, false, 0, 'J', false, 1, '', '', true, 0, false, true, 0, 'M', false);    
    $pdf->addPage();
        
/******** GENERAR RESULTADO EN tablaUno *****/
setlocale(LC_TIME, 'es_CO', 'esp_esp'); 
$k=0;
$tablaUno = '<table cellspacing="1" border="0">';
$tablaDos = '<table cellspacing="1" border="0">';
$conteo = 0;
$tamanofila=683; // TAMAÑO FILA****
  //var_dump($descripcion);
  if ($descripcion>0){
            foreach($descripcion as $desc) {
                $conteo += strlen($desc["DescMercancia"]);
                if ($conteo<=$tamanofila){
                    $tablaUno .= '<tr>';
                    $tablaUno .= '<td style="width:25px" class="centrar">'. $desc["Item"] . '</td>';
                    $tablaUno .= '<td colspan="7" style="width:253px; vertical-align: middle;"><p>'. $desc['DescMercancia'] . '</p></td>';
                    $tablaUno .= '<td style="width:82px; "class="centrar"><p>'. $desc['ClasiArancelaria'] . '</p></td>';
                    $tablaUno .= '<td style="width:62px" class="centrar"><p>'. $desc['NoFactura']  . '</p></td>';
                    $tablaUno .= '<td style="width:75px" class="derecha"><p>'. number_format($desc['ValorFactura'], 2, '.', ',')  . '</p></td>';
                    $tablaUno .= '<td style="width:64px" class="centrar"><p>'. $desc['CriterOrigen']  . '</p></td>';
                    $tablaUno .= '</tr>';
                }else{
                    $tablaDos .= '<tr>';
                    $tablaDos .= '<td style="width:25px" class="centrar">'. $desc['Item'] . '</td>';
                    $tablaDos .= '<td colspan="3" style="width:258px; vertical-align: middle;"><p>'. strtoupper($desc['DescMercancia'])  . '</p></td>';
                    $tablaDos .= '<td style="width:81px; "class="centrar"><p>'. $desc['ClasiArancelaria']  . '</p></td>';
                    $tablaDos .= '<td style="width:64px" class="centrar"><p>'. $desc['NoFactura']  . '</p></td>';
                    $tablaDos .= '<td style="width:73px" class="derecha"><p>'. number_format($desc['ValorFactura'], 2, '.', ',')  . '</p></td>';
                    $tablaDos .= '<td style="width:67px" class="centrar"><p>'. $desc['CriterOrigen']  . '</p></td>';
                    $tablaDos .= '</tr>';
                }
            }
            $fechaexp = strftime("%d de %B de %Y", strtotime($datos["FechaExp"]));
        }else{
            $fechaexp = '';
            $tablaUno.='<tr><td></td></tr>';
            $tablaDos.='<tr><td></td></tr>';
        }
            $tablaUno.='</table>';
            $tablaDos.='</table>';
//$FechaAutoCompe = strftime("%d de %B de %Y", strtotime($datos["FechaAutoCompe"]));
    $content = '';
     $content .= '
     <html>
     <head>
     
     <link rel="shortcut icon" href="../assets/logo.ico">
    <style>
    viewer-pdf-toolbar{
        display:none;
        visibility:hidden!important;
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
            <table  id="pdf" style="width:100%">
                <!-- EXPORTADOR  style="width:250px" -->
                <tr>
                    <td colspan="6" class="borde">1. Nombre y Dirección del Exportador: '. $datos["NombreExp"]. ' / '. $datos["DireccionExp"]. '
                    <p>Teléfono: '. $datos["TelefonoExp"]. ' Fax:  '. $datos["FaxExp"]. '</p>
                        <p>Correo electrónico:    '. $datos["CorreoExp"]. ' </p>
                        Número de Registro Fiscal:    '. $datos["NumRegFiscalExp"]. '                        
                    </td>
                    <td colspan="6" class="borde">Certificado N°:
                        <p class="centrar"><strong>CERTIFICADO DE ORIGEN</strong></p>
                        <p class="centrar">Tratado de Libre Comercio entre Colombia y Costa Rica
                        <br>(Ver Instrucciones al reverso)</p>
        
                    </td>
                </tr>
                <!-- PRODUCTOR -->
                <tr>
                    <td colspan="6" class="borde">1. Nombre y Dirección del Productor:   '. $datos["NombrePro"]. ' /  '. $datos["DireccionPro"]. ' 
                        <p>Teléfono:  '. $datos["TelefonoPro"]. ' Fax:  '. $datos["FaxPro"]. ' </p>
                        <p>Correo electrónico: '. $datos["CorreoPro"]. ' </p>
                        <p>Número de Registro Fiscal:   '. $datos["NumRegFiscalPro"]. '<br></p>
                        
                    </td>
                    <td colspan="6" class="borde">1. Nombre y Dirección del Importador: '. $datos["NombreImp"]. ' /  '. $datos["DireccionImp"]. ' 
                        <br>Teléfono: '. $datos["TelefonoImp"]. '  Fax:  '. $datos["FaxImp"]. ' 
                        <p>Correo electrónico:  '. $datos["CorreoImp"]. ' </p>
                        <p>Número de Registro Fiscal:    '. $datos["NumRegFiscalImp"]. ' </p>
                    </td>
                </tr>
                <!-- DESCRIPCION MERCANCIAS -->                
                
                <tr class="centrar">                
                    <td style="width:30px" class="borde"><p>4. Item</p></td>
                    <td colspan="7" style="width:260px vertical-align: middle;" class="borde"><p>5. Descripción de las Mercancías</p></td>
                    <td style="width:82px;"class="borde"><p>6. Clasificación Arancelaria SA (6 Digitos)</p></td>
                    <td style="width:65px;"class="borde"><p>7. Número de la Factura</p></td>
                    <td style="width:75px;"class="borde"><p>8. Valor en Factura</p></td>
                    <td style="width:67px;"class="borde"><p>9. Criterio de Origen</p></td>                    
             </tr>
            <!-- DESCRIPCION MERCANCIAS -->
            <!-- tablaUno INSERTADA --> 
            <tr>
                <td colspan="12" class="bordeizq borderecho" height="190px">';
                $content .= $tablaUno;
                $content .= '
                </td>
            </tr>
                <!--<tr><td colspan="12" style="" class="bordeizq borderecho"><p></p></td></tr>-->            
                <!-- OBSERVACIONES -->
            <tr>
            <td colspan="12" style="height:20px" class="borde"><p>10. Observaciones:  '. $datos["Observaciones"]. ' </p></td>
            </tr>
            <!-- SECCION ONCE -->
            <tr>             
            <td colspan="6" width="50%" class="borde">11. Declaración del exportador
                <p>El abajo firmante declara bajo juramento que la información consignada en este certificado de origen es correcta y verdadera y que las mercancías fueron producidas en:</p>
                <p class=""><u>   COLOMBIA   </u><br/>
                (pais)</p>
                <p>y cumplen con las disposiciones del Capitulo 3 (Reglas de Origen y Procedimientos de
                Origen)
                establecidas en el Tratado de Libre Comercio entre la República de Colombia y la
                República                de
                Costa Rica y exportadas a:</p>
                <p class=""><u>   COSTA RICA   </u><br/>
                (pais de importación)</p>
                <p>Lugar y fecha, firma del exportador</p>
                <p> '. $datos["LugarExp"]. ', '. $fechaexp . '  </p>                
            </td>
            <!-- SECCION DOCE -->
            <td colspan="6" style="width:50%" class="borde">12. Nombre y Dirección del Importador:
                <p>Sobre la base del control efectuado, se certifica por este medio que la información aquí señalada es correcta y que las mercancías descritas cumplen con las disposiciones del Tratado de Libre Comercio entre la República de Colombia y la República de Costa Rica.</p>                
                <p>Lugar y fecha, nombre y firma del funcionario y sello de la autoridad competente:</p>                
                    <p> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br></p> 
                
                <p></p>
                <br>Dirección:  '. $datos["DireccionAutoCompe"]. '
                <br>Teléfono:   '. $datos["TelefonoAutoCompe"]. ' Fax:  '. $datos["FaxAutoCompe"]. '
                <br>Correo electrónico:    '. $datos["CorreoAutoCompe"]. '
                <br>
            </td>
        </tr>
            </table>';                    

$pdf->writeHTML($content, true, 0, true, 0);
/*********************************************PAGINA DOS *******************/ 
if ($conteo>$tamanofila){
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
       <table  id="pagina2" style="width:100%">
           <!-- EXPORTADOR -->
           <tr style="">
               <td colspan="12" class="borde">Certificado N°:
                   <p class="centrar"><strong>CERTIFICADO DE ORIGEN</strong></p>
                   <p>Tratado de Libre Comercio entre Colombia y Costa Rica</p>
   
               </td>
           </tr>
           <!-- DESCRIPCION MERCANCIAS DOS-->           
           <tr class="centrar">
               <td style="width:30px" class="borde"><p>4. Item</p></td>
               <td colspan="7" style="width:260px vertical-align: middle;" class="borde"><p>5. Descripción de las Mercancías</p></td>
               <td style="width:82px;"class="borde"><p>6. Clasificación Arancelaria SA (6 Digitos)</p></td>
               <td style="width:65px;"class="borde"><p>7. Número de la Factura</p></td>
               <td style="width:75px;"class="borde"><p>8. Valor en Factura</p></td>
               <td style="width:67px;"class="borde"><p>9. Criterio de Origen</p></td>
               
       </tr>
       <!-- DETALLE Mercancias -->
       <!-- tablaDOS INSERTADA -->
       <tr>
           <td  colspan="12" class="bordeizq borderecho" height="300px">';
           $paginaDos .= $tablaDos;
           $paginaDos .= '
           </td>
       </tr>
           <!-- OBSERVACIONES DOS-->           
       <tr>
            <td colspan="12" style="" class="borde"><p>10. Observaciones<br></p></td>
       </tr>
       <!-- SECCION ONCE -->
       <tr>       
       <td colspan="6" style="width:50%" class="borde">11. Declaración del exportador
           <p>El abajo firmante declara bajo juramento que la información consignada en este certificado de origen es correcta y verdadera y que las mercancías fueron producidas en:</p>
           <p class="centrar"><u>   COLOMBIA   </u><br/>
           (pais)</p>
           <p>y cumplen con las disposiciones del Capitulo 3 (Reglas de Origen y Procedimientos de
           Origen)
           establecidas en el Tratado de Libre Comercio entre la República de Colombia y la
           República                de
           Costa Rica y exportadas a:</p>
           <p class="centrar"><u>   COSTA RICA   </u><br/>
           (pais de importación)</p>
           <p>Lugar y fecha, firma del exportador</p>
           <p> '. $datos["LugarExp"]. ', '. $fechaexp . '  </p>
           
       </td>
       <!-- SECCION DOCE -->
       <td colspan="6" style="width:50%" class="borde">12. Nombre y Dirección del Importador:
       <p>Sobre la base del control efectuado, se certifica por este medio que la información aquí señalada es correcta y que las mercancías descritas cumplen con las disposiciones del Tratado de Libre Comercio entre la República de Colombia y la República de Costa Rica.</p>
       <p></p>
       <p>Lugar y fecha, nombre y firma del funcionario y sello de la autoridad competente:</p>
       <p> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br></p> 
       <p></p>
       <br>Dirección:  '. $datos["DireccionAutoCompe"]. '
       <br>Teléfono:   '. $datos["TelefonoAutoCompe"]. ' Fax:  '. $datos["FaxAutoCompe"]. '
       <br>Correo electrónico:    '. $datos["CorreoAutoCompe"]. '<br>
       
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
?>