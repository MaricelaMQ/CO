<?php
include "conecta.php";
$respuesta= false;
$certificado = json_decode( $_POST["guardar"]);  // decodificar cadena JSON en cadena de objetos (array)
$descmerca = json_decode( $_POST["items"]);  // decodificar cadena JSON en cadena de objetos (array)
// var_dump($descmerca);
// var_dump($descmerca->{"tabladesc"}[1]->{"descripcion"});
// var_dump($certificado->{"data"}[0]->{"nombreexp"});
//echo ($descmerca->{"data"}[1]->{"descripcion"});
//console.log($descmerca);
$operacion = $certificado->{"data"}[0]->{"operacion"};
$stmt = $conn->prepare("INSERT INTO detallecertificado (NombreExp, DireccionExp, TelefonoExp, FaxExp, CorreoExp, NumRegFiscalExp, LugarExp, FechaExp, NombrePro, DireccionPro, TelefonoPro, FaxPro, CorreoPro, NumRegFiscalPro, NombreImp, DireccionImp, TelefonoImp, FaxImp, CorreoImp, NumRegFiscalImp,Observaciones, DireccionAutoCompe, TelefonoAutoCompe, FaxAutoCompe, CorreoAutoCompe, LugarautoCompe, FechaAutoCompe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
$stmt->bindParam(26, $certificado->{"data"}[0]->{"lugarautocompe"});
$stmt->bindParam(27, $certificado->{"data"}[0]->{"fechaautocompe"});
$respuesta = $stmt->execute();

$insCert = $conn->prepare("INSERT INTO certificados (Operacion, Regional, fecha) VALUES (?, ?, ?)");
$fecha = date("Y-m-d");
//$num = str_pad($n, 4, '0', STR_PAD_LEFT);

$regional = "CR";
$insCert->bindParam(1, $operacion);
$insCert->bindParam(2, $regional);
$insCert->bindParam(3, $fecha);
$result = $insCert->execute();
/**CONSULTA ULTIMO ID CERTIFICADO*/
$resp = $conn->query("select max(id)  from  certificados")->fetchColumn();
/****** INSERT DESCRIPCION MERCANCIAS* */
$insdescmerca = $conn->prepare("INSERT INTO descripcionmercancias (id_certificados, item, descmercancia, clasiarancelaria, nofactura, valorfactura, criterorigen) VALUES (?, ?, ?, ?, ?, ?, ?)");

$i = 1;
foreach($descmerca->{"tabladesc"} as $item){
        $insdescmerca->bindParam(1, $resp);
        $insdescmerca->bindParam(2, $i);
        $insdescmerca->bindParam(3, $item->{"descripcion"});
        $insdescmerca->bindParam(4, $item->{"clasiarancelaria"});
        $insdescmerca->bindParam(5, $item->{"nofactura"});
        $insdescmerca->bindParam(6, $item->{"valorfactura"});
        $insdescmerca->bindParam(7, $item->{"criterorigen"});
        $respuesta3 = $insdescmerca->execute();
    $i++;
}

echo $respuesta;
?>