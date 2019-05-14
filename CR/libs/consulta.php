<?php
include "conecta.php";
/*****CONSULTA DETALLE CERTIFICADO */
//  $id=1;
if(isset($id)){
        $stmt = $conn->prepare("SELECT * FROM vista_datoscertificado WHERE id=?");
        $stmt->execute([$id]);
        $datos = $stmt->fetch();
        /**CONSULTA TABLA BD DESCRIPCION MERCANCIAS */
        // $querydescmerca = $conn->prepare("SELECT id, item, descmercancia, clasiarancelaria, nofactura, valorfactura, criterorigen FROM descripcionmercancias WHERE id_certificados=?");        
         $querydescmerca = $conn->prepare("SELECT * FROM descripcionmercancias WHERE id_certificados=?");
        $querydescmerca->execute([$id]);
        // $descripcion = $querydescmerca->fetchAll();
         $descripcion = $querydescmerca->fetchAll();        
        
        if(count($descripcion)==0){
                $descripcion=0;        
        };
        
}else{
        $datos='';
}
//var_dump($datos);
/*****CONSULTA DESCRIPCION MERCANCIAS FORMAT(valorfactura, 2) as */
// $querydescmerca = $conn->prepare("SELECT id, item, descmercancia, clasiarancelaria, nofactura, valorfactura, criterorigen FROM descripcionmercancias WHERE id_certificados=?");
// $querydescmerca->execute([$id]);
// $descripcion = $querydescmerca->fetchAll();
//var_dump($desc);
        // 
                    // $content = '';     
                    // $content .= '<table>';
                    // $content .= '<thead class="thead-dark"><tr>';
                    // $content .= '<td style="text-align: center">Numero Certificado</td>';
                    // $content .= '<td style="text-align: center">Operación</td>';
                    // $content .= '<td style="text-align: center">Formato</td>';
                    // $content .= '<td style="text-align: center">Fecha</td>';
                    // $content .= '<td></td>';
                    // $content .= '</tr></thead>';             
                    // $content .= '<tbody>';
            //         $tabla = '<table>';
            // foreach($descripcion as $desc) {
            //         $tabla .= '<tr>';
            //         $tabla .= '<td style="width:30px" class="bordeizq centrar">'. $desc['item'] . '</td>';
            //         $tabla .= '<td colspan="3" style="width:260px"><p>'. $desc['descmercancia']  . '</p></td>';
            //         $tabla .= '<td style="width:82px" class="centrar"><p>'. $desc['clasiarancelaria']  . '</p></td>';
            //         $tabla .= '<td style="width:65px" class="centrar"><p>'. $desc['nofactura']  . '</p></td>';
            //         $tabla .= '<td style="width:75px" class="centrar"><p>'. $desc['valorfactura']  . '</p></td>';
            //         $tabla .= '<td style="width:67px" class="borderecho centrar"><p>'. $desc['criterorigen']  . '</p></td>';
            //         $tabla .= '</tr>';
            // }
            // $tabla .='</table>';
            //$content = $tabla;
            //echo $content;
        //     echo $valor['item'] . ' - ' . $valor['descmercancia'].'<br/>';
        //     }
// foreach ($respuesta as $row ) {
//     $descripcion["data"][] = $row;
// }
//var_dump($descripcion);
//echo json_encode($descripcion);

// while ($res = $respuesta->fetch()) {
//     $descripcion["data"][] = $res;
// }

// $nume = $conn->query("select max(id) from  certificados")->fetchColumn();
// echo $nume;

// $stmt = $conn->prepare("INSERT INTO certificados (numerocertificado, regional) VALUES (?, ?)");
// $stmt->bindParam(1, $numero);
// $stmt->bindParam(2, $regional);

// // Establecer parámetros y ejecutar
// $numero = 4124124;
// $regional = "CALI";
// $stmt->execute();

// $numero = 4665767;
// $regional = "BARRA";
// $stmt->execute();
// // Mensaje de éxito en la inserción
// echo "Se han creado las entradas exitosamente";
// // Cerrar conexiones
 $conn = null;
?>