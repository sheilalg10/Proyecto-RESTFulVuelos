<?php

// Se requiere el archivo que contiene la clase FlightModel
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/models/Flight/FlightModel.php';

// Se instancia un objeto de la clase FlightModel
$flight = new FlightModel();

// Se establece la cabecera para indicar que el contenido de la respuesta será JSON
@header("Content-type: application/json");

// Se verifica que el método de solicitud HTTP sea GET
if($_SERVER['REQUEST_METHOD'] == "GET"){
    // Si se proporciona el parámetro 'identificador' en la URL, se obtiene la información de un vuelo específico
    if(isset($_GET['identificador'])){
        // Se llama al método getOneFlight de FlightModel para obtener la información del vuelo con el identificador especificado
        $result = $flight->getOneFlight($_GET['identificador']);
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    }else{
        // Si no se proporciona el parámetro 'identificador', se obtienen todos los vuelos
        $result = $flight->getFlights();
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    }
}

// Si no se cumple ninguna de las condiciones anteriores, se envía un encabezado HTTP de "Bad Request" (400)
header("HTTP/1.1 400 Bad Request");