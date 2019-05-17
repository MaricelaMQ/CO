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
    $operacion = $certificado->{"datosform"}[0]->{"operacion"};
    // INSERTAR EN TABLA >> DETALLECERTIFICADO
    $stmt = $conn->prepare("INSERT INTO ms_detallecertificado 
                                        (PaisImp, NoFacturaComercial, FechaDeclaOrigen, RazonSocialExpoPro, NIT, DireccionExpoPro, FechaExpoPro, RazonSocialImp, DireccionImp, MedioTransporte, PuertoEmbarque, Observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $certificado->{"datosform"}[0]->{"paisimp"});
    $stmt->bindParam(2, $certificado->{"datosform"}[0]->{"nofacturacomercial"});
    $stmt->bindParam(3, $certificado->{"datosform"}[0]->{"fechadeclaorigen"});
    $stmt->bindParam(4, $certificado->{"datosform"}[0]->{"razonsocialexpopro"});
    $stmt->bindParam(5, $certificado->{"datosform"}[0]->{"nit"});
    $stmt->bindParam(6, $certificado->{"datosform"}[0]->{"direccionexpopro"});
    $stmt->bindParam(7, $certificado->{"datosform"}[0]->{"fechaexpopro"});
    $stmt->bindParam(8, $certificado->{"datosform"}[0]->{"razonsocialimp"});
    $stmt->bindParam(9, $certificado->{"datosform"}[0]->{"direccionimp"});
    $stmt->bindParam(10, $certificado->{"datosform"}[0]->{"mediotransporte"});
    $stmt->bindParam(11, $certificado->{"datosform"}[0]->{"puertoembarque"});
    $stmt->bindParam(12, $certificado->{"datosform"}[0]->{"observaciones"});    
    $respuesta1 = $stmt->execute();
    //****** INSERTAR EN TABLA >> CERTIFICADOS
    $insCert = $conn->prepare("INSERT INTO ms_certificados (Operacion, Formato, Fecha, Estado) VALUES (?, ?, ?, ?)");
    //setlocale(LC_TIME, 'es_CO', 'esp_esp');
    $fecha = date("Y-m-d");
    $formato = "MS";
    $insCert->bindParam(1, $operacion);
    $insCert->bindParam(2, $formato);
    $insCert->bindParam(3, $fecha);
    $insCert->bindParam(4, $estado);
    $respuesta2 = $insCert->execute();

    /**CONSULTA ULTIMO ID CERTIFICADO*/
    $idcertificados = $conn->query("select max(id) from ms_certificados")->fetchColumn();
    /****** INSERTAR EN TABLA DESCRIPCION MERCANCIAS* */
    $insdescmerca = $conn->prepare("INSERT INTO ms_descripcionmercancias (ID_certificadosMS, NoOrden, Naladisa, DescMercancia, PesoCantidad, ValorFob, Normas) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $it = 1;
    foreach($descmerca->{"tabladesc"} as $item){
        $insdescmerca->bindParam(1, $idcertificados);
        $insdescmerca->bindParam(2, $it);
        $insdescmerca->bindParam(3, $item->{"naladisa"});
        $insdescmerca->bindParam(4, $item->{"descripcion"});
        $insdescmerca->bindParam(5, $item->{"pesocantidad"});
        $insdescmerca->bindParam(6, $item->{"valorfob"});
        $insdescmerca->bindParam(7, $item->{"normas"});        
        $respuesta3 = $insdescmerca->execute();
        $it++;        
    }

    return $respuesta1;
}
// ACTUALIZAR DATOS EN TABLAS BD
function actualizar($conn, $id, $estado, $idborrar){    
    $certificado = json_decode( $_POST["guardar"]);  // decodificar cadena JSON en cadena de objetos (array)
    $descmerca = json_decode( $_POST["items"]);  // decodificar cadena JSON en cadena de objetos (array)
    $operacion = $certificado->{"datosform"}[0]->{"operacion"};
    // UPDATE  EN TABLA >> DETALLECERTIFICADO
    $stmt = $conn->prepare("UPDATE ms_detallecertificado 
                            SET PaisImp=?, NoFacturaComercial=?, FechaDeclaOrigen=?, RazonSocialExpoPro=?, NIT=?, DireccionExpoPro=?,
                                FechaExpoPro=?, RazonSocialImp=?, DireccionImp=?, MedioTransporte=?, PuertoEmbarque=?, Observaciones=?
                            WHERE id=?");
    $stmt->bindParam(1, $certificado->{"datosform"}[0]->{"paisimp"});
    $stmt->bindParam(2, $certificado->{"datosform"}[0]->{"nofacturacomercial"});
    $stmt->bindParam(3, $certificado->{"datosform"}[0]->{"fechadeclaorigen"});
    $stmt->bindParam(4, $certificado->{"datosform"}[0]->{"razonsocialexpopro"});
    $stmt->bindParam(5, $certificado->{"datosform"}[0]->{"nit"});
    $stmt->bindParam(6, $certificado->{"datosform"}[0]->{"direccionexpopro"});
    $stmt->bindParam(7, $certificado->{"datosform"}[0]->{"fechaexpopro"});
    $stmt->bindParam(8, $certificado->{"datosform"}[0]->{"razonsocialimp"});
    $stmt->bindParam(9, $certificado->{"datosform"}[0]->{"direccionimp"});
    $stmt->bindParam(10, $certificado->{"datosform"}[0]->{"mediotransporte"});
    $stmt->bindParam(11, $certificado->{"datosform"}[0]->{"puertoembarque"});
    $stmt->bindParam(12, $certificado->{"datosform"}[0]->{"observaciones"});
    $stmt->bindParam(13, $id);
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

    $updateCert = $conn->prepare("UPDATE ms_certificados 
                                SET Operacion=?, Estado=? 
                                WHERE id=?");
    $updateCert->bindParam(1, $operacion);
    $updateCert->bindParam(2, $estado);    
    $updateCert->bindParam(3, $id);
    $respuesta2 = $updateCert->execute();
    
        //* Sentencia preparada para INSERTAR DESCRIPCION DE LAS MERCANCIAS
        $insdescmerca = $conn->prepare("INSERT INTO ms_descripcionmercancias 
                                                    (ID_certificadosMS, NoOrden, Naladisa, DescMercancia, PesoCantidad, ValorFob, Normas) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
        //* Sentencia preparada para ACTUALIZAR DESCRIPCION DE LAS MERCANCIAS
        $updateDescmerca = $conn->prepare("UPDATE ms_descripcionmercancias 
                                           SET NoOrden=?, Naladisa=?, DescMercancia=?, PesoCantidad=?, ValorFob=?, Normas=?
                                           WHERE id=?");
    $it = 1;
    foreach($descmerca->{"tabladesc"} as $item){                
            if($item->{"idDescmercancia"}>0){// SI idDescmercancia >0 ACTUALIZA REGISTRO EN TABLA DESCIPCION MERCANCIAS
                    $updateDescmerca->bindParam(1, $it);
                    $updateDescmerca->bindParam(2, $item->{"naladisa"});
                    $updateDescmerca->bindParam(3, $item->{"descripcion"});
                    $updateDescmerca->bindParam(4, $item->{"pesocantidad"});
                    $updateDescmerca->bindParam(5, $item->{"valorfob"});
                    $updateDescmerca->bindParam(6, $item->{"normas"});
                    $updateDescmerca->bindParam(7, $item->{"idDescmercancia"});
                    $respuesta3 = $updateDescmerca->execute();
                }else {
                    $insdescmerca->bindParam(1, $id);
                    $insdescmerca->bindParam(2, $it);
                    $insdescmerca->bindParam(3, $item->{"naladisa"});
                    $insdescmerca->bindParam(4, $item->{"descripcion"});
                    $insdescmerca->bindParam(5, $item->{"pesocantidad"});
                    $insdescmerca->bindParam(6, $item->{"valorfob"});
                    $insdescmerca->bindParam(7, $item->{"normas"});        
                    $respuesta4 = $insdescmerca->execute();
                }
    $it++;    
    }
    
    return $respuesta1;
}

function eliminaRegistro($conn, $idborrar){
    $borrardescmerca = $conn->prepare("delete FROM ms_descripcionmercancias where id=?");
        foreach ($idborrar as $numId) {
            $borrardescmerca->execute([$numId]);
        }
}

?>