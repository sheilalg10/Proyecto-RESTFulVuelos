<!-- Inicio de la barra de navegación (nav) -->
<nav class="navbar navbar-expand-lg">
    <!-- Contenedor fluido para el contenido de la barra de navegación -->
    <div class="container-fluid">
        <!-- Enlace que sirve como el título de la barra de navegación -->
        <a class="navbar-brand" id="nav__title" href="#">RestFul Vuelos</a>
        <!-- Área colapsable de la barra de navegación -->
        <div class="collapse navbar-collapse" id="navbarScroll">
            <!-- Lista de elementos de la barra de navegación -->
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <!-- Elemento de lista para el enlace "Vuelos" -->
                <li class="nav-item">
                    <!-- Enlace "Vuelos" -->
                    <a class="nav-link active" id="nav__link_flights" aria-current="page" href="index.php?controller=Flight&action=getAllFlights">Vuelos</a>
                </li>
                <!-- Elemento de lista para el enlace "Insertar Pasaje" -->
                <li class="nav-item">
                    <!-- Enlace "Insertar Pasaje" -->
                    <a class="nav-link" id="nav__link_insert" href="index.php?controller=FlightPassagePassenger&action=showFormInsertPassage">Insertar Pasaje</a>
                </li>
                <!-- Elemento de lista para el enlace "Pasajes" -->
                <li class="nav-item">
                    <!-- Enlace "Pasajes" -->
                    <a class="nav-link" id="nav__link_passages" href="index.php?controller=Passage&action=getAllPassages">Pasajes</a>
                </li>
            </ul>      
        </div>
    </div>
</nav>
<!-- Fin de la barra de navegación -->
