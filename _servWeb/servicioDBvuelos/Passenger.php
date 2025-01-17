<?php

// Se requiere el archivo que contiene la clase PassengerModel
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/models/Passenger/PassengerModel.php';

// Se instancia un objeto de la clase PassengerModel
$passanger = new PassengeModel();

// Se establece la cabecera para indicar que el contenido de la respuesta será JSON
@header("Content-type: application/json");

// Se verifica que el método de solicitud HTTP sea GET
if($_SERVER['REQUEST_METHOD'] == "GET"){
    // Si se proporciona el parámetro 'pasajerocod' en la URL, se obtiene la información de un pasajero específico
    if(isset($_GET['pasajerocod'])){
        // Se llama al método getOnePassenger de PassengerModel para obtener la información del pasajero con el código especificado
        $result = $passanger->getOnePassenger($_GET['pasajerocod']);
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    }else{
        // Si no se proporciona el parámetro 'pasajerocod', se obtienen todos los pasajeros
        $result = $passanger->getPassengers();
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    }
}

// Si no se cumple ninguna de las condiciones anteriores, se envía un encabezado HTTP de "Bad Request" (400)
header("HTTP/1.1 400 Bad Request");