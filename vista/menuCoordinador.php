<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Coordinador</title>
</head>
<body>
    <div>
        <h2>Datos Usuarios:</h2>
        <ul>
            <?php foreach ($datos['usuarios_deportes'] as $fila){
                echo "<li>".$fila['nombreUsuario']." - ".$fila['apeNombre']." - ".$fila['correo']." - ".($fila['telefono'] ?? 'N/A')." - ".$fila['perfil']." - ".$fila['deporte']."</li>";
            }
            ?>
        </ul>
    </div>
    <div>
        <h2>Datos Deportes:</h2>
        <ul>
            <?php foreach ($datos['deportes'] as $fila){
                echo "<li>".$fila['deporte']." - Total usuarios: ".$fila['total_usuarios']."</li>";
            }
            ?>
        </ul>
    </div>
    <div>
        <h2>Estadísticas:</h2>
        <?php 
            // total_deportes viene como array de arrays: $datos['total_deportes'][0]['Total_Deportes']
            $total = $datos['total_deportes'][0]['Total_Deportes'] ?? 0;
        ?>
        <p>Total de deportes con personas inscritas: <?= $total ?></p>
    </div>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
