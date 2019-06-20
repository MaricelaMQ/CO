<?php
include "conecta.php";
$estado = $_POST["est"];
    $sql = "select * from vista_eu_certificados where estado='".$estado."'" ;
    // $nume = $conn->query("select max(id) from certificados")->fetchColumn();    
    //$resp = $conn->query($sql, PDO::FETCH_ASSOC);
    //$resp = $conn->query("select id, Operacion, Regional, Fecha, estado from vista_certificados")->fetchColumn();
    $resp = $conn->query($sql)->fetchColumn();
    //$resp = $conn->query("select id, Operacion, Regional, Fecha from  certificados")->fetchColumn();

    if ($resp <1){
            $respuesta = 'N';
            echo $respuesta;
            
    } else {
         $resp = $conn->query($sql, PDO::FETCH_ASSOC);
             foreach ($resp as $row) {
                $datos["data"][] = $row;
            }
            echo json_encode($datos);
            //var_dump($datos);
     }
 $conn = null;
?>