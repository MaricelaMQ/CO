<?php
include "conecta.php";
$estado = $_POST["est"];
    $sql = "select * from vista_ms_certificados where estado='".$estado."'" ;
    // $nume = $conn->query("select max(id) from  certificados")->fetchColumn();    
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
           
    
       
        

    // Select '650' + '{FORM:Sel_Anio}' + '0080'+ Suc_Id + 
    // (select SUBSTRING(
    //     (select STR(
    //         (select cast((MAX(Suc_Cons) + 1) AS DECIMAL(20,0))/100000
    // from Sucursales where Suc_Id ={FORM:Sel_Regional}), 7, 10)
    // from Sucursales where Suc_Id ={FORM:Sel_Regional}), 3, 10) 
    // from  Sucursales where Suc_Id ={FORM:Sel_Regional}) as conteo 
    // from Sucursales where Suc_Id ={FORM:Sel_Regional}
     
       
       // $sql ="select * from detallecertificado";
// $resp = mysqli_query($conn, $sql);

// if (mysqli_num_rows($resp) > 0){
//     while($resultado =mysqli_fetch_assoc($resp)){
//         $datos["data"][] = $resultado;
//     }
//         echo json_encode($datos);
//     }else{
//         die('Error');
//     }
// mysqli_free_result($resp);
 //mysqli_close($conn);
 $conn = null;
?>