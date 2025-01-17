<?php

// Se incluye la clase Basedatos para utilizar su funcionalidad de conexión a la BD.
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/db/Basedatos.php';

/**
 * Definición de la clase AirportModel, que extiende de la clase Basedatos 
 * para heredar sus métodos de conexión a la BD.
 * 
 */

class AirportModel extends Basedatos{
    
    private $connection;    // Propiedad privada para almacenar la conexión a la base de datos
    
    /**
     * Constructor de la clase
     */
    
    public function __construct() {
        // Se obtiene la conexión a la BD utilizando el método getConnection() heredado de la clase Basedatos
        $this->connection = $this->getConnection();
    }
    
    /**
     * Método para obtiener los datos de todos los aeropuertos.
     * 
     * Esta función realiza una consulta SQL para recuperar los datos
     * de todos los aeropuertos de la BD.
     * 
     * @return array    Retorna un array asociativo con la informacion de todos los aeropuertos.
     */
    
    public function getAirports() {
        try{
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT * FROM aeropuerto;");
            $stmt->execute();
            // Se obtienen los resultados de la consulta y se devuelven
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR" . $ex->getMessage();
        }
    }
    
    /**
     * Método para obtener un aeropuerto específico por su código.
     * 
     * Esta función realiza una consulta SQL para recuperar los datos
     * de un aeropuerto específico de la BD.
     * 
     * @param type $codaeropuerto   Código del aeropuerto que se desea obtener.
     * @return string               Devuelve un arreglo asociativo con los datos del aeropuerto si se encuentra,
     *                              de lo contrario, devuelve un mensaje indicando que no existe el código 
     *                              del aeropuerto o un mensaje de error si ocurre algún problema con la consulta.
     */
    
    public function getOneAirport($codaeropuerto) {
        try{
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT * FROM aeropuerto WHERE codaeropuerto = ?;");
            $stmt->bindParam(1,$codaeropuerto);
            $stmt->execute();
            // Se obtiene el resultado de la consulta
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Si se encuentra el aeropuerto, se devuelve
            if($result){
                return $result;
            }else{
                // Si no se encuentra, se devuelve un mensaje indicando que no existe el código del aeropuerto
                return "NO EXISTE EL CODIGO DEL AEROPUERTO";
            }
        } catch (PDOException $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR " .$ex->getMessage();
        }
    }
}

