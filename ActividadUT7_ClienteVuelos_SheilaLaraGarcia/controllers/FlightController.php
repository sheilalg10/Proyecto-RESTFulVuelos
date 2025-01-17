<?php

/**
 * Clase FlightController
 * 
 * Esta clase controla las acciones relacionadas con los vuelos, como obtener todos los vuelos disponibles.
 */

class FlightController{
    
    private $service;   // Objeto de la clase FlightService para interactuar con el servicio de vuelos
    private $view;      // Objeto de la clase FlightView para mostrar la información relacionada con vuelos

    /**
     * Constructor de la clase FlightController.
     * 
     * Se inicializan los objetos de los servicios y vistas necesarios para realizar las operaciones relacionadas
     * con los vuelos.
     */
    
    public function __construct() {
        $this->service = new FlightService();   // Inicializar el objeto FlightService
        $this->view = new FlightView();         // Inicializar el objeto FlightView
    }
    
    /**
     * Método para obtener todos los vuelos disponibles.
     * 
     * Se obtienen todos los vuelos del servicio y se muestran utilizando la vista correspondiente.
     */
    
    public function getAllFlights() {
         $flights = $this->service->getAllFlights();    // Obtener todos los vuelos del servicio
         $this->view->showAllFlights($flights);         // Mostrar todos los vuelos utilizando la vista correspondiente
    }
}
