<?php

// Se requiere el archivo que contiene la clase PassageModel
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/models/Passage/PassageModel.php';

// Se instancia un objeto de la clase PassageModel
$passage = new PassageModel();

// Se establece la cabecera para indicar que el contenido de la respuesta será JSON
@header("Content-type: application/json");

// Se verifica el método de solicitud HTTP
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Si se proporciona el parámetro 'idpasaje' en la URL, se obtiene la información de un pasaje específico
    if (isset($_GET['idpasaje'])) {
        // Se llama al método getOnePassage de PassageModel para obtener la información del pasaje con el ID especificado
        $result = $passage->getOnePassage($_GET['idpasaje']);
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    } // Si se proporciona el parámetro 'identificador' en la URL, se obtienen todos los pasajes asociados a un vuelo específico 
    else if (isset($_GET['identificador'])) {
        // Se llama al método getPassageOneFlight de PassageModel para obtener la información de los pasajes asociados al vuelo con el identificador especificado
        $result = $passage->getPassageOneFlight($_GET['identificador']);
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    } else {
        // Si no se proporcionan los parámetros anteriores, se obtienen todos los pasajes
        $result = $passage->getPassages();
        // Se imprime el resultado en formato JSON
        echo json_encode($result);
        // Se finaliza la ejecución del script
        exit();
    }
}

// Si la solicitud es de tipo POST, se inserta un nuevo pasaje en la BD
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Se decodifica el JSON recibido en el cuerpo de la solicitud y se convierte en un array asociativo
    $req = json_decode(file_get_contents('php://input'), true);
    // Se llama al método insertPassage de PassageModel para insertar el nuevo pasaj
    $result = $passage->insertPassage($req);
    // Se crea un array para almacenar el mensaje de respuesta
    $res['message'] = $result;
    // Se imprime el mensaje de respuesta en formato JSON
    echo json_encode($res);
    // Se finaliza la ejecución del script
    exit();
}

// Si la solicitud es de tipo PUT, se actualiza un pasaje existente en la BD
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Se decodifica el JSON recibido en el cuerpo de la solicitud y se convierte en un array asociativo
    $req = json_decode(file_get_contents('php://input'), true);
    // Se llama al método updatePassage de PassageModel para actualizar el pasaje
    $result = $passage->updatePassage($req);
    // Se crea un array para almacenar el mensaje de respuesta
    $res['message'] = $result;
    // Se imprime el mensaje de respuesta en formato JSON
    echo json_encode($res);
    // Se finaliza la ejecución del script
    exit();
}

// Si la solicitud es de tipo DELETE, se elimina un pasaje existente en la BD
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Se llama al método deletePassage de PassageModel para eliminar el pasaje con el ID especificado
    $result = $passage->deletePassage($_GET['idpasaje']);
    // Se crea un array para almacenar el mensaje de respuesta
    $res['message'] = $result;
    // Se imprime el mensaje de respuesta en formato JSON
    echo json_encode($res);
    // Se finaliza la ejecución del script
    exit();
}

// Si no se cumple ninguna de las condiciones anteriores, se envía un encabezado HTTP de "Bad Request" (400)
header("HTTP/1.1 400 Bad Request");
