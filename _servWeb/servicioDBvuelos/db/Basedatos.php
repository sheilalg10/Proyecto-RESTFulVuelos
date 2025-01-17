<?php

/**
 * Definición clase abstracta.
 */

abstract class Basedatos {

    // Propiedades privadas de la clase    
    private $connection;        // Almacena el objeto de conexión PDO a la base de datos   
    private $menssage = "";     // Almacena mensajes de error en caso de que ocurran

    /**
     * Método para establecer la conexión a la base de datos
     * 
     * @return string
     */
    public function getConnection() {

        // Método para establecer la conexión
        require_once $_SERVER['DOCUMENT_ROOT'] . '/_servWeb/servicioDBvuelos/config/config.php';

        try {
            
            // Se intenta establecer la conexión utilizando PDO
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $pwd);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $ex) {
            
            // Si ocurre un error, se captura la excepción y se almacena el mensaje de error en la propiedad $menssage
            $this->menssage = $ex->getMessage();
        }
    }

    /**
     * Método para cerrar la conexión a la base de datos
     */
    
    public function closeConnection() {
        $this->connection = null;
    }

    /**
     * Método para obtener el mensaje de error en caso de que se haya producido algún error durante la conexión
     * 
     * @return string
     */
    
    public function getMenssageError() {
        return $this->menssage;
    }
}
