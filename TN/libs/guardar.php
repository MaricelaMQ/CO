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
    $descmerca = json_decode( $_POST["items"]);  // decodificar cadena JSON en cadena de objetos (array)
    $operacion = $certificado->{"datosform"}[0]->{"Operacion_"};

        //****** INSERTAR EN TABLA >> CERTIFICADOS
    try{
                $conn->beginTransaction();
        $insCert = $conn->prepare("INSERT INTO tn_certificados (Operacion, Formato, fecha, Estado) VALUES (?, ?, ?,?)");
        //setlocale(LC_TIME, 'es_CO', 'esp_esp');
        $fecha = date("Y-m-d");
        $formato = "TN";
        $insCert->bindParam(1, $operacion);
        $insCert->bindParam(2, $formato);
        $insCert->bindParam(3, $fecha);
        $insCert->bindParam(4, $estado);
        $respuesta2 = $insCert->execute();
    
        /**CONSULTA ULTIMO ID CERTIFICADO*/
        $idcertificados = $conn->query("select max(id) from tn_certificados")->fetchColumn();
    
    // INSERTAR EN TABLA >> DETALLECERTIFICADO
    $stmt = $conn->prepare("INSERT INTO tn_detallecertificado (NombreExp, TelefonoExp, FaxExp, DireccionExp, CiudadExp, PaisExp, NumRegFiscalExp, FechaDesde, FechaHasta, NumFacturaComercial, NombrePro, TelefonoPro, FaxPro, DireccionPro, CiudadPro, PaisPro, NumRegFiscalPro, NombreImp, TelefonoImp, DireccionImp, CiudadImp, PaisImp, NumRegFiscalImp, Observaciones, FechaElabora, NombreAutoriza, CargoPersonAutoriza, EmpresaAutoriza, TelPersonAutoriza, FaxPersonAutoriza, id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $certificado->{"datosform"}[0]->{"NombreExp_"});
    $stmt->bindParam(2, $certificado->{"datosform"}[0]->{"TelefonoExp_"});
    $stmt->bindParam(3, $certificado->{"datosform"}[0]->{"FaxExp_"});
    $stmt->bindParam(4, $certificado->{"datosform"}[0]->{"DireccionExp_"});
    $stmt->bindParam(5, $certificado->{"datosform"}[0]->{"CiudadExp_"});
    $stmt->bindParam(6, $certificado->{"datosform"}[0]->{"PaisExp_"});
    $stmt->bindParam(7, $certificado->{"datosform"}[0]->{"NumRegFiscalExp_"});
    $stmt->bindParam(8, $certificado->{"datosform"}[0]->{"FechaDesde_"});
    $stmt->bindParam(9, $certificado->{"datosform"}[0]->{"FechaHasta_"});
    $stmt->bindParam(10, $certificado->{"datosform"}[0]->{"NumFacturaComercial_"});
    $stmt->bindParam(11, $certificado->{"datosform"}[0]->{"NombrePro_"});
    $stmt->bindParam(12, $certificado->{"datosform"}[0]->{"TelefonoPro_"});
    $stmt->bindParam(13, $certificado->{"datosform"}[0]->{"FaxPro_"});
    $stmt->bindParam(14, $certificado->{"datosform"}[0]->{"DireccionPro_"});
    $stmt->bindParam(15, $certificado->{"datosform"}[0]->{"CiudadPro_"});
    $stmt->bindParam(16, $certificado->{"datosform"}[0]->{"PaisPro_"});
    $stmt->bindParam(17, $certificado->{"datosform"}[0]->{"NumRegFiscalPro_"});
    $stmt->bindParam(18, $certificado->{"datosform"}[0]->{"NombreImp_"});
    $stmt->bindParam(19, $certificado->{"datosform"}[0]->{"TelefonoImp_"});
    $stmt->bindParam(20, $certificado->{"datosform"}[0]->{"DireccionImp_"});
    $stmt->bindParam(21, $certificado->{"datosform"}[0]->{"CiudadImp_"});
    $stmt->bindParam(22, $certificado->{"datosform"}[0]->{"PaisImp_"});
    $stmt->bindParam(23, $certificado->{"datosform"}[0]->{"NumRegFiscalImp_"});
    $stmt->bindParam(24, $certificado->{"datosform"}[0]->{"Observaciones_"});
    $stmt->bindParam(25, $certificado->{"datosform"}[0]->{"FechaElabora_"});
    $stmt->bindParam(26, $certificado->{"datosform"}[0]->{"NombreAutoriza_"});
    $stmt->bindParam(27, $certificado->{"datosform"}[0]->{"CargoPersonAutoriza_"});
    $stmt->bindParam(28, $certificado->{"datosform"}[0]->{"EmpresaAutoriza_"});
    $stmt->bindParam(29, $certificado->{"datosform"}[0]->{"TelPersonAutoriza_"});
    $stmt->bindParam(30, $certificado->{"datosform"}[0]->{"FaxPersonAutoriza_"});
    $stmt->bindParam(31, $idcertificados);
    $respuesta1 = $stmt->execute();
    /****** INSERTAR EN TABLA DESCRIPCION MERCANCIAS* */
    $insdescmerca = $conn->prepare("INSERT INTO tn_descripcionmercancias (ID_CertificadosTN, item, DescMercancia, ClasiArancelaria, CritePreferencial, OtrosCriterios, Productor, PaisdeOrigen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $it = 1;
    foreach($descmerca->{"tabladesc"} as $item){
        $insdescmerca->bindParam(1, $idcertificados);
        $insdescmerca->bindParam(2, $it);
        $insdescmerca->bindParam(3, $item->{"DescMercancia_"});
        $insdescmerca->bindParam(4, $item->{"ClasiArancelaria_"});
        $insdescmerca->bindParam(5, $item->{"CritePreferencial_"});
        $insdescmerca->bindParam(6, $item->{"OtrosCriterios_"});
        $insdescmerca->bindParam(7, $item->{"Productor_"});
        $insdescmerca->bindParam(8, $item->{"PaisdeOrigen_"});
        $respuesta3 = $insdescmerca->execute();
        $it++;        
    }
            $conn->commit();
}catch(PDOException $exception){
            $conn->rollBack();
            echo 'ERROR:' . $exception->getMessage();
            $respuesta1 = 0;
}
    return $respuesta1;
}
// ACTUALIZAR DATOS EN TABLAS BD
function actualizar($conn, $id, $estado, $idborrar){    
    $certificado = json_decode( $_POST["guardar"]);  // decodificar cadena JSON en cadena de objetos (array)
    $descmerca = json_decode( $_POST["items"]);  // decodificar cadena JSON en cadena de objetos (array)
    $operacion = $certificado->{"datosform"}[0]->{"Operacion_"};
    // UPDATE  EN TABLA >> DETALLECERTIFICADO
    try{
            $conn->beginTransaction();
    $stmt = $conn->prepare("UPDATE tn_detallecertificado 
                            SET NombreExp=?, TelefonoExp=?, FaxExp=?, DireccionExp=?, CiudadExp=?, PaisExp=?, NumRegFiscalExp=?, 
                                FechaDesde=?, FechaHasta=?, NumFacturaComercial=?, 
                                NombrePro=?, TelefonoPro=?, FaxPro=?, DireccionPro=?, CiudadPro=?, PaisPro=?, NumRegFiscalPro=?, 
                                NombreImp=?, TelefonoImp=?, DireccionImp=?, CiudadImp=?, PaisImp=?, NumRegFiscalImp=?, 
                                Observaciones=?, FechaElabora=?, NombreAutoriza=?, CargoPersonAutoriza=?, 
                                EmpresaAutoriza=?, TelPersonAutoriza=?, FaxPersonAutoriza=?
                            WHERE id=?");
    $stmt->bindParam(1, $certificado->{"datosform"}[0]->{"NombreExp_"});
    $stmt->bindParam(2, $certificado->{"datosform"}[0]->{"TelefonoExp_"});
    $stmt->bindParam(3, $certificado->{"datosform"}[0]->{"FaxExp_"});
    $stmt->bindParam(4, $certificado->{"datosform"}[0]->{"DireccionExp_"});
    $stmt->bindParam(5, $certificado->{"datosform"}[0]->{"CiudadExp_"});
    $stmt->bindParam(6, $certificado->{"datosform"}[0]->{"PaisExp_"});
    $stmt->bindParam(7, $certificado->{"datosform"}[0]->{"NumRegFiscalExp_"});
    $stmt->bindParam(8, $certificado->{"datosform"}[0]->{"FechaDesde_"});
    $stmt->bindParam(9, $certificado->{"datosform"}[0]->{"FechaHasta_"});
    $stmt->bindParam(10, $certificado->{"datosform"}[0]->{"NumFacturaComercial_"});
    $stmt->bindParam(11, $certificado->{"datosform"}[0]->{"NombrePro_"});
    $stmt->bindParam(12, $certificado->{"datosform"}[0]->{"TelefonoPro_"});
    $stmt->bindParam(13, $certificado->{"datosform"}[0]->{"FaxPro_"});
    $stmt->bindParam(14, $certificado->{"datosform"}[0]->{"DireccionPro_"});
    $stmt->bindParam(15, $certificado->{"datosform"}[0]->{"CiudadPro_"});
    $stmt->bindParam(16, $certificado->{"datosform"}[0]->{"PaisPro_"});
    $stmt->bindParam(17, $certificado->{"datosform"}[0]->{"NumRegFiscalPro_"});
    $stmt->bindParam(18, $certificado->{"datosform"}[0]->{"NombreImp_"});
    $stmt->bindParam(19, $certificado->{"datosform"}[0]->{"TelefonoImp_"});
    $stmt->bindParam(20, $certificado->{"datosform"}[0]->{"DireccionImp_"});
    $stmt->bindParam(21, $certificado->{"datosform"}[0]->{"CiudadImp_"});
    $stmt->bindParam(22, $certificado->{"datosform"}[0]->{"PaisImp_"});
    $stmt->bindParam(23, $certificado->{"datosform"}[0]->{"NumRegFiscalImp_"});
    $stmt->bindParam(24, $certificado->{"datosform"}[0]->{"Observaciones_"});
    $stmt->bindParam(25, $certificado->{"datosform"}[0]->{"FechaElabora_"});
    $stmt->bindParam(26, $certificado->{"datosform"}[0]->{"NombreAutoriza_"});
    $stmt->bindParam(27, $certificado->{"datosform"}[0]->{"CargoPersonAutoriza_"});
    $stmt->bindParam(28, $certificado->{"datosform"}[0]->{"EmpresaAutoriza_"});
    $stmt->bindParam(29, $certificado->{"datosform"}[0]->{"TelPersonAutoriza_"});
    $stmt->bindParam(30, $certificado->{"datosform"}[0]->{"FaxPersonAutoriza_"});    
    $stmt->bindParam(31, $id);
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

    $updateCert = $conn->prepare("UPDATE tn_certificados 
                                SET Operacion=?, Estado=? 
                                WHERE id=?");
    $updateCert->bindParam(1, $operacion);
    $updateCert->bindParam(2, $estado);    
    $updateCert->bindParam(3, $id);
    $respuesta2 = $updateCert->execute();
    
        //* Sentencia preparada para INSERTAR
        $insdescmerca = $conn->prepare("INSERT INTO tn_descripcionmercancias 
                                                    (ID_CertificadosTN, item, DescMercancia, ClasiArancelaria, CritePreferencial, OtrosCriterios, Productor, PaisdeOrigen) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        //* Sentencia preparada para ACTUALIZAR
        $updateDescmerca = $conn->prepare("UPDATE tn_descripcionmercancias 
                                           SET item=?, DescMercancia=?, ClasiArancelaria=?, CritePreferencial=?, OtrosCriterios=?, Productor=?, PaisdeOrigen=?
                                           WHERE id=?");
    $it = 1;
    foreach($descmerca->{"tabladesc"} as $item){
                
            if($item->{"idDescmercancia_"}>0){// SI idDescmercancia >0 ACTUALIZA REGISTRO EN TABLA DESCIPCION MERCANCIAS
                    $updateDescmerca->bindParam(1, $it);
                    $updateDescmerca->bindParam(2, $item->{"DescMercancia_"});
                    $updateDescmerca->bindParam(3, $item->{"ClasiArancelaria_"});
                    $updateDescmerca->bindParam(4, $item->{"CritePreferencial_"});
                    $updateDescmerca->bindParam(5, $item->{"OtrosCriterios_"});
                    $updateDescmerca->bindParam(6, $item->{"Productor_"});
                    $updateDescmerca->bindParam(7, $item->{"PaisdeOrigen_"});
                    $updateDescmerca->bindParam(8, $item->{"idDescmercancia_"});
                    $respuesta3 = $updateDescmerca->execute();
                }else {
                    $insdescmerca->bindParam(1, $id);
                    $insdescmerca->bindParam(2, $it);
                    $insdescmerca->bindParam(3, $item->{"DescMercancia_"});
                    $insdescmerca->bindParam(4, $item->{"ClasiArancelaria_"});
                    $insdescmerca->bindParam(5, $item->{"CritePreferencial_"});
                    $insdescmerca->bindParam(6, $item->{"OtrosCriterios_"});
                    $insdescmerca->bindParam(7, $item->{"Productor_"});
                    $insdescmerca->bindParam(8, $item->{"PaisdeOrigen_"});
                    $respuesta4 = $insdescmerca->execute();
                }
    $it++;    
    }
            $conn->commit();
    }catch(PDOException $exception){
            $conn->rollBack();
            echo 'ERROR:' .$exception->getMessage();
            $respuesta1 = 0;
    }
    return $respuesta1;
}

function eliminaRegistro($conn, $idborrar){
    $borrardescmerca = $conn->prepare("delete FROM tn_descripcionmercancias where id=?");    
        foreach ($idborrar as $numId) {
            $borrardescmerca->execute([$numId]);
        }
}
?>