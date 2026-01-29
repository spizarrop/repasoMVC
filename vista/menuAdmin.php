<div>
    <h2>Datos Usuarios:</h2>
    <div>
        <ul>
            <?php
                foreach ($datos['usuarios_deportes'] as $fila) {
                    echo "<li>".$fila['nombreUsuario']." - ".$fila['apeNombre']." - ".$fila['correo']." - ".$fila['telefono']." - ".$fila['perfil']."</li>";
                    echo "<br/>";
                }
            ?>
        </ul>
    </div>
</div>
<div>
    <h2>Datos Deportes:</h2>
    <div>
        <ul>
            <?php
                foreach ($datos['deportes'] as $fila) {
                    echo "<li>".$fila['deporte']."</li>";
                    echo "<br/>";
                }
            ?>
        </ul>
    </div>
</div>
<div>
    <h2>Estadisticas:</h2><br/>
    <p>Total de deportes con personas inscritas: <?= $datos['total_deportes'] ?></p>
</div>
<a href="index.php">Volver</a>