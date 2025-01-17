<?php

// Se incluye la clase Basedatos para utilizar su funcionalidad de conexión a la BD.
require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/db/Basedatos.php';

/**
 * Definición de la clase PassageModel, que extiende de la clase Basedatos 
 * para heredar sus métodos de conexión a la base de datos.
 * 
 */

class PassageModel extends Basedatos {

    private $connection;    // Propiedad privada para almacenar la conexión a la BD.

    /**
     * Constructor de la clase
     */
    
    public function __construct() {
        // Se obtiene la conexión a la BD utilizando el método getConnection() heredado de la clase Basedatos
        $this->connection = $this->getConnection();
    }

    /**
     * Método para obtener todos los pasajes disponibles junto con información adicional.
     * 
     * Esta función realiza una consulta SQL para recuperar la inforamción sobre todos los 
     * pasajes, incluyendo el nombre del pasajero asociados al pasaje.
     * Ordena los resultados por el idpasaje.
     * 
     * @return mixed    Retorna un arreglo asociativo con la información de los pasajes si se ejecuta correctamente
     *                  de lo contrario, devuelve un mensaje de error.
     */
    
    public function getPassages() {
        try {
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT P.idpasaje AS Pasaje, PA.nombre AS Nombre_Pasajero, P.identificador AS Identificador, P.numasiento AS Num_Asiento,
                                                P.clase AS Clase, P.pvp AS Precio
                                                FROM pasaje P JOIN pasajero PA
                                                ON (P.pasajerocod = PA.pasajerocod)
                                                ORDER BY Pasaje;");
            $stmt->execute();
            // Se obtienen los resultados de la consulta y se devuelven
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR" . $ex->getMessage();
        }
    }
    
    /**
     * Método para obtener información detallada sobre un pasaje específico identificado por su ID.
     * 
     * Realiza una consulta SQL para recuperar información detallada sobre un pasaje específico, 
     * incluyendo el código del pasajero, el identificador del vuelo, el número de asiento, la clase y el precio.
     * Los resultados se filtran por el ID del pasaje.
     * 
     * @param type $idpasaje    ID del pasaje que se desea obtener.
     * @return mixed            Devuelve un arreglo asociativo con la información del pasaje si se encuentra,
     *                          de lo contrario, devuelve un mensaje indicando que no existe el pasaje 
     *                          o un mensaje de error si ocurre algún problema.
     */

    public function getOnePassage($idpasaje) {
        try {
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT P.idpasaje AS Pasaje, P.pasajerocod AS Cod_Pasajero, PA.nombre AS Nombre_Pasajero, P.identificador AS Identificador, P.numasiento AS Num_Asiento,
                                                P.clase AS Clase, P.pvp AS Precio
                                                FROM pasaje P JOIN pasajero PA
                                                ON (P.pasajerocod = PA.pasajerocod) 
                                                WHERE P.idpasaje = ?;");
            $stmt->bindParam(1, $idpasaje);
            $stmt->execute();
            // Se obtienen los resultados de la consulta y se devuelven
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR" . $ex->getMessage();
        }
    }

    /**
     * Método para obtener información de todos los pasajes asociados a un 
     * vuelo específico identificado por su identificador.
     * 
     * Realiza una consulta SQL para recuperar información detallada sobre un pasaje específico, 
     * incluyendo el código del pasajero, el identificador del vuelo, el número de asiento, la clase y el precio.
     * Los resultados se filtran por el ID del pasaje.
     * 
     * @param type $identificador   Identificador del vuelo del cual se desean obtener los pasajes.
     * @return mixed                Devuelve un arreglo asociativo con la información del pasaje si se encuentra,
     *                              de lo contrario, devuelve un mensaje indicando que no existe el pasaje 
     *                              o un mensaje de error si ocurre algún problema.
     */
    
    public function getPassageOneFlight($identificador) {
        try {
            // Prepara y ejecuta la consulta SQL
            $stmt = $this->connection->prepare("SELECT P.idpasaje AS Pasaje, P.pasajerocod AS Codigo_Pasajero, PA.nombre AS Nombre_Pasajero, PA.pais AS Pais_Pasajero, P.numasiento AS Num_Asiento_Pasajero,
                                                P.clase AS Clase, P.pvp AS Precio
                                                FROM pasaje P JOIN pasajero PA
                                                ON (P.pasajerocod = PA.pasajerocod)
                                                WHERE P.identificador = ?;");
            $stmt->bindParam(1, $identificador);
            $stmt->execute();
            // Se obtienen los resultados de la consulta y se devuelven
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $ex) {
            // En caso de error, se devuelve un mensaje indicando el problema
            return "ERROR AL CARGAR" . $ex->getMessage();
        }
    }

    /**
     * Método que comprueba si un pasajero ya está asociado a un vuelo específico.
     * 
     * Realiza una consulta SQL para verificar si un pasajero específico ya está asociado a 
     * un vuelo específico identificado por su identificador.
     * 
     * @param type $pasajerocod     Código del pasajero
     * @param type $identificador   Identificador del vuelo
     * @return bool                 Devuelve true si el pasajero no está asociado al vuelo, de lo contrario, devuelve false.
     */
    
    public function checkPassengerAndFlight($pasajerocod, $identificador) {
        try {
            $sql = "SELECT COUNT(*) 
                    FROM pasaje
                    WHERE pasajerocod = ? AND identificador = ?;" ;
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1,$pasajerocod);
            $stmt->bindParam(2,$identificador);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($result['COUNT(*)'] > 0){
                return false;
            }else{
                return true;
            }
        } catch (PDOException $ex) {
            return "ERROR AL CARGAR" .$ex->getMessage();
        }
    }
    
    /**
     * Método que comprueba si un asiento específico está disponible en un vuelo.
     * 
     * Realiza una consulta SQL para verificar si un asiento específico está disponible en un vuelo identificado por su identificador.
     * 
     * @param type $numasiento      Número del asiento.
     * @param type $identificador   Identificador del vuelo.
     * @return bool                 Devuelve true si el asiento está disponible en el vuelo, de lo contrario, devuelve false.
     */
    
    public function checkSeatAndFlight($numasiento, $identificador) {
        try{
            $sql = "SELECT COUNT(*) 
                    FROM pasaje
                    WHERE numasiento = ? AND identificador = ?;";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1,$numasiento);
            $stmt->bindParam(2,$identificador);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($result['COUNT(*)'] > 0){
                return false;
            }else{
                return true;
            }
        } catch (PDOException $ex) {
            return "ERROR AL CARGAR" .$ex->getMessage();
        }
    }
    
    /**
     * Método que inserta un nuevo pasaje en la BD.
     * 
     * Inserta un nuevo pasaje en la base de datos si el pasajero y el asiento están disponibles en el vuelo.
     * 
     * @param type $req Arreglo asociativo que contiene los datos del pasaje a insertar.
     * @return string   Devuelve un mensaje indicando si el pasaje se ha insertado correctamente o si ha ocurrido algún error.
     */
    
    public function insertPassage($req) {
        try{
            $checkPassengeFlight = $this->checkPassengerAndFlight($req['pasajerocod'], $req['identificador']);
            $checkSeatFlight = $this->checkSeatAndFlight($req['numasiento'], $req['identificador']);
            
            if($checkPassengeFlight == true && $checkSeatFlight == true){
                $sql = "INSERT INTO pasaje (pasajerocod, identificador, numasiento, clase, pvp) 
                        VALUES (?,?,?,?,?);";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(1, $req['pasajerocod']);
                $stmt->bindParam(2, $req['identificador']);
                $stmt->bindParam(3, $req['numasiento']);
                $stmt->bindParam(4, $req['clase']);
                $stmt->bindParam(5, $req['pvp']);               
                $insert = $stmt->execute();
                return "Nuevo pasaje insertado.";
            }
            
            $message = "";
            
            if($checkPassengeFlight == false){
                $message = "Error al insertar. El pasajero " . $req['pasajerocod'] ." ya esta en el vuelo ". $req['identificador'];
                return $message;
            }
            
            if($checkSeatFlight == false){
                $message = "Error al insertar. El asiento " . $req['numasiento'] ." ya esta reservado en el vuelo ". $req['identificador'];
                return $message;
            }
            
        } catch (PDOException $ex) {
            return "ERROR AL INSERTAR" .$ex->getMessage();
        }
    }
    
    /**
     * Método que actualiza un pasaje existente en la base de datos.
     * 
     * Actualiza un pasaje existente en la base de datos si el asiento está disponible en el vuelo.
     * 
     * @param type $req Arreglo asociativo que contiene los datos del pasaje a actualizar.
     * @return string   Devuelve un mensaje indicando si el pasaje se ha actualizado correctamente o si ha ocurrido algún error.
     */
    
    public function updatePassage($req) {
        try{
            //$checkPassengeFlight = $this->checkPassengerAndFlight($req['pasajerocod'], $req['identificador']);
            $checkSeatFlight = $this->checkSeatAndFlight($req['numasiento'], $req['identificador']);
            
            if($checkSeatFlight == true){
                $sql = "UPDATE pasaje SET pasajerocod = ?,identificador = ?,numasiento = ?,clase = ?,pvp = ?
                        WHERE idpasaje = ?;";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindParam(1, $req['pasajerocod']);
                $stmt->bindParam(2, $req['identificador']);
                $stmt->bindParam(3, $req['numasiento']);
                $stmt->bindParam(4, $req['clase']);
                $stmt->bindParam(5, $req['pvp']);
                $stmt->bindParam(6, $_GET['idpasaje']); 
                $update = $stmt->execute();                                
                return "Pasaje ". $_GET['idpasaje'] ." modificado.";  
            }
            
            $message = "";
            
            /**if($checkPassengeFlight == false){
                $message = "Error al modificar. El pasajero " . $req['pasajerocod'] ." ya esta en el vuelo ". $req['identificador'];
                return $message;
            }*/
            
            if($checkSeatFlight == false){
                $message = "Error al actualizar. El asiento " . $req['numasiento'] ." ya esta reservado en el vuelo ". $req['identificador'];
                return $message;
            }
            
        } catch (PDOException $ex) {
            return "Error al actualizar". $ex->getMessage();
        }
    }
    
    /**
     * Método que elimina un pasaje de la BD.
     * 
     * Elimina un pasaje de la base de datos identificado por su ID.
     * 
     * @param type $idpasaje    ID del pasaje que se desea eliminar.
     * @return string           Devuelve un mensaje indicando si el pasaje se ha eliminado correctamente o si ha ocurrido algún error.
     */
    
    public function deletePassage($idpasaje) {
        try{
            $stmt = $this->connection->prepare("DELETE FROM pasaje WHERE idpasaje = ?;");
            $stmt->bindParam(1,$idpasaje);
            $stmt->execute();
            
            $message = "";
            if($stmt->rowCount() == 0){
                $message = "Error al borrar el pasaje ". $idpasaje;
                return $message;
            }else{
                $message = "El pasaje  ". $idpasaje ." ha sido eliminado.";
                return $message;
            }
            
        } catch (PDOException $ex) {
            return "Error al eliminar". $ex->getMessage();
        }
    }
    
}
