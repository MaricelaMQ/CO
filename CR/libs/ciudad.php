<?php 
include "conecta.php";
$ciudad = $_POST["Ciudad"];
//$id = 1 ;
$stmt = $conn->prepare("SELECT * FROM ciudades WHERE ciudad=?");
        $stmt->execute([$ciudad]);
$consulta = $stmt->fetch();
// if($consulta){
//     foreach ($consulta as $row) {
//      $datos["datos"][] = $row;
//     }
//  echo json_encode($consulta);
// }
  echo json_encode($consulta);
?>