<?php

/**
 * Clase PassageView
 * 
 * Esta clase se encarga de mostrar la información de los pasajes en diferentes formatos.
 */

class PassageView{
    
    /**
     * Método para mostrar todos los pasajes.
     * 
     * @param string $data      Datos de los pasajes en formato JSON.
     * @param string $message   Mensaje de éxito o error en formato JSON.
     */
    
    public function showAllPassages($data, $message) {
        // Mostrar el encabezado de la sección
        echo '<section class="text-center text-md-start bloque">'
        . '<h1 class="m-5 text-center display-3" id="bloque__h1">LISTADO DE PASAJES</h1>';
        
        // Verificar si hay un mensaje de éxito o error y mostrarlo
        $messageDelete =  is_string($message) && is_array(json_decode($message, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
        
        if($messageDelete){
            $message = json_decode($message, true);
            echo '<div class="alert alert-info text-center" role="alert">'. $message['message'] .'</div>';
        }
        
        // Decodificar los datos JSON de los pasajes
        $passages = json_decode($data, true);
        
        // Mostrar la tabla de pasajes
        echo '<table class="text-center" id="table">'
        . '<thead class="table-secondary">'
        . '<tr class="table__tr">'
        . '<th class="table__th" scope="col">Código Pasaje</th>'
        . '<th class="table__th" scope="col">Nombre Pasajero</th>'
        . '<th class="table__th" scope="col">Identificador</th>'
        . '<th class="table__th" scope="col">Nº Asiento</th>'
        . '<th class="table__th" scope="col">Clase</th>'
        . '<th class="table__th" scope="col">PVP</th>'
        . '<th class="table__th" scope="col">Borrar</th>'
        . '<th class="table__th" scope="col">Modificar</th>'
        . '</tr>'
        . '</thead>'
        . '<tbody>';
        
        // Mostrar detalles de cada pasaje en filas de la tabla
        foreach ($passages as $passage){
            echo '<tr class="table__tr">'
            . '<td class="table__td">' . $passage['Pasaje'] . '</td>'
                    . '<td class="table__td">' . $passage['Nombre_Pasajero'] . '</td>'
                    . '<td class="table__td">' . $passage['Identificador'] . '</td>'
                    . '<td class="table__td">' . $passage['Num_Asiento'] . '</td>'
                    . '<td class="table__td">' . $passage['Clase'] . '</td>'
                    . '<td class="table__td">' . $passage['Precio'] . ' €</td>'
                    . '<td class="table__td">'
                        . '<form method="POST" action="index.php?controller=Passage&action=deletePassage">'
                            . '<input type="text" name="idpassage"  value="' . $passage['Pasaje'] . '" hidden>'
                            . '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#miModal'.$passage['Pasaje'].'">Borrar</button>'
                    . '<div class="modal fade" id="miModal'.$passage['Pasaje'].'" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog text-black fs-5">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-black">localhost dice</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estas seguro de querer eliminar este pasaje?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                </div>
                            </div>
                        </div>           
                    </div>'
                        . '</form>'
                    . '</td>'
                    . '<td class="table__td">'
                        . '<form method="POST" action="index.php?controller=FlightPassagePassenger&action=showFormUpdatePassage">'
                            . '<input type="text" name="idpassage"  value="' . $passage['Pasaje'] . '" hidden>'
                            . '<button type="submit" class="btn btn-warning ms-3">Modificar</button>'
                        . '</form>'
                    . '</td>'
            . '</tr>';
        }
        echo '</tbody>'
        . '</table>'
        . '</section>';
    }        
}
