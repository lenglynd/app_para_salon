<?php
    include_once __DIR__.'/../templates/barra.php';
    include_once __DIR__.'/../templates/alertas.php';
?>

<h1 class="nombre-pagina">Crear Servicio</h1>
<p class="descripcion-pagina">Crea un nuevo servicio en formulario</p>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php
        include_once __DIR__.'/formulario.php';
    ?>

    <input type="submit" value="Guardar Sevicio" class="boton">
</form>