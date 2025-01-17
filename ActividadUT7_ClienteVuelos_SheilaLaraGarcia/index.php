<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <!-- Se enlaza el archivo de estilos CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css">
        
        <!-- Enlace a Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        
        <!-- Enlaces a las fuentes de Google Fonts -->
        <link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css">
        
        <title>RestFul_Vuelos_SheilaLaraGarcia</title>
    </head>
    <body class="body">
        <?php
            // Se incluye el archivo Header.php que contiene la cabecera de la página
            include 'views/templates/Header.php';
        ?>
        <div class="container">
            <?php
                // Se incluyen el archivo frontcontroller.php que se encarga de dirigir las solicitudes y el archivo Footer.php que contiene el pie de página
                include 'frontcontroller.php';
                include 'views/templates/Footer.php';
            ?>
        </div>
        
        <!-- Se incluye el script de Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
