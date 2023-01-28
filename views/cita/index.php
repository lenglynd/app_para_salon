<?php include_once __DIR__.'/../templates/barra.php' ?>
<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div class="app">
    <nav class="tabs">
        <button  class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button"  data-paso="2">información cita</button>
        <button type="button"  data-paso="3">Resumen</button>
    </nav>
    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div class="listado-servicios" id="servicios"></div>
    
    </div>

    <div class="seccion" id="paso-2">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>

        <form action="" class="formulario">
            <div class="campo">
            <label for="nombre">Nombre</label>
            <input 
                id="nombre"
                type="text"
                placeholder="Tu nombre"
                value="<?php echo $nombre; ?>"
                disabled
            
            />

            </div>  
            <div class="campo">
            <label for="fecha">fecha</label>
            <input 
                id="fecha"
                type="date"
                min="<?php echo date('Y-m-d',strtotime('+1 day'))?>"

            />

            </div>  
            <div class="campo">
            <label for="hora">hora</label>
            <input 
                id="hora"
                type="time"

            />

            </div>  
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>

    <div class="seccion contenido-resumen" id="paso-3">
        <h2>Resumen</h2>
        <p>Verifica que la información es correcta</p>
    </div>

    <div class="paginacion">
    <button 
        class="boton"
        id="anterior"
        >&laquo; Anterior

    </button>
    <button 
        class="boton"
        id="siguiente"
        >Siguente &raquo;

    </button>

    </div>

</div>

<?php

 $scripts="
 <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>

 <script src='build/js/app.js'></script>";
?>