<?php

/**
 * Clase FlightView
 * 
 * Esta clase se encarga de mostrar la información de los vuelos en diferentes formatos.
 */

class FlightView{
    
    /**
     * Método para mostrar todos los vuelos.
     * @param string $data   Datos de los vuelos en formato JSON.
     */
    
    public function showAllFlights($data) {
        // Decodificar los datos JSON de los vuelos
        $flights = json_decode($data, true);
        
        // Mostrar el encabezado de la sección
        echo '<section class="text-center text-md-start bloque">'
        . '<h1 class="m-5 text-center display-3" id="bloque__h1">Listado de Vuelos</h1>'
                // Formulario para seleccionar un vuelo y mostrar información relacionada
                . '<form class="d-flex justify-content-center mb-5 bloque__form" method="POST" action="index.php?controller=FlightPassagePassenger&action=showInfo">'
                . '<select class="me-3 form__select" name="identificador" required>'
                . '<option value="" disabled selected>Selecciona una opción</option>';
        
        // Mostrar opciones de identificador de vuelo disponibles
        foreach($flights as $flight){
                    echo '<option value="'.$flight['Identificador'].'">'.$flight['Identificador'].'</option>';
                }
                
        // Botones para mostrar información específica del vuelo seleccionado
        echo '</select>'
                . '<button class="btn btn-primary me-3" name="btn_flight" type="submit">Info Vuelo</button>'
                . '<button class="btn btn-secondary me-3" name="btn_passage" type="submit">Datos Pasaje</button>'
                . '</form>'
                
        // Tabla para mostrar detalles de los vuelos
        . '<table class="text-center">'
        . '<thead class="table-secondary">'
        . '<tr class="table__tr">'
        . '<th class="table__th" scope="col">Identificador</th>'
        . '<th class="table__th" scope="col">Aeropuerto Origen</th>'
        . '<th class="table__th" scope="col">Nombre Aeropuerto</th>'
        . '<th class="table__th" scope="col">Pais Aeropuerto</th>'
        . '<th class="table__th" scope="col">Aeropuerto Destino</th>'
        . '<th class="table__th" scope="col">Nombre Aeropuerto</th>'
        . '<th class="table__th" scope="col">Pais Aeropuerto</th>'
        . '<th class="table__th" scope="col">Tipo</th>'
        . '<th class="table__th" scope="col">Nº pasajeros</th>'
        . '</tr>'
        . '</thead>'
        . '<tbody>';
        
        // Mostrar detalles de cada vuelo en filas de la tabla
        foreach ($flights as $flight){
            echo '<tr class="table__tr">'
            . '<td class="table__td">' . $flight['Identificador'] . '</td>'
                    . '<td class="table__td">' . $flight['Aeropuerto_Origen'] . '</td>'
                    . '<td class="table__td">' . $flight['Nombre_Aeropuerto_Origen'] . '</td>'
                    . '<td class="table__td">' . $flight['Pais_Aeropuerto_Origen'] . '</td>'
                    . '<td class="table__td">' . $flight['Aeropuerto_Destino'] . '</td>'
                    . '<td class="table__td">' . $flight['Nombre_Aeropuerto_Destino'] . '</td>'
                    . '<td class="table__td">' . $flight['Pais_Aeropuerto_Destino'] . '</td>'
                    . '<td class="table__td">' . $flight['Tipo'] . '</td>'
                    . '<td class="table__td">' . $flight['Num_Pasajeros'] . '</td>'
            . '</tr>';
        }
        echo '</tbody>'
        . '</table>'
        . '</section>';
    }
}

