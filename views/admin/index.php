<?php include_once __DIR__.'/../templates/barra.php' ?>
<h1 class="nombre-pagina">Panel de Administracion</h1>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date" 
                name="fecha" 
                id="fecha"
                value="<?php echo  $fecha;?>"
            
            />
        </div>
    </form>
</div>
<?php
    if(count($citas)===0){
        echo "<h2>No hay citas en esta fecha</h2>";
    }
?>
<div class="citas-admin">
    <ul class="citas">
    <?php
    $idCita=0;
    foreach ($citas as $key=>$cita):
        if($idCita!==$cita->id):
            $total=0;
            $idCita=$cita->id
    ?>
    <li>
        <p>ID: <span><?php echo $cita->id; ?></span></p>
        <p>Hora: <span><?php echo $cita->hora; ?></span></p>
        <p>Nombre: <span><?php echo $cita->cliente; ?></span></p>
        <p>Email: <span><?php echo $cita->email; ?></span></p>
        <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>
        <h3>Servicios</h3>
        <?php endif;
        $total+=$cita->precio;
        ?>

        <p class="servicio"><?php echo $cita->servicio.' $ '.$cita->precio; ?></p>

    <?php $actual=$cita->id;
    $proximo=$citas[$key+1]->id ?? 0;
    if(esUltimo($actual,$proximo)):
    ?>
    <p class="total">TOTAL: <span><?php echo ' $ '.$total; ?></span></p>
    <form action="/api/eliminar" method="POST">
        <input type="hidden" name="id" value="<?php echo $cita->id;?>">
        <input type="submit" value="Eliminar" class="boton-eliminar">
    </form>
    <?php

    endif;
    ?>    
    <?php endforeach;  ?>
    </ul>
</div> 
<?php
$scripts="
 <script src='build/js/buscador.js'></script>";
?>