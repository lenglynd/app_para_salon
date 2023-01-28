<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>
<?php
include_once __DIR__."/../templates/alertas.php";
if($error) return ;
?>

<form action="" method="POST" class="formulario">
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            name="password"
            placeholder="Tu nueva clave"
        
        />
    </div>

    <input type="submit" class="boton" value="Guardar nueva clave">
</form>

<div class="acciones">
    <a href="/">Si resuerdas tu clave Inicia sesión aqui</a>
    <a href="/crear-vuenta">Crea una nueva cuenta</a>
</div>