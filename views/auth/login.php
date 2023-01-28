<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<?php
include_once __DIR__."/../templates/alertas.php";
?>
<form action="/" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu email"
            name="email"       
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            placeholder="Tu password"
            name="password"       
        />
    </div>
    <input 
        type="submit" 
        class="boton"
        value="Iniciar Sesión"
    
    />

</form>

<div class="acciones">
    <a href="/crear-cuenta">¿Si aún no tienes cuenta, crea una con nosotros?</a>
    <a href="/olvide">¿olvidaste tu clave?</a>
</div>
