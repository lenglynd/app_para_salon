<h1 class="nombre-pagina">Olvidé Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>
<?php
include_once __DIR__."/../templates/alertas.php";
?>
<form action="/olvide" method="POST" class="formulario">
<div class="campo">
    <label for="email">Email</label>
    <input 
        type="email"
        id="email"
        name="email"
        placeholder="Tu email"
    
    />
</div>

<input type="submit" value="Enviar instrucciones" class="boton">
</form>

<div class="acciones">
<a href="/">¿Si ya tienes cuenta, inicia sessión?</a>
<a href="/crear-cuenta">¿Si aún no tienes cuenta? crea una</a>
</div>
