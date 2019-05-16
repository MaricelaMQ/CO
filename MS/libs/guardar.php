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
    $operacion = $certificado->{"data"}[0]->{"operacion"};
    // INSERTAR EN TABLA >> DETALLECERTIFICADO
    $stmt = $conn->prepare("INSERT INTO detallecertificado (NombreExp, DireccionExp, TelefonoExp, FaxExp, CorreoExp, NumRegFiscalExp, LugarExp, FechaExp, NombrePro, DireccionPro, TelefonoPro, FaxPro, CorreoPro, NumRegFiscalPro, NombreImp, DireccionImp, TelefonoImp, FaxImp, CorreoImp, NumRegFiscalImp,Observaciones, DireccionAutoCompe, TelefonoAutoCompe, FaxAutoCompe, CorreoAutoCompe  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $certificado->{"data"}[0]->{"nombreexp"});
    $stmt->bindParam(2, $certificado->{"data"}[0]->{"direccionexp"});
    $stmt->bindParam(3, $certificado->{"data"}[0]->{"telefonoexp"});
    $stmt->bindParam(4, $certificado->{"data"}[0]->{"faxexp"});
    $stmt->bindParam(5, $certificado->{"data"}[0]->{"correoexp"});
    $stmt->bindParam(6, $certificado->{"data"}[0]->{"numregfiscalexp"});
    $stmt->bindParam(7, $certificado->{"data"}[0]->{"lugarexp"});
    $stmt->bindParam(8, $certificado->{"data"}[0]->{"fechaexp"});
    $stmt->bindParam(9, $certificado->{"data"}[0]->{"nombrepro"});
    $stmt->bindParam(10, $certificado->{"data"}[0]->{"direccionpro"});
    $stmt->bindParam(11, $certificado->{"data"}[0]->{"telefonopro"});
    $stmt->bindParam(12, $certificado->{"data"}[0]->{"faxpro"});
    $stmt->bindParam(13, $certificado->{"data"}[0]->{"correopro"});
    $stmt->bindParam(14, $certificado->{"data"}[0]->{"numregfiscalpro"});
    $stmt->bindParam(15, $certificado->{"data"}[0]->{"nombreimp"});
    $stmt->bindParam(16, $certificado->{"data"}[0]->{"direccionimp"});
    $stmt->bindParam(17, $certificado->{"data"}[0]->{"telefonoimp"});
    $stmt->bindParam(18, $certificado->{"data"}[0]->{"faximp"});
    $stmt->bindParam(19, $certificado->{"data"}[0]->{"correoimp"});
    $stmt->bindParam(20, $certificado->{"data"}[0]->{"numregfiscalimp"});
    $stmt->bindParam(21, $certificado->{"data"}[0]->{"observaciones"});
    $stmt->bindParam(22, $certificado->{"data"}[0]->{"direccionautocompe"});
    $stmt->bindParam(23, $certificado->{"data"}[0]->{"telefonoautocompe"});
    $stmt->bindParam(24, $certificado->{"data"}[0]->{"faxautocompe"});
    $stmt->bindParam(25, $certificado->{"data"}[0]->{"correoautocompe"});
    //$stmt->bindParam(26, $certificado->{"data"}[0]->{"lugarautocompe"});
    //$stmt->bindParam(27, $certificado->{"data"}[0]->{"fechaautocompe"});
    $respuesta1 = $stmt->execute();
    //****** INSERTAR EN TABLA >> CERTIFICADOS
    $insCert = $conn->prepare("INSERT INTO certificados (Operacion, Regional, fecha, Estado) VALUES (?, ?, ?,?)");
    //setlocale(LC_TIME, 'es_CO', 'esp_esp');
    $fecha = date("Y-m-d");
    $regional = "CR";
    $insCert->bindParam(1, $operacion);
    $insCert->bindParam(2, $regional);
    $insCert->bindParam(3, $fecha);
    $insCert->bindParam(4, $estado);
    $respuesta2 = $insCert->execute();

    /**CONSULTA ULTIMO ID CERTIFICADO*/
    $idcertificados = $conn->query("select max(id) from certificados")->fetchColumn();
    /****** INSERTAR EN TABLA DESCRIPCION MERCANCIAS* */
    $insdescmerca = $conn->prepare("INSERT INTO descripcionmercancias (id_certificados, item, descmercancia, clasiarancelaria, nofactura, valorfactura, criterorigen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $it = 1;
    foreach($descmerca->{"tabladesc"} as $item){
        $insdescmerca->bindParam(1, $idcertificados);
        $insdescmerca->bindParam(2, $it);
        $insdescmerca->bindParam(3, $item->{"descripcion"});
        $insdescmerca->bindParam(4, $item->{"clasiarancelaria"});
        $insdescmerca->bindParam(5, $item->{"nofactura"});
        $insdescmerca->bindParam(6, $item->{"valorfactura"});
        $insdescmerca->bindParam(7, $item->{"criterorigen"});        
        $respuesta3 = $insdescmerca->execute();
        $it++;        
    }

    return $respuesta1;
}
// ACTUALIZAR DATOS EN TABLAS BD
function actualizar($conn, $id, $estado, $idborrar){    
    $certificado = json_decode( $_POST["guardar"]);  // decodificar cadena JSON en cadena de objetos (array)
    $descmerca = json_decode( $_POST["items"]);  // decodificar cadena JSON en cadena de objetos (array)
    $operacion = $certificado->{"data"}[0]->{"operacion"};
    // UPDATE  EN TABLA >> DETALLECERTIFICADO
    $stmt = $conn->prepare("UPDATE detallecertificado 
                            SET NombreExp=?,
                                DireccionExp=?, TelefonoExp=?, FaxExp=?, CorreoExp=?, NumRegFiscalExp=?, LugarExp=?, FechaExp=?, 
                                NombrePro=?, DireccionPro=?, TelefonoPro=?, FaxPro=?, CorreoPro=?, NumRegFiscalPro=?, 
                                NombreImp=?, DireccionImp=?, TelefonoImp=?, FaxImp=?, CorreoImp=?, NumRegFiscalImp=?, Observaciones=?, 
                                DireccionAutoCompe=?, TelefonoAutoCompe=?, FaxAutoCompe=?, CorreoAutoCompe=? 
                            WHERE id=?");
    $stmt->bindParam(1, $certificado->{"data"}[0]->{"nombreexp"});
    $stmt->bindParam(2, $certificado->{"data"}[0]->{"direccionexp"});
    $stmt->bindParam(3, $certificado->{"data"}[0]->{"telefonoexp"});
    $stmt->bindParam(4, $certificado->{"data"}[0]->{"faxexp"});
    $stmt->bindParam(5, $certificado->{"data"}[0]->{"correoexp"});
    $stmt->bindParam(6, $certificado->{"data"}[0]->{"numregfiscalexp"});
    $stmt->bindParam(7, $certificado->{"data"}[0]->{"lugarexp"});
    $stmt->bindParam(8, $certificado->{"data"}[0]->{"fechaexp"});
    $stmt->bindParam(9, $certificado->{"data"}[0]->{"nombrepro"});
    $stmt->bindParam(10, $certificado->{"data"}[0]->{"direccionpro"});
    $stmt->bindParam(11, $certificado->{"data"}[0]->{"telefonopro"});
    $stmt->bindParam(12, $certificado->{"data"}[0]->{"faxpro"});
    $stmt->bindParam(13, $certificado->{"data"}[0]->{"correopro"});
    $stmt->bindParam(14, $certificado->{"data"}[0]->{"numregfiscalpro"});
    $stmt->bindParam(15, $certificado->{"data"}[0]->{"nombreimp"});
    $stmt->bindParam(16, $certificado->{"data"}[0]->{"direccionimp"});
    $stmt->bindParam(17, $certificado->{"data"}[0]->{"telefonoimp"});
    $stmt->bindParam(18, $certificado->{"data"}[0]->{"faximp"});
    $stmt->bindParam(19, $certificado->{"data"}[0]->{"correoimp"});
    $stmt->bindParam(20, $certificado->{"data"}[0]->{"numregfiscalimp"});
    $stmt->bindParam(21, $certificado->{"data"}[0]->{"observaciones"});
    $stmt->bindParam(22, $certificado->{"data"}[0]->{"direccionautocompe"});
    $stmt->bindParam(23, $certificado->{"data"}[0]->{"telefonoautocompe"});
    $stmt->bindParam(24, $certificado->{"data"}[0]->{"faxautocompe"});
    $stmt->bindParam(25, $certificado->{"data"}[0]->{"correoautocompe"});    
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

    $updateCert = $conn->prepare("UPDATE certificados 
                                SET Operacion=?, Estado=? 
                                WHERE id=?");
    $updateCert->bindParam(1, $operacion);
    $updateCert->bindParam(2, $estado);    
    $updateCert->bindParam(3, $id);
    $respuesta2 = $updateCert->execute();
    
        //* Sentencia preparada para INSERTAR
        $insdescmerca = $conn->prepare("INSERT INTO descripcionmercancias 
                                                    (id_certificados, item, descmercancia, clasiarancelaria, nofactura, valorfactura, criterorigen) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
        //* Sentencia preparada para ACTUALIZAR
        $updateDescmerca = $conn->prepare("UPDATE descripcionmercancias 
                                           SET item=?, descmercancia=?, clasiarancelaria=?, nofactura=?, valorfactura=?, criterorigen=?
                                           WHERE id=?");
    $it = 1;
    foreach($descmerca->{"tabladesc"} as $item){
                
            if($item->{"idDescmercancia"}>0){// SI idDescmercancia >0 ACTUALIZA REGISTRO EN TABLA DESCIPCION MERCANCIAS
                    $updateDescmerca->bindParam(1, $it);
                    $updateDescmerca->bindParam(2, $item->{"descripcion"});
                    $updateDescmerca->bindParam(3, $item->{"clasiarancelaria"});
                    $updateDescmerca->bindParam(4, $item->{"nofactura"});
                    $updateDescmerca->bindParam(5, $item->{"valorfactura"});
                    $updateDescmerca->bindParam(6, $item->{"criterorigen"});
                    $updateDescmerca->bindParam(7, $item->{"idDescmercancia"});
                    $respuesta3 = $updateDescmerca->execute();
                }else {
                    $insdescmerca->bindParam(1, $id);
                    $insdescmerca->bindParam(2, $it);
                    $insdescmerca->bindParam(3, $item->{"descripcion"});
                    $insdescmerca->bindParam(4, $item->{"clasiarancelaria"});
                    $insdescmerca->bindParam(5, $item->{"nofactura"});
                    $insdescmerca->bindParam(6, $item->{"valorfactura"});
                    $insdescmerca->bindParam(7, $item->{"criterorigen"});        
                    $respuesta4 = $insdescmerca->execute();
                }
    $it++;    
    }
    
    return $respuesta1;
}

function eliminaRegistro($conn, $idborrar){
    $borrardescmerca = $conn->prepare("delete FROM descripcionmercancias where id=?");    
        foreach ($idborrar as $numId) {
            $borrardescmerca->execute([$numId]);
        }
}
?>