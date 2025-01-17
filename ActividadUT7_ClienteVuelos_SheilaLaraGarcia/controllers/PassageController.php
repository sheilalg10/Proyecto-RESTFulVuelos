<?php

/**
 * Clase PassageController
 * 
 * Esta clase controla las acciones relacionadas con los pasajes, como obtener todos los pasajes, eliminar un pasaje
 * y actualizar un pasaje.
 */

class PassageController{
    
    private $service;   // Objeto de la clase PassageService para interactuar con el servicio de pasajes
    private $view;      // Objeto de la clase PassageView para mostrar la información de los pasajes
    
    /**
     * Constructor de la clase PassageController.
     * 
     * Se inicializan los objetos de los servicios y vistas necesarios para realizar las operaciones 
     * relacionadas con los pasajes.
     */
    
    public function __construct() {
        $this->service = new PassageService();  // Inicializar el objeto PassageService
        $this->view = new PassageView();        // Inicializar el objeto PassageView
    }
    
    /**
     * Método para obtener todos los pasajes.
     * 
     * Obtiene todos los pasajes del servicio y muestra la información utilizando la vista correspondiente.
     */
    
    public function getAllPassages() {
        $message = "";                                      // Variable para almacenar mensajes de error o éxito
        $passages = $this->service->getAllPassages();       // Obtener todos los pasajes del servicio
        $this->view->showAllPassages($passages,$message);   // Mostrar los pasajes utilizando la vista correspondiente
    }
    
    /**
     * Método para eliminar un pasaje.
     * 
     * Elimina un pasaje del servicio utilizando su identificador y luego muestra la información actualizada
     * utilizando la vista correspondiente.
     */
    
    public function deletePassage() {
        $idpasaje = $_POST['idpassage'];                        // Obtener el identificador del pasaje a eliminar desde el formulario
        $result = $this->service->deletePassage($idpasaje);     // Eliminar el pasaje utilizando el servicio
        
        // Obtener todos los pasajes actualizados del servicio
        $passages = $this->service->getAllPassages();
        // Mostrar los pasajes actualizados utilizando la vista correspondiente, junto con un mensaje de resultado
        $this->view->showAllPassages($passages, $result);
    }
    
    /**
     * Método para actualizar un pasaje.
     * 
     * Actualiza un pasaje del servicio con la información proporcionada y luego muestra la información actualizada
     * utilizando la vista correspondiente.
     */
    
    public function updatePassage() {
        // Obtener los datos del pasaje a actualizar desde el formulario
        $pasajerocod = $_POST['pasajerocod'];
        $identificador = $_POST['identificador'];
        $numasiento = $_POST['numasiento'];
        $clase = $_POST['clase'];
        $pvp = $_POST['pvp'];
        $idpassage = $_POST['idpasaje'];
        
        // Actualizar el pasaje utilizando el servicio
        $result = $this->service->updatePassage($pasajerocod, $identificador, $numasiento, $clase, $pvp, $idpassage);
        
        // Obtener todos los pasajes actualizados del servicio
        $passages = $this->service->getAllPassages();
        // Mostrar los pasajes actualizados utilizando la vista correspondiente, junto con un mensaje de resultado
        $this->view->showAllPassages($passages, $result);
    }
}
