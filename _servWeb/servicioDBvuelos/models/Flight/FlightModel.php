<?php

// Se incluye la clase Basedatos para utilizar su funcionalidad de conexión a la BD.
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/db/Basedatos.php';

/**
 * Definición de la clase FlightModel, que extiende de la clase Basedatos 
 * para heredar sus métodos de conexión a la base de datos.
 * 
 */

class FlightModel extends Basedatos{
    
    private $connection;    // Propiedad privada para almacenar la conexión a la BD.
    
    /**
     * Constructor de la clase
     */
    
    public function __construct() {
        // Se obtiene la conexión a la BD utilizando el método getConnection() heredado de la clase Basedatos
        $this->connection = $this->getConnection();
    }
    
    /**
     * Método para obtiener todos los vuelos disponibles junto con información adicional.
     * 
     * Esta función realiza una consulta SQL para recuperar información sobre 
     * todos los vuelos, incluyendo el aeropuerto de origen y destino, el tipo de vuelo y 
     * el número de pasajeros asociados a cada vuelo.
     * Agrupa los resultados por el identificador del vuelo.
     * 
     * @return mixed    Retorna un arreglo asociativo con la información de los vuelos si se ejecuta correctamente
     *                  de lo contrario, devuelve un mensaje de error.
     */
    
    public function getFlights() {
        try{
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT V.identificador AS Identificador, V.aeropuertoorigen AS Aeropuerto_Origen, AO.nombre AS Nombre_Aeropuerto_Origen, AO.pais AS Pais_Aeropuerto_Origen, V.aeropuertodestino AS Aeropuerto_Destino, AD.nombre AS Nombre_Aeropuerto_Destino, AD.pais AS Pais_Aeropuerto_Destino, 
                                                V.tipovuelo AS Tipo, COUNT(P.pasajerocod) AS Num_Pasajeros 
                                                FROM vuelo V JOIN aeropuerto AO 
                                                ON (V.aeropuertoorigen = AO.codaeropuerto) JOIN aeropuerto AD 
                                                ON (V.aeropuertodestino = AD.codaeropuerto) LEFT JOIN pasaje P 
                                                ON (V.identificador = P.identificador) 
                                                GROUP BY V.identificador;");
            $stmt->execute();
            // Se obtienen los resultados de la consulta y se devuelven
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR " .$ex->getMessage();
        }
    }
    
    /**
     * Método para obtiener información detallada sobre un vuelo específico identificado por su identificador.
     * 
     * Esta función realiza una consulta SQL para recuperar información sobre 
     * todos los vuelos, incluyendo el aeropuerto de origen y destino, el tipo de vuelo y 
     * el número de pasajeros asociados a cada vuelo.
     * Agrupa los resultados por el identificador del vuelo.
     * 
     * @param type $identificador   Identificador del vuelo que se desea obtener.
     * @return mixed                Retorna un arreglo asociativo con la información del vuelo si se encuentra,
     *                              de lo contrario, devuelve un mensaje indicando que no existe el vuelo 
     *                              o un mensaje de error si ocurre algún problema.
     */
    
    public function getOneFlight($identificador) {
        try{
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT V.identificador AS Identificador, V.aeropuertoorigen AS Aeropuerto_Origen, AO.nombre AS Nombre_Aeropuerto_Origen, AO.pais AS Pais_Aeropuerto_Origen, V.aeropuertodestino AS Aeropuerto_Destino, AD.nombre AS Nombre_Aeropuerto_Destino, AD.pais AS Pais_Aeropuerto_Destino, 
                                                V.tipovuelo AS Tipo, COUNT(P.pasajerocod) AS Num_Pasajeros 
                                                FROM vuelo V join aeropuerto AO 
                                                ON (V.aeropuertoorigen = AO.codaeropuerto) join aeropuerto AD 
                                                ON (V.aeropuertodestino = AD.codaeropuerto) join pasaje P 
                                                ON (V.identificador = P.identificador) 
                                                WHERE V.identificador = ?;");
            $stmt->bindParam(1,$identificador);
            $stmt->execute();
            // Se obtiene el resultado de la consulta
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR" . $ex->getMessage();
        }
    }

}