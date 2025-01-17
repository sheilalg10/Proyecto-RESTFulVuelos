<?php

/**
 * Clase PassengerService
 * Esta clase proporciona métodos para interactuar con el servicio de pasajeros.
 */
class PassengerService{
    
    /**
     * Método para obtener todos los pasajeros
     * 
     * Este método realiza una solicitud HTTP GET al servicio de pasajeros 
     * para obtener todos los registros de pasajeros.
     * 
     * @return string|array     Si la solicitud tiene éxito, devuelve los datos de los pasajeros en formato JSON.
     *                          De lo contrario, devuelve un mensaje de error.
     */
    
    public function getAllPassengers() {
        // URL del servicio de pasajeros
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Passenger.php";
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
            // Si la solicitud tiene éxito, devolver los datos de los pasajeros
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
            $message = "Página en mantenimiento";
            return $message;
        }
    }
}