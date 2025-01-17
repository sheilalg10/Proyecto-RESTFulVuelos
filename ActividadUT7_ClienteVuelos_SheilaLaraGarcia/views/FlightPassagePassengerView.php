<?php

/**
 * Clase FlightPassagePassengerView para manejar la visualización 
 * de información relacionada con vuelos, pasajes y pasajeros.
 */

class FlightPassagePassengerView {

    /**
     * Método para mostrar los detalles de un vuelo.
     * @param array $data   Datos del vuelo en formato JSON.
     */
    
    public function showInfoFlight($data) {
        // Decodificar los datos JSON del vuelo
        $flight = json_decode($data, true);

        // Generar el HTML para mostrar los detalles del vuelo
        echo '<section class="text-center text-md-start bloque">'
        . '<h1 class="m-5 text-center display-3" id="bloque__h1">Detalles Vuelo</h1>'
        . '<div class="card">
            <h2 class="card-header text-center" id="card__header">Vuelo ' . $flight['Identificador'] . '</h2>
                <div class="card-body text-center">
                
                <!-- Detalles del aeropuerto de origen -->
                    <div class="d-flex justify-content-evenly mb-4">
                        <div class="card__body--origen rounded-4 me-3 p-5">
                            <p class="card-text"><span class="card__span">Aeropuerto Origen: </span>' . $flight['Aeropuerto_Origen'] . '</p>
                            <p class="card-text"><span class="card__span">Nombre Aeropuerto: </span>' . $flight['Nombre_Aeropuerto_Origen'] . '</p>
                            <p class="card-text"><span class="card__span">Pais Aeropuerto: </span>' . $flight['Pais_Aeropuerto_Origen'] . '</p>
                        </div>
                        
                        <div class="pt-5">
                            <p class="pt-2 arrow">&#10140;</p>
                        </div>
                        
                        <!-- Detalles del aeropuerto de destino -->
                        <div class="card__body--destino rounded-4 p-5">
                            <p class="card-text"><span class="card__span">Aeropuerto Destino: </span>' . $flight['Aeropuerto_Destino'] . '</p>
                            <p class="card-text"><span class="card__span">Nombre Aeropuerto: </span>' . $flight['Nombre_Aeropuerto_Destino'] . '</p>
                            <p class="card-text"><span class="card__span">Pais Aeropuerto: </span>' . $flight['Pais_Aeropuerto_Destino'] . '</p>
                        </div>
                    </div>
                    
                    <!-- Otros detalles del vuelo -->
                    <p class="card-text"><span class="card__span">Tipo de vuelo: </span>' . $flight['Tipo'] . '</p>
                    <p class="card-text"><span class="card__span">Número de pasajeros: </span>' . $flight['Num_Pasajeros'] . '</p>
                </div>
                
                <!-- Botón para volver al inicio -->
                <div class="card-footer">               
                    <a href="index.php?controller=Flight&action=getAllFlights" class="btn btn-dark">Volver Inicio</a>
                </div>
        </div>
        </section>';
    }

    /**
     * Método para mostrar la información de los pasajes de un vuelo.
     * 
     * @param array $data   Datos de los pasajes en formato JSON
     */
    
    public function showInfoPassagesFlight($data) {
        // Decodificar los datos JSON de los pasajes
        $passages = json_decode($data,true);
        
        // Generar el HTML para mostrar la información de los pasajes
        echo '<section class="text-center text-md-start mb-5 bloque">'
        . '<h1 class="m-5 text-center display-3" id="bloque__h1">Pasajes Vuelo ' . $_POST['identificador'] . '</h1>'
        . '<div class="row row-cols-1 row-cols-md-3 g-4 mb-4">';
        
        foreach ($passages as $passage) {
            // Generar tarjeta para cada pasaje
            echo '<div class="col">
    <div class="card h-100 div__card">
    <div class="card-header text-center card--header">
    <h2 class="card-title card__header">Pasaje ' . $passage['Pasaje'] . '</h2>
    </div>
      <div class="card-body">        
        <p class="card-text"><span class="card__span">Pasajero: </span>' . $passage['Codigo_Pasajero'] . ' - ' . $passage['Nombre_Pasajero'] . '</p>
        <p class="card-text"><span class="card__span">Pais: </span>' . $passage['Pais_Pasajero'] . '</p>
        <p class="card-text"><span class="card__span">Nº Asiento: </span>' . $passage['Num_Asiento_Pasajero'] . '</p>
        <p class="card-text"><span class="card__span">Clase: </span>' . $passage['Clase'] . '</p>
        <p class="card-text"><span class="card__span">Precio: </span>' . $passage['Precio'] . ' €</p>
      </div>
    </div>
  </div>';
        }
        
        // Botón para volver al inicio
        echo '</div>'
        . '<a href="index.php?controller=Flight&action=getAllFlights" class="btn btn-dark">Volver Inicio</a>'
        . '</section>';
    }

    /**
     * Método para mostrar el formulario de inserción de pasajes.
     * 
     * @param string|array $message Mensaje de éxito o error.
     * @param type $flights         Lista de vuelos disponibles.
     * @param type $passengers      Lista de pasajeros disponibles.
     */
    
    public function formInsertPassage($message, $flights, $passengers) {
        // Verificar si hay un mensaje de éxito para mostrar
        $messageInsert = is_string($message) && is_array(json_decode($message, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;

        // Mostrar mensaje de éxito si existe
        if ($messageInsert) {
            $message = json_decode($message, true);
            echo '<div class="alert alert-success text-center" role="alert">' . $message['message'] . '</div>';
        }
        
        // Generar el HTML para el formulario de inserción de pasajes
        echo '<div id="booking" class="section">
		<div class="section-center">
                    <div class="container">
                        <div class="row">
                            <div class="booking-form">
				<div class="booking-bg">
                                    <div class="form-header">
					<h2>Insertar Pasaje</h2>								
                                    </div>
				</div>
				<form method="POST" action="index.php?controller=FlightPassagePassenger&action=insertPassage">
                                    <div class="row">
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Pasajero</span>
                                                <select class="form-control" name="pasajerocod" required>
                                                <option value="" disabled selected>Selecciona una opción</option>';
        
        // Mostrar opciones de pasajeros disponibles
        foreach ($passengers as $passenger) {
            echo '<option value="' . $passenger['pasajerocod'] . '">' . $passenger['pasajerocod'] . ' - ' . $passenger['nombre'] . '</option>';
        }
        echo '</select>
                                            <span class="select-arrow"></span>
                                            </div>
					</div>
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Vuelo</span>
                                                <select class="form-control" name="identificador" required>
                                                <option value="" disabled selected>Selecciona una opción</option>';
        
        // Mostrar opciones de vuelos disponibles
        foreach ($flights as $flight) {
            echo '<option value="' . $flight['Identificador'] . '">' . $flight['Identificador'] . ' - ' . $flight['Aeropuerto_Origen'] . ' - ' . $flight['Aeropuerto_Destino'] . '</option>';
        }
        echo '</select>
                                            <span class="select-arrow"></span>
                                            </div>
					</div>
                                    </div>
                                    <div class="row">
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Número asiento</span>
                                                <input type="number" class="form-control" placeholder="Número asiento" max="100" name="numasiento" min="1" required value="">
                                            </div>
					</div>
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Clase</span>
                                                    <select class="form-control" name="clase">
                                                        <option value="TURISTA">TURISTA</option>
							<option value="PRIMERA">PRIMERA</option>
							<option value="BUSINESS">BUSINESS</option>
                                                    </select>
                                                    <span class="select-arrow"></span>
                                            </div>
					</div>
                                    </div>
                                    <div class="form-group">
					<span class="form-label">Precio</span>
                                        <input type="number" class="form-control" placeholder="Precio" max="999" name="pvp" min="1" required value="">
                                    </div>
                                    <div class="form-btn">
					<button class="submit-btn">Insertar Pasaje</button>
                                    </div>
				</form>
                            </div>
                        </div>
                    </div>
		</div>
	</div>';
    }

    /**
     * Método para mostrar el formulario de modificación de pasajes.
     * 
     * @param array $passengers         Lista de pasajeros disponibles.
     * @param type $flights             Lista de vuelos disponibles.
     * @param string|array $message     Mensaje de éxito o error.    
     * @param array $passage            Datos del pasaje a modificar.
     */
    
    public function formUpdatePassage($passengers, $flights, $message, $passage) {
        // Verificar si hay un mensaje de éxito para mostrar
        $messageUpdate = is_string($message) && is_array(json_decode($message, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;

        // Mostrar mensaje de éxito si existe
        if ($messageUpdate) {
            $message = json_decode($message, true);
            echo '<div class="alert alert-info text-center" role="alert">' . $message['message'] . '</div>';
        }

        // Generar el HTML para el formulario de modificación de pasajes
        echo '<div id="booking" class="section">
		<div class="section-center">
                    <div class="container">
                        <div class="row">
                            <div class="booking-form">
				<div class="booking-bg">
                                    <div class="form-header">
					<h2>PASAJE ' . $passage['Pasaje'] . '</h2>
                                        <p>PASAJERO: ' . $passage['Cod_Pasajero'] . '. ' . $passage['Nombre_Pasajero'] . '</p>
                                        <p>VUELO: ' . $passage['Identificador'] .'</p>
                                        <p>Nº ASIENTO: ' . $passage['Num_Asiento'] .'</p>
                                        <p>CLASE: ' . $passage['Clase'] .'</p>
                                        <p>PRECIO: ' . $passage['Precio'] .' €</p>
                                    </div>
				</div>
				<form method="POST" action="index.php?controller=Passage&action=updatePassage">
                                    <div class="row">
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Pasajero</span>
                                                <select class="form-control" name="pasajerocod" required>
                                                <option value="" disabled selected>Selecciona una opción</option>';
        
        // Mostrar opciones de pasajeros disponibles
        foreach ($passengers as $passenger) {
            echo '<option value="' . $passenger['pasajerocod'] . '">' . $passenger['pasajerocod'] . ' - ' . $passenger['nombre'] . '</option>';
        }
        echo '</select>
                                            <span class="select-arrow"></span>
                                            </div>
					</div>
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Vuelo</span>
                                                <select class="form-control" name="identificador" required>
                                                <option value="" disabled selected>Selecciona una opción</option>';
        
        // Mostrar opciones de vuelos disponibles
        foreach ($flights as $flight) {
            echo '<option value="' . $flight['Identificador'] . '">' . $flight['Identificador'] . ' - ' . $flight['Aeropuerto_Origen'] . ' - ' . $flight['Aeropuerto_Destino'] . '</option>';
        }
        echo '</select>
                                            <span class="select-arrow"></span>
                                            </div>
					</div>
                                    </div>
                                    <div class="row">
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Número asiento</span>
                                                <input type="number" class="form-control" max="100" name="numasiento" min="1" required value="' . $passage['Num_Asiento'] . '">
                                            </div>
					</div>
					<div class="col-md-6">
                                            <div class="form-group">
						<span class="form-label">Clase</span>
                                                    <select class="form-control" name="clase">
                                                        <option value="TURISTA">TURISTA</option>
							<option value="PRIMERA">PRIMERA</option>
							<option value="BUSINESS">BUSINESS</option>
                                                    </select>
                                                    <span class="select-arrow"></span>
                                            </div>
					</div>
                                    </div>
                                    <div class="form-group">
					<span class="form-label">Precio</span>
                                        <input type="number" class="form-control" max="999" name="pvp" min="1" required value="' . $passage['Precio'] . '">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="idpasaje" hidden value="' . $passage['Pasaje'] . '">
                                    </div>
                                    <div class="form-btn">
					<button type="submit" class="submit-btn">Modificar Pasaje</button>
                                    </div>
				</form>
                            </div>
                        </div>
                    </div>                    
		</div>        
	</div>';
    }
}
