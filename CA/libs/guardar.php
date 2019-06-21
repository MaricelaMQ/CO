<?php

include "conecta.php";
$estado = $_POST["estado"];
$id = $_POST["id"];
$editar = $_POST["editar"];// variable determina si es esta editando formulario.
$idborrar = $_POST["idborrar"];
//var_dump($idborrar);
$resp = false;
if(isset($editar)){ // Verificar si variable '$id' esta definida
    // $stmt = $conn->prepare("SELECT * FROM certificados WHERE id=?");    
    // $stmt->execute([$id]);
    // $datos = $stmt->fetch();
    if ($editar==1){
        //echo "Editar registro id: ". $id;
        $resp = actualizar($conn, $id, $estado, $idborrar);
    }else{
      //  echo "Insertar nuevo registro";
        $resp = insertar($estado, $conn);
    }
}else{
    // Crear nuevo certificado
    //echo "ID no definido INSERTAR";
    $resp = insertar($estado, $conn);
}
echo $resp;

/*************************** FUNCIONES ***************** */
// INSERTAR DATOS EN TABLAS BD
function insertar($estado, $conn){
    $respuesta= false;
    $certificado = json_decode( $_POST["guardar"]);  // decodificar cadena JSON en cadena de objetos (array)
    //var_dump($certificado);
    $descmerca = json_decode( $_POST["items"]);  // decodificar cadena JSON en cadena de objetos (array)
    $operacion = $certificado->{"datosform"}[0]->{"Operacion"};

    //****** INSERTAR EN TABLA >> CERTIFICADOS
    try{
                $conn->beginTransaction();
    $insCert = $conn->prepare("INSERT INTO can_certificados (Operacion, Formato, Fecha, Estado) VALUES (?, ?, ?, ?)");
    //setlocale(LC_TIME, 'es_CO', 'esp_esp');
    $fecha = date("Y-m-d");
    $formato = "CA";
    $insCert->bindParam(1, $operacion);
    $insCert->bindParam(2, $formato);
    $insCert->bindParam(3, $fecha);
    $insCert->bindParam(4, $estado);
    $respuesta2 = $insCert->execute();

    /**CONSULTA ULTIMO ID CERTIFICADO*/
    $idcertificados = $conn->query("select max(id) from can_certificados")->fetchColumn();

    // INSERTAR EN TABLA >> DETALLECERTIFICADO
    $stmt = $conn->prepare("INSERT INTO can_detallecertificado 
                                        (NombreExp, DireccionExp, TelefonoExp, FaxExp, CorreoExp, FechaDesde, FechaHasta, NombrePro, DireccionPro, TelefonoPro, FaxPro, CorreoPro, NombreImp, DireccionImp, TelefonoImp, FaxImp, CorreoImp, FechaElabora, NombreAutoriza, EmpresaAutoriza, CargoPersonAutoriza, TelPersonAutoriza, FaxPersonAutoriza, CorreoPersonAutoriza, Observaciones, id) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $certificado->{"datosform"}[0]->{"NombreExp"});
    $stmt->bindParam(2, $certificado->{"datosform"}[0]->{"DireccionExp"});
    $stmt->bindParam(3, $certificado->{"datosform"}[0]->{"TelefonoExp"});
    $stmt->bindParam(4, $certificado->{"datosform"}[0]->{"FaxExp"});
    $stmt->bindParam(5, $certificado->{"datosform"}[0]->{"CorreoExp"});
    $stmt->bindParam(6, $certificado->{"datosform"}[0]->{"FechaDesde"});
    $stmt->bindParam(7, $certificado->{"datosform"}[0]->{"FechaHasta"});
    $stmt->bindParam(8, $certificado->{"datosform"}[0]->{"NombrePro"});
    $stmt->bindParam(9, $certificado->{"datosform"}[0]->{"DireccionPro"});
    $stmt->bindParam(10, $certificado->{"datosform"}[0]->{"TelefonoPro"});
    $stmt->bindParam(11, $certificado->{"datosform"}[0]->{"FaxPro"});
    $stmt->bindParam(12, $certificado->{"datosform"}[0]->{"CorreoPro"});
    $stmt->bindParam(13, $certificado->{"datosform"}[0]->{"NombreImp"});
    $stmt->bindParam(14, $certificado->{"datosform"}[0]->{"DireccionImp"});
    $stmt->bindParam(15, $certificado->{"datosform"}[0]->{"TelefonoImp"});
    $stmt->bindParam(16, $certificado->{"datosform"}[0]->{"FaxImp"});
    $stmt->bindParam(17, $certificado->{"datosform"}[0]->{"CorreoImp"});
    $stmt->bindParam(18, $certificado->{"datosform"}[0]->{"FechaElabora"});
    $stmt->bindParam(19, $certificado->{"datosform"}[0]->{"NombreAutoriza"});
    $stmt->bindParam(20, $certificado->{"datosform"}[0]->{"EmpresaAutoriza"});
    $stmt->bindParam(21, $certificado->{"datosform"}[0]->{"CargoPersonAutoriza"});
    $stmt->bindParam(22, $certificado->{"datosform"}[0]->{"TelPersonAutoriza"});
    $stmt->bindParam(23, $certificado->{"datosform"}[0]->{"FaxPersonAutoriza"});
    $stmt->bindParam(24, $certificado->{"datosform"}[0]->{"CorreoPersonAutoriza"});
    $stmt->bindParam(25, $certificado->{"datosform"}[0]->{"Observaciones"});
    $stmt->bindParam(26, $idcertificados);
    $respuesta1 = $stmt->execute();

    
    /****** INSERTAR EN TABLA DESCRIPCION MERCANCIAS* */
    $insdescmerca = $conn->prepare("INSERT INTO can_descripcionmercancias (ID_CertificadosCAN, DescMercancia, ClasiArancelaria, CritPreferencial, Productor, PruebadeValor, PaisdeOrigen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    //$it = 1;
    foreach($descmerca->{"tabladesc"} as $item){
        $insdescmerca->bindParam(1, $idcertificados);
        $insdescmerca->bindParam(2, $item->{"DescMercancia"});
        $insdescmerca->bindParam(3, $item->{"ClasiArancelaria"});
        $insdescmerca->bindParam(4, $item->{"CritPreferencial"});
        $insdescmerca->bindParam(5, $item->{"Productor"});
        $insdescmerca->bindParam(6, $item->{"PruebadeValor"});
        $insdescmerca->bindParam(7, $item->{"PaisdeOrigen"});
        $respuesta3 = $insdescmerca->execute();
        //$it++;
    }
            $conn->commit();
    }catch(PDOException $exception){
            $conn->rollBack();
            echo 'ERROR:' .$exception->getMessage();
            $respuesta2 = 0;    
        }
        return $respuesta2;
    }
// ACTUALIZAR DATOS EN TABLAS BD
function actualizar($conn, $id, $estado, $idborrar){
    $certificado = json_decode( $_POST["guardar"]);  // decodificar cadena JSON en cadena de objetos (array)
    $descmerca = json_decode( $_POST["items"]);  // decodificar cadena JSON en cadena de objetos (array)
    $operacion = $certificado->{"datosform"}[0]->{"Operacion"};
    // UPDATE  EN TABLA >> DETALLECERTIFICADO
    try{
            $conn->beginTransaction();
    $stmt = $conn->prepare("UPDATE can_detallecertificado 
                            SET NombreExp=?, DireccionExp=?, TelefonoExp=?, FaxExp=?, CorreoExp=?, FechaDesde=?, FechaHasta=?, 
                                NombrePro=?, DireccionPro=?, TelefonoPro=?, FaxPro=?, CorreoPro=?, 
                                NombreImp=?, DireccionImp=?, TelefonoImp=?, FaxImp=?, CorreoImp=?, 
                                FechaElabora=?, NombreAutoriza=?, EmpresaAutoriza=?, CargoPersonAutoriza=?, TelPersonAutoriza=?, FaxPersonAutoriza=?, CorreoPersonAutoriza=?, Observaciones
                            WHERE id=?");
        $stmt->bindParam(1, $certificado->{"datosform"}[0]->{"NombreExp"});
        $stmt->bindParam(2, $certificado->{"datosform"}[0]->{"DireccionExp"});
        $stmt->bindParam(3, $certificado->{"datosform"}[0]->{"TelefonoExp"});
        $stmt->bindParam(4, $certificado->{"datosform"}[0]->{"FaxExp"});
        $stmt->bindParam(5, $certificado->{"datosform"}[0]->{"CorreoExp"});
        $stmt->bindParam(6, $certificado->{"datosform"}[0]->{"FechaDesde"});
        $stmt->bindParam(7, $certificado->{"datosform"}[0]->{"FechaHasta"});
        $stmt->bindParam(8, $certificado->{"datosform"}[0]->{"NombrePro"});
        $stmt->bindParam(9, $certificado->{"datosform"}[0]->{"DireccionPro"});
        $stmt->bindParam(10, $certificado->{"datosform"}[0]->{"TelefonoPro"});
        $stmt->bindParam(11, $certificado->{"datosform"}[0]->{"FaxPro"});
        $stmt->bindParam(12, $certificado->{"datosform"}[0]->{"CorreoPro"});
        $stmt->bindParam(13, $certificado->{"datosform"}[0]->{"NombreImp"});
        $stmt->bindParam(14, $certificado->{"datosform"}[0]->{"DireccionImp"});
        $stmt->bindParam(15, $certificado->{"datosform"}[0]->{"TelefonoImp"});
        $stmt->bindParam(16, $certificado->{"datosform"}[0]->{"FaxImp"});
        $stmt->bindParam(17, $certificado->{"datosform"}[0]->{"CorreoImp"});
        $stmt->bindParam(18, $certificado->{"datosform"}[0]->{"FechaElabora"});
        $stmt->bindParam(19, $certificado->{"datosform"}[0]->{"NombreAutoriza"});
        $stmt->bindParam(20, $certificado->{"datosform"}[0]->{"EmpresaAutoriza"});
        $stmt->bindParam(21, $certificado->{"datosform"}[0]->{"CargoPersonAutoriza"});
        $stmt->bindParam(22, $certificado->{"datosform"}[0]->{"TelPersonAutoriza"});
        $stmt->bindParam(23, $certificado->{"datosform"}[0]->{"FaxPersonAutoriza"});
        $stmt->bindParam(24, $certificado->{"datosform"}[0]->{"CorreoPersonAutoriza"});
        $stmt->bindParam(25, $certificado->{"datosform"}[0]->{"Observaciones"});
        $stmt->bindParam(26, $id);
    $respuesta1 = $stmt->execute();
    
    //******************* VERIFICAR SI HAY ITEMS ELIMINADOS DESCRIPCION MERCANCIAS TABLA HTML    
    
     if (isset($idborrar)){
            if ($idborrar[0]!=-1){                
//              echo "SI hay registros para para borrar ". $idborrar[0];
                eliminaRegistro($conn, $idborrar);            
//              echo "NO hay registros para borrar" . $idborrar[0];
         }
        }
    //*********************** UPDATE TABLA CERTIFICADOS

    $updateCert = $conn->prepare("UPDATE can_certificados 
                                SET Operacion=?, Estado=? 
                                WHERE id=?");
    $updateCert->bindParam(1, $operacion);
    $updateCert->bindParam(2, $estado);
    $updateCert->bindParam(3, $id);
    $respuesta2 = $updateCert->execute();
    
        //* Sentencia preparada para INSERTAR DESCRIPCION DE LAS MERCANCIAS
        $insdescmerca = $conn->prepare("INSERT INTO can_descripcionmercancias 
                                                    (ID_CertificadosCAN, DescMercancia, ClasiArancelaria, CritPreferencial, Productor, PruebadeValor, PaisdeOrigen) 
                                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        //* Sentencia preparada para ACTUALIZAR DESCRIPCION DE LAS MERCANCIAS
        $updateDescmerca = $conn->prepare("UPDATE can_descripcionmercancias 
                                           SET DescMercancia=?, ClasiArancelaria=?, CritPreferencial=?, Productor=?, PruebadeValor=?, PaisdeOrigen=?
                                           WHERE id=?");
    //$it = 1;
    foreach($descmerca->{"tabladesc"} as $item){                
            if($item->{"idDescmercancia"}>0){// SI idDescmercancia >0 ACTUALIZA REGISTRO EN TABLA DESCIPCION MERCANCIAS
                    //$updateDescmerca->bindParam(1, $it);
                    $updateDescmerca->bindParam(1, $item->{"DescMercancia"});
                    $updateDescmerca->bindParam(2, $item->{"ClasiArancelaria"});
                    $updateDescmerca->bindParam(3, $item->{"CritPreferencial"});
                    $updateDescmerca->bindParam(4, $item->{"Productor"});
                    $updateDescmerca->bindParam(5, $item->{"PruebadeValor"});
                    $updateDescmerca->bindParam(6, $item->{"PaisdeOrigen"});
                    $updateDescmerca->bindParam(7, $item->{"idDescmercancia"});
                    $respuesta3 = $updateDescmerca->execute();
                }else {
                    $insdescmerca->bindParam(1, $id);
                    //$insdescmerca->bindParam(2, $it);
                    $insdescmerca->bindParam(2, $item->{"DescMercancia"});
                    $insdescmerca->bindParam(3, $item->{"ClasiArancelaria"});
                    $insdescmerca->bindParam(4, $item->{"CritPreferencial"});
                    $insdescmerca->bindParam(5, $item->{"Productor"});
                    $insdescmerca->bindParam(6, $item->{"PruebadeValor"});
                    $insdescmerca->bindParam(7, $item->{"PaisdeOrigen"});
                    $respuesta4 = $insdescmerca->execute();
                }
    //$it++;    
    }
            $conn->commit();
    }catch (PDOException $exception){
        $conn->rollBack();
        echo 'ERROR:' .$exception->getMessage();
        $respuesta1 = 0;
    }
    
    return $respuesta1;
}

function eliminaRegistro($conn, $idborrar){
    $borrardescmerca = $conn->prepare("delete FROM can_descripcionmercancias where id=?");
        foreach ($idborrar as $numId) {
            $borrardescmerca->execute([$numId]);
        }
}

?>