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
    require_once('tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', 'mm', 'LETTER', true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Adia SAS');
	$pdf->SetTitle("Certificado de Origen");
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(5, false, 5, false);
	$pdf->SetAutoPageBreak(true, 10);
	$pdf->SetFont('Times', '', 9);
	$pdf->addPage();

/******** GENERAR RESULTADO EN TABLA *****/
$tabla = '<table>';
            foreach($descripcion as $desc) {
                    $tabla .= '<tr>';
                    $tabla .= '<td style="width:30px" class="bordeizq centrar">'. $desc['item'] . '</td>';
                    $tabla .= '<td colspan="3" style="width:260px"><p>'. $desc['descmercancia']  . '</p></td>';
                    $tabla .= '<td style="width:82px" class="centrar"><p>'. $desc['clasiarancelaria']  . '</p></td>';
                    $tabla .= '<td style="width:65px" class="centrar"><p>'. $desc['nofactura']  . '</p></td>';
                    $tabla .= '<td style="width:75px" class="centrar"><p>'. $desc['valorfactura']  . '</p></td>';
                    $tabla .= '<td style="width:67px" class="borderecho centrar"><p>'. $desc['criterorigen']  . '</p></td>';
                    $tabla .= '</tr>';
            }
$tabla .='</table>';

    $content = ''; 
     $content .= '
     <html>
     <head>
     <link rel="stylesheet" href="css/Estilos.css" />
     <link rel="stylesheet" href="css/materialize.min.css" /> 
    <style>
        .centrar {
            text-align: center;            
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
                <!-- EXPORTADOR -->
                <tr style="width:250px">
                    <td colspan="4" class="borde">1. Nombre y Dirección del Exportador: '. $datos["NombreExp"]. ' / '. $datos["DireccionExp"]. '
                        <p>Teléfono: '. $datos["TelefonoExp"]. ' Fax:  '. $datos["FaxExp"]. ' </p>
                        <p>Correo electrónico:    '. $datos["CorreoExp"]. ' </p>
                        Número de Registro Fiscal:    '. $datos["NumRegFiscalExp"]. '
                        <p></p>
                    </td>
                    <td colspan="4" class="borde">Certificado N°:
                        <p class="centrar"><strong>CERTIFICADO DE ORIGEN</strong></p>
                        <p class="centrar">Tratado de Libre Comercio entre Colombia y Costa Rica</p>
        
                    </td>
                </tr>
                <!-- PRODUCTOR -->
                <tr>
                    <td colspan="4" class="borde">1. Nombre y Dirección del Productor:   '. $datos["NombrePro"]. ' /  '. $datos["DireccionPro"]. ' 
                        <p>Teléfono:  '. $datos["TelefonoPro"]. ' Fax:  '. $datos["FaxPro"]. ' </p>
                        <p>Correo electrónico: '. $datos["CorreoPro"]. ' </p>
                        <p>Número de Registro Fiscal:   '. $datos["NumRegFiscalPro"]. '<br></p>
                        
                    </td>
                    <td colspan="4" class="borde">1. Nombre y Dirección del Importador: '. $datos["NombreImp"]. ' /  '. $datos["DireccionImp"]. ' 
                        <p>Teléfono: '. $datos["TelefonoImp"]. '  Fax:  '. $datos["FaxImp"]. ' </p>
                        <p>Correo electrónico:  '. $datos["CorreoImp"]. ' </p>
                        <p>Número de Registro Fiscal:    '. $datos["NumRegFiscalImp"]. ' </p>
                    </td>
                </tr>
                <!-- DESCRIPCION MERCANCIAS -->                
                
                <tr class="centrar">
                    <td style="width:30px" class="borde"><p>4. Item</p></td>
                    <td colspan="3" style="width:260px vertical-align: middle;" class="borde"><p>5. Descripción de las Mercancías</p></td>
                    <td style="width:82px;"class="borde"><p>6. Clasificación Arancelaria SA (6 Digitos)</p></td>
                    <td style="width:65px;"class="borde"><p>7. Número de la Factura</p></td>
                    <td style="width:75px;"class="borde"><p>8. Valor en Factura</p></td>
                    <td style="width:67px;"class="borde"><p>9. Criterio de Origen</p></td>
                    
            </tr>
            <!-- DETALLE Mercancias -->
            <!-- UNO -->';
            // $content .= '<table>';
            //  foreach($descripcion as $desc) {
            //             $content .= '<tr>';
            //             $content .= '<td" class="bordeizq centrar">'. $desc['item'] . '</td>';
            //             $content .= '<td colspan="3"><p>'. $desc['descmercancia']  . '</p></td>';
            //             $content .= '<td class="centrar"><p>'. $desc['clasiarancelaria']  . '</p></td>';
            //             $content .= '<td class="centrar"><p>'. $desc['nofactura']  . '</p></td>';
            //             $content .= '<td class="centrar"><p>'. $desc['valorfactura']  . '</p></td>';
            //             $content .= '<td class="borderecho centrar"><p>'. $desc['criterorigen']  . '</p></td>';
            //             $content .= '</tr>';
            //     }
                $content .= $tabla;
                $content .= '<!-- OBSERVACIONES -->
            <tr><td colspan="8" style="" class="borde"><p>10. Observaciones<br> '. $datos["Observaciones"]. ' </p></td>
            </tr>
            <tr>
            <!-- SECCION ONCE -->
            <td colspan="4" class="borde">11. Declaración del exportador
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
                <p> '. $datos["LugarExp"]. ', '. $datos["FechaExp"]. '  </p>
                
            </td>
            <!-- SECCION DOCE -->
            <td colspan="4" class="borde">12. Nombre y Dirección del Importador:
            <p>Sobre la base del control efectuado, se certifica por este medio que la información aquí señalada es correcta y que las mercancías descritas cumplen con las disposiciones del Tratado de Libre Comercio entre la República de Colombia y la República de Costa Rica.</p>
            <p></p>
            <p>Lugar y fecha, nombre y firma del funcionario y sello de la autoridad competente:</p>
            <p>'. $datos["LugarAutoCompe"]. ', '. $datos["FechaAutoCompe"]. '  </p>
            <p></p>
            <p>Dirección:  '. $datos["DireccionAutoCompe"]. '</p>
            <p>Teléfono:   '. $datos["TelefonoAutoCompe"]. ' Fax:  '. $datos["FaxAutoCompe"]. '</p>
            <p>Correo electrónico:    '. $datos["CorreoAutoCompe"]. '</p>
            </td>
        </tr>            
            </table>';           
                    

$pdf->writeHTML($content, true, 0, true, 0);
$pdf->lastPage();

// $pdf->addPage();
// $pdf->writeHTML("<h1>nuevo contenido siguiente pagina</h1>", true, 0, true, 0);

$pdf->output('Reportecertificado.pdf', 'I');
}
?>