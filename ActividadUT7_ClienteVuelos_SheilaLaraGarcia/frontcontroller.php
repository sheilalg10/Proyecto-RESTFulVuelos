<?php

// Incluir servicios, vistas y controladores necesarios

include 'services/FlightService.php';
include 'views/FlightView.php';
include 'controllers/FlightController.php';

include 'controllers/FlightPassagePassengerController.php';
include 'views/FlightPassagePassengerView.php';

include 'services/AirportService.php';
include 'views/AirportView.php';
include 'controllers/AirportController.php';

include 'services/PassageService.php';
include 'views/PassageView.php';
include 'controllers/PassageController.php';

include 'services/PassengerService.php';
include 'views/PassengerView.php';
include 'controllers/PassengerController.php';

// Define la accion y el controlador por defecto
define('ACCION_DEFECTO', 'getAllFlights');
define('CONTROLADOR_DEFECTO', 'Flight');

// Función que carga una acción en el controlador dado
function loadAction($controllerObjet){
    // Verifica si la acción está definida y que existe en el controlador
    if(isset($_GET['action']) && method_exists($controllerObjet, $_GET['action'])){                
        // Ejecutar la acción en el controlador
        executeAction($controllerObjet, $_GET['action']);
    }else{
        // Si la acción no esta definida, ejecutar la acción por defecto
        executeAction($controllerObjet, ACCION_DEFECTO);
    }
}

// Función que ejecuta una acción en un controlador
function executeAction($controllerObjet,$action){
    $Action = $action;
    $controllerObjet->$Action();
}

// Función que carga un controlador
function loadController($nameController){
    $controller = $nameController . "Controller";
    
    // Verifica si la clase del controlador existe
    if(class_exists($controller)){
        return new $controller();
    }else{
        // Si la clase no existe, muestra un mensaje de error
        die("El controlador no existe");     
    }
}

// Carga el controlador y ejecuta la acción correspondiente
if(isset($_GET['controller'])){
    $controller = loadController($_GET['controller']);    
    loadAction($controller);
}else{
    $controller = loadController(CONTROLADOR_DEFECTO);
    loadAction($controller);
}