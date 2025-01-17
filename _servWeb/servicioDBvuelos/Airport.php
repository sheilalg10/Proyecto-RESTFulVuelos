<?php

// Se requiere el archivo que contiene la clase AirportModel
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/models/Airport/AirportModel.php';

// Se instancia un objeto de la clase AirportModel
$airport = new AirportModel();

// Se establece la cabecera para indicar que el contenido de la respuesta será JSON
@header("Content-type: application/json");

// Se verifica que el método de solicitud HTTP sea GET
if($_SERVER['REQUEST_METHOD'] == "GET"){
    
    // Si se proporciona el parámetro 'codaeropuerto' en la URL, se obtiene la información de un aeropuerto específico
    if(isset($_GET['codaeropuerto'])){
        // Se llama al método getOneAirport de AirportModel para obtener la información del aeropuerto con el código especificado
        $result = $airport->getOneAirport($_GET['codaeropuerto']);
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    }else{
        // Si no se proporciona el parámetro 'codaeropuerto', se obtienen todos los aeropuertos
        $result = $airport->getAirports();
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    }
}

// Si no se cumple ninguna de las condiciones anteriores, se envía un encabezado HTTP de "Bad Request" (400)
header("HTTP/1.1 400 Bad Request");