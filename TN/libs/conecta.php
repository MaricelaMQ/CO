<?php
    $servidor ="localhost";
    $usuario = "root";
    $pass ="";//ZmogHwyA4d6FdMrK
    $bd =  "certorigen";
    try {
        // Conectar
        $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $pass);
        // Establecer el nivel de errores a EXCEPTION
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error: " . $e->getMessage();
        }   
?>