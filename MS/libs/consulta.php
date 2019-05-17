<?php
ob_start();
include "conecta.php";
/*****CONSULTA DETALLE CERTIFICADO */
//  $id=1;
if(isset($id)){
        $stmt = $conn->prepare("SELECT * FROM vista_ms_datoscertificados WHERE id=?");
        $stmt->execute([$id]);
        $datos = $stmt->fetch();
        /**CONSULTA TABLA BD DESCRIPCION MERCANCIAS */
        // $querydescmerca = $conn->prepare("SELECT id, item, descmercancia, clasiarancelaria, nofactura, valorfactura, criterorigen FROM descripcionmercancias WHERE id_certificados=?");        
         $querydescmerca = $conn->prepare("SELECT * FROM ms_descripcionmercancias WHERE id_certificadosMS=?");
        $querydescmerca->execute([$id]);
        // $descripcion = $querydescmerca->fetchAll();
         $descripcion = $querydescmerca->fetchAll();        
        
        if(count($descripcion)==0){
                $descripcion=0;
        }
}else{
        $datos='';
}
 $conn = null;
 ob_flush();
?>