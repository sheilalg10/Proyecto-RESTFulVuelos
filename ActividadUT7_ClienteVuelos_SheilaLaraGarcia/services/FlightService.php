<?php

/**
 * Clase FlightService
 * Esta clase proporciona métodos para interactuar con el servicio de vuelos.
 */

class FlightService{
    
    /**
     * Método para obtener todos los vuelos.
     * 
     * Realiza una solicitud HTTP GET al servicio de vuelos para obtener todos los registros de vuelos.
     * 
     * @return string|array     Si la solicitud tiene éxito, devuelve los datos de los vuelos en formato JSON.
     *                          De lo contrario, devuelve un mensaje de error.
     */
    
    public function getAllFlights() {
        // URL del servicio de vuelos
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Flight.php";
        // Iniciar una nueva sesión CURL
        $connection = curl_init();
        
        //Url de la petición
        curl_setopt($connection, CURLOPT_URL, $urlservice);
        //Tipo de petición
        curl_setopt($connection, CURLOPT_HTTPGET, true);
        //Tipo de contenido de la respuesta
        curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        //para recibir una respuesta
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        // Ejecutar la solicitud CURL y almacenar la respuesta
        $res = curl_exec($connection);
        
        // Verificar si la solicitud fue exitosa
        if($res){
            // Si la solicitud tiene éxito, devolver los datos de los vuelos
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
            $message = "Página en mantenimiento";
            return $message;
        }
    }
    
    /**
     * Método para obtener un vuelo específico.
     * 
     * Realiza una solicitud HTTP GET al servicio de vuelos para obtener un vuelo específico por su identificador.
     * 
     * @param string $identificador     Identificador del vuelo.
     * @return string|array             Si la solicitud tiene éxito, devuelve los datos del pasaje en formato JSON.
     *                                  De lo contrario, devuelve null.
     */
    
    public function getOneFlight($identificador) {
        // URL del servicio de vuelos para obtener un vuelo específico
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Flight.php?identificador=".$identificador;
        // Iniciar una nueva sesión CURL
        $connection = curl_init();
        
        //Url de la petición
        curl_setopt($connection, CURLOPT_URL, $urlservice);
        //Tipo de petición
        curl_setopt($connection, CURLOPT_HTTPGET, true);
        //Tipo de contenido de la respuesta
        curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        //para recibir una respuesta
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        // Ejecutar la solicitud CURL y almacenar la respuesta
        $res = curl_exec($connection);
        
        // Verificar si la solicitud fue exitosa
        if($res){
            // Si la solicitud tiene éxito, devolver los datos del vuelo
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
        }
    }
}
