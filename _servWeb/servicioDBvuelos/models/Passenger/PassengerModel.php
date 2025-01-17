<?php

// Se incluye la clase Basedatos para utilizar su funcionalidad de conexión a la BD.
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/db/Basedatos.php';

/**
 * Definición de la clase PassengerModel, que extiende de la clase Basedatos 
 * para heredar sus métodos de conexión a la base de datos.
 * 
 */

class PassengerModel extends Basedatos{
    
    private $connection;    // Propiedad privada para almacenar la conexión a la BD.
    
    /**
     * Constructor de la clase
     */
    
    public function __construct() {
        // Se obtiene la conexión a la BD utilizando el método getConnection() heredado de la clase Basedatos
        $this->connection = $this->getConnection();
    }
    
    /**
     * Método para obtiener los datos de todos los pasajeros.
     * 
     * Esta función realiza una consulta SQL para recuperar los datos
     * de todos los pasajeros de la BD.
     * 
     * @return array    Retorna un array asociativo con la informacion de todos los pasajeros.
     */
    
    public function getPassengers() {
        try{
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT * FROM pasajero;");
            $stmt->execute();
            // Se obtienen los resultados de la consulta y se devuelven
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR " . $ex->getMessage();
        }
    }
    
    /**
     * Método para obtener un pasajero específico por su código.
     * 
     * Esta función realiza una consulta SQL para recuperar los datos
     * de un pasajero específico de la BD.
     * 
     * @param type $pasajerocod Código del pasajero que se desea obtener.
     * @return string           Devuelve un arreglo asociativo con los datos del pasajero si se encuentra,
     *                          de lo contrario, devuelve un mensaje indicando que no existe el código 
     *                          del aeropuerto o un mensaje de error si ocurre algún problema con la consulta.
     */
    
    public function getOnePassenger($pasajerocod) {
        try{
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT * FROM pasajero WHERE pasajerocod = ?;");
            $stmt->bindParam(1,$pasajerocod);
            $stmt->execute();
            // Se obtiene el resultado de la consulta
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Si se encuentra el aeropuerto, se devuelve
            if($result){
                return $result;
            }else{
                // Si no se encuentra, se devuelve un mensaje indicando que no existe el código del aeropuerto
                return "NO EXISTE EL CODIGO DEL PASAJERO";
            }
            
        } catch (PDOException $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR ". $ex->getMessage();
        }
    }
}
