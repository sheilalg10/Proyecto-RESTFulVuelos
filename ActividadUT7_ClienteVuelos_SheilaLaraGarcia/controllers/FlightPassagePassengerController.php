<?php

/**
 * Clase FlightPassagePassengerController
 * 
 * Esta clase controla las acciones relacionadas con los vuelos, pasajes y pasajeros, como mostrar información,
 * mostrar formularios de inserción y actualización de pasajes, e insertar nuevos pasajes.
 */

class FlightPassagePassengerController{
    private $serviceflight;     // Objeto de la clase FlightService para interactuar con el servicio de vuelos
    private $servicepassage;    // Objeto de la clase PassageService para interactuar con el servicio de pasajes
    private $servicepassenger;  // Objeto de la clase PassengerService para interactuar con el servicio de pasajeros
    private $view;              // Objeto de la clase FlightPassagePassengerView para mostrar la información relacionada

    /**
     * Constructor de la clase FlightPassagePassengerController.
     * 
     * Se inicializan los objetos de los servicios y vistas necesarios para realizar las operaciones relacionadas
     * con vuelos, pasajes y pasajeros.
     */
    
    public function __construct() {
        $this->serviceflight = new FlightService();         // Inicializar el objeto FlightService
        $this->servicepassage = new PassageService();       // Inicializar el objeto PassageService
        $this->servicepassenger = new PassengerService();   // Inicializar el objeto PassengerService
        $this->view = new FlightPassagePassengerView();     // Inicializar el objeto FlightPassagePassengerView
    }
    
    /**
     * Método para mostrar información de vuelo o pasajes.
     * 
     * Si se presiona el botón de vuelo, se muestra la información del vuelo seleccionado.
     * Si se presiona el botón de pasaje, se muestran los pasajes relacionados con el vuelo seleccionado.
     */
    
    public function showInfo() {
        if(isset($_POST['btn_flight'])){
            $flight = $this->serviceflight->getOneFlight($_POST['identificador']);  // Obtener información del vuelo
            $this->view->showInfoFlight($flight);   // Mostrar información del vuelo utilizando la vista correspondiente
        }else if(isset ($_POST['btn_passage'])){
            $passage = $this->servicepassage->getPassagesFlight($_POST['identificador']);   // Obtener pasajes del vuelo
            $this->view->showInfoPassagesFlight($passage);      // Mostrar pasajes relacionados con el vuelo utilizando la vista correspondiente
        }
    }
    
    /**
     * Método para mostrar el formulario de inserción de pasajes.
     * 
     * Se muestran los formularios necesarios para insertar un nuevo pasaje, junto con la información de vuelos
     * y pasajeros disponibles.
     */
    
    public function showFormInsertPassage() {
        $message = "";  // Variable para almacenar mensajes de error o éxito
        
        // Obtener pasajeros disponibles del servicio y decodificar la respuesta
        $passengers = $this->servicepassenger->getAllPassengers();
        $passengers = json_decode($passengers, true);
        
        // Obtener vuelos disponibles del servicio y decodificar la respuesta
        $flights = $this->serviceflight->getAllFlights();
        $flights = json_decode($flights, true);
        
        // Mostrar el formulario de inserción de pasajes utilizando la vista correspondiente
        $this->view->formInsertPassage($message, $flights, $passengers);
    }
    
    /**
     * Método para mostrar el formulario de actualización de pasajes.
     * 
     * Se muestra el formulario necesario para actualizar un pasaje existente, junto con la información de vuelos
     * y pasajeros disponibles.
     */
    
    public function showFormUpdatePassage() {
        $message = "";      // Variable para almacenar mensajes de error o éxito                
        
        // Obtener información del pasaje a actualizar del servicio y decodificar la respuesta
        $passage = $this->servicepassage->getOnePassage($_POST['idpassage']);
        $passage = json_decode($passage, true);
        
        // Obtener pasajeros disponibles del servicio y decodificar la respuesta
        $passengers = $this->servicepassenger->getAllPassengers();
        $passengers = json_decode($passengers, true);
        
        // Obtener vuelos disponibles del servicio y decodificar la respuesta
        $flights = $this->serviceflight->getAllFlights();
        $flights = json_decode($flights, true);
        
        // Mostrar el formulario de actualización de pasajes utilizando la vista correspondiente
        $this->view->formUpdatePassage($passengers, $flights, $message,$passage);
    }
    
    /**
     * Método para insertar un nuevo pasaje.
     * 
     * Se inserta un nuevo pasaje utilizando la información proporcionada en el formulario de inserción,
     * y luego se muestra el formulario de inserción actualizado con el resultado de la operación.
     */
    
    public function insertPassage() {
        // Obtener los datos del formulario de inserción de pasajes
        $pasajerocod = $_POST['pasajerocod'];
        $identificador = $_POST['identificador'];
        $numasiento = $_POST['numasiento'];
        $clase = $_POST['clase'];
        $pvp = $_POST['pvp'];
        
        // Insertar el nuevo pasaje utilizando el servicio y obtener el resultado de la operación
        $result = $this->servicepassage->insertPassage($pasajerocod, $identificador, $numasiento, $clase, $pvp);
        
        // Obtener vuelos disponibles del servicio y decodificar la respuesta
        $flights = $this->serviceflight->getAllFlights();
        $flights = json_decode($flights, true);
        
        // Obtener pasajeros disponibles del servicio y decodificar la respuesta
        $passengers = $this->servicepassenger->getAllPassengers();
        $passengers = json_decode($passengers, true);
        
        // Mostrar el formulario de inserción de pasajes actualizado con el resultado de la operación
        $this->view->formInsertPassage($result, $flights, $passengers);
    }        
}

