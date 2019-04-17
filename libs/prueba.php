<?php
include "conecta.php";
/*****CONSULTA DETALLE CERTIFICADO */
//$id=4;
$stmt = $conn->prepare("SELECT * FROM detallecertificado WHERE id=?");
$stmt->execute([$id]);
$datos = $stmt->fetch();
//var_dump($datos);
/*****CONSULTA DESCRIPCION MERCANCIAS */
$querydescmerca = $conn->prepare("SELECT item, descmercancia, clasiarancelaria, nofactura, valorfactura, criterorigen FROM descripcionmercancias WHERE id_certificados=?");
$querydescmerca->execute([$id]);
$descripcion = $querydescmerca->fetchAll();
//var_dump($desc);
// foreach($desc as $valor) {
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
 //$conn = null;
?>