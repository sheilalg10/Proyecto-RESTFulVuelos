<?php

/**
 * Clase PassageService
 * Esta clase proporciona métodos para interactuar con el servicio de pasajes.
 */

class PassageService{
    
    /**
     * Método para obtener todos los pasajes.
     * 
     * Realiza una solicitud HTTP GET al servicio de pasajes para obtener todos los registros de pasajes.
     * 
     * @return string|array     Si la solicitud tiene éxito, devuelve los datos de los pasajes en formato JSON.
     *                          De lo contrario, devuelve un mensaje de error.
     */
    
    public function getAllPassages() {
        // URL del servicio de pasajes
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Passage.php";
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
            // Si la solicitud tiene éxito, devolver los datos de los pasajes
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
            $message = "Página en mantenimiento";
            return $message;
        }
    }
    
    /**
     * Método para obtener un pasaje específico.
     * 
     * Realiza una solicitud HTTP GET al servicio de pasajes para obtener un pasaje específico por su identificador.
     * 
     * @param int $idpassage    Identificador del pasaje.
     * @return string|array     Si la solicitud tiene éxito, devuelve los datos del pasaje en formato JSON.
     *                          De lo contrario, devuelve null.
     */
    
    public function getOnePassage($idpassage) {
        // URL del servicio de pasajes para obtener un pasaje específico
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Passage.php?idpasaje=".$idpassage;
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
            // Si la solicitud tiene éxito, devolver los datos del pasaje
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
            $message = "Página en mantenimiento";
            return $message;
        }
    }
    
    /**
     * Método para obtener los pasajes de un vuelo específico.
     * 
     * Realiza una solicitud HTTP GET al servicio de pasajes para 
     * obtener los pasajes de un vuelo específico por su identificador.
     * 
     * @param int $identificador    Identificador del vuelo.
     * @return string|array         Si la solicitud tiene éxito, devuelve los datos de los pasajes en formato JSON.
     *                              De lo contrario, devuelve un mensaje de error.
     */
    
    public function getPassagesFlight($identificador) {
        // URL del servicio de pasajes para obtener los pasajes de un vuelo específico
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Passage.php?identificador=".$identificador;
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
            // Si la solicitud tiene éxito, devolver los datos del pasaje
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
            $message = "Página en mantenimiento";
            return $message;
        }
    }
    
    /**
     * Método para insertar un nuevo pasaje
     * 
     * Realiza una solicitud HTTP POST al servicio de pasajes para insertar un nuevo pasaje con los datos proporcionados.
     * 
     * @param int $pasajerocod          Código del pasajero
     * @param string $identificador     Identificador del vuelo
     * @param int $numasiento           Número de asiento.
     * @param string $clase             Clase del pasaje
     * @param int $pvp                  Precio del pasaje
     * @return string|array             Si la solicitud tiene éxito, devuelve los datos del pasaje insertado en formato JSON.
     *                                  De lo contrario, devuelve null.
     */
    
    public function insertPassage($pasajerocod, $identificador, $numasiento, $clase, $pvp) {
        // Datos a enviar para la inserción del pasaje en formato JSON
        $insert = json_encode(array("pasajerocod" => $pasajerocod, "identificador" => $identificador, "numasiento" => $numasiento, "clase" => $clase, "pvp" => $pvp));
        // URL del servicio de pasajes para la inserción de un nuevo pasaje
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Passage.php";
        // Iniciar una nueva sesión CURL
        $connection = curl_init();
        
        //Url de la petición
        curl_setopt($connection, CURLOPT_URL, $urlservice);
        //Cabecera, tipo de datos y longitud de envío
        curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Content-Length: '. mb_strlen($insert)));
        //Tipo de petición
        curl_setopt($connection, CURLOPT_POST, true);
        //Campos que van en el envío
        curl_setopt($connection, CURLOPT_POSTFIELDS, $insert);
        //para recibir una respuesta
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        // Ejecutar la solicitud CURL y almacenar la respuesta
        $res = curl_exec($connection);
        
        // Verificar si la solicitud fue exitosa
        if($res){
            // Si la solicitud tiene éxito, devolver los datos del pasaje insertado
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
        }
    }
    
    /**
     * Método para actualizar un pasaje existente.
     * 
     * Realiza una solicitud HTTP PUT al servicio de pasajes para actualizar un pasaje 
     * existente con los datos proporcionados.
     * 
     * @param int $pasajerocod          Código del pasajero
     * @param string $identificador     Identificador del vuelo
     * @param int $numasiento           Número de asiento.
     * @param string $clase             Clase del pasaje
     * @param int $pvp                  Precio del pasaje
     * @param type $idpassage           Identificador del pasaje a actualizar.
     * @return string|array             Si la solicitud tiene éxito, devuelve los datos del pasaje actualizado en formato JSON.
     *                                  De lo contrario, devuelve null.
     */
    
    public function updatePassage($pasajerocod, $identificador, $numasiento, $clase, $pvp, $idpassage) {
        // Datos a enviar para la actualización del pasaje en formato JSON
        $update = json_encode(array("pasajerocod" => $pasajerocod, "identificador" => $identificador, "numasiento" => $numasiento, "clase" => $clase, "pvp" => $pvp));
        // URL del servicio de pasajes para la actualización de un pasaje existente
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Passage.php?idpasaje=".$idpassage;
        // Iniciar una nueva sesión CURL
        $connection = curl_init();
        
        //Url de la petición
        curl_setopt($connection, CURLOPT_URL, $urlservice);
        //Cabecera, tipo de datos y longitud de envío
        curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-type: application/json', 'Content-Length: '. mb_strlen($update)));
        //Tipo de petición
        curl_setopt($connection, CURLOPT_CUSTOMREQUEST, 'PUT');
        //Campos que van en el envío
        curl_setopt($connection, CURLOPT_POSTFIELDS, $update);
        //para recibir una respuesta
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        // Ejecutar la solicitud CURL y almacenar la respuesta
        $res = curl_exec($connection);
        
        // Verificar si la solicitud fue exitosa
        if($res){
            // Si la solicitud tiene éxito, devolver los datos del pasaje actualizado
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
        }
    }
    
    /**
     * Método para eliminar un pasaje existente.
     * 
     * Realiza una solicitud HTTP DELETE al servicio de pasajes para eliminar un pasaje existente por su identificador.
     * 
     * @param int $idpassage    Identificador del pasaje a eliminar.
     * @return string|array     Si la solicitud tiene éxito, devuelve los datos del pasaje eliminado en formato JSON.
     *                          De lo contrario, devuelve null.
     */
    
    public function deletePassage($idpassage) {
        // URL del servicio de pasajes para eliminar un pasaje existente
        $urlservice = "http://localhost/_servWeb/servicioDBvuelos/Passage.php?idpasaje=".$idpassage;
        // Iniciar una nueva sesión CURL
        $connection = curl_init();
        
        //Url de la petición
        curl_setopt($connection, CURLOPT_URL, $urlservice);
        //Cabecera, tipo de datos y longitud de envío
        curl_setopt($connection, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        //Tipo de petición
        curl_setopt($connection, CURLOPT_CUSTOMREQUEST, 'DELETE');
         //para recibir una respuesta
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        // Ejecutar la solicitud CURL y almacenar la respuesta
        $res = curl_exec($connection);
        
        // Verificar si la solicitud fue exitosa
        if($res){
            // Si la solicitud tiene éxito, devolver los datos del pasaje eliminado
            return $res;
        }else{
            // Si la solicitud falla, cerrar la conexión CURL y devolver un mensaje de error
            curl_close($connection);
        }
    }
}
